<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100,300" rel="stylesheet" type="text/css">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">

        <link rel="stylesheet" href="{{ elixir('css/main.css') }}" media="screen" title="no title" charset="utf-8">

    </head>
    <body>
        <nav class="navbar navbar-light bg-faded">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <svg style="width: 1em; height: 1em;">
                        <use xlink:href="svg/sprites.svg#notebook"></use>
                    </svg>
                    <span>Rabbitnote</span>
                </a>
                <ul class="nav navbar-nav pull-xs-right">
                  <li class="nav-item">
                      <a href="#" class="nav-link">Help</a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">Contact Us</a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">Blog</a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">Login</a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">Create Account</a>
                  </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row hero">
                <div class="col-lg-12 text-xs-center">
                    <h1 class="heading-text">The great assistant of your brain</h1>
                    <h3 class="heading-description lead">Rabbitnote provide to you a simple and effective way to organize and keep track all of your thoughts whenever you want and wherever you are.</h3>

                    <a type="button" class="btn btn-primary btn-lg" href="{{ url('home') }}">Getting Started</a>
                </div>
            </div>
        </div>

        {{-- Scripts --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.15/vue.min.js" charset="utf-8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-strap/1.0.3/vue-strap.min.js" charset="utf-8"></script>

    </body>
</html>
