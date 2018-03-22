@extends('admin.branding.base')
@section('action-content')

 <!-- Main content -->
    <div class="col-md-12">
    	<div class="box">
    		<div class="box-header">
    			<h3 class="box-title">Thêm mới thương hiệu sản phẩm</h3>
    		</div>
    		<!-- /.box-header -->
    		<form action="{{ route('branding.store') }}" class="form-horizontal" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    			@csrf
    			<div class="box-body">
    				<!-- form start -->
                    <div class="form-group"> <!-- Split the columns due to numbers of level of Category -->
                        <label for="products_category_1">Danh mục</label>
                        <select name="category_id" class="form-control" id="products_category">
                            @if($category)
                            <option value="">Chọn danh mục</option>
                                @foreach($category as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            @else
                            <option value="">Danh mục hiện dang trống</option>
                            @endif
                        </select>
                        @if ($errors->has('category_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('category_id') }}</strong>
                            </span>
                        @endif
                    </div>
    				<div class="form-group">
    					<label for="category_name">Tiêu đề</label>
    					<input type="text" name="name" value="{{ old('name') }}" class="form-control" id="branding_name"  autofocus required>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
    				</div>
    				<div class="form-group">
    					<label for="avatar">Hình ảnh</label>
    					<input type="file" id="branding_image" name="image"  >
    				</div>

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" >Giới thiệu ngắn</label>
                        <textarea id="branding_description" rows="10" class="form-control" name="description" value="{{ old('description') }}" ></textarea>

                        @if ($errors->has('description'))
                            <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                        @endif
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

@endsection