@extends('portal.layout.app')
@section('pageContent')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="content-page-header">
                <h5>Order Details</h5>
                <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Order Details -->
        <div class="card">
            <div class="card-body">
                <h5>Order Reference: {{ $order->reference_number }}</h5>
                <p>Customer: {{ $order->first_name }} {{ $order->last_name }}</p>
                <p>Email: {{ $order->email }}</p>
                <p>Payment Mode: {{ $order->payment_method }}</p>
                <p>Total Amount: ₦ {{ number_format($order->total_amount, 2) }}</p>
                <p>Status: {{ $order->status }}</p>
                <p>Created At: {{ $order->created_at }}</p>
            </div>
        </div>
        <!-- /Order Details -->

        <!-- Order Items -->
        <div class="card mt-4">
            <div class="card-body">
                <h5>Order Items</h5>
                <div class="table-responsive">
                    <table class="table table-center table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orderItems as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['product']->item }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No items found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /Order Items -->
    </div>
@endsection
