<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('apkclaim/images/logo150.ico') }}">
    <link href="{{ asset('apkclaim/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('apkclaim/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('apkclaim/libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('apkclaim/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/fontawesome/css/all.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/menudis.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('sky16/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('sky16/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('sky16/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />

    <!-- DataTables -->
    <link href="{{ asset('apkclaim/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('apkclaim/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('apkclaim/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('apkclaim/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('sky16/css/bootstrap.min.css') }}" rel="stylesheet" />
</head>
<style>
     body { 
    width: 100%;
    height: 100vh;
    background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)),
        url(/restaurant/public/assets/images/restaurant_2.jpg)no-repeat 50%; 
    background-size: cover;
    /* background-attachment: fixed; */
    /* display: flex; */
    /* align-items: center; */
    /* justify-content: center; */

}
</style>

<body>
    {{-- <nav class="navbar navbar-expand-md navbar-light me-5">
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
               
                <ul class="navbar-nav me-auto">

                </ul>
               
                <ul class="navbar-nav ms-auto">
                   
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
    </nav> --}}
  
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container">
            <a class="navbar-brand" href="#" style="color: rgb(241, 94, 8)">PR-Restaurant</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"> 
                        <a href="{{url('reserve_table_edit')}}" class="btn btn-outline-warning btn-sm">จัดการโต๊ะนั่ง</a>
                    </li>
                    <li class="nav-item ms-3"> 
                        <a href="{{url('customerinfo')}}" class="btn btn-outline-info btn-sm">จัดการรายชื่อลูกค้า</a>
                    </li>
                    <li class="nav-item ms-3"> 
                        <a href="{{url('kitchen')}}" class="btn btn-outline-success btn-sm">จัดการเมนูอาหาร</a>
                    </li>
                    <li class="nav-item ms-3"> 
                        <a href="{{url('order_back')}}" class="btn btn-outline-primary btn-sm">จัดการรายการสั่งซื้อ</a>
                    </li>
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: rgb(241, 94, 8)">
                    จัดการโต๊ะนั่ง
                    </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#saveModal1" style="color: rgb(241, 94, 8)">เพิ่มโต๊ะ</a></li> 
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{url('reserve_table_edit')}}" style="color: rgb(241, 94, 8)">แก้ไข/ลบ</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: rgb(241, 94, 8)">
                        จัดการรายชื่อลูกค้า
                    </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#saveModal2" style="color: rgb(241, 94, 8)">เพิ่มลูกค้า</a></li> 
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{url('reserve_table_edit')}}" style="color: rgb(241, 94, 8)">แก้ไข/ลบ</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: rgb(241, 94, 8)">
                        จัดการเมนูอาหาร
                    </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#saveModal3" style="color: rgb(241, 94, 8)">เพิ่มเมนูอาหาร</a></li> 
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{url('reserve_table_edit')}}" style="color: rgb(241, 94, 8)">แก้ไข/ลบ</a></li>
                    </ul>
                </li> --}}
                
                </ul>
                <ul class="navbar-nav ms-auto">
                    
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
                                <label for="" style="color: rgb(241, 94, 8)">{{ Auth::user()->fname }}
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

        <main class="page-content">
            @yield('content')
        </main>

        {{-- <footer class="footer mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <label for="" style="color: white">2022 © PR-Restaurant</label>
                    </div>
               
                    <div class="col">
                      
                    </div>
                    <div class="col-sm-2 text-center">
                        <label for="" style="color: white"> By Dekbanbanproject</label>
                    </div>
                </div>
            </div>
        </footer> --}}
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top mb-3 me-3 ms-3">
            <div class="col-md-6 d-flex align-items-center">
              
                <span class="mb-3 mb-md-0 text-muted"> 
                    2022 &copy; PR-Restaurant
                </span>                        
            </div>
        
            <ul class="nav col-md-6 justify-content-end list-unstyled d-flex">
                <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-2x fa-instagram"></i></a></li> 
                <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-2x fa-facebook"></i></a></li>
            </ul>
            <br>
        </footer>
 
    <script src="{{ asset('apkclaim/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('apkclaim/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('apkclaim/libs/select2/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script> --}}
     <!-- Required datatable js -->
     <script src="{{ asset('apkclaim/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
     <script src="{{ asset('apkclaim/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
 
     <!-- Buttons examples -->
     <script src="{{ asset('apkclaim/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
     <script src="{{ asset('apkclaim/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
     <script src="{{ asset('apkclaim/libs/jszip/jszip.min.js') }}"></script>
     <script src="{{ asset('apkclaim/libs/pdfmake/build/pdfmake.min.js') }}"></script>
     <script src="{{ asset('apkclaim/libs/pdfmake/build/vfs_fonts.js') }}"></script>
     <script src="{{ asset('apkclaim/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
     <script src="{{ asset('apkclaim/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
     <script src="{{ asset('apkclaim/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
 
     <script src="{{ asset('apkclaim/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
     <script src="{{ asset('apkclaim/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
 
     <!-- Responsive examples -->
     <script src="{{ asset('apkclaim/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
     <script src="{{ asset('apkclaim/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    @yield('footer')

<script>
        $(document).ready(function() {
            $('#example').DataTable();
            $('#example2').DataTable();            
        });
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        // $(document).ready(function() { 
        //    $('#table_update').on('submit', function(e) {
        //            e.preventDefault();
    
        //            var form = this;
                   
        //            $.ajax({
        //                url: $(form).attr('action'),
        //                method: $(form).attr('method'),
        //                data: new FormData(form),
        //                processData: false,
        //                dataType: 'json',
        //                contentType: false,
        //                beforeSend: function() {
        //                    $(form).find('span.error-text').text('');
        //                },
        //                success: function(data) {
        //                    if (data.status == 0) {
    
        //                    } else {
        //                        Swal.fire({
        //                            title: 'แก้ไขข้อมูลสำเร็จ',
        //                            text: "You edit data success",
        //                            icon: 'success',
        //                            showCancelButton: false,
        //                            confirmButtonColor: '#06D177',
        //                            // cancelButtonColor: '#d33',
        //                            confirmButtonText: 'เรียบร้อย'
        //                        }).then((result) => {
        //                            if (result.isConfirmed) {
        //                                window.location
        //                              .reload();
        //                                // window.location =
        //                                //     "{{ url('supplies/supplies_index') }}"; // กรณี add page new   
        //                            }
        //                        })
        //                    }
        //                }
        //            });
        //        });
        // });
</script>

   
</body>

</html>
