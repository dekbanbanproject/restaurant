<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
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
    body {
        font-family: 'Kanit', sans-serif;
        font-size: 13px;

    }

    label {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;

    }

    @media only screen and (min-width: 1200px) {
        label {
            /* float:right; */
        }

    }

    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    .dataTables_wrapper .dataTables_filter {
        float: right
    }

    .dataTables_wrapper .dataTables_length {
        float: left
    }

    .dataTables_info {
        float: left;
    }

    .dataTables_paginate {
        float: right
    }

    .custom-tooltip {
        --bs-tooltip-bg: var(--bs-primary);


    }

    .table thead tr th {
        font-size: 14px;
    }

    .table tbody tr td {
        font-size: 13px;
    }

    .menu {
        font-size: 13px;
    }
</style>

<body>
    <nav class="navbar navbar-expand-md navbar-light me-5">
        <div class="container-fuid">
            <div class="btn-group dropend">
                <button type="button" class="btn btn-outline-info dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    ADD TABLE
                </button>
                <ul class="dropdown-menu">
                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                            data-bs-target="#saveModal1">เพิ่มโต๊ะ</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">แก้ไข/ลบ</a></li>
                </ul>
            </div>
            <br>
            <a class="navbar-brand" href="{{ url('admin/home') }}">
                <label for="" style="color: white;font-size:25px;"
                    class="ms-2 mt-2 text-center">PR-Restaurant</label>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if (Auth::user()->img == null)
                                    <img src="{{ asset('assets/images/default-image.jpg') }}" height="32px" width="32px"
                                        alt=" " class="rounded-circle header-profile-user me-3">
                                @else
                                    <img src="{{ asset('storage/person/' . Auth::user()->img) }}" height="32px"
                                        width="32px" alt=" " class="rounded-circle header-profile-user me-3">
                                @endif
                                <label for="" style="color: white">{{ Auth::user()->fname }}
                                    {{ Auth::user()->lname }}</label>

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
    <div class="menu4">
        @yield('content')
    </div>

    <footer class="footer ms-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
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

 



    @yield('footer')


    <script src="{{ asset('apkclaim/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('apkclaim/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('apkclaim/libs/select2/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
       $(document).ready(function() { 
          $('table_update').on('submit', function(e) {
                  e.preventDefault();
  
                  var form = this;
                  // alert('OJJJJOL');
                  $.ajax({
                      url: $(form).attr('action'),
                      method: $(form).attr('method'),
                      data: new FormData(form),
                      processData: false,
                      dataType: 'json',
                      contentType: false,
                      beforeSend: function() {
                          $(form).find('span.error-text').text('');
                      },
                      success: function(data) {
                          if (data.status == 0) {
  
                          } else {
                              Swal.fire({
                                  title: 'แก้ไขข้อมูลสำเร็จ',
                                  text: "You edit data success",
                                  icon: 'success',
                                  showCancelButton: false,
                                  confirmButtonColor: '#06D177',
                                  // cancelButtonColor: '#d33',
                                  confirmButtonText: 'เรียบร้อย'
                              }).then((result) => {
                                  if (result.isConfirmed) {
                                      window.location
                                    .reload();
                                      // window.location =
                                      //     "{{ url('supplies/supplies_index') }}"; // กรณี add page new   
                                  }
                              })
                          }
                      }
                  });
              });
      });
  </script>
</body>

</html>
