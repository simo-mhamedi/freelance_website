@extends('base.index')
<style>
    .dash-title {
        margin-left: 40px;
        color: #00A453;
        font-size: 50px;
        text-transform: uppercase;
    }

    .estimate-infos {
        width: 100%;
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin: 20px;
    }
    .table{
        margin: 20px
    }
    .rest {
        width: 324px;
        height: 189px;
        flex-shrink: 0;
        border-radius: 14px 14px 0px 14px;
        background: #F2F5F2;
        color: #000;
        font-size: 60px;
        text-transform: uppercase;
        text-align: center
    }

    .rest .content {
        color: #000;
        font-size: 30px;
        text-transform: uppercase;
    }

    .propose {
        width: 324px;
        height: 189px;
        flex-shrink: 0;
        border-radius: 14px;
        background: #00A453;
        color: #FFF;
        font-size: 60px;
        text-align: center;
        text-transform: uppercase;
    }

    .propose .content {
        color: #FFF;
        font-size: 30px;
        line-height: 21.76px;
        text-transform: uppercase;
    }

    .week-status {
        padding: 20px;
        width: 822px;
        height: 232px;
        flex-shrink: 0;
        border-radius: 14px;
        background: #F2F5F2;
        margin-left: auto;
        margin-right: auto;
    }

    .week-title {
        color: #000;
        font-size: 30px;
        margin: 10px;
        text-transform: uppercase;
    }

    .status {
        display: flex;
        align-content: center;
        justify-content: space-evenly
    }

    .statu .value {
        color: #108A00;
        font-size: 50px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .statu {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .statu .title {
        color: #000;
        font-size: 20px;
        text-transform: uppercase;
    }

    .chart img {
        margin: 10px;
        width: 100px;
    }

    .statu-with-chart {
        display: flex;
        flex-direction: row;
        align-items: center;

    }

    .infos {
        display: flex;
        flex-direction: column;
        align-content: center
    }

    .next-section .title {
        color: #000;
        font-size: 30px;
        line-height: 21.76px;
        text-transform: uppercase;
    }
    .next-section{
        margin: 20px;
        margin-left: auto;
        margin-right: auto;
        width: 70%;
    }
</style>
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
                <div class="value">130</div>
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
        <table class="table">
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
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
    </div>
@endsection
