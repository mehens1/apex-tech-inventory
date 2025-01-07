<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    @include('portal.layout.headMetas')
    <title>Inventory - APEX Solar & CCTV</title>
</head>

<body>
    <div class="main-wrapper">

        @include('portal.layout.topbar')
        @include('portal.layout.sidebar')

        <div class="page-wrapper">
            @yield('pageContent')
        </div>
    </div>
    @include('portal.layout.scripts')

</body>

</html>
