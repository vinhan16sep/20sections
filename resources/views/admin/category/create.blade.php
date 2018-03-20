@extends('admin.category.base')
@section('action-content')

 <!-- Main content -->
    <div class="col-md-12">
    	<div class="box">
    		<div class="box-header">
    			<h3 class="box-title">Thêm mới danh mục sản phẩm</h3>
    		</div>
    		<!-- /.box-header -->
    		<form action="{{ route('category.store') }}" class="form-horizontal" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    			@csrf
    			<div class="box-body">
    				<!-- form start -->

    				<div class="form-group">
    					<label for="category_name">Tiêu đề</label>
    					<input type="text" name="name" value="{{ old('name') }}" class="form-control" id="category_name"  autofocus required>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
    				</div>
    				<div class="form-group">
    					<label for="avatar">Hình ảnh</label>
    					<input type="file" id="category_image" name="image"  >
    				</div>

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" >Giới thiệu ngắn</label>
                        <textarea id="description" rows="10" class="form-control" name="description" value="{{ old('description') }}" ></textarea>

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