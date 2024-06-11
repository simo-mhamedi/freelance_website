<head>
    <!-- Include necessary CSS and JavaScript libraries (e.g., Bootstrap and jQuery) -->

    <script>

        // Function to add a new row to the table
        function addRow() {
            var article = document.getElementById("articleInput").value;
            var description = document.getElementById("descriptionInput").value;
            var quantity = document.getElementById("quantityInput").value;
            var secteurDac = document.getElementById("secteurDacInput").value;
            var lieuDeLivraison = document.getElementById("lieuDeLivraisonInput").value;

            // Create a new row and populate it with the input values
            var table = document.getElementById("dataTable");
            var newRow = table.insertRow(-1);

            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);

            var cell6 = newRow.insertCell(5);

            cell1.innerHTML = article;
            cell2.innerHTML = description;
            cell3.innerHTML = quantity;


            // Add "Delete" and "Edit" buttons to the new row
            cell6.innerHTML = '<button class="btn btn-danger" onclick="deleteRow(this)">Delete</button>' +
                             '<button class="btn btn-primary" onclick="editRow(this)">Edit</button>';

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
        }

        // Function to save the updated row
        function saveRow() {
            // Get input values from the edit modal
            var article = document.getElementById("editArticleInput").value;
            var description = document.getElementById("editDescriptionInput").value;
            var quantity = document.getElementById("editQuantityInput").value;
            var secteurDac = document.getElementById("editSecteurDacInput").value;
            var lieuDeLivraison = document.getElementById("editLieuDeLivraisonInput").value;

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
@extends('base.index')
@section('content')
    <div class="backgroud-green">
        <p>update demande</p>
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
                            @foreach ($userCategorys as $subCagorie)
                                <li class="btn category-selected" id="sub-selected" value="{{ $subCagorie->Sub_categorie->id }}"
                                    style=" margin: 10px;" data-category="{{ $subCagorie->Sub_categorie->id }}">
                                    {{ $subCagorie->Sub_categorie->subCategoryName }}
                                    <i class="fa fa-close close"></i>
                                </li>
                            @endforeach
                    </ul>
                    <input type="hidden" id="myCategories" name="myCategories">
                </div>
        <div class="input_container">
            <label class="input_label" for="email_field">titre demande</label>
            <input value="{{$request_recu->title}}" name="title"style="padding:5px !important" placeholder="EX : DEVIS ALLIMINIUM pour 100 tonnes" title="Inpit title" name="input-name"
                type="text" class="input_field inp-title" id="email_field">
            </div>
            <div class="input_container">
                <label class="input_label" for="email_field">Lieu</label>

                <input required name="title"style="padding:5px !important" placeholder="Lieu"
                    title="Inpit title" value="{{$request_recu->lieu}}" name="input-name" type="text" class="input_field inp-lieu" id="email_field">
                </div>

            <div class="input_container">
                <table class="table" id="dataTable">
                    <thead>
                      <tr>
                        <th scope="col">Artciale</th>
                        <th scope="col">Description</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">actions</th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr id="editRowIdx">

                      </tr>
                      <?php foreach ($article as $item): ?>
                      <tr>
                        <td><?= $item->name ?></td>
                        <td><?= $item->description ?></td>
                        <td><?= $item->quantity ?></td>
                        <td>
                            <button class="btn btn-danger" onclick="deleteRow(this)">Delete</button>
                            <button class="btn btn-primary" onclick="editRow(this)">Edit</button>
                        </td>
                      </tr>
                    <?php endforeach; ?>

                    </tbody>
                  </table>
                  <button

                  data-toggle="modal" data-target="#deleteModal"
                  style="align-self: end" class="btn btn-success">add artciale</button>

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
                                    <input type="number" class="form-control" id="quantityInput" aria-describedby="emailHelp" >
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Secteur Dac</label>
                                    <input type="text" class="form-control" id="secteurDacInput" aria-describedby="emailHelp" placeholder="secteur Dac">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">lieu De Livraison</label>
                                    <input type="text" class="form-control" id="lieuDeLivraisonInput" aria-describedby="emailHelp" placeholder="Lieu de livraison">
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
                              <div class="form-group">
                                <label for="exampleInputEmail1">Secteur Dac</label>
                                <input type="text" class="form-control" id="editSecteurDacInput" aria-describedby="emailHelp" placeholder="secteur Dac">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">lieu De Livraison</label>
                                <input type="text" class="form-control" id="editLieuDeLivraisonInput" aria-describedby="emailHelp" placeholder="Lieu de livraison">
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
                <label class="input_label" for="email_field">DESCRIPTIF demande</label>

                <textarea id="desc"
                    style="background: #F2F5F2;
                border-radius: 14px;
                height: 309px;
                "
                    name="description" class="form-control description"
                    placeholder="EX : nous cherchons un devis pour notre société pour 100 tonnes d’alliminium...(150 mots)
                    "
                    id="exampleFormControlTextarea1" rows="3">{{$request_recu->description}}</textarea>
            </div>
        </div> --}}
        <div class="input_container">
            <div class="form-group">
                <label class="input_label" for="email_field">DESCRIPTIF demande</label>
                <input value="{{ $request_recu->date_deadline }}"
                type="date"
                style="padding: 6px !important; border-radius: 5px;"
                class="date_deadline"
                name="date_deadline">

            </div>
        </div>
        <div class="location">
            <label style="text-align: left" class="input_label" for="email_field">PRIX</label>
            <div class="input_container loca-infos">
                <div class="form-group">
                    <input type="checkbox" id="national" name="national" <?php if ($request_recu->national) echo 'checked'; ?> style="width: 12px; height: 12px;">
                    <label for="national">National</label>
                  </div>

                  <div class="form-group">
                    <input type="checkbox" id="international" name="international" <?php if ($request_recu->isInterNational) echo 'checked'; ?> style="width: 12px; height: 12px;">
                    <label for="international">International</label>
                  </div>
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
                        <input type="number"  value="{{$request_recu->price_min}}" class="input-min" name="price_min" value="2500">
                    </div>
                    <div class="separator">-</div>
                    <div class="field">
                        <span>Max</span>
                        <input type="number" value="{{$request_recu->price_max}}" class="input-max" name="price_max" value="7500">
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

            </div>
        </div>
        <input type="hidden" class="id" name="id" value="{{$request_recu->id}}">
        <button style="width: 50%" title="Sign In" type="submit" class="sign-in_btn next-btn">
            <span> Update demande</span>
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

            var jsonList = JSON.stringify(list);
            var title = JSON.stringify(document.querySelector(".inp-title").value);
            var lieu = JSON.stringify(document.querySelector(".inp-lieu").value);
            var interNational = JSON.stringify(document.querySelector("#international").checked);
            var national = JSON.stringify(document.querySelector("#national").checked);
            var date_deadline = JSON.stringify(document.querySelector(".date_deadline").value);
            var input_min = JSON.stringify(document.querySelector(".input-min").value);
            var input_max = JSON.stringify(document.querySelector(".input-max").value);
            var id = JSON.stringify(document.querySelector(".id").value);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/update-request-proceess',
                type: 'POST',
                data: {
                    id:id,
                    interNational:interNational,
                    national:national,
                    articls:data,
                    list: jsonList,
                    title: title,
                    lieu:lieu,
                    date_deadline: date_deadline,
                    input_min: input_min,
                    input_max: input_max
                },
                success: function(response) {
                    // Handle the response from the server
                    window.location.href = '{{ route('request') }}';
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
