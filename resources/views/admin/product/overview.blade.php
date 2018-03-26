@extends('admin.product.base')
@section('action-content')

<!-- Content Header (Page header) -->
	
	<!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-4">
	            <div class="box box-success">
	                <div class="box-header with-border">
	                    <h3 class="box-title">Biểu đồ sản phẩm đang được sử dụng và<br> không sử dụng </h3>

	                    <div class="box-tools pull-right">
	                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
	                        </button>
	                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	                    </div>
	                </div>
	                <div class="box-body">
	                    <div class="row">
	                        <div class="col-md-12">
	                            <canvas id="pieChart"></canvas>
	                        </div>
	                    </div>
	                </div>
	                <strong></strong><i class="fa fa-square" aria-hidden="true" style="color: #00a65a"></i></strong> <span style="color: #00a65a"> Đang sử dụng</span><br>
	            	<strong></strong><i class="fa fa-square" aria-hidden="true" style="color: #f39c12"></i></strong> <span style="color: #f39c12" >Không sử dụng</span>
	            </div><!-- /.box -->
	        </div>
            <div class="col-md-4">

                <div class="box box-success">
	                <div class="box-header with-border">
	                    <h3 class="box-title">Biểu đồ tình trạng sản phẩm </h3>

	                    <div class="box-tools pull-right">
	                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
	                        </button>
	                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	                    </div>
	                </div>
	                <div class="box-body">
	                    <div class="row">
	                        <div class="col-md-12">
	                            <canvas id="quantityChart"></canvas>
	                        </div>
	                    </div>
	                </div>
	                <strong></strong><i class="fa fa-square" aria-hidden="true" style="color: #00a65a"></i></strong> <span style="color: #00a65a"> Còn hàng</span><br>
	            	<strong></strong><i class="fa fa-square" aria-hidden="true" style="color: #f00"></i></strong> <span style="color: #f00">Hết hàng</span>
	            </div><!-- /.box -->

            </div>
            <div class="col-md-4">
            	
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-cubes"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Products on Stock</span>
                        <span class="info-box-number">41,410</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                            70%/100% Stock
                        </span>
                    </div>
                </div>

                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-cube"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Kind of Products</span>
                        <span class="info-box-number">2</span>

                        <span class="progress-description">
                            Number of Product's Kind
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
            	<div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sale Chart</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="barChart" style="height:230px"></canvas>
                            <div>
                                <ul id="inputData" class="list-unstyled list-inline"></ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <input type="hidden" name="pie_chart" value="{{ $pieChart }}" id="pie_chart">
        <input type="hidden" name="quantity_chart" value="{{ $quantityChart }}" id="quantity_chart">
        <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL-->
    </section>
    <script src="{{ asset('public/lib/chartJs/js/Chart.js') }}"></script>
	<!-- page script -->
@endsection