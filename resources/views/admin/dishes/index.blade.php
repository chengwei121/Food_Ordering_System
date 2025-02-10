@extends('admin.layouts.app')

@section('title', 'Manage Dishes')

@section('styles')
<style>
/* Modern Fresh Theme with Glassmorphism */
:root {
    /* Base Colors */
    --bg-primary: #eef2ff;
    --bg-secondary: #ffffff;
    --bg-tertiary: #f5f7ff;
    
    /* Accent Colors */
    --accent-primary: #6366f1;
    --accent-secondary: #818cf8;
    --accent-hover: #4f46e5;
    
    /* Text Colors */
    --text-primary: #1e1b4b;
    --text-secondary: #4338ca;
    --text-muted: #6366f1;
    
    /* Status Colors */
    --success: #059669;
    --success-light: #10b981;
    --danger: #dc2626;
    --danger-light: #ef4444;
    --warning: #d97706;
    
    /* Glass Effects */
    --glass-bg: rgba(255, 255, 255, 0.95);
    --glass-border: rgba(99, 102, 241, 0.15);
    --glass-highlight: rgba(99, 102, 241, 0.1);
    
    /* Shadows */
    --shadow-sm: 0 2px 4px rgba(99, 102, 241, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(99, 102, 241, 0.1);
    --shadow-lg: 0 8px 24px rgba(99, 102, 241, 0.15);
    --shadow-glow: 0 0 15px rgba(99, 102, 241, 0.4);
    
    /* Card Effects */
    --card-bg: rgba(255, 255, 255, 1);
    --card-hover-bg: rgba(255, 255, 255, 1);
    --card-border: rgba(99, 102, 241, 0.15);
    
    /* Status Badges */
    --badge-success-bg: rgba(5, 150, 105, 0.1);
    --badge-success-border: rgba(5, 150, 105, 0.2);
    --badge-danger-bg: rgba(220, 38, 38, 0.1);
    --badge-danger-border: rgba(220, 38, 38, 0.2);
}

.dashboard-container {
    display: flex;
    min-height: calc(100vh - var(--header-height) - var(--footer-height));
    background: var(--bg-primary);
    margin-top: calc(-1 * var(--header-height));
    padding-top: var(--header-height);
}

/* Sidebar Navigation */
.side-nav {
    width: var(--sidebar-width);
    background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
    border-right: 1px solid var(--glass-border);
    padding: 2rem 1.5rem;
    position: fixed;
    height: 100%;
    display: flex;
    flex-direction: column;
    gap: 3rem;
    z-index: 1020;
    box-shadow: var(--shadow-md);
}

/* Main Content Area */
.main-content {
    flex: 1;
    margin-left: var(--sidebar-width);
    padding: 2rem;
    background: var(--bg-primary);
    min-height: 100%;
}

/* Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
}

body {
    background: var(--bg-primary);
    color: var(--text-primary);
    min-height: 100vh;
}

.dashboard {
    display: flex;
    min-height: 100vh;
}

.brand {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.5rem;
}

.brand i {
    font-size: 1.8rem;
    color: white;
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.4);
}

.brand h2 {
    color: white;
    font-weight: 600;
}

.nav-links {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.nav-link:hover {
    background: rgba(255, 255, 255, 0.1);
    color: white;
}

.nav-link.active {
    background: white;
    color: var(--accent-primary);
}

.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.page-info h1 {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: var(--shadow-sm);
    color: var(--text-primary);
    font-weight: 700;
}

.page-info p {
    color: var(--text-secondary);
}

.actions {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.search-wrapper {
    position: relative;
    background: var(--bg-secondary);
    backdrop-filter: blur(8px);
    border: 1px solid var(--glass-border);
    border-radius: 12px;
    padding: 0.5rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    width: 300px;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-sm);
}

.search-wrapper:focus-within {
    border-color: var(--accent-primary);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
}

.search-wrapper i {
    color: var(--text-muted);
}

.search-wrapper input {
    background: transparent;
    border: none;
    color: var(--text-primary);
    width: 100%;
    outline: none;
}

.search-wrapper input::placeholder {
    color: var(--text-muted);
}

.btn-new {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    box-shadow: var(--shadow-md);
}

.btn-new:hover {
    background: var(--accent-hover);
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

/* Category Filters */
.category-filters {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.filter-chip {
    background: white;
    backdrop-filter: blur(8px);
    border: 1px solid var(--glass-border);
    border-radius: 12px;
    padding: 0.75rem 1.25rem;
    color: var(--text-secondary);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
    box-shadow: var(--shadow-sm);
}

.filter-chip:hover {
    background: var(--glass-highlight);
    border-color: var(--accent-primary);
    color: var(--accent-primary);
}

.filter-chip.active {
    background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
    color: white;
    border: none;
}

/* Menu Grid */
.menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
}

.menu-card {
    background: white;
    backdrop-filter: blur(8px);
    border: 1px solid var(--glass-border);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    animation: fadeIn 0.5s ease;
    box-shadow: var(--shadow-md);
}

.menu-card:hover {
    border-color: var(--accent-primary);
    box-shadow: var(--shadow-lg);
}

.card-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.menu-card:hover .card-image img {
    transform: scale(1.05);
}

.card-actions {
    position: absolute;
    top: 1rem;
    right: 1rem;
    display: flex;
    gap: 0.5rem;
    opacity: 0;
    transform: translateY(-10px);
    transition: all 0.3s ease;
}

.menu-card:hover .card-actions {
    opacity: 1;
    transform: translateY(0);
}

.card-btn {
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-sm);
}

.card-btn:hover {
    background: white;
}

.card-btn.edit:hover {
    background: var(--accent-primary);
    color: white;
}

.card-btn.delete:hover {
    background: var(--danger);
    color: white;
}

.status-badge {
    position: absolute;
    bottom: 1rem;
    left: 1rem;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.8125rem;
    font-weight: 600;
    backdrop-filter: blur(8px);
    box-shadow: var(--shadow-sm);
}

.status-badge.available {
    background: var(--badge-success-bg);
    color: var(--success);
    border: 1px solid var(--badge-success-border);
}

.status-badge.unavailable {
    background: var(--badge-danger-bg);
    color: var(--danger);
    border: 1px solid var(--badge-danger-border);
}

.card-content {
    padding: 1.5rem;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.card-header h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
}

.price {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--accent-primary);
    text-shadow: 0 0 10px rgba(79, 70, 229, 0.2);
}

.card-meta {
    display: flex;
    gap: 0.75rem;
}

.category-tag {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
}

.category-tag i {
    color: var(--accent-primary);
}

/* Alert Styles */
.alert {
    background: var(--badge-success-bg);
    backdrop-filter: blur(8px);
    border: 1px solid var(--badge-success-border);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    animation: fadeIn 0.5s ease;
    box-shadow: var(--shadow-md);
}

.alert i {
    color: var(--success);
    font-size: 1.25rem;
    text-shadow: 0 0 10px rgba(16, 185, 129, 0.4);
}

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

/* Responsive Design */
@media (max-width: 991.98px) {
    .side-nav {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        box-shadow: var(--shadow-lg);
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
    }

    .side-nav.show {
        transform: translateX(0);
        box-shadow: var(--shadow-lg);
    }

    .main-content {
        margin-left: 0;
    }
}

@media (max-width: 768px) {
    .top-bar {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .actions {
        flex-direction: column;
    }
    
    .search-wrapper {
        width: 100%;
    }
    
    .menu-grid {
        gap: 1.5rem;
    }
    
    .card-image {
        height: 180px;
    }
}

@media (max-width: 640px) {
    .main-content {
        padding: 1rem;
    }
    
    .menu-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .card-image {
        height: 160px;
    }
    
    .menu-card:hover {
        transform: none;
    }
}
</style>
@endsection

@section('content')
<div class="dashboard-container">
    <nav class="side-nav">
        <div class="brand">
            <i class="fas fa-utensils"></i>
            <h2>FoodAdmin</h2>
        </div>
        <div class="nav-links">
            <a href="{{ route('admin.dishes.index') }}" class="nav-link active">
                <i class="fas fa-hamburger"></i>
                <span>Menu Items</span>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="nav-link">
                <i class="fas fa-shopping-bag"></i>
                <span>Orders</span>
            </a>
            <a href="{{ route('admin.kitchen') }}" class="nav-link">
                <i class="fas fa-tv"></i>
                <span>Kitchen View</span>
            </a>
        </div>
    </nav>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-info">
                <h1>Menu Items</h1>
                <p>{{ count($dishes) }} items listed</p>
            </div>
            <div class="actions">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchDishes" placeholder="Search menu items...">
                </div>
                <a href="{{ route('admin.dishes.create') }}" class="btn-new">
                    <span>New Item</span>
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert">
                <i class="fas fa-check-circle"></i>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="category-filters">
            <button class="filter-chip active" data-filter="all">
                <i class="fas fa-border-all"></i>All Items
            </button>
            <button class="filter-chip" data-filter="main">
                <i class="fas fa-utensils"></i>Main Course
            </button>
            <button class="filter-chip" data-filter="appetizer">
                <i class="fas fa-cheese"></i>Appetizers
            </button>
            <button class="filter-chip" data-filter="dessert">
                <i class="fas fa-ice-cream"></i>Desserts
            </button>
            <button class="filter-chip" data-filter="beverage">
                <i class="fas fa-glass-martini-alt"></i>Beverages
            </button>
        </div>

        <div class="menu-grid">
            @foreach($dishes as $dish)
                <div class="menu-card" data-category="{{ strtolower($dish->category) }}">
                    <div class="card-image">
                        @if($dish->image)
                            <img src="{{ Storage::url($dish->image) }}" alt="{{ $dish->name }}">
                        @endif
                        <div class="card-actions">
                            <a href="{{ route('admin.dishes.edit', $dish) }}" class="card-btn edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.dishes.destroy', $dish) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="card-btn delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                        <div class="status-badge {{ $dish->is_available ? 'available' : 'unavailable' }}">
                            {{ $dish->is_available ? 'Available' : 'Sold Out' }}
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-header">
                            <h3>{{ $dish->name }}</h3>
                            <div class="price">${{ number_format($dish->price, 2) }}</div>
                        </div>
                        <div class="card-meta">
                            <span class="category-tag">
                                @switch($dish->category)
                                    @case('Main_course')
                                        <i class="fas fa-utensils"></i>
                                        @break
                                    @case('Appetizer')
                                        <i class="fas fa-cheese"></i>
                                        @break
                                    @case('Dessert')
                                        <i class="fas fa-ice-cream"></i>
                                        @break
                                    @case('Beverage')
                                        <i class="fas fa-glass-martini-alt"></i>
                                        @break
                                    @default
                                        <i class="fas fa-hamburger"></i>
                                @endswitch
                                {{ str_replace('_', ' ', $dish->category) }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchDishes');
    const menuCards = document.querySelectorAll('.menu-card');
    const filterChips = document.querySelectorAll('.filter-chip');
    let currentFilter = 'all';

    // Search functionality
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        filterDishes(searchTerm, currentFilter);
    });

    // Category filter functionality
    filterChips.forEach(chip => {
        chip.addEventListener('click', function() {
            const filter = this.dataset.filter;
            currentFilter = filter;
            
            // Update active state
            filterChips.forEach(c => c.classList.remove('active'));
            this.classList.add('active');

            // Filter dishes
            filterDishes(searchInput.value.toLowerCase(), filter);
        });
    });

    function filterDishes(searchTerm, category) {
        menuCards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const cardCategory = card.dataset.category;
            const matchesSearch = title.includes(searchTerm);
            const matchesCategory = category === 'all' || cardCategory === category;

            if (matchesSearch && matchesCategory) {
                card.style.display = 'block';
                card.style.animation = 'fadeIn 0.5s ease';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Delete confirmation
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this dish?')) {
                this.submit();
            }
        });
    });

    // Add sidebar toggle functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sideNav = document.querySelector('.side-nav');
    
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sideNav.classList.toggle('show');
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 991.98) {
            if (!sideNav.contains(e.target) && !sidebarToggle.contains(e.target)) {
                sideNav.classList.remove('show');
            }
        }
    });
});
</script>
@endpush 