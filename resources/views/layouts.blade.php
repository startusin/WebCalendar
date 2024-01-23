<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3f9b90c861.js" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/hjsCalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/customstyle.css') }}">
    <title>Calendar</title>

</head>
<body>
{{--@if (Route::has('login'))--}}
{{--    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">--}}
{{--        @auth--}}
{{--            <a href="{{ url('/home') }}" class="btn btn-primary font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>--}}
{{--        @else--}}
{{--            <a href="{{ route('login') }}" class="btn btn-primary font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>--}}

{{--            @if (Route::has('register'))--}}
{{--                <a href="{{ route('register') }}" class="btn btn-primary ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>--}}
{{--            @endif--}}
{{--        @endauth--}}
{{--    </div>--}}
{{--@endif--}}

@yield('content')

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-popover@0.0.4/src/jquery-popover.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/jquery.bs.calendar.min.js') }}"></script>
<script>

    $('#exampleCalendar').bsCalendar({
        width: '100%',
        showTodayHeader:false,

        formatEvent:function (event) {
            const startTime = new Date(event.start).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
            const endTime = new Date(event.end).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });

            //return drawEvent(event);
            console.log(event);
            return '<button class="event-time meeting d-inline-block w-auto event-item" data-language = '+event.language+'  data-id = '+event.timestamp+'  data-start = '+event.start+' data-end='+event.end+'>'+ event.language+' ' + startTime + ' - ' + endTime + '</button>'
        },
    });
</script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/js/сalendarProduct.js')}}"></script>
@stack('js')

</body>
</html>

