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
    <span class="avatar"></span>
    <div class="name">test</div>
    <div class="edit">Edit Profile</div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto" style="width: 100%">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="{{ (request()->is('dashboard')) ? 'nav-link active' : 'nav-link  text-white' }}" aria-current="page">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#home" />
                </svg>
                TABLEAUX DE BORD
            </a>
        </li>
        <li>
            <a  href="{{ route('estimate') }}" class="{{ (request()->is('estimate')) ? 'nav-link active' : 'nav-link  text-white' }}">
                <i class="fa fa-comments bi me-2"></i>

                DEVIS RECUS
            </a>
        </li>
        <li>
            <a href="#" class="nav-link text-white">
                <i class="fa fa-comments bi me-2"></i>

                DEVIS ENVOYES
            </a>
        </li>
    </ul>

</div>
