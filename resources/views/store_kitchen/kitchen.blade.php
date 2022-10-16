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
    <link href="{{ asset('css/menudis.css') }}" rel="stylesheet">
    <link href="{{ asset('sky16/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('sky16/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('sky16/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />

        <!-- DataTables -->
        <link href="{{ asset('apkclaim/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('apkclaim/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('apkclaim/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('apkclaim/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('sky16/css/bootstrap.min.css') }}" rel="stylesheet" />
 
</head>
<script>
    function TypeAdmin() {
        window.location.href = '{{ route('index') }}';
    }
    function customer_destroy(id) {
        Swal.fire({
            title: 'ต้องการลบรายการนี้ใช่ไหม?',
            text: "รายการนี้จะถูกลบไปเลย !!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#06D177',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบเดี๋ยวนี้ !',
            cancelButtonText: 'ไม่, ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('customer_destroy') }}" + '/' + id,
                    type: 'delete',
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'ลบรายการนี้สำเร็จ!',
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

            <div class="btn-group dropend">
                <button type="button" class="btn btn-outline-info dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                      ห้องครัว
                </button>
                <ul class="dropdown-menu">
                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                            data-bs-target="#saveModal1">เพิ่มเมนูอาหาร</a>
                        
                    <li> 
                    </li> 
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
    </nav>
    <div class="menu3">
        <div class="container-fluid ">
            <h3 align="center" style="color: white">เมนูอาหาร</h3>
            <br />
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="panel-body" >
                    <div class="table-responsive">
                        @csrf
                        {{-- <table class="table table-hover"> --}}
                            {{-- <table class="table table-hover" id="editable"  > --}}
                                <table class="table table-hover" id="example"  >
                            <thead >
                                <tr>
                                    <th style="color: white">ลำดับ</th>
                                    <th style="color: white">ชื่อ</th>
                                    <th style="color: white">นามสกุล</th>
                                    <th style="color: white">เบอร์โทร</th> 
                                    <th style="color: white" width="30%">จัดการ</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($users as $item)
                                    <tr >
                                        <td style="color: white">{{ $i++ }}</td>
                                        <td style="color: white">{{ $item->fname }}</td>
                                        <td style="color: white">{{ $item->lname }}</td>
                                        <td style="color: white">{{ $item->tel }}</td>
                                        <td style="color: white" width="30%">                                             
                                            <button type="button" class="btn btn-outline-warning edit_data" value="{{$item->id}}">
                                                {{-- <button type="button" class="btn btn-outline-warning edit_data" value="{{$item->id}}"> --}}
                                                <i class="fa-solid fa-pen-to-square "  style="color: rgb(248, 120, 16)"></i> 
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm" href="javascript:void(0)" onclick="customer_destroy({{ $item->id }})" >
                                                <i class="fa-solid fa-trash-can text-danger"></i> 
                                            </button>
                                        </td>
                                    </tr>

                                    

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Modal saveModal1-->
     <div class="modal fade" id="saveModal1" tabindex="-1" aria-labelledby="saveModal1Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="saveModal1Label">เพิ่มลูกค้า</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fnme" class="form-label">ชื่อ</label>
                            <input type="text" class="form-control" id="fname"
                                name="fname">
                        </div> 
                        <div class="col-md-6 mb-3">
                            <label for="lname" class="form-label">นามสกุล</label>
                            <input type="text" class="form-control" id="lname"
                                name="lname">
                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="tel" class="form-label">เบอร์โทร</label>
                            <input type="text" class="form-control" id="tel"
                                name="tel">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="save_Customer" class="btn btn-primary btn-sm">
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
      <div class="modal fade" id="updteModal" tabindex="-1" aria-labelledby="updteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updteModalLabel">แก้ไขลูกค้า</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
               
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fname" class="form-label">ชื่อ</label>
                            <input type="text" class="form-control" id="editfname"
                                name="fname">
                        </div> 
                        <div class="col-md-6 mb-3">
                            <label for="lname" class="form-label">นามสกุล</label>
                            <input type="text" class="form-control" id="editlname"
                                name="lname" >
                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tel" class="form-label">Username</label>
                            <input type="text" class="form-control" id="editusername"
                                name="username" >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tel" class="form-label">เบอร์โทร</label>
                            <input type="text" class="form-control" id="edittel"
                                name="tel" >
                        </div>
                    </div>
                </div>

                <input type="hidden" class="form-control" id="editid" name="id" >
                <div class="modal-footer">
                    <button type="button" id="updateBtn" class="btn btn-primary btn-sm"> 
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        Update
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                            class="fa-solid fa-xmark me-2"></i>Close</button>
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

            $('#save_Customer').click(function() {
                var fname = $('#fname').val();
                var lname = $('#lname').val();
                var tel = $('#tel').val();
                var id = $('#id').val();
                //    alert(fname);
                $.ajax({
                    url: "{{route('cus.customer_save') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        fname,
                        lname,
                        tel,
                        id
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

           
            $('#updateBtn').click(function() {
                var fname = $('#editfname').val();
                var lname = $('#editlname').val();
                var tel = $('#edittel').val(); 
                var username = $('#editusername').val(); 
                var id = $('#editid').val(); 
                //    alert(fname); 
                $.ajax({
                    url: "{{route('cus.customer_update') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        fname,
                        lname,
                        tel,
                        username,
                        id
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            // alert('gggggg');
                            Swal.fire({
                                title: 'แก้ไขข้อมูลสำเร็จ',
                                text: "You edit data success",
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

            // $('#editable').Tabledit({
            //     url: '{{ route('tabledit.action') }}',
            //     dataType: "json",
            //     columns: {
            //         identifier: [0, 'id'],
            //         editable: [
            //             [1, 'fname'],
            //             [2, 'lname'],
            //             [3, 'tel']
            //         ]
            //         // editable:[[1, 'fname'], [2, 'lname'], [3, 'tel', '{"1":"Male", "2":"Female"}']]
            //     },
            //     restoreButton: false,
            //     onSuccess: function(data, textStatus, jqXHR) {
            //         if (data.action == 'delete') {
            //             $('#' + data.id).remove();
            //         }
            //     }
            // });

        });
    </script>
    <script>
         $(document).on('click', '.edit_data', function() {
                var id = $(this).val(); 
                //  alert(id);
                $('#updteModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "{{ url('customer_edit') }}" + '/' + id,
                    success: function(res) {
                        $('#editlname').val(res.datauser.lname)
                        $('#editfname').val(res.datauser.fname)
                        $('#edittel').val(res.datauser.tel)
                        $('#editusername').val(res.datauser.username)
                        $('#editid').val(res.datauser.id)
                    },
                });
            });
         $('#updteModalCus').on('submit', function(e) {
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
                                    window.location.reload();
                                    // window.location =
                                    //     "{{ url('supplies/supplies_index') }}"; // กรณี add page new   
                                }
                            })
                        }
                    }
                });
            });

    </script>
</body>

</html>
