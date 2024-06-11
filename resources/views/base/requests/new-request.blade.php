@extends('base.index')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<head>
    <!-- Include necessary CSS and JavaScript libraries (e.g., Bootstrap and jQuery) -->

    <script>

        // Function to add a new row to the table
        function addRow() {
            var article = document.getElementById("articleInput").value;
            var description = document.getElementById("descriptionInput").value;
            var quantity = document.getElementById("quantityInput").value;

            if (article === "" || description === "" || quantity === "" ) {
                console.log("error");
                Swal.fire({
                    title: "Erreur!",
                    text: "Veuillez remplir tous les champs.",
                    icon: "error"
                });
                return;
            }
            // Create a new row and populate it with the input values
            var table = document.getElementById("dataTable");
            var newRow = table.insertRow(-1);

            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell6 = newRow.insertCell(3);

            cell1.innerHTML = article;
            cell2.innerHTML = description;
            cell3.innerHTML = quantity;


            // Add "Delete" and "Edit" buttons to the new row
            cell6.innerHTML = '<button class="btn btn-danger" onclick="deleteRow(this)" ><i  style="color:white" class="fa fa-trash"></i></button>' +
                             '<button class="btn btn-primary" onclick="editRow(this)"><i style="color:white" class="fa fa-refresh"></i></button>';
                             cell6.style.display = "flex";
                             cell6.style.gap = "5px";

            // Clear the input fields
            document.getElementById("articleInput").value = '';
            document.getElementById("descriptionInput").value = '';
            document.getElementById("quantityInput").value = '';

        }

        // Function to delete a row
        function deleteRow(row) {
            var i = row.parentNode.parentNode.rowIndex;
            document.getElementById("dataTable").deleteRow(i);
        }

        // Function to populate the modal for updating a row
        function editRow(row) {
            $('#editModal').modal('show');
            var i = row.parentNode.parentNode.rowIndex;
            var table = document.getElementById("dataTable");
            var cells = table.rows[i].cells;
            var article = cells[0].innerHTML;
            var description = cells[1].innerHTML;
            var quantity = cells[2].innerHTML;
            // Populate the modal fields with the row data
            document.getElementById("editArticleInput").value = article;
            document.getElementById("editDescriptionInput").value = description;
            document.getElementById("editQuantityInput").value = quantity;
            document.getElementById("editRowIdx").value = i;
            // Show the modal for editing
            if (article === "" || description === "" || quantity === "") {
                    console.log("error");
                    Swal.fire({
                        title: "Erreur!",
                        text: "Veuillez remplir tous les champs.",
                        icon: "error"
                    });
                    return;
                }
        }

        // Function to save the updated row
        function saveRow() {
            // Get input values from the edit modal
            var article = document.getElementById("editArticleInput").value;
            var description = document.getElementById("editDescriptionInput").value;
            var quantity = document.getElementById("editQuantityInput").value;
            // Update the row with the new values
            var i = $('#editRowIdx').val();
            var table = document.getElementById("dataTable");
            var cells = table.rows[i].cells;
            cells[0].innerHTML = article;
            cells[1].innerHTML = description;
            cells[2].innerHTML = quantity;
            // Hide the edit modal
            $('#editModal').modal('hide');
        }
    </script>
</head>
<style>
    .span {
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
        -moz-appearance: textfield;
        width: 100px;
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
    th{
        background-color: green !important;
        color: white;
    }

    .range-slider {
        display: none;
        /* Initially hide the range slider */
    }
    .modal-dialog
    .form-group{
        width: 100%;
    }
    .loca-infos{
        display: flex !important;
        flex-direction: row !important;
        align-items: left !important;
        gap: 20px !important;
    }
    .location{
        align-self: normal;
    }
    .categotys{
        display: flex !important;
        flex-direction: column !important;
        align-content: center !important;
        justify-content: flex-start !important
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
  <div class="container categotys">
    <label class="input_label" for="email_field">Pouvez-vous s'il vous plaît sélectionner les catégories qui font référence à cette demande</label>

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
        <div class="input_container">
            <label class="input_label" for="email_field">TITRE DEMANDE</label>

            <input required name="title"style="padding:5px !important" placeholder="EX : DEVIS ALLIMINIUM pour 100 tonnes"
                title="Inpit title" name="input-name" type="text" class="input_field inp-title" id="email_field">
            </div>
            {{-- <div class="input_container">
                <label class="input_label" for="email_field">Lieu</label>

                <input required name="title"style="padding:5px !important" placeholder="Lieu"
                    title="Inpit title" name="input-name" type="text" class="input_field inp-lieu" id="email_field">
                </div> --}}

            <div class="input_container">
                <label class="input_label" for="email_field">Country</label>

                <select class="input_field"style="padding:5px !important" id="country" name="country">
                    <option value="">Select Country</option>
                    @foreach($countriesObjects as $country)
                        <option value="{{ $country->code }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>

                <div class="input_container">
                    <label class="input_label" for="email_field">City</label>

                    <select class="input_field"style="padding:5px !important" id="city" name="state">
                        <option value="">Select city</option>
                        @foreach($states as $state)
                            <option value="{{ $state }}">{{ $state }}</option>
                        @endforeach
                    </select>
            </div>

            <table class="table" id="dataTable" style="border-raduis:10px ">
                <thead >
                  <tr style="font-size:13px" >
                    <th scope="col" style="border-top-left-radius: 10px">Artciale</th>
                    <th scope="col">Description</th>
                    <th scope="col">Quantity</th>
                    <th scope="col" style="border-top-right-radius: 10px">actions</th>
                </tr>
                </thead>
                <tbody>
                  <tr id="editRowIdx">

                  </tr>

                </tbody>
              </table>
              <button

              data-toggle="modal" data-target="#deleteModal"
              style="align-self: end ;font-size:9px" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add article</button>

              <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
              aria-labelledby="deleteModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="deleteModalLabel">Add article</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Artciale</label>
                              <input type="text" class="form-control" id="articleInput" aria-describedby="emailHelp" placeholder="article">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea class="form-control" id="descriptionInput" rows="10"></textarea>
                            </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Quantity</label>
                                <input type="number" class="form-control" style="text-align: left; font-size:12px" id="quantityInput" aria-describedby="emailHelp" >
                              </div>
                      </div>
                      <div class="modal-footer">
                        <button data-toggle="modal"   data-dismiss="modal" onclick="addRow()" data-target="#addModal" class="btn btn-success">Add Article</button>



                      </div>
                  </div>
              </div>
          </div>

          <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
          aria-labelledby="deleteModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="deleteModalLabel">update article</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Artciale</label>
                          <input type="text" class="form-control" id="editArticleInput" aria-describedby="emailHelp" placeholder="article">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea class="form-control" id="editDescriptionInput" rows="10"></textarea>
                        </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Quantity</label>
                            <input type="number" class="form-control" id="editQuantityInput" aria-describedby="emailHelp" >
                          </div>
                  </div>
                  <div class="modal-footer">
                    <button data-toggle="modal"   data-dismiss="modal" onclick="saveRow()" data-target="#addModal" class="btn btn-success">update Article</button>



                  </div>
              </div>
          </div>
      </div>
            {{-- <div class="input_container">
            <div class="form-group">
                <label class="input_label" for="email_field">DESCRIPTIF DEMANDE</label>

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
        </div> --}}
        <div class="input_container">
            <div class="form-group">
                <label class="input_label" for="email_field">DEADLINE</label>
                <input required type="date" style="padding: 6px !important ;border-reduis:5px" class="date_deadline"
                    name="date_deadline">
            </div>
        </div>
        <div class="location">
            <label style="text-align: left" class="input_label" for="email_field">type</label>
            <div class="input_container loca-infos">
                <div class="form-group">
                    <input type="checkbox" style="width: 12px;height:12px" id="national">
                    National
                </div>
                <div class="form-group">
                    <input type="checkbox" style="width: 12px;height:12px" id="international">
                    International
                </div>
            </div>
        </div>

        <div class="input_container">

            <div class="form-group">
                <label style="text-align: left" class="input_label" for="email_field">PRIX</label>
                <input type="checkbox" style="width: 12px;height:12px" id="show_range">
                (optional)
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

        <button style="width: 50%" title="Sign In" type="submit" class="sign-in_btn next-btn">
            <span> Déposer demande</span>
        </button>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    addEventListener("DOMContentLoaded", (event) => {
        // Function to add a new row to the table

        document.getElementById('country').addEventListener('change', function () {
        var country = this.value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/get-cities?country=' + country, true);
        xhr.onload = function () {
            var cities = JSON.parse(xhr.responseText);

            var citySelect = document.getElementById('city');
            citySelect.innerHTML = '<option value="">Select city</option>';
            for (var code in cities) {
            if (cities.hasOwnProperty(code)) {
                var option = document.createElement('option');
                option.value = cities[code];
                option.text = cities[code];
                citySelect.appendChild(option);
            }
        }
        };
        xhr.send();
    });

        document.querySelector("#show_range").onchange = () => {
                var rangeSlider = document.querySelector('.range-slider');
                var checkbox = document.querySelector('#show_range');

                if (checkbox.checked) {
                    rangeSlider.style.display = 'block'; // Show the range slider
                } else {
                    rangeSlider.style.display = 'none'; // Hide the range slider
                }
            }
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
            var table = document.getElementById('dataTable');
            // Get all the rows in the table body
            var rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            // Initialize an array to store the data
            var data = [];
            // Iterate through the rows and cells to collect the data
            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                var rowData = [];

                for (var j = 0; j < cells.length; j++) {
                    rowData.push(cells[j].textContent.trim());
                }

                data.push(rowData);
            }
            var listItems = Array.from(document.querySelector('.myList').getElementsByTagName('li'));
            var list = listItems.map(function(item) {
                return item.value;
            });

            var selectElements = document.getElementsByTagName("select");
            var selectedCountry = selectElements[0].value;
            var selectedCity = selectElements[1].value;
            console.log(selectedCity);
            var jsonList = JSON.stringify(list);
            var title = JSON.stringify(document.querySelector(".inp-title").value);
            var date_deadline = JSON.stringify(document.querySelector(".date_deadline").value);
            var interNational = JSON.stringify(document.querySelector("#international").checked);
            var national = JSON.stringify(document.querySelector("#national").checked);
            var input_min = null;
            var input_max = null;
            if (document.querySelector("#show_range").checked) {
                input_min = JSON.stringify(document.querySelector(".input-min").value);
                input_max = JSON.stringify(document
                    .querySelector(".input-max").value);
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/save-new-request',
                type: 'POST',
                data: {
                    selectedCountry,
                    selectedCity,
                    interNational:interNational,
                    national:national,
                    articls:data,
                    list: jsonList,
                    title: title,
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
