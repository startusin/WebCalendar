<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <script>
        let navbarStyle = localStorage.getItem("navbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">

            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                    data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span
                        class="toggle-line"></span></span></button>

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
                    @if (!in_array('slot', auth()->user()->excluded_permissions ?? []))

                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator collapsed" href="#Slot" data-bs-toggle="collapse"
                           aria-expanded="false" aria-controls="dashboard">
                            <div class="d-flex align-items-center">
                             <span class="nav-link-icon">
                                    <i class="nav-icon fa-solid fa-calendar-days"></i>
                             </span>
                                <span class="nav-link-text ps-1">Slot</span>
                            </div>
                        </a>
                        <ul class="nav collapse" id="Slot" style="">

                                <li class="nav-item">
                                    <!-- label-->
                                    <a class="nav-link custom-link" id="subSlot" href="{{route('customer.slot.view')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text ps-1">Slot</span>
                                        </div>
                                    </a>
                                </li>


                        </ul>
                    </li>
                    @endif

                    @if (!in_array('product', auth()->user()->excluded_permissions ?? []))

                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator collapsed" href="#Product" data-bs-toggle="collapse"
                           aria-expanded="false" aria-controls="dashboard">
                            <div class="d-flex align-items-center">
                             <span class="nav-link-icon">
                                    <i class="nav-icon fa-brands fa-product-hunt"></i>
                             </span>
                                <span class="nav-link-text ps-1">Product</span>
                            </div>
                        </a>
                        <ul class="nav collapse" id="Product" style="">

                                <li class="nav-item">
                                    <!-- label-->
                                    <a class="nav-link custom-link" id="subProduct"
                                       href="{{route('customer.product.index')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text ps-1">Product</span>
                                        </div>
                                    </a>
                                </li>

                        </ul>
                    </li>
                    @endif


                    @if (!in_array('brunch', auth()->user()->excluded_permissions ?? []))

                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator collapsed" href="#Brunch" data-bs-toggle="collapse"
                           aria-expanded="false" aria-controls="dashboard">
                            <div class="d-flex align-items-center">
                             <span class="nav-link-icon">
                                    <i class="nav-icon fa-solid fa-coffee"></i>
                             </span>
                                <span class="nav-link-text ps-1">Brunch</span>
                            </div>
                        </a>
                        <ul class="nav collapse" id="Brunch" style="">
                                <li class="nav-item">
                                    <!-- label-->
                                    <a class="nav-link custom-link" id="subBrunch"
                                       href="{{route('customer.brunch.index')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text ps-1">Brunch</span>
                                        </div>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    @endif


                    @if (!in_array('sales', auth()->user()->excluded_permissions ?? []))
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator collapsed" href="#Sales" data-bs-toggle="collapse"
                           aria-expanded="false" aria-controls="dashboard">
                            <div class="d-flex align-items-center">
                             <span class="nav-link-icon">
                                   <i class="fa-solid fa-money-bill"></i>
                             </span>
                                <span class="nav-link-text ps-1">Sales</span>
                            </div>
                        </a>
                        <ul class="nav collapse" id="Sales" style="">
                            <li class="nav-item">
                                <!-- label-->
                                <a class="nav-link custom-link" id="subNewPurchase" href="{{route('makeOrder')}}">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-text ps-1">New purchase</span>
                                    </div>
                                </a>
                            </li>

                            <li class="nav-item">
                                <!-- label-->
                                <a class="nav-link custom-link" id="subPurchases" href="{{route('purchase.index')}}">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-text ps-1">Purchases</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if (!in_array('marketing', auth()->user()->excluded_permissions ?? []))
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator collapsed" href="#Marketing" data-bs-toggle="collapse"
                           aria-expanded="false" aria-controls="dashboard">
                            <div class="d-flex align-items-center">
                             <span class="nav-link-icon">
                                   <i class="fa-solid fa-receipt"></i>
                             </span>
                                <span class="nav-link-text ps-1">Marketing</span>
                            </div>
                        </a>
                        <ul class="nav collapse" id="Marketing" style="">
                                <li class="nav-item">
                                    <!-- label-->
                                    <a class="nav-link custom-link" id="subPromocode"
                                       href="{{route('customer.promocode.index')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text ps-1">Promocode</span>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <!-- label-->
                                    <a class="nav-link custom-link" id="subCustomPrices"
                                       href="{{route('customer.price.view')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text ps-1">Custom Prices</span>
                                        </div>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    @endif


                    @if (auth()->user()->role !== 'invited')
                        <li class="nav-item">
                            <a class="nav-link dropdown-indicator collapsed" href="#Setup" data-bs-toggle="collapse"
                               aria-expanded="false" aria-controls="dashboard">
                                <div class="d-flex align-items-center">
                             <span class="nav-link-icon">
                                    <i class="nav-icon fa-solid fa-gear"></i>
                             </span>
                                    <span class="nav-link-text ps-1">Setup</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="Setup" style="">


                                <li class="nav-item">
                                    <!-- label-->
                                    <a class="nav-link custom-link" id="subEmbededCode"
                                       href="{{route('customer.embedded.index')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text ps-1">Embedded Code</span>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <!-- label-->
                                    <a class="nav-link custom-link" id="subSettings"
                                       href="{{route('calendarSettings.edit')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text ps-1">Settings</span>
                                        </div>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <!-- label-->
                                    <a class="nav-link custom-link" id="subTranslations"
                                       href="{{route('translations.edit')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text ps-1">Translations</span>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <!-- label-->
                                    <a class="nav-link custom-link" id="subFormSettings"
                                       href="{{route('getFormsSettings')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text ps-1">Form settings</span>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <!-- label-->
                                    <a class="nav-link custom-link" id="subCountries"
                                       href="{{route('customer.calendarCountry.index')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text ps-1">Countries</span>
                                        </div>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <!-- label-->
                                    <a class="nav-link custom-link" id="subTeam"
                                       href="{{route('customer.team.index')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text ps-1">Team</span>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <!-- label-->
                                    <a class="nav-link custom-link" id="subStyles" href="{{route('styles.index')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text ps-1">Style and Scripts</span>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <!-- label-->
                                    <a class="nav-link custom-link" id="subPrivacy" href="{{route('privacy.index')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text ps-1">Privacy Policy Settings</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (!in_array('automation', auth()->user()->excluded_permissions ?? []))
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator collapsed" href="#Automation" data-bs-toggle="collapse"
                           aria-expanded="false" aria-controls="dashboard">
                            <div class="d-flex align-items-center">
                             <span class="nav-link-icon">
                                    <i class="fa-solid fa-comments"></i>
                             </span>
                                <span class="nav-link-text ps-1">Automation</span>
                            </div>
                        </a>
                        <ul class="nav collapse" id="Automation" style="">

                            <li class="nav-item">
                                <!-- label-->
                                <a class="nav-link custom-link" id="subEmails" href="{{route('emails.edit')}}">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-text ps-1">Emails</span>
                                    </div>
                                </a>
                            </li>

                            <li class="nav-item">
                                <!-- label-->
                                <a class="nav-link custom-link" id="subSMS" href="{{route('sms.edit')}}">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-text ps-1">SMS</span>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </li>

                    @endif
                @endif
            </ul>


            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">

                @if (auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <!-- label-->
                        <a class="nav-link" href="{{route('admin.user.index')}}">
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
                        <a class="nav-link" href="{{route('admin.country.index')}}">
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

@push('js')
    <script>
        $(document).ready(function () {
            $(".custom-link").removeClass("active");

            function getCookie(name) {
                let nameEQ = name + "=";
                let cookies = document.cookie.split(';');
                for (let i = 0; i < cookies.length; i++) {
                    let cookie = cookies[i];
                    while (cookie.charAt(0) === ' ') {
                        cookie = cookie.substring(1, cookie.length);
                    }
                    if (cookie.indexOf(nameEQ) === 0) {
                        return decodeURIComponent(cookie.substring(nameEQ.length, cookie.length));
                    }
                }
                return null;
            }

            let lastSubSettingClickedId = getCookie("lastSubSettingClickedId");
            let lastSettingClickedId = getCookie("lastSettingClickedId");
            console.log('lastSettingClickedId');
            console.log(lastSettingClickedId);
            $('#' + lastSubSettingClickedId).addClass('active');
            $('#' + lastSettingClickedId).addClass('show');

            $(".custom-link").click(function () {
                let subSettings = $(this).attr('id');
                $(this).addClass('active');
                document.cookie = "lastSubSettingClickedId=" + String(subSettings) + "; expires=" + 3600 + "; path=/";

                let settings = $(this).closest("ul").attr('id');
                document.cookie = "lastSettingClickedId=" + String(settings) + "; expires=" + 3600 + "; path=/";
            });
        });
    </script>

@endpush
