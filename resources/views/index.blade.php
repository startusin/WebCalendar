@extends('layouts')
@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <header class="d-flex my-header mb-5">
            <div class="d-flex navigation-action col-8">
                <div class="action">Visite </div>
                <div class="action">Brunch </div>
                <div class="action">Event</div>
            </div>
            <div class="d-flex navigation-language col-4">
                <div class="language col-4">ENG </div>
                <div class="language col-4">FR </div>
                <div class="language col-4">ES</div>
            </div>
        </header>
        <div class="d-flex  sub-title  mt-3 mb-2">
            <div class="IdCounter">
                1
            </div>
            <div class="sub-title-text">
                Indiques vos dates et holralres
            </div>
        </div>

        <div data-bs-toggle="calendar" style="padding: 0" id="exampleCalendar" data-bs-target="{{ route('slots', ['user' => $user]) }}"></div>


{{--        <div class="col-12" id="rightContent" style="margin-top: 20px; text-align: center;">--}}
{{--            <div class="fw-bold justify-content-center d-flex py-5" id="today-date">--}}
{{--                <div id="event-day">Friday</div>--}}
{{--                <div id="event-date">, February 16</div>--}}
{{--            </div>--}}
{{--            <div class="text-center">--}}
{{--                <div class="events me-4 row gx-2 d-flex flex-wrap" id="meeting_daily_timings">--}}
{{--                    @foreach($slots as $slot)--}}
{{--                        <button class="event-time meeting d-inline-block w-auto">--}}
{{--                            {{ $slot->start_date->format('h:i') }} - {{ $slot->end_date->format('h:i') }} {{ $slot->language }}--}}
{{--                        </button>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}



        <div class="products d-flex flex-wrap justify-content-center mt-3">
            @foreach($products as $product)
                <div class="product col-12 pt-2 pb-2 mt-1 mb-1">
                    <div class="up-card d-flex mb-3">
                        <div class="product-title col-6">{{ $product->title }}</div>
                        <div class="product-price d-flex justify-content-end col-3">{{ $product->price }}$</div>
                        <div class="product-navigation col-3 d-flex justify-content-center">
                            <div class="left-icon white-circle">
                                <button>
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                            <div class="count-of-product white-circle">0</div>
                            <div class="right-icon white-circle">
                                <button>
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="down-card">
                        <div class="product-description">
                            {{ $product->description }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
@endsection
