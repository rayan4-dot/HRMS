<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Livewire\{DepartmentManagement, FormationManagement, JobManagement, ContractManagement};
use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/employees', EmployeeController::class)->middleware('role:Admin|Manager|HR');


    Route::middleware('role:Admin')->group(function () {
        Route::get('/departments', DepartmentManagement::class)->name('departments.index');
        Route::get('/jobs', JobManagement::class)->name('jobs.index');
    });

    Route::middleware('role:Admin|HR')->group(function () {
        Route::get('/contracts', ContractManagement::class)->name('contracts.index');
        Route::get('/formations', FormationManagement::class)->name('formations.index');
    });


    Route::middleware('role:Manager|HR|Employee')->group(function () {
        Route::get('/employees/profile/{employee}', [EmployeeController::class, 'profile'])->name('employees.profile');
    });


    Route::middleware('role:Employee|Manager')->prefix('')->group(function () {
        Route::view('/vacations', 'vacations.index')->name('vacations.index');
        Route::view('/recovery-days', 'recovery-days.index')->name('recovery-days.index');
    });


    Route::middleware('role:HR|Manager')->group(function () {
        Route::view('/vacation-approvals', 'vacations.approvals')->name('vacation.approvals');
    });


    Route::middleware('role:HR')->group(function () {
        Route::view('/recovery-approval', 'recovery-days.approvals')->name('recovery-days.approvals');
    });


    Route::get('/employees/export', [EmployeeController::class, 'export'])
        ->middleware('role:Admin|Manager|HR')
        ->name('employees.export');


Route::get('/hierarchy', function() {
    return view('organigram.hierarchy');
})->name('organigram.hierarchy'); 
});
