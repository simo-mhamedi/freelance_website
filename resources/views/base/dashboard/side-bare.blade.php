<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #000 !important;
        background-color: #ffffff !important;
    }

    .avatar {
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
    }
    .name{
      text-align: center;
      color: #000
    }
    .edit{
        text-align: center
    }
</style>
<div class="d-flex flex-column flex-shrink-0 p-3 text-white " style="width: 280px;      border-radius: 10px;  height: 800px;background:#00A453">
    <img src="{{ asset('storage/'.Auth::user()->image)}}" class="avatar">
    <div class="name"><a  href="{{ route('profile-infos') }}" style="cursor: pointer;color:#000;text-decoration:none">{{ Auth::user()->companyName }}<a>
    </div>
    <a style="text-decoration:none !important" href="{{ route('update-profile-infos') }}"  >
    <div style="cursor: pointer; color:white;text-decoration:none !important" class="edit">Edit Profile</div>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto" style="width: 100%">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="{{ (request()->is('dashboard')) ? 'nav-link active' : 'nav-link  text-white' }}" aria-current="page">
                <i class=" bi me-2 fa fa-clipboard board-icon"></i>

                TABLEAUX DE BORD
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('request') }}" class="{{ (request()->is('requests')) ||  (request()->is('search-estimates-from-req'))||(request()->is('request-infos-view/*'))|| (request()->is('searsh-request')) ? 'nav-link active' : 'nav-link  text-white' }}" aria-current="page">
                <i class="bi me-2 fa fa-paper-plane request-icon"></i>
                MES DEMANDES
            </a>
        </li>
        <li>
            <a  href="{{ route('estimate') }}" class="{{ (request()->is('estimate')) || (request()->is('select-estimates'))|| (request()->is('select-date-estimates')) || (request()->is('search-estimates'))  ? 'nav-link active' : 'nav-link  text-white' }}">
                <i class="fa fa-comments bi me-2"></i>

                DEVIS RECUS
            </a>
        </li>
        <li>
            <a href="{{ route('estimate_send') }}" class="{{ (request()->is('estimate_send')) || (request()->is('search-send-estimates'))|| (request()->is('select-send-estimates'))|| (request()->is('select-send-date-estimates')) || (request()->is('sselect-send-date-estimates'))  ? 'nav-link active' : 'nav-link  text-white' }}" class="nav-link text-white">
                <i class="fa fa-comments bi me-2"></i>

                DEVIS ENVOYES
            </a>
        </li>
    </ul>

</div>
