@extends("base.auth.registration-inc.inc-userAdresse.base")
@section("input")
    <div class="form-item">
        <input id="country_selector" value="{{ isset($data['country']) ? $data['country'] : '' }}" class="form-control" name="country" type="text">
        <label for="country_selector" style="display:none;">Select a country here...</label>
    </div>
    <div class="form-item" style="display:none;">
        <input type="text" class="form-control" id="country_selector_code" name="country_selector_code" data-countrycodeinput="1" readonly="readonly" placeholder="Selected country code will appear here" />
        <label for="country_selector_code">...and the selected country code will be updated here</label>
    </div>
    <button type="submit" style="display:none;">Submit</button>
@endsection