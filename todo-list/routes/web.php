<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;

Route::middleware("guest")->group(function () {
 Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
});
Route::middleware('auth')->group( function (){
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('categories', CategoryController::class);

Route::resource('/categories/{category}/tasks', TaskController::class);
Route::put('tasks/{category}/{task}/status', [TaskController::class, 'toggleStatus'])->name('tasks.toggleStatus');

Route::get('/tasks', [TaskController::class, 'allTasks'])->name('tasks.all');
    Route::get('/profile', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    
});

// auteur, nom, date, description, echeance,priorite,creer categorie avec couleur, creer modifier et supprimer une tache, creer modifier et supprimer une categorie, creer modifier et supprimer un utilisateur, authentification, autorisation, middleware, validation des formulaires, gestion des erreurs, redirection, se
