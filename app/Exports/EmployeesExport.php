<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Employee::with(['user', 'department', 'jobTitle'])->get();
    }

    /**
     * Define the headings for the Excel file
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Department',
            'Position',
            'Salary',
            'Hire Date',
            'Status'
        ];
    }

    /**
     * Map the data for each row
     */
    public function map($employee): array
    {
        return [
            $employee->id,
            $employee->user->name,
            $employee->user->email,
            $employee->department->name,
            $employee->jobTitle->title,
            $employee->salary,
            $employee->hire_date,
            $employee->status
        ];
    }
}