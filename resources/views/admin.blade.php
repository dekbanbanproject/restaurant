<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  {{-- <link rel="shortcut icon" href="{{ asset('assets/images/logoZoffice2.ico') }}"> --}}
      <!-- App favicon -->
      <link rel="shortcut icon" href="{{ asset('apkclaim/images/logo150.ico') }}">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/menudis.css') }}" rel="stylesheet">
    <link href="{{ asset('sky16/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('sky16/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('sky16/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
      <!-- Bootstrap CSS -->
     
      <link href="{{ asset('sky16/css/bootstrap.min.css') }}" rel="stylesheet" />
      <link href="{{ asset('sky16/css/bootstrap-extended.css') }}" rel="stylesheet" />
      <link href="{{ asset('sky16/css/style.css') }}" rel="stylesheet" />
</head>
<?php
if (Auth::check()) {
   $type = Auth::user()->type;
   $iduser = Auth::user()->id;
} else {
   echo "<body onload=\"TypeAdmin()\"></body>";
   exit();
}
$url = Request::url();
$pos = strrpos($url, '/') + 1;
 
?>
<style>
      * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          font-family: 'Edu VIC WA NT Beginner', cursive;
      }

      
</style>
<body  >
  <nav class="navbar navbar-expand-md navbar-light me-5">
    <div class="container-fuid">
        <a href="{{url("setting/setting_index")}}" target="_blank">  
          <i class="fa-solid fa-3x fa-gear text-danger" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="ตั้งค่า"></i>
        </a>
      <br>
        <a class="navbar-brand" href="{{ url('admin/home') }}">
            {{-- {{ config('app.name', 'Laravel') }} --}}
            {{-- <img src="{{ asset('apkclaim/images/logo150.png') }}" alt="logo-sm-light" height="40"> --}}
          <label for="" style="color: white;font-size:25px;" class="ms-2 mt-2 text-center">PR-Restaurant</label>
            {{-- class="ms-2 mt-2">PKClaim</label> --}}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon" ></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          @if (Auth::user()->img == null)
                          <img src="{{ asset('assets/images/default-image.jpg') }}" height="32px" width="32px"
                              alt=" " class="rounded-circle header-profile-user me-3">
                      @else
                          <img src="{{ asset('storage/person/' . Auth::user()->img) }}" height="32px"
                              width="32px" alt=" " class="rounded-circle header-profile-user me-3">
                      @endif
                      <label for="" style="color: white" >{{ Auth::user()->fname }}   {{ Auth::user()->lname }}</label>
                          
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
  <div class="menu">
    <div class="toggle">  
      <img src="{{ asset('assets/images/restaurant_cup.png') }}" alt="logo-sm-light" height="220">
    </div> 
    <li style="--i:0;">
      <a href="{{url("person/person_index")}}" target="_blank">
        <i class="fa-solid fa-3x fa-cash-register text-primary " data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="แคชเชียร์"></i>
      </a> 
    </li>
    <li style="--i:1;">
      <a href="{{url("kitchen")}}" target="_blank"> 
        <i class="fa-solid fa-3x fa-kitchen-set text-secondary" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="ห้องครัว"></i> 
      </a>
    </li>
    
    <li style="--i:2;">
      <a href="{{url("car/car_narmal_calenda")}}" target="_blank">
        <i class="fa-solid fa-3x fa-file-invoice text-info" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="สั่งซื้อ"></i>
      </a> 
    </li> 
    <li style="--i:3;">
      <a href="{{url("meetting/meettingroom_dashboard")}}" target="_blank"> 
        <i class="fa-solid fa-3x fa-store text-success" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="คลัง"></i>
      </a>
    </li>
    <li style="--i:4;">
      <a href="" target="_blank"> 
        <i class="fa-solid fa-3x fa-address-book text-danger" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="ลูกค้า"></i>
      </a> 
    </li>
    <li style="--i:5;">
      <a href="{{url('reserve_table')}}" target="_blank"> 
        <i class="fa-solid fa-3x fa-pen-nib text-info" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="จองโต๊ะ"></i>
      </a> 
    </li>
   
  </div> 
  <footer class="footer ms-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                {{-- <script>
                    document.write(new Date().getFullYear())
                </script> --}}
                 <label for="" style="color: white">2022 © PR-Restaurant</label> 
            </div>
            
        </div>
        <div class="row">
          <div class="col-sm-12 text-center"> 
               <label for="" style="color: white"> By Dekbanbanproject</label>
          </div>
          
      </div>
    </div>
</footer>
 
  <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>  
  <script src="{{ asset('sky16/js/jquery.min.js') }}"></script>
 <script src="{{ asset('sky16/js/app.js') }}"></script> 
   <script>
    let toggle = document.querySelector('.toggle');
    let menu = document.querySelector('.menu');
    toggle.onclick = function () {
      menu.classList.toggle('active');
    }
  </script>
</body>
</html>