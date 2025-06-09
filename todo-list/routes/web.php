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

Route::resource('/categories/{category}/tasks', TaskController::class);

    
});

// auteur, nom, date, description, echeance,priorite,creer categorie avec couleur, creer modifier et supprimer une tache, creer modifier et supprimer une categorie, creer modifier et supprimer un utilisateur, authentification, autorisation, middleware, validation des formulaires, gestion des erreurs, redirection, se
