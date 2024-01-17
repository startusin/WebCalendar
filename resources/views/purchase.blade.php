@extends('layouts')
@section('content')
    <div class="container PurchaseContainer">
        <div class="row">
            <div class="col-6">
                <div class="sub-title-text mt-5 mb-3">
                    Indiques vos dates et holralres
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="floatingSelect">Works with selects</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Numero de voie et norm de rue</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Appartnent ou</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Code postal</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Ville</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Telephone</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Adresse de messagerie</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Mobile</label>
                    </div>
                </div>
            </div>

            <div class="col-6 ">
                <div class="sub-title-text  mt-5 mb-3">
                    Indiques vos dates et holralres
                </div>

                <div class="all-purchase mb-5">
                    <div class="products-items ">
                        <div class="accordion-item">
                            <div class="accordion-header d-block" id="flush-heading1">
                                <div class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse1" aria-expanded="false" aria-controls="flush-collapse1">
                                    <div class="product-item d-flex">
                                        <div class="col-7 product-item-text">
                                            Producct XXXXXX
                                        </div>
                                        <div class="col-2 product-item-count text-end">
                                            <span>2</span>
                                        </div>
                                        <div class="col-2 product-item-price text-end">
                                            <span>22$</span>
                                        </div>
                                        <div class="col-1 product-item-price text-end">
                                            <i class='fas fa-angle-down'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="flush-collapse1" class="accordion-collapse collapse" aria-labelledby="flush-heading1" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body col-6" style="margin-top: 5px; margin-bottom: 5px; margin-left: 14px;">
                                    <input type="email" class="form-control" id="floatingInput1" placeholder="Promocode">
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-header d-block" id="flush-heading2">
                                <div class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse2" aria-expanded="false" aria-controls="flush-collapse2">
                                    <div class="product-item d-flex">
                                        <div class="col-7 product-item-text">
                                            Producct XXXXXX
                                        </div>
                                        <div class="col-2 product-item-count text-end">
                                            <span>2</span>
                                        </div>
                                        <div class="col-2 product-item-price text-end">
                                            <span>22$</span>
                                        </div>
                                        <div class="col-1 product-item-price text-end">
                                            <i class='fas fa-angle-down'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="flush-collapse2" class="accordion-collapse collapse" aria-labelledby="flush-heading2" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body col-6" style="margin-left: 14px;">
                                    <input type="email" class="form-control" id="floatingInput1" placeholder="Promocode">
                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <div class="accordion-header d-block" id="flush-heading3">
                                <div class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse3" aria-expanded="false" aria-controls="flush-collapse3">
                                    <div class="product-item d-flex">
                                        <div class="col-7 product-item-text">
                                            Producct XXXXXX
                                        </div>
                                        <div class="col-2 product-item-count text-end">
                                            <span>2</span>
                                        </div>
                                        <div class="col-2 product-item-price text-end">
                                            <span>22$</span>
                                        </div>
                                        <div class="col-1 product-item-price text-end">
                                            <i class='fas fa-angle-down'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="flush-collapse3" class="accordion-collapse collapse" aria-labelledby="flush-heading3" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body col-6" style="margin-left: 14px;">
                                    <input type="email" class="form-control" id="floatingInput1" placeholder="Promocode">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="sous-total d-flex">
                        <div class="col-7 sous-total-item-text">
                            Sous total
                        </div>
                        <div class="col-2 product-item-count text-end">
                            <span>
                                 2
                             </span>
                        </div>
                        <div class="col-2 total-item-price text-end">
                            <span>
                            72$
                            </span>
                        </div>
                    </div>
                    <div class="total d-flex">
                        <div class="col-7 total-item-text">
                            Total
                        </div>
                        <div class="col-2 total-item-count text-end">

                        </div>
                        <div class="col-2 total-item-price text-end">
                            <span>
                            72$
                            </span>
                        </div>
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
                            Card
                        </div>
                        </div>
                    </div>


                    <div class="col-3 card-item d-flex align-items-center" data-id="2">
                        <div class="d-flex flex-column" style="padding-left: 10px;">
                            <div class="imgF">
                                <i class="fa-solid fa-credit-card" aria-hidden="true"></i>
                            </div>
                            <div class="card-text">
                                Card
                            </div>
                        </div>
                    </div>


                    <div class="col-3 card-item d-flex align-items-center" data-id="3">
                        <div class="d-flex flex-column" style="padding-left: 10px;">
                            <div class="imgF">
                                <i class="fa-solid fa-credit-card" aria-hidden="true"></i>
                            </div>
                            <div class="card-text">
                                Card
                            </div>
                        </div>
                    </div>


                    <div class="col-3 card-item d-flex align-items-center" data-id="4">
                        <div class="d-flex flex-column" style="padding-left: 10px;">
                            <div class="imgF">
                                <i class="fa-solid fa-credit-card" aria-hidden="true"></i>
                            </div>
                            <div class="card-text">
                                Card
                            </div>
                        </div>
                    </div>
                </div>

                <div class="generate-payments">

                </div>

                <div class="col-12 d-md-flex justify-content-md-end mt-5">
                    <button type="button" class="btn btn-warning text-end"><i class="fa-solid fa-check"></i> Payer</button>
                </div>
            </div>
        </div>

    </div>
@endsection
