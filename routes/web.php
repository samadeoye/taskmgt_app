<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

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

//Main
Route::get('/', [MainController::class, 'index'])->name('index.view')->middleware('Logged_in');
Route::get('/login', [MainController::class, 'loginView'])->name('login.view')->middleware('Already_in');
Route::post('/login/run', [MainController::class, 'loginRun'])->name('login.run');
Route::get('/logout', [MainController::class, 'logout'])->name('logout');
Route::get('/profile', [MainController::class, 'profileView'])->name('profile.view')->middleware('Logged_in');
Route::post('/profile/run', [MainController::class, 'profileRun'])->name('profile.run')->middleware('Logged_in');
Route::get('/security', [MainController::class, 'securityView'])->name('security.view')->middleware('Logged_in');
Route::post('/security/run', [MainController::class, 'securityRun'])->name('security.run')->middleware('Logged_in');

//Project
Route::get('/projects', [ProjectController::class, 'projectsView'])->name('projects.view')->middleware('Logged_in');
Route::post('/projects/run', [ProjectController::class, 'projectsRun'])->name('projects.run')->middleware('Logged_in');
Route::post('/projects/update', [ProjectController::class, 'projectsUpdate'])->name('projects.update')->middleware('Logged_in');


//Task
Route::get('/tasks', [TaskController::class, 'tasksView'])->name('tasks.view')->middleware('Logged_in');
Route::post('/tasks/run', [TaskController::class, 'tasksRun'])->name('tasks.run')->middleware('Logged_in');
Route::post('/tasks/update', [TaskController::class, 'tasksUpdate'])->name('tasks.update')->middleware('Logged_in');
Route::post('/tasks/updateOrder', [TaskController::class, 'tasksUpdateOrder'])->name('tasks.updateOrder')->middleware('Logged_in');