@extends('admin.brand.base')
@section('action-content')
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Đăng ký Brand</h3>
					</div>
					<div class="box-body">
						<form method="POST" action="{{ route('brand.register') }}">
							@csrf
							@if(Session::has('message'))
								<p class="alert alert-info">{{ Session::get('message') }}</p>
							@endif
							<div class="form-group row">
								<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Họ Tên') }}</label>

								<div class="col-md-6">
									<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

									@if ($errors->has('name'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Đại chỉ E-Mail') }}</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

									@if ($errors->has('email'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mật khẩu') }}</label>

								<div class="col-md-6">
									<input id="password" type="text" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} generate_password" name="password" required>
									<input type="button" class="button" value="Tạo mật khẩu" id="generate">
									@if ($errors->has('password'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Xác nhận mật khẩu') }}</label>

								<div class="col-md-6">
									<input id="password-confirm" type="text" class="form-control generate_password" name="password_confirmation" required>
								</div>
							</div>

							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary">
										{{ __('Đăng ký') }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	function randomPassword(length) {
	    var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
	    var pass = "";
	    for (var x = 0; x < length; x++) {
	        var i = Math.floor(Math.random() * chars.length);
	        pass += chars.charAt(i);
	    }
	    return pass;
	}

	$('#generate').click(function(){
		var generate = randomPassword(8);
		$('.generate_password').val(generate);
	})
</script>
@endsection
