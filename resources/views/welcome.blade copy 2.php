<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

       

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>Restaurant</title>
  
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

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

          
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
    </body>
</html>
