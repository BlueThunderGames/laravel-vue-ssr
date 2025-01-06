<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return Inertia::render('Introduction', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('introduction');

Route::middleware('auth')->group(function () {
    /*
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    */

    Route::resource('students', StudentController::class);
    
});

Route::fallback(function()
{
    if(Auth::check())
    {
        return Inertia::render('Errors/404Auth');
    }
    else 
    {
        return Inertia::render('Errors/404NonAuth');
    }
});

require __DIR__.'/auth.php';
