@extends('admin.category.base')
@section('action-content')
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">DANH MỤC SẢN PHẨM</h3>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('category.create') }}" class="btn btn-primary" role="button">Thêm Danh Mục</a>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('category.index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Tìm kiếm ..." name="search" value="{{ $keyword }}">
                                    <span class="input-group-btn">
                                        <input type="submit" class="btn btn-block btn-primary" value="Tìm kiếm">
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tiêu đề</th>
                                <th>Slug</th>
                                <th>Trạng thái</th>
                                <th>Chi tiết</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($category)
                            <?php $i=1; ?>
                            @foreach($category as $value)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td><a href="{{ route('category.show', ['id' => $value->id]) }}">{{ $value->name }}</a></td>
                                    <td>{{ $value->slug }}</td>
                                    <td class="active_{{ $value->id }}">
                                        @if($value->is_activated == 0)
                                        <span class="label label-success category-active" data-id="{{ $value->id }}" >Active</span>
                                        @else()
                                        <span class="label label-warning category-active" data-id="{{ $value->id }}" >Deactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-default btn-sm" type="button" data-toggle="collapse" data-target="#collapse_{{ $value->id }}" aria-expanded="false" aria-controls="collapse_1">Xem chi tiết</button>
                                    </td>
                                    <td>
                                        <a href="{{ route('category.edit', ['id' => $value->id]) }}" id="dataActionEdit"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                        <a href="#" class="dataActionDelete category-remove" data-id="{{ $value->id }}" data-csrf="{!! csrf_token() !!}" ><i class="fa fa-remove" aria-hidden="true"></i> </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="10">
                                        <div class="collapse" id="collapse_{{ $value->id }}">
                                            <div class="well">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th width="30%">Hình ảnh</th>
                                                            <th>Giới thiệu</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><img src="{{ asset('storage/app/category/'.$value->image) }}" width="250px"></td>
                                                            <td>{{ $value->description }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @else()
                                <tr>
                                    <td>Chưa có Danh Mục sản phẩm</td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Tiêu đề</th>
                                <th>Slug</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </tfoot>
                        </table>
                        {{ $category->appends(Request::get('page'))->links()}}
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