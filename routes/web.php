<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RapotController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Admin\SD\SiswaSDController;
use App\Http\Controllers\Admin\TK\SiswaTKController;
use App\Http\Controllers\Admin\SMP\SiswaSMPController;
use App\Http\Controllers\Siswa\HakAksesSiswaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard')->middleware(['role:admin']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/profile/password-edit', [ProfileController::class, 'editPassword'])->name('profile.password-edit');
    Route::post('/profile/password-edit', [ProfileController::class, 'updatePassword'])->name('profile.password-update');

    Route::middleware(['role:client'])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        Route::get('/lihat-rapot', [HakAksesSiswaController::class, 'lihatRapot'])->name('lihatrapotasuser');
    });
});

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('siswa-tk', SiswaTKController::class);
    Route::resource('siswa-sd', SiswaSDController::class);
    Route::resource('siswa-smp', SiswaSMPController::class);
    Route::resource('rapot', RapotController::class)->except(['index', 'create']);
    Route::get('/rapot/{rapot}/create', [RapotController::class, 'create'])->name('rapot.create');
    Route::get('/import-siswa-tk', [ImportController::class, 'getImportSiswaTK']);
    Route::post('/import-siswa-tk', [ImportController::class, 'storeImportSiswaTK'])->name('siswa-tk.import');
    Route::get('/import-siswa-sd', [ImportController::class, 'getImportSiswaSD']);
    Route::post('/import-siswa-sd', [ImportController::class, 'storeImportSiswaSD'])->name('siswa-sd.import');
    Route::get('/import-siswa-smp', [ImportController::class, 'getImportSiswaSMP']);
    Route::post('/import-siswa-smp', [ImportController::class, 'storeImportSiswaSMP'])->name('siswa-smp.import');
    Route::get('/export-siswa', [ExportController::class, 'exportSiswa'])->name('export.siswa');
    Route::get('/export-rapot', [ExportController::class, 'exportRapot'])->name('export.rapot');
});
