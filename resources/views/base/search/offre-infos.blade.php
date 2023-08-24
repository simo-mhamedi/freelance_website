@extends('base.index')
<style>
    .filter {
        width: 337px;
        border-radius: 18px;
        border: 1px solid rgba(0, 0, 0, 0.60);
        padding: 20px;
        margin: 20px
    }

    .filter-title {
        color: #000;
        font-size: 26px;
        font-style: normal;
        font-weight: 700;
        line-height: 21.76px;
        /* 83.692% */
        text-transform: uppercase;
        text-align: center
    }

    .category-title {
        color: #000;
        font-size: 20px;
        font-style: normal;
        font-weight: 700;
        line-height: 21.76px;
        /* 108.8% */
        text-transform: uppercase;
    }

    .clear-cat-section {
        margin-top: 20px;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between
    }

    .accordion-button:hover {
        background: white !important;
    }

    .accordion-item {
        margin-bottom: 10px !important;
    }

    .country-inputs {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px
    }

    .city,
    .country {
        border-radius: 8px !important;
        background-color: #F2F5F2 !important;
    }

    /*  ###  Rubberband range input   */

    .rubber-ipt {
        width: 200px;
        height: 2px;
        background-color: #ddd;
        position: relative;
    }

    .rubber-ipt-range {
        width: 200px;
        height: 2px;
        background-color: var(--main-dark);
        position: relative;
    }

    .rubber-ipt-min,
    .rubber-ipt-max {
        height: 16px;
        width: 16px;
        border-radius: 50%;
        position: absolute;

        background-color: #fff;
        border: 1px solid var(--main-dark);
    }

    .rubber-ipt-min {
        transform: translate(-9px, -9px);
        left: 0;
    }

    .rubber-ipt-max {
        transform: translate(191px, -9px);
        left: 0;
    }

    .rubber-value-min {
        top: 10px;
        transform: translateX(-10px);
    }

    .rubber-value-max {
        top: 10px;
        right: 0;
        transform: translateX(10px);
    }

    /* #########  Styling */



    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p {
        margin: 0;
        padding: 0;
    }

    a,
    a:hover {
        text-decoration: none;
        color: #000;
    }

    :root {
        --main-lighter: #f0fffb;
        --main-light: #a9f3f9;
        --main-sublight: #bffaff;
        --main: #00e1da;
        --main-dark: #00b7b4;
        --main-darker: #003f3c;
    }

    body {
        font-family: Verdana, Geneva, sans-serif;
    }

    h5 {
        font-size: 24px;
        color: var(--main-dark);
        font-weight: 400;
    }

    .flex {
        display: flex;
    }

    .f-wrap {
        flex-wrap: wrap;
    }

    .jcsb {
        justify-content: space-between;
    }

    .jcsa {
        justify-content: space-around;
    }

    .jcc {
        justify-content: center;
    }

    .aifs {
        align-items: flex-start;
    }

    .aic {
        align-items: center;
    }

    .w-100 {
        width: 100%;
    }

    .m-m {
        margin: 20px;
    }

    .mb-m {
        margin-bottom: 20px;
    }

    .mt-s {
        margin-top: 10px;
    }

    .main-card {
        max-width: 25%;
        min-width: 300px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    }

    .main-card-head {
        background-color: var(--main-darker);
        padding: 15px 30px;
        border-radius: 10px 10px 0 0;
    }

    .cardhead-light {
        background-color: var(--main-lighter);
        border: 1px solid var(--main-dark);
    }

    .main-card-ctt {
        padding: 20px 30px 30px;
        background-color: #fff;
    }

    .result-card {
        margin: 40px;
        width: 981px;
        height: 369px;
        flex-shrink: 0;
        border-radius: 18px;
        border: 1px solid rgba(0, 0, 0, 0.60);
        padding: 40px;
    }

    .main-section {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: flex-start;
        gap: 30px;
    }

    .search-cards {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .req-title {
        color: #71A5D2;
        font-size: 26px;
        font-style: normal;
        font-weight: 700;
        line-height: 21.76px;
        /* 83.692% */
        text-transform: uppercase;
    }

    .time-post {
        color: #BC5118;
        font-size: 15px;
        font-style: normal;
        font-weight: 700;
        line-height: 21.76px;
        /* 145.067% */
        text-transform: uppercase;
    }

    .card-titles {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }

    .req-infos {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        gap: 50px;
        padding-left: 20px;
        margin: 20px;
    }

    .infos-sts {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .loc {
        color: rgba(0, 0, 0, 0.60);
        font-size: 15px;
        font-style: normal;
        font-weight: 700;
        line-height: 21.76px;
        /* 145.067% */
        text-transform: uppercase;
    }

    .date {
        color: rgba(0, 0, 0, 0.60);
        font-size: 15px;
        font-style: normal;
        font-weight: 700;
        line-height: 21.76px;
        /* 145.067% */
        text-transform: uppercase;
    }

    .statu-req {
        border-radius: 20px;
        background: #00A453;
        width: 115px;
        height: 45px;
        flex-shrink: 0;
        color: white;
        text-align: center;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }

    .name-company {
        color: rgba(0, 0, 0, 0.60);
        font-size: 15px;
        font-style: normal;
        font-weight: 700;
        line-height: 21.76px;
        /* 145.067% */
        text-transform: uppercase;
    }

    .company-desc {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }

    .desc-content {
        color: #000;
        font-size: 15px;
        font-style: normal;
        font-weight: 700;
        line-height: 21.76px;
        /* 145.067% */
        text-transform: uppercase;
    }

    .devis-content {
        color: rgba(0, 0, 0, 0.60);
        font-size: 15px;
        font-style: normal;
        font-weight: 700;
        line-height: 21.76px;
        /* 145.067% */
        text-transform: uppercase;
    }

    .categorys-info {
        margin: 20px;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }

    .list-categorys {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .category {
        width: 131px;
        height: 45px;
        flex-shrink: 0;
        border-radius: 14px;
        background: #F2F5F2;
        color: rgba(0, 0, 0, 0.60);
        font-size: 15px;
        font-style: normal;
        font-weight: 700;
        line-height: 21.76px;
        /* 145.067% */
        text-transform: uppercase;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .input-as-text {
        border: none;
        background-color: transparent;
        font-size: 16px;
        padding: 0;
        outline: none;
    }

    .action-offre {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        gap: 20px;
        margin-bottom: 20px;
    }

    .action-offre button {
        border-radius: 14px !important;
    }

    .left-side {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        gap: 20px;
        padding: 20px;
        margin-top: 40px;
        width: 330px;
        height: 613px;
        flex-shrink: 0;
        border-radius: 18px;
        border: 1px solid rgba(0, 0, 0, 0.60);
    }

    .left-side-title {
        color: #000;
        font-size: 26px;
        font-style: normal;
        font-weight: 700;
        line-height: 21.76px;
        /* 83.692% */
        text-transform: uppercase;
    }

    .user-infos {
        color: #000;
        font-size: 15px;
        font-style: normal;
        font-weight: 700;
        line-height: 21.76px;
        /* 145.067% */
        text-transform: uppercase;
    }

    .statu-req {
        border-radius: 20px;
        background: #00A453;
        width: 80px;
        height: 45px;
        flex-shrink: 0;
        color: white;
        text-align: center;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }

    .statu-info {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 20px;
        justify-content: space-between
    }

    .av-update-btn .btn-success {
        background: #0d6efd !important;
        color: white !important;
        border-color: #0d6efd !important;
        font-weight: bold;
        border-radius: 10px;

    }

    .file-input__input {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    .file-input__label {
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        font-size: 14px;
        padding: 10px 12px;
        background-color: #4245a8;
        box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.25);
    }

    .file-input__label svg {
        height: 16px;
        margin-right: 4px;
    }
</style>
@section('content')
    <div class="backgroud-green" style="height: 280px !important;">
        <p></p>
    </div>
    <div class="main-section">
        <div class="search-cards">
            <div class="result-card">
                <span class="req-title" style="color: black;">details de projet
                </span>
                <div class="card-titles">

                    <span class="req-title"
                        style="margin-top: 40px;margin-left:60px;margin-bottom:20px;">{{ $request->title }}
                    </span>
                </div>
                <div class="descr" style="text-align: center;margin:10px;">
                    {{ $request->description }}
                </div>
                <div class="action-offre">
                    <a href="/messaging/{{ $request->user->id }}" class="btn btn-primary">envoyer message
                    </a>
                    <a class="btn btn-success" data-toggle="modal" data-target="#exampleModal">envoyez devis
                    </a>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">veuillez importer votre DEVIS
                                    </h5>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="clientId" class="clientId" value="{{ $request->user->id }}">
                                    <input type="hidden" name="reqId" class="reqId" value="{{ $request->id }}">

                                    <div class="file-input">
                                        <input hidden type="file"  id="file-input"
                                            class="file-input__input file" />
                                        <label class="file-input__label" for="file-input">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload"
                                                class="svg-inline--fa fa-upload fa-w-16" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path fill="currentColor"
                                                    d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z">
                                                </path>
                                            </svg>
                                            <span>Upload file</span></label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary next-btn">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                        aria-labelledby="deleteModalLabel" aria-hidden="true">

                    </div>
                </div>
                <div class="company-desc">

                    <div class="desc-content">
                        secteur demandé
                    </div>
                </div>
                <div class="categorys-info">
                    <div class="list-categorys">
                        @foreach ($subCategories as $caregory)
                            <div class="category">
                                {{ $caregory->sub_categorie->subCategoryName }}
                            </div>
                        @endforeach

                    </div>

                </div>

            </div>
        </div>
        <div class="left-side">
            <div class="left-side-title">
                info société
            </div>
            <div class="user-infos">
                <div class="rep">{{ $request->user->companyRepresentative }}</div>
                <div class="comp">({{ $request->user->companyName }})</div>
            </div>
            <div class="rating">
                <div style="display: flex;align-items:center;">
                    @if ($roundedAverageRating > 0)
                        @for ($i = 0; $i < $roundedAverageRating; $i++)
                            <span style="color: orange" class="fa fa-star checked"></span>
                        @endfor
                    @else
                    @endif

                </div>
            </div>
            <div class="location">
                {{ $request->user->country }}
            </div>
            <div class="statu-info">
                <div class="label">Statut</div>
                <div class="stat-value">
                    <div class="statu-req">{{ $request->status }}</div>
                </div>
            </div>
            <div class="dates">
                <div class="exp">publié le {{ $request->date_request }}
                </div>
                <div class="crea">expire le : {{ $request->date_deadline }}
                </div>
            </div>
            <div class="devis-infos">
                Vue: {{ $request->viewsNumber }} | devis: {{ count($request->estimates) }}
            </div>
        </div>


    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    addEventListener("DOMContentLoaded", (event) => {
        document.querySelector('.next-btn').addEventListener('click', function(event) {
            console.log("eee");
            var clientId = document.querySelector(".clientId").value;
            var reqId = document.querySelector(".reqId").value;
            var fileInput = document.querySelector(".file");

            var formData = new FormData();
            formData.append('clientId', clientId);
            formData.append('reqId', reqId);
            formData.append('file', fileInput.files[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/add-devis',
                type: 'POST',
                data: formData,
                processData: false, // Important! To prevent jQuery from processing the FormData
                contentType: false, // Important! To prevent jQuery from setting the Content-Type header
                success: function(response) {
                    // Handle the response from the server
                },
                error: function(error) {
                    // Handle the error (if any)
                }
            });
        });
    });
    </script>
