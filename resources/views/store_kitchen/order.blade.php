<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PR - Restaurant </title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('apkclaim/images/logo150.ico') }}">
    <link href="{{ asset('apkclaim/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('apkclaim/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('apkclaim/libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('apkclaim/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/fontawesome/css/all.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/menudis.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/menufooddis.css') }}" rel="stylesheet">
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
    

    function order_destroy(order_rep_id) {
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
                    url: "{{ url('order_destroy') }}" + '/' + order_rep_id,
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
                                $("#sid" + order_rep_id).remove();
                                window.location.reload();
                                //   window.location = "/person/person_index"; //     
                            }
                        })
                    }
                })
            }
        })
    }

    
    function order_update(order_rep_id) {
        Swal.fire({
            title: 'ต้องการยกเลิกรายการนี้ใช่ไหม?',
            text: "รายการนี้จะถูกยกเลิกไปเลย !!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#06D177',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ยกเลิกเดี๋ยวนี้ !',
            cancelButtonText: 'ไม่, ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('order_update') }}" + '/' + order_rep_id,
                    type: 'POST',
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'ยกเลิกรายการนี้สำเร็จ!',
                            text: "You Cancel data success",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#06D177',
                            // cancelButtonColor: '#d33',
                            confirmButtonText: 'เรียบร้อย'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#sid" + order_rep_id).remove();
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


<body> 
        <div class="container">

            <div class="row"> 
                <div class="col-md-12 text-center mt-4">
                   
                    <label for="" class="justify-content-center" style="color: white;font-size:30px">PR - Restaurant</label>
                    <a href="{{ url('order/' . $table) }}" type="button" class="btn position-relative text-white">
                        <i class="fa-solid fa-2x fa-basket-shopping text-white me-2 ms-2"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info">
                            {{$countdata}} รายการ
                          <span class="visually-hidden">unread messages</span>
                        </span>
                        <span class="position-absolute top-100 start-100 translate-middle badge rounded-pill bg-danger">
                           รวม {{ number_format($totaldata,2) }} ฿
                            <span class="visually-hidden">unread messages</span>
                          </span>
                    </a>
                </div> 
            </div>

            <h3 class="text-center mt-3" style="color: white">รายการที่สั่ง</h3>
            <br />
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        @csrf 
                        <table class="table table-hover" id="example222">
                            <thead>
                                <tr>
                                    {{-- <th class="text-center" style="color: white">ลำดับ</th> --}}
                                    {{-- <th class="text-center" style="color: white">โต๊ะ</th> --}}
                                    {{-- <th class="text-center" style="color: white">รูปอาหาร</th> --}}
                                    <th class="text-center" style="color: white">รายการ</th>
                                    <th class="text-center" style="color: white">จำนวน</th>
                                    <th class="text-center" style="color: white">ราคา</th>
                                    <th class="text-center" style="color: white">รวม</th>
                                    <th class="text-center" style="color: white">สถานะ</th>
                                    <th class="text-center" style="color: white" >จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($order_rep as $item)
                                    <tr id="sid{{ $item->order_rep_id }}">
                                        {{-- <td style="color: white">{{ $i++ }}</td> --}}
                                        {{-- <td class="text-center" style="color: white" width="10%">{{ $item->table_group_1_name }} </td> --}}
                                        <td style="color: white">
                                            <img src="{{ asset('storage/menu/'. $item->img) }}" height="90px" width="90px" alt="Image" class="img-thumbnail">
                                             
                                            </td>
                                        {{-- <td style="color: white">{{ $item->menukitchen_name }}</td> --}}
                                        <td style="color: white" class="text-center">{{ $item->order_rep_qty }}</td>
                                        <td style="color: white" class="text-center">{{ $item->order_rep_price }}</td>
                                        <td style="color: white" class="text-center">{{ $item->order_rep_total }}</td>
                                        @if ($item->order_rep_active == 'PREORDER')
                                            <td class="text-center"><span class="badge text-dark" style="background-color: rgb(253, 5, 220)">รอยืนยัน</span></td>
                                        @elseif ($item->order_rep_active == 'ORDER')
                                            <td class="text-center"><span class="badge bg-info">กำลังดำเนินการ</span></td>
                                        @elseif ($item->order_rep_active == 'FINISH')
                                            <td class="text-center"><span class="badge bg-success">เรียบร้อย</span></td>
                                        @elseif ($item->order_rep_active == 'CANCEL')
                                            <td class="text-center"><span class="badge bg-danger">ยกเลิก</span></td>
                                        @else
                                        <td class="text-center"><span class="badge text-white" style="background-color: rgb(230, 38, 4)">ค้างชำระ</span></td>
                                        @endif
                                        
                                        {{-- <td style="color: white">{{ $item->order_rep_active }}</td> --}}
                                        <td style="color: white" class="text-center">                                            
                                            {{-- <button type="button" class="btn btn-outline-warning" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updteModal{{ $item->menukitchen_id }}">
                                            <i class="fa-solid fa-pen-to-square "
                                                    style="color: rgb(248, 120, 16)"></i>
                                            </button> --}}
                                            @if ($item->order_rep_active == 'PREORDER')
                                                <a href="javascript:void(0)" onclick="order_update({{ $item->order_rep_id }})">
                                                    <i class="fa-solid fa-trash-can text-danger"></i>
                                                </a>
                                            @elseif ($item->order_rep_active == 'CANCEL')
                                            <i class="fa-solid fa-rectangle-xmark text-danger"></i> 
                                            @elseif ($item->order_rep_active == 'STALE')
                                            <i class="fa-solid fa-rectangle-xmark text-white" style="background-color: rgb(230, 38, 4)"></i> 
                                            @else 
                                                <i class="fa-solid fa-circle-check text-success"></i>
                                            @endif
                                            
                                        </td>
                                    </tr>

                                    <!-- Modal updteModal-->
                                    {{--<div class="modal fade" id="updteModal{{ $item->menukitchen_id }}" tabindex="-1" aria-labelledby="updteModalLabel" aria-hidden="true">
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
                                    </div>--}}
                                    
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top mb-3">
                <div class="col-md-6 d-flex align-items-center">
                  
                    <span class="mb-3 mb-md-0 text-muted">
                        {{-- <a href="{{ route('login') }}"><i class="fa-solid fa-2x fa-fingerprint me-4 ms-4"></i></a>  --}}
                        {{-- <a href="{{ url('order/'.$table) }}"><i class="fa-solid fa-2x fa-utensils me-4 ms-4"></i></a> --}}
                        <a href="{{ url('order_add/'.$table) }}"><i class="fa-solid fa-2x fa-utensils me-4 ms-4"></i></a>
                        2022 &copy; PR-Restaurant
                    </span>                        
                </div>
            
                <ul class="nav col-md-6 justify-content-end list-unstyled d-flex">
                    <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-2x fa-instagram"></i></a></li>
                    {{-- <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-2x fa-twitter"></i></a></li> --}}
                    <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-2x fa-facebook"></i></a></li>
                </ul>
                <br>
        </footer>
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
