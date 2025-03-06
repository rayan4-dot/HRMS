<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\Job;
use Livewire\Component;
use App\Models\Department;
use Spatie\Permission\Models\Role;

class EmployeeForm extends Component
{
    public $employee;
    public $departments = [];
    public $jobs = [];
    public $roles;
    public $selectedDepartment = '';
    public $search = '';

    public function mount($employee = null)
    {
        $this->employee = $employee;

        $user = auth()->user();
        if($user->hasRole('Manager')) {
            $this->departments = Department::where('id', $user->employee->department_id)->get();

        }
        else {

            $this->departments = Department::orderBy('name')->get();
        }


        if($user->hasRole('Admin')) {
            $this->roles = Role::whereNotIn('name', ['admin'])->get();

        }
        elseif ($user->hasRole('HR')) {
            $this->roles = Role::whereIn('name', ['HR', 'Manager', 'Employee']);
        }
        elseif ($user->hasRole('Manager')) {
            $this->roles = Role::where('name', 'Employee')->get();

        }
    }

    public function jobsByDepartment($department)
    {
        $this->jobs = Job::where('department_id', $department)->get();
    }

    public function render()
    {
        return view('livewire.employee-form');
    }
}
