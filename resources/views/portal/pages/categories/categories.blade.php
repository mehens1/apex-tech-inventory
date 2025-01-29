@extends('portal.layout.app')
@section('pageContent')
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="content-page-header ">
                <h5>Category </h5>
                <div class="list-btn">
                    <ul class="filter-list">
                        <li>
                            <a class="btn btn-primary" href="{{ route('newCategory') }}"><i class="fa fa-plus-circle me-2"
                                    aria-hidden="true"></i>Add Category</a>
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

        <!-- All Invoice -->
        <div class="card invoices-tabs-card">
            <div class="invoices-main-tabs">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="invoices-tabs">
                            <ul>
                                <li><a href="{{ route('products') }}">Product</a></li>
                                <li><a href="{{ route('categories') }}" class="active">Category</a></li>
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
                <div class=" card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center table-hover datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Total Products</th>
                                        <th class="no-sort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $key => $category)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="product-list-item-img">
                                                    <span>{{ $category->name }}</span>
                                                </a>
                                            </td>
                                            <td>{{ $category->products_count }}</td>
                                            <td class="d-flex align-items-center">
                                                <a class="btn-action-icon me-2" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#edit_category">
                                                    <i class="fe fe-edit"></i>
                                                </a>
                                                <a class="btn-action-icon" href="javascript:void(0);" data-bs-toggle="modal"
                                                    data-bs-target="#delete_modal">
                                                    <i class="fe fe-trash-2"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No categories available</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Table -->

    </div>
@endsection
