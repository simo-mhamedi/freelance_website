@extends('base.index')


<style>
    .avatar-sections {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 20px;
    }

    .av-title {
        color: #108A00;
        font-size: 45px;
        font-style: normal;
        font-weight: 600;
        line-height: 21.76px;
        /* 48.356% */
        text-transform: uppercase;
    }

    .company-name {
        color: #000;
        font-size: 30px;
        font-style: normal;
        font-weight: 600;
        line-height: 21.76px;
        /* 72.533% */
        text-transform: uppercase;
    }

    .name-infos {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .rsp-name {
        color: #000;
        font-size: 20px;
        font-style: normal;
        font-weight: 600;
        line-height: 21.76px;
        /* 108.8% */
        text-transform: uppercase;
    }

    .av-actions {
        display: flex;
        justify-content: space-between;
        align-content: center;
        flex-direction: row;
        gap: 10px;
    }

    .btn {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 10px;
    }

    .av-update-btn .btn-success {
        background: white !important;
        color: #108A00 !important;
        border-color: #108A00 !important;
        font-weight: bold;
        border-radius: 10px;

    }

    .avatar {
        border: #108A00 solid 1px;
        width: 105px;
        margin-left: auto;
        margin-right: auto;
        height: 105px;
        flex-shrink: 0;
        border-radius: 105px;
        background: rgba(217, 217, 217, 0.40);
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        background-image: url({{ asset('storage/' . $user->image) }});

    }

    .item {
        margin-top: 20px;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 200px;

    }

    a {
        color: #000 !important;
        text-decoration: none !important;
    }

    .action-info {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .flesh {
        background: #F2F5F2;
        border-radius: 100%;

        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center
    }

    .Abtn {
        color: white !important;
    }

    .icon-action {
        width: 60px;
        height: 51px;
        flex-shrink: 0;
        background: #F2F5F2;
        color: #108A00;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        border-radius: 10px;
    }

    .div-line {
        width: 40% !important;
        background: green;
        margin-top: 20px;
        margin-bottom: 20px;
        height: 1px;
    }
</style>
@section('content')
    <div class="backgroud-green"> </div>
    <div class="form_container" style="
position:absolute !important;
top: 110px;
    left: 30%;
">
        <div class="avatar-sections">
            <div class="av-title">
                profil
            </div>
            <img src="{{ asset('storage/users-avatar/' . $user->avatar) }}" class="avatar">

            <div class="name-infos">
                <div class="company-name">
                    {{ $user->companyName }}
                </div>
                <div class="rsp-name">
                    {{ $user->companyRepresentative }}
                </div>
            </div>
            <div class="av-actions">
                <div class="email">
                    <a class="Abtn btn btn-danger" data-toggle="modal" data-target="#exampleModalCenterEmail"><i class="fa fa-envelope request-icon"></i></a>
                    <div class="modal fade" id="exampleModalCenterEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="sendEmailModalLabel">Send Email</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form style="width: 100%" action="{{ route('send_email') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" value="{{$user->email}}" id="recipient" name="recipient">
                                        </div>
                                            <label for="subject">Subject</label>
                                            <input type="text" class="form-control" id="subject" name="subject" required>
                                            <label for="message">Message</label>
                                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                            </div>
                        </div>
        

                </div>
                </div>
                <div class="sms">
                    <a href="/messaging/{{$user->id}}" class="Abtn btn btn-primary"><i class="fa fa-comment request-icon"></i></a>

                </div>
                <div class="phoneNumber">
                    <a href="https://api.whatsapp.com/send?phone={{ $user->tele }}" target="_blank"
                        class="Abtn btn btn-success"><i class=" fa fa-phone request-icon"></i></a>

                </div>
            </div>
            <div class="av-update-btn">
                <a style="text-decoration:none !important" href="{{ route('update-profile-infos') }}">
                    <button class="btn btn-success ">EDIT PROFILE</button>
                </a>
            </div>
        </div>



        <div class="list-actions">
            <a href="{{ route('dashboard') }}">
                <div class="item">
                    <div class="action-info">
                        <div class="icon-action"><i class="fa fa-tachometer"></i>
                        </div>
                        <div class="name-action">
                            TABLEAUX DE BORD
                        </div>
                    </div>
                    <div class="flesh"><i class="fa fa-chevron-right"></i>
                    </div>
                </div>
            </a>
            <a href="{{ route('request') }}">
                <div class="item">
                    <div class="action-info">
                        <div class="icon-action"><i class="fa fa-file"></i>

                        </div>
                        <div class="name-action">
                            Mes offres
                        </div>
                    </div>
                    <div class="flesh"><i class="fa fa-chevron-right"></i>
                    </div>
                </div>
            </a>
            <a href="{{ route('estimate') }}">

                <div class="item">
                    <div class="action-info">
                        <div class="icon-action"><i class="fa fa-check-square"></i>

                        </div>
                        <div class="name-action">
                            Mes DEVIS
                        </div>
                    </div>
                    <div class="flesh"><i class="fa fa-chevron-right"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="div-line"></div>
        <div class="list-actions">
            <div class="item">
                <div class="action-info">
                    <div class="icon-action"><i class="fa fa-info-circle"></i>
                    </div>
                    <div class="name-action">
                        Mes information
                    </div>
                </div>
                <div class="flesh"><i class="fa fa-chevron-right"></i>
                </div>
            </div>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="item">
                    <div class="action-info">
                        <div class="icon-action"><i style="color: #BC1818" class="fa fa-sign-out"></i>

                        </div>
                        <div class="name-action">
                            log out
                        </div>

                    </div>
                    <div class="flesh"><i class="fa fa-chevron-right"></i>
                    </div>
                </div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
