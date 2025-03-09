<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Employee;
use App\Models\RecoveryBalance;


class RecoveryRequest extends Component
{
    public $employee;
    public $start_date;
    public $end_date;
    public $days;

    public function mount($employee)
    {
        $this->employee = $employee;
    }

    protected $rules = [
        'start_date' => 'required|date|after_or_equal:today',
        'end_date'   => 'required|date|after_or_equal:start_date',
    ];

    public function submitRequest()
    {
        $this->validate();

        // Fetch balance with a null check
        $balanceRecord = RecoveryBalance::where('employee_id', $this->employee->id)->first();
        
        if (!$balanceRecord) {
            session()->flash('error', 'No recovery balance found for your account.');
            return;
        }

        $balance = $balanceRecord->current_balance;

        // Calculate working days (excluding weekends)
        $days = Carbon::parse($this->start_date)->diffInDaysFiltered(function (Carbon $date) {
            return !$date->isWeekend();
        }, Carbon::parse($this->end_date));

        if (intval($days) > intval($balance)) {
            session()->flash('error', "Requested days ($days) exceed your balance ($balance).");
            return;
        }

        // Create the recovery request
        RecoveryRequest::create([
            'employee_id' => $this->employee->id,
            'start_date'  => $this->start_date,
            'end_date'    => $this->end_date,
            'days'        => $days, // Use filtered days (excluding weekends)
            'status'      => 'pending',
        ]);

        // Optionally update the balance (if this is part of your logic)
        $balanceRecord->current_balance -= $days;
        $balanceRecord->save();

        session()->flash('message', 'Recovery request submitted successfully!');

        $this->reset(['start_date', 'end_date', 'days']);
    }

    public function render()
    {
        $requests = RecoveryRequest::where('employee_id', $this->employee->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.recovery-request', [
            'recoveryRequests' => $requests
        ]);
    }
}