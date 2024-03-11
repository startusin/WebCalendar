<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">

            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

        </div>
        {{--                <a class="navbar-brand" href="index.html">--}}
        {{--                    <div class="d-flex align-items-center py-3"><img class="me-2" src="assets/img/icons/spot-illustrations/falcon.png" alt="" width="40" /><span class="font-sans-serif text-primary">falcon</span>--}}
        {{--                    </div>--}}
        {{--                </a>--}}
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">

            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">

            @if (auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <!-- label-->
                        <a class="nav-link" href="{{route('admin.user.index')}}" role="button">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                                    <i class="nav-icon fa-solid fa-users"></i>
                                </span>
                                <span class="nav-link-text ps-1">Users</span>
                            </div>
                        </a>
                    </li>
            @endif

            @if (auth()->user()->role == 'customer' || auth()->user()->role == 'invited')
                @if (!in_array('slot', auth()->user()->excluded_permissions ?? []))
                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('customer.slot.view')}}" role="button">
                                <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                            <i class="nav-icon fa-solid fa-calendar-days "></i>
                                </span>
                                    <span class="nav-link-text ps-1">Slot</span>
                                </div>
                            </a>
                        </li>
                @endif

                @if (!in_array('product', auth()->user()->excluded_permissions ?? []))
                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('customer.product.index')}}" role="button">
                                <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                            <i class="nav-icon fa-brands fa-product-hunt"></i>
                                </span>
                                    <span class="nav-link-text ps-1">Product</span>
                                </div>
                            </a>
                        </li>
                @endif

                @if (!in_array('custom_prices', auth()->user()->excluded_permissions ?? []))

                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('customer.price.view')}}" role="button">
                                <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                            <i class="nav-icon fa-solid fa-dollar-sign"></i>
                                </span>
                                    <span class="nav-link-text ps-1">Custom Prices</span>
                                </div>
                            </a>
                        </li>
                @endif

                @if (!in_array('promocode', auth()->user()->excluded_permissions ?? []))

                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('customer.promocode.index')}}" role="button">
                                <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                            <i class="nav-icon fa-solid fa-money-bill"></i>
                                </span>
                                    <span class="nav-link-text ps-1">Promocode</span>
                                </div>
                            </a>
                        </li>
                @endif

                @if (!in_array('brunch', auth()->user()->excluded_permissions ?? []))

                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('customer.brunch.index')}}" role="button">
                                <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                            <i class="nav-icon fa-solid fa-coffee"></i>
                                </span>
                                    <span class="nav-link-text ps-1">Brunch</span>
                                </div>
                            </a>
                        </li>
                @endif

                @if (!in_array('history_purchases', auth()->user()->excluded_permissions ?? []))


                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('purchase.index')}}" role="button">
                                <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                                    <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
                                </span>
                                    <span class="nav-link-text ps-1">History purchases</span>
                                </div>
                            </a>
                        </li>
                @endif

                @if (auth()->user()->role !== 'invited')

                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('calendarSettings.edit')}}" role="button">
                                <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                                    <i class="nav-icon fa-solid fa-gear"></i>
                                </span>
                                    <span class="nav-link-text ps-1">Settings</span>
                                </div>
                            </a>
                        </li>


                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('customer.embedded.index')}}" role="button">
                                <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                                    <i class="nav-icon fa-solid fa-gear"></i>
                                </span>
                                    <span class="nav-link-text ps-1">Embedded Code</span>
                                </div>
                            </a>
                        </li>




                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('translations.edit')}}" role="button">
                                <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                                    <i class="nav-icon fa-solid fa-language"></i>
                                </span>
                                    <span class="nav-link-text ps-1">Translations</span>
                                </div>
                            </a>
                        </li>


                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('emails.edit')}}" role="button">
                                <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                                    <i class="nav-icon fa-solid fa-envelope"></i>
                                </span>
                                    <span class="nav-link-text ps-1">Emails</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('sms.edit')}}" role="button">
                                <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                                    <i class="nav-icon fa-solid fa-envelope"></i>
                                </span>
                                    <span class="nav-link-text ps-1">SMS</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('makeOrder')}}" role="button">
                                <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                                    <i class="nav-icon fa-solid fa-envelope"></i>
                                </span>
                                    <span class="nav-link-text ps-1">Make order</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('getFormsSettings')}}" role="button">
                                <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                                   <i class="nav-icon fa-solid fa-gear"></i>
                                </span>
                                    <span class="nav-link-text ps-1">Forms Settings</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('customer.team.index')}}" role="button">
                                <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                                  <i class="nav-icon fa-solid fa-person-booth"></i>
                                </span>
                                    <span class="nav-link-text ps-1">Team</span>
                                </div>
                            </a>
                        </li>

                @endif
            @endif
            </ul>
        </div>
    </div>
</nav>


