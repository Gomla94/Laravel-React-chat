<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/new-authentication.css')}}"/>
    {{-- <link rel="stylesheet" href="{{asset('css/app.css')}}" /> --}}
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('images/dark-logo.jpeg') }}"/>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap"
        rel="stylesheet"
    />
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body style="background-color: #F0F2F5">
<div></div>
<div>
    @yield('content')
</div>
@stack('js')
</body>
</html>
