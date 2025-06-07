<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::middleware('auth')->group( function (){
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::resource('categories', CategoryController::class);


Route::get('/dashboard', [CategoryController::class, 'index'])->name('categories.index');

Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::post('/categories/{category}/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    
});

// auteur, nom, date, description, echeance,priorite,creer categorie avec couleur, creer modifier et supprimer une tache, creer modifier et supprimer une categorie, creer modifier et supprimer un utilisateur, authentification, autorisation, middleware, validation des formulaires, gestion des erreurs, redirection, se
