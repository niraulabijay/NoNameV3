<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from demo.themefisher.com/themefisher/elite-shop/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Dec 2018 08:34:28 GMT -->
<head>
    <meta charset="utf-8">
    <title>Hamro Shop - Login</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="{{asset('css/my.css')}}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
</head>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Forgot Password</h5>
                    <form class="form-signin" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="form-label-group">
                            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="New Password" required autofocus>
                            <label for="inputPassword">New Password</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="inputCPassword" name="confirm_password" class="form-control" placeholder="Confirm Password" required autofocus>
                            <label for="inputCPassword">Confirm Password</label>
                        </div>


                        {{--<div class="form-label-group">--}}
                        {{--<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>--}}
                        {{--<label for="inputPassword">Password</label>--}}
                        {{--</div>--}}

                        {{--<div class="custom-control custom-checkbox mb-3">--}}
                        {{--<input type="checkbox" class="custom-control-input" id="customCheck1" name="remember">--}}
                        {{--<label class="custom-control-label" for="customCheck1">Remember password</label>--}}
                        {{--</div>--}}
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Send Password Reset Code </button>
                        {{--<a href="#">Forgot Password?</a><br>--}}
                        {{--<a href="{{route('register')}}">Not a user yet? Sign Up</a>--}}
                        <hr class="my-4">
                        {{--<button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>--}}
                        {{--<button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button>--}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</html>