<nav class="navbar navbar-expand-lg bg-light  navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">LGOGO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <!-- Added "ms-auto" class here -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">CHERCHER PROJECT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">NOS TARIF</a>
                </li>
                @guest
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus-circle"></i>
                        DEPOSER VOTRE DEMMADE</a>
                </li>
                @endguest
                @auth
                <li class="nav-item">
                        <a class="nav-link"  href="{{ route('newRequest') }}"><i class="fa fa-plus-circle"></i>
                        DEPOSER VOTRE DEMMADE</a>
                </li>
                @endauth
                @guest
                <li class="nav-item">
                    <a  href="{{ route('user-infos') }}" class="btn btn-success">M'INSCRIRE <i class="fa fa-user"></i>
                    </a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
