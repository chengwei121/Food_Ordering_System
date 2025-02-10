@extends('admin.layouts.app')

@section('title', 'Admin Management')

@section('styles')
<style>
    /* Modern Color Scheme */
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --success-color: #4CAF50;
        --danger-color: #f72585;
        --info-color: #4cc9f0;
        --background-color: #f8f9fa;
        --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Card Styling */
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
    }

    /* Table Styling */
    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        color: #495057;
        font-weight: 600;
    }

    .table tbody tr {
        transition: all 0.3s ease;
        animation: fadeIn 0.5s ease-out;
    }

    .table tbody tr:hover {
        background-color: rgba(67, 97, 238, 0.05);
        transform: translateX(5px);
    }

    /* Button Styling */
    .btn {
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: var(--primary-color);
        border: none;
    }

    .btn-primary:hover {
        background-color: var(--secondary-color);
        transform: translateY(-2px);
    }

    .btn-info {
        background-color: var(--info-color);
        border: none;
        color: white;
    }

    .btn-danger {
        background-color: var(--danger-color);
        border: none;
    }

    /* Badge Styling */
    .badge {
        padding: 8px 12px;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .badge:hover {
        transform: scale(1.1);
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Alert Styling */
    .alert {
        border-radius: 10px;
        animation: slideIn 0.5s ease-out;
    }

    @keyframes slideIn {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Action Buttons */
    .action-btn {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 2px;
    }

    .action-btn i {
        font-size: 14px;
    }

    /* Loading Animation */
    .loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid var(--primary-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endsection

@section('content')
<div class="loading-overlay">
    <div class="spinner"></div>
</div>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Admin Management</h2>
        <a href="{{ route('admin.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Create New Admin
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-responsive-card">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <td data-label="ID">{{ $admin->id }}</td>
                                <td data-label="Name">{{ $admin->name }}</td>
                                <td data-label="Email">{{ $admin->email }}</td>
                                <td data-label="Status">
                                    <span class="badge {{ $admin->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $admin->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td data-label="Actions">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-info action-btn" data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger action-btn" data-bs-toggle="tooltip" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Delete confirmation with sweet alert
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f72585',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();
                    form.submit();
                }
            });
        });
    });

    // Loading overlay functions
    function showLoading() {
        document.querySelector('.loading-overlay').style.display = 'flex';
    }

    // Add loading animation for page transitions
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function() {
            if (!this.hasAttribute('data-bs-toggle')) {
                showLoading();
            }
        });
    });

    // Fade in table rows sequentially
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach((row, index) => {
        row.style.animationDelay = `${index * 0.1}s`;
    });

    // Success alert auto-dismiss
    const alertSuccess = document.querySelector('.alert-success');
    if (alertSuccess) {
        setTimeout(() => {
            alertSuccess.style.animation = 'slideOut 0.5s ease-out forwards';
            setTimeout(() => {
                alertSuccess.remove();
            }, 500);
        }, 3000);
    }
});
</script>
@endsection 