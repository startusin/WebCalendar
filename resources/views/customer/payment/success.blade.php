@extends('layouts')
@section('content')
    <div>
        <div class="mySuccess row d-flex justify-content-center">
            <div class="d-flex justify-content-center">
            <img src="{{$logo!=null ? asset('storage/' . $logo): '/demologo.png' }}" class="calendar-logo"/>
            </div>
            <div class="d-flex mt-5 flex-column align-items-center justify-content-center">
                <div class="title-Success">
                    Merci !
                </div>
                <div class="description-Success">
                    <p class="text-center">Nous avons blen receptionee <br>
                        votre reservation pour visitier nos caves
                    </p>
                </div>
            </div>
            <div class="successful-container d-flex flex-column align-items-center justify-content-center">
            <div class=" ">
                <div class="d-flex justify-content-center col-12 text-center">
                    <div class="title-payment-succusess">Nous vous donnons donc rednez-vous le</div>
                </div>
                <div class="d-flex justify-content-center col-12 text-center success-textmt-1">
                    <div id="SuccessDateId" class="success-date">Mardi juin 2024 11h45</div>
                </div>
            </div>

        </div>
            <div class="ending-Success mt-3">
                <p class="text-center">Vous allez recevoir ce jour un mail de confirmation <br> avec le detail de votre commande.<br> A bientot</p>
            </div>
    </div>
    </div>
@endsection

