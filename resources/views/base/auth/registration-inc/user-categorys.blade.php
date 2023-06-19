@extends('base.auth.registration')
<style>
    .container {
        width: 1180px;
        margin-top: 3em;
    }

    #accordion {
        width: 100%;
    }

    #accordion .panel {
        border-radius: 5px;
        border: 0;
        margin-top: 0px;
    }

    #accordion a {
        display: block;
        padding: 10px 15px;
        border-radius: 10px;
        text-decoration: none;
        background-color: #00A453;
        font-style: normal;
        font-weight: 600;
        font-size: 22px;
        line-height: 22px;
        /* identical to box height, or 84% */
        text-transform: uppercase;

        color: #FEF9F9;

        text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    }

    #accordion .panel-heading a.collapsed:hover,
    #accordion .panel-heading a.collapsed:focus {
        color: white;
        transition: all 0.2s ease-in;
    }

    #accordion .panel-heading a.collapsed:hover::before,
    #accordion .panel-heading a.collapsed:focus::before {
        color: white;
    }

    #accordion .panel-heading {
        padding: 0;
        border-radius: 0px;
        text-align: center;
    }

    #accordion .panel-heading a:not(.collapsed) {
        color: white;
        transition: all 0.2s ease-in;
        border-radius: 5px;
    }

    /* Add Indicator fontawesome icon to the left */
    #accordion .panel-heading .accordion-toggle::before {
        font-family: 'FontAwesome';
        float: left;
        color: white;
        font-weight: lighter;
        transform: rotate(0deg);
        transition: all 0.2s ease-in;
    }

    #accordion .panel-heading .accordion-toggle.collapsed::before {
        color: #444;
        transform: rotate(-135deg);
        transition: all 0.2s ease-in;
    }

    .sub {
        background: #4C78AF !important;
        border-radius: 12px !important;
        font-style: normal;
        font-weight: 600;
        font-size: 15px !important;
        line-height: 22px;
        /* identical to box height, or 109% */

        align-items: center;
        text-transform: uppercase;

        color: #FFFFFF;
    }

    .sub:hover {
        background-color: #FFFFFF;
        color: black
    }

    .category-selected {
        margin: 20px;
        width: 22%;
        background: #E2E3E4 !important;
        border-radius: 12px !important;
        font-style: normal;
        font-weight: 600;
        font-size: 10px !important;
        line-height: 22px;
        /* identical to box height, or 145% */
        align-items: center;
        text-transform: uppercase;
        padding: 4px !important;
        color: #FFFFFF;
        position: relative;
    }

    .close {
        color: rgba(0, 0, 0, 0.4);
        position: absolute;
        right: 9px;
        top: 5px;
    }

    #second-list {
        padding: 0px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
@section('user-content')
    <div style="width: 100%">
        @csrf
        <div class="progress" style="width:100%;height:5px">
            <div class="progress-bar  bg-success" role="progressbar" aria-label="Basic example" style="width: 100%"
                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>
        <div class="title_container">
            <p class="title-user-infos">INscrivez vous </p>
            <span class="subtitle-user-infos"> deposez vos offre & envoyez devis </span>
        </div>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->

        <div class="container">
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
                        <center>

                        </center>
                    </ul>
                </div>

                <div class="form-group">
                    <textarea id="desc"
                        style="background: #F2F5F2;
                    border-radius: 14px;
                    height: 309px;
                    "
                        class="form-control" placeholder="description company ..(150 mots)" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
        </div>
        <br>

        <div class="actions">
            <a href="{{ route('back-company-infos') }}" class="sign-in_btn back-btn">
                <span>PRECEDENT</span>
            </a>
            <button title="Sign In" class="sign-in_btn next-btn">
                <span>TERMINER</span>
            </button>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Instead of -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script> -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    addEventListener("DOMContentLoaded", (event) => {
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

        // Event listener for clicking on categories in the second list
        document.getElementById('second-list').addEventListener('click', function(event) {
            var category = event.target;
            if (category.className == "fa fa-close close") {
                category.parentElement.parentNode.removeChild(category.parentElement);
            }
            // Remove the category from the second list
        });
        document.querySelector('.next-btn').addEventListener('click', function(event) {
            var listItems = Array.from(document.querySelector('.myList').getElementsByTagName('li'));
            var list = listItems.map(function(item) {
                return item.value;
            });

            var jsonList = JSON.stringify(list);
            var desc = JSON.stringify(document.querySelector("#desc").value);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/signUp-user',
                type: 'POST',
                data: {
                    list: jsonList,
                    desc: desc
                },
                success: function(response) {
                    // Handle the response from the server
                    window.location.href = '{{ route('home') }}';
                },
                error: function(xhr) {
                    // Handle any errors that occur during the request
                    Toastify({
                        text: xhr.responseText,
                        className: "errore",
                        style: {
                            background: "linear-gradient(to right, #df1b1b, #d62121)",
                        }
                    }).showToast();
                }
            });
        });


        // var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        // console.log(csrfToken);

        // var xhr = new XMLHttpRequest();
        // xhr.open('POST', '/signUp-user', true);
        // xhr.setRequestHeader('Content-Type', 'application/json');
        // xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        // xhr.onreadystatechange = function() {
        //     if (xhr.readyState === 4) {
        //         if (xhr.status === 200) {
        //             // Handle the response from the controller
        //             console.log(xhr.responseText);
        //         } else {
        //             // Handle the error response
        //             console.error(xhr.status + ': ' + xhr.statusText);
        //         }
        //     }
        // };
        // xhr.send(JSON.stringify(list));

    });
</script>
