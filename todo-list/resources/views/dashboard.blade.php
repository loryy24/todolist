@extends('extends.base')

@section('content')
<div class="container mt-4">
    <h2>Mes catégories</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulaire ajout catégorie --}}
    <form method="POST" action="{{ route('categories.store') }}" class="mb-4">
        @csrf
        <input type="text" name="name" placeholder="Nom de la catégorie" value="{{ old('name') }}">
        <select name="color">
            <option value="">Couleur</option>
            <option value="red">Rouge</option>
            <option value="green">Vert</option>
            <option value="blue">Bleu</option>
        </select>
        <button type="submit">Ajouter</button>
        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        @error('color') <div class="text-danger">{{ $message }}</div> @enderror
    </form>

    {{-- Liste catégories --}}
    @forelse ($categories as $category)
        <div class="mb-3 p-2 border">
            <strong>{{ $category->name }}</strong> - 
            <span style="color:{{ $category->color }}">{{ ucfirst($category->color) }}</span>

            {{-- Modifier / Supprimer catégorie --}}
            <form method="POST" action="{{ route('categories.update', $category->id) }}" style="display:inline-block">
                @csrf
                @method('PUT')
                <input name="name" value="{{ $category->name }}">
                <select name="color">
                    <option value="red" @selected($category->color == 'red')>Rouge</option>
                    <option value="green" @selected($category->color == 'green')>Vert</option>
                    <option value="blue" @selected($category->color == 'blue')>Bleu</option>
                </select>
                <button type="submit">Modifier</button>
            </form>

            <form method="POST" action="{{ route('categories.destroy', $category->id) }}" style="display:inline-block">
                @csrf
                @method('DELETE')
                <input type="submit" onclick="return confirm('Supprimer ?')" value="Supprimer">
            </form>
            <a href="{{ route('tasks.index', $category->id) }}" class="btn btn-primary">Voir les tâches</a>
        </div>
    @empty
        <p>Aucune catégorie pour le moment.</p>
    @endforelse
</div>
@endsection
 
 Connexion à github.com...