<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Cerdas') }}</title>
      
    <!-- <link href="{{ asset('assets/vendors/iconfonts/simple-line-icon/css/simple-line-icons.css') }}" rel="stylesheet"> -->
    
    <!-- <link href="{{ asset('assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet"> -->
  
    <!-- <link href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}" rel="stylesheet"> -->
  
    <!-- <link href="{{ asset('assets/vendors/css/vendor.bundle.addons.css') }}" rel="stylesheet"> -->
    
    <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Sistem Cerdas') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <!--<li><a href="{{ route('login') }}">Login</a></li>
                            route('register') }}">Register</a></li>-->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    @if (Auth::user()->level == 'mahasiswa')
                                    <li>
                                        <a href="/">
                                            Lihat Notifikasi Revisi Proposal
                                        </a>
                                        
                                        <a href="/pengaturan_mhs/{{ Auth::user()->id }}">
                                            Lihat Data Akun
                                        </a>
                                        
                                        <a href="/proposalku/{{ Auth::user()->id }}"
                                            onclick="">
                                            Lihat Proposal
                                        </a>
                                        
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    @else
                                    <li>   
                                        <a href="/pengaturan_mhs/{{ Auth::user()->id }}">
                                            Lihat Data Akun
                                        </a>
                                        
                                        <a href="/data_mhs_bimbingan"
                                            onclick="">
                                            Lihat Data Mahasiswa Bimbingan
                                        </a>
                                        
                                        <a href="/upload_proposal"
                                            onclick="">
                                            Unggah Proposal Revisi
                                        </a>
                                        
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- plugins:js -->  
    <!-- <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>-->
  
    <!-- <script src="{{ asset('assets/vendors/js/vendor.bundle.addons.js') }}"></script>   -->
    
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <!-- <script src="{{ asset('assets/js/template.js') }}"></script> -->  
    
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- <script src="{{ asset('assets/js/dashboard.js') }}"></script>-->    
    <!-- <script src="{{ asset('assets/js/todolist.js') }}"></script>-->
    <!-- End custom js for this page-->
    
    @yield('script')
</body>
</html>
