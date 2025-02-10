@extends('admin.layouts.app')

@section('title', 'Edit Dish')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Edit Dish</h4>
                    <a href="{{ route('admin.dishes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.dishes.update', $dish) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Dish Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $dish->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="">Select Category</option>
                                <option value="appetizer" {{ old('category', $dish->category) == 'appetizer' ? 'selected' : '' }}>Appetizer</option>
                                <option value="main_course" {{ old('category', $dish->category) == 'main_course' ? 'selected' : '' }}>Main Course</option>
                                <option value="dessert" {{ old('category', $dish->category) == 'dessert' ? 'selected' : '' }}>Dessert</option>
                                <option value="beverage" {{ old('category', $dish->category) == 'beverage' ? 'selected' : '' }}>Beverage</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $dish->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price ($)</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" value="{{ old('price', $dish->price) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Dish Image</label>
                            @if($dish->image)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($dish->image) }}" alt="{{ $dish->name }}" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            @endif
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <small class="text-muted">Leave empty to keep the current image</small>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_available" name="is_available" value="1" {{ old('is_available', $dish->is_available) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_available">
                                    Available for Order
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Dish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 