<div>
    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
</div>
@extends('extends.base')

@section('content')
<div class="container mt-4">
    <h2>Mes taches</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

            {{-- Liste des tâches --}}
            @if($category->tasks->count())
                <ul>
                    @foreach($category->tasks as $task)
                        <li>
                             <form method="POST" action="{{ route('tasks.update', ['category' => $category->id, 'task' => $task->id]) }}">
                                @csrf @method('PUT')
                                <input name="name" value="{{ $task->name }}">
                                <input name="description" value="{{ $task->description }}">
                                <input type="date" name="due_date" value="{{ $task->due_date }}">
                                <select name="priority">
                                    <option value="1" @selected($task->priority == 1)>Faible</option>
                                    <option value="2" @selected($task->priority == 2)>Moyenne</option>
                                    <option value="3" @selected($task->priority == 3)>Élevée</option>
                                </select>
                                <button type="submit">Enregistrer</button>
                            </form>

                            <form method="POST" action="{{ route('tasks.destroy', ['category' => $category->id, 'task' => $task->id]) }}" style="display:inline-block">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Supprimer ?')">Supprimer</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Aucune tâche.</p>
            @endif

            {{-- Ajouter une tâche --}}
            <form method="POST" action="{{ route('tasks.store', $category->id) }}">
                @csrf
                <input name="name" placeholder="Nom">
                <input name="description" placeholder="Description">
                <input type="date" name="due_date">
                <select name="priority">
                    <option value="1">Faible</option>
                    <option value="2">Moyenne</option>
                    <option value="3">Élevée</option>
                </select>
                <button type="submit">Ajouter tâche</button>
            </form>
        </div>
</div>
@endsection
