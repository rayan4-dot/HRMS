<?php

namespace App\Exports;

use App\Models\Employee; // Adjust the namespace based on your Employee model location
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
        return Employee::with(['user', 'position', 'department'])->get();
    }

    /**
     * Define the headings for the Excel file
     */
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Position',
            'Department',
            'Hire Date',
            'Role',
        ];
    }

    /**
     * Map the data for each row
     */
    public function map($employee): array
    {
        return [
            $employee->user->name,
            $employee->user->email,
            $employee->position->title,
            $employee->department->name,
            $employee->hire_date,
            $employee->user->getRoleNames()->implode(','),
        ];
    }
}