
@extends('base.auth.registration')
@section("user-content")
<form method="POST" action="{{ route('to-user-category-infos') }}" style="width: 100%">
    @csrf
    <div class="progress" style="width:100%;height:5px">
        <div class="progress-bar  bg-success" role="progressbar" aria-label="Basic example" style="width: 75%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
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

    <img class="icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAABEklEQVR4nO2ZQQrCMBBF3xEUbyO6V1vBK3kMNy68TRW8hODSpVgRRkQLRSxNbDuJOA/+qp9hfjJNoAXDMEKSAlsgB+SD8tfzhEibFw8tiIydZ4CMyKgamypdiAyf5gtFhQX46x3oA2vgBCy/9AQLMAeOpaLnLz3qAXrAqqawiydIgClwqCns4lEP0Ac2DoVdPOoBJm9z3FSDUu1B1wFS4NZi823JmX0EzUqTANdfDyCRypnQjYoFoHoVhqWdGin6xH2A/Ipo+cQC8FyFxzYXjBV90tYO2CmEHaP1hB4V6fIdsHsAuweajZDdA9gx2v6nbw1d6PDng4YynwBJBA3Lm2Y+AYoQWeBxyl89eDdvGIaBCnewgSY3UyfcvwAAAABJRU5ErkJggg==">
    <input placeholder="Nom societe" title="Inpit title" name="email" type="text" class="input_field" id="email_field">
  </div>
  <br>
  <div class="input_container">
    <img  class="icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAABKklEQVR4nO3UsUtCURTH8S/oH5BkEISTQ6tzBNUSjf4F/gOuBkHQFi3iEu0lvKWWoCFIJ/8AWxrMVYeiIgnEoUQRnnCJ533n4rkY4Q/Ocs+598OFdx8s80eTBS6ANtAH3oBbYNMnmgcGwCiiXoAisObjpv0ZqFldYF0TPheg0zrVhFsO8JMmPHCAvzTh10XB9w5wXRO+c4Ans2rpOsAdTbjiAJdRTl2APuAhBwJ4H085s6BHeM5oRvEv4RsLfK2NJYE9IBB8XEE4m5gH3AWugI8IoGrMVSP678AlsOMCZoBazM2GQC6soeBtb8ShKeBZ+IcqhCWZbQErNvhEeNAPkAZWgW/hnmMb/Cg8pGHsafzqbRm9bWO9aYN7Qrhk7DmMec/T9U8bvAy+MgZ+WBKOK5JpUwAAAABJRU5ErkJggg==">
    <input placeholder="Represantant de la société" title="Inpit title" name="password" type="password" class="input_field" id="password_field">
  </div>
  <br>
  <div class="input_container">

<select class="selectpicker countrypicker" data-flag="true"></select>
  </div>
  <br>

  <div class="actions">
    <button href="{{ url()->previous() }}" title="Sign In" type="submit" class="sign-in_btn back-btn">
        <span>PRECEDENT</span>
    </button>
      <button title="Sign In" type="submit" class="sign-in_btn next-btn" >
        <span>SUIVANT</span>
      </button>
  </div>
</form>

  @endsection