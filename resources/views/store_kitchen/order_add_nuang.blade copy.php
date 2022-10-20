<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta http-equiv="refresh" content="10"> --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('apkclaim/images/logo150.ico') }}">
    <link href="{{ asset('apkclaim//libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('apkclaim//libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('apkclaim//libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('apkclaim//libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/menufooddis.css') }}" rel="stylesheet">
    <link href="{{ asset('sky16/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('sky16/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('sky16/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->

    <link href="{{ asset('sky16/css/bootstrap.min.css') }}" rel="stylesheet" />

</head>


<body>
 
    <div class="container">
        <div class="row"> 
            <div class="col-md-12 text-center mt-2">
               
                <label for="" class="justify-content-center" style="color: white;font-size:30px">PR - Restaurant</label>
                <i class="fa-solid fa-2x fa-house text-white me-3 ms-4"></i>
                <a href="{{url('order/'.$table)}}"><i class="fa-solid fa-2x fa-basket-shopping text-white me-2"></i></a>
            </div> 
        </div>
        <hr  style="color: white">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills" id="ex1" role="tablist">

                    <li class="nav-item" role="presentation"> 
                        <a class="nav-link " href="{{url('order_add/'.$table)}} " ><label class="xl" style="color: white">อาหารประเภทต้ม</label> </a>
                    </li>
                    <li class="nav-item" role="presentation"> 
                        <a class="nav-link " href=" {{url('order_add_phad/'.$table)}}" >&nbsp;&nbsp;<label class="xl" style="color: white">อาหารประเภทผัด</label>&nbsp;&nbsp; </a>
                    </li>
                    <li class="nav-item" role="presentation"> 
                        <a class="nav-link " href="{{url('order_add_tod/'.$table)}} " >&nbsp;<label class="xl" style="color: white">อาหารประเภททอด</label>&nbsp;</a>
                    </li>
                    <li class="nav-item" role="presentation"> 
                        <a class="nav-link " href="{{url('order_add_drink/'.$table)}}" ><label class="xl" style="color: white">เครื่องดื่ม</label> </a>
                    </li>
                    <li class="nav-item" role="presentation"> 
                        <a class="nav-link active bg-warning" href="{{url('order_add_nuang/'.$table)}}" ><label class="xl" style="color: white">ประเภทนึ่ง</label> </a>
                    </li> 
                    <li class="nav-item" role="presentation"> 
                        <a class="nav-link" href="{{url('order_add_sod/'.$table)}}" ><label class="xl" style="color: white">ประเภทอาหารสด</label> </a>
                    </li>  
                    <li class="nav-item" role="presentation"> 
                        <a class="nav-link" href="{{url('order_add_pingyang/'.$table)}}" ><label class="xl" style="color: white">ประเภทปิ้งย่าง</label> </a>
                    </li>                 
                </ul>
            </div>
        </div>
        <hr  style="color: white">
     <!-- Pills content -->
     <div class="tab-content" id="ex1-content">
        <div class="tab-pane fade show active" id="ex1-pills-1" role="tabpanel" aria-labelledby="ex1-tab-1" >
            <div class="row">
                @foreach ($menukitchen as $item)
                    <div class="col-6 col-md-6 col-xl-6">
                        <div class="card-body">
                            <button class="btn btn-outline-danger" href=" " style="height: auto;">
                                <div class="card-body shadow" style="background-color: rgba(41, 198, 246, 0.301)" style="width: auto;">
                                    <img src="{{ asset('storage/menu/' . $item->img) }}" height="140px" width="140px"
                                        alt="Image" class="img-thumbnail" data-bs-toggle="modal" data-bs-target=".addModal{{$item->menukitchen_id}}"><br>
                                    <label for="" style="font-size:13px;color: rgb(255, 240, 241)">{{$item->menukitchen_name}}</label><br>
                                    <label for="" style="font-size:17px;color: rgb(255, 240, 241)">{{$item->menukitchen_pricesale}}.-</label>
                                </div>
                            </button>
                        </div>
                    </div>
                     <!-- Modal addModal-->
                     <div class="modal fade addModal{{$item->menukitchen_id}}" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addModalLabel">{{$item->menukitchen_name}}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="custom-validation" action="{{ route('or.order_save') }}" method="POST" id="order_saveForm" enctype="multipart/form-data">
                                    @csrf
                    
                                    <input type="hidden" name="menukitchen_id" id="menukitchen_id" class="form-control" value="{{$item->menukitchen_id}}">
                                    <input type="hidden" name="table" id="table" class="form-control" value="{{$table}}">
                                    <input type="hidden" name="price" id="price" class="form-control" value="{{$item->menukitchen_pricesale}}">
                                    
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12 mb-3"> 
                                                    <img src="{{ asset('storage/menu/' . $item->img) }}" height="300px" width="300px" alt="Image" class="img-thumbnail">
                                                </div>                                            
                                                <div class="col-md-12 mb-3">
                                                    <input type="number" class="form-control form-control-sm input-rounded" id="qty" name="qty">                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="save_table_group_1" class="btn btn-primary btn-sm">
                                                <i class="fa-solid fa-plus me-2"></i>
                                                เพิ่ม
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                                                    class="fa-solid fa-xmark me-2"></i>ยกเลิก</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
 
        <hr  style="color: white">
    </div>
    
  

    

    <script src="{{ asset('apkclaim/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('apkclaim/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('apkclaim/libs/select2/js/select2.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
           
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

         

        });
    </script>
 

</body>

</html>
