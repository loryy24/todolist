@extends('extends.base')

@section('title', 'Catégories')

@section('content')
<div class="container mt-5">
    <h2 class="text-2xl font-bold mb-4">Mes Catégories</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>🔴 {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('categories.store') }}" class="mb-4 d-flex align-items-center gap-3">
        @csrf
        <input type="text" name="name" placeholder="Nom de la catégorie" value="{{ old('name') }}" required class="form-control">
        <input type="color" name="color" value="#cccccc" class="form-control form-control-color" style="width: 3rem;">
        <button type="submit" class="btn btn-success fw-bold px-4 py-2 rounded-pill shadow-sm">
            <i class="bi bi-plus-circle"></i> Ajouter
        </button>
    </form>

    <table id="categories-table" class="table table-striped table-bordered shadow">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Couleur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr style="color:{{ $category->color }};">
                <td>{{ $category->name }}</td>
                <td>
                    <span style="display:inline-block;width:16px;height:16px;background-color:{{ $category->color }};border-radius:50%;vertical-align:middle;margin-right:4px;"></span>
                    {{ $category->color }}
                </td>
                <td>
                    {{-- Modifier --}}
                    <button onclick="openModal('edit-modal-{{ $category->id }}')" class="btn btn-sm btn-warning">✏️</button>
                    {{-- Modal édition --}}
                    <div id="edit-modal-{{ $category->id }}" class="modal hidden">
                        <div class="modal-bg" onclick="closeModal('edit-modal-{{ $category->id }}')"></div>
                        <div class="modal-content">
                            <h3 class="mb-3">Modifier la catégorie</h3>
                            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                                @csrf
                                @method('PUT')
                                <input name="name" value="{{ $category->name }}" class="form-control mb-2" required>
                                <input type="color" name="color" value="{{ $category->color ?? '#cccccc' }}" class="form-control form-control-color mb-2">
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" onclick="closeModal('edit-modal-{{ $category->id }}')" class="btn btn-secondary">Annuler</button>
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- Supprimer --}}
                    <button onclick="openModal('delete-modal-{{ $category->id }}')" class="btn btn-sm btn-danger">🗑️</button>
                    {{-- Modal suppression --}}
                    <div id="delete-modal-{{ $category->id }}" class="modal hidden">
                        <div class="modal-bg" onclick="closeModal('delete-modal-{{ $category->id }}')"></div>
                        <div class="modal-content">
                            <h3 class="mb-3 text-danger">Supprimer la catégorie</h3>
                            <p>Voulez-vous vraiment supprimer <strong>{{ $category->name }}</strong> ?</p>
                            <form method="POST" action="{{ route('categories.destroy', $category->id) }}" class="d-flex justify-content-end gap-2">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="closeModal('delete-modal-{{ $category->id }}')" class="btn btn-secondary">Annuler</button>
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                    {{-- Voir tâches --}}
                    <a href="{{ route('tasks.index', $category->id) }}" class="btn btn-sm btn-info">📋 Voir</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center text-muted">Aucune catégorie enregistrée.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>

{{-- Styles modales et pagination DataTables --}}
<style>
.modal { position: fixed; inset: 0; z-index: 1050; display: flex; align-items: center; justify-content: center; }
.modal.hidden { display: none; }
.modal-bg { position: absolute; inset: 0; background: rgba(0,0,0,0.4); }
.modal-content {
    position: relative;
    background: #fff;
    border-radius: 8px;
    padding: 2rem;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.2);
    z-index: 10;
    animation: modalIn .2s;
}
@media (max-width: 500px) {
    .modal-content {
        padding: 1rem;
        max-width: 95vw;
    }
}
/* Pagination DataTables */
.dataTables_paginate .paginate_button {
    padding: 0.5em 1em !important;
    margin: 0 0.2em;
    border-radius: 4px;
    background: #f1f1f1 !important;
    color: #007bff !important;
    border: none !important;
    font-weight: 500;
}
.dataTables_paginate .paginate_button.current {
    background: #007bff !important;
    color: #fff !important;
}
.dataTables_paginate .paginate_button:hover {
    background: #0056b3 !important;
    color: #fff !important;
}
</style>

@push('scripts')
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
    $(document).ready(function() {
        $('#categories-table').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
            },
            paging: true, // Active la pagination DataTables
            info: false
        });
    });
</script>
@endpush
@endsection