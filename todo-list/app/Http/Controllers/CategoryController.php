<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Affiche la liste des catégories dans le dashboard.
     */
 public function index()
{
    $categories = Category::with('tasks')->where('user_id', Auth::id())->get();
    return view('dashboard', compact('categories'));
}


    /**
     * Stocke une nouvelle catégorie.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'color' => 'required|in:red,green,blue',
        ], [
            'name.required' => 'Le nom est requis',
            'color.required' => 'La couleur est requise',
            'color.in' => 'La couleur doit être rouge, verte ou bleue',
        ]);

        $validated['user_id'] = Auth::id();
        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Met à jour une catégorie existante.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'color' => 'required|in:red,green,blue',
        ], [
            'name.required' => 'Le nom est requis',
            'color.required' => 'La couleur est requise',
            'color.in' => 'La couleur doit être rouge, verte ou bleue',
        ]);

    $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Supprime une catégorie.
     */
    public function destroy(string $id)
    {
        $category = Category::where('user_id', Auth::id())->findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }

     public function create() {
        //
    }
    public function edit(string $id) {
        //
    }
    public function show(string $id) {
        //
    }
   
}
