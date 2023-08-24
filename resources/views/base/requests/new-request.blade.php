@extends('base.index')
<style>
    .span{
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }
    .range-slider {
        width: 100%;
        margin: auto;
        text-align: center;
        position: relative;
        height: 6em;
    }

    .range-slider svg,
    .range-slider input[type=range] {
        position: absolute;
        left: 0;
        bottom: 0;
    }

    input[type=number] {
        border: 1px solid #ddd;
        text-align: center;
        font-size: 1.6em;
        -moz-appearance: textfield;
    }

    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }

    input[type=number]:invalid,
    input[type=number]:out-of-range {
        border: 2px solid #ff6347;
    }

    input[type=range] {
        -webkit-appearance: none;
        width: 100%;
    }

    input[type=range]:focus {
        outline: none;
    }

    input[type=range]:focus::-webkit-slider-runnable-track {
        background: green;
    }

    input[type=range]:focus::-ms-fill-lower {
        background: green;
    }

    input[type=range]:focus::-ms-fill-upper {
        background: green;
    }

    input[type=range]::-webkit-slider-runnable-track {
        width: 100%;
        height: 5px;
        cursor: pointer;
        animate: 0.2s;
        background: green;
        border-radius: 1px;
        box-shadow: none;
        border: 0;
    }

    input[type=range]::-webkit-slider-thumb {
        z-index: 2;
        position: relative;
        box-shadow: 0px 0px 0px #000;
        border: 1px solid green;
        height: 18px;
        width: 18px;
        border-radius: 25px;
        background: #a1d0ff;
        cursor: pointer;
        -webkit-appearance: none;
        margin-top: -7px;
    }

    input[type=range]::-moz-range-track {
        width: 100%;
        height: 5px;
        cursor: pointer;
        animate: 0.2s;
        background: green;
        border-radius: 1px;
        box-shadow: none;
        border: 0;
    }

    input[type=range]::-moz-range-thumb {
        z-index: 2;
        position: relative;
        box-shadow: 0px 0px 0px #000;
        border: 1px solid #green;
        height: 18px;
        width: 18px;
        border-radius: 25px;
        background: #a1d0ff;
        cursor: pointer;
    }

    input[type=range]::-ms-track {
        width: 100%;
        height: 5px;
        cursor: pointer;
        animate: 0.2s;
        background: transparent;
        border-color: transparent;
        color: transparent;
    }

    input[type=range]::-ms-fill-lower,
    input[type=range]::-ms-fill-upper {
        background: green;
        border-radius: 1px;
        box-shadow: none;
        border: 0;
    }

    input[type=range]::-ms-thumb {
        z-index: 2;
        position: relative;
        box-shadow: 0px 0px 0px #000;
        border: 1px solid green;
        height: 18px;
        width: 18px;
        border-radius: 25px;
        background: #a1d0ff;
        cursor: pointer;
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
            <input required name="title"style="padding:5px !important" placeholder="EX : DEVIS ALLIMINIUM pour 100 tonnes"
                title="Inpit title" name="input-name" type="text" class="input_field inp-title" id="email_field">
        </div>
        <div class="input_container">
            <div class="form-group">
                <label class="input_label" for="email_field">DESCRIPTIF demande</label>

                <textarea required id="desc"
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
                <input required type="date" style="padding: 6px !important ;border-reduis:5px" class="date_deadline"
                    name="date_deadline">
            </div>
        </div>
        <div class="range-slider">
            <span class="span">
                <input type="number" class="input-min" value="25000" min="0" max="120000" />
                <input type="number" value="50000" class="input-max" min="0" max="120000" />
            </span>
            <input value="25000" min="0" max="120000" step="500" type="range" />
            <input value="50000" min="0" max="120000" step="500" type="range" />
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
        (function() {
            var parent = document.querySelector(".range-slider");
            if (!parent) return;

            var rangeS = parent.querySelectorAll("input[type=range]"),
                numberS = parent.querySelectorAll("input[type=number]");

            rangeS.forEach(function(el) {
                el.oninput = function() {
                    var slide1 = parseFloat(rangeS[0].value),
                        slide2 = parseFloat(rangeS[1].value);

                    if (slide1 > slide2) {
                        [slide1, slide2] = [slide2, slide1];
                        // var tmp = slide2;
                        // slide2 = slide1;
                        // slide1 = tmp;
                    }

                    numberS[0].value = slide1;
                    numberS[1].value = slide2;
                };
            });

            numberS.forEach(function(el) {
                el.oninput = function() {
                    var number1 = parseFloat(numberS[0].value),
                        number2 = parseFloat(numberS[1].value);

                    if (number1 > number2) {
                        var tmp = number1;
                        numberS[0].value = number2;
                        numberS[1].value = tmp;
                    }

                    rangeS[0].value = number1;
                    rangeS[1].value = number2;
                };
            });
        })();

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
