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
    <h3 class="login-box-msg">Sign Up</h3>
    <form action="{{ route('auth.save')}}" method="post">

      @if(Session::get('success'))
      <div class="alert alert-success">
          {{ Session::get('success' )}}
      </div>
      @endif
          @if(Session::get('fail'))
          <div class="alert alert-danger">
              {{ Session::get('fail' )}}
          </div>  
          @endif

      @csrf
      <div class="form-group has-feedback">
        <input type="text" class="form-control sty1" name="fname"  value="{{ old('fname')}}" placeholder="First Name">
        <span class="text-danger">@error('name'){{ $message}} @enderror</span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control sty1" name="lname"  value="{{ old('lname')}}" placeholder="Last Name">
        <span class="text-danger">@error('name'){{ $message}} @enderror</span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control sty1" name="email" value="{{ old('email')}}" placeholder="Email Address">
        <span class="text-danger">@error('email'){{ $message}} @enderror</span>

      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control sty1" name="password"  vallue="{{ old('password')}}" placeholder="Password">
        <span class="text-danger">@error('password'){{ $message}} @enderror</span>

      </div>
    
      <div>
      
        <!-- /.col -->
        <div class="col-xs-4 m-t-1">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
        </div>
        <!-- /.col --> 
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