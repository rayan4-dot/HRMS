<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\VacationRequest;
use App\Models\VacationBalance;
use Carbon\Carbon;
use Livewire\Component;

class VacationManagement extends Component
{
    public $employee;
    public $vacationBalance;
    public $start_date;
    public $end_date;
    public $reason;
    public $totalDays = 0;

    protected $rules = [
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',

        'reason' => 'required|string|max:255', // Added validation for reason
    ];

    public function mount()
    {

        $this->employee = Employee::where('user_id', auth()->id())->first();
        if (!$this->employee) {
            session()->flash('error', 'Employee record not found.');
            return;
        }

 
        $this->employee = Employee::where('user_id', auth()->id())->first();
        
        $this->loadVacationBalance();
    }

    private function loadVacationBalance()
    {
        $this->vacationBalance = VacationBalance::where('employee_id', $this->employee->id)->first();

        if (!$this->vacationBalance || $this->shouldRecalculateBalance()) {
            $initialBalance = $this->calculateInitialBalance();
            if ($this->vacationBalance) {
                $this->vacationBalance->update($initialBalance);
            } else {
                $this->vacationBalance = VacationBalance::create(
                    array_merge(['employee_id' => $this->employee->id], $initialBalance)
                );
            }
        }
    }

    private function shouldRecalculateBalance()
    {
        // Recalculate if balance is 0 or last update is over a year old
        return !$this->vacationBalance->current_balance ||
               Carbon::parse($this->vacationBalance->last_balance_update)->diffInYears(Carbon::now()) >= 1;
        $this->vacationBalance = VacationBalance::firstOrCreate(
            ['employee_id' => $this->employee->id],
            $this->calculateInitialBalance()
        );
    }

    private function calculateInitialBalance()
    {
        // Calculate years of service
        $employmentStartDate = $this->employee->created_at;
        $yearsOfService = $employmentStartDate->diffInYears(Carbon::now());

        if ($yearsOfService < 1) {
            $monthsWorked = max(1, $employmentStartDate->diffInMonths(Carbon::now())); // Ensure at least 1 month
            $balance = $monthsWorked * 1.5;
        } else {
            $balance = 18 + (($yearsOfService - 1) * 0.5);
        }


            $monthsWorked = $employmentStartDate->diffInMonths(Carbon::now());
            $balance = $monthsWorked * 1.5;
            // dump("balance 1", $balance);
        } else {
            // Base 18 days + 0.5 days per year after first year
            $balance = intval(18 + (($yearsOfService - 1) * 0.5));
            // dump($balance);
        }
        // dd();
        return [
            'current_balance' => $balance,
            'acquired_days' => $balance,
            'last_balance_update' => now(),
            'years_of_service' => $yearsOfService,
            'employment_start_date' => $employmentStartDate
        ];
    }

    public function calculateTotalDays()
    {
        if ($this->start_date && $this->end_date) {
            $start = Carbon::parse($this->start_date);
            $end = Carbon::parse($this->end_date);
            
            $this->totalDays = $start->diffInDaysFiltered(function (Carbon $date) {
                return !$date->isWeekend();
            }, $end) + 1;
        }
    }

    public function updatedStartDate()
    {
        $this->calculateTotalDays();
    }

    public function updatedEndDate()
    {
        $this->calculateTotalDays();
    }

    public function submit()
    {
        $this->validate();

        if (Carbon::now()->diffInDays(Carbon::parse($this->start_date)) < 7) {
            $this->addError('start_date', 'Vacation requests must be submitted at least 7 days in advance.');
            return;
        }

        if ($this->totalDays > $this->vacationBalance->current_balance) {
            $this->addError('end_date', 'Insufficient vacation balance. You only have ' . 
                number_format($this->vacationBalance->current_balance, 1) . ' days available.');

        // dd("hello");
        $this->validate();

        // Check minimum notice period (7 days)
        // dd(Carbon::parse($this->start_date)->diffIndays(Carbon::now()));
        if (Carbon::now()->diffInDays(Carbon::parse($this->start_date)) < 7) {
            $this->addError('start_date', 'Vacation requests must be submitted at least 7 days in advance.');
            dd("start date must be greater that 7 days");
            return;
        }
        // dd($this->vacationBalance->current_balance);
        if ($this->totalDays > $this->vacationBalance->current_balance) {
            $this->addError('end_date', 'Insufficient vacation balance. You only have ' . 
                number_format($this->vacationBalance->current_balance, 1) . ' days available.');
                dd("Invalid balance");
            return;
        }

        $request = VacationRequest::create([
            'employee_id' => $this->employee->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'total_days' => $this->totalDays,
               'execuse' => $this->reason, // Note: 'execuse' might be a typo, should it be 'excuse'?
            'status' => 'pending',
        ]);

        // Deduct the used days from the balance
        $this->vacationBalance->current_balance -= $this->totalDays;
        $this->vacationBalance->save();

        $this->reset(['start_date', 'end_date', 'reason', 'totalDays']);
            'execuse' => $this->reason,
            'status' => 'pending',
            // Get the employee's manager ID from department
            // 'manager_id' => $this->employee->department->manager_id ?? null
        ]);

        // Reset form
        $this->reset(['start_date', 'end_date', 'reason']);
           session()->flash('message', 'Vacation request submitted successfully!');
    }

    public function render()
    {
        $pendingRequests = VacationRequest::where('employee_id', $this->employee->id)
            ->orderBy('created_at', 'desc')
            ->get();
   

// dd($pendingRequests);
           return view('livewire.vacation-management', [
            'pendingRequests' => $pendingRequests
        ]);
    }
}