<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: white;">
    <!-- Brand Logo -->


    <!-- Sidebar -->
    <div class="sidebar">

        <ul class="pt-3 nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            @if (auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a href="{{route('admin.user.index')}}" class="nav-link">
                        <i class="nav-icon fa-solid fa-users text-dark"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
            @endif

            @if (auth()->user()->role == 'customer')
                <li class="nav-item">
                    <a href="{{route('customer.slot.view')}}" class="nav-link">
                        <i class="nav-icon fa-solid fa-calendar-days text-dark"></i>
                        <p class="text-dark">
                            Slot
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{route('customer.product.index')}}" class="nav-link">
                        <i class="nav-icon fa-brands fa-product-hunt text-dark"></i>
                        <p class="text-dark">
                            Product
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('customer.price.view')}}" class="nav-link">
                        <i class="nav-icon fa-solid fa-dollar-sign text-dark"></i>
                        <p class="text-dark">
                            Custom Prices
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('customer.promocode.index')}}" class="nav-link">
                        <i class="nav-icon fa-solid fa-money-bill text-dark"></i>
                        <p class="text-dark">
                            Promocode
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('customer.brunch.index')}}" class="nav-link">
                        <i class="nav-icon fa-solid fa-coffee text-dark"></i>
                        <p class="text-dark">
                            Brunch
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('calendarSettings.edit')}}" class="nav-link">
                        <i class="nav-icon fa-solid fa-gear text-dark"></i>
                        <p class="text-dark">
                            Settings
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('customer.embedded.index')}}" class="nav-link">
                        <i class="nav-icon fa-solid fa-gear text-dark"></i>
                        <p class="text-dark">
                            Embedded Code
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('purchase.index')}}" class="nav-link">
                        <i class="nav-icon fa-solid fa-clock-rotate-left text-dark"></i>
                        <p class="text-dark">
                            History purchases
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('translations.edit')}}" class="nav-link">
                        <i class="nav-icon fa-solid fa-language text-dark"></i>
                        <p class="text-dark">
                            Translations
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('emails.edit')}}" class="nav-link">
                        <i class="nav-icon fa-solid fa-envelope text-dark"></i>
                        <p class="text-dark">
                            Emails
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('sms.edit')}}" class="nav-link">
                        <i class="nav-icon fa-solid fa-envelope text-dark"></i>
                        <p class="text-dark">
                            SMS
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{route('makeOrder')}}" class="nav-link">
                        <i class="nav-icon fa-solid fa-envelope text-dark"></i>
                        <p class="text-dark">
                            Make order
                        </p>
                    </a>
                </li>
            @endif
        </ul>



    </div>
    <!-- /.sidebar -->
</aside>
