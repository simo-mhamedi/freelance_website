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
        margin: 40px;
        width: 50%;
        margin-left: auto;
        margin-right: auto;
        display: flex;
        flex-direction: row;
        align-items: center;

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

    .desc {
        font-size: 30px;
        font-weight: bold;
        text-transform: uppercase
    }

    .label-search {
        width: 70%;
        font-size: 15px !important;
        color: #108a00;
        font-weight: bold;
    }

    .external-actions {
        margin: 10px;
        float: right;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        gap: 10px;
    }

    .btn-delete {
        background: white !important;
        color: black !important;
        border-radius: 10px;
        border-color: black !important;
        padding: 5px !important;
    }

    .deposer {
        background: #108a00 !important;
        color: white !important;
        border-radius: 10px;
    }

    .fa-trash {
        color: red;
        cursor: pointer
    }

    .fa-pencil,
    .fa-eye {
        color: #4C78AF;
        cursor: pointer
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@if (session('message'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
        <div class="toast align-items-center text-white bg-danger border-0 fade" role="alert" aria-live="assertive"
            aria-atomic="true" data-bs-autohide="true" data-bs-delay="2000">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('message') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        var toastEl = document.querySelector('.toast');
        var toastInstance = new bootstrap.Toast(toastEl);
        toastInstance.show();
    </script>
@endif


@section('content')
    <div class="title">MES DEMANDES</div>
    <div class="desc">Gérer/Modifier mes DEMANDES</div>



    <div class="actions">
        <!-- Example single danger button -->


        <form class="right" method="GET" action="{{ route('searsh-request') }}" id="keyForm">
            <label for="" class="label-search">RECHERCHE ANNONCE</label>
            <input value="{{ isset($data) ? $data : '' }}" type="text" name="key" placeholder="chercher mot clé"
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
    <div class="external-actions">
        <a class="nav-link deposer" href="{{ route('newRequest') }}"><i class="fa fa-plus-circle"></i> deposer demande</a>
        <form style="margin: 0" id="deleteForm" action="{{ route('delete-selected-requests') }}" method="get">
            @csrf
            <button class="btn-primary btn-delete" id="deleteAll">supprimer</button>
            <input type="hidden" id="checkboxValues" name="deletedRequestes">
        </form>
    </div>

    <div class="table" style="margin-top: 20px">
        <table class="table" style="background:#F2F5F2;border-radius:14px ">
            <thead>
                <tr>
                    <th scope="col">Numero</th>
                    <th scope="col">titre DEMANDE</th>
                    <th scope="col">Date d’aCTIvation</th>
                    <th scope="col">DEVIS</th>
                    <th scope="col">MODIFIER</th>
                    <th scope="col">SUPP</th>
                    <th scope="col">voir</th>
                    <th scope="col"><input type="checkbox" class="all"></th>
                </tr>
            </thead>

            <tbody id="estimates">
                @foreach ($request_recus->requests as $request_recu)
                    <tr>
                        <th scope="row">{{ $request_recu->requestNumber }}</th>
                        <td>{{ $request_recu->title }}</td>
                        <td>{{ $request_recu->date_request }}</td>
                        <td>{{ $request_recu->estimates_count }}</td>
                        <td>
                            <form style="margin: 0" method="GET" action="{{route('update-request-view')}}"  >
                                @csrf
                                <input type="hidden" value="{{$request_recu}}" name="request_recu">
                                <button style="border: none"><i class="fa fa-pencil"></i></button></td>
                            </form>
                        <td>

                            <i data-toggle="modal" data-target="#deleteModal" class="fa fa-trash"></i>
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this record?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <form action="{{ route('delete-request', ['id' => $request_recu->id]) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                        <td><i class="fa fa-eye"></i>

                        </td>
                        <td><input type="checkbox" value="{{ $request_recu->id }}" class="single-delete"></td>
                    </tr>
                @endforeach
            </tbody>

            </td>
            </tr>
            </tbody>
        </table>

    </div>
@endsection
<script>
    addEventListener("DOMContentLoaded", (event) => {
        var deleteForm=document.querySelector("#deleteForm");
        // Get the select element and the form element
        var all = document.querySelector(".all");
        document.querySelector("#deleteAll").onclick = ()=> {
            var checkedValues = [];
            document.querySelectorAll(".single-delete").forEach(element => {
                if (element.checked) {
                    checkedValues.push(element.value);
                }
            });
            document.getElementById('checkboxValues').value = checkedValues.join(',');
            deleteForm.submit();
        };

        all.addEventListener("click", (event) => {
            document.querySelectorAll(".single-delete").forEach(element => {
                if (all.checked) {
                    element.checked = true;
                } else {
                    element.checked = false;
                }
            });
        })

    });
</script>
