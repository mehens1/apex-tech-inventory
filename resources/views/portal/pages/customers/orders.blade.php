@extends('portal.layout.app')
@section('pageContent')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="content-page-header">
                <h5>Customers</h5>
                <div class="list-btn">
                    <ul class="filter-list">
                        <li>
                            {{-- <a class="btn btn-primary" href="{{ route('newCustomer') }}"><i class="fa fa-plus-circle me-2"
                                    aria-hidden="true"></i>Add Customer</a> --}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Filter -->
        <div id="filter_inputs" class="card filter-card">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="input-block mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="input-block mb-3">
                            <label>Email</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="input-block mb-3">
                            <label>Phone</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Search Filter -->

        <!-- All Invoice -->
        <div class="card invoices-tabs-card">
            <div class="invoices-main-tabs">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="invoices-tabs">
                            <ul>
                                <li><a href="{{ route('customer.list') }}">Customer</a></li>
                                <li><a href="{{ route('customer.orders') }}" class="active">Orders</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /All Invoice -->

        <!-- Table -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="companies-table">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Order Reference</th>
                                            <th>Payment Mode</th>
                                            <th>Total Amount</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                            <tr style="cursor: pointer;" onclick="window.location='{{ route('customer.order', ['order' => $order->id]) }}'">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $order->first_name }}</td>
                                                <td>{{ $order->last_name }}</td>
                                                <td>{{ $order->email }}</td>
                                                <td>{{ $order->reference_number  }}</td>
                                                <td>{{ $order->payment_method }}</td>
                                                <td>₦ {{ number_format($order->total_amount, 2) }}</td>
                                                <td>{{ $order->status }}</td>
                                                <td>{{ $order->created_at }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">No orders found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
