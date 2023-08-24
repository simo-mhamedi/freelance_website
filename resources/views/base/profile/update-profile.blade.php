@extends('base.index')
<style>
    .input_field {
        padding: 10px !important;
    }

    .company-infos .input_field {
        background: #F2F5F2 !important;
    }

    label {
        color: #000;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: 21.76px;
        /* 108.8% */
        text-transform: uppercase;
        margin-bottom: 5px
    }

    .user-infos {
        width: 50%;
        padding: 10px 20px 10px 20px;
        border-radius: 14px;
        background: #F2F5F2;
    }

    .av-update-btn .btn-success {
        background: white !important;
        color: #108A00 !important;
        border-color: #108A00 !important;
        font-weight: bold;
        border-radius: 10px;

    }

    .avatar {
        border: #108A00 solid 1px;
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

    .header {
        padding: 10px 60px 10px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .company-infos {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px
    }

    textarea {
        flex-shrink: 0;
        border-radius: 14px !important;
        background: #F2F5F2 !important;
    }

    .update-pro {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 20px;
    }

    .body {
        display: flex;
        flex-direction: column;
        justify-items: center;
        padding: 20px;
    }

    /* Style for the custom file button */
    .custom-file-button {
        display: inline-block;
        padding: 8px 16px;
        border: 2px solid #28a745;
        border-radius: 4px;
        color: #fff;
        background-color: #28a745;
        cursor: pointer;
    }

    /* Hide the default input file element */
    .hidden-input {
        display: none;
    }
</style>
@section('content')
    <div class="request-title" style="text-align: left !important;">Modifier mon profil</div>
    <div class="update-pro">
        <div class="header">
            <div class="user-infos">
                <br>
                <div class="input_container">
                    <label for="">represantant société
                    </label>
                    <input value="{{ $user->name }}" placeholder="NOM" title="Inpit title" id="name"
                        type="text" class="input_field edit-name" id="societeName">
                </div>
                <br>
                <div class="input_container">
                    <label for="">Email
                    </label>
                    <input value="{{ $user->email }}" placeholder="Email" title="Inpit title" name="email" type="text"
                        class="input_field email" id="companyRepresentative">
                </div>
                <br>
                <label for="">localisation

                </label>
                <div class="input_container country">

                    <div class="form-item">
                        <input id="country_selector" value="{{ $user->country }}" class="form-control"
                            name="country" type="text">
                        <label for="country_selector" style="display:none;">Select a country here...</label>
                    </div>
                    <div class="form-item" style="display:none;">
                        <input type="text" class="form-control" id="country_selector_code" name="country_selector_code"
                            data-countrycodeinput="1" readonly="readonly"
                            placeholder="Selected country code will appear here" />
                        <label for="country_selector_code">...and the selected country code will be updated here</label>
                    </div>
                    <button type="submit" style="display:none;">Submit</button>

                    <div class="input_container city">
                        <input placeholder="City" required title="Inpit title" id="city" type="text"
                            class="input_field city-input city" id="rsSociete" value="{{ $user->city }}">
                    </div>
                </div>
                <br>
                <div class="input_container">
                    <label for="">Numéro de telephone


                    </label>
                    <input type="hidden" name="areaCode" value="+44" class="areaCode">
                    <div class="select-box">
                        <div class="selected-option">
                            <div>
                                <span class="iconify" data-icon="flag:gb-4x3"></span>
                                <strong>+44</strong>
                            </div>
                            <input type="tel" value="{{ $user->tele }}" class="tele" required name="tel"
                                placeholder="Phone Number">
                        </div>
                        <div class="options">
                            <input type="text" class="search-box" placeholder="Search Country Name">
                            <ol>

                            </ol>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="company-infos">
                <div class="av-update-btn">
                    <label for="readUrl" class="btn btn-success custom-file-button">
                        Edit Profile
                    </label>
                    <input class="hidden-input photo " type="file" id="readUrl" (change)="onFileSelected($event)">

                </div>
                <img class="avatar" id="uploadedImage" alt="Uploaded Image" accept="image/png, image/jpeg"
                    src="{{ asset('storage/users-avatar/' . $user->avatar) }}">
                <input placeholder="societe Name" value="{{ $user->companyName }}" title="Inpit title" name="societeName"
                    type="text" class="input_field companyName" id="societeName">
                <input placeholder="RC" value="{{ $user->rcCompany }}" title="Inpit title" name="societeName" type="text"
                    class="input_field rc" id="societeName">
            </div>
        </div>
        <div class="body">
            <div class="category-infos">
                <div class="desc-company">
                    <div class="form-group">
                        <label for="my-input">PRésentation société
                        </label>
                        <textarea name="" placeholder="Description de la société (max 150 mots)..." class="form-control desc"
                            cols="25" rows="8">{{ $user->desc_Activity }}</textarea>
                    </div>
                </div>
                <div class="container" style="max-width: 100% !important">
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
                                                        <li class="btn btn-primary sub" id="sub"
                                                            value="{{ $subCagorie->id }}" style=" margin: 10px;"
                                                            data-category="{{ $subCagorie->id }}">
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
                                @foreach ($userCategorys as $subCagorie)
                                    <li class="btn category-selected" id="sub-selected"
                                        value="{{ $subCagorie->Sub_categorie->id }}" style=" margin: 10px;"
                                        data-category="{{ $subCagorie->Sub_categorie->id }}">
                                        {{ $subCagorie->Sub_categorie->subCategoryName }}
                                        <i class="fa fa-close close"></i>
                                    </li>
                                @endforeach
                            </ul>
                            <input type="hidden" id="myCategories" name="myCategories">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-success next-btn" style="width: 10%;margin-left:auto;margin-right:auto;">modifier</button>
    </div>
@endsection
<script>
    addEventListener("DOMContentLoaded", (event) => {
        $("form").on("change", ".file-upload-field", function() {
            $(this).parent(".file-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/,
                ''));
        });
        document.getElementById('readUrl').addEventListener('change', function() {
            if (this.files[0]) {
                var picture = new FileReader();
                picture.readAsDataURL(this.files[0]);
                picture.addEventListener('load', function(event) {
                    document.getElementById('uploadedImage').setAttribute('src', event.target
                        .result);
                    document.getElementById('uploadedImage').style.display = 'block';
                });
            }
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
            var listItems = Array.from(document.querySelector('.myList').getElementsByTagName('li'));
            var list = listItems.map(function(item) {
                return item.value;
            });
            var jsonList = JSON.stringify(list);
            var name = document.querySelector("#name").value;
            var mail = document.querySelector(".email").value;
            var country = document.querySelector("#country_selector").value;
            console.log();
            var city = document.querySelector("#city").value;
            var tele = document.querySelector(".tele").value;
            var areaCode = document.querySelector(".areaCode").value;
            var desc = document.querySelector(".desc").value;
            var rc = document.querySelector(".rc").value;
            var companyName = document.querySelector(".companyName").value;
            var photoInput = document.querySelector(".photo");

            var formData = new FormData();
            formData.append('name', name);
            formData.append('list', jsonList);
            formData.append('mail', mail);
            formData.append('country', country);
            formData.append('city', city);
            formData.append('tele', tele);
            formData.append('areaCode', areaCode);
            formData.append('desc', desc);
            formData.append('rc', rc);
            formData.append('companyName', companyName);
            formData.append('photo', photoInput.files[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/update-profile-infos-process',
                type: 'POST',
                data: formData,
                processData: false, // Important! To prevent jQuery from processing the FormData
                contentType: false, // Important! To prevent jQuery from setting the Content-Type header
                success: function(response) {
                   window.location.href = '{{ route('update-profile-infos') }}';

                },
                error: function(error) {
                    // Handle the error (if any)
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
