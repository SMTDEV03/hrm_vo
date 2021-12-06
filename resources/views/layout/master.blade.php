<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />
    <title>@yield('title')</title>
    @include('include.backend.header')
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper boxed-wrapper">
      @include('include.backend.navbar')
      @include('include.backend.sidebar')
      @yield('content')
    
    </div>
  </div>
  @include('include.backend.footer')
  @yield('extra-js')
  @yield('leave-js')
  @yield('application-js')
  @yield('checkStatus.js')
  </body>
</html>

