@extends('portal.layout.app')

@section('pageContent')
    <div class="content container-fluid">
        <div class="card mb-0">
            <div class="card-body">
                <div class="page-header">
                    <div class="content-page-header">
                        <h5>Edit Product</h5>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Product Title <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ old('title', $product->item) }}" placeholder="Enter Product Name">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Purchase Price <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="purchase_price"
                                            value="{{ old('purchase_price', $product->purchase_price) }}"
                                            placeholder="Enter Purchase Price">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Selling Price <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="selling_price"
                                            value="{{ old('selling_price', $product->selling_price) }}"
                                            placeholder="Enter Selling Price">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Category <span class="text-danger"> *</span></label>
                                        <select class="form-control" name="category_id">
                                            <option value="" disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Measure/Unit <span class="text-danger"> *</span></label>
                                        <select class="form-control" name="unit_id">
                                            <option value="" disabled>Select Measure/Unit</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}"
                                                    {{ $product->unit_id == $unit->id ? 'selected' : '' }}>
                                                    {{ $unit->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Quantity <span class="text-danger"> *</span></label>
                                        <input type="number" class="form-control" name="quantity"
                                            value="{{ old('quantity', $product->quantity) }}" placeholder="Enter Quantity">
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-12 description-box">
                                    <div class="input-block mb-3" id="summernote_container">
                                        <label class="form-control-label">Product Descriptions</label>
                                        <textarea class="form-control" name="description" placeholder="Type your message">{{ old('description', $product->description) }}</textarea>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Product Image</label>
                                        <input type="file" class="form-control" name="image">
                                        @if ($product->image)
                                            <img src="{{ $product->image }}" width="200" class="mt-2">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="reset" class="btn btn-secondary me-2">Cancel</button>
                                <button type="submit" class="btn btn-primary" data-submit-btn
                                    data-loading-text="Updating...">
                                    <span class="btn-text">Update Product</span>
                                    <span class="spinner spinner-border spinner-border-sm d-none"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
