<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- load jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- provide the csrf token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Gehwol</title>

    <meta property="og:url"           content="@yield('meta-page-url')" />
    <meta property="og:type"          content="product" />
    <meta property="og:title"         content="@yield('meta-title')" />
    <meta property="og:description"   content="@yield('meta-description')" />
    <meta property="og:image"         content="@yield('meta-image-url')" />
</head>
<body>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId=711885369577776&autoLogAppEvents=1" nonce="HtikjlIx"></script>

<script async defer src="//assets.pinterest.com/js/pinit.js"></script>


    @include('components.header')

    @yield('content')

    @include('components.footer')

    @yield('scripts')
    <script src="{{ mix('js/app.js') }}"></script>



</body>
</html>
