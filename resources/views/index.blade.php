@extends('layouts')
@section('content')
    <div class="container MyContainer">
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


        <div class="products d-flex flex-wrap justify-content-center mt-3">

            @foreach($products as $product)
                <div class="product col-12 pt-2 pb-2 mt-1 mb-1">
                    <div class="up-card d-flex mb-3">
                        <div class="product-title col-6">{{ $product->title }}</div>
                        <div class="product-price d-flex justify-content-end col-3" data-price="{{$product->price}}">{{ $product->price }}$</div>
                        <div class="product-navigation col-3 d-flex justify-content-center">
                            <div class="left-icon white-circle" data-id="{{ $product->id }}">
                                <button >
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                            <div class="count-of-product white-circle" data-max="{{$product->max_qty}}">0</div>
                            <div class="right-icon white-circle" data-id="{{ $product->id }}">
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
        <div class="mt-3 mb-5 row d-flex flex-nowrap align-items-center" style="padding: 0;">
            <div class="col-6 left-link-modifier" style="width: 47.5%;">
                Modifier la date consider
            </div>
            <div  type="button" class="col-5 reserve text-start" style="width: 37%;"><i class="fa-solid fa-check"></i> Reserver</div>
            <div class="col-1 total-sum-purchase" style="width: 13.5%;">
                38$
            </div>
        </div>
    </div>
    </div>
@endsection
