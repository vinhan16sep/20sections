@extends('admin.layouts.backend-template')
@section('title', 'Thương hiệu Sản Phẩm')
@section('content')
    <link rel="stylesheet" href="{{ asset('public/sass/forms.css') }}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Brand
                <small>Danh sách Brand</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">Brand</li>
            </ol>
        </section>
        @yield('action-content')
        <!-- /.content -->
    </div>
    <script src="{{ asset ("public/admin/js/branding.js") }}" type="text/javascript"></script>
@endsection
