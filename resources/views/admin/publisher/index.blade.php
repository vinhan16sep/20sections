
@extends('admin.publisher.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">

                <div class="box collapsed-box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm mới và tìm kiếm sản phẩm</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <form action="{{ route('publisher.index') }}" method="get">
                                @csrf
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input name="search_date" type="text" class="form-control pull-right" id="reservation" value="{{ $dateRange }}">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm ..." name="search" value="{{ $keyword }}">
                                        <span class="input-group-btn">
                                    <input type="submit" class="btn btn-block btn-primary" value="Tìm kiếm">
                                </span>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">SẢN PHẨM</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <a href="" class="btn btn-primary" role="button">Thêm sản phẩm</a>
                        <div class="table-responsive">
                            <table id="table" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Chi tiết</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($publisher)
                                    @foreach($publisher as $key => $value)
                                        <tr>
                                            <td>1</td>
                                            <td><a href="#">{{ $value['name'] }}</a></td>
                                            <td>{{ $value['email'] }}</td>
                                            <td>
                                                <button class="btn btn-default btn-sm" type="button" data-toggle="collapse" data-target="#collapse_{{ $value['id'] }}" aria-expanded="true" aria-controls="collapse_1">Xem chi tiết</button>
                                            </td>
                                            <td>
                                                <a href="#" class="dataActionDelete category-remove" data-id="{{ $value['id'] }}"><i class="fa fa-remove" aria-hidden="true"></i> </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="10">
                                                <div class="collapse" id="collapse_{{ $value['id'] }}" aria-expanded="false" style="height: 0px;">
                                                    <div class="well">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th width="30%">Người tạo</th>
                                                                <th>Ngày tạo</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>{{ $value['created_by'] }}</td>
                                                                <td>{{ $value['created_at'] }}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>Chưa có Brand</tr>
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Chi tiết</th>
                                    <th>Hành động</th>
                                </tr>
                                </tfoot>
                            </table>
                            {{ $publisher->appends(Request::get('page'))->links()}}
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL-->
    </section>
@endsection