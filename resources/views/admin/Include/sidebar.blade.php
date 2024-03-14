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
        <a class="navbar-brand">
            <div class="d-flex align-items-center py-3">
                <span class="font-sans-serif text-primary">Margot</span>
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">


            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">

                @if (auth()->user()->role == 'customer' || auth()->user()->role == 'invited')
                <li class="nav-item">
                    <a class="nav-link dropdown-indicator collapsed" href="#products" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="dashboard">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-chart-pie fa-w-17" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-pie" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 544 512" data-fa-i2svg=""><path fill="currentColor" d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z"></path></svg><!-- <span class="fas fa-chart-pie"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Products</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="products" style="">

                        @if (!in_array('slot', auth()->user()->excluded_permissions ?? []))
                            <li class="nav-item">
                                <!-- label-->
                                <a class="nav-link" href="{{route('customer.slot.view')}}" role="button">
                                    <div class="d-flex align-items-center">
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
                                            <span class="nav-link-text ps-1">History purchases</span>
                                        </div>
                                    </a>
                                </li>
                            @endif
                    </ul>
                </li>




                <li class="nav-item">
                    <a class="nav-link dropdown-indicator collapsed" href="#settings" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="dashboard">
                        <div class="d-flex align-items-center">
                             <span class="nav-link-icon">
                                    <i class="nav-icon fa-solid fa-gear"></i>
                             </span>
                            <span class="nav-link-text ps-1">Settings</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="settings" style="">

                        @if (auth()->user()->role !== 'invited')
                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('calendarSettings.edit')}}" role="button">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Settings</span>
                                </div>
                            </a>
                        </li>

                            <li class="nav-item">
                                <!-- label-->
                                <a class="nav-link" href="{{route('customer.calendarCountry.index')}}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-text ps-1">Countries</span>
                                    </div>
                                </a>
                            </li>


                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('customer.embedded.index')}}" role="button">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Embedded Code</span>
                                </div>
                            </a>
                        </li>




                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('translations.edit')}}" role="button">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Translations</span>
                                </div>
                            </a>
                        </li>




                            <li class="nav-item">
                                <!-- label-->
                                <a class="nav-link" href="{{route('getFormsSettings')}}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-text ps-1">Forms Settings</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <!-- label-->
                                <a class="nav-link" href="{{route('privacy.index')}}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-text ps-1">Privacy Policy Settings</span>
                                    </div>
                                </a>
                            </li>


                            <li class="nav-item">
                                <!-- label-->
                                <a class="nav-link" href="{{route('styles.index')}}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-text ps-1">Style and Scripts</span>
                                    </div>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link dropdown-indicator collapsed" href="#notifications" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="dashboard">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                    <i class="nav-icon fa-solid fa-envelope"></i>
                            </span>
                            <span class="nav-link-text ps-1">Notifications</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="notifications" style="">
                        @if (auth()->user()->role !== 'invited')
                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('emails.edit')}}" role="button">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Emails</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('sms.edit')}}" role="button">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">SMS</span>
                                </div>
                            </a>
                        </li>

                        @endif
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link dropdown-indicator collapsed" href="#management" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="dashboard">
                        <div class="d-flex align-items-center">

                            <span class="nav-link-icon">
                                  <i class="nav-icon fa-solid fa-person-booth"></i>
                                </span>
                            <span class="nav-link-text ps-1">Management</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="management" style="">
                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('makeOrder')}}" role="button">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Make order</span>
                                </div>
                            </a>
                        </li>


                        <li class="nav-item">
                            <!-- label-->
                            <a class="nav-link" href="{{route('customer.team.index')}}" role="button">
                                <div class="d-flex align-items-center">

                                    <span class="nav-link-text ps-1">Team</span>
                                </div>
                            </a>
                        </li>


                    </ul>
                </li>
                @endif
            </ul>





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


                    <li class="nav-item">
                        <!-- label-->
                        <a class="nav-link" href="{{route('admin.country.index')}}" role="button">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                                    <i class="nav-icon fa-solid fa-users"></i>
                                </span>
                                <span class="nav-link-text ps-1">Countries</span>
                            </div>
                        </a>
                    </li>
            @endif





            </ul>
        </div>
    </div>
</nav>


