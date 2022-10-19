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
    <link href="{{ asset('apkclaim/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('apkclaim/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('apkclaim/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('sky16/css/bootstrap.min.css') }}" rel="stylesheet" />

</head>
<script>
    // function TypeAdmin() {
    //     window.location.href = '{{ route('index') }}';
    // }

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


<body> 
        <div class="container">
            <h3 align="center" style="color: white">รายการที่สั่ง</h3>
            <br />
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        @csrf 
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr>
                                    <th style="color: white">ลำดับ</th>
                                    <th style="color: white">โต๊ะ</th>
                                    <th style="color: white">รูปอาหาร</th>
                                    <th style="color: white">เมนู</th>
                                    <th style="color: white">จำนวน</th>
                                    <th style="color: white">สถานะ</th>
                                    <th style="color: white" width="30%">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <?php $i = 1; ?>
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
                                        <td style="color: white" width="30%">
                                            
                                                <button type="button" class="btn btn-outline-warning" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updteModal{{ $item->menukitchen_id }}">
                                                <i class="fa-solid fa-pen-to-square "
                                                    style="color: rgb(248, 120, 16)"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm"
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
                                    
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
   
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
            
        
        });
    </script>
    <script></script>
</body>

</html>
