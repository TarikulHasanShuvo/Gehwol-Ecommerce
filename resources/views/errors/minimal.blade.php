<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ mix('css/errors.css') }}">
        <title>@yield('title')</title>

    </head>
    <body>
        <div class="wrapper error_page">
            <div class="error_page__title">
               Error @yield('code')
            </div>
            <div class="error_page__message">
                @yield('message')
            </div>
            <div class="error_page__text">
                The page you are looking for has been moved or does not exist
            </div>
            <div class="error_page__buttons">
                <a href="/" class="button button_secondary button_small">Home page</a>
                <a href="/" onclick="window.history.go(-1); return false;" class="button button_outlied button_small">Back</a>
            </div>
        </div>
    </body>
</html>
