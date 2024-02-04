<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/student/create',[StudentController::class,'create'])->name('student.create');
Route::post('/student', [StudentController::class, 'store'])->name('student.store');
Route::get('/student', [StudentController::class, 'index'])->name('student.index');
Route::get('/student/{student}', [StudentController::class,'show'])->name('student.show');
Route::get('/student/{student}/edit', [StudentController::class,'edit'])->name('student.edit');
Route::patch('/student/{student}', [StudentController::class,'update'])->name('student.update');
Route::delete('/student/{student}', [StudentController::class,'destroy'])->name('student.destroy');