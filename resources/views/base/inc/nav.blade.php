<style>
    .icon-button {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        color: #333333;
        background: #dddddd;
        border: none;
        outline: none;
        border-radius: 50%;
        font-size: 19px !important;
    }

    .icon-button:hover {
        cursor: pointer;
    }

    .icon-button:active {
        background: #cccccc;
    }

    .icon-button__badge {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 20px;
        height: 20px;
        background: red;
        color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
    }

    ul {
        list-style: none;
    }

    .user-menu-wrap {
        position: relative;
        width: 36px;
        margin-left: 20px;
        margin-right: 30px
    }

    .menu-container {
        visibility: hidden;
        opacity: 0;
    }

    .menu-container.active {
        visibility: visible;
        opacity: 1;
        transition: all 0.2s ease-in-out;
    }

    .user-menu {
        position: absolute;
        right: -22px;
        background-color: #ffffff;
        width: 256px;
        border-radius: 2px;
        border: 1px solid rgba(0, 0, 0, 0.15);
        padding-top: 5px;
        padding-bottom: 5px;
        margin-top: 20px;
    }

    .user-menu .profile-highlight {
        display: flex;
        border-bottom: 1px solid #e0e0e0;
        padding: 12px 16px;
        margin-bottom: 6px;
    }

    .user-menu .profile-highlight img {
        width: 48px;
        height: 48px;
        border-radius: 25px;
        -o-object-fit: cover;
        object-fit: cover;
    }

    .user-menu .profile-highlight .details {
        display: flex;
        flex-direction: column;
        margin: auto 12px;
    }

    .user-menu .profile-highlight .details #profile-name {
        font-weight: 600;
        font-size: 16px;
    }

    .user-menu .profile-highlight .details #profile-footer {
        font-weight: 300;
        font-size: 14px;
        margin-top: 4px;
    }

    .user-menu .footer {
        border-top: 1px solid #e0e0e0;
        padding-top: 6px;
        margin-top: 6px;
    }

    .user-menu .footer .user-menu-link {
        font-size: 13px;
    }

    .user-menu .user-menu-link {
        display: flex;
        text-decoration: none;
        color: #333333;
        font-weight: 400;
        font-size: 14px;
        padding: 12px 16px;
    }

    .user-menu .user-menu-link div {
        margin: auto 10px;
    }

    .user-menu .user-menu-link:hover {
        background-color: #f5f5f5;
        color: #333333;
    }

    .user-menu:before {
        position: absolute;
        top: -16px;
        left: 120px;
        display: inline-block;
        content: "";
        border: 8px solid transparent;
        border-bottom-color: #e0e0e0;
    }

    .user-menu:after {
        position: absolute;
        top: -14px;
        left: 121px;
        display: inline-block;
        content: "";
        border: 7px solid transparent;
        border-bottom-color: #ffffff;
    }
</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<nav class="navbar navbar-expand-lg bg-light navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">LGOGO</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item mx-auto"> <!-- Added "mx-auto" class to center the links -->
                    <a class="nav-link active" aria-current="page" href="/main-search">CHERCHER PROJECT</a>
                </li>

                <li class="nav-item mx-auto"> <!-- Added "mx-auto" class to center the links -->
                    <a class="nav-link" href="#">NOS TARIF</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="/messaging">
                        <button type="button" class="icon-button">
                            <span class="material-icons">notifications</span>
                            <span class="icon-button__badge"></span>
                        </button>
                    </a>
                </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#exampleModalLong"><i
                                class="fa fa-plus-circle"></i>
                            DEPOSER VOTRE DEMMADE</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('newRequest') }}"><i class="fa fa-plus-circle"></i>
                            DEPOSER VOTRE DEMMADE</a>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a href="{{ route('user-infos') }}" class="btn btn-success">M'INSCRIRE <i class="fa fa-user"></i>
                        </a>
                    </li>
                @endguest
                @auth
                <li class="nav-item ">
                    <div class="user-menu-wrap">

                        <a class="mini-photo-wrapper" href="#"><img class="mini-photo"
                            src="{{ asset('storage/users-avatar/' . Auth::user()->avatar) }}"
                                width="36" height="36" /></a>


                        <div class="menu-container">
                            <ul class="user-menu">
                                <div class="profile-highlight">
                                    <img
                                    src="{{ asset('storage/users-avatar/' . Auth::user()->avatar) }}"
                                        alt="profile-img" width=36 height=36>
                                    <div class="details">
                                        <div id="profile-name">{{Auth::user()->name}}</div>
                                        <div id="profile-footer">{{Auth::user()->companyName}}</div>
                                    </div>
                                </div>
                                <li class="user-menu__item">
                                    <a class="user-menu-link" href="/dashboard">
                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1604623/trophy.png"
                                            alt="trophy_icon" width=20 height=20>
                                        <div>Dashboard</div>
                                    </a>
                                </li>
                                <li class="user-menu__item">
                                    <a class="user-menu-link" href="/profile-infos">
                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1604623/team.png"
                                            alt="team_icon" width=20 height=20>
                                        <div>Profile</div>
                                    </a>
                                </li>
                                <li class="user-menu__item">
                                    <a class="user-menu-link" href="/requests">
                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1604623/book.png"
                                            alt="team_icon" width=20 height=20>
                                        <div>Mes demandes</div>
                                    </a>
                                </li>
                                <div class="footer">

                                    <li class="user-menu__item">
                                        <a href="{{ route('logout') }}" class="user-menu-link"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            style="color: #F44336;">Logout</a></li>
                                    <li class="user-menu__item"><a class="user-menu-link" href="/update-profile-infos">Edit Profile</a>
                                    </li>
                                </div>
                            </ul>
                        </div>
                    </div>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @endauth


            </ul>
        </div>
    </div>
</nav>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    document.querySelector('.mini-photo-wrapper').addEventListener('click', function() {
        document.querySelector('.menu-container').classList.toggle('active');
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/getunseenMessage',
        type: 'GET',
        data: {},
        success: function(response) {
            // Handle the response from the server
            document.querySelector('.icon-button__badge').innerText = response.unseenMessage;
        },
        error: function(xhr) {
            // // Handle any errors that occur during the request
            // Toastify({
            //     text: xhr.responseText,
            //     className: "errore",
            //     style: {
            //         background: "linear-gradient(to right, #df1b1b, #d62121)",
            //     }
            // }).showToast();
        }
    });
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('eed527ef5a6a0a3c6d36', {
        cluster: 'eu'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {


        $.ajax({
            url: '/checkunseenMessage',
            type: 'GET',
            data: {},
            success: function(response) {
                // Handle the response from the server
                document.querySelector('.icon-button__badge').innerText = response.unseenMessage;
            },
            error: function(xhr) {
                // // Handle any errors that occur during the request
                // Toastify({
                //     text: xhr.responseText,
                //     className: "errore",
                //     style: {
                //         background: "linear-gradient(to right, #df1b1b, #d62121)",
                //     }
                // }).showToast();
            }
        });
    });
</script>
