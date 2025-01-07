@extends('portal.layout.app')
@section('pageContent')
    <div class="content container-fluid">

        <div class="content container-fluid pb-0">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Dashboard</h5>
                </div>
            </div>

            <div class="super-admin-dashboard">
                <div class="row">
                    <div class="col-12 d-flex">
                        <div class="dash-user-card w-100">
                            <h4><i class="fe fe-sun"></i>{{ $salute }}, {{ $user->firstName }}
                            </h4>
                            <p>{{ $message }}</p>
                            <div class="dash-btns">
                                <a href="{{ route('products') }}" class="btn view-company-btn">View Products</a>
                                <a href="#" class="btn view-package-btn">All Packages</a>
                            </div>
                            <div class="dash-img">
                                <img src="assets/img/dashboard-card-img.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
