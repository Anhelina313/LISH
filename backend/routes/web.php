<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');


/* Account routes */
Route::middleware(['auth', 'verified'])->group(function () {

    /* Redirect user to the correct dashboard */
    Route::get('/dashboard', function () {
        /** @var User $user */
        $user = Auth::user();

        return match ($user->role?->name) {
            'student' => redirect()->route('student.dashboard'),
            'teacher' => redirect()->route('teacher.dashboard'),
            default => abort(403),
        };
    })->name('dashboard');


    /* Student account */
    Route::middleware('role:student')->group(function () {
        Route::get('/student/dashboard', function () {
            return Inertia::render('student/Dashboard', [
                'user' => Auth::user(),
                'upcomingLesson' => null,
                'homework' => null,
            ]);
        })->name('student.dashboard');
    });


    /* Teacher account */
    Route::middleware('role:teacher')->group(function () {
        Route::get('/teacher/dashboard', function () {
            return Inertia::render('teacher/Dashboard', [
                'user' => Auth::user(),
                'upcomingLesson' => null,
                'toReview' => null,
            ]);
        })->name('teacher.dashboard');
    });

});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
