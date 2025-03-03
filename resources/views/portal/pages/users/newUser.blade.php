@extends('portal.layout.app')

@section('pageContent')
    <div class="content container-fluid">
        <div class="card mb-0">
            <div class="card-body">
                <div class="page-header">
                    <div class="content-page-header">
                        <h5>Add User</h5>
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

                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('storeUser') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>First Name <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="firstName"
                                            value="{{ old('firstName') }}" placeholder="Enter First Name">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Last Name <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="lastName"
                                            value="{{ old('lastName') }}" placeholder="Enter Last Name">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Email <span class="text-danger"> *</span></label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ old('email') }}" placeholder="Enter Email">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Phone <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ old('phone') }}" placeholder="Enter Phone Number">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Password <span class="text-danger"> *</span></label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Enter Password">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Role <span class="text-danger"> *</span></label>
                                        <select class="form-control" name="role_id">
    <option value="" disabled>Select Role</option>
    @foreach ($roles as $role)
        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
            {{ $role->name }}
        </option>
    @endforeach
</select>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="button" class="btn btn-secondary me-2"
                                    onclick="window.history.back();">Cancel</button>
                                <button type="submit" class="btn btn-primary" data-submit-btn
                                    data-loading-text="Submitting...">
                                    <span class="btn-text">Add User</span>
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
