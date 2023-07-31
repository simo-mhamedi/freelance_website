<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="{{ URL::asset('tel/style.css') }}" rel="stylesheet" />

    <link href="{{ URL::asset('home/home.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('home/auth-modale.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('home/auth-page.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('home/registration.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <title>Freelance</title>
    <style>
        .dsc {
            display: flex;
            flex-direction: row;
            margin: 20px
        }
    </style>
</head>

<body>
    @include('base.inc.nav')
    @if (request()->routeIs('dashboard') || request()->routeIs('estimate')
    || request()->routeIs('select-estimates')
    || request()->routeIs('select-date-estimates')
    || request()->routeIs('search-estimates')
    || request()->routeIs('estimate_send')
    || request()->routeIs('select-send-estimates')
    || request()->routeIs('select-send-date-estimates')
    || request()->routeIs('request')
    || request()->routeIs('searsh-request')
    )
        <div class="dsc">
            <div class="sideBare">
                @include('base.dashboard.side-bare')
            </div>
            <div id="content" style="margin: 20px;width:100%; height: 100%">
                @yield('content')
            </div>
        </div>
    @else
        <div id="content" style="height: 100%;">
            @yield('content')
        </div>
    @endif


    @include('base.auth.auth-modal')
    <script src="{{ URL::asset('tel/javaScript.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>

</html>
