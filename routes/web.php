<?php

use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ChecklistController::class, 'index'])->name('index');

Route::middleware('auth')->group(function() 
{
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/tasks/{id}', [TaskController::class, 'view']);
    
    Route::middleware('isAdm')->group(function()
    {
        Route::get('/adm/checklists', [ChecklistController::class, 'create'])->name('add_checklist');
        Route::get('/adm/checklist/edit/{id}', [ChecklistController::class, 'edit'])->name('edit_checklist');
        Route::post('/adm/checklists', [ChecklistController::class, 'store']);
        Route::post('/adm/checklist/edit/{id}', [ChecklistController::class, 'update']);
        Route::post('/adm/checklist/delete/{id}', [ChecklistController::class, 'delete']);

        Route::get('/adm/tasks', [TaskController::class, 'create'])->name('add_task');
        Route::post('/adm/tasks', [TaskController::class, 'store']);
        Route::post('/adm/task/delete/{id}', [TaskController::class, 'delete']);
    });
});

Route::middleware('guest')->group(function () 
{
    Route::post('/register', [UserController::class, 'store']);
    Route::post('/login', [UserController::class, 'login']);
});


