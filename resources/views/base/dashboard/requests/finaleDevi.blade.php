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
.table{
    padding: 40px
}
    table {
        border-color: #888;
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border-color: #ddd;

        padding: 8px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
    .prix-details{
        position: absolute;
        bottom: 100px;
        right: 100px;


    }
    .total{
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
        gap: 5px;
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
</div>
<div class="table">
    <table>
        <thead>
            <tr>
                <th scope="col">Article</th>
                <th scope="col">Description</th>
                <th scope="col">Quantité</th>
                <th scope="col">Prix unitaire</th>
                <th scope="col">Prix total bas</th>
                <th scope="col">ENTREPRISE</th>
                <th scope="col">CONTACT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($freelancerSuggestions as $suggestion)
            <tr>
                <td>{{ $suggestion->article->name }}</td>
                <td>{{ $suggestion->article->description }}</td>
                <td>{{ $suggestion->article->quantity }}</td>
                <td>{{ $suggestion->prix }}</td>
                <td>{{ $suggestion->prix*$suggestion->article->quantity }}</td>
                <td>{{ $suggestion->freelancer->companyName }}</td>
                <td><a style="text-decoration: none" target="_blank" href="/messaging/{{$suggestion->freelancer->id}}">click</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="prix-details">
    <div class="total">
        <span>TOTAL Hors taxe : 4550.00DH</span>
        <span>tva: 20%</span>
        <span>TOTAL TTC : 14550.00DH</span>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Function to calculate totals
    function calculateTotals() {
        let totalHT = 0;
        let totalTTC = 0;

        // Iterate over table rows
        document.querySelectorAll('tbody tr').forEach(function(row) {
            // Get quantity and unit price
            let quantity = parseFloat(row.querySelector('td:nth-child(3)').innerText);
            let unitPrice = parseFloat(row.querySelector('td:nth-child(4)').innerText);

            // Calculate total price for the row
            let totalPrice = quantity * unitPrice;

            // Update totalHT
            totalHT += totalPrice;

            // Update totalTTC with VAT (assuming VAT is 20%)
            totalTTC += totalPrice * 1.20;
        });

        // Update the DOM with the calculated totals
        document.querySelector('.total span:nth-child(1)').innerText = 'TOTAL Hors taxe : ' + totalHT.toFixed(2) + 'DH';
        document.querySelector('.total span:nth-child(3)').innerText = 'TOTAL TTC : ' + totalTTC.toFixed(2) + 'DH';
    }

    // Call the calculateTotals function
    calculateTotals();
});

</script>