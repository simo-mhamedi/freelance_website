@extends('base.auth.registration')
@section('user-content')
    <form method="POST" action="{{ route('to-user-category-infos') }}" style="width: 100%">
        @csrf
        <div class="progress" style="width:100%;height:5px">
            <div class="progress-bar  bg-success" role="progressbar" aria-label="Basic example" style="width: 75%"
                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>
        <br>
        <div class="title_container">
            <p class="title-user-infos">INscrivez vous </p>
            <span class="subtitle-user-infos"> deposez vos offre & envoyez devis
            </span>
        </div>
        <br>
        <div class="input_container">

            <img class="icon"
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAABEklEQVR4nO2ZQQrCMBBF3xEUbyO6V1vBK3kMNy68TRW8hODSpVgRRkQLRSxNbDuJOA/+qp9hfjJNoAXDMEKSAlsgB+SD8tfzhEibFw8tiIydZ4CMyKgamypdiAyf5gtFhQX46x3oA2vgBCy/9AQLMAeOpaLnLz3qAXrAqqawiydIgClwqCns4lEP0Ac2DoVdPOoBJm9z3FSDUu1B1wFS4NZi823JmX0EzUqTANdfDyCRypnQjYoFoHoVhqWdGin6xH2A/Ipo+cQC8FyFxzYXjBV90tYO2CmEHaP1hB4V6fIdsHsAuweajZDdA9gx2v6nbw1d6PDng4YynwBJBA3Lm2Y+AYoQWeBxyl89eDdvGIaBCnewgSY3UyfcvwAAAABJRU5ErkJggg==">
            <input required placeholder="Nom societe" value="{{ isset($data['societeName']) ? $data['societeName'] : '' }}"  title="Inpit title" name="societeName" type="text" class="input_field"
                id="societeName">
        </div>
        <br>
        <div class="input_container">
            <img class="icon"
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAABKklEQVR4nO3UsUtCURTH8S/oH5BkEISTQ6tzBNUSjf4F/gOuBkHQFi3iEu0lvKWWoCFIJ/8AWxrMVYeiIgnEoUQRnnCJ533n4rkY4Q/Ocs+598OFdx8s80eTBS6ANtAH3oBbYNMnmgcGwCiiXoAisObjpv0ZqFldYF0TPheg0zrVhFsO8JMmPHCAvzTh10XB9w5wXRO+c4Ans2rpOsAdTbjiAJdRTl2APuAhBwJ4H085s6BHeM5oRvEv4RsLfK2NJYE9IBB8XEE4m5gH3AWugI8IoGrMVSP678AlsOMCZoBazM2GQC6soeBtb8ShKeBZ+IcqhCWZbQErNvhEeNAPkAZWgW/hnmMb/Cg8pGHsafzqbRm9bWO9aYN7Qrhk7DmMec/T9U8bvAy+MgZ+WBKOK5JpUwAAAABJRU5ErkJggg==">
            <input required value="{{ isset($data['companyRepresentative']) ? $data['companyRepresentative'] : '' }}" placeholder="Represantant de la société" title="Inpit title" name="companyRepresentative" type="text"
                class="input_field" id="companyRepresentative">
        </div>
        <br>
        <div class="input_container">
            <img class="icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAABEklEQVR4nO2ZQQrCMBBF3xEUbyO6V1vBK3kMNy68TRW8hODSpVgRRkQLRSxNbDuJOA/+qp9hfjJNoAXDMEKSAlsgB+SD8tfzhEibFw8tiIydZ4CMyKgamypdiAyf5gtFhQX46x3oA2vgBCy/9AQLMAeOpaLnLz3qAXrAqqawiydIgClwqCns4lEP0Ac2DoVdPOoBJm9z3FSDUu1B1wFS4NZi823JmX0EzUqTANdfDyCRypnQjYoFoHoVhqWdGin6xH2A/Ipo+cQC8FyFxzYXjBV90tYO2CmEHaP1hB4V6fIdsHsAuweajZDdA9gx2v6nbw1d6PDng4YynwBJBA3Lm2Y+AYoQWeBxyl89eDdvGIaBCnewgSY3UyfcvwAAAABJRU5ErkJggg==" alt="Your Image Alt Text">

            <input required  placeholder="email societe 1" value="{{ isset($data['email1']) ? $data['societeName'] : '' }}"  title="Inpit title" name="email1" type="email  " class="input_field"
                id="email1">
        </div>
        <br>
        <div class="input_container">
            <img class="icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAABEklEQVR4nO2ZQQrCMBBF3xEUbyO6V1vBK3kMNy68TRW8hODSpVgRRkQLRSxNbDuJOA/+qp9hfjJNoAXDMEKSAlsgB+SD8tfzhEibFw8tiIydZ4CMyKgamypdiAyf5gtFhQX46x3oA2vgBCy/9AQLMAeOpaLnLz3qAXrAqqawiydIgClwqCns4lEP0Ac2DoVdPOoBJm9z3FSDUu1B1wFS4NZi823JmX0EzUqTANdfDyCRypnQjYoFoHoVhqWdGin6xH2A/Ipo+cQC8FyFxzYXjBV90tYO2CmEHaP1hB4V6fIdsHsAuweajZDdA9gx2v6nbw1d6PDng4YynwBJBA3Lm2Y+AYoQWeBxyl89eDdvGIaBCnewgSY3UyfcvwAAAABJRU5ErkJggg==" alt="Your Image Alt Text">

            <input required  placeholder="email societe 2" value="{{ isset($data['email2']) ? $data['societeName'] : '' }}"  title="Inpit title" name="email2" type="email" class="input_field"
                id="email2">
        </div>
        <br>
        <div class="input_container country">
            @include('base.auth.registration-inc.inc-userAdresse.country')
            <div class="input_container city">
                <img class="icon"
                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAQUlEQVR4nGNgGAUUgP9E4sFvAbH8wWvBf0oMGRQW0CziaW7B0ExZ/wl4+T+lQUQ3C6jFHzgL/o/GwYDFwShgQAcA3mSxT5N1sRkAAAAASUVORK5CYII=">
                <input placeholder="City"  required title="Inpit title" name="city" type="text" class="input_field city-input"
                    id="rsSociete" value="{{ isset($data['city']) ? $data['city'] : ''  }}">
            </div>
        </div>
        <br>
        <div class="input_container">
            <img class="icon"
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAQUlEQVR4nGNgGAUUgP9E4sFvAbH8wWvBf0oMGRQW0CziaW7B0ExZ/wl4+T+lQUQ3C6jFHzgL/o/GwYDFwShgQAcA3mSxT5N1sRkAAAAASUVORK5CYII=">
            <input placeholder="RC"  value="{{ isset($data['rsSociete']) ? $data['rsSociete'] : '' }}" required title="Inpit title" name="rsSociete" type="text" class="input_field city-input"
                id="rsSociete">
        </div>
        <br>
        <div class="input_container">
            <input type="hidden" name="areaCode" value="+44" class="areaCode">
            <div class="select-box">
                <div class="selected-option">
                    <div>
                        <span class="iconify" data-icon="flag:gb-4x3"></span>
                        <strong>+44</strong>
                    </div>
                    <input type="tel" pattern="[0-9]{9}" value="{{ isset($data['tel']) ? $data['tel'] : '' }}" required name="tel" placeholder="Phone Number">
                </div>
                <div class="options">
                    <input type="text"  class="search-box"  placeholder="Search Country Name">
                    <ol>

                    </ol>
                </div>
            </div>
        </div>
        <br>

        <div class="actions">
            <a href="{{ route('back-user-infos') }}" class="sign-in_btn back-btn">
                <span>PRECEDENT</span>
            </a>
            <button title="Sign In" type="submit" class="sign-in_btn next-btn">
                <span>SUIVANT</span>
            </button>
        </div>
    </form>
@endsection
