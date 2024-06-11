
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<style>
.title{
    margin: 20px;
    color: green;
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
}
.search-key{
    display: flex;
    flex-direction: row;
    align-items: flex-end;
    justify-content: flex-end;
    width: 30%;
    gap: 20px;
}
.actions{
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: 20px
}
.search{
    background-color: green;
}
.value-search,.dropdown{
    background: rgb(237, 236, 236);
    border-radius:10px;
    color: gray
}
table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    .tables{

        margin: 20px;
        margin-top: 40px;
        display: flex;
        align-items: flex-end;
        justify-content: center;

    }
    .prices th{
        background-color: green;
        color: white;
        padding: 15px;
    }
    .titles{
        font-weight: bold;
    }
    table{
        text-transform: uppercase;
    }
    .small-title{
        text-align: center;
        color: #108A00;
    }
    .dropdown-item{
        text-transform: uppercase;
    }
    .drops{
        display: flex;
        gap: 10px
    }
    .dropdown-toggle{
        background: green;
        color: white;
        text-transform: uppercase;
    }
    .dropdown-toggle:hover{
       background: #45d303;
    }
    .myTable {
        width: 100%;
        border-collapse: collapse;
        overflow-x: auto;
    }

    .table-container {
        width: 90%; /* Set max width for the container */
        overflow-x: auto; /* Enable horizontal overflow scrolling */
    }

    .myTable {
        width: 100%;
        border-collapse: collapse;
    }

    .myTable th, .myTable td {
        padding: 8px;
        border: 1px solid black;
        text-align: center;
    }

    .first th, .titles td {
        width: 120px; /* Set specific width for each column */
    }
    .table-container::-webkit-scrollbar {
        width: 10px; /* Set the width of the scrollbar */
    }

    .table-container::-webkit-scrollbar-track {
        background: #f1f1f1; /* Set the color of the scrollbar track */
    }

    .table-container::-webkit-scrollbar-thumb {
        background: #888; /* Set the color of the scrollbar thumb */
    }

    /* Define scrollbar styles for Firefox */
    .table-container {
        scrollbar-width: thin; /* Set the width of the scrollbar */
        scrollbar-color: #888 #f1f1f1; /* Set the color of the scrollbar thumb and track */
    }
.nav-back{
    padding: 20px;
    color: green;
    cursor: pointer;

}
</style>
<div class="header">
    <div class="nav-back">
        <a href="{{ route('request') }}" style="text-decoration: none !important;    color: green;
        "><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <div class="title">
        <h1>Comparaison devis n {{$req->requestNumber}}</br>
            Titre demande
        </h1>
    </div>
    <div class="actions">
        <input type="hidden" id="reqId" value="{{$req->id}}">
        <div class="drops">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item select-dropdown-item" href="#" data-target="articles">Articles</a></li>
                    <li><a class="dropdown-item select-dropdown-item" href="#" data-target="societe">SOCIété</a></li>
                </ul>
            </div>
            <div id="articles-content" class="dropdown-content" style="display: none;">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Articles
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach($articles as $article)
                        <li>
                            <label class="dropdown-item">
                                <input type="checkbox" class="article-checkbox article" data-target="{{ $article['id'] }}"> {{ $article->name }}
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>

            <div id="societe-content" class="dropdown-content" style="display: none;">
                <button  class="btn btn-secondary company"  style="text-transform: uppercase"    type="button">
                    SOCIété
                </button>
            </div>
            <form id="myForm" action="{{ route('generer') }}" method="post">
                <!-- Your form inputs go here -->
                @csrf <!-- CSRF protection token -->

                <!-- Hidden input field to store freelancer IDs -->
                <input type="hidden" name="freelancerIds" id="freelancerIdsInput">

                <!-- Button to trigger form submission -->
                <button class="btn btn-primary devi" style="text-transform: uppercase;display:none" type="button" onclick="submitForm()">Generer Devi</button>
            </form>

            <form id="myForm2" style="display: none" action="{{ route('genererwithCompany') }}" method="post">
                <!-- Your form inputs go here -->
                @csrf <!-- CSRF protection token -->

                <!-- Hidden input field to store freelancer IDs -->
                <input type="hidden" name="freelancer_id" id="freelancerIdsInput2">

                <!-- Button to trigger form submission -->
            </form>
        </div>
    </div>
    <div class="small-title">
        <i class="fa-solid fa-triangle-exclamation"></i> veuillez cliquer sur le nom société pour ajouté article(s) au devis
      </div>
</div>
<div class="body">

    <div  id="tables-container">
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    var selectedArticles = [];

     $(document).ready(function() {
        let freeLanceIds = [];

        function submitForm() {
    // Assuming you have an array of freelancer IDs stored in freeLanceIds

    // Convert the array to a JSON string
    let freelancerIdsJson = JSON.stringify(freeLanceIds);

    // Set the value of the hidden input field to the JSON string
    document.getElementById('freelancerIdsInput').value = freelancerIdsJson;

    // Submit the form
    document.getElementById('myForm').submit();
        }
        document.querySelector('.devi').addEventListener('click', function() {
    // Call the submitForm function here
    submitForm();
});
            // JavaScript to handle multi-select functionality
        // AJAX function to send the selected article ID
        $('.company').click(function() {
            var reqId= document.querySelector("#reqId").value;
            $.ajax({
                url: '/get_companys_segg', // URL matches the route '/get_segg'
                type: 'GET',
                data: { reqId },
                success: function(response) {
                    if(  response.freelancerSuggestions.length>0)
                    {
                        const container = document.getElementById('tables-container');
    container.innerHTML=""
    const addedArticles = [];
    console.log(response);
    var minPrice = Number.MAX_SAFE_INTEGER;
    let minPricerowSelector
        let minPriceCompany = '';
    // Check if the current article has already been added
        const tableContainer = document.createElement('div');
        tableContainer.classList.add('tables'); // Adding a class to the table container
        tableContainer.innerHTML = `
            <table class="prices myTable" id="myTable">
                <tr class="first">
                    <th>Enterprise 1</th>
                    <th>Enterprise 2</th>
                    <th>Enterprise 3</th>
                </tr>
                <tr class="titles">
                    <td>Unit Price</td>
                    <td>Unit Price</td>
                    <td>Unit Price</td>
                </tr>
                <tr class="prix">
                    <td>éééé</td>
                    <td>éééé</td>
                    <td>éééé</td>
                </tr>
            </table>
            <table id="myTable2">
                <tr>
                    <th>Lowest Price</th>
                    <th>Total Lowest Price</th>
                </tr>
                <tr class="min-price">
                    <td></td>
                    <td></td>
                </tr>
            </table>
        `;

        container.appendChild(tableContainer);
        $(`#myTable .first`).empty();
                $(`#myTable .prix`).empty();
                $(`#myTable .titles`).empty();
                $(`#myTable2 .min-price`).empty();
console.log(response.freelancerSuggestions);
var minPrice = 10000000000000;

    response.freelancerSuggestions.forEach(s => {
                var smallone
                // Append data to the respective table
                const tableSelector = `#myTable .first`; // Selector for the enterprise names
                const rowSelector = `#myTable .prix`; // Selector for the prices
                const titlesrowSelector = `#myTable .titles`; // Selector for the prices
                minPriceRowSelector = `#myTable2 .min-price`; // Selector for the prices

                console.log("sss:"+  s.prix);
                console.log("sssd:"+  minPrice);
                console.log(tableSelector);


                if ( Number(minPrice) > Number(s.prix) ) {
                    minPrice = s.prix;
                    minPriceCompany = s.freelancer.companyName;
                }
                console.log(minPrice);
                $(tableSelector).append('<th style="cursor:pointer">' + s.freelancer.companyName + '</th>');
                $(tableSelector + ' th:last-child').on('click', function() {
                    // Convert array of Freelancer IDs to a comma-separated string
                    // Set the value of the hidden input field to the string of Freelancer IDs
                    $('#freelancerIdsInput2').val(s.freelancer.id);

                    // Submit the f
                    $('#myForm2').submit();
                });

                $(rowSelector).append('<td>' + s.prix + '</td>');
                $(titlesrowSelector).append('<td>' + 'Unit Price' + '</td>');
            });
        minPriceRowSelector = `#myTable2 .min-price`; // Selector for the prices
        console.log( minPrice);
        $(minPriceRowSelector).append('<td>' + minPrice + '</td>');
        $(minPriceRowSelector).append('<td>' + minPrice*response.articles_quantity_sum+ '</td>');
        $(`#myTable .prix td`).filter(function() {
            return parseInt($(this).text()) === parseInt((minPrice));
        }).css('background-color', '#8BE760');
        minPrice=Infinity
                    }

            }
            ,


                error: function(xhr, status, error) {
                    // Handle error
                    console.error('Error sending article ID:', error);
                }
            })

    });


        $('.article').click(function() {
            var id = $(this).data('target');
            // Toggle the 'active' class
            $(this).toggleClass('active');

            // Check if the article is already selected
            var index = selectedArticles.indexOf(id);

            if (index === -1) {
                // If not selected, add it to the selectedArticles array
                selectedArticles.push(id);
            } else {
                // If already selected, remove it from the selectedArticles array
                selectedArticles.splice(index, 1);
            }
            // Additional functionality here
            console.log("Selected Articles:", selectedArticles);
            var id = $(this).data('target');
            var id2=1;
            $.ajax({
                url: '/get_segg', // URL matches the route '/get_segg'
                type: 'GET',
                data: { selectedArticles },
                success: function(response) {
                    if(  response.freelancerSuggestions.length>0)
                    {
                        const container = document.getElementById('tables-container');
                        container.innerHTML=""
                        const addedArticles = [];
                        console.log(response);
                        let minPrice = Infinity;
                        let minPricerowSelector
                        let minPriceCompany = '';

                        response.articlesList.forEach((article, index) => {
                        // Check if the current article has already been added
                        if (!addedArticles.includes(article.name)) {
                            const tableContainer = document.createElement('div');
                            tableContainer.classList.add('tables'); // Adding a class to the table container
                            tableContainer.style.position = 'relative';
                            tableContainer.innerHTML = `
                            <table>

                <tr>
                    <th>Article</th>
                    <th>Description</th>
                    <th>Quantité</th>
                </tr>
                <tr>
                    <td>${article.name}</td>
                    <td>${article.description}</td>
                    <td>${article.quantity}</td>
                </tr>
            </table>
            <table class="prices myTable" id="myTable_${index}">
                <tr class="first">
                    <th>Enterprise 1</th>
                    <th>Enterprise 2</th>
                    <th>Enterprise 3</th>
                </tr>
                <tr class="titles">
                    <td>Unit Price</td>
                    <td>Unit Price</td>
                    <td>Unit Price</td>
                </tr>
                <tr class="prix">
                    <td>éééé</td>
                    <td>éééé</td>
                    <td>éééé</td>
                </tr>
            </table>
            <table id="myTable2_${index}">
                <tr>
                    <th>Lowest Price</th>
                    <th>Total Lowest Price</th>
                </tr>
                <tr class="min-price">
                    <td>${article.lowestPrice}</td>
                    <td>${article.totalLowestPrice}</td>
                </tr>
            </table>
        `;

        container.appendChild(tableContainer);
        addedArticles.push(article.name);
        $(`#myTable_${index} .first`).empty();
                $(`#myTable_${index} .prix`).empty();
                $(`#myTable_${index} .titles`).empty();
                $(`#myTable2_${index} .min-price`).empty();
                var minPrice = 10000000000000;

response.freelancerSuggestions.forEach((s) => {
    console.log(s.article_id);
    console.log(article.id);
    if (s.article_id == article.id) {
        // Append data to the respective table
        const tableSelector = `#myTable_${index} .first`; // Selector for the enterprise names
        const rowSelector = `#myTable_${index} .prix`; // Selector for the prices
        const titlesrowSelector = `#myTable_${index} .titles`; // Selector for the prices

        console.log("sss:" + s.prix);
        console.log("sssd:" + minPrice);

        if ( Number(minPrice) > Number(s.prix) ) {
            minPrice = s.prix;
            minPriceCompany = s.freelancer.companyName;
        }

        console.log("r="+ minPrice);

        $(tableSelector).append('<th style="cursor:pointer">' + s.freelancer.companyName + '</th>');

        $(tableSelector + ' th:last-child').on('click', function() {
            // Your click event handler code here
            console.log('Table header clicked!');
            Swal.fire({
                title: "Voulez vous ajoutez au DEvis?",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "oui",
                cancelButtonText: "non"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Avec succès!",
                        text: "Votre devi a été ajouté.",
                        icon: "success"
                    });
                    freeLanceIds.push(s.id);
                    console.log(freeLanceIds);
                    document.querySelector(".devi").style.display = "block";
                }
            });
        });

        $(rowSelector).append('<td>' + s.prix + '</td>');
        $(titlesrowSelector).append('<td>' + 'Unit Price' + '</td>');
    }
});

minPriceRowSelector = `#myTable2_${index} .min-price`; // Selector for the prices
console.log(minPrice);
$(minPriceRowSelector).append('<td>' + minPrice + '</td>');
$(minPriceRowSelector).append('<td>' + minPrice * article.quantity + '</td>');

$(`#myTable_${index} .prix td`).filter(function() {
    return parseInt($(this).text()) === parseInt((minPrice));
}).css('background-color', '#8BE760');

minPrice = Infinity; // Reset minPrice to Infinity after processing

            }

});
                    }


                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error('Error sending article ID:', error);
                }
            });
        });
    });


    const tables = document.querySelectorAll('.myTable');

    tables.forEach(table => {
        const rows = table.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName('td');
            let min = Infinity;
            let minIndex = -1;

            for (let j = 0; j < cells.length; j++) {
                let value = parseFloat(cells[j].innerText);
                if (!isNaN(value) && value < min) {
                    min = value;
                    minIndex = j;
                }
            }

            if (minIndex !== -1) {
                cells[minIndex].style.backgroundColor = '#8BE760';
            }
        }
    });

    const dropdownItems = document.querySelectorAll('.select-dropdown-item');
    const dropdownContents = document.querySelectorAll('.dropdown-content');

    dropdownItems.forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior

            const targetId = this.getAttribute('data-target');

            // Hide all dropdown contents
            dropdownContents.forEach(content => {
                content.style.display = 'none';
            });

            // Display the target dropdown content
            document.getElementById(targetId + '-content').style.display = 'block';
        });
    });
</script>