@extends('layouts.admin_tem')
@section('title', 'PR-Restaurant || จัดการรายชื่อลูกค้า')
@section('content')
<script>
    function TypeAdmin() {
        window.location.href = "{{ route('index')}}";
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
        <div class="container">
           
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div class="row">
                        <div class="col-md-2 mt-4 mb-3">
                            <h5 style="color: white" >รายชื่อลูกค้า</h5>
                        </div>
                        <div class="col"></div>
                        <div class="col-md-2 mt-4 mb-3">
                            <a class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#saveModal2" style="color: rgb(241, 94, 8)">เพิ่มรายชื่อลูกค้า</a>
                        </div>
                    </div>                       
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
                                    <th style="color: white" width="20%">จัดการ</th> 
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
                                        <td style="color: white" width="20%">                                             
                                            <button type="button" class="btn btn-outline-warning edit_data" value="{{$item->id}}">
                                                {{-- <button type="button" class="btn btn-outline-warning edit_data" value="{{$item->id}}"> --}}
                                                <i class="fa-solid fa-pen-to-square "  style="color: rgb(248, 120, 16)"></i> 
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" href="javascript:void(0)" onclick="customer_destroy({{ $item->id }})" >
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
     <div class="modal fade" id="saveModal2" tabindex="-1" aria-labelledby="saveModal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="saveModal2Label">เพิ่มลูกค้า</h1>
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
 @endsection
