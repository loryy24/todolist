<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Crée une tâche pour une catégorie.
     */
    public function store(Request $request, $categoryId)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:1,2,3'
        ]);

        $category = Category::where('user_id', Auth::id())->findOrFail($categoryId);

        $validated['category_id'] = $category->id;
        Task::create($validated);

        return redirect()->route('categories.index')->with('success', 'Tâche ajoutée.');
    }

    /**
     * Met à jour une tâche.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:1,2,3'
        ]);

        $task = Task::findOrFail($id);
        $categoryId = $task->category_id;

        $task->update($validated);

        return redirect()->route('categories.index')->with('success', 'Tâche mise à jour.');
    }

    /**
     * Supprime une tâche.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('categories.index')->with('success', 'Tâche supprimée.');
    }
}
