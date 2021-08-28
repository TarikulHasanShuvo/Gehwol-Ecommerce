<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/iconly/bold.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/app.css')}}">
    <link rel="shortcut icon" href="{{asset('backend/images/favicon.svg" type="image/x-icon')}}">
</head>

<body>
    <div id="wrapper">
        @include('backend.components.sidebar')
        <div id="main">
            <div id="app">
                @include('backend.components.header')
                <!-- Container fluid  -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                @include('backend.components.footer')
            </div>
        </div>
    </div>
    <script src="{{asset('backend/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('backend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('backend/vendors/apexcharts/apexcharts.js')}}"></script>
    @stack('dashboard-scripts')
    <script src="{{asset('backend/js/main.js')}}"></script>
    @stack('js')
</body>

</html>