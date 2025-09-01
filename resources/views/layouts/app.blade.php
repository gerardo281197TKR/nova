<!doctype html>
<html lang="es">

<head>
@include("partials.app.header")
</head>

<body>
  <!--start wrapper-->
  <div class="wrapper" id="app">
    @include("partials.app.sidebar")
    @include("partials.app.headerMenu")
    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
      <!-- start page content-->
      <div class="page-content">
        @include("partials.app.breadcrum")
        @yield('content')
      </div>
      <!-- end page content-->
    </div>
    <!--end page content wrapper-->
    @include("partials.app.footer")
    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top">
      <ion-icon name="arrow-up-outline"></ion-icon>
    </a>
    <!--End Back To Top Button-->
    <!--start overlay-->
    <div class="overlay nav-toggle-icon"></div>
    <!--end overlay-->
  </div>
  <!--end wrapper-->
  @include("partials.app.javascript")
</body>
</html>