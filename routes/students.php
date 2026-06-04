<?php

use App\Http\Controllers\Public\StudentsController;
use Illuminate\Support\Facades\Route;

Route::get('/siswa', [StudentsController::class, 'index'])->name('students.index');

