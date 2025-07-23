<!DOCTYPE html>
<html>

<head>
    <title>Task Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: none;
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .input-group-text {
            border-radius: 8px 0 0 8px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
        }
        
        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
            transform: translateY(-1px);
        }
        
        .btn-check:checked + .btn {
            transform: scale(1.05);
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }
        
        .text-primary {
            color: #667eea !important;
        }
        
        /* Custom animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .card {
            animation: fadeIn 0.5s ease-out;
        }
        
        /* Enhanced Priority Selection Styling */
        .priority-card {
            cursor: pointer;
            border: 2px solid #e2e8f0 !important;
            background: white;
            transition: all 0.3s ease;
            min-height: 140px;
        }
        
        .priority-card:hover {
            border-color: #cbd5e0 !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .priority-radio:checked + .priority-card {
            border-color: var(--bs-primary) !important;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        
        .priority-radio:checked + .priority-card.text-success,
        .priority-radio:checked + .priority-card .text-success {
            border-color: var(--bs-success) !important;
            background: linear-gradient(135deg, rgba(25, 135, 84, 0.1) 0%, rgba(25, 135, 84, 0.05) 100%);
            box-shadow: 0 10px 30px rgba(25, 135, 84, 0.3);
        }
        
        .priority-radio:checked + .priority-card.text-warning,
        .priority-radio:checked + .priority-card .text-warning {
            border-color: var(--bs-warning) !important;
            background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 193, 7, 0.05) 100%);
            box-shadow: 0 10px 30px rgba(255, 193, 7, 0.3);
        }
        
        .priority-radio:checked + .priority-card.text-danger,
        .priority-radio:checked + .priority-card .text-danger {
            border-color: var(--bs-danger) !important;
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.05) 100%);
            box-shadow: 0 10px 30px rgba(220, 53, 69, 0.3);
        }
        
        .selection-indicator {
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .priority-radio:checked + .priority-card .selection-indicator {
            opacity: 1;
            animation: checkIn 0.5s ease-out;
        }
        
        .priority-icon {
            transition: all 0.3s ease;
        }
        
        .priority-card:hover .priority-icon {
            transform: scale(1.1);
        }
        
        .priority-radio:checked + .priority-card .priority-icon {
            transform: scale(1.15);
            animation: pulse 2s infinite;
        }
        
        /* Pulse effect for high priority */
        .pulse-ring {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100px;
            height: 100px;
            border: 3px solid rgba(220, 53, 69, 0.3);
            border-radius: 50%;
            animation: pulsate 2s ease-out infinite;
            opacity: 0;
        }
        
        .priority-radio:checked + .priority-card[for*="high"] .pulse-ring {
            opacity: 1;
        }
        
        /* Animations */
        @keyframes checkIn {
            0% {
                opacity: 0;
                transform: scale(0.5) rotate(-45deg);
            }
            50% {
                opacity: 0.8;
                transform: scale(1.2) rotate(0deg);
            }
            100% {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1.15);
            }
            50% {
                transform: scale(1.25);
            }
        }
        
        @keyframes pulsate {
            0% {
                transform: translate(-50%, -50%) scale(0.8);
                opacity: 1;
            }
            100% {
                transform: translate(-50%, -50%) scale(1.5);
                opacity: 0;
            }
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .priority-card {
                min-height: 120px;
            }
            
            .priority-icon i {
                font-size: 2.5rem !important;
            }
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <h2 class="mb-4 text-primary">📝 Task Manager</h2>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @yield('content')
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
            
            // Auto-resize textarea
            const textareas = document.querySelectorAll('textarea');
            textareas.forEach(textarea => {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = this.scrollHeight + 'px';
                });
            });
            
            // Priority button interactions
            const priorityButtons = document.querySelectorAll('input[name="priority"]');
            priorityButtons.forEach(button => {
                button.addEventListener('change', function() {
                    // Add a subtle animation when priority changes
                    const label = document.querySelector(`label[for="${this.id}"]`);
                    label.style.transform = 'scale(1.1)';
                    setTimeout(() => {
                        label.style.transform = 'scale(1.05)';
                    }, 150);
                });
            });
            
            // Success message auto-hide
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }, 5000);
            });
        });
    </script>
</body>

</html>
