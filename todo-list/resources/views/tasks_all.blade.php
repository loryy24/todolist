{{-- filepath: /home/lory/todolist/todo-list/resources/views/tasks_all.blade.php --}}
@extends('extends.base')
@section('title', 'Toutes les tâches')
@section('content')
<div class="container mt-5">
    <h2 class="fw-bold mb-4">Toutes mes tâches</h2>
    <div class="table-responsive">
        <table id="all-tasks-table" class="table table-striped table-bordered align-middle shadow">
            <thead>
                <tr>
                    <th>Catégorie</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Échéance</th>
                    <th>Priorité</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->category->name ?? '-' }}</td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</td>
                    <td>
                        @if($task->priority == 1) <span class="badge bg-secondary">Faible</span>
                        @elseif($task->priority == 2) <span class="badge bg-warning text-dark">Moyenne</span>
                        @else <span class="badge bg-danger">Élevée</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $task->status === 'terminée' ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ ucfirst($task->status ?? 'en cours') }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@push('scripts')
<script>
$(document).ready(function() {
    $('#all-tasks-table').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        order: [[3, 'asc']],
        responsive: true,
        paging: true,
        info: false
    });
});
</script>
@endpush
@endsection