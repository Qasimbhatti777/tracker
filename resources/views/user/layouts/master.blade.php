@include('user.layouts.header')

<!-- Top navbar start  -->
@include('user.layouts.top-nav')
<!-- Top navbar End  -->


<div id="layoutSidenav">


<!-- Side navbar Start  -->
    @include('user.layouts.sidebar')
<!-- Side navbar End  -->

  <div id="layoutSidenav_content">

<!-- Content of The Dashboard Page Start -->
    @yield('content')
<!-- Content of The Dashboard Page End -->


<!-- Footer Start -->

    @include('user.layouts.footer')

<!-- Footer End -->

