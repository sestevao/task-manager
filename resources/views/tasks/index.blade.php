@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Your Tasks</h4>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ New Task</a>
</div>

<div class="card p-3">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>
                    @php
                    $badge = [
                    'todo' => 'secondary',
                    'in_progress' => 'warning',
                    'done' => 'success',
                    ][$task->status];
                    @endphp
                    <span class="badge bg-{{ $badge }}">
                        {{ ucwords(str_replace('_', ' ', $task->status)) }}
                    </span>
                </td>
                <td class="text-end">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this task?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-muted">No tasks yet. Click "New Task" to create one.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection