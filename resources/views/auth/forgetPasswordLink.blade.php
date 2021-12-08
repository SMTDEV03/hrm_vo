<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Niche Admin - Powerful Bootstrap 4 Dashboard and Admin Template</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />
  
  <!-- v4.0.0-alpha.6 -->
  <link rel="stylesheet" href="{{ asset('public/assets/bootstrap/css/bootstrap.min.css')}}">
  
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('public/assets/css/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{ asset('public/assets/css/et-line-font/et-line-font.css')}}">
  <link rel="stylesheet" href="{{ asset('public/assets/css/themify-icons/themify-icons.css')}}">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-box-body">
    <h3 class="login-box-msg">Reset Password</h3>
    <form action="{{ route('reset.password.post') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group row">
            {{-- <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label> --}}
            <div class="col-md-8">
                <input type="text" id="email_address" class="form-control" placeholder="E-Mail Address" name="email" required autofocus>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            {{-- <label for="password" class="col-md-4 col-form-label text-md-right"> New Password</label> --}}
            <div class="col-md-8">
                <input type="password" id="password" class="form-control" placeholder="New Password" name="password" required autofocus>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label> --}}
            <div class="col-md-8">
                <input type="password" id="password-confirm" class="form-control" placeholder="Confirm Password" name="password_confirmation" required autofocus>
                @if ($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>
        </div>

        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Reset Password
            </button>
        </div>
    </form>
    <div class="m-t-2">Already have an account? <a href="{{ route('auth.login')}}" class="text-center">Login</a></div>
  </div>
  <!-- /.login-box-body --> 
</div>
<!-- /.login-box --> 

<!-- jQuery 3 --> 
<script src="{{ asset('public/assets/js/jquery.min.js')}}"></script> 

<!-- v4.0.0-alpha.6 --> 
<script src="{{ asset('public/assets/bootstrap/js/bootstrap.min.js')}}"></script> 

<!-- template --> 
<script src="{{ asset('public/assets/js/niche.js')}}"></script>
</body>
</html>