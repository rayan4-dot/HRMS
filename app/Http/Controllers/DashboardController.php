<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        
        if ($user->hasRole('Manager')) {
            $managerDepartment = $user->employee->department_id;
            $employees = Employee::where('department_id', $managerDepartment)->with(['user', 'position', 'department'])->get();
        } else {
            $employees = Employee::with(['user', 'position', 'department'])->get();
        }

        return view('dashboard', compact('employees'));
    }
}