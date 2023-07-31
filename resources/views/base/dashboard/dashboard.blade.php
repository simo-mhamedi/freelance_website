@extends('base.index')

@section('content')
    <div class="dash-title">
        TABLEAUX DE BORD
    </div>
    <div class="estimate-infos">
        <div class="rest">
            <div class="number">
            @if($user_historique)
            {{$user_historique->estimates_restNumber}}
            @else
            0
            @endif
        </div>
            <div class="content">devis RESTANTS
            </div>
        </div>
        <div class="propose">
            <div class="number">
                @if($consum_estimate)
                {{$consum_estimate}}
                @else
                0
                @endif
               </div>
            <div class="content">offre proposé
            </div>
        </div>
    </div>
    <div class="week-status">
        <div class="week-title">Apercu de la semaine
        </div>
        <div class="status">
            <div class="statu">
                <div class="value">{{$allEstimates}}</div>
                <div class="title">
                    devis ajoutés
                </div>
            </div>
            <div class="statu statu-with-chart">
                <div class="chart">
                    <img src="{{ asset('home/imges/Layer 3.png') }}"
                        alt="">

                </div>
                <div class="infos">
                    <div class="value">{{$estimate_send}}</div>
                    <div class="title">devis envoyé
                    </div>
                </div>

            </div>
            <div class="statu statu-with-chart">
                <div class="chart">
                    <img src="{{ asset('home/imges/Layer 4.png') }}" alt="">
                </div>
                <div class="infos">
                    <div class="value">{{$estimate_recus}}</div>
                    <div class="title">devis recus
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="next-section">
        <div class="title">
            Nouveaux devis

        </div>
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
                @foreach ($lastsEstimates as $estimate_recu)
                    <tr>
                        <td>
                            @if ($estimate_recu !== null)
                        {{ $estimate_recu->reference }}
                        <!-- Other table cells or data for each estimate -->
                @endif
                        </td>
                <td>
                    @if ($estimate_recu !== null)
                    {{ $estimate_recu->client->companyName  }}
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

                    <div  class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div style="    height: 90%;" class="modal-dialog modal-lg" role="document">
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
@endsection
