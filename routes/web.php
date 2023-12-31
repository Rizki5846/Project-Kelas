<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudentController;
use App\Models\Student;

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
Route::get('/coba', [CobaController::class, 'test']);
Route::view('/view', 'tampilan');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['role:admin|user']], function () {
    Route::get('/data', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('data');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('user')
    ->name('user.')
    ->group(function() {
        Route::get('/unsur/{name?}', function(string $name=null){
            if($name == null) {
                return "hello there .. ";
            } else {
                return "hello ".$name;
            }
        })->name('test');
});


Route::get('/test-lagi', function () {
    return view('test'); 
});

Route::prefix('lecturer')
    ->name('lecturer.')
    ->group(function() {
        Route::get('/', [LecturerController::class, 'index'])->name('index');
});
Route::prefix('student')
    ->name('student.')
    ->group(function() {
        Route::get('/', [StudentController::class, 'index'])->name('index');
});

require __DIR__.'/auth.php';