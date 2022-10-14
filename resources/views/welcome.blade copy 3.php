<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Font Awesome -->
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('apkclaim/images/logo150.ico') }}">
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/styledis.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('bt52/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('bt52/js/bootstrap.bundle.min.js') }}" />
    <link href="{{ asset('apkclaim//libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('apkclaim//libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('apkclaim//libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('apkclaim//libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Edu VIC WA NT Beginner', cursive;
    }
</style>
<body>
    <div class="menu2">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="row" >
                            <?php $i = 1; ?>
                            @foreach ($table_group_1 as $item1)
                                @if ($item1->table_group_1_active == 'TRUE')
                                    <div class="col-6 col-md-2 col-xl-2 me-2" >
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
                                    <div class="col-6 col-md-2 col-xl-2 me-2" id="sid{{ $item1->table_group_1_id }}">
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
            </div>
            {{-- <div class="row">
                <div class="col-md-5">
                    <div class="card-body">
                        <div class="row mb-3 justify-content-center">

                            <div class="col-6 col-md-4 col-xl-3 mt-3">
                                <div class="card-body shadow">
                                    <a href="{{ url('home') }}" class="nav-link text-dark text-center">
                                        <i class="fa-solid fa-3x fa-1 text-info"></i>
                                        <br>
                                        <label for="" class="mt-2">ว่าง</label>
                                    </a>
                                </div>
                            </div>
                        
                        </div>
                    
                    </div>
                </div>          
            </div> --}}

            

            <div class="container">
                <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <div class="col-md-4 d-flex align-items-center">
                    {{-- <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                    <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
                    </a> --}}
                    <span class="mb-3 mb-md-0 text-muted">
                        <a href="{{ route('login') }}"><i class="fa-solid fa-2x fa-fingerprint me-3"></i></a>  &copy; 2022 DFood, POS</span>
                        
                </div>
            
                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-2x fa-instagram"></i></a></li>
                    <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-2x fa-twitter"></i></a></li>
                    <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-2x fa-facebook"></i></a></li>
                </ul>
                </footer>
            </div>
        </div>
    </div> 

<!-- Modal -->
<div class="modal fade" id="vipModal" tabindex="-1" aria-labelledby="vipModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="vipModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <hr>
  <h2 class="fs-5">Tooltips in a modal</h2>
  <p><a href="#" data-bs-toggle="tooltip" title="Tooltip">This link</a> and <a href="#" data-bs-toggle="tooltip" title="Tooltip">that link</a> have tooltips on hover.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    
    <script src="{{ asset('apkclaim/libs/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('bt52/js/bootstrap.min.js') }}" />
    <script src="{{ asset('apkclaim/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('apkclaim/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('apkclaim/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('apkclaim/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('apkclaim/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('apkclaim/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('apkclaim/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
    <script src="{{ asset('apkclaim/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('apkclaim/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ asset('apkclaim/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
        <script> 
            $(document).ready(function() {
                // $('#example').DataTable(); 

                $('select').select2();
                $('#ECLAIM_STATUS').select2({
                    dropdownParent: $('#detailclaim')
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // $('#saveBtn').click(function() {

                //     var plan_type_name = $('#plan_type_name').val();
                //     // alert(plan_type_name);
                //     $.ajax({
                //         url: "",
                //         type: "POST",
                //         dataType: 'json',
                //         data: {
                //             plan_type_name
                //         },
                //         success: function(data) {
                //             if (data.status == 200) {
                //                 // alert('gggggg');
                //                 Swal.fire({
                //                     title: 'บันทึกข้อมูลสำเร็จ',
                //                     text: "You Insert data success",
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

                $(document).on('click', '.edit_data', function() {
                    var plan_type_id = $(this).val();
                    // alert(plan_type_id);
                    $('#vipModal').modal('show');
                    $.ajax({
                        type: "GET",
                        // url: "" + '/' + plan_type_id,
                        success: function(data) {
                            console.log(data.type.plan_type_name);
                            // $('#editplan_type_name').val(data.type.plan_type_name)
                            // $('#editplan_type_id').val(data.type.plan_type_id)
                        },
                    });
                });
                
                // $('#updateBtn').click(function() {
                //     var plan_type_id = $('#editplan_type_id').val();
                //     var plan_type_name = $('#editplan_type_name').val();
                //     $.ajax({
                //         url: "",
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
                              
            });
           
        </script>    
    

</body>

</html>
