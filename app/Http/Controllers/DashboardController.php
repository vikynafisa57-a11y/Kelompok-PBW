<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\ProgressController;

Route::view('/', 'landing')->name('landing');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/assessment', [AssessmentController::class, 'index'])
        ->name('assessment.index');

    Route::post('/assessment', [AssessmentController::class, 'store'])
        ->name('assessment.store');

    Route::get('/skills', [SkillController::class, 'index'])
        ->name('skills.index');

    Route::get('/roadmap', [RoadmapController::class, 'index'])
        ->name('roadmap.index');

    Route::get('/progress', [ProgressController::class, 'index'])
        ->name('progress.index');
});