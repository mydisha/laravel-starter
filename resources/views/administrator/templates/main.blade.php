<!DOCTYPE html>
<html>
  <head>
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/vendor.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/flat-admin.css') }}">
    <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/theme/blue-sky.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/theme/blue.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/theme/red.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/theme/yellow.css') }}">
    <!--Tiny MCE-->
    {{-- <script type="text/javascript" src="{{ asset('assets/plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/vendor/jquery-2.1.0.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/dist/js/select2.min.js') }}"></script>
  </head>
  <body>
    <div class="app app-default">
      <!-- Sidebar -->
      @include('administrator.templates.sidebar')

      <div class="app-container">
        @include('administrator.templates.header')
        @include('administrator.templates.floating')
        @yield('content')
        @include('administrator.templates.footer')
      </div>
    </div>
    <script type="text/javascript" src="{{ asset('assets/admin/js/vendor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/app.js') }}"></script>


    @stack('javascript')
  </body>
</html>
