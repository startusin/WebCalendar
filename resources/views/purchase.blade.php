@extends('layouts')
@section('content')
    <script src="https://js.stripe.com/v3/"></script>

    <div class="container PurchaseContainer">
        <div class="row">
            <div class="col-md-6 form-inner">
                <form method="POST" id="form-data">
                    @csrf
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <input type="hidden" name="slots" id="slots" value="{{ json_encode($slots) }}">
                    <input name="calendar_id" id="calendar_id" value="{{$calendarId}}" hidden>
                    <input name="vat" id="vat" value="{{$user->settings['vat']}}" hidden>

                    <input name="adminValue" id="adminValue" value="{{$admin}}" hidden>

                    <div class="sub-title mt-5 mb-4">
                        {{$user->translations['translations']['choise1'][Cookie::get('locale')]??""}}
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" {{$formSettings['First_Name']==1?"required":""}}  class="form-control" id="First_NameInput" name="First_NameInput" placeholder="name@example.com">
                                <label for="floatingInput">{{$user->translations['translations']['prenom'][Cookie::get('locale')]??""}}</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" {{$formSettings['Last_Name']==1?"required":""}} class="form-control" id="Last_NameInput" name="Last_NameInput" placeholder="name@example.com">
                                <label for="floatingInput">{{$user->translations['translations']['perrier'][Cookie::get('locale')]??""}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text"  {{$formSettings['Company']==1?"required":""}} class="form-control" id="CompanyInput" name="CompanyInput" placeholder="name@example.com">
                            <label for="floatingInput">{{$user->translations['translations']['nam-de-enterprise'][Cookie::get('locale')]??""}}</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <select class="form-select"  id="RegionSelect"  name="RegionSelect" aria-label="Floating label select example">
                                @foreach($user->settings['countries'] as $item)
                                    <option value="{{$item}}" selected>{{$item}}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">{{$user->translations['translations']['works-with-selectes'][Cookie::get('locale')]??""}}</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" {{$formSettings['Street']==1?"required":""}} class="form-control" id="StreetInput" name="StreetInput" placeholder="name@example.com">
                            <label for="floatingInput">{{$user->translations['translations']['numero-de-voie'][Cookie::get('locale')]??""}}</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" {{$formSettings['Place']==1?"required":""}} class="form-control" id="PlaceInput" name="PlaceInput" placeholder="name@example.com">
                            <label for="floatingInput">{{$user->translations['translations']['appartnent'][Cookie::get('locale')]??""}}</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text"{{$formSettings['PostalCode']==1?"required":""}} class="form-control" id="PostalCode"  name="PostalCode" placeholder="name@example.com">
                            <label for="floatingInput">{{$user->translations['translations']['code-postal'][Cookie::get('locale')]??""}}</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" {{$formSettings['Ville']==1?"required":""}} class="form-control" id="floatingInput" name=floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">{{$user->translations['translations']['ville'][Cookie::get('locale')]??""}}</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="email"{{$formSettings['EmailInput']==1?"required":""}} class="form-control" id="EmailInput"  name="EmailInput" placeholder="name@example.com">
                            <label for="floatingInput">{{$user->translations['translations']['addresse-de'][Cookie::get('locale')]??""}}</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input  id="phone" type="tel"  {{$formSettings['PhoneInput']==1?"required":""}} class="form-control" name="PhoneInput">
                            {{--                            <label for="floatingInput">{{$user->translations['translations']['telephone'][Cookie::get('locale')]??""}}</label>--}}
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-6">
                <div class="sub-title mt-5 mb-4">
                    {{$user->translations['translations']['choise2'][Cookie::get('locale')]??""}}
                </div>

                <div class="all-purchase mb-5" data-intent="{{ $intent->id }}" data-token="{{ $intent->client_secret }}" data-pk-js="{{ env('STRIPE_PK_JS') }}" data-locale="{{ Cookie::get('locale') ?? 'en' }}" data-slot-date="{{ $slots['startDateSlot']->format('Y-m-d H:i:s') }}" data-calendar-id="{{ $user->id }}">
                    <div class="products-items">

                    @if(!$isBrunch)
                        @foreach($productData as $product)
                            <div class="accordion-item">
                                <div class="accordion-header d-block" id="flush-heading{{$product['product']->id}}">
                                    <div class="collapsed prod-info" data-product-price-id ="{{$product['product']->product_price_id}}"
                                         data-price="{{$product['price']}}"
                                         data-id="{{$product['product']->id}}"
                                         data-quantity={{$product['product']->quantity}}
                                         type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$product['product']->id}}" aria-expanded="false" aria-controls="flush-collapse{{$product['product']->id}}">
                                        <div class="product-item d-flex">

                                            @foreach($product['product']['title'] as $lg => $item)
                                                @if(\Illuminate\Support\Facades\Cookie::get('locale') == $lg)
                                                    <div class="col-7 product-item-text">
                                                        {{$item}}
                                                    </div>
                                                @endif
                                            @endforeach


                                            <div class="col-4 text-end">
                                                <div class="product-item-count d-inline-block">
                                                    <span>{{$product['product']->quantity}}</span>
                                                </div>

                                                <div class="product-item-price d-inline-block">
                                                    <span>{{$product['product']->quantity * $product['price']}}€</span>
                                                </div>
                                            </div>

                                            <div class="col-1 product-item-mo text-end">
                                                <i class='fas fa-angle-down'></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="flush-collapse{{$product['product']->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$product['product']->id}}" data-bs-parent="#accordionFlushExample">
                                    <div class="row d-flex promo-inner">
                                        <div class="accordion-body col-8 my-2">
                                            <input type="text" class="form-control promocode-input" data-product-id="{{$product['product']->id}}" placeholder="{{$user->translations['translations']['promocode'][Cookie::get('locale')]??""}}">
                                        </div>
                                        <div class="col-4 d-flex align-items-center promocode-apply text-center justify-content-center">
                                            <button style="background-color: var(--calendar-primary-color); color: white; font-weight: 600">
                                                {{$user->translations['translations']['apply'][Cookie::get('locale')]??""}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="accordion-item">
                            <div class="accordion-header d-block">
                                <div class="collapsed prod-info" data-brunch-id="{{ $brunchId }}" data-qty="{{ $totalQuantity }}">
                                    <div class="product-item d-flex">
                                        <div class="col-7 product-item-text">
                                            {{$user->translations['translations']['brunch'][Cookie::get('locale')]??""}}
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="product-item-count d-inline-block">
                                                <span>{{ $totalQuantity }}</span>
                                            </div>

                                            <div class="product-item-price d-inline-block">
                                                <span>{{ $brunchPrice }}€</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    </div>
                    <div class="sous-total d-flex">
                        <div class="col-7 sous-total-item-text">
                            {{$user->translations['translations']['sous-total'][Cookie::get('locale')]??""}}
                        </div>
                        <div class="col-4 text-end">
                            <div class="product-item-count d-inline-block">
                                <span>{{$totalQuantity}}</span>
                            </div>

                            <div class="product-item-price d-inline-block">
                                <span style="background-color: var(--calendar-primary-color); color: white; font-weight: 600">{{$sousSum}}€</span>
                            </div>
                        </div>

                        <div class="col-1 text-end"></div>
                    </div>

                    <div class="total d-flex">
                        <div class="col-7 total-item-text">
                            {{$user->translations['translations']['total'][Cookie::get('locale')]??""}}
                        </div>
                        <div class="col-4 total-item-price text-end">
                            <span class="total-sum" style="background-color: var(--calendar-primary-color); color: white; font-weight: 600">
                                {{$totalSum}}€
                            </span>
                        </div>
                        <div class="col-1 text-end"></div>
                    </div>
                </div>

                <div class="title-payment mb-3">
                    {{$user->translations['translations']['reglement'][Cookie::get('locale')]??""}}
                </div>

                <form id="payment-form">
                    <div id="link-authentication-element">
                        <!-- Elements will create authentication element here -->
                    </div>
                    <div id="payment-element">
                        <!-- Elements will create form elements here -->
                    </div>
                    <button id="submit" class="d-none">Pay now</button>
                    <div id="error-message">
                        <!-- Display error message to your customers here -->
                    </div>
                </form>

                <div class="col-12 d-md-flex justify-content-md-end mt-3 mb-5">
                    <button data-type="{{ $isBrunch ? 'brunch' : 'items' }}" type="submit" class="makesPurchase submit-form btn text-end make-purchase"><i class="fa-solid fa-check"></i> {{$user->translations['translations']['payer'][Cookie::get('locale')]??""}}</button>
                </div>
            </div>
        </div>
    </div>

    @if(!$admin)
        <script src="{{asset('assets/js/stripe.js')}}"></script>
    @endif
@endsection

