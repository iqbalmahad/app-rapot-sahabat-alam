<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard')->middleware(['auth', 'role:admin']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::post('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login')->middleware(['guest']);
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::resource('students', SiswaController::class)->except(['show', 'index']);
Route::get('/students/in-school', [SiswaController::class, 'indexInSchool'])->name('students.inschool');
Route::get('/students/graduated', [SiswaController::class, 'indexGraduated'])->name('students.graduated');
