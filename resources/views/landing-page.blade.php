<!DOCTYPE html>
<html lang="en">
<head>
    <title>Library</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="{{asset('css/landing-page.css')}}">
    <link rel="shortcut icon" href="{{asset('images/logo2.png')}}">

    <meta name="keywords" content="Binus, Binus Library, Library Binus, Bina Nusantara University Library, Bina Nusantara University">
    <meta name="description" content=" Booking buku sebelum keduluan orang lain.">
    <meta name="title" content="Binus Library">

    <meta property="og:image" content="{{asset('images/logo2.png')}}">

    <meta property="og:url" content="http://library.christopheralvin.xyz/">

    <meta name="theme-color" content="#0af"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body onload="loadingScene()">
<div id="loader">
    <img src="images/loading.gif" class="img-fluid" alt="">
    <h2 class="text-center"><i>"“Reading is essential for those who seek to rise above the ordinary.”<br>Jim Rohn</i></h2>
</div>
<div class="body-content">
    <div class="landing-page" id="home-div">
        <div class="navbar" style="">
            <div class="nav-left">
                
            </div>
            <div class="nav-right">
                <div class="no-burger">
                    <a href="{{url('/')}}">Home</a>
                    <a href="{{url('/catalog')}}">Catalog</a>
                    <a href="{{url('/video')}}">Video</a>
                    @if(Auth::guard('web')->check())
                    <a href="{{url('/history')}}">History</a>
                    <label style="color: #556489;">{{Auth::user()->name}}</label>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @else
                    <a href="{{url('/login')}}">Login</a>
                    @endif
                    {{-- <a href="#contact-us">Contact Us</a> --}}
                </div>
                <button class="btn-burger">
                    <span class="span-1 color-super-dark"></span>
                    <span class="span-2 color-super-dark"></span>
                    <span class="span-3 color-super-dark"></span>
                </button>
            </div>
        </div>
    
        <div class="section-navbar">
            <img src="images/wave_atas.png" style="width:100%;">
            <div class="section-navbar-list"><a href="{{url('/')}}">Home</a></div>
            <div class="section-navbar-list"><a href="{{url('/catalog')}}">Catalog</a></div>
            <div class="section-navbar-list"><a href="{{url('/video')}}">Video</a></div>
            @if(Auth::guard('web')->check())
            <div class="section-navbar-list">
                <a href="{{url('/history')}}">History</a>
            </div>
            <div class="section-navbar-list">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            @else
            <div class="section-navbar-list">
                <a href="{{url('/login')}}">Login</a>
            </div>
            @endif
            {{-- <div class="section-navbar-list"> <a href="#contact-us">Contact Us</a></div> --}}
            <img src="images/wave_bawah.png" style="width:100%">
        </div>
        <div class="landing-content direction-wrap mx-auto">
            <div class="containers rightreveal inner-content">
                <span class="text-center">
                    {{-- <h4>Daftar Sebagai</h4> --}}
                    <h1>BINUS LIBRARY</h1>
                </span>
                <h4 class="text-center content-regis">
                    Booking buku sebelum keduluan orang lain.
                </h4>
                <div class="row container">
                @guest   
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 text-center">
                        <a class="anti-a" href="{{url('login')}}"><button type="submit">LOGIN</button></a>
                    </div>
                @else
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 text-center">
                    <a class="anti-a" href="{{url('catalog')}}"><button type="submit">Catalog</button></a>
                </div>
                @endguest
                </div>
            </div>
            <img src="images/flat.jpg" class="img-fluid bic-img upreveal" alt="">    
        </div>
    </div>  
 </div> 

{{-- <script src="{{asset('js/app.js')}}"></script> --}}
<script src="{{asset('js/landing-page.js')}}"></script>
</body>
</html>