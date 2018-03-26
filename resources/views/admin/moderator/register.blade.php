@extends('admin.moderator.base')
@section('action-content')

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div id="client_signup" style="">
                <form method="POST" action="{{ route('mod.register') }}" accept-charset="UTF-8" class="" id="mod-register">
                    @csrf
                    @if(Session::has('message'))
                        <p class="alert alert-info">{{ Session::get('message') }}</p>
                    @endif
                    <div class="form-group">
                        <label for="name">Họ Tên (*)</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Họ và tên" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Email (*)</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email của bạn" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu (*)</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Xác nhận mật khẩu (*)</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Xác nhận mật khẩu">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="log_in col-md-12 col-sm-12 col-xs-12">
                        <input name="submit" class="btn btn-primary btn-submit-register" type="submit" value="Đăng ký">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection