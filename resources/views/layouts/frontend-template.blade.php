<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Maymymy</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{ asset("public/libraries/css/bootstrap.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("public/libraries/css/font-awesome.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("public/sass/main.css")}}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,700,700i" rel="stylesheet">
    <link href="{{ asset("public/sass/font_settings.css")}}" rel="stylesheet" type="text/css" />

    <script src="{{ asset ("public/libraries/js/jquery-3.2.1.js") }}"></script>
    <script src="{{ asset ("public/libraries/js/bootstrap.min.js") }}"></script>
</head>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content container-fluid">
            <div class="modal-body">
                <div class="row">
                    <div class="right col-md-6 col-sm-6 col-xs-12 col-md-offset-6 col-sm-offset-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div class="left col-md-12 col-sm-12 col-xs-12">
                            <div class="mask">
                                {{ HTML::image('public/img/background/login_bg_1.jpg') }}
                            </div>
                            <div class="featured">
                                <div id="featured_brand">
                                    <h2>Featured</h2>
                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <i class="fa fa-3x fa-flag" aria-hidden="true"></i>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="media-heading">Featured #1</h3>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id nulla nec odio molestie iaculis sit amet id justo. Pellentesque tempor quis sem id ullamcorper.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <i class="fa fa-3x fa-feed" aria-hidden="true"></i>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="media-heading">Featured #2</h3>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id nulla nec odio molestie iaculis sit amet id justo. Pellentesque tempor quis sem id ullamcorper.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <i class="fa fa-3x fa-group" aria-hidden="true"></i>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="media-heading">Featured #3</h3>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id nulla nec odio molestie iaculis sit amet id justo. Pellentesque tempor quis sem id ullamcorper.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div id="featured_client">
                                    <h2>Featured</h2>
                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <i class="fa fa-3x fa-handshake-o" aria-hidden="true"></i>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="media-heading">Featured #1</h3>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id nulla nec odio molestie iaculis sit amet id justo. Pellentesque tempor quis sem id ullamcorper.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <i class="fa fa-3x fa-key" aria-hidden="true"></i>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="media-heading">Featured #2</h3>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id nulla nec odio molestie iaculis sit amet id justo. Pellentesque tempor quis sem id ullamcorper.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <i class="fa fa-3x fa-smile-o" aria-hidden="true"></i>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="media-heading">Featured #3</h3>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id nulla nec odio molestie iaculis sit amet id justo. Pellentesque tempor quis sem id ullamcorper.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#view_login_brand" aria-controls="brand" role="tab" data-toggle="tab">
                                        <b>Brand Login</b>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#view_login_client" aria-controls="client" role="tab" data-toggle="tab">
                                        <b>Client Login</b>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="view_login_brand">
                                    <h3 class="title">For Brand only</h3>

                                    {{-- BRAND LOGIN FORM --}}
                                    {{ Form::open(array('method'=>'post','class'=> '','url' => '', 'id'=>'brand-login')) }}
                                    <span class="error_brand_login"></span>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label for="input_brand_email">Email</label>
                                            <input type="text" class="form-control" id="input_brand_email" placeholder="yourbrand@20section.com">
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label for="input_brand_password">Password</label>
                                            <input type="password" class="form-control" id="input_brand_password" placeholder="password">
                                        </div>
                                        <div class="log_in col-md-12 col-sm-12 col-xs-12">
                                        {{Form::submit('Log in!', array('name'=>'submit', 'class'=>'btn btn-primary'))}}
                                        </div>
                                    {{ Form::close() }}
                                    {{-- END BRAND LOGIN FORM --}}

                                    <div class="forgot_password col-md-12 col-sm-12 col-xs-12">
                                        <a href="#">Forgot password?</a>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="view_login_client">
                                    <h3 class="title">For Client only</h3>
                                    <div id="client_login">
                                        {{-- PUBLISHER LOGIN FORM --}}
                                        {{ Form::open(array('method'=>'post','class'=> '','url' => '', 'id'=>'publisher-login')) }}
                                        <span class="error_client_login"></span>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <label for="input_client_email">Email</label>
                                                <input type="text" class="form-control" id="input_client_email" placeholder="yourclient@20section.com">

                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <label for="input_client_password">Password</label>
                                                <input type="password" class="form-control" id="input_client_password" placeholder="password">
                                            </div>
                                            <div class="log_in col-md-12 col-sm-12 col-xs-12">
                                            {{Form::submit('Log in!', array('name'=>'submit', 'class'=>'btn btn-primary'))}}
                                            </div>
                                        {{ Form::close() }}
                                        {{-- END PUBLISHER LOGIN FORM --}}

                                        <div class="sign_up col-md-12 col-sm-12 col-xs-12">
                                            <p>
                                                Don't have an account? Don't worry, <a href="javascript:void(0);" id="btn_signup">Sign up here</a>
                                            </p>
                                        </div>

                                        <div class="forgot_password col-md-12 col-sm-12 col-xs-12">
                                            <a href="#">Forgot password?</a>
                                        </div>

                                        {{-- <div class="log_in col-md-12 col-sm-12 col-xs-12">
                                            <button class="btn btn-primary" type="submit">
                                                Log in!
                                            </button>
                                        </div> --}}
                                    </div>

                                    <div id="client_signup">
                                        {{ Form::open(array('method'=>'post','class'=> '','url' => '', 'id'=>'publisher-register')) }}
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <label for="input_client_firstName">First Name (*)</label>
                                                <input type="text" class="form-control" name="input_client_firstName" id="input_client_firstName" placeholder="First Name">
                                                <span class="error_firstName"></span>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <label for="input_client_lastName">Last Name (*)</label>
                                                <input type="text" class="form-control" name="input_client_lastName" id="input_client_lastName" placeholder="Last Name">
                                                <span class="error_lastName"></span>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <label for="input_client_email_signup">Email</label>
                                                <input type="email" class="form-control" name="input_client_email_signup" id="input_client_email_signup" placeholder="youremail">
                                                <span class="error_email"></span>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <label for="input_client_phone_signup">Phone number</label>
                                                <input type="tel" class="form-control" name="input_client_phone_signup" id="input_client_phone_signup" placeholder="091 234 5678">
                                                <span class="error_phone"></span>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <label for="input_client_password_signup">Password</label>
                                                <input type="password" class="form-control" name="input_client_password_signup" id="input_client_password_signup" placeholder="password">
                                                <span class="error_password"></span>
                                            </div>
                                            
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <label for="input_client_confirm_password_signup">Confirm Password</label>
                                                <input type="password" class="form-control" name="input_client_confirm_password_signup" id="input_client_confirm_password_signup" placeholder="confirm password">
                                                <span class="error_confirm_password"></span>
                                            </div>
                                            <div class="log_in col-md-12 col-sm-12 col-xs-12">
                                            {{Form::submit('Register!', array('name'=>'submit', 'class'=>'btn btn-primary btn-submit-register'))}}
                                            </div>
                                        {{ Form::close() }}

                                        <div class="sign_up col-md-12 col-sm-12 col-xs-12">
                                            <p>
                                                Having an account. <a href="javascript:void(0);" id="btn_login">Log in here</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<body>

@include('layouts.header')

@yield('content')

@include('layouts.footer')

</body>
</html>