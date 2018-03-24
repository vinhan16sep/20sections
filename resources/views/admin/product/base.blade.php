@extends('admin.layouts.backend-template')
@section('title', 'Thương hiệu Sản Phẩm')
@section('content')
    <link rel="stylesheet" href="{{ asset('public/sass/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('public/sass/admin/overview.css') }}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sản Phẩm
                <small>Danh sách sản phẩm</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">Sản Phẩm</li>
            </ol>
        </section>
        @yield('action-content')
        <!-- /.content -->
    </div>
    <script src="{{ asset('public/lib/chartJs/js/Chart.js') }}"></script>
    <script src="{{ asset ("public/admin/js/product_chart.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("public/admin/js/product.js") }}" type="text/javascript"></script>
@endsection
