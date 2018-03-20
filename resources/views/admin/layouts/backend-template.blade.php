<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Mato Creative | @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('public/lib/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/lib/fontAwesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('public/lib/ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/lib/dist/css/AdminLTE.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('public/lib/dist/css/skins/skin-black-light.css') }}">

    <link rel="stylesheet" href="{{ asset('public/lib/dataTable/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/sass/datatable.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,900&amp;subset=latin-ext" rel="stylesheet">

    <!-- Library JS called-->
    <!-- jQuery 3 -->
    <script src="{{ asset('public/lib/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('public/lib/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- STYLE -->


<!-- SCRIPT -->
<script src="{{ asset('public/lib/dataTable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/lib/dataTable/js/dataTables.bootstrap.min.js') }}"></script>


</head>

<body class="hold-transition skin-black-light sidebar-mini">
<div class="wrapper">

    @include('admin.layouts.header')
    <!-- Left side column. contains the logo and sidebar -->

    @include('admin.layouts.sidebar')

    @yield('content')

    <!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
    </div>
    <strong>Admin Controller by <a href="http://matocreative.vn/" target="_blank">Mato Creative</a>.</strong> All rights reserved.
</footer>


</body>

<!-- fastClick -->
<script src="{{ asset('public/lib/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/lib/dist/js/adminlte.min.js') }}"></script>

</html>

