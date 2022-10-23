@extends('layouts.admin_tem')
@section('title', 'PR-Restaurant || จัดการโต๊ะ')
@section('content')
<script>
    function TypeAdmin() {
        window.location.href = "{{ route('index')}}";
    }
    function updatetable(table_group_1_id) {
        Swal.fire({
            title: 'ต้องการจองโต๊ะนี้ใช่ไหม?',
            text: "ระบบจะทำการจองให้ทันที !!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#06D177',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, จองเดี๋ยวนี้ !',
            cancelButtonText: 'ไม่, ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('updatetable') }}" + '/' + table_group_1_id,
                    type: 'POST',
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'จองโต๊ะนี้สำเร็จ!',
                            text: "You Update data success",
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
    function canceltable(table_group_1_id) {
        Swal.fire({
            title: 'ต้องการยกเลิกโต๊ะนี้ใช่ไหม?',
            text: "โต๊ะนี้จะถูกเปลี่ยนสีให้เลย !!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ยกเลิกเดี๋ยวนี้ !',
            cancelButtonText: 'ไม่, ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('canceltable') }}" + '/' + table_group_1_id,
                    type: 'POST',
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'ยกเลิกโต๊ะนี้สำเร็จ!',
                            text: "You Cancel data success",
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
        <div class="row">
            <div class="col-md-6 mt-4">
                <div class="card-body">
                    <div class="row" >
                        <?php $i = 1; ?>
                        @foreach ($table_group_1 as $item1)
                            @if ($item1->table_group_1_active == 'TRUE')
                                <div class="col-6 col-md-2 col-xl-2 me-2 mt-2" >
                                    <button type="button" class="btn btn-outline-danger"
                                        href="javascript:void(0)"
                                        onclick="canceltable({{ $item1->table_group_1_id }})"
                                        value="{{ $item1->table_group_1_id }}" style="height: 90px;">
                                        <div class="card-body shadow"
                                            style="background-color: rgba(255, 6, 6, 0.301)">
                                            <label for=""
                                                style="font-size:27px;color: rgb(255, 240, 241)">{{ $item1->table_group_1_name }}</label>
                                        </div>
                                    </button>
                                </div>
                            @else
                                <div class="col-6 col-md-2 col-xl-2 me-2 mt-2" id="sid{{ $item1->table_group_1_id }}">
                                    <button type="button" class="btn btn-outline-info" href="javascript:void(0)"
                                        onclick="updatetable({{ $item1->table_group_1_id }})"
                                        value="{{ $item1->table_group_1_id }}" style="height: 90px;">
                                        <div class="card-body shadow"
                                            style="background-color: rgba(240, 248, 255, 0.253)">
                                            <label for=""
                                                style="font-size:27px;color: rgb(240, 248, 255)">{{ $item1->table_group_1_name }}</label>
                                        </div>
                                    </button>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-4">
                <div class="card-body">
                    <div class="row" >
                        <?php $i = 1; ?>
                        @foreach ($table_group_1B as $item2)
                            @if ($item2->table_group_1_active == 'TRUE')
                                <div class="col-6 col-md-2 col-xl-2 me-2 mt-2" >
                                    <button type="button" class="btn btn-outline-danger"
                                        href="javascript:void(0)"
                                        onclick="canceltable({{ $item2->table_group_1_id }})"
                                        value="{{ $item2->table_group_1_id }}" style="height: 90px;">
                                        <div class="card-body shadow"
                                            style="background-color: rgba(255, 6, 6, 0.301)">
                                            <label for=""
                                                style="font-size:27px;color: rgb(255, 240, 241)">{{ $item2->table_group_1_name }}</label>
                                        </div>
                                    </button>
                                </div>
                            @else
                                <div class="col-6 col-md-2 col-xl-2 me-2 mt-2" id="sid{{ $item2->table_group_1_id }}">
                                    <button type="button" class="btn btn-outline-success" href="javascript:void(0)"
                                        onclick="updatetable({{ $item2->table_group_1_id }})"
                                        value="{{ $item2->table_group_1_id }}" style="height: 90px;">
                                        <div class="card-body shadow"
                                            style="background-color: rgba(240, 248, 255, 0.253)">
                                            <label for=""
                                                style="font-size:27px;color: rgb(240, 248, 255)">{{ $item2->table_group_1_name }}</label>
                                        </div>
                                    </button>
                                </div>
                            @endif
                        @endforeach

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
                                <option value="">--เลือกผู้ดูแล--</option>
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
 
    @endsection
    @section('footer')

    <script>
        $(document).ready(function() {

            $('select').select2();
            $('#user_id').select2({
                dropdownParent: $('#saveModal1')
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
 

        });
    </script>
 @endsection
