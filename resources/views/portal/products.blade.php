@extends('portal.layout.app')
@section('pageContent')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="content-page-header">
                <h5>Products</h5>
                <div class="list-btn">
                    <ul class="filter-list">
                        <li>
                            <a class="btn btn-primary" href="{{ route('newProduct') }}"><i class="fa fa-plus-circle me-2"
                                    aria-hidden="true"></i>Add Product</a>
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
                                <li><a href="{{ route('products') }}" class="active">Product</a></li>
                                <li><a href="{{ route('categories') }}">Category</a></li>
                                <li><a href="{{ route('units') }}">Units</a></li>
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
                                            <th>Item</th>
                                            <th>Category</th>
                                            <th>Units</th>
                                            <th>Quantity</th>
                                            <th>Selling Price</th>
                                            <th>Purchase Price</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($products as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        {{-- <a href="#" class="avatar avatar-md me-2 companies">
                                                            <img class="avatar-img sales-rep"
                                                                src="assets/img/sales-return8.svg" alt="Product Image">
                                                        </a> --}}
                                                        <a href="#">{{ $product->item }}</a>
                                                    </h2>
                                                </td>
                                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                                <td>{{ $product->unit->name ?? 'N/A' }}</td>
                                                <td>{{ $product->quantity }}</td>
                                                <td>₦ {{ number_format($product->selling_price, 2) }}</td>
                                                <td>₦ {{ number_format($product->purchase_price, 2) }}</td>
                                                <td class="d-flex align-items-center">
                                                    <a class="btn-action-icon me-2" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#edit_unit"><i
                                                            class="fe fe-edit"></i></a>
                                                    {{-- <a class="btn-action-icon" href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete_modal"><i class="fe fe-trash-2"></i></a> --}}
                                                </td>
                                                {{-- <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="btn-action-icon" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul>
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('products.edit', $product->id) }}">
                                                                        <i class="far fa-edit me-2"></i>Edit
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal_{{ $product->id }}">
                                                                        <i class="far fa-trash-alt me-2"></i>Delete
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td> --}}
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">No products found.</td>
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
        <!-- /Table -->
    </div>
@endsection
