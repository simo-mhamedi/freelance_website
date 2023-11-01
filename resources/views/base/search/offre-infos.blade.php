@extends('base.index')

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
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);
            var cell6 = newRow.insertCell(5);

            cell1.innerHTML = article;
            cell2.innerHTML = description;
            cell3.innerHTML = quantity;
            cell4.innerHTML = secteurDac;
            cell5.innerHTML = lieuDeLivraison;

            // Add "Delete" and "Edit" buttons to the new row
            cell6.innerHTML = '<button class="btn btn-danger" onclick="deleteRow(this)">Delete</button>' +
                             '<button class="btn btn-primary" onclick="editRow(this)">Edit</button>';

            // Clear the input fields
            document.getElementById("articleInput").value = '';
            document.getElementById("descriptionInput").value = '';
            document.getElementById("quantityInput").value = '';
            document.getElementById("secteurDacInput").value = '';
            document.getElementById("lieuDeLivraisonInput").value = '';

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
            var secteurDac = cells[3].innerHTML;
            var lieuDeLivraison = cells[4].innerHTML;

            // Populate the modal fields with the row data
            document.getElementById("editArticleInput").value = article;
            document.getElementById("editDescriptionInput").value = description;
            document.getElementById("editQuantityInput").value = quantity;
            document.getElementById("editSecteurDacInput").value = secteurDac;
            document.getElementById("editLieuDeLivraisonInput").value = lieuDeLivraison;
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
            cells[3].innerHTML = secteurDac;
            cells[4].innerHTML = lieuDeLivraison;

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
    .header{
        display: flex;
        flex-direction: row;
        align-content: center;
        justify-content: space-between;
        gap: 100px;
    }
    .header span{
        font-weight: bold
    }
    .header div{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 5px;
        font-weight: 100;
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
        <div class="header">
           <div class="date">
            <span>DeadLine</span>
            <span>{{ $request->date_deadline }}</span>
           </div>
           <div class="titre">
            <span>Titre devis</span>
            <span>{{ $request->title }}</span>
           </div>
           <div class="cpName">
            <span>Nom socite</span>
            <span>{{ $request->user->companyName }}</span>
        </div>
            </div>
            <table class="table" id="dataTable">
                <thead>
                  <tr>
                    <th scope="col">Artciale</th>
                    <th scope="col">Description</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Secteur Dac</th>
                    <th scope="col">Lieu de livraison</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($article as $item): ?>
                    <tr>
                      <td><?= $item->name ?></td>
                      <td><?= $item->description ?></td>
                      <td><?= $item->quantity ?></td>
                      <td><?= $item->secteur ?></td>
                      <td><?= $item->lieu ?></td>
                    </tr>
                  <?php endforeach; ?>

                </tbody>
              </table>
              <button style="width: 50%" title="Sign In" type="submit" class="sign-in_btn next-btn">
                <span> Envoyer devis</span>
            </button>
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

    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    addEventListener("DOMContentLoaded", (event) => {
        // Function to add a new row to the table

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
