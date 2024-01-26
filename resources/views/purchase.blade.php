@extends('layouts')
@section('content')
    <div class="container PurchaseContainer">
        <form method="POST" id="form-data" >
            @csrf
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <div class="row">

                <input type="hidden" name="slots" id="slots" value="{{ json_encode($slots) }}">


            <input name="calendar_id" id="calendar_id" value="{{$calendarId}}" hidden>
            <div class="col-6 form-inner">
                <div class="sub-title mt-5 mb-4">
                    Indiques vos dates et holralres
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" required class="form-control" id="First_NameInput" name="First_NameInput" placeholder="name@example.com">
                            <label for="floatingInput">Prenom</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" required class="form-control" id="Last_NameInput" name="Last_NameInput" placeholder="name@example.com">
                            <label for="floatingInput">Perrier</label>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="text" required class="form-control" id="CompanyInput" name="CompanyInput" placeholder="name@example.com">
                        <label for="floatingInput">Nam de l'enterprise</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <select class="form-select"  id="RegionSelect"  name="RegionSelect" aria-label="Floating label select example">
                            <option value="1" selected>France</option>
                            <option value="2">England</option>
                        </select>
                        <label for="floatingSelect">Works with selects</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="text"required class="form-control" id="StreetInput" name="StreetInput" placeholder="name@example.com">
                        <label for="floatingInput">Numero de voie et norm de rue</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="text"required class="form-control" id="PlaceInput" name="PlaceInput" placeholder="name@example.com">
                        <label for="floatingInput">Appartnent ou</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="text"required class="form-control" id="PostalCode"  name="PostalCode" placeholder="name@example.com">
                        <label for="floatingInput">Code postal</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name=floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Ville</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="text"required class="form-control" id="PhoneInput" name="PhoneInput" placeholder="name@example.com">
                        <label for="floatingInput">Telephone</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="email"required class="form-control" id="EmailInput"  name="EmailInput" placeholder="name@example.com">
                        <label for="floatingInput">Adresse de messagerie</label>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="sub-title mt-5 mb-4">
                    Indiques vos dates et holralres
                </div>

                <div class="all-purchase mb-5">
                    <div class="products-items ">

                    @if(!$isBrunch)
                        @foreach($products as $product)
                            <div class="accordion-item">
                                <div class="accordion-header d-block" id="flush-heading{{$product->id}}">
                                    <div class="collapsed prod-info" data-product-price-id ="{{$product->product_price_id}}" data-price="{{$product->price}}" data-id = "{{$product->id}}" data-quantity = {{$product->quantity}}  type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$product->id}}" aria-expanded="false" aria-controls="flush-collapse{{$product->id}}">
                                        <div class="product-item d-flex">
                                            <div class="col-7 product-item-text">
                                                {{$product->title}}
                                            </div>
                                            <div class="col-4 text-end">
                                                <div class="product-item-count d-inline-block">
                                                    <span>{{$product->quantity}}</span>
                                                </div>

                                                <div class="product-item-price d-inline-block">
                                                    <span>{{$product->quantity * $product->price}}$</span>
                                                </div>
                                            </div>

                                            <div class="col-1 product-item-mo text-end">
                                                <i class='fas fa-angle-down'></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="flush-collapse{{$product->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$product->id}}" data-bs-parent="#accordionFlushExample">
                                    <div class="row d-flex promo-inner">
                                        <div class="accordion-body col-8 my-2">
                                            <input type="text" class="form-control promocode-input" data-product-id="{{$product->id}}" placeholder="Promocode">
                                        </div>
                                        <div class="col-4 d-flex align-items-center promocode-apply text-center justify-content-center">
                                            <button style="background-color: #CCA646; color: white; font-weight: 600">
                                                Apply
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
                                            Brunch
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="product-item-count d-inline-block">
                                                <span>{{ $totalQuantity }}</span>
                                            </div>

                                            <div class="product-item-price d-inline-block">
                                                <span>{{ $brunchPrice }}$</span>
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
                            Sous total
                        </div>
                        <div class="col-4 text-end">
                            <div class="product-item-count d-inline-block">
                                <span>{{$totalQuantity}}</span>
                            </div>

                            <div class="product-item-price d-inline-block">
                                <span style="background-color: #CCA646; color: white; font-weight: 600">{{$totalSum}}$</span>
                            </div>
                        </div>

                        <div class="col-1 text-end"></div>
                    </div>
                    <div class="total d-flex">
                        <div class="col-7 total-item-text">
                            Total
                        </div>
                        <div class="col-4 total-item-price text-end">
                            <span class="total-sum" style="background-color: #CCA646; color: white; font-weight: 600">
                                {{$totalSum}}$
                            </span>
                        </div>
                        <div class="col-1 text-end"></div>
                    </div>
                </div>

                <div class="title-payment mb-3">
                    Reglement
                </div>

                <div class="card-items d-flex gx-2">
                    <div class="col-3 card-item d-flex align-items-center" data-id="1">
                        <div class="d-flex flex-column" style="padding-left: 10px;">
                            <div class="imgF">
                                <i class="fa-solid fa-credit-card" aria-hidden="true"></i>
                            </div>
                            <div class="card-text">
                                Stripe
                            </div>
                        </div>
                    </div>
                </div>

                <div class="generate-payments">

                </div>

                <div class="col-12 d-md-flex justify-content-md-end mt-5">
                    <button data-type="{{ $isBrunch ? 'brunch' : 'items' }}" type="submit" class="makesPurchase submit-form btn btn-warning text-end"><i class="fa-solid fa-check"></i> Payer</button>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection

