<?php


use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestController;





Route::get('/', function () {
    return view('landing');
})->name('landing');
Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'show']);
Route::post('/login', [LoginController::class, 'authLogin']);


// Public Quest Board
Route::get('/quests', [QuestController::class, 'board'])->middleware('auth')->name('quests.board');

// Client Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/client/dashboard', [QuestController::class, 'clientDashboard']);
    Route::get('/client/create-quest', [QuestController::class, 'clientCreate']);
    Route::post('/client/create-quest', [QuestController::class, 'clientStore']);
});

// Hunter Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/hunter/dashboard', [QuestController::class, 'hunterDashboard']);
    Route::post('/quests/{id}/accept', [QuestController::class, 'accept']);
    Route::post('/quests/{id}/submit-proof', [QuestController::class, 'submitProof']);
});

// Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [QuestController::class, 'adminDashboard']);
    Route::post('/admin/approve-quest/{id}', [QuestController::class, 'approveQuest']);
    Route::post('/admin/reject-quest/{id}', [QuestController::class, 'rejectQuest']);
    Route::post('/admin/complete-quest/{id}', [QuestController::class, 'completeQuest']);
    Route::post('/admin/toggle-ban/{userId}', [QuestController::class, 'toggleBan']);
});