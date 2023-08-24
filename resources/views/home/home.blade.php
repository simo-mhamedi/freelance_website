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
                <a href="new-request" class="btn btn-success depo"><i class="fa fa-plus-circle"></i> DEPOSER OFFRE</a>
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="65" viewBox="0 0 64 65" fill="none">
                        <path d="M31.9951 44.6364V52.9049M52.3381 16.4609H11.6621L11.7221 44.5764H52.3976L52.3381 16.4609Z" stroke="#108A00" stroke-width="2" stroke-miterlimit="10"/>
                        <path d="M25.4757 33.99H31.2517M25.1502 52.3895H38.7152M42.3752 37.748L42.3452 26.2165L31.4987 26.231L27.7937 23.272H22.5337V37.748H42.3752Z" stroke="#108A00" stroke-width="2" stroke-miterlimit="10"/>
                      </svg>
                </div>
                <div class="content">
                    <div class="title">
                        Déposer une offre
                    </div>
                    Un e-mail est automatiquement envoyé à toutes les sociétés concernés
                </div>
            </div>
            <div class="card">
                <div class="img">
                    <svg xmlns="http://www.w3.org/2000/svg" width="61" height="62" viewBox="0 0 61 62" fill="none">
                        <path d="M22.2088 26.7464C22.989 25.2699 24.1572 24.034 25.5876 23.1721C27.018 22.3101 28.6564 21.8546 30.3265 21.8546C31.9965 21.8546 33.635 22.3101 35.0654 23.1721C36.4958 24.034 37.664 25.2699 38.4442 26.7464M45.0247 33.9306V45.8471H15.6074V26.4071H45.0247V33.9306ZM30.316 20.1498C33.167 20.1498 35.4784 17.8385 35.4784 14.9875C35.4784 12.1365 33.167 9.8252 30.316 9.8252C27.4655 9.8252 25.1542 12.1365 25.1542 14.988C25.1542 17.839 27.4655 20.1503 30.3165 20.1503L30.316 20.1498Z" stroke="#108A00" stroke-width="1.89844" stroke-miterlimit="10"/>
                        <path d="M30.3242 45.6519V51.3173M25.7314 51.3173H34.9009" stroke="#108A00" stroke-width="1.89844"/>
                        <path d="M30.3163 37.3046C30.4591 37.3046 30.6004 37.2765 30.7323 37.2218C30.8641 37.1672 30.9839 37.0872 31.0849 36.9862C31.1858 36.8853 31.2659 36.7655 31.3205 36.6336C31.3751 36.5018 31.4032 36.3604 31.4032 36.2177C31.4032 36.075 31.3751 35.9337 31.3205 35.8018C31.2659 35.6699 31.1858 35.5501 31.0849 35.4492C30.9839 35.3483 30.8641 35.2682 30.7323 35.2136C30.6004 35.159 30.4591 35.1309 30.3163 35.1309C30.0281 35.1309 29.7517 35.2454 29.5478 35.4492C29.344 35.653 29.2295 35.9295 29.2295 36.2177C29.2295 36.506 29.344 36.7824 29.5478 36.9862C29.7517 37.1901 30.0281 37.3046 30.3163 37.3046Z" fill="#108A00"/>
                      </svg>                </div>
                <div class="content">
                    <div class="title">
                        ENVOIE DEVIS
                    </div>
                    Recevez les centaines des devis et choisissez les mieux adapté a votre offre
                </div>
            </div>
            <div class="card">
                <div class="img">
                    <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 65 65" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3438 16.4849H10.3438V47.5749H55.0088V32.9454H53.0088V45.5754H12.3438V18.4849H53.0088V22.9449H55.0088V16.4849H11.3438Z" fill="#108A00"/>
                        <path d="M16.1787 40.845H21.9987L32.7137 30.125L43.3837 40.795H49.1487" stroke="#108A00" stroke-width="2" stroke-miterlimit="10"/>
                        <path d="M21.9985 27.3496C22.1489 27.3496 22.2978 27.32 22.4367 27.2624C22.5756 27.2049 22.7018 27.1205 22.8082 27.0142C22.9145 26.9079 22.9988 26.7817 23.0564 26.6427C23.1139 26.5038 23.1435 26.3549 23.1435 26.2046C23.1435 26.0542 23.1139 25.9053 23.0564 25.7664C22.9988 25.6275 22.9145 25.5013 22.8082 25.3949C22.7018 25.2886 22.5756 25.2043 22.4367 25.1467C22.2978 25.0892 22.1489 25.0596 21.9985 25.0596C21.6948 25.0596 21.4036 25.1802 21.1889 25.3949C20.9741 25.6097 20.8535 25.9009 20.8535 26.2046C20.8535 26.5082 20.9741 26.7995 21.1889 27.0142C21.4036 27.2289 21.6948 27.3496 21.9985 27.3496Z" fill="#007FED"/>
                        <path d="M59.9212 34.935L56.4262 31.44M52.9462 32.785C55.6247 32.785 57.7962 30.6135 57.7962 27.935C57.7962 25.2565 55.6247 23.085 52.9462 23.085C50.2677 23.085 48.0962 25.2565 48.0962 27.935C48.0962 30.6135 50.2677 32.785 52.9462 32.785Z" stroke="#108A00" stroke-width="2" stroke-miterlimit="10"/>
                      </svg>                </div>
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 56 56" fill="none">
                        <g clip-path="url(#clip0_13_766)">
                          <path d="M12.25 10.5H26.25V14H12.25V10.5ZM12.25 40.25H19.25V36.75H12.25V40.25ZM12.25 22.75H28V21V19.25H12.25V22.75ZM12.25 31.5H21V28H12.25V31.5ZM28 50.75V52.5V54.25H5.25C2.275 54.25 0 51.975 0 49V10.5C0 7.525 2.275 5.25 5.25 5.25V3.5C5.25 1.575 6.825 0 8.75 0H31.85C32.725 0 33.6 0.35 34.3 1.05L46.2 12.95C46.9 13.65 47.25 14.525 47.25 15.4V21H43.75V17.5H35C32.025 17.5 29.75 15.225 29.75 12.25V3.5H8.75V45.5H22.75V49H8.75C6.825 49 5.25 47.425 5.25 45.5V8.75C4.2 8.75 3.5 9.45 3.5 10.5V49C3.5 50.05 4.2 50.75 5.25 50.75H28ZM33.25 4.9V12.25C33.25 13.3 33.95 14 35 14H42.35L33.25 4.9ZM31.5 36.75C31.5 33.775 33.775 31.5 36.75 31.5C37.8 31.5 38.5 30.8 38.5 29.75C38.5 28.7 37.8 28 36.75 28C31.85 28 28 31.85 28 36.75C28 37.8 28.7 38.5 29.75 38.5C30.8 38.5 31.5 37.8 31.5 36.75ZM55.475 53.025C56.175 53.725 56.175 54.775 55.475 55.475C55.125 55.825 54.775 56 54.25 56C53.725 56 53.375 55.825 53.025 55.475L45.325 47.775C42.875 49.7 39.9 50.75 36.75 50.75C29.05 50.75 22.75 44.45 22.75 36.75C22.75 29.05 29.05 22.75 36.75 22.75C44.45 22.75 50.75 29.05 50.75 36.75C50.75 39.9 49.7 42.875 47.775 45.325L55.475 53.025ZM47.25 36.75C47.25 30.975 42.525 26.25 36.75 26.25C30.975 26.25 26.25 30.975 26.25 36.75C26.25 42.525 30.975 47.25 36.75 47.25C42.525 47.25 47.25 42.525 47.25 36.75Z" fill="#FAFFFF"/>
                        </g>
                        <defs>
                          <clipPath id="clip0_13_766">
                            <rect width="56" height="56" fill="white"/>
                          </clipPath>
                        </defs>
                      </svg>
                </div>
                <div class="stat-content">
                    <div class="title">TROUVER LES DEVIS</div>
                    <p> Vous pouvez trouver les devis dispol ll lorem ipdusm orkerlisu</p>

                </div>
            </div>
            <div class="stat-card">
                <div class="stat-image">
                    <svg xmlns="http://www.w3.org/2000/svg" width="79" height="81" viewBox="0 0 79 81" fill="none">
                        <g clip-path="url(#clip0_13_799)">
                          <path d="M34.1259 80.9999C52.973 80.9999 68.2517 65.6478 68.2517 46.7099C68.2517 27.7721 52.973 12.4199 34.1259 12.4199C15.2787 12.4199 0 27.7721 0 46.7099C0 65.6478 15.2787 80.9999 34.1259 80.9999Z" fill="#00A651"/>
                          <path d="M34.1258 73.8001C49.0156 73.8001 61.0862 61.6715 61.0862 46.7101C61.0862 31.7487 49.0156 19.6201 34.1258 19.6201C19.2361 19.6201 7.16553 31.7487 7.16553 46.7101C7.16553 61.6715 19.2361 73.8001 34.1258 73.8001Z" fill="white"/>
                          <path d="M34.1258 66.6003C45.0582 66.6003 53.9206 57.6953 53.9206 46.7103C53.9206 35.7254 45.0582 26.8203 34.1258 26.8203C23.1935 26.8203 14.3311 35.7254 14.3311 46.7103C14.3311 57.6953 23.1935 66.6003 34.1258 66.6003Z" fill="#00A651"/>
                          <path d="M34.1258 59.3995C41.1008 59.3995 46.7551 53.718 46.7551 46.7095C46.7551 39.701 41.1008 34.0195 34.1258 34.0195C27.1509 34.0195 21.4966 39.701 21.4966 46.7095C21.4966 53.718 27.1509 59.3995 34.1258 59.3995Z" fill="white"/>
                          <path d="M34.1256 52.1096C37.0937 52.1096 39.4998 49.6919 39.4998 46.7096C39.4998 43.7272 37.0937 41.3096 34.1256 41.3096C31.1576 41.3096 28.7515 43.7272 28.7515 46.7096C28.7515 49.6919 31.1576 52.1096 34.1256 52.1096Z" fill="#00A651"/>
                          <path d="M79.0003 11.4298L70.5808 10.2598L60.4595 20.4298L68.879 21.5098L79.0003 11.4298Z" fill="white"/>
                          <path d="M67.625 0L68.7894 8.46L58.7577 18.63L57.5933 10.17L67.625 0Z" fill="white"/>
                          <path d="M34.126 46.7104L36.6339 45.9004L70.4911 10.2604C70.9389 9.81039 70.9389 9.00039 70.4911 8.55039C70.0432 8.10039 69.2371 8.10039 68.7892 8.55039L34.9321 44.1004L34.126 46.7104Z" fill="#FDFDFF"/>
                        </g>
                        <defs>
                          <clipPath id="clip0_13_799">
                            <rect width="79" height="81" fill="white"/>
                          </clipPath>
                        </defs>
                      </svg>
                                 </div>
                <div class="stat-content">
                    <div class="title"> decouvrir projets </div>
                    <p>Vous pouvez trouver les devis dispol ll lorem ipdusm orkerlisu</p>
                </div>
            </div>
        </div>
    </div>
@endsection
