<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elxan Bəşirov | Admin</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{asset('backend/css/style.min.css')}}">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render={{env('RECAPTCHA_KEY')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

</head>

<body>
<div class="layer"></div>
@yield('content')
<!-- Chart library -->
<script src="{{asset('backend/plugins/chart.min.js')}}"></script>
<!-- Icons library -->
<script src="{{asset('backend/plugins/feather.min.js')}}"></script>
<!-- Custom scripts -->
<script src="{{asset('backend/js/script.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

@stack('js')
</body>

</html>
