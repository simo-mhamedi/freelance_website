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
        height: 8px;
        background-color: #ddd;
        position: relative;
    }

    .rubber-ipt-range {
        width: 200px;
        height: 8px;
        background-color: #00A453;
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
        transform: translate(-9px, -11px);
        left: 0;
    }

    .rubber-ipt-max {
        transform: translate(191px, -11px);
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
        width: 981px;
        height: 269px;
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

    .form-check {
        display: flex !important;
        gap: 14px !important;
    }

    .cat-name {
        color: #001E00;
        font-size: 20px;
        font-style: normal;
        font-weight: 700;
        line-height: 21.76px;
        /* 108.8% */
        text-transform: uppercase;
    }

    input[type="checkbox"] {
        border-radius: 2px !important;
    }

    input[type="checkbox"]:enabled:checked {
        background-color: #002B4E !important;
        color: white;
    }

    .input-as-text {
        width: 35% !important;
        border-radius: 14px;
        background: #00A453;
        color: #FFF;
        font-size: 18px;
        font-style: normal;
        font-weight: 600;
        line-height: 21.76px;
        /* 120.889% */
        text-transform: uppercase;
        text-align: center
    }
</style>
@section('content')
    <form method="post" action="{{ route('main-search-proc') }}">
        @csrf
        <div class="backgroud-green" style="height: 280px !important;">
            <p>decouvrer les PROJETS Déposés</p>
        </div>

        <div class="search">
            <div class="right" id="keyForm">
                <label for="" class="label-search">Result {{ $totale }}</label>
                <input value="{{ isset($data) ? $data : '' }}" type="text" name="searchKey" class="search-key"
                    placeholder="chercher mot clé" style="border-radius: 14px;
    background: #F2F5F2;margin-right:10px"
                    class="form-control">
                <button style="width: 105px;
    height: 38px;
    flex-shrink: 0;border-radius: 14px;
background: #108A00;"
                    class="btn btn-success next-btn">search</button>
                <label for="" style="margin-left: 40px" class="label-search">Sort by Latest</label>

            </div>
        </div>

        <div class="main-section">
            <div class="filter">
                <div class="filter-title">
                    Filters
                </div>
                <div class="clear-cat-section">
                    <div class="category-title">
                        Category
                    </div>
                    <a class="btn btn-primary clear"
                        style="background: transparent;color:#007FED;border:none;
                font-size: 20px;
    font-style: normal;
    font-weight: 700;
    line-height: 21.76px; /* 108.8% */
    text-transform: uppercase;
                ">CLEAR</a>
                </div>
                <div class="accordion" id="accordionExample"
                    style="margin-top: 14px;
            width: 100%;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;">
                    @foreach ($categories as $categorie)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#{{ $categorie->categoryName }}" aria-controls="collapseOne">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="28"
                                        viewBox="0 0 38 43" fill="none">
                                        <g clip-path="url(#clip0_1_2617)">
                                            <path
                                                d="M18.376 23.9168H24.446L27.1068 15.4355H18.376V23.9168ZM20.3716 17.471H24.446L23.0324 21.8813H20.3716V17.471Z"
                                                fill="#001E00" />
                                            <path
                                                d="M37.7505 12.8915L30.7659 6.53057C30.6827 6.44576 30.5164 6.36095 30.3501 6.36095H17.046V0.678501C17.046 0.339251 16.7133 0 16.3807 0H7.64989C7.23414 0 6.98468 0.339251 6.98468 0.678501V6.36095H0.665208C0.332604 6.36095 0 6.7002 0 7.03945V13.4004C0 13.7396 0.332604 14.0789 0.665208 14.0789H6.98468V38.8442H4.15755L2.99344 40.5404V43H21.0372V40.5404L19.8731 38.8442H17.046V14.0789H28.6871V24.002H28.2713V26.4615L29.4354 28.1578H30.3501V29.1755C30.3501 29.3452 30.5164 29.5148 30.6827 29.5148C31.3479 29.5148 31.93 30.1085 31.93 30.787C31.93 31.4655 31.3479 32.0592 30.6827 32.0592C30.267 32.0592 29.9344 31.8895 29.6849 31.5503C29.6018 31.3807 29.3523 31.3807 29.186 31.4655C29.0197 31.5503 29.0197 31.8047 29.1028 31.9744C29.4354 32.4832 30.0175 32.7377 30.6827 32.7377C31.7637 32.7377 32.5952 31.8895 32.5952 30.787C32.5952 29.854 31.93 29.0059 31.0153 28.8363V28.1578H31.7637L32.9278 26.4615V24.002H32.512V14.0789H37.1685C37.4179 14.0789 37.6674 13.9093 37.7505 13.6548C38.0832 13.4004 38 13.0611 37.7505 12.8915ZM14.302 7.71795L11.9737 9.4142L9.64551 7.71795H14.302ZM9.72866 6.36095L12.0569 4.66469L14.3851 6.36095H9.72866ZM13.1379 3.81657L15.7155 1.95069V5.68245L13.1379 3.81657ZM12.0569 3.05325L9.72866 1.357H14.302L12.0569 3.05325ZM10.8928 3.81657L8.3151 5.68245V1.95069L10.8928 3.81657ZM10.8928 10.1775L8.3151 12.0434V8.31164L10.8928 10.1775ZM9.72866 12.7219L12.0569 11.0256L14.3851 12.7219H9.72866ZM14.302 14.0789L11.9737 15.7751L9.64551 14.0789H14.302ZM10.8928 16.5385L8.3151 18.4043V14.6726L10.8928 16.5385ZM15.7155 31.1262L13.1379 29.2604L15.7155 27.3945V31.1262ZM15.2998 32.4832L12.0569 34.7732L8.814 32.3984L12.0569 30.0237L15.2998 32.4832ZM12.0569 28.497L8.814 26.1223L12.0569 23.7475L15.2998 26.1223L12.0569 28.497ZM15.7155 24.7653L13.1379 22.8994L15.7155 21.0335V24.7653ZM12.0569 22.1361L8.814 19.7613L12.0569 17.3866L15.2998 19.7613L12.0569 22.1361ZM8.3151 21.0335L10.8928 22.8994L8.3151 24.7653V21.0335ZM8.3151 27.3945L10.8928 29.2604L8.3151 31.1262V27.3945ZM8.3151 33.7554L10.8928 35.6213L8.3151 37.4872V33.7554ZM12.0569 36.4694L14.3851 38.1657H9.81182L12.0569 36.4694ZM13.1379 35.6213L15.7155 33.7554V37.4872L13.1379 35.6213ZM13.1379 16.5385L15.7155 14.6726V18.4043L13.1379 16.5385ZM13.1379 10.1775L15.7155 8.31164V12.0434L13.1379 10.1775ZM24.0306 8.56608L28.6039 12.7219H24.0306V8.56608ZM22.7002 11.8738L18.1269 7.71795H22.7002V11.8738ZM25.1116 7.71795H29.6849V11.8738L25.1116 7.71795ZM6.98468 11.8738L2.41138 7.71795H6.98468V11.8738ZM1.33042 8.56608L5.90372 12.7219H1.33042V8.56608ZM17.046 8.56608L21.6193 12.7219H17.046V8.56608ZM31.93 23.9172H29.3523V14.0789H31.93V23.9172ZM31.0153 12.7219V8.56608L35.5886 12.7219H31.0153Z"
                                                fill="#001E00" />
                                        </g>
                                        <defs>

                                        </defs>
                                    </svg>&ensp;
                                    <span class="cat-name">{{ $categorie->categoryName }}</span>

                                </button>
                            </h2>
                            <div id="{{ $categorie->categoryName }}" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @foreach ($subCagories as $subCagorie)
                                        @if ($subCagorie->category_id == $categorie->id)
                                            <div class="form-check">
                                                <input class="form-check-input check" type="checkbox"
                                                    value="{{ $subCagorie->id }}" id="{{ $subCagorie->id }}">
                                                <label class="form-check-label" for="flexCheckDefault1">
                                                    {{ $subCagorie->subCategoryName }}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <input type="hidden" name="checkedValues" id="checkedValues">
                </div>
                <div class="clear-cat-section">
                    <div class="category-title">
                        Project location
                    </div>
                    <a class="btn btn-primary clear-loc"
                        style="background: transparent;color:#007FED;border:none;
                font-size: 20px;
    font-style: normal;
    font-weight: 700;
    line-height: 21.76px; /* 108.8% */
    text-transform: uppercase;
                ">CLEAR</a>
                </div>
                <div class="country-inputs">
                    <input type="text" class="form-control country"
                        value="{{ isset($data['country']) ? $data['country'] : '' }}" name="country" placeholder="country">
                    <input type="text" class="form-control city" value="{{ isset($data['city']) ? $data['city'] : '' }}"
                        name="city" placeholder="city">
                </div>
                <div class="clear-cat-section">
                    <div class="category-title">
                        budget
                    </div>
                    <a class="btn btn-primary clear-price"
                        style="background: transparent;color:#007FED;border:none;
                font-size: 20px;
    font-style: normal;
    font-weight: 700;
    line-height: 21.76px; /* 108.8% */
    text-transform: uppercase;
                ">CLEAR</a>
                </div>
                <div class="input_container">
                    <div class="flex jcsa aifs f-wrap w-100vw">
                        <div class="main-card m-m rubber-ipt-ctn">
                            <div class="main-card-ctt flex jcc aic">
                                <div class="rubber-ipt mb-m mt-s">
                                    <div class="rubber-ipt-range"></div>

                                    <div class="rubber-ipt-min"></div>
                                    <div class="rubber-ipt-max"></div>

                                    <div class="w-100 flex jcsb mt-s">
                                        <input class="rubber-value-min input-as-text" name="minPrice" value="2500">
                                        <input class="rubber-value-max input-as-text" name="maxPrice" value="5000">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>


    <div class="search-cards">
        @foreach ($requests as $request)
            <form id="view-request-form" action="{{ route('offre-infos') }}" method="post">
                @csrf
                <div class="result-card" data-request="{{ $request }}">
                    <input type="hidden" id="htr" name="req" value="e">
                    <div class="card-titles">
                        <span class="req-title">{{ $request->title }}
                        </span>
                        <span class="time-post">
                            @if ($request->minutesDifference<60)
                            {{$request->minutesDifference}}Mn
                            @else
                            {{$request->hoursDifference}}H
                            @endif
                        </span>
                    </div>
                    <div class="req-infos">
                        <div class="date">
                            {{ $request->date_request }}
                        </div>
                        <div class="infos-sts">
                            <div class="loc">{{ $request->user->country }}</div>
                            <div class="statu-req">{{ $request->status }}</div>
                            <div class="name-company">{{ $request->user->companyName }}</div>
                        </div>
                    </div>
                    <div class="company-desc">
                        <div class="desc-content">
                            {{ $request->description }}
                        </div>
                        <div class="devis-content">
                            Vue: {{ $request->viewsNumber }} | devis: {{ $request->estimates->count() }}
                        </div>
                    </div>
                    <div class="categorys-info">
                        <div class="list-categorys">
                            @foreach ($request->Sub_categorie as $caregory)
                                <div class="category">
                                    {{ $caregory->Sub_categorie->subCategoryName }}
                                </div>
                            @endforeach

                        </div>
                        <div class="dead-line">
                            DEADLINE : {{ $request->date_deadline }}
                        </div>
                    </div>

                </div>
                <button type="submit" id="submit-btn" style="display: none;"></button>
            </form>
        @endforeach
    </div>



    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    addEventListener("DOMContentLoaded", (event) => {
        const resultCards = document.querySelectorAll('.result-card');
        resultCards.forEach(resultCard => {
            // Add a click event listener to each result card
            resultCard.addEventListener('click', function() {
                // Get the custom data attribute 'data-request' value
                const requestDataString = resultCard.getAttribute('data-request');
                document.getElementById('htr').value = requestDataString;


                // Perform your logic using the 'requestId'

                // Trigger a click event on the invisible submit button if needed
                const submitButton = document.getElementById('submit-btn');
                submitButton.click();
            });
        });

        selectedValues = [];
        document.querySelectorAll('.check').forEach(el => {
            const checkboxState = localStorage.getItem(el.id);
            console.log(checkboxState);
            if (checkboxState == "checked") {
                el.checked = true;
            }
            if (checkboxState == "unchecked") {
                localStorage.removeItem(el.id);
            }

        });

        document.querySelector('.clear').addEventListener('click', function(event) {
            document.querySelectorAll(".check").forEach(element => {
                element.checked = false;
                localStorage.removeItem(element.id);

            });
        })

        document.querySelector('.clear-loc').addEventListener('click', function(event) {
            document.querySelector(".country").value = "";
            document.querySelector(".city").value = "";

        })


        document.querySelector('.clear-price').addEventListener('click', function(event) {
            const rubberIpts = document.querySelectorAll(".rubber-ipt");

            for (var i = 0; i < rubberIpts.length; i++) {
                const rubberRange = rubberIpts[i].querySelector(".rubber-ipt-range");
                const rubberMin = rubberIpts[i].querySelector(".rubber-ipt-min");
                const rubberMax = rubberIpts[i].querySelector(".rubber-ipt-max");

                // Reset the positions of rubberMin and rubberMax
                rubberMin.style.left = "0px";
                rubberMax.style.left = "0px";

                // Reset the width of the rubberRange
                rubberRange.style.width = "200px";

                // Call updateRubberRangeMin and updateRubberRangeMax to reset the range
                updateRubberRangeMin(0);
                updateRubberRangeMax(0);

                // Reset the minPrice and maxPrice values
                const minPrice = rubberIpts[i].querySelector(".rubber-value-min");
                const maxPrice = rubberIpts[i].querySelector(".rubber-value-max");
                minPrice.value = "10";
                maxPrice.value = "1000";
            }
        })

        const checkboxes = document.querySelectorAll('.check');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                handleCheckboxChange(checkbox);
            });
        });

        function handleCheckboxChange(checkbox) {
            // Get the value and ID of the clicked checkbox
            const value = checkbox.value;
            const id = checkbox.id;

            // Perform actions based on checkbox state (checked or unchecked)
            if (checkbox.checked) {
                // Checkbox is checked, do something
                if (!selectedValues.includes(value)) {
                    selectedValues.push(value);
                    document.querySelector("#checkedValues").value = selectedValues
                    localStorage.setItem(checkbox.id, 'checked');
                }
            } else {
                // Checkbox is unchecked, do something
                const index = selectedValues.indexOf(value);
                selectedValues.splice(index, 1);
                document.querySelector("#checkedValues").value = selectedValues
                localStorage.setItem(checkbox.id, 'unchecked');

            }
        }

        const rubberIpts = document.querySelectorAll(".rubber-ipt");

        for (var i = 0; i < rubberIpts.length; i++) {
            const rubberRange = rubberIpts[i].querySelector(".rubber-ipt-range");
            const rubberMin = rubberIpts[i].querySelector(".rubber-ipt-min");
            const rubberMax = rubberIpts[i].querySelector(".rubber-ipt-max");
            var initialMousePosMin;
            var initialMousePosMax;

            // Rubber Minimum
            rubberMin.style.left = "0px";

            function dragTargetMin(dragOffsetMin) {
                rubberMin.style.left = `${dragOffsetMin}px`;
            }

            function getDragOffsetMin(e) {
                if (initialMousePosMin == null) {
                    initialMousePosMin = e.clientX;
                }
                var mousePos = e.clientX;
                var dragOffsetMin = mousePos - initialMousePosMin;
                var rubberMinMax = 200 + parseInt(rubberMax.style.left, 10) - 10;

                if (dragOffsetMin < 0) {
                    dragOffsetMin = 0;
                } else if (dragOffsetMin > rubberMinMax) {
                    dragOffsetMin = rubberMinMax;
                }
                if (dragOffsetMin > 190) {
                    dragOffsetMin = 190;
                }

                dragTargetMin(dragOffsetMin);
                updateRubberRangeMin(dragOffsetMin);
                getMinPrice(dragOffsetMin);
            }

            function SetDragStartMin(e) {
                document.addEventListener("mousemove", getDragOffsetMin);
            }

            function stopDragMin() {
                document.removeEventListener("mousemove", getDragOffsetMin);
            }

            rubberMin.addEventListener("mousedown", SetDragStartMin);
            document.addEventListener("mouseup", stopDragMin);

            // Rubber Maximum
            rubberMax.style.left = "0px";

            function dragTargetMax(dragOffsetMax) {
                rubberMax.style.left = `${dragOffsetMax}px`;
            }

            function getDragOffsetMax(e) {
                if (initialMousePosMax == null) {
                    initialMousePosMax = e.clientX;
                }
                var mousePos = e.clientX;
                var dragOffsetMax = mousePos - initialMousePosMax;
                var rubberMaxMin = parseInt(rubberMin.style.left, 10) - 200 + 10;

                if (dragOffsetMax > 0) {
                    dragOffsetMax = 0;
                } else if (dragOffsetMax < rubberMaxMin) {
                    dragOffsetMax = rubberMaxMin;
                }
                if (dragOffsetMax < -190) {
                    dragOffsetMax = -190;
                }

                dragTargetMax(dragOffsetMax);
                updateRubberRangeMax(dragOffsetMax);
                getMaxPrice(dragOffsetMax);
            }

            function SetDragStartMax() {
                document.addEventListener("mousemove", getDragOffsetMax);
            }

            function stopDragMax() {
                document.removeEventListener("mousemove", getDragOffsetMax);
            }

            rubberMax.addEventListener("mousedown", SetDragStartMax);
            document.addEventListener("mouseup", stopDragMax);

            // Update Range between Min and Max

            rubberRange.style.width = "200px";

            function updateRubberRangeMin(dragOffsetMin) {
                rubberRange.style.left = `${dragOffsetMin}px`;

                var rubberRangeWidth =
                    200 - parseInt(rubberMax.style.left, 10) * -1 - dragOffsetMin;
                if (rubberRangeWidth <= 0) {
                    rubberRangeWidth = 0;
                }
                rubberRange.style.width = `${rubberRangeWidth}px`;
            }

            function updateRubberRangeMax(dragOffsetMax) {
                var rubberRangeWidth =
                    200 - parseInt(rubberMin.style.left, 10) - dragOffsetMax * -1;
                if (rubberRangeWidth <= 0) {
                    rubberRangeWidth = 0;
                }
                rubberRange.style.width = `${rubberRangeWidth}px`;
            }

            // Update price range

            const minPrice = rubberIpts[i].querySelector(".rubber-value-min");
            const maxPrice = rubberIpts[i].querySelector(".rubber-value-max");

            var RubberMinPrice = 10;
            var RubberMaxPrice = 1000;

            function getMinPrice(dragOffsetMin) {
                rubberMinPrice =
                    (RubberMaxPrice / 200) * dragOffsetMin +
                    (RubberMinPrice - (RubberMinPrice / 200) * dragOffsetMin);
                minPrice.value = `${rubberMinPrice}`;
            }

            function getMaxPrice(dragOffsetMax) {
                rubberMaxPrice =
                    (RubberMaxPrice / 200) * (dragOffsetMax + 200) +
                    (RubberMinPrice - (RubberMinPrice / 200) * (dragOffsetMax + 200));
                maxPrice.value = `${rubberMaxPrice}`;
            }
        }

    });
</script>
