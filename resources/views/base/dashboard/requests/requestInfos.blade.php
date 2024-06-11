@extends('base.index')
<style>
    .requestInfos {
        width: 90%;
        padding: 20px;
        margin-left: auto;
        margin-right: auto;
        border: 1px solid gray;
        border-radius: 10px;
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: space-between
    }

    .requestInfos-left {
        display: flex;
        flex-direction: column;
        margin: 10px
    }

    .title-request {
        color: #000;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: 21.76px;
        text-transform: uppercase;
    }

    .date-status {
        margin-top: 20px;
        margin-left: 20px;

        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }

    .date {
        color: rgba(0, 0, 0, 0.60);
        font-size: 15px;
        font-style: normal;
        font-weight: 600;
        line-height: 21.76px;
        text-transform: uppercase;
    }

    .status {
        width: 106px;
        height: 28px;
        flex-shrink: 0;
        border-radius: 12px;
        background: #108A00;
        color: white;
        margin: 20px
    }

    .head,
    .value-date {
        color: #000;
        font-size: 15px;
        font-style: normal;
        font-weight: 600;
        line-height: 21.76px;
        text-transform: uppercase;
    }

    .value-date {
        color: rgba(188, 24, 24, 1);
    }

    .deadline {
        display: flex;
        flex-direction: row;
        align-items: center;

    }

    .update {
        text-decoration: none;
        color: #00A453 !important;
        font-size: 15px;
        font-style: normal;
        font-weight: 600;
        line-height: 21.76px;
        text-transform: uppercase;
        background: white !important;
        border-color: #00A453 !important;
    }

    .delete {
        text-decoration: none;
        color: #BC1818 !important;
        font-size: 15px;
        font-style: normal;
        font-weight: 600;
        line-height: 21.76px;
        text-transform: uppercase;
        background: white !important;
        border-color: #BC1818 !important;
    }

    .infos {
        margin-top: 20px;
        display: flex;
        flex-direction: row;
        align-items: flex-end;
        justify-content: flex-end;
        color: rgba(0, 0, 0, 0.60);
        font-size: 15px;
        font-style: normal;
        font-weight: 600;
        line-height: 21.76px;
        text-transform: uppercase;
    }

    .actions-request {
        display: flex;
        gap: 10px;
    }

    #container {
        display: flex;
        width: 300px;
        margin: 0 auto;
    }

    #star {
        font-size: 50px;
        flex: 1;
        text-align: center;
        line-height: 50px;
        margin: 10px auto;
        cursor: pointer;
        border-radius: 100%;
        transition: 1s;
    }

    .inactive {
        color: lightgrey;
    }

    @keyframes myAnim {
        0% {
            animation-timing-function: ease-out;
            transform: scale(1);
            transform-origin: center center;
        }

        10% {
            animation-timing-function: ease-in;
            transform: scale(0.91);
        }

        17% {
            animation-timing-function: ease-out;
            transform: scale(0.98);
        }

        33% {
            animation-timing-function: ease-in;
            transform: scale(0.87);
        }

        45% {
            animation-timing-function: ease-out;
            transform: scale(1);
        }
    }

    .animated {
        animation: myAnim 2s ease 0s infinite normal forwards;
        color: gold;
    }

    .active {
        color: gold;
    }

    .raing-title {
        text-transform: uppercase;
        text-align: center;
        color: #000
    }

    .actions-rating {
        MARGIN-LEFT: AUTO;
        MARGIN-RIGHT: auto;
        DISPLAY: FLEX;
        FLEX-DIRECTION: row;
        ALIGN-ITEMS: center;
        JUSTIFY-CONTENT: space-between;
        WIDTH: 40%;
        MARGIN-BOTTOM: 16PX;
    }

    .plus-tard,
    .confirm {
        border-radius: 10px;
        padding: 5px;
    }

    .avatar {
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
.modal-content{
    color: #000
}

</style>
@section('content')
    <div class="request-title">demande numero {{ $request->requestNumber }}</div>
    <div class="requestInfos">
        <div class="requestInfos-left">
            <div class="title-request">{{ $request->title }}</div>
            <div class="date-status">
                <div class="date">
                    {{ $request->date_request }}
                </div>
                <div class="status">
                    {{ $request->status }}
                </div>
            </div>
            <div class="deadline">
                <div class="head">
                    Expire le
                </div>
                &nbsp;
                <div class="value-date">
                    {{ $request->date_deadline }}
                </div>
            </div>
            <div class="categorys">
                {{-- <ul style="padding:0px;" class="myList" id="second-list">
                    @foreach ($userCategorys as $subCagorie)
                        <li class="btn category-selected" id="sub-selected" value="{{ $subCagorie->Sub_categorie->id }}"
                            style=" margin: 10px;" data-category="{{ $subCagorie->Sub_categorie->id }}">
                            {{ $subCagorie->Sub_categorie->subCategoryName }}
                            <i class="fa fa-close close"></i>
                        </li>
                    @endforeach
            </ul> --}}
            </div>
        </div>
        <div class="requestInfos-right">
            <div class="actions-request">
                <form style="margin: 0" method="GET" action="{{ route('update-request-view') }}">
                    @csrf
                    <input type="hidden" value="{{ $request }}" name="request_recu">
                    <button class="btn btn-primary update">MODIFIER DEMANDES</button></td>
                </form>
                <form style="margin: 0" id="deleteForm" action="{{ route('compare') }}" method="get">
                    @csrf
                    <button class="btn-primary btn-danger" style="border-radius: 10px" id="deleteAll">comparer</button>
                    <input type="hidden" id="checkboxValues" value="{{$request->id}}" name="id">
                </form>
                <a data-toggle="modal" data-target="#deleteModal" class="btn btn-primary delete">supprimer
                </a>
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                    aria-hidden="true">
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form action="{{ route('delete-request', ['id' => $request->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="infos">
                vue : {{ $request->viewsNumber }} | devis : {{ $request->estimates_count }}
            </div>
        </div>
    </div>
    <div class="actions">
        <!-- Example single danger button -->


        <form class="right" method="GET" action="{{ route('search-estimates-from-req') }}" id="keyForm">
            <label for="" class="label-search">RECHERCHE ANNONCE</label>
            <input type="hidden" value="{{ $request->id }}" name="id">
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
    <div class="table" style="margin-top: 20px">
        <table class="table" style="background:#F2F5F2;border-radius:14px ">
            <thead>
                <tr>
                    <th scope="col">REFERENCE</th>
                    <th scope="col">Société</th>
                    <th scope="col">Date depot</th>
                    <th scope="col">DEVIS</th>
                    <th scope="col">Contact</th>
                    <th scope="col">review</th>
                </tr>
            </thead>

            <tbody id="estimates">
                @foreach ($estimate_recus as $estimate_recu)
                    <tr>
                        <th scope="row">{{ $estimate_recu->reference }}</th>
                        <td>{{ $estimate_recu->client->companyName }}</td>
                        <td>{{ $estimate_recu->estimate_date }}</td>
                        <td style="color:rgba(16, 138, 0, 1);cursor:pointer"><a data-toggle="modal"
                                data-target="#exampleModalLong">voir offre</a>

                            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div style="    height: 80% !important;" class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close"class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModalCenter">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Or embed a video -->
                                            <iframe style="width: 100%;height:100%"
                                                src="/storage/{{ $estimate_recu->file }}" frameborder="0"
                                                allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">

                                        <div class="modal-body">
                                            <h5 style="margin-bottom: -8px !important;" class="raing-title">donner une
                                                note pour ce devis
                                            </h5>
                                            <div id="container">
                                                <div id="star" class="inactive" data-index=0>★</div>
                                                <div id="star" class="inactive" data-index=1>★</div>
                                                <div id="star" class="inactive" data-index=2>★</div>
                                                <div id="star" class="inactive" data-index=3>★</div>
                                                <div id="star" class="inactive" data-index=4>★</div>
                                            </div>
                                            <input class="idEst" type="hidden" value="{{ $estimate_recu->id }}">
                                        </div>
                                        <div class="actions-rating">
                                            <button class="btn-primary plus-tard" data-dismiss="modal"
                                                aria-label="Close">PLUS TARD</button>
                                            <button class="btn-success confirm">CONFIRMER</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
    </div>

    </div>
    </td>
    <td style="color:#007FED;cursor:pointer"><a data-toggle="modal" data-target="#exampleModalLongContact">Contacter</a>

        <div class="modal fade" id="exampleModalLongContact" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div style="    height: 50% !important;" class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="
justify-content: flex-end;">
                        <img
                        src="{{ asset('storage/users-avatar/' . $estimate_recu->client->avatar) }}"
                        class="avatar"
                        style="
                        position: absolute;
                        left:20px;
                        top: 10px;"/>
                        <div>

                            <div class="user-contact-infos"
                                style="
                        position: absolute;
    top: 49px
;
    left: 141px;
                        ">
                                <div class="name-contact">
                                    {{ $estimate_recu->client->companyName }}
                                </div>
                                <div style="display: flex;align-items:center;">
                                    @if ($estimate_recu->client->userratings->count() > 0)
                                        @for ($i = 0; $i < $estimate_recu->client->userratings->avg('review'); $i++)
                                            <span style="color: orange" class="fa fa-star checked"></span>
                                        @endfor
                                    @else
                                    @endif

                                </div>
                            </div>

                        </div>


                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="desicriptif société">{{ $estimate_recu->client->desc_Activity }}
                    </textarea>

                    </div>
                    <div class="av-actions"
                        style="    display: flex;
                    flex-direction: row;
                    align-items: center;
                    justify-content: center;
                    gap: 10px;
                    margin: 10px;">
                        <div class="email">
                            <a class="Abtn btn btn-danger" data-toggle="modal" data-target="#exampleModalCenterEmail"><i class="fa fa-envelope request-icon"></i></a>
                            <div class="modal fade" id="exampleModalCenterEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="sendEmailModalLabel">Send Email</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form style="width: 100%" action="{{ route('send_email') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" value="{{$estimate_recu->client->email}}" id="recipient" name="recipient">
                                                </div>
                                                    <label for="subject">Subject</label>
                                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                                    <label for="message">Message</label>
                                                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                             </div>
                        </div>
                        <div class="sms">
                            <a href="/messaging/{{$estimate_recu->client->id}}" class="Abtn btn btn-primary"><i class="fa fa-comment request-icon"></i></a>

                        </div>
                        <div class="phoneNumber">
                            <a href="https://api.whatsapp.com/send?phone={{$estimate_recu->client->tele }}" target="_blank"
                                class="Abtn btn btn-success"><i class=" fa fa-phone request-icon"></i></a>
                        </div>
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
    <div class="paginate">
        {{ $estimate_recus->links() }}
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    addEventListener("DOMContentLoaded", (event) => {

        $(".plus-tard").on("click", function() {
            location.reload();
        });


        document.querySelectorAll('#star').forEach(star => {
            star.addEventListener('mouseover', animateStart);
            star.addEventListener('mouseout', animateEnd);
            star.addEventListener('click', set)
        })

        function animateStart(e) {
            const index = e.target.getAttribute('data-index')
            for (let i = 0; i <= index; i++) {
                e.target.parentNode.children[i].classList.add('animated')
            }

        }

        function animateEnd(e) {
            const index = e.target.getAttribute('data-index')
            for (let i = 0; i <= index; i++) {
                e.target.parentNode.children[i].classList.remove('animated')
            }
        }

        function set(e) {
            const index = e.target.getAttribute('data-index');
            for (let i = 0; i <= 4; i++) {
                e.target.parentNode.children[i].classList.remove('active')
            }
            for (let i = 0; i <= index; i++) {
                e.target.parentNode.children[i].classList.add('active')
            }
        }

        document.querySelector('.confirm').addEventListener('click', function(event) {

            const stars = document.querySelectorAll('#star');
            let activeStarsCount = 0;
            id = document.querySelector(".idEst").value;
            stars.forEach(star => {
                if (star.classList.contains('active')) {
                    activeStarsCount++;
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/add-user-review',
                type: 'POST',
                data: {
                    stars: activeStarsCount,
                    id: id
                },
                success: function(response) {
                    // Handle the response from the server
                    window.location.href = '{{ route('home') }}';
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



    });
</script>
