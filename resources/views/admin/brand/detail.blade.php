@extends('admin.brand.base')
@section('title-base', 'Chi tiết Brand')
@section('action-content')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="box-body">
                <div class="row">
                    <form action="{{ route('brand.detail', ['id' => $user['id']]) }}" method="get">
                        @csrf
                        <div class="col-md-4">
                            <select name="category_id" class="input-group form-control" id="search_products_category">
                                @if($category)
                                    <option value="">Chọn danh mục</option>
                                    @foreach($category as $key => $value)
                                        <option value="{{ $value->id }}" {{ ($value->id == $category_id)? 'selected': '' }} >{{ $value->name }}</option>
                                    @endforeach
                                @else:
                                <option value="">Danh mục hiện dang trống</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-4" class="products_branding">
                            <select name="branding_id" class="input-group form-control" id="search_products_branding">
                                <option value="">Chọn thương hiệu (Chọn danh mục trước)</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="{{ $user['id'] }}">
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

                <input type="hidden" name="products_branding_id" value="{{ $branding_id }}">
            </div>

            <div class="col-md-4">
                <h3>Thông tin Brand</h3>
                <table class="row table table-bordered table-hover dataTable table-striped">
                    <tr>
                        <td class="col-md-3">
                            <strong>Họ tên:</strong>
                        </td>
                        <td class="col-md-9">{{ $user['name'] }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-3">
                            <strong>Email:</strong>
                        <td class="col-md-9">{{ $user['email'] }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-3">
                            <strong>Người tạo:</strong>
                        <td class="col-md-9">{{ $user['created_by'] }}</td>
                    </tr>
                    <tr>
                        <td class="col-md-3">
                            <strong>Ngày tạo:</strong>
                        <td class="col-md-9">{{ $user['created_at'] }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-8">
                <h3>Sản phẩm của {{ $user['name'] }}</h3>
                <button type="button" class="btn btn-primary btn-lg btn-create-product" data-toggle="modal" data-target="#bs-edit-modal-lg">Thêm mới sản phẩm </button>
                <table id="table" class="table table_product table-striped">
                    <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $key => $value)
                            <tr>
                                <td>{{ $value['name'] }}</td>
                                <td>{{ $value['quantity'] }}</td>
                                <td>{{ $value['price'] }} <strong>VND</strong></td>
                                <td>
                                    @if($value['is_activated'] == 0)
                                        <span class="label label-success product-active" data-id="{{ $value['id'] }}" >Đang sử dụng</span>
                                    @else
                                        <span class="label label-warning product-active" data-id="{{ $value['id'] }}" >Không sử dụng</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#bs-edit-modal-lg" data-id="{{ $value['id'] }}" data-category="{{ $value['category_id'] }}" data-id="{{ $value['id'] }}" class="edit-product"><i class="fa fa-pencil bs-edit-modal-lg" aria-hidden="true"></i> </a>

                                    <a href="#" class="dataActionDelete product-remove" data-id="{{ $value['id'] }}" ><i class="fa fa-remove" aria-hidden="true"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $product->appends(Request::get('page'))->links()}}
            </div>

            {{-------------------Modal Edit-------------------}}
            <div class="modal fade" id="bs-edit-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content detail-product">
                        <form action="" class="form-horizontal form-edit-product" enctype="multipart/form-data" method="post" accept-charset="utf-8" id="form-detail-product">
                            <div class="modal-body">
                                <div class="row">@csrf
                                    <div class="box-body">

                                        <div class="col-md-12">
                                            <h4 class="box-title">Thông tin cơ bản</h4>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="products_name">Tên sản phẩm</label>
                                            <input type="text" name="name" value="" class="form-control" id="edit-products-name" required>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <!-- Split the columns due to numbers of level of Category -->
                                            <label for="products_category">Danh mục sản phẩm</label>
                                            <select name="category_id" class="form-control" id="edit-products-category">
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
                                        <div class="form-group col-md-6">
                                            <!-- Split the columns due to numbers of level of Category -->
                                            <label for="products_branding">Thương hiệu sản phẩm</label>
                                            <select name="branding_id" class="form-control" id="edit-products-branding">
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
                                            <input type="text" name="quantity" value="" class="form-control" id="edit-products-quantity">
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
                                                <input type="text" name="price" value="" class="form-control" id="edit-products-price">

                                            </div>
                                            @if ($errors->has('price'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('price') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12 image-preview">
                                            <label for="products_image">Hình ảnh đang sử dụng</label>
                                            <div class="item">
                                                <div class="old-image mask">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="products_image">Hình ảnh</label>
                                            <input type="file" id="edit-products-image" name="image[]" multiple>
                                            <p class="help-block">Click để upload. Hình ảnh đầu tiên sẽ được sử dụng làm avata cho sản phẩm</p>
                                            @if ($errors->has('image'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="products_description">Giới thiệu</label>
                                            <textarea class="form-control box_content" id="edit-products-description" name="description"></textarea>
                                            @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="products_content">Nội dung</label>
                                            <textarea class="form-control box_content" id="edit-products-content" name="content"></textarea>
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
                                            <input type="text" name="time" value="" class="form-control" id="edit-products-time">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="products_production">Nhà sản xuất</label>
                                            <input type="text" name="production" value="" class="form-control" id="edit-products-production">
                                            @if ($errors->has('production'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('production') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="products_madein">Nơi sản xuất</label>
                                            <input type="text" name="madein" value="" class="form-control" id="edit-products-madein">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="products_madeof">Thành phẩn của sản phẩm</label>
                                            <input type="text" name="madeof" value="" class="form-control" id="products_madeof">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="products_weight">Khối lượng</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"> gram </span>
                                                <input type="text" name="weight" value="" class="form-control" id="edit-products-weight">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="products_volume">Dung lượng</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"> ml </span>
                                                <input type="text" name="volume" value="" class="form-control" id="edit-products-volume">
                                            </div>
                                        </div>
                                        <input type="hidden" name="edit_product_branding_id" value="" id="edit-product-branding-id">
                                        <input type="hidden" name="brand_id" value="{{ $user['id'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-activity-product">Cập nhật</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            {{-------------------End Modal Edit-------------------}}

        </div>
    </section>
@endsection