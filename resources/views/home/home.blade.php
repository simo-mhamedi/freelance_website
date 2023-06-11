@extends('base.index')
@section('content')
    <header style="
background-color: #E4EBE4;padding:60px">
        <div class="title">Trouver le meilleure devis pour <br> votre offre</div>

        <div class="input-section">
            <div class="label">
                DEPOSER UNE OFFRE
            </div>
            <div class="input-action">
                <div class="group">
                    <input placeholder="Ex: Devis pour 10 tonnes d'Aliminuim.." type="search" class="input">
                </div>
                <button class="btn btn-success depo"><i class="fa fa-plus-circle"></i> DEPOSER OFFRE</button>
            </div>
        </div>
    </header>
    <center>
        <h2 class="heading">Comment ça marche
        </h2>
        <div class="line"></div>
    </center>
    <div class="guide">
        <div class="container">
            <div class="card">
                <div class="img">
                    <i class="fa fa-folder-o"></i>
                </div>
                <div class="content">
                    <div class="title">
                        Déposer une offre
                    </div>
                    automatiquement envoyé à toutes les sociétés concernés                 </div>
            </div>
            <div class="card">
                <div class="img">
                    <i class="fa fa-folder-o"></i>
                </div>
                <div class="content">
                    <div class="title">
                        ENVOIE DEVIS
                    </div>
                    Recevez les centaines des devis et choisissez les mieux adapté a votre offre
                </div>
            </div>
            <div class="card">
                <div class="img">
                    <i class="fa fa-folder-o"></i>
                </div>
                <div class="content">
                    <div class="title">
                        contacteR les societes
                    </div>
                    Contactez directement la société par email, par téléphone ou par Chat
                </div>
            </div>
        </div>
    </div>
    <center>
        <h2 class="heading">POURQUOI CHOISIR LLL ?
        </h2>
        <div class="line"></div>
    </center>
    <div class="stats">
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-image">
                <p class="com-icon">0%</p>
                </div>
                <div class="stat-content">
                    <div class="title"> CoMMISSION </div>
                    <p>Vous pouvez trouver les devis dispol ll lorem ipdusm orkerlisu</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-image">
                    <i class="fa fa-bullseye com-icon"></i>
                </div>
                <div class="stat-content">
                    <div class="title">TROUVER LES DEVIS</div>
                    <p> Vous pouvez trouver les devis dispol ll lorem ipdusm orkerlisu</p>

                </div>
            </div>
            <div class="stat-card">
                <div class="stat-image">
                    <i class="fa fa-bullseye com-icon"></i>                </div>
                <div class="stat-content">
                    <div class="title"> decouvrir projets </div>
                    <p>Vous pouvez trouver les devis dispol ll lorem ipdusm orkerlisu</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('base.inc.footer')
