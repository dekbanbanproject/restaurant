@extends('layouts.admin_tem')
@section('title', 'PR-Restaurant || Cashier')
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

 
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mt-4">
                <div class="card-body">
                    <div class="row" >
                        <?php $i = 1; ?>
                        @foreach ($table_group_1 as $item1)
                            @if ($item1->table_group_1_active == 'TRUE')
                                <div class="col-6 col-md-2 col-xl-2 ms-3 me-3 mt-2" >
                                    <a class="btn btn-outline-danger"
                                        href="{{url('cashier_pay/'.$item1->table_group_1_id)}}" style="height: auto;width: auto">
                                        <div class="card-body shadow"
                                            style="background-color: rgba(255, 6, 6, 0.301)">
                                            <label for=""
                                                style="font-size:27px;color: rgb(255, 240, 241)">{{ $item1->table_group_1_name }}</label>
                                        </div>
                                    </a>
                                </div>
                            @else
                                <div class="col-6 col-md-2 col-xl-2 ms-3 me-3 mt-2" id="sid{{ $item1->table_group_1_id }}">
                                    <a class="btn btn-outline-info" href="" style="height: auto;width: auto">
                                        <div class="card-body shadow"
                                            style="background-color: rgba(240, 248, 255, 0.253)">
                                            <label for=""
                                                style="font-size:27px;color: rgb(240, 248, 255)">{{ $item1->table_group_1_name }}</label>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <div class="card-body">
                    <div class="row" >
                        <?php $i = 1; ?>
                        @foreach ($table_group_1B as $item2)
                            @if ($item2->table_group_1_active == 'TRUE')
                                <div class="col-6 col-md-2 col-xl-2 ms-3 me-3 mt-2" >
                                    <a class="btn btn-outline-danger"
                                        href="{{url('cashier_pay/'.$item1->table_group_1_id)}}" style="height: auto;width: auto">
                                        <div class="card-body shadow"
                                            style="background-color: rgba(255, 6, 6, 0.301)">
                                            <label for=""
                                                style="font-size:27px;color: rgb(255, 240, 241)">{{ $item2->table_group_1_name }}</label>
                                        </div>
                                    </a>
                                </div>
                            @else
                                <div class="col-6 col-md-2 col-xl-2 ms-3 me-3 mt-2" id="sid{{ $item2->table_group_1_id }}">
                                    <a class="btn btn-outline-success" href="" style="height: auto;width: auto">
                                        <div class="card-body shadow"
                                            style="background-color: rgba(240, 248, 255, 0.253)">
                                            <label for=""
                                                style="font-size:27px;color: rgb(240, 248, 255)">{{ $item2->table_group_1_name }}</label>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <div class="table-responsive">
                    @csrf 
                    <table class="table table-hover">
                        <thead >
                            <tr>
                                <th style="color: white">ลำดับ</th>
                                <th style="color: white">รายการอาหาร</th> 
                                <th style="color: white">จำนวน</th> 
                                <th style="color: white">ราคา</th> 
                                <th style="color: white">ส่วนลด</th> 
                                <th style="color: white">รวม</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                                @foreach ($order_rep as $item3)
                                    <tr >
                                        <td style="color: white">{{ $i++ }}</td>
                                        <td style="color: white"> 
                                            <img src="{{ asset('storage/menu/'. $item3->img) }}" height="110px" width="110px" alt="Image" class="img-thumbnail">
                                        </td> 
                                        <td style="color: white">{{ $item3->order_rep_qty }}</td> 
                                        <td style="color: white">{{ $item3->order_rep_price }}</td> 
                                        <td style="color: white">{{ $item3->order_rep_discount }}</td> 
                                        <td style="color: white">{{ $item3->order_rep_total }}</td> 
                                    </tr>
                                   
                                @endforeach
                        </tbody>
                        <tr>
                            <td colspan="2" style="color: white;" class="text-end">รวมทั้งหมด</td>
                            <td style="color: white">{{$countqty}}</td>
                            <td style="color: white"> </td>
                            <td style="color: white"></td>
                            <td style="color: white">{{$totaldata}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @endsection
    @section('footer')

    <script>
        $(document).ready(function() {
 
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
