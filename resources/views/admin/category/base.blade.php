@extends('admin.layouts.backend-template')
@section('title', 'Danh Mục Sản Phẩm')
@section('content')
    <link rel="stylesheet" href="{{ asset('public/sass/forms.css') }}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh Mục
                <small>Danh sách danh mục</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#"><i class="fa fa-dashboard"></i> Products</a></li>
                <li class="active">List of Products</li>
            </ol>
        </section>
        @yield('action-content')
        <!-- /.content -->
    </div>
    <script src="{{ asset ("public/admin/js/category.js") }}" type="text/javascript"></script>
@endsection
