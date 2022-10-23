@extends('layouts.admin_tem')
@section('title', 'PR-Restaurant || จัดการโต๊ะ')
@section('content')
<script>
    function TypeAdmin() {
        window.location.href = "{{ route('index')}}";
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
  
        <div class="container-fluid ">
            <h3 align="center" style="color: white">ชื่อโต๊ะ</h3>
            <br />
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="panel-body" >
                    <div class="table-responsive">
                        @csrf 
                                <table class="table table-hover" id="example"  >
                            <thead >
                                <tr>
                                    <th style="color: white">ลำดับ</th>
                                    <th style="color: white">QRCODE</th> 
                                    <th style="color: white">ชื่อโต๊ะ</th> 
                                    <th style="color: white" width="30%">จัดการ</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($table_group_1 as $item)
                                    <tr >
                                        <td style="color: white">{{ $i++ }}</td>
                                        <td style="color: white">
                                            {{-- {!! QrCode::size(50)->generate($item->table_group_1_name); !!}  --}}
                                            {!! QrCode::size(100)->generate(asset('order_add/'.$item->table_group_1_name)); !!} 
                                        </td> 
                                        <td style="color: white">{{ $item->table_group_1_name }}</td> 
                                        <td style="color: white" width="40%">                                             
                                            {{-- <button type="button" class="btn btn-outline-warning edit_data" data-bs-toggle="modal" data-bs-target="#updteModal{{$item->table_group_1_id}}">  --}}
                                            <a href="{{url('table_qrcode/'.$item->table_group_1_id)}}" class="btn btn-outline-primary"> 
                                                <i class="fa-solid fa-print"  style="color: rgb(5, 165, 245)"></i> 
                                            </a>
                                            <button type="button" class="btn btn-outline-warning " data-bs-toggle="modal" data-bs-target="#updteModal{{$item->table_group_1_id}}"> 
                                                <i class="fa-solid fa-pen-to-square "  style="color: rgb(248, 120, 16)"></i> 
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm" href="javascript:void(0)" onclick="delettable({{ $item->table_group_1_id }})" >
                                                <i class="fa-solid fa-trash-can text-danger"></i> 
                                            </button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="updteModal{{$item->table_group_1_id}}" tabindex="-1" aria-labelledby="updteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="updteModalLabel">แก้ไขโต๊ะนั่ง</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="custom-validation" action="{{ route('zone.table_group_1_update') }}" method="POST"
                                                    id="table_update" enctype="multipart/form-data">
                                                    @csrf

                                                    <input type="hidden" name="table_group_1_id" id="edittable_group_1_id" value="{{$item->table_group_1_id}}">
            
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="table_group_1_name" class="form-label">ชื่อโต๊ะ</label>
                                                            <input type="text" class="form-control" id="edit_table_group_1_name"
                                                                name="table_group_1_name" value="{{$item->table_group_1_name}}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="table_group_1_zone" class="form-label">เลือกโซน</label>
                                                            <select id="table_group_1_zone" name="table_group_1_zone" class="form-control form-control-sm input-rounded" style="width: 100%">
                                                                <option value="">--ZONE--</option> 
                                                                @if ($item->table_group_1_zone == 'A' )
                                                                <option value="A" selected>--ZONE A--</option>
                                                                <option value="B">--ZONE B--</option>
                                                                <option value="C" >--ZONE C--</option>  
                                                                <option value="D">--ZONE D--</option>
                                                                @elseif ($item->table_group_1_zone == 'B')
                                                                <option value="B" selected>--ZONE B--</option>
                                                                <option value="A">--ZONE A--</option>
                                                                <option value="C" >--ZONE C--</option>  
                                                                <option value="D">--ZONE D--</option>
                                                                @elseif ($item->table_group_1_zone == 'C')
                                                                <option value="C" selected>--ZONE C--</option>   
                                                                <option value="A">--ZONE A--</option>
                                                                <option value="B">--ZONE B--</option> 
                                                                <option value="D">--ZONE D--</option>                                                          
                                                                @else
                                                                <option value="A">--ZONE A--</option>
                                                                <option value="B">--ZONE B--</option>
                                                                <option value="C" >--ZONE C--</option>   
                                                                <option value="D" selected>--ZONE D--</option>
                                                                @endif
                                                              
                                                                
                                                            </select>
                                                        </div>
                                                        {{-- <input type="hidden" class="form-control" id="edit_table_group_1_zone"
                                                            name="edit_table_group_1_zone" value="1"> --}}

                                                        <div class="col-md-12 mb-3">
                                                            <select id="edituser_id" name="user_id" class="form-control form-control-sm input-rounded"
                                                                style="width: 100%">
                                                                <option value="">--เลือก--</option>
                                                                @foreach ($users as $u)
                                                                @if ($item->user_id == $u->id)
                                                                <option value="{{ $u->id }}" selected> {{ $u->fname }} {{ $u->lname }} </option>
                                                                @else
                                                                <option value="{{ $u->id }}"> {{ $u->fname }} {{ $u->lname }} </option>
                                                                @endif
                                                                    
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" id="updateBtn" class="btn btn-primary btn-sm">
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
                        <div class="col-md-6 mb-3">
                            <label for="table_group_1_name" class="form-label">ชื่อโต๊ะ</label>
                            <input type="text" class="form-control" id="table_group_1_name"
                                name="table_group_1_name">
                        </div> 
                        <div class="col-md-6 mb-3">
                            <label for="table_group_1_name" class="form-label">เลือกโซน</label>
                            <select id="table_group_1_zone" name="table_group_1_zone" class="form-control form-control-sm input-rounded"
                                style="width: 100%">
                                <option value="">--ZONE--</option>
                                <option value="A">--ZONE A--</option>
                                <option value="B">--ZONE B--</option>
                                <option value="C">--ZONE C--</option>
                                <option value="D">--ZONE D--</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
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

    {{-- @endsection --}}
    {{-- @section('footer') --}}
 
    {{-- <script src="{{ asset('apkclaim/libs/select2/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    --}}

    <script>
    //     $(document).ready(function() { 
    //        $('#table_update').on('submit', function(e) {
    //                e.preventDefault();
    
    //                var form = this;
    //                // alert('OJJJJOL');
    //                $.ajax({
    //                    url: $(form).attr('action'),
    //                    method: $(form).attr('method'),
    //                    data: new FormData(form),
    //                    processData: false,
    //                    dataType: 'json',
    //                    contentType: false,
    //                    beforeSend: function() {
    //                        $(form).find('span.error-text').text('');
    //                    },
    //                    success: function(data) {
    //                        if (data.status == 0) {
    
    //                        } else {
    //                            Swal.fire({
    //                                title: 'แก้ไขข้อมูลสำเร็จ',
    //                                text: "You edit data success",
    //                                icon: 'success',
    //                                showCancelButton: false,
    //                                confirmButtonColor: '#06D177',
    //                                // cancelButtonColor: '#d33',
    //                                confirmButtonText: 'เรียบร้อย'
    //                            }).then((result) => {
    //                                if (result.isConfirmed) {
    //                                    window.location
    //                                  .reload();
    //                                    // window.location =
    //                                    //     "{{ url('supplies/supplies_index') }}"; // กรณี add page new   
    //                                }
    //                            })
    //                        }
    //                    }
    //                });
    //            });
    //    });
    </script>
    <script>
        $(document).ready(function() { 


            $('#example').DataTable();
            $('#example2').DataTable();
             

            $('select').select2();
            $('#user_id').select2({
                dropdownParent: $('#saveModal1')
            });
            $('#edituser_id').select2({
                dropdownParent: $('#updteModal')
            });
            $('#table_group_1_zone').select2({
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
                var user_id = $('#edituser_id').val();
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

            $(document).on('click', '.edit_data', function() {
                var table_group_1_id = $(this).val(); 
                $('#updteModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "{{ url('table_group_1_edit') }}" + '/' + table_group_1_id,
                    success: function(data) {
                        $('#edit_table_group_1_zone').val(data.type.edit_table_group_1_zone)
                        $('#edit_table_group_1_name').val(data.type.edit_table_group_1_name)
                        $('#table_group_1_id').val(data.type.table_group_1_id)
                    },
                });
            });

            $('#updateBtn').click(function() {
                var table_group_1_id = $('#edittable_group_1_id').val();
                var table_group_1_name = $('#edit_table_group_1_name').val();
                var user_id = $('#edit_table_group_1_name').val();
                $.ajax({
                    url: "{{ route('zone.table_group_1_update') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        table_group_1_id,
                        table_group_1_name
                    },
                    success: function(data) {
                        if (data.status == 200) {
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

         
           

        });
       
    </script>
 @endsection
