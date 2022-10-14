<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Font Awesome -->
    <link href="{{ asset('assets/fontawesome/css/all.css') }}" rel="stylesheet">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('apkclaim/images/logo150.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Edu+VIC+WA+NT+Beginner&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/fontawesome/css/all.css') }}" rel="stylesheet">

    <link href="{{ asset('sky16/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('sky16/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('sky16/css/style.css') }}" rel="stylesheet" />
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Edu VIC WA NT Beginner', cursive;
    }

    body {
        width: 100%;
        height: 100vh;
        background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)),
            url(/restaurant/public/assets/images/restaurant.jpg)no-repeat 50%;
        /* url(/assets/images/restaurant.jpg)no-repeat 50%; */ 
        background-size: cover;
        background-attachment: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .container {
        position: relative;
    }

    .form {
        position: relative;
        z-index: 100;
        width: 500px;
        height: 500px;
        background-color: rgba(240, 248, 255, 0.158);
        border-radius: 20px;
        backdrop-filter: blur(2px);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .logo {
        width: 200px;
        height: 200px;
        background:
            url(/restaurant/public/assets/images/restaurant_cup.png)no-repeat 50%;
        /* url(/assets/images/restaurant_cup.png)no-repeat 25%; */
        background-size: cover;
        /* background-attachment: fixed; */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .h1 {
        color: rgb(255, 255, 255);
        font-weight: 500;
        margin-bottom: 20px;
        font-size: 50px;
        margin-top: 20px;
    }

    .username {
        width: 250px;
        background: none;
        outline: none;
        border: none;
        margin: 15px 0px;
        border-bottom: rgba(240, 248, 255, 0.418) 1px solid;
        padding: 10px;
        color: aliceblue;
        font-size: 18px;
        transition: 0.2s ease-in-out;
        margin-top: 50px;
    }

    .password {
        width: 250px;
        background: none;
        outline: none;
        border: none;
        margin: 5px 0px;
        border-bottom: rgba(240, 248, 255, 0.418) 1px solid;
        padding: 10px;
        color: aliceblue;
        font-size: 18px;
        transition: 0.2s ease-in-out;
    }

    ::placeholder {
        color: rgba(255, 255, 255, 0.582);
    }

    ::focus {
        border-bottom: aliceblue 1px solid;
    }

    .fa-solid {
        transition: 0.2s ease-in-out;
        color: rgba(240, 248, 255, 0.59);
        margin-right: 10px;
        /* margin-top: 50px; */
    }

    .btn {
        width: 120px;
        height: 40px;
        margin-top: 30px;
        font-weight: 500;
        color: aliceblue;
        outline: none;
        border: none;
        background: rgba(240, 248, 255, 0.2);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        font-size: 20px;
        transition: 0.2s;
    }

    .footer {
        width: 400px;
        height: 40px;
        margin-top: 100px;
        font-weight: 500;
        color: aliceblue;
        outline: none;
        border: none;
        background: rgba(240, 248, 255, 0.2);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        font-size: 20px;
        transition: 0.2s;
    }

    &::hover {
        background: aliceblue;
        color: gray;
        font-weight: 500;
    }

    .circle1 {
        position: absolute;
        width: 290px;
        height: 290px;
        background: rgba(240, 248, 255, 0.1);
        border-radius: 50%;
        top: 60%;
        left: 75%;
        z-index: -1;
        animation: float 2s 0.5s ease-in-out infinite;
    }

    .circle2 {
        position: absolute;
        width: 170px;
        height: 170px;
        background: rgba(240, 248, 255, 0.1);
        border-radius: 50%;
        top: -15%;
        right: 25%;
        z-index: -1;
        animation: float 2s ease-in-out infinite;
    }

    .circle3 {
        position: absolute;
        width: 220px;
        height: 220px;
        background: rgba(240, 248, 255, 0.1);
        border-radius: 50%;
        top: 50%;
        right: 80%;
        z-index: -1;
        animation: float 2s 0.7s ease-in-out infinite;
    }

    @keyframes float {
        0% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }

        100% {
            transform: translateY(0);
        }
    }
</style>

<body>
    <div class="container">
        <div class="circle1"> </div>
            <div class="circle2"> </div>
            <div class="circle3"> </div>
        <div class="row">
            <div class="col"></div>
            <div class="col-md-4">
            
            <form method="POST" action="{{ route('login') }}" class="form">
                @csrf
                <div class="logo"> </div>
                <!-- <h1 class="h1">Login</h1> -->
                <div>
                    <i class="fa-solid fa-user"></i>
                    <input type="text" placeholder="Username" name="username" class="username" required>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div>
                    <i class="fa-solid fa-key"></i>
                    <input type="password" placeholder="Password" name="password" class="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
            <div class="col"></div>
        </div>
        <div class="row mt-3"> 
            <div class="col-md-12 text-center">              
                 <label for="" class=" ms-5" style="color: white">2022 © PR-Restaurant</label> 
            </div> 
        </div>
        <div class="row text-center"> 
            <div class="col-md-12 "> 
                <label for="" class=" ms-5" style="color: white"> By Dekbnbnproject</label>
            </div>       
        </div>
    </div>
     

</body>

</html>
