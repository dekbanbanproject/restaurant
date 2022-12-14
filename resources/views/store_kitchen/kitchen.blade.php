
@extends('layouts.admin_tem')
@section('title', 'PR-Restaurant || จัดการเมนูอาหาร')
@section('content')
<script>
    function TypeAdmin() {
        window.location.href = "{{ route('index')}}";
    }
    
    function kitchen_destroy(menukitchen_id) {
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
                    url: "{{ url('kitchen_destroy') }}" + '/' + menukitchen_id,
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
                                $("#sid" + menukitchen_id).remove();
                                window.location.reload();
                                //   window.location = "/person/person_index"; //     
                            }
                        })
                    }
                })
            }
        })
    }

    function addpic(input) {
        var fileInput = document.getElementById('img');
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext ==
                "jpg")) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#add_upload_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            alert('กรุณาอัพโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
            fileInput.value = '';
            return false;
        }
    }
    function editpic(input) {
      var fileInput = document.getElementById('img');
      var url = input.value;
      var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
          if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
              var reader = new FileReader();    
              reader.onload = function (e) {
                  $('#edit_upload_preview').attr('src', e.target.result);
              }    
              reader.readAsDataURL(input.files[0]);
          }else{    
              alert('กรุณาอัพโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
              fileInput.value = '';
              return false;
              }
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

 
    {{-- <nav class="navbar navbar-expand-md navbar-light me-5">
        <div class="container-fuid">

            <div class="btn-group dropend">
                <button type="button" class="btn btn-outline-info dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    ห้องครัว
                </button>
                <ul class="dropdown-menu">
                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#saveModal1">เพิ่มเมนูอาหาร</a>

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
    </nav> --}}
 
        <div class="container">
            {{-- <h3 align="center" style="color: white" class="mt-4">เมนูอาหาร</h3>
            <br /> --}}
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div class="row">
                        <div class="col-md-2 mt-4 mb-3">
                            <h5 style="color: white" >เมนูอาหาร</h5>
                        </div>
                        <div class="col"></div>
                        <div class="col-md-2 mt-4 mb-3">
                            <a class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#saveModalmenu" style="color: rgb(241, 94, 8)">เพิ่มเมนูอาหาร</a>
                        </div>
                    </div>                       
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        @csrf 
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr>
                                    <th style="color: white">ลำดับ</th>
                                    <th style="color: white">barcode</th>
                                    <th style="color: white">รูปอาหาร</th>
                                    <th style="color: white">เมนู</th>
                                    <th style="color: white">ราคาต้นทุน</th>
                                    <th style="color: white">ราคาขาย</th>
                                    <th style="color: white" width="20%">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($menukitchen as $item)
                                    <tr id="sid{{ $item->menukitchen_id }}">
                                        <td style="color: white">{{ $i++ }}</td>
                                        <td class="text-center" width="10%">
                                            <?php
                                            $generator = new \Picqer\Barcode\BarcodeGeneratorJPG();
                                            $Pi = '<img src="data:image/jpeg;base64,' . base64_encode($generator->getBarcode($item->menukitchen_code, $generator::TYPE_CODE_128, 2, 30)) . '" height="30px" width="95%" > ';
                                            echo $Pi;
                                            ?>

                                            <label for=""
                                                style="color: white">{{ $item->menukitchen_code }}</label>

                                        </td>
                                        <td style="color: white">
                                            <img src="{{ asset('storage/menu/' . $item->img) }}" height="70px"
                                                width="70px" alt="Image" class="img-thumbnail">
                                        </td>
                                        <td style="color: white">{{ $item->menukitchen_name }}</td>
                                        <td style="color: white">{{ $item->menukitchen_pricecost }}</td>
                                        <td style="color: white">{{ $item->menukitchen_pricesale }}</td>
                                        <td style="color: white" width="20%">
                                            {{-- <button type="button" class="btn btn-outline-warning edit_data" value="{{ $item->menukitchen_id }}"> --}}
                                                <button type="button" class="btn btn-outline-warning" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updteModal{{ $item->menukitchen_id }}">
                                                <i class="fa-solid fa-pen-to-square "
                                                    style="color: rgb(248, 120, 16)"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger "
                                                href="javascript:void(0)"
                                                onclick="kitchen_destroy({{ $item->menukitchen_id }})">
                                                <i class="fa-solid fa-trash-can text-danger"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal updteModal-->
                                    <div class="modal fade" id="updteModal{{ $item->menukitchen_id }}" tabindex="-1" aria-labelledby="updteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="updteModalLabel">แก้ไขเมนูอาหาร</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form class="custom-validation" action="{{ route('menu.kitchen_update') }}" method="POST"
                                                id="menu_update" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3"> 
                                                                @if ( $item->img == Null )
                                                                <img src="{{asset('assets/images/default-image.jpg')}}" id="edit_upload_preview" height="300px" width="300px" alt="Image" class="img-thumbnail">
                                                                @else
                                                                <img src="{{asset('storage/menu/'.$item->img)}}" id="edit_upload_preview" height="300px" width="300px" alt="Image" class="img-thumbnail">
                                                               <!--   <td> <img src="data:image/jpg;base64,{{chunk_split(base64_encode($item->img)) }}" height="60px" width="60px"></td> -->
                                                                @endif  
                                                            <br>
                                                            <input type="file" class="form-control" id="img" name="img"
                                                                onchange="editpic(this)">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <div class="row">
                                                                <div class="col-md-12 mt-2">
                                                                    <label for="menukitchen_code" class="form-label">barcode เมนู</label>
                                                                    <input type="text" class="form-control" id="editmenukitchen_code"
                                                                        name="menukitchen_code" value="{{$item->menukitchen_code}}">
                                                                </div>
                                                                <div class="col-md-12 mt-2">
                                                                    <label for="menukitchen_name" class="form-label">ชื่อเมนู</label>
                                                                    <input type="text" class="form-control" id="editmenukitchen_name"
                                                                        name="menukitchen_name" value="{{$item->menukitchen_name}}">
                                                                </div>
                                                                <div class="col-md-12 mt-2">
                                                                    <label for="menukitchen_pricecost" class="form-label">ราคาทุน</label>
                                                                    <input type="text" class="form-control" id="editmenukitchen_pricecost"
                                                                        name="menukitchen_pricecost" value="{{$item->menukitchen_pricecost}}">
                                                                </div>
                                                                <div class="col-md-12 mt-2">
                                                                    <label for="menukitchen_pricesale" class="form-label">ราคาขาย</label>
                                                                    <input type="text" class="form-control" id="editmenukitchen_pricesale"
                                                                        name="menukitchen_pricesale" value="{{$item->menukitchen_pricesale}}">
                                                                </div>
                                                                <div class="col-md-12 mt-2">
                                                                    <label for="menukitchen_category" class="form-label">ประเภทอาหาร</label> 
                                                                    <select id="menukitchen_category" name="menukitchen_category" class="form-control form-control-sm input-rounded" style="width: 100%">
                                                                        <option value="">--ประเภทอาหาร--</option> 
                                                                       @foreach ($menukitchen_category as $itemcat)
                                                                       @if ($item->menukitchen_category == $itemcat->menukitchen_category_id)
                                                                       <option value="{{$itemcat->menukitchen_category_id}}" selected>{{$itemcat->menukitchen_category_name}}</option> 
                                                                       @else
                                                                       <option value="{{$itemcat->menukitchen_category_id}}">{{$itemcat->menukitchen_category_name}}</option> 
                                                                       @endif
                                                                      
                                                                       @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                
                                                <input type="hidden" class="form-control" id="editmenukitchen_id" name="menukitchen_id" value="{{$item->menukitchen_id}}">
                                
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        <i class="fa-solid fa-floppy-disk me-2"></i>
                                                        Update
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                                                            class="fa-solid fa-xmark me-2"></i>Close</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal saveModalmenu-->
    <div class="modal fade" id="saveModalmenu" tabindex="-1" aria-labelledby="saveModalmenuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="saveModalmenuLabel">เพิ่มเมนูอาหาร</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="custom-validation" action="{{ route('menu.kitchen_save') }}" method="POST"
                        id="menu_insert" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <img src="{{ asset('assets/images/default-image.jpg') }}" id="add_upload_preview"
                                    alt="Image" class="img-thumbnail" width="300px" height="300px">
                                <br>
                                <input type="file" class="form-control" id="img" name="img"
                                    onchange="addpic(this)">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="row">
                                    <div class="col-md-12 mt-2">
                                        <label for="menukitchen_code" class="form-label">barcode เมนู</label>
                                        <input type="text" class="form-control" id="menukitchen_code"
                                            name="menukitchen_code">
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="menukitchen_name" class="form-label">ชื่อเมนู</label>
                                        <input type="text" class="form-control" id="menukitchen_name"
                                            name="menukitchen_name">
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="menukitchen_pricecost" class="form-label">ราคาทุน</label>
                                        <input type="text" class="form-control" id="menukitchen_pricecost"
                                            name="menukitchen_pricecost">
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="menukitchen_pricesale" class="form-label">ราคาขาย</label>
                                        <input type="text" class="form-control" id="menukitchen_pricesale"
                                            name="menukitchen_pricesale">
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="menukitchen_category" class="form-label">ประเภทอาหาร</label> 
                                        <select id="menukitchen_category" name="menukitchen_category" class="form-control form-control-sm input-rounded" style="width: 100%">
                                            <option value="">--ประเภทอาหาร--</option> 
                                           @foreach ($menukitchen_category as $itemcat)
                                           <option value="{{$itemcat->menukitchen_category_id}}">{{$itemcat->menukitchen_category_name}}</option> 
                                           @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        Save
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                            class="fa-solid fa-xmark me-2"></i>Close</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    @endsection
    @section('footer') 
  
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
           

            $('#menu_insert').on('submit', function(e) {
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
                                title: 'เพิ่มข้อมูลสำเร็จ',
                                text: "You Insert data success",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#06D177',
                                // cancelButtonColor: '#d33',
                                confirmButtonText: 'เรียบร้อย'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();

                                }
                            })
                        }
                    }
                });
            });
           
            $('#menu_update').on('submit', function(e) {
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
                                text: "You Edit data success",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#06D177',
                                // cancelButtonColor: '#d33',
                                confirmButtonText: 'เรียบร้อย'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();

                                }
                            })
                        }
                    }
                });
            });
           
        });
    </script>
 
    @endsection
