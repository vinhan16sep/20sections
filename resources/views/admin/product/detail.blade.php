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
                    <h3 class="box-title">CHI TIẾT SẢN PHẨM</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    
                    <div class="row">
                        Hình ảnh:
                        <br>
                        @if($product['image'])
                            @foreach(json_decode($product['image']) as $key => $value)
                                <img src="{{ asset('storage/app/products/'.$product['slug'].'/'.$value) }}">
                            @endforeach
                        @endif
                        <br>
                        Tên sản phẩm:
                        <br>
                            {{ $product['name'] }}
                        <br>
                        Tên danh mục:
                        <br>
                            {{ $product['category']['name'] }}
                        <br>
                        Tên thương hiệu:
                        <br>
                            {{ $product['branding']['name'] }}
                        <br>
                        Số lượng sản phẩm:
                        <br>
                            {{ $product['quantity'] }}
                        <br>
                        Giá sản phẩm:
                        <br>
                            {{ $product['price'] }}
                        <br>
                        Thời gian bảo hành:
                        <br>
                            {{ $product['time'] }}
                        <br>
                        Nhà sản xuất:
                        <br>
                            {{ $product['production'] }}
                        <br>
                        Nơi sản xuất:
                        <br>
                            {{ $product['madein'] }}
                        <br>
                        Thành phần chính:
                        <br>
                            {{ $product['madeof'] }}
                        <br>
                        Khối lượng:
                        <br>
                            {{ $product['weight'] }}
                        <br>
                        Dung lượng:
                        <br>
                            {{ $product['volume'] }}
                        <br>
                        Giới thiệu:
                        <br>
                            {{ $product['description'] }}
                        <br>
                        Nội dung:
                        <br>
                            {{ $product['content'] }}
                        <br>
                        Trạng thái:
                        <br>
                            @if($product['is_activated'] == 0)
                                Active
                            @else
                                Deactive
                            @endif
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