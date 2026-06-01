<!DOCTYPE html>
<html lang="en">
@include('themes.partials.head')
<body>
  <!--================Header Menu Area =================-->
  @include('themes.partials.header')
  <!--================Header Menu Area =================-->
  
 
  @yield('content')
 @include('themes.partials.footer')
  <!--================ Start Footer Area =================-->

  <!--================ End Footer Area =================-->

  @include('themes.partials.scribt')
</body>
</html>