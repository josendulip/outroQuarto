@php
$config = [
    'appName' => config('app.name'),
    'locale' => $locale = app()->getLocale(),
    'locales' => config('app.locales'),
    'githubAuth' => config('services.github.client_id'),
];
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">
  <title>{{ config('app.name') }}</title>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">
  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/app.css') }}"> --}}
</head>
<body>
  <div id="app">
    <!-- Your vue application -->
    <vue-toastr ref="mytoast"></vue-toastr>
  </div>

  {{-- Global configuration object --}}
  <script>
    window.config = @json($config);
  </script>

  {{-- @auth
  <script>
      window.user = @json(auth()->user());
  </script>
  @endauth --}}
  
  {{-- Load the application scripts --}}
  <script src="{{ mix('dist/js/app.js') }}"></script>
  {{-- <script type="text/javascript" src="{{ asset('dist/js/app.js') }}"></script> --}}
  <script>
    window.onerror = function(error, url, line) {
      controller.sendLog({acc:'error', data:'ERR:'+error+' URL:'+url+' L:'+line});
    };
  </script>
</body>
</html>
