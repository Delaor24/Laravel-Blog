<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ config("app.name", "Laravel ") }} @yield("title")</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('assets/favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset("assets/backEnd/plugins/bootstrap/css/bootstrap.css") }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset("assets/backEnd/plugins/node-waves/waves.css") }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset("assets/backEnd/plugins/animate-css/animate.css") }}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{ asset("assets/backEnd/plugins/morrisjs/morris.css") }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset("assets/backEnd/css/style.css") }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset("assets/backEnd/css/themes/all-themes.css") }}" rel="stylesheet" />

    <!-- ..............toastr.min.css.................local file............ -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backEnd/css/toastr.min.css')}}">
    <!-- ...............toastr.min.css...................CDN.....................-->

     <lnk rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    @stack("css")
</head>
<body class="theme-blue">
    <!-- Page Loader -->
   <!--  <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div> -->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    @include("layouts.backEnd.partials.topbar")
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        @include("layouts.backEnd.partials.sidebar")
        <!-- #END# Left Sidebar -->
       
    </section>

    <section class="content">
        @yield("content")
        
    </section>

    <!-- Jquery Core Js -->
    <script src="{{asset("assets/backEnd/plugins/jquery/jquery.min.js")}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset("assets/backEnd/plugins/bootstrap/js/bootstrap.js")}}"></script>

    <!-- Select Plugin Js -->
    <script src="{{asset("assets/backEnd/plugins/bootstrap-select/js/bootstrap-select.js")}}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{asset("assets/backEnd/plugins/jquery-slimscroll/jquery.slimscroll.js")}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset("assets/backEnd/plugins/node-waves/waves.js")}}"></script>
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
    @stack("js")
</body>
</html>
