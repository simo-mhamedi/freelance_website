@extends("base.in")
<body style="height: 100%;">
    <div class="sideBare">
        @include("base.dashboard.side-bare")
    </div>
    <div id="content" style="height: 100%;">
        @yield('content')
    </div>
</body>
