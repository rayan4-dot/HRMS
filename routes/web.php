<?php

use App\Livewire\JobManagement;
use App\Livewire\ContractManagement;
use App\Livewire\FormationManagement;
use App\Livewire\AdminOrganigramme;
use Illuminate\Support\Facades\Route;
use App\Livewire\DepartmentManagement;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'redirect-based-on-role',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'index'])->name('profile.show');
    Route::get('/departments', DepartmentManagement::class)->name('departments.index');
    Route::get('/formations', FormationManagement::class)->name('formations.index');
    Route::get('/jobs', JobManagement::class)->name('jobs.index');
    Route::get('/contracts', ContractManagement::class)->name('contracts.index');
    Route::resource('/employees', EmployeeController::class);
});

Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->get('/admin/organigramme', function () {
    dd(Auth::user()->roles->pluck('name')); // Debug roles
    return \App\Livewire\AdminOrganigramme::class;
})->name('admin.organigramme');