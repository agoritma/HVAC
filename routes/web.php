<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware(AuthMiddleware::class);

// If need a middleware for role
Route::middleware(['Role:super_admin,admin'])->group(function () {
    Route::get('/add-employee', [EmployeeController::class, 'index'])->name('add-employee');
    Route::get('/list-employee', [EmployeeController::class, 'showEmployee'])->name('list-employee');
});

Route::post('/employee/create', [EmployeeController::class, 'createEmployee'])->name('create-employee');
Route::delete('/employee/delete/{id}', [EmployeeController::class, 'deleteEmployee'])->name('delete-employee');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
