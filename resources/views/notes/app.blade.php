<!DOCTYPE html>
<html lang="en_US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
        <link rel="stylesheet" href="{{ elixir('/css/main.css') }}">
    </head>
    <body>

        <app></app>

        <!-- Libs -->
        <script src="https://cdn.jsdelivr.net/g/tether@1.2.0,jquery@2.2.2,bootstrap@3.3.6"></script>
        <script>
        var key = '{{ \JWTAuth::fromUser(\Auth::user()) }}';
        console.log(key);
        var user = '{!! json_encode(\Auth::user()) !!}';
        </script>
        <script src="/js/vendor.bundle.js"></script>
        <script src="/js/build.js"></script>
    </body>
</html>