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
    {{--<script src="{{ asset ("public/admin/js/branding.js") }}" type="text/javascript"></script>--}}
    {{--<script src="{{ asset ("public/bower_components/bootstrap-daterangepicker/daterangepicker.js") }}"></script>--}}
    <script src="http://localhost/20sections/public/bower_components/moment/min/moment.min.js"></script>
    <script src="http://localhost/20sections/public/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="http://localhost/20sections/public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>




    <script>
        $('#reservation').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('#reservation').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    </script>
@endsection
