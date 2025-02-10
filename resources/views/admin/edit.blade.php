@extends('admin.layouts.app')

@section('title', 'Edit Admin')

@section('content')
<div class="page-header d-flex align-items-center mb-4 animate__animated animate__fadeInDown">
    <h2 class="me-3 mb-0">Edit Admin</h2>
    <a href="{{ route('admin.index') }}" class="btn btn-secondary animate__animated animate__fadeIn animate__delay-1s">
        <i class="fas fa-arrow-left me-2"></i>Back to List
    </a>
</div>

@if ($errors->any())
    <div class="alert alert-danger mb-4 animate__animated animate__shakeX">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="edit-form-container animate__animated animate__fadeIn animate__delay-1s">
    <form action="{{ route('admin.update', $admin->id) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        
        <div class="form-group mb-4 input-animate">
            <label class="form-label">
                <i class="fas fa-user me-2"></i>Admin Name
            </label>
            <input type="text" 
                class="form-control form-control-lg" 
                id="name" 
                name="name" 
                value="{{ old('name', $admin->name) }}" 
                required
                placeholder="Enter admin name">
            <div class="invalid-feedback">Please provide a name.</div>
        </div>

        <div class="form-group mb-4 input-animate">
            <label class="form-label">
                <i class="fas fa-envelope me-2"></i>Email
            </label>
            <input type="email" 
                class="form-control form-control-lg" 
                id="email" 
                name="email" 
                value="{{ old('email', $admin->email) }}" 
                required
                placeholder="Enter email address">
            <div class="invalid-feedback">Please provide a valid email.</div>
        </div>

        <div class="form-group mb-4 input-animate">
            <label class="form-label">
                <i class="fas fa-toggle-on me-2"></i>Status
            </label>
            <select class="form-select form-select-lg" id="status" name="status">
                <option value="1" {{ $admin->status ? 'selected' : '' }}>
                    <i class="fas fa-check-circle text-success"></i> Active
                </option>
                <option value="0" {{ !$admin->status ? 'selected' : '' }}>
                    <i class="fas fa-times-circle text-danger"></i> Inactive
                </option>
            </select>
        </div>

        <div class="form-actions d-flex justify-content-between align-items-center mt-5">
            <button type="button" class="btn btn-light btn-lg px-4" onclick="history.back()">
                <i class="fas fa-times me-2"></i>Cancel
            </button>
            <button type="submit" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-save me-2"></i>Update Admin
                <span class="btn-loader spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
        </div>
    </form>
</div>

<style>
/* Modern Color Scheme */
:root {
    --primary-gradient: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    --hover-gradient: linear-gradient(135deg, #224abe 0%, #1a3a94 100%);
    --input-bg: #f8fafc;
    --input-border: #e2e8f0;
    --input-focus: #4e73df;
    --label-color: #4a5568;
    --text-primary: #2d3748;
    --animation-timing: 0.3s;
}

/* Container Styles */
.edit-form-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    transition: transform var(--animation-timing);
}

.edit-form-container:hover {
    transform: translateY(-5px);
}

/* Form Controls */
.form-control, .form-select {
    background-color: var(--input-bg);
    border: 2px solid var(--input-border);
    border-radius: 10px;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all var(--animation-timing);
}

.form-control:focus, .form-select:focus {
    border-color: var(--input-focus);
    box-shadow: 0 0 0 4px rgba(78, 115, 223, 0.1);
    background-color: white;
}

/* Labels */
.form-label {
    color: var(--label-color);
    font-weight: 600;
    font-size: 0.95rem;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    transition: color var(--animation-timing);
}

.form-group:focus-within .form-label {
    color: var(--input-focus);
}

/* Buttons */
.btn {
    border-radius: 10px;
    font-weight: 600;
    transition: all var(--animation-timing);
}

.btn-primary {
    background: var(--primary-gradient);
    border: none;
    position: relative;
    overflow: hidden;
}

.btn-primary:hover {
    background: var(--hover-gradient);
    transform: translateY(-2px);
}

.btn-primary:active {
    transform: translateY(0);
}

.btn-light {
    background: white;
    border: 2px solid var(--input-border);
}

.btn-light:hover {
    background: var(--input-bg);
    border-color: #cbd5e0;
}

/* Input Animation */
.input-animate {
    position: relative;
    transform-origin: top left;
    animation: slideIn var(--animation-timing) ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Loading State */
.btn-loader {
    margin-left: 0.5rem;
}

.btn[disabled] {
    opacity: 0.7;
    cursor: not-allowed;
}

/* Hover Effects */
.form-control:hover, .form-select:hover {
    border-color: #cbd5e0;
}

/* Page Header */
.page-header h2 {
    color: var(--text-primary);
    font-weight: 700;
    font-size: 1.8rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .edit-form-container {
        padding: 1.5rem;
    }
    
    .form-actions {
        flex-direction: column-reverse;
        gap: 1rem;
    }
    
    .btn {
        width: 100%;
    }
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation and animation
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('.form-control, .form-select');
    
    // Add animation delay to form groups
    inputs.forEach((input, index) => {
        input.closest('.form-group').style.animationDelay = `${(index + 2) * 0.1}s`;
    });

    // Form submission handling
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            
            // Shake animation for invalid fields
            const invalidInputs = form.querySelectorAll(':invalid');
            invalidInputs.forEach(input => {
                input.closest('.form-group').classList.add('animate__animated', 'animate__shakeX');
                setTimeout(() => {
                    input.closest('.form-group').classList.remove('animate__animated', 'animate__shakeX');
                }, 1000);
            });
        } else {
            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            const spinner = submitBtn.querySelector('.btn-loader');
            submitBtn.disabled = true;
            spinner.classList.remove('d-none');
            submitBtn.querySelector('i').classList.add('d-none');
        }
        
        form.classList.add('was-validated');
    });

    // Input focus effects
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.closest('.form-group').classList.add('focused');
        });
        
        input.addEventListener('blur', () => {
            input.closest('.form-group').classList.remove('focused');
        });
    });

    // Hover animation for form container
    const formContainer = document.querySelector('.edit-form-container');
    formContainer.addEventListener('mousemove', (e) => {
        const rect = formContainer.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        formContainer.style.background = `radial-gradient(circle at ${x}px ${y}px, #ffffff, #f8fafc)`;
    });
    
    formContainer.addEventListener('mouseleave', () => {
        formContainer.style.background = 'white';
    });
});
</script>
@endpush
@endsection 