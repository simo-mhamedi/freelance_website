@extends('base.index')

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
            <input required name="title"style="padding:5px !important" placeholder="EX : DEVIS ALLIMINIUM pour 100 tonnes" title="Inpit title" name="input-name"
                type="text" class="input_field inp-title" id="email_field">
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
                <input required type="date" style="padding: 6px !important ;border-reduis:5px" class="date_deadline" name="date_deadline">
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
