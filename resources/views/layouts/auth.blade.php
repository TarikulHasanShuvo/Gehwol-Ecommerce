<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/auth.css') }}">
    <title>Gehwol</title>
</head>
<body>
@include('components.header')
<div class="auth_page">
    <div class="auth_page__accessuar first">
        <img src="{{ asset('img/auth_leaf_1.png') }}" width="100%" alt="">
    </div>
    <div class="auth_page__accessuar second">
        <img src="{{ asset('img/auth_almond_1.png') }}" width="100%" alt="">
    </div>
    <div class="auth_page__accessuar third">
        <img src="{{ asset('img/auth_almond_2.png') }}" width="100%" alt="">
    </div>
    <div class="auth_page__accessuar fourth">
        <img src="{{ asset('img/auth_almond_3.png') }}" width="100%" alt="">
    </div>
    <div class="auth_page__accessuar fiveth">
        <img src="{{ asset('img/auth_leaf_2.png') }}" width="100%" alt="">
    </div>
    <div class="container">
        <div class="auth_page__in">
            <div class="auth_page__left">
                @yield('content')
                <div class="auth_page__privacy">
                    <a href="#">Privacy Policy</a> and <a href="#">Terms of Service</a>
                </div>
            </div>
            <div class="auth_page__right">
                <img src="{{ asset('img/auth_page_image.png') }}" width="100%" alt="">
            </div>
        </div>
    </div>
</div>
@include('components.footer')

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>