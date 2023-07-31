@extends('base.index')
<style>
    .left {
        width: 39%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-evenly;
    }

    .right {
        width: 30%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }

    .actions {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center
    }

    .paginate {
        position: absolute;
        bottom: 0;
        left: 50%;
    }

    .paginate a {
        text-decoration: none !important;
        border: 1px solid green !important;
        color: green !important;
        margin: 5px;
        border-radius: 10px
    }

    .title {
        text-align: center !important;
        text-transform: uppercase;
        font-size: 40px !important;
        color: #108a00 !important;
        margin-bottom: 40px !important;

    }
</style>
@section('content')
    <div class="title">devis envoyés</div>
    <div class="actions">
        <!-- Example single danger button -->
        <div class="left">
            <form style="width: 40%" method="GET" action="{{ route('select-send-estimates') }}" id="selectForm">
                <select class="form-select" name="id" style="border-radius: 10px; padding: 10px" id="requestSelect">
                    <option value="">DEMANDE</option>
                    @foreach ($requests as $request)
                        <option class="dropdown-item" value="{{ $request->id }}"
                            {{ isset($requestId) && $requestId == $request->id ? 'selected' : '' }}>
                            {{ $request->requestNumber }}
                        </option>
                    @endforeach
                </select>
            </form>
            <form style="width: 40%" method="GET" action="{{ route('select-send-date-estimates') }}" id="dateForm">
                <input value="{{ isset($data) ? $data : '' }}" type="date" name="date"
                    style="
    height: 43px;border-radius: 14px;
    padding:10px;
    border-color:rgba(0, 0, 0, 0.123);
background: #F2F5F2;"
                    class="form-control">
            </form>
        </div>

        <form class="right" method="GET" action="{{ route('search-estimates') }}" id="keyForm">
            <input type="text" name="key" placeholder="chercher mot clé"
                style="border-radius: 14px;
    background: #F2F5F2;margin-right:10px" class="form-control">
            <button style="width: 105px;
    height: 38px;
    flex-shrink: 0;border-radius: 14px;
background: #108A00;"
                class="btn btn-success">search</button>
        </form>

    </div>
    <br>
    <br>

    <div class="table" style="margin-top: 20px">
        <table class="table" style="background:#F2F5F2;border-radius:14px ">
            <thead>
                <tr>
                    <th scope="col">REFERENCE</th>
                    <th scope="col">Société</th>
                    <th scope="col">Date depot</th>
                    <th scope="col">DEVIS</th>
                    <th scope="col">review</th>
                </tr>
            </thead>

            <tbody id="estimates">
                @foreach ($paginatedEstimates as $estimate_recu)
                    <tr>
                        <td>
                            @if ($estimate_recu !== null)
                        {{ $estimate_recu->reference }}
                        <!-- Other table cells or data for each estimate -->
                @endif
                        </td>
                <td>
                    @if ($estimate_recu !== null)
                    {{ $estimate_recu->user->companyName  }}
                    <!-- Other table cells or data for each estimate -->
            @endif
     </td>
                <td>
                    @if ($estimate_recu !== null)
                    {{ $estimate_recu->estimate_date   }}
                    <!-- Other table cells or data for each estimate -->
            @endif
                </td>
                <td style="color:rgba(16, 138, 0, 1);cursor:pointer">
                    @if ($estimate_recu !== null)

                    <a data-toggle="modal"
                        data-target="#exampleModalLong">voir offre</a>

                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div style="    height: 80% !important;" class="modal-content">
                                <div class="modal-body">
                                    <iframe style="width: 100%;height:100%" src="/storage/{{ $estimate_recu->file }}"
                                        frameborder="0" allowfullscreen></iframe>
                                    <!-- Other table cells or data for each estimate -->

                                </div>
                            </div>
                        </div>
                    </div>

    </div>
    @endif

    </td>
    <td style="display: flex;align-items:center;">
        @if ($estimate_recu !== null)
        @for ($i = 0; $i < $estimate_recu->rating; $i++)
        <span style="color: orange" class="fa fa-star checked"></span>
    @endfor
        <!-- Other table cells or data for each estimate -->
@endif


    </td>
    </tr>
    @endforeach
    </tbody>
    </table>

    </div>
    <div class="paginate">
        {{ $paginatedEstimates->links() }}
    </div>
@endsection
<script>
    addEventListener("DOMContentLoaded", (event) => {
        // Get the select element and the form element
        var selectElement = document.getElementById('requestSelect');
        var formElement = document.getElementById('selectForm');
        var dateForm = document.getElementById('dateForm');

        dateForm.addEventListener('change', function() {
            // Submit the form when an option is selected
            dateForm.submit();
        });
        // Add event listener for the 'change' event on the select element
        selectElement.addEventListener('change', function() {
            // Submit the form when an option is selected
            formElement.submit();
        });
    });
</script>
