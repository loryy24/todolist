@extends('extends.base')

@section('title', 'Tâches')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold mb-4">Tâches de la catégorie : {{ $category->name }}</h2>

    {{-- Messages --}}
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

    {{-- Ajouter une tâche --}}
    <form method="POST" action="{{ route('tasks.store', $category->id) }}" class="mb-4 row g-2 align-items-end">
        @csrf
        <div class="col-md">
            <input name="name" placeholder="Nom" class="form-control" required>
        </div>
        <div class="col-md">
            <input name="description" placeholder="Description" class="form-control">
        </div>
        <div class="col-md">
            <input type="date" name="due_date" class="form-control">
        </div>
        <div class="col-md">
            <select name="priority" class="form-select">
                <option value="1">Faible</option>
                <option value="2">Moyenne</option>
                <option value="3">Élevée</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-success fw-bold px-4 py-2 rounded-pill shadow-sm">
                <i class="bi bi-plus-circle"></i> Ajouter
            </button>
        </div>
    </form>

    @if($category->tasks->count())
    {{-- Filtres personnalisés (côte à côte) --}}
    <div id="custom-filters" class="d-flex flex-row flex-wrap align-items-center gap-2 mb-2">
        <input type="date" id="filter-ech" class="form-control form-control-sm" placeholder="Échéance">
        <select id="filter-prio" class="form-select form-select-sm">
            <option value="">Toutes priorités</option>
            <option value="Faible">Faible</option>
            <option value="Moyenne">Moyenne</option>
            <option value="Élevée">Élevée</option>
        </select>
        <select id="filter-statut" class="form-select form-select-sm">
            <option value="">Tous statuts</option>
            <option value="en cours">En cours</option>
            <option value="terminée">Terminée</option>
        </select>
    </div>
    <div class="table-responsive">
    <table id="tasks-table" class="table table-striped table-bordered align-middle shadow">
        <thead class="table-light">
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Échéance</th>
                <th>Priorité</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($category->tasks as $task)
            @php
                $enRetard = \Carbon\Carbon::parse($task->due_date)->isPast() && $task->status !== 'terminée';
            @endphp
            <tr class="{{ $enRetard ? 'table-danger' : '' }}">
                <td>{{ $task->name }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}</td>
                <td>
                    @if($task->priority == 1) <span class="badge bg-secondary">Faible</span>
                    @elseif($task->priority == 2) <span class="badge bg-warning text-dark">Moyenne</span>
                    @else <span class="badge bg-danger">Élevée</span>
                    @endif
                </td>
                <td>
                    <form method="POST" action="{{ route('tasks.toggleStatus', ['category' => $category->id, 'task' => $task->id]) }}">
                        @csrf @method('PUT')
                        <button type="submit" class="btn btn-sm {{ $task->status === 'terminée' ? 'btn-success' : 'btn-warning' }}">
                            {{ ucfirst($task->status ?? 'en cours') }}
                        </button>
                    </form>
                </td>
                <td>
                    {{-- Modifier (modale) --}}
                    <button onclick="openModal('edit-{{ $task->id }}')" class="btn btn-sm btn-warning">✏️</button>
                    {{-- Supprimer (modale) --}}
                    <button onclick="openModal('delete-{{ $task->id }}')" class="btn btn-sm btn-danger">🗑️</button>
                </td>
            </tr>

            {{-- Modal édition --}}
            <div id="edit-{{ $task->id }}" class="modal hidden">
                <div class="modal-bg" onclick="closeModal('edit-{{ $task->id }}')"></div>
                <div class="modal-content">
                    <h3 class="mb-3">Modifier la tâche</h3>
                    <form method="POST" action="{{ route('tasks.update', ['category' => $category->id, 'task' => $task->id]) }}">
                        @csrf
                        @method('PUT')
                        <input name="name" value="{{ $task->name }}" class="form-control mb-2" required>
                        <input name="description" value="{{ $task->description }}" class="form-control mb-2">
                        <input type="date" name="due_date" value="{{ $task->due_date }}" class="form-control mb-2">
                        <select name="priority" class="form-select mb-2">
                            <option value="1" @selected($task->priority == 1)>Faible</option>
                            <option value="2" @selected($task->priority == 2)>Moyenne</option>
                            <option value="3" @selected($task->priority == 3)>Élevée</option>
                        </select>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" onclick="closeModal('edit-{{ $task->id }}')" class="btn btn-secondary">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Modal suppression --}}
            <div id="delete-{{ $task->id }}" class="modal hidden">
                <div class="modal-bg" onclick="closeModal('delete-{{ $task->id }}')"></div>
                <div class="modal-content">
                    <h3 class="mb-3 text-danger">Supprimer la tâche</h3>
                    <p>Voulez-vous vraiment supprimer <strong>{{ $task->name }}</strong> ?</p>
                    <form method="POST" action="{{ route('tasks.destroy', ['category' => $category->id, 'task' => $task->id]) }}" class="d-flex justify-content-end gap-2">
                        @csrf @method('DELETE')
                        <button type="button" onclick="closeModal('delete-{{ $task->id }}')" class="btn btn-secondary">Annuler</button>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
    </div>
    @else
        <p class="text-muted">Aucune tâche pour cette catégorie.</p>
    @endif
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
        var table = $('#tasks-table').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
            },
            order: [[2, 'asc']],
            responsive: true,
            paging: true,
            info: false,
            dom: '<"d-flex justify-content-between align-items-center mb-2"lf>tip'
        });

        // Déplacer les filtres dans la barre DataTables
        $('.dataTables_filter').before($('#custom-filters'));

        // Filtres personnalisés
        $('#filter-ech').on('change', function() {
            table.column(2).search(this.value).draw();
            console.log('Filtre échéance appliqué :', this.value);
        });
        $('#filter-prio').on('change', function() {
            table.column(3).search(this.value).draw();
        });
        $('#filter-statut').on('change', function() {
            table.column(4).search(this.value).draw();
        });
    });
</script>
@endpush
@endsection