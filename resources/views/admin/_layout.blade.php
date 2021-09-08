<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Admin</title>
    <!-- vendor css -->
    <link href="{{ asset('admin/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/lib/rickshaw/rickshaw.min.css') }}" rel="stylesheet">
    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/starlight.css') }}">
</head>

<body>

@include('admin.partials._sidebar')

@include('admin.partials._header')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Dashboard</span>
    </nav>

    @yield('admin')

    @include('admin.partials._footer')
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

<script src="{{ asset('admin/lib/jquery/jquery.js') }}"></script>
<script src="{{ asset('admin/lib/popper.js/popper.js') }}"></script>
<script src="{{ asset('admin/lib/bootstrap/bootstrap.js') }}"></script>
<script src="{{ asset('admin/lib/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('admin/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
<script src="{{ asset('admin/lib/jquery.sparkline.bower/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('admin/lib/d3/d3.js') }}"></script>
<script src="{{ asset('admin/lib/rickshaw/rickshaw.min.js') }}"></script>
<script src="{{ asset('admin/lib/chart.js/Chart.js') }}"></script>
<script src="{{ asset('admin/lib/Flot/jquery.flot.js') }}"></script>
<script src="{{ asset('admin/lib/Flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('admin/lib/Flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('admin/lib/flot-spline/jquery.flot.spline.js') }}"></script>

<script src="{{ asset('admin/js/starlight.js') }}"></script>
<script src="{{ asset('admin/js/ResizeSensor.js') }}"></script>
<script src="{{ asset('admin/js/dashboard.js') }}"></script>
</body>
</html>
