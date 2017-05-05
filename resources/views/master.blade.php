<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials._head')
  </head>
  <body>
    <!--[if IE]>
      <div class="browserupgrade"><p>You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p></div>
    <![endif]-->
    @include('partials._nav')
    <div class="container">
      @include('partials._message')
      @yield('content')
    </div>
    @include('partials._footer')
    @include('partials._scripts')
  </body>
</html>
