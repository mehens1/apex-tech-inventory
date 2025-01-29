@extends('portal.layout.app')
@section('pageContent')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="content-page-header ">
                <h5>Units </h5>
                <div class="list-btn">
                    <ul class="filter-list">
                        <li>
                            {{-- <a class="btn btn-primary" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#add_unit"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add
                                Unit</a> --}}
                            <a class="btn btn-primary" href="{{ route('newUnit') }}"><i class="fa fa-plus-circle me-2"
                                    aria-hidden="true"></i>Add Unit</a>
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
                                <li><a href="{{ route('categories') }}">Category</a></li>
                                <li><a href="{{ route('units') }}" class="active">Units</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center table-hover datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Unit Name</th>
                                        <th class="no-sort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($units as $unit)
                                        <tr>
                                            <td>{{ $unit->id }}</td>
                                            <td>{{ $unit->name }}</td>
                                            <td class="d-flex align-items-center">
                                                <a class="btn-action-icon me-2" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#edit_unit"><i
                                                        class="fe fe-edit"></i></a>
                                                <a class="btn-action-icon" href="javascript:void(0);" data-bs-toggle="modal"
                                                    data-bs-target="#delete_modal"><i class="fe fe-trash-2"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No units available</td>
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
