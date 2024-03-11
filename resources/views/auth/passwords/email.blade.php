@extends('layouts.app')

@section('content')
    <div class="row min-vh-100 flex-center g-0">
        <div class="col-lg-8 col-xxl-5 py-3 position-relative"><img class="bg-auth-circle-shape" src="../../../assets/img/icons/spot-illustrations/bg-shape.png" alt="" width="250"><img class="bg-auth-circle-shape-2" src="../../../assets/img/icons/spot-illustrations/shape-1.png" alt="" width="150">
            <div class="card overflow-hidden z-1">
                <div class="card-body p-0">
                    <div class="row g-0 h-100">
                        <div class="col-md-5 text-center" style="background-color: #e3e4ff">
                            <div class="position-relative p-4 pt-md-5 pb-md-7" data-bs-theme="light">
                                <div class="bg-holder bg-auth-card-shape"
                                     style="background-image:url({{asset('images/half-circle.png')}});">
                                </div>
                                <!--/.bg-holder-->

                                <div class="z-1 position-relative"><a
                                        class="ColorTextForLogin mb-2 font-sans-serif fs-5 d-inline-block fw-bolder"
                                        href="../../../index.html"><img src="{{asset('images/logo.png')}}" style="max-width: 100px; max-height: 100px"></a>
                                    <p class="opacity-75 ColorTextForLogin">Le seul outil de réservation destinée aux Châteaux, Vignobles & Brasseurs.
                                        Visite. Dégustation. Brunch. Musée. Événements & plus.</p>
                                </div>
                            </div>
                            <div class="mt-3 mb-4 mt-md-4 mb-md-5" data-bs-theme="light">
                                <p class="ColorTextForLogin">Vous n’avez pas de compte ?<br><a
                                        class="text-decoration-underline ColorTextForLogin"
                                        href="https://www.bookwithmargot.com/creer-un-compte" style="color: #29074B">C’est parti</a></p>
                                <p class="mb-0 mt-4 mt-md-5 px-4 fs-10 fw-semi-bold ColorTextForLogin opacity-75"> Lire nos mentions <a
                                        class="text-decoration-underline ColorTextForLogin" href="https://www.bookwithmargot.com/mentions-legales"  style="color: #29074B">legales</a> et nos <a
                                        class="text-decoration-underline ColorTextForLogin" href="https://www.bookwithmargot.com/conditions-generales-de-vente"  style="color: #29074B">conditions générales de vente </a></p>
                            </div>
                        </div>

                        <div class="col-md-7 d-flex flex-center">
                            <div class="p-4 p-md-5 flex-grow-1">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <h3>Reset password</h3>
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="card-email">Email</label>

                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">{{ __('Send Password Reset Link') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
