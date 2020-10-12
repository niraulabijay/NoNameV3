<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Hotel & Resort HTML5 Template" />
    <meta name="author" content="TeslaThemes" />
    <link rel="shortcut icon" href="{{  asset('front/img/favicon.png') }}" type="image/x-icon" />

    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Style CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('admin_lte/plugins/datepicker/datepicker3.css') }}">
    <title>Register</title>
    <style>
        :root {
            --input-padding-x: 1.5rem;
            --input-padding-y: .75rem;
        }

        body {
            background: #007bff;
            background: linear-gradient(to right, #0062E6, #33AEFF);
        }

        .card-signin {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
        }

        .card-signin .card-title {
            margin-bottom: 2rem;
            font-weight: 300;
            font-size: 1.5rem;
        }

        .card-signin .card-body {
            padding: 2rem;
        }

        .form-signin {
            width: 100%;
        }

        .form-signin .btn {
            font-size: 80%;
            border-radius: 5rem;
            letter-spacing: .1rem;
            font-weight: bold;
            padding: 1rem;
            transition: all 0.2s;
        }

        .form-label-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-label-group input {
            height: auto;
            border-radius: 2rem;
        }

        .form-label-group>input,
        .form-label-group>label {
            padding: var(--input-padding-y) var(--input-padding-x);
        }

        .form-label-group>label {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            margin-bottom: 0;
            /* Override default `<label>` margin */
            line-height: 1.5;
            color: #495057;
            border: 1px solid transparent;
            border-radius: .25rem;
            transition: all .1s ease-in-out;
        }

        .form-label-group input::-webkit-input-placeholder {
            color: transparent;
        }

        .form-label-group input:-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-moz-placeholder {
            color: transparent;
        }

        .form-label-group input::placeholder {
            color: transparent;
        }

        .form-label-group input:not(:placeholder-shown) {
            padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
            padding-bottom: calc(var(--input-padding-y) / 3);
        }

        .form-label-group input:not(:placeholder-shown)~label {
            padding-top: calc(var(--input-padding-y) / 3);
            padding-bottom: calc(var(--input-padding-y) / 3);
            font-size: 12px;
            color: #777;
        }

        .btn-google {
            color: white;
            background-color: #ea4335;
        }

        .btn-facebook {
            color: white;
            background-color: #3b5998;
        }

        /* Fallback for Edge
        -------------------------------------------------- */

        @supports (-ms-ime-align: auto) {
            .form-label-group>label {
                display: none;
            }
            .form-label-group input::-ms-input-placeholder {
                color: #777;
            }
        }

        /* Fallback for IE
        -------------------------------------------------- */

        @media all and (-ms-high-contrast: none),
        (-ms-high-contrast: active) {
            .form-label-group>label {
                display: none;
            }
            .form-label-group input:-ms-input-placeholder {
                color: #777;
            }
        }

    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center text-uppercase"><strong>Sign In</strong></h5>
                    <div class="alert alert-error" style="display:none;"></div>
                    <form method="POST" action="{{route('register_user')}}" enctype="multipart/form-data">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                Please fix the following errors.
                            </div>
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="inputfirstname1">{{ __('First Name') }}</label>
                                    <input type="text" name="first_name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="inputfirstname1" placeholder="Enter firstname" value="{{ old('first_name') }}">
                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="inputlastname1">{{ __('Last Name') }}</label>
                                    <input type="text" name="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="inputlastname1" placeholder="Enter lastname" value="{{ old('last_name') }}">
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputemail1">{{ __('E-Mail Address') }}</label>
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="inputemail1" placeholder="Enter email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="inputpassword1">{{ __('Password') }}</label>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="inputpassword1" placeholder="Enter password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="inputrepassword1">{{ __('Confirm Password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control" id="inputrepassword1" placeholder="Enter re-password">
                        </div>
                        <div class="form-group">
                            <label for="country">{{ __('Date of Birth') }}</label>
                            <input type="date" name="dob" class="form-control datepicker" placeholder="YYYY-MM-DD">
                        </div>
                        <div class="form-group">
                            <label for="prof_pic">Profile Picture</label>
                            <input type='file' name="prof_pic" class="btn btn-secondary" id="imgInp">
                            <div class="style-photo" style="display: none; padding-top: 10px; padding-left: 30px">
                                <img id="blah" src="#" alt="your image" style="width: 240px; height: 240px;border-radius: 50%;"/>
                            </div>
                        </div>
                        <div class="form-group form-check mb-3">
                            <input name="terms" type="checkbox" value="1" class="form-check-input" id="exampleCheck12">
                            <label class="form-check-label" for="exampleCheck12">By signing up, you agree
                                to our <a href="javascript:void(0)" class="link">terms</a>.</label>
                            @if ($errors->has('terms'))
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('terms') }}</strong>
                    </span>
                            @endif
                        </div>
                        <div class="btn-container">
                            <button type="submit" class="btn btn-primary ">Submit</button>
                        </div>

                    </form>
                    {{--<form class="form-signin" id="login" method="post" action="">--}}
                        {{--<div class="form-label-group">--}}
                            {{--<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>--}}
                            {{--<label for="inputEmail">Email address</label>--}}
                        {{--</div>--}}

                        {{--<div class="form-label-group">--}}
                            {{--<input   type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>--}}
                            {{--<label for="inputPassword">Password</label>--}}
                        {{--</div>--}}

                        {{--<div class="custom-control custom-checkbox mb-3">--}}
                            {{--<input type="checkbox" name="rememberMe" class="custom-control-input" id="customCheck1">--}}
                            {{--<label class="custom-control-label" for="customCheck1">Remember password</label>--}}
                        {{--</div>--}}
                        {{--<button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>--}}
                        {{--<hr class="my-4">--}}
                        {{--<button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>--}}
                        {{--<button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button>--}}
                    {{--</form>--}}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script>
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
                $('.style-photo').show();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });
</script>

{{--<script src="{{ asset('admin/js/login.js') }}"></script>--}}


{{--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
{{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
<!-- datepicker -->
{{--<script src="{{asset('admin_lte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>--}}
{{--<script>--}}
    {{--//Datepicker for dynamically added fields--}}
    {{--$(document).on("focus", ".datepicker", function(){--}}
        {{--$(this).datepicker({--}}
            {{--dateFormat:"yy-mm-dd",--}}
            {{--minDate:0,--}}
            {{--autocomplete:0,--}}
        {{--});--}}
    {{--});--}}

{{--</script>--}}
{{--<script>--}}
    {{--$( function() {--}}
        {{--$( ".datepicker" ).datepicker({--}}
            {{--dateFormat:'yy-mm-dd',--}}
            {{--minDate:0,--}}
            {{--autocomplete:0,--}}
        {{--});--}}
    {{--} );--}}
{{--</script>--}}
</body>
</html>