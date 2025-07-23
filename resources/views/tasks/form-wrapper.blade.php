@extends('layout')

@section('content')
<!-- Task Title Field -->
<div class="form-group mb-4">
    <label for="title" class="form-label fw-semibold text-dark mb-2">
        <i class="bi bi-pencil-square me-2"></i>Task Title
    </label>
    <div class="input-group">
        <span class="input-group-text bg-light border-end-0">
            <i class="bi bi-card-text text-muted"></i>
        </span>
        <input type="text" name="title" id="title"
            class="form-control border-start-0 @error('title') is-invalid @enderror"
            value="{{ old('title', $task->title ?? '') }}"
            placeholder="Enter a descriptive title for your task"
            required>
        @error('title')
        <div class="invalid-feedback">
            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
        </div>
        @enderror
    </div>
</div>

<!-- Task Description Field -->
<div class="form-group mb-4">
    <label for="description" class="form-label fw-semibold text-dark mb-2">
        <i class="bi bi-text-paragraph me-2"></i>Description
    </label>
    <div class="input-group">
        <span class="input-group-text bg-light border-end-0 align-items-start pt-3">
            <i class="bi bi-journal-text text-muted"></i>
        </span>
        <textarea name="description" id="description"
            class="form-control border-start-0 @error('description') is-invalid @enderror"
            placeholder="Provide detailed information about this task (optional)"
            rows="4">{{ old('description', $task->description ?? '') }}</textarea>
        @error('description')
        <div class="invalid-feedback">
            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-text text-muted mt-1">
        <i class="bi bi-info-circle me-1"></i>Add any relevant details, requirements, or notes for this task.
    </div>
</div>

<!-- Task Status Field -->
<div class="form-group mb-4">
    <label for="status" class="form-label fw-semibold text-dark mb-2">
        <i class="bi bi-flag me-2"></i>Status
    </label>
    <div class="input-group">
        <span class="input-group-text bg-light border-end-0">
            <i class="bi bi-list-task text-muted"></i>
        </span>
        <select name="status" id="status" class="form-select border-start-0 @error('status') is-invalid @enderror">
            @foreach([
            'todo' => ['label' => '📋 To Do', 'color' => 'text-primary'],
            'in_progress' => ['label' => '⚡ In Progress', 'color' => 'text-warning'],
            'done' => ['label' => '✅ Done', 'color' => 'text-success']
            ] as $value => $config)
            <option value="{{ $value }}"
                class="{{ $config['color'] }}"
                {{ old('status', $task->status ?? '') == $value ? 'selected' : '' }}>
                {{ $config['label'] }}
            </option>
            @endforeach
        </select>
        @error('status')
        <div class="invalid-feedback">
            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
        </div>
        @enderror
    </div>
</div>

<!-- Priority Field (Enhanced) -->
<div class="form-group mb-4">
    <label for="priority" class="form-label fw-semibold text-dark mb-3">
        <i class="bi bi-flag me-2"></i>Priority Level
    </label>

    <div class="priority-selection">
        <div class="row g-3">
            @foreach([
            'low' => [
            'label' => 'Low Priority',
            'icon' => 'bi-arrow-down-circle-fill',
            'color' => 'success',
            'bg' => 'bg-success-subtle',
            'description' => 'Can be done later'
            ],
            'medium' => [
            'label' => 'Medium Priority',
            'icon' => 'bi-dash-circle-fill',
            'color' => 'warning',
            'bg' => 'bg-warning-subtle',
            'description' => 'Should be done soon'
            ],
            'high' => [
            'label' => 'High Priority',
            'icon' => 'bi-arrow-up-circle-fill',
            'color' => 'danger',
            'bg' => 'bg-danger-subtle',
            'description' => 'Needs immediate attention'
            ]
            ] as $value => $config)
            <div class="col-12 col-md-4">
                <input type="radio" class="btn-check priority-radio" name="priority"
                    id="priority_{{ $value }}" value="{{ $value }}"
                    {{ old('priority', $task->priority ?? 'medium') == $value ? 'checked' : '' }}>
                <label class="priority-card w-100 h-100 d-flex flex-column align-items-center p-3 border-2 rounded-3 text-center position-relative"
                    for="priority_{{ $value }}">

                    <!-- Priority Icon -->
                    <div class="priority-icon mb-2">
                        <i class="bi {{ $config['icon'] }} fs-1 text-{{ $config['color'] }}"></i>
                    </div>

                    <!-- Priority Label -->
                    <h6 class="fw-bold mb-1 text-{{ $config['color'] }}">
                        {{ $config['label'] }}
                    </h6>

                    <!-- Priority Description -->
                    <small class="text-muted mb-0">
                        {{ $config['description'] }}
                    </small>

                    <!-- Selection Indicator -->
                    <div class="selection-indicator position-absolute top-0 end-0 m-2">
                        <i class="bi bi-check-circle-fill text-{{ $config['color'] }} fs-5"></i>
                    </div>

                    <!-- Pulse Effect for High Priority -->
                    @if($value === 'high')
                    <div class="pulse-ring"></div>
                    @endif
                </label>
            </div>
            @endforeach
        </div>
    </div>

    @error('priority')
    <div class="invalid-feedback d-block mt-2">
        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
    </div>
    @enderror
</div>

<!-- Due Date Field (New Addition) -->
<div class="form-group mb-4">
    <label for="due_date" class="form-label fw-semibold text-dark mb-2">
        <i class="bi bi-calendar-event me-2"></i>Due Date
    </label>
    <div class="input-group">
        <span class="input-group-text bg-light border-end-0">
            <i class="bi bi-calendar3 text-muted"></i>
        </span>
        <input type="datetime-local" name="due_date" id="due_date"
            class="form-control border-start-0 @error('due_date') is-invalid @enderror"
            value="{{ old('due_date', isset($task->due_date) ? $task->due_date->format('Y-m-d\TH:i') : '') }}">
        @error('due_date')
        <div class="invalid-feedback">
            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-text text-muted mt-1">
        <i class="bi bi-info-circle me-1"></i>Optional: Set a deadline for this task.
    </div>
</div>

<!-- Action Buttons -->
<div class="d-flex gap-3 mt-5 pt-3 border-top">
    <button type="submit" class="btn btn-primary btn-lg flex-grow-1 py-3">
        <i class="bi bi-check-circle me-2"></i>
        {{ isset($task) ? 'Update Task' : 'Create Task' }}
    </button>
    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary btn-lg flex-grow-1 py-3">
        <i class="bi bi-arrow-left me-2"></i>
        Cancel
    </a>
</div>
@endsection