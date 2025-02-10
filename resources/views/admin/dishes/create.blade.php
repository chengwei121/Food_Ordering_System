<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Dish</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Create New Dish</h4>
                        <a href="{{ route('admin.dishes.index') }}" class="btn btn-secondary">Back to List</a>
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

                        <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Dish Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="appetizer" {{ old('category') == 'appetizer' ? 'selected' : '' }}>Appetizer</option>
                                    <option value="main_course" {{ old('category') == 'main_course' ? 'selected' : '' }}>Main Course</option>
                                    <option value="dessert" {{ old('category') == 'dessert' ? 'selected' : '' }}>Dessert</option>
                                    <option value="beverage" {{ old('category') == 'beverage' ? 'selected' : '' }}>Beverage</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" value="{{ old('price') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Dish Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <small class="text-muted">Recommended size: 800x600 pixels</small>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_available" name="is_available" value="1" {{ old('is_available', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_available">
                                        Available for Order
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Dish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 