<!doctype html>
<html lang="es" class="light-theme">

<head>
@include("partials.guest.header")
</head>

<body>
  <!--start wrapper-->
  <div class="wrapper">
    <header>
        {{-- @include("partials.guest.navbar") --}}
    </header>
    @yield("content")
    @include("partials.guest.footer")
  </div>
  <!--end wrapper-->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>