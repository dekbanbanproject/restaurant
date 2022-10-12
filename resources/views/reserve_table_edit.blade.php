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
    <link href="{{ asset('apkclaim//libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('apkclaim//libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('apkclaim//libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('apkclaim//libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/menudis.css') }}" rel="stylesheet">
    <link href="{{ asset('sky16/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('sky16/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('sky16/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->

    <link href="{{ asset('sky16/css/bootstrap.min.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('sky16/css/bootstrap-extended.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('sky16/css/style.css') }}" rel="stylesheet" />  --}}
</head>
<script>
    function TypeAdmin() {
        window.location.href = '{{ route('index') }}';
    }
    function delettable(table_group_1_id) {
        Swal.fire({
            title: 'ต้องการลบโต๊ะนี้ใช่ไหม?',
            text: "โต๊ะนี้จะถูกลบไปเลย !!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#06D177',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบเดี๋ยวนี้ !',
            cancelButtonText: 'ไม่, ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('table_group_1_destroy') }}" + '/' + table_group_1_id,
                    type: 'delete',
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'ลบโต๊ะนี้สำเร็จ!',
                            text: "You Delete data success",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#06D177',
                            // cancelButtonColor: '#d33',
                            confirmButtonText: 'เรียบร้อย'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // $("#sid" + table_group_1_id).remove();
                                window.location.reload();
                                //   window.location = "/person/person_index"; //     
                            }
                        })
                    }
                })
            }
        })
    }
   
</script>
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

<body>
    <nav class="navbar navbar-expand-md navbar-light me-5">
        <div class="container-fuid">
            {{-- <a href="{{ url('setting/setting_index') }}" target="_blank">
                <i class="fa-solid fa-2x fa-gear text-danger" data-bs-toggle="tooltip" data-bs-placement="left"
                    data-bs-title="ตั้งค่า"></i>
            </a>  <br> --}}
            {{-- <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                จองโต๊ะ
            </button> --}}
            <!-- Default dropend button -->
            <div class="btn-group dropend">
                <button type="button" class="btn btn-outline-info dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    ZONE A
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


    <div class="menu2">
        
        <div class="container-fluid ">

            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="row" >
                            <?php $i = 1; ?>
                            @foreach ($table_group_1 as $item1) 
                                
                                    <div class="col-6 col-md-2 col-xl-2 me-2 ms-2" id="sid{{ $item1->table_group_1_id }}">
                                        <button type="button" class="btn btn-outline-warning" style="height: 105px;">
                                            <div class="card-body shadow" style="background-color: rgba(240, 248, 255, 0.253)">
                                                <label for="" style="font-size:25px;color: rgb(240, 248, 255)">{{ $item1->table_group_1_name }} </label>  แก้ไข                                                
                                            </div>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm" href="javascript:void(0)" onclick="delettable({{ $item1->table_group_1_id }})" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                        ลบ {{ $item1->table_group_1_name }}
                                        </button>
                                        <hr style="background-color: rgb(255, 255, 255)">
                                    </div>
                                   
                                
                            @endforeach

                        </div>
                    </div>
                </div>
                
            </div>
        </div>
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

    <!-- Modal saveModal1-->
    <div class="modal fade" id="saveModal1" tabindex="-1" aria-labelledby="saveModal1Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="saveModal1Label">จัดการโต๊ะนั่ง</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="table_group_1_name" class="form-label">ชื่อโต๊ะ</label>
                            <input type="text" class="form-control" id="table_group_1_name"
                                name="table_group_1_name">
                        </div>
                        <input type="hidden" class="form-control" id="table_group_1_zone" name="table_group_1_zone"
                            value="A">
                        <div class="col-md-12 mb-3">
                            <select id="user_id" name="user_id" class="form-control form-control-sm input-rounded"
                                style="width: 100%">
                                <option value="">--เลือก--</option>
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}"> {{ $u->fname }} {{ $u->lname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="save_table_group_1" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        Save
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                            class="fa-solid fa-xmark me-2"></i>Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal updteModal-->
    {{-- <div class="modal fade" id="updteModal" tabindex="-1" aria-labelledby="updteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updteModalLabel">จัดการโต๊ะนั่ง</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="table_group_1_name" class="form-label">ชื่อโต๊ะ</label>
                            <input type="text" class="form-control" id="edit_table_group_1_name"
                                name="edit_table_group_1_name">
                        </div>
                        <input type="hidden" class="form-control" id="edit_table_group_1_zone"
                            name="edit_table_group_1_zone" value="1">
                        <div class="col-md-12 mb-3">
                            <select id="user_id" name="user_id" class="form-control form-control-sm input-rounded"
                                style="width: 100%">
                                <option value="">--เลือก--</option>
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}"> {{ $u->fname }} {{ $u->lname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="updateBtn" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        Save
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                            class="fa-solid fa-xmark me-2"></i>Close</button>
                </div>
            </div>
        </div>
    </div> --}}

    <script src="{{ asset('apkclaim/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('apkclaim/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('apkclaim/libs/select2/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            $('select').select2();
            $('#user_id').select2({
                dropdownParent: $('#saveModal1')
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#save_table_group_1').click(function() {

                var table_group_1_name = $('#table_group_1_name').val();
                var table_group_1_zone = $('#table_group_1_zone').val();
                var user_id = $('#user_id').val();
                // alert(table_group_1_name);
                $.ajax({
                    url: "{{ route('zone.table_group_1_save') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        table_group_1_name,
                        table_group_1_zone,
                        user_id
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            // alert('gggggg');
                            Swal.fire({
                                title: 'บันทึกข้อมูลสำเร็จ',
                                text: "You Insert data success",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#06D177',
                                confirmButtonText: 'เรียบร้อย'
                            }).then((result) => {
                                if (result
                                    .isConfirmed) {
                                    console.log(
                                        data);

                                    window.location
                                        .reload();
                                }
                            })
                        } else {

                        }

                    },
                });
            });

            // $(document).on('click', '.edit_data', function() {
            //     var table_group_1_id = $(this).val(); 
            //     $('#updteModal').modal('show');
            //     $.ajax({
            //         type: "GET",
            //         url: "{{ url('table_group_1_edit') }}" + '/' + table_group_1_id,
            //         success: function(data) {
            //             $('#edit_table_group_1_zone').val(data.type.edit_table_group_1_zone)
            //             $('#edit_table_group_1_name').val(data.type.edit_table_group_1_name)
            //             $('#table_group_1_id').val(data.type.table_group_1_id)
            //         },
            //     });
            // });

            // $('#updateBtn').click(function() {
            //     var plan_type_id = $('#editplan_type_id').val();
            //     var plan_type_name = $('#editplan_type_name').val();
            //     $.ajax({
            //         url: "{{ route('zone.table_group_1_update') }}",
            //         type: "POST",
            //         dataType: 'json',
            //         data: {
            //             plan_type_id,
            //             plan_type_name
            //         },
            //         success: function(data) {
            //             if (data.status == 200) {
            //                 Swal.fire({
            //                     title: 'แก้ไขข้อมูลสำเร็จ',
            //                     text: "You edit data success",
            //                     icon: 'success',
            //                     showCancelButton: false,
            //                     confirmButtonColor: '#06D177',
            //                     confirmButtonText: 'เรียบร้อย'
            //                 }).then((result) => {
            //                     if (result
            //                         .isConfirmed) {
            //                         console.log(
            //                             data);

            //                         window.location
            //                             .reload();
            //                     }
            //                 })
            //             } else {

            //             }

            //         },
            //     });
            // });

            // function updatetable(table_group_1_id) {
            //     Swal.fire({
            //         title: 'ต้องการลบใช่ไหม?',
            //         text: "ข้อมูลนี้จะถูกลบไปเลย !!",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'ใช่, ลบเดี๋ยวนี้ !',
            //         cancelButtonText: 'ไม่, ยกเลิก'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             $.ajax({
            //                 url: "{{ url('updatetable') }}" + '/' + table_group_1_id,
            //                 type: 'DELETE',
            //                 data: {
            //                     _token: $("input[name=_token]").val()
            //                 },
            //                 success: function(response) {
            //                     Swal.fire({
            //                         title: 'ลบข้อมูล!',
            //                         text: "You Delet data success",
            //                         icon: 'success',
            //                         showCancelButton: false,
            //                         confirmButtonColor: '#06D177',
            //                         // cancelButtonColor: '#d33',
            //                         confirmButtonText: 'เรียบร้อย'
            //                     }).then((result) => {
            //                         if (result.isConfirmed) {
            //                             $("#sid" + table_group_1_id).remove();
            //                             window.location.reload();
            //                             //   window.location = "/person/person_index"; //     
            //                         }
            //                     })
            //                 }
            //             })
            //         }
            //     })
            // }
           

        });
    </script>
</body>

</html>
