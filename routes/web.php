<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ProgramController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;


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
    return view('landing');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin,super_admin'])->group(function () {
    Route::resource('programs', ProgramController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('lecturers', LecturerController::class);
    Route::resource('rooms', RoomController::class);
    Route::post('/timetables/generate', [TimetableController::class, 'generate'])->name('timetables.generate');

    Route::get('/import', [ImportController::class, 'index'])->name('import.index');
    Route::post('/import/programs', [ImportController::class, 'importPrograms'])->name('import.programs');
    Route::post('/import/courses', [ImportController::class, 'importCourses'])->name('import.courses');
    Route::post('/import/lecturers', [ImportController::class, 'importLecturers'])->name('import.lecturers');
    Route::post('/import/rooms', [ImportController::class, 'importRooms'])->name('import.rooms');
    Route::get('/import/template/{type}', [ImportController::class, 'downloadTemplate'])->name('import.template');
});

Route::middleware('auth')->group(function () {
    Route::get('/timetables', [TimetableController::class, 'index'])->name('timetables.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

