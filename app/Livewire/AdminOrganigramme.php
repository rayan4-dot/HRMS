<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class AdminOrganigramme extends Component
{
    public $employees = [];

    protected $rules = [
        'employees.*.manager_id' => 'nullable|exists:employees,id',
    ];

    public function mount()
    {
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized. Admins only.');
        }

        $this->loadEmployees();
    }

    public function loadEmployees()
    {
        $this->employees = Employee::with(['user', 'position', 'department', 'manager', 'subordinates'])
            ->get()
            ->map(function ($employee) {
                return [
                    'id' => $employee->id,
                    'name' => $employee->user->name ?? 'Unnamed',
                    'position' => $employee->position->title ?? 'N/A',
                    'department' => $employee->department->name ?? 'N/A',
                    'manager_id' => $employee->manager_id,
                ];
            })->toArray();
    }

    public function updateHierarchy()
    {
        $this->validate();

        foreach ($this->employees as $employee) {
            Employee::where('id', $employee['id'])->update(['manager_id' => $employee['manager_id']]);
        }

        $this->loadEmployees();
        session()->flash('message', 'Organigramme updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin-organigramme');
    }
}