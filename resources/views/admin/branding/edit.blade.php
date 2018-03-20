@extends('admin.branding.base')
@section('action-content')

 <!-- Main content -->
    <div class="col-md-12">
    	<div class="box">
    		<div class="box-header">
    			<h3 class="box-title">Chỉnh sửa danh mục sản phẩm</h3>
    		</div>
    		<!-- /.box-header -->
    		<form action="{{ route('branding.update', ['id' => $branding->id]) }}" class="form-horizontal" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    			@csrf
    			<div class="box-body">
    				<!-- form start -->
                    <div class="form-group"> <!-- Split the columns due to numbers of level of Category -->
                        <label for="products_category_1">Danh mục</label>
                        <select name="category_id" class="form-control" id="products_category">
                            @if($category)
                            <option value="">Chọn danh mục</option>
                                @foreach($category as $key => $value)
                                    <option value="{{ $value->id }}" {{ ($value->id == $branding->category_id)? 'selected' : '' }}>{{ $value->name }}</option>
                                @endforeach
                            @else:
                            <option value="">Danh mục hiện dang trống</option>
                            @endif
                        </select>
                    </div>
    				<div class="form-group">
    					<label for="branding_name">Name</label>
    					<input type="text" name="name" value="{{ $branding->name }}" class="form-control" id="branding_name" required>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
    				</div>
                    <div class="form-group mask_sm">
                        <label for="avatar">Hình ảnh đang sử dụng</label><br />
                        <img src="{{ asset('storage/app/branding/'.$branding->image) }}" width="250px">
                    </div>
    				<div class="form-group">
    					<label for="avatar">Hình ảnh</label>
    					<input type="file" id="branding_image" name="image"  >
    				</div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" >Giới thiệu ngắn</label>
                        <textarea id="description" rows="10" class="form-control" name="description" value="{{ old('description') }}" >{{ $branding->description }}</textarea>

                        @if ($errors->has('description'))
                            <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                        @endif
                    </div>
    			</div>
    			<!-- /.box-body -->
    			<div class="box-footer">
    				<button type="submit" class="btn btn-primary">Cập nhật</button>
    			</div>
    		</form>
    	</div>
    	<!-- /.box -->
    </div>

@endsection