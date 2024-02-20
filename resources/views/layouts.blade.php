<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://kit.fontawesome.com/3f9b90c861.js" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/hjsCalendar.min.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@600&family=Outfit:wght@300;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    @stack('css')
    <style>

        :root {
            --calendar-primary-color: {{ isset($user) && isset($user->settings['primary_color']) ? $user->settings['primary_color'] : "#cca646" }};
            --calendar-secondary-color: {{isset($user) &&  isset($user->settings['secondary_color'])? $user->settings['secondary_color']:"#e9d9a7" }};
            --calendar-background-color: {{isset($user) &&  isset($user->settings['bg_color'])?$user->settings['bg_color']:"#fcf6e8" }};
        }
        body{
            background-color: {{isset($user) &&  isset($user->settings['bg_color'])?$user->settings['bg_color']:"#fcf6e8" }};
        }
        .MyContainer {
            background-color: {{isset($user) &&  isset($user->settings['bg_color'])?$user->settings['bg_color']:"#fcf6e8" }};
        }
        .PurchaseContainer{
            background-color: {{isset($user) &&  isset($user->settings['bg_color'])?$user->settings['bg_color']:"#fcf6e8" }};
        }
    </style>

    <title>Calendar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;600;700;800&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/customstyle.css') }}">

</head>
<body>

<div class="fullScreen">

@yield('content')

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-popover@0.0.4/src/jquery-popover.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/jquery.bs.calendar.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
@stack('firstJs')

<script src="{{asset('assets/js/сalendarProduct.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>

@stack('js')

</body>
</html>

