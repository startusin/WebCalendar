@extends('layouts')
@section('content')
    <div class="container MyContainer main-container" data-calendar-id="{{ $user->id }}">
        <div class="row justify-content-center">
            <header class="d-block my-header pb-4 mt-4 mb-3 text-center position-relative">
                <img src="{{$logo!=null ? asset('storage/' . $logo): '/demologo.png' }}" class="calendar-logo"/>

                <div class="dropdown language-selector-container position-absolute">
                    <a class="dropdown-toggle language-selector" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <img src="/assets/flags/{{ $locale }}.png" class="flag-icon"/>

                        <i class="fa-solid fa-arrow-down selector-arrow"></i>
                    </a>

                    <ul class="dropdown-menu language-selector-list">
                        @foreach ($user->languages as $lang)
                            <li>
                                <a class="dropdown-item my-1" href="{{ route('setLang', $lang )}}">
                                    <img src="/assets/flags/{{ $lang }}.png"
                                         class="flag-icon me-2"/> {{ \App\Enums\Languages::getStringLanguage($lang) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </header>

            <div class="sub-title mt-1 mb-2 text-center mb-4 fw-bold text-uppercase">
                {{$user->translations['translations']['indicate-your'][Cookie::get('locale')]??""}}
            </div>

            <div data-bs-toggle="calendar" style="padding: 0" id="exampleCalendar"
                 data-bs-target="{{ route('slots', ['user' => $user]) }}" class="mt-4"></div>

            <div class="brunches d-flex flex-wrap justify-content-center d-none brunches-area">
                <div class="col-12">
                    <div class="brunch-title-head mb-4">
                        {{$user->translations['translations']['brunch'][Cookie::get('locale')]??""}}
                    </div>

                    <div class="brunch-list text-center"></div>
                </div>

{{--                <div class="col-6">--}}
{{--                    <div class="sub-title mb-4">--}}
{{--                        {{$user->translations['translations']['dont-miss'][Cookie::get('locale')]??""}}--}}
{{--                    </div>--}}

{{--                    <div class="brunch-article"--}}
{{--                         style="background-image: url('{{$banner!=null ? asset('storage/' . $banner): 'https://placehold.co/600x400/EEE/31343C' }}');">--}}
{{--                        <div class="inner">--}}
{{--                            {{ $user->settings['brunch_text'][\Illuminate\Support\Facades\Cookie::get('locale')] ?? '' }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>

            <div class="brunch-qty d-flex flex-wrap justify-content-center mt-3 d-none px-0 mb-4">
                <div class="brunch col-12 py-3 mt-1 mb-1">
                    <div class="up-card d-flex mb-2 items-center align-items-center">
                        <div class="col-7">
                            <div class="brunch-title">
                                {{$user->translations['translations']['select-brunch'][Cookie::get('locale')]??""}}
                            </div>
                        </div>

                        <div class="brunch-navigation col-5">
                            <div class="d-flex justify-content-end brunch-navigation-container">
                                <div class="brunch-price"><span>0</span>€</div>

                                <div class="right-icon white-circle">
                                    <button>
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                </div>
                                <div class="count-of-brunch white-circle">0</div>
                                <div class="left-icon white-circle">
                                    <button>
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="products d-flex flex-wrap justify-content-center mt-3 d-none products-area">
                <div class="sub-title mt-3 mb-2 text-center mb-4 fw-bold text-uppercase">
                    {{$user->translations['translations']['select-product'][Cookie::get('locale')]??""}}
                </div>

                @foreach($products as $product)
                    <div class="product col-12 pb-3 mt-1 mb-4">
                        <div class="up-card d-flex mb-2 align-items-center">
                            <div class="col-7">
                                @foreach($product['title'] as $key => $item)
                                    @if(\Illuminate\Support\Facades\Cookie::get('locale') == $key)
                                        <div class="product-title">{{$item}}</div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="product-navigation col-5">
                                <div class="d-flex justify-content-center product-navigation-container">
                                    @foreach($product['price'] as $key => $item)
                                        @if(\Illuminate\Support\Facades\Cookie::get('locale') == $key)
                                            <div class="product-price" data-id="{{ $product->id }}" data-price="{{$item}}">
                                                {{ (double)$item }}€
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="right-icon white-circle" data-id="{{ $product->id }}">
                                        <button>
                                            <i class="fa-solid fa-minus"></i>
                                        </button>
                                    </div>
                                    <div class="count-of-product white-circle" data-max="{{$product->max_qty}}">0</div>
                                    <div class="left-icon white-circle" data-id="{{ $product->id }}">
                                        <button>
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="down-card">

                            @foreach($product['description'] as $key => $item)
                                @if(\Illuminate\Support\Facades\Cookie::get('locale')== $key)
                                    <div class="product-description">
                                        {{ $item }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-3 mb-5 row d-flex flex-nowrap align-items-center d-none button-order">
                <div class="col-6" style="width: 47.5%;">
                </div>
                <div type="button" id="PurchaseButton" class="col-5 reserve text-start disable_button"
                     style="width: 19%;">
                    {{$user->translations['translations']['reserver'][Cookie::get('locale')]??""}}
                </div>
                <div class="col-1 total-sum-purchase" style="width: 13.5%;">
                    0.00€
                </div>
            </div>
        </div>
    </div>

    @if ($banner):
        <style>
            .bootstrap-calendar-container .js-collapse .js-events {
                background: url({{ asset('storage/' . $banner) }});
                padding-top: 24px;
                padding-left: 15px;
                padding-right: 15px;
            }
        </style>
    @endif
@endsection
@push('js')
    <script>


        $('#exampleCalendar').bsCalendar({
            locale: "{{$locale}}",
            width: '100%',
            showTodayHeader: false,
            showPopover: false,

            formatEvent: function (event) {
                const startTime = new Date(event.start).toLocaleTimeString('fr-FR', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
                const qty = (event.limit - event.booked) < 0 ? 0 : (event.limit - event.booked);

                return '<button class="event-time meeting d-inline-block w-auto event-item ' + (qty <= 0 ? 'inactive' : '') + '" data-language = ' + event.language + '  data-id = ' + event.timestamp + ' data-start = ' + event.start + ' data-end=' + event.end + ' data-available=' + qty + '>' +
                    '<img class="event-flag" src="/assets/flags/' + event.language + '.png">' + startTime + '' +
                    '<div class="qty-inner"><i class="fa-regular fa-user attendee-icon"></i> <div class="qty-inner-text">' + qty +
                    '</div></div></button>'
            },
        });
    </script>
@endpush
