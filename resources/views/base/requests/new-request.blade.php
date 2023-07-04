@extends('base.index')
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap");

    ::selection {
        color: #fff;
        background: #17a2b8;
    }

    .wrapper {
        margin-top: 20px;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        background: #fff;
        border-radius: 10px;
        padding: 20px 25px 40px;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
    }

    header h2 {
        font-size: 24px;
        font-weight: 600;
    }

    header p {
        margin-top: 5px;
        font-size: 16px;
    }

    .price-input {
        width: 100%;
        display: flex;
        margin: 30px 0 35px;
    }

    .price-input .field {
        display: flex;
        width: 100%;
        height: 45px;
        align-items: center;
    }

    .field input {
        width: 100%;
        height: 100%;
        outline: none;
        font-size: 19px;
        margin-left: 12px;
        border-radius: 5px;
        text-align: center;
        border: 1px solid #999;
        -moz-appearance: textfield;
    }

    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }

    .price-input .separator {
        width: 130px;
        display: flex;
        font-size: 19px;
        align-items: center;
        justify-content: center;
    }

    .slider {
        height: 5px;
        position: relative;
        background: #ddd;
        border-radius: 5px;
    }

    .slider .progress {
        height: 100%;
        left: 25%;
        right: 25%;
        position: absolute;
        border-radius: 5px;
        background: rgba(0, 164, 83, 1);

    }

    .range-input {
        position: relative;
    }

    .range-input input {
        position: absolute;
        width: 100%;
        height: 5px;
        top: -5px;
        background: none;
        pointer-events: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    input[type="range"]::-webkit-slider-thumb {
        height: 17px;
        width: 17px;
        border-radius: 50%;
        background: rgba(0, 164, 83, 1);
        pointer-events: auto;
        -webkit-appearance: none;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
    }

    input[type="range"]::-moz-range-thumb {
        height: 17px;
        width: 17px;
        border: none;
        border-radius: 50%;
        background: rgba(0, 164, 83, 1);
        pointer-events: auto;
        -moz-appearance: none;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
    }

    /* Support */
    .support-box {
        top: 2rem;
        position: relative;
        bottom: 0;
        text-align: center;
        display: block;
    }

    .b-btn {
        color: white;
        text-decoration: none;
        font-weight: bold;
    }

    .b-btn.paypal i {
        color: blue;
    }

    .b-btn:hover {
        text-decoration: none;
        font-weight: bold;
    }

    .b-btn i {
        font-size: 20px;
        color: yellow;
        margin-top: 2rem;
    }

    .container {
        width: 1180px;
        margin-top: 3em;
    }

    #accordion {
        width: 100%;
    }

    #accordion .panel {
        border-radius: 5px;
        border: 0;
        margin-top: 0px;
    }

    #accordion a {
        display: block;
        padding: 10px 15px;
        border-radius: 10px;
        text-decoration: none;
        background-color: #00A453;
        font-style: normal;
        font-weight: 600;
        font-size: 22px;
        line-height: 22px;
        /* identical to box height, or 84% */
        text-transform: uppercase;

        color: #FEF9F9;

        text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    }

    #accordion .panel-heading a.collapsed:hover,
    #accordion .panel-heading a.collapsed:focus {
        color: white;
        transition: all 0.2s ease-in;
    }

    #accordion .panel-heading a.collapsed:hover::before,
    #accordion .panel-heading a.collapsed:focus::before {
        color: white;
    }

    #accordion .panel-heading {
        padding: 0;
        border-radius: 0px;
        text-align: center;
    }

    #accordion .panel-heading a:not(.collapsed) {
        color: white;
        transition: all 0.2s ease-in;
        border-radius: 5px;
    }

    /* Add Indicator fontawesome icon to the left */
    #accordion .panel-heading .accordion-toggle::before {
        font-family: 'FontAwesome';
        float: left;
        color: white;
        font-weight: lighter;
        transform: rotate(0deg);
        transition: all 0.2s ease-in;
    }

    #accordion .panel-heading .accordion-toggle.collapsed::before {
        color: #444;
        transform: rotate(-135deg);
        transition: all 0.2s ease-in;
    }

    .sub {
        background: #4C78AF !important;
        border-radius: 12px !important;
        font-style: normal;
        font-weight: 600;
        font-size: 15px !important;
        line-height: 22px;
        /* identical to box height, or 109% */

        align-items: center;
        text-transform: uppercase;

        color: #FFFFFF;
    }

    .sub:hover {
        background-color: #FFFFFF;
        color: black
    }

    .category-selected {
        margin: 20px;
        width: 22%;
        background: #E2E3E4 !important;
        border-radius: 12px !important;
        font-style: normal;
        font-weight: 600;
        font-size: 10px !important;
        line-height: 22px;
        /* identical to box height, or 145% */
        align-items: center;
        text-transform: uppercase;
        padding: 4px !important;
        color: #FFFFFF;
        position: relative;
    }

    .close {
        color: rgba(0, 0, 0, 0.4);
        position: absolute;
        right: 9px;
        top: 5px;
    }

    #second-list {
        padding: 0px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@section('content')
    <div class="backgroud-green">
        <p>deposer une nouvelle demande</p>
    </div>
    <div class="form_container" style="
position:absolute !important;
top: 250px;
    left: 30%;
">
        <div class="input_container">
            <label class="input_label" for="email_field">titre demande</label>
            <input name="title"style="padding:5px !important" placeholder="EX : DEVIS ALLIMINIUM pour 100 tonnes" title="Inpit title" name="input-name"
                type="text" class="input_field inp-title" id="email_field">
        </div>
        <div class="input_container">
            <div class="form-group">
                <label class="input_label" for="email_field">DESCRIPTIF demande</label>

                <textarea id="desc"
                    style="background: #F2F5F2;
                border-radius: 14px;
                height: 309px;
                "
                    name="description" class="form-control description"
                    placeholder="EX : nous cherchons un devis pour notre société pour 100 tonnes d’alliminium...(150 mots)
                    "
                    id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </div>
        <div class="input_container">
            <div class="form-group">
                <label class="input_label" for="email_field">DESCRIPTIF demande</label>
                <input type="date" style="padding: 6px !important ;border-reduis:5px" class="date_deadline" name="date_deadline">
            </div>
        </div>
        <div class="input_container">
            <div class="wrapper">
                <header>
                    <h2>Price Range</h2>
                    <p>Use slider or enter min and max price</p>
                </header>
                <div class="price-input">
                    <div class="field">
                        <span>Min</span>
                        <input type="number" class="input-min" name="price_min" value="2500">
                    </div>
                    <div class="separator">-</div>
                    <div class="field">
                        <span>Max</span>
                        <input type="number" class="input-max" name="price_max" value="7500">
                    </div>
                </div>
                <div class="slider">
                    <div class="progress"></div>
                </div>
                <div class="range-input">
                    <input type="range" class="range-min" min="0" max="10000" value="2500" step="100">
                    <input type="range" class="range-max" min="0" max="10000" value="7500" step="100">
                </div>
            </div>
        </div>
        <div class="container">
            <div id="accordion" class="panel-group">
                <div class="panel">
                    @foreach ($categories as $categorie)
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#{{ $categorie->id }}" class="accordion-toggle" data-toggle="collapse"
                                    data-parent="#accordion">{{ $categorie->categoryName }}</a>
                            </h4>
                        </div>
                        <div id="{{ $categorie->id }}" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <ul style="padding:0px;" id="first-list">
                                    <center>
                                        @foreach ($subCagories as $subCagorie)
                                            @if ($subCagorie->category_id == $categorie->id)
                                                <li class="btn btn-primary sub" id="sub" value="{{ $subCagorie->id }}"
                                                    style=" margin: 10px;" data-category="{{ $subCagorie->id }}">
                                                    {{ $subCagorie->subCategoryName }}</li>
                                            @endif
                                        @endforeach
                                        <!-- Add more categories as needed -->
                                    </center>
                                </ul>
                            </div>
                        </div>
                    @endforeach

                </div>
                {{-- <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#panelBodyTwo" class="accordion-toggle collapsed" data-toggle="collapse"
                                data-parent="#accordion">Categorie 2</a>
                        </h4>
                    </div>
                    <div id="panelBodyTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>Energistically drive standardized communities through user friendly results.
                                Phosfluorescently initiate superior technologies vis-a-vis low-risk high-yield solutions.
                                Objectively facilitate clicks-and-mortar partnerships vis-a-vis superior partnerships.
                                Continually generate long-term high-impact methodologies via wireless leadership. Holisticly
                                seize resource maximizing solutions via user friendly outsourcing.</p>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#panelBodyThree" class="accordion-toggle collapsed" data-toggle="collapse"
                                data-parent="#accordion">Categorie 3</a>
                        </h4>
                    </div>
                    <div id="panelBodyThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>Energistically drive standardized communities through user friendly results.
                                Phosfluorescently initiate superior technologies vis-a-vis low-risk high-yield solutions.
                                Objectively facilitate clicks-and-mortar partnerships vis-a-vis superior partnerships.
                                Continually generate long-term high-impact methodologies via wireless leadership. Holisticly
                                seize resource maximizing solutions via user friendly outsourcing.</p>
                        </div>
                    </div>
                </div> --}}

                <div class="form-group">

                    <ul style="padding:0px;" class="myList" id="second-list">
                        <center>

                        </center>
                    </ul>
                    <input type="hidden" id="myCategories" name="myCategories">
                </div>
            </div>
        </div>
        <button style="width: 50%" title="Sign In" type="submit" class="sign-in_btn next-btn">
            <span> Déposer demande</span>
        </button>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    addEventListener("DOMContentLoaded", (event) => {
        $("form").on("change", ".file-upload-field", function() {
            $(this).parent(".file-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/,
                ''));
        });

        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        let priceGap = 1000;

        priceInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);

                if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });

        rangeInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);

                if (maxVal - minVal < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap;
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });
        var count = 0;
        var firstLists = document.querySelectorAll('#first-list');
        Array.from(firstLists).forEach(function(firstList) {
            firstList.addEventListener('click', function(event) {
                var category = event.target;
                if (category.id === "sub") {
                    var categorySelector = '[data-category="' + category.dataset.category +
                        '"]';
                    var duplicateCategory = document.getElementById('second-list')
                        .querySelector(categorySelector);

                    if (!duplicateCategory && count < 5) {
                        count++;
                        // Clone the category and add it to the second list
                        var clonedCategory = category.cloneNode(true);
                        clonedCategory.className = "btn category-selected";
                        var close = document.createElement('i');
                        close.className = "fa fa-close close";
                        clonedCategory.appendChild(close);
                        console.log(clonedCategory);
                        clonedCategory.id = 'sub-selected';
                        document.getElementById('second-list').appendChild(clonedCategory);

                    }
                }
            });
        });
        document.querySelector('.next-btn').addEventListener('click', function(event) {
            console.log("ss");
            var listItems = Array.from(document.querySelector('.myList').getElementsByTagName('li'));
            var list = listItems.map(function(item) {
                return item.value;
            });

            var jsonList = JSON.stringify(list);
            var title = JSON.stringify(document.querySelector(".inp-title").value);
            var description = JSON.stringify(document.querySelector(".description").value);
            var date_deadline = JSON.stringify(document.querySelector(".date_deadline").value);
            var input_min = JSON.stringify(document.querySelector(".input-min").value);
            var input_max = JSON.stringify(document.querySelector(".input-max").value);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/save-new-request',
                type: 'POST',
                data: {
                    list: jsonList,
                    title: title,
                    description: description,
                    date_deadline: date_deadline,
                    input_min: input_min,
                    input_max: input_max
                },
                success: function(response) {
                    // Handle the response from the server
                    window.location.href = '{{ route('dashboard') }}';
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

        // Event listener for clicking on categories in the second list
        document.getElementById('second-list').addEventListener('click', function(event) {
            var category = event.target;
            if (category.className == "fa fa-close close") {
                category.parentElement.parentNode.removeChild(category.parentElement);
            }
            // Remove the category from the second list
        });
    });
</script>
