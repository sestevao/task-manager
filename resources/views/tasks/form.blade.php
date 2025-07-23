@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-7">
        <!-- Form Header -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-gradient text-white py-4" 
                 style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi {{ isset($task) ? 'bi-pencil-square' : 'bi-plus-circle' }} fs-2"></i>
                    </div>
                    <div>
                        <h3 class="mb-1 fw-bold">
                            {{ isset($task) ? 'Edit Task' : 'Create New Task' }}
                        </h3>
                        <p class="mb-0 opacity-75">
                            {{ isset($task) ? 'Update the details for this task' : 'Add a new task to your list' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 p-md-5">
                <form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" 
                      method="POST" class="needs-validation" novalidate>
                    @csrf
                    @if(isset($task))
                    @method('PUT')
                    @endif

                    @include('tasks.form-wrapper')
                </form>
            </div>
        </div>
        
        <!-- Quick Tips -->
        <div class="card border-0 bg-light mt-4">
            <div class="card-body p-3">
                <div class="d-flex align-items-start">
                    <i class="bi bi-lightbulb text-warning me-2 mt-1"></i>
                    <div>
                        <h6 class="fw-semibold mb-1">Quick Tips</h6>
                        <small class="text-muted">
                            • Use descriptive titles to easily identify tasks<br>
                            • Set priorities to focus on what matters most<br>
                            • Add due dates to stay on track with deadlines
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
