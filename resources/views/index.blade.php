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
        <div id="hjsCalendar"></div>

        <div class="d-flex  sub-title mt-3 mb-2">
            <div class="IdCounter">
               2
            </div>
            <div class="sub-title-text">
                Indiques vos dates et holralres
            </div>
        </div>

        <div class="products d-flex flex-wrap justify-content-center mt-3">
            <div class="product col-12 pt-2 pb-2 mt-1 mb-1">
                <div class="up-card d-flex mb-3">
                    <div class="product-title col-6">Product XXXX</div>
                    <div class="product-price d-flex justify-content-end col-3">33$</div>
                    <div class="product-navigation col-3 d-flex justify-content-center">
                        <div class="left-icon white-circle">
                            <button>
                            <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <div class="count-of-product white-circle">
                            33
                        </div>
                        <div class="right-icon white-circle">
                            <button>
                            <i class="fa-solid fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="down-card">
                    <div class="product-description">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    </div>
                </div>
            </div>
            <div class="product col-12 pt-2 pb-2 mt-1 mb-1">
                <div class="up-card d-flex mb-3">
                    <div class="product-title col-6">Product XXXX</div>
                    <div class="product-price d-flex justify-content-end col-3">33$</div>
                    <div class="product-navigation col-3 d-flex justify-content-center">
                        <div class="left-icon white-circle">
                            <button>
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <div class="count-of-product white-circle">
                            33
                        </div>
                        <div class="right-icon white-circle">
                            <button>
                                <i class="fa-solid fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="down-card">
                    <div class="product-description">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    </div>
                </div>
            </div>

            <div class="product col-12 pt-2 pb-2 mt-1 mb-1">
                <div class="up-card d-flex mb-3">
                    <div class="product-title col-6">Product XXXX</div>
                    <div class="product-price d-flex justify-content-end col-3">33$</div>
                    <div class="product-navigation col-3 d-flex justify-content-center">
                        <div class="left-icon white-circle">
                            <button>
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <div class="count-of-product white-circle">
                            33
                        </div>
                        <div class="right-icon white-circle">
                            <button>
                                <i class="fa-solid fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="down-card">
                    <div class="product-description">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
