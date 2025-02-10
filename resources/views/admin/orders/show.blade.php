<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details #{{ $order->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Order #{{ $order->id }} Details</h4>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>Order Information</h5>
                                <p><strong>Table:</strong> #{{ $order->table_id }}</p>
                                <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>
                                <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Status</h5>
                                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select mb-2" onchange="this.form.submit()">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>Preparing</option>
                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                                <p class="text-muted">Last Updated: {{ $order->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>

                        <h5>Order Items</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($item->dish->image)
                                                        <img src="{{ Storage::url($item->dish->image) }}" alt="{{ $item->dish->name }}" class="me-2" style="width: 50px; height: 50px; object-fit: cover;">
                                                    @endif
                                                    <div>
                                                        <strong>{{ $item->dish->name }}</strong>
                                                        <br>
                                                        <small class="text-muted">{{ $item->dish->category }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                        <td><strong>${{ number_format($order->total_amount, 2) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        @if($order->notes)
                            <div class="mt-4">
                                <h5>Order Notes</h5>
                                <div class="alert alert-info">
                                    {{ $order->notes }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Order Timeline</h5>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6>Order Placed</h6>
                                    <p class="text-muted">{{ $order->created_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                            @if($order->status !== 'pending')
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-info"></div>
                                    <div class="timeline-content">
                                        <h6>Preparing</h6>
                                        <p class="text-muted">Order is being prepared</p>
                                    </div>
                                </div>
                            @endif
                            @if($order->status === 'completed')
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <h6>Completed</h6>
                                        <p class="text-muted">Order has been served</p>
                                    </div>
                                </div>
                            @endif
                            @if($order->status === 'cancelled')
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-danger"></div>
                                    <div class="timeline-content">
                                        <h6>Cancelled</h6>
                                        <p class="text-muted">Order was cancelled</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .timeline {
            position: relative;
            padding: 20px 0;
        }
        .timeline-item {
            position: relative;
            padding-left: 40px;
            margin-bottom: 20px;
        }
        .timeline-marker {
            position: absolute;
            left: 0;
            top: 0;
            width: 15px;
            height: 15px;
            border-radius: 50%;
        }
        .timeline-content {
            padding-bottom: 20px;
            border-bottom: 1px dashed #dee2e6;
        }
    </style>
</body>
</html> 