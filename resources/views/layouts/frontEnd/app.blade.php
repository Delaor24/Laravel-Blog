<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- title icon -->
    <link rel="icon" href="{{asset('assets/fivicon_frontEnd.png')}}" type="image/x-icon">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



    <!-- Font -->

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


    <!-- Stylesheets -->

    <link href="{{asset('assets/frontEnd/css/bootstrap.css')}}" rel="stylesheet">

    <!-- ..............toastr.min.css.................local file............ -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backEnd/css/toastr.min.css')}}">

    <link href="{{asset('assets/frontEnd/css/swiper.css')}}" rel="stylesheet">

    <link href="{{asset('assets/frontEnd/css/ionicons.css')}}" rel="stylesheet">
    @stack('css')
</head>
<body>
   
  @include('layouts.frontEnd.partial.header')
   

   @yield('content')



   @include('layouts.frontEnd.partial.footer')


   <script src="{{asset('assets/frontEnd/js/jquery-3.1.1.min.js')}}"></script>

    <script src="{{asset('assets/frontEnd/js/tether.min.js')}}"></script>

    <script src="{{asset('assets/frontEnd/js/bootstrap.js')}}"></script>

    <script src="{{asset('assets/frontEnd/js/swiper.js')}}"></script>

    <script src="{{asset('assets/frontEnd/js/scripts.js')}}"></script>


     <!-- ...................Toastr.js local file ................-->
    <script type="text/javascript" src="{{asset('assets/backEnd/js/toastr.min.js')}}"></script>
    <!--..........................Toastr CDN.................. -->
   <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}

    <script>
        //...............Error message show.......................
    @if($errors->any())
        @foreach($errors->all() as $error)
              toastr.error('{{ $error }}','Error',{
                  closeButton:true,
                  progressBar:true,
               });
        @endforeach
    @endif
</script>
    @stack('js')

</body>
</html>
