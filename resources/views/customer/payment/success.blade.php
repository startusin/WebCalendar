@extends('layouts')
@section('content')
    <div>
        <div class="mySuccess row d-flex justify-content-center">
            <div class="d-flex justify-content-center">
            <img src="{{$logo!=null ? asset('storage/' . $logo): '/demologo.png' }}" class="calendar-logo"/>
            </div>
            <div class="d-flex mt-5 flex-column align-items-center justify-content-center">
                <div class="title-Success">
                    {{$user->translations['translations']['thanks'][Cookie::get('locale')]??""}}
                </div>
                <div class="description-Success">
                    <p class="text-center">
                        {{$user->translations['translations']['received-reservation'][Cookie::get('locale')]??""}}
                    </p>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center">
            <div class="successful-container d-flex flex-column align-items-center justify-content-center">
            <div class=" ">
                <div class="d-flex justify-content-center col-12 text-center">
                    <div class="title-payment-succusess"> {{$user->translations['translations']['invite-meet-us'][Cookie::get('locale')]??""}}</div>
                </div>
                <div class="d-flex justify-content-center col-12 text-center success-textmt-1">
                    <div id="SuccessDateId" class="success-date"></div>
                </div>
            </div>
            </div>
        </div>
            <br>
            <div class="ending-Success mt-3">
                <p class="text-center"> {{$user->translations['translations']['see-you-soon'][Cookie::get('locale')]??""}}</p>
            </div>
    </div>
    </div>
@endsection

@push('firstJs')
    <script>
        let currentLanguage;
        $.ajax({
            url: '/currentLanguage',
            async: false,
            method: 'GET',
            success: function(data) {
                currentLanguage = data;
                console.log("Current Language"+currentLanguage);
            },
            error: function(xhr, status, error) {

                console.error(xhr.responseText);
            }
        });

        let tempTime =  moment('{{$date}}');

        if (currentLanguage==='fr') {
            moment.updateLocale('fr', {
                months: [
                    "janvier", "février", "mars", "avril", "mai", "juin",
                    "juillet", "août", "septembre", "octobre", "novembre", "décembre"
                ],
                weekdays: [
                    "dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"
                ]
            });
        }

        let formattedStartTime = tempTime.locale('fr').format('D MMMM YYYY HH[h]mm');
        console.log(formattedStartTime);

        document.cookie = "currentDate=" + String(formattedStartTime) + "; expires=" + 3600 + "; path=/";
    </script>
@endpush
