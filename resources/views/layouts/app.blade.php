<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style >
        .contextmenu{
          visibility:hidden;
          background:#ffffff;
          border:1px solid #8888FF;
          z-index: 10;
          position: relative;
          width: 140px;
        }
        .contextmenu div{
          padding-left: 5px
        }
    </style>
</head>
<body>
    <div class="container-fluid" id="app">
        <div class="row d-flex">
            <nav class="col-md-2">
                <!-- sidebar -->
                @include('partials.sidebar')
                <!-- /sidebar -->
            </nav>
            <!-- main -->
            <main class="col-md-10">
                @yield('content')
            </main>
            <!-- /main -->
        </div>
    </div>
    <!-- Scripts -->
    @yield('scripts')
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
