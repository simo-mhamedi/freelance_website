<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link  rel="stylesheet" href="{{ URL::asset('countrys/build/css/demo.css') }}" rel="stylesheet" />
    <link  rel="stylesheet" href="{{ URL::asset('countrys/build/css/countrySelect.css') }}" rel="stylesheet" />
</head>
<body>
    <div class="input_container">
        @yield('input')
    </div>
<!-- Load jQuery from CDN so can run demo immediately -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ URL::asset('countrys/build/js/countrySelect.js') }}"></script>
<script>
    $("#country_selector").countrySelect({
        // defaultCountry: "jp",
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // responsiveDropdown: true,
        preferredCountries: ['ca', 'gb', 'us']
    });
</script>
</body>
</html>