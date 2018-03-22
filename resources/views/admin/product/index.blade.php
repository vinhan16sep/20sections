@extends('admin.product.base')
@section('action-content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">SẢN PHẨM</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('product.create') }}" class="btn btn-primary" role="button">Thêm sản phẩm</a>
                        </div>
                        <form action="{{ route('product.index') }}" method="get">
                            @csrf
                            <div class="col-md-3">
                                <select name="category_id" class="input-group form-control" id="products_category">
                                    @if($category)
                                    <option value="">Chọn danh mục</option>
                                    @foreach($category as $key => $value)
                                    <option value="{{ $value->id }}" {{ ($value->id == $category_id)? 'selected' : '' }} >{{ $value->name }}</option>
                                    @endforeach
                                    @else:
                                    <option value="">Danh mục hiện dang trống</option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-3" class="products_branding">
                                <select name="branding_id" class="input-group form-control" id="products_branding">
                                    <option value="">Chọn thương hiệu (Chọn danh mục trước)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Tìm kiếm ..." name="search" value="{{ $keyword }}">
                                    <span class="input-group-btn">
                                        <input type="submit" class="btn btn-block btn-primary" value="Tìm kiếm">
                                    </span>
                                </div>
                            </div>
                        </form>
                        <input type="hidden" name="products_branding_id" value="{{ $branding_id }}">
                    </div>
                    
                    <div class="table-responsive">
                        <table id="table" class="table table_product">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giới thiệu</th>
                                <th>Danh mục</th>
                                <th>Thương hiệu</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($product)
                            <?php $i=1; ?>
                            @foreach($product as $value)
                            @if($value['image'] != null)
                                <?php $image = json_decode($value['image']); ?>
                            @endif
                            
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        <div class="mask_sm">
                                            @if($image != null)
                                            <a href="#"><img src="{{ asset('storage/app/products/'.$value['slug'].'/'.$image[0]) }}"></a>
                                            @else:
                                            <a href="#"><img src="{{ asset('storage/no_image.jpg') }}"></a>
                                            @endif
                                        </div>
                                    </td>
                                    <td><a href="{{ route('product.show', ['id' => $value['id']]) }}">{{ $value['name'] }}</a></td>
                                    <td>{{ $value['description'] }}</td>
                                    <td>{{ $value['category']['name'] }}</td>
                                    <td>{{ $value['branding']['name'] }}</td>
                                    <td>{{ $value['quantity'] }}</td>
                                    <td>{{ $value['price'] }} VND</td>
                                    <td>
                                        @if($value['is_activated'] == 0)
                                        <span class="label label-success product-active" data-id="{{ $value['id'] }}" >Active</span>
                                        @else
                                        <span class="label label-warning product-active" data-id="{{ $value['id'] }}" >Deactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('product.edit', ['id' => $value['id']]) }}" id="dataActionEdit"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                        <a href="#" class="dataActionDelete product-remove" data-id="{{ $value['id'] }}" data-csrf="{!! csrf_token() !!}" ><i class="fa fa-remove" aria-hidden="true"></i> </a>
                                    </td>

                                </tr>
                            @endforeach
                            @else()
                                <tr>
                                    <td>Chưa có sản phẩm</td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Detail</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                        {{ $product->appends(Request::get('page'))->links()}}
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
<script type="text/javascript">
    
</script>
@endsection