@extends('admin.product.base')
@section('action-content')

<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-9">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Thêm mới sản phẩm</h3>
                </div>
                <!-- /.box-header -->
                <form action="{{ route('product.store') }}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf
                    <div class="box-body">

                        <div class="col-md-12">
                            <h4 class="box-title">Thông tin cơ bản</h4>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="products_name">Tên sản phẩm</label>
                            <input type="text" name="name" value="" class="form-control" id="products_name">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6"> <!-- Split the columns due to numbers of level of Category -->
                            <label for="products_category">Danh mục sản phẩm</label>
                            <select name="category_id" class="form-control" id="products_category">
                                @if($category)
                                <option value="">Chọn danh mục</option>
                                    @foreach($category as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                @else:
                                <option value="">Danh mục hiện dang trống</option>
                                @endif
                            </select>
                            @if ($errors->has('category_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6"> <!-- Split the columns due to numbers of level of Category -->
                            <label for="products_branding">Thương hiệu sản phẩm</label>
                            <select name="branding_id" class="form-control" id="products_branding">
                                <option value="">Chon danh mục trước</option>
                            </select>
                            @if ($errors->has('branding_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('branding_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="products_quantity">Số lượng</label>
                            <input type="text" name="quantity" value="" class="form-control" id="products_quantity">
                            @if ($errors->has('quantity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="products_price">Giá</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar" aria-hidden="true"></i> VND </span>
                                <input type="text" name="price" value="" class="form-control" id="products_price">
                                
                            </div>
                            @if ($errors->has('price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-12">
                            <label for="products_image">Hình ảnh</label>
                            <input type="file" id="products_image" name="image[]" required multiple>
                            <p class="help-block">Click để upload. Hình ảnh đầu tiên sẽ được sử dụng làm avata cho sản phẩm</p>
                            @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-12">
                            <label for="products_description">Giới thiệu</label>
                            <textarea class="form-control box_content" id="products_description" name="description"></textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-12">
                            <label for="products_content">Nội dung</label>
                            <textarea class="form-control box_content" id="products_content" name="content"></textarea>
                            @if ($errors->has('content'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <h4 class="box-title">Thông tin chi tiết</h4>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="products_time">Thời gian bảo hành</label>
                            <input type="text" name="time" value="" class="form-control" id="products_time">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="products_production">Nhà sản xuất</label>
                            <input type="text" name="production" value="" class="form-control" id="products_production">
                            @if ($errors->has('production'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('production') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="products_madein">Nơi sản xuất</label>
                            <input type="text" name="madein" value="" class="form-control" id="products_madein">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="products_madeof">Thành phẩn của sản phẩm</label><input type="text" name="madeof" value="" class="form-control" id="products_madeof">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="products_weight">Khối lượng</label>
                            <div class="input-group">
                                <span class="input-group-addon"> gram </span>
                                <input type="text" name="weight" value="" class="form-control" id="products_weight">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="products_volume">Dung lượng</label>
                            <div class="input-group">
                                <span class="input-group-addon"> ml </span>
                                <input type="text" name="volume" value="" class="form-control" id="products_volume">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <h4 class="box-title">Hoàn thành</h4>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 nav_side">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Nội dung</h3>
                </div>
                <div class="box-body">
                    <ol>
                        <li>Thông tin cơ bản</li>
                            <ul>
                                <li>Tên sản phẩm</li>
                                <li>Danh mục sản phẩm</li>
                                <li>Thương hiệu sản phẩm</li>
                                <li>Số lượng</li>
                                <li>Giá</li>
                                <li>Hình ảnh</li>
                                <li>Giới thiệu</li>
                                <li>Nội dung</li>
                            </ul>
                        <li>Thông tin chi tiết</li>
                            <ul>
                                <li>Thời gian bảo hành</li>
                                <li>Nhà sản xuất</li>
                                <li>Nơi sản xuất</li>
                                <li>Thành phẩn của sản phẩm</li>
                                <li>Khối lượng</li>
                                <li>Dung lượng</li>
                            </ul>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- END ACCORDION & CAROUSEL-->
</section>
@endsection