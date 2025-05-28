<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Formation;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Password;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeesExport;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if($user->hasRole('Manager')) {
            $managerDepartment = $user->employee->department_id;
            $employees = Employee::where('department_id', $managerDepartment)->get();
        } else {
            $employees = Employee::all();
        }

        return view('employees.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('profile_photo_path')) {
            $data['profile_photo_path'] = $request->file('profile_photo_path')->store('images', 'public');
        } else {
            $data['profile_photo_path'] = "";
        }

        $defaultPassword = 'rayan';

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($defaultPassword),
                'profile_photo_path' => $data['profile_photo_path']
            ]);

            $user->assignRole($data['role']);

            $employee = Employee::create([
                'user_id' => $user->id,
                'job_title_id' => $data['job_title_id'],
                'salary' => $data['salary'],
                'department_id' => $data['department'],
                'hire_date' => $data['hire_date']
            ]);

            $token = Password::createToken($user);
            Mail::to($user->email)->send(new ResetPassword($token, $user->name));
            session()->flash('success', "Employee created successfully.");
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            session()->flash('failed', "Employee's account creation failed.");
        }
        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($employeeId)
    {
        $employee = Employee::with([
            'user',
            'contracts' => function ($query) {
                $query->with('type')
                    ->orderBy('startDate', 'asc');
            }
        ])->findOrFail($employeeId);

        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', ['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();

            if ($request->hasFile('profile_photo_path')) {
                $data['profile_photo_path'] = $request->file('profile_photo_path');
            }

            $employee->user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'profile_photo_path' => $data['profile_photo_path'] ?? $employee->user->profile_photo_path
            ]);

            $employee->update([
                'job_title_id' => $data['job_title_id'],
                'salary' => $data['salary'],
                'department_id' => $data['department']
            ]);

            DB::commit();
            session()->flash('success', "Employee updated successfully");
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }

        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index');
    }

    public function profile($id)
    {
        $employee = Employee::with(['user', 'position', 'department', 'formations',
            'contracts' => function($query) {
                $query->with('type')->orderby('startDate');
            },
        ])->where('user_id', $id)->firstOrFail();

        $stats = [
            'totalContracts' => $employee->contracts->count(),
            'formations' => Formation::all()->count(),
            'current_contract' => $employee->contracts->where('status', 'active')->first()
        ]; 

        return view('employees.profile', ['employee' => $employee, 'stats' => $stats]);
    }

    public function export()
    {
        return Excel::download(new EmployeesExport, 'employees_' . now()->format('Y-m-d') . '.xlsx');
    }
}
