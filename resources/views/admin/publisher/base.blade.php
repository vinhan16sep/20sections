@extends('admin.layouts.backend-template')
@section('title', 'Publisher')
@section('content')
    <link rel="stylesheet" href="{{ asset('public/sass/forms.css') }}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Publisher
                <small>Danh sách Publisher</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">Publisher</li>
            </ol>
        </section>
    @yield('action-content')
    <!-- /.content -->
    </div>
    <script src="{{ asset ("public/bower_components/moment/min/moment.min.js") }}"></script>
    <script src="{{ asset ("public/bower_components/bootstrap-daterangepicker/daterangepicker.js") }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset ("public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js") }}"></script>

    <script>
        $('#reservation').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear',
                format: 'DD-MM-YYYY'
            }
        });

        $('#reservation').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
        });

        $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    </script>

@endsection
