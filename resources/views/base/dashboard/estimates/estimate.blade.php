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
</style>
@section('content')
    <div class="actions">
        <!-- Example single danger button -->
        <div class="left">

            <select class="form-select" id="form-select" style="width: 40%;border-radius: 10px;padding:10px">
                <option value="">DEMANDE</option>
                @foreach ($requests as $request)
                    <option class="dropdown-item" value="{{ $request->id }}" href="#">{{ $request->requestNumber }}
                    </option>
                @endforeach

            </select>

            <input type="date"
                style="width: 40%;
    height: 43px;border-radius: 14px;
    padding:10px;
    border-color:rgba(0, 0, 0, 0.123);
background: #F2F5F2;"
                class="form-control">
        </div>

        <div class="right">
            <input type="text" placeholder="chercher mot clé"
                style="border-radius: 14px;
    background: #F2F5F2;margin-right:10px" class="form-control">
            <button style="width: 105px;
    height: 38px;
    flex-shrink: 0;border-radius: 14px;
background: #108A00;"
                class="btn btn-success">search</button>
        </div>
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
        
            <tbody>
                @foreach ($estimate_recus as $estimate_recu)
                    <tr>
                        <th scope="row">{{ $estimate_recu->reference }}</th>
                        <td>{{ $estimate_recu->user->companyName }}</td>
                        <td>{{ $estimate_recu->estimate_date }}</td>
                        <td style="color:rgba(16, 138, 0, 1);cursor:pointer"><a data-toggle="modal"
                                data-target="#exampleModalLong">voir offre</a>

                            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div style="    height: 80% !important;" class="modal-content">
                                        <div class="modal-body">
                                            <!-- Or embed a video -->
                                            <iframe style="width: 100%;height:100%"
                                                src="/storage/{{ $estimate_recu->file }}" frameborder="0"
                                                allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>

    </div>
    </td>
    <td style="display: flex;align-items:center;">
        @for ($i = 0; $i < $estimate_recu->rating; $i++)
            <span style="color: orange" class="fa fa-star checked"></span>
        @endfor

    </td>
    </tr>
    @endforeach


    </tbody>
    </table>
    </div>
@endsection

<script>
    addEventListener("DOMContentLoaded", (event) => {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        document.getElementById('form-select').addEventListener('click', function(event) {
            var id = document.getElementById('form-select').value;
            if (id != "") {
                $.ajax({
                    url: '/select-estimates',
                    type: 'GET',
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        // Handle the response from the server
                        estimate_recus=response;
                    },
                    error: function(xhr) {
                        // Handle any errors that occur during the request
                    }
                });

            }

        });


    });
</script>
