<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->


    <!-- Sidebar -->
    <div class="sidebar">

        <ul class="pt-3 nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            @if(auth()->user()->role == 'admin')
            <li class="nav-item">
                <a href="{{route('admin.user.index')}}" class="nav-link">
                    <i class="nav-icon far fa-image"></i>
                    <p>
                        Users
                    </p>
                </a>
            </li>
            @endif
            @if(auth()->user()->role == 'customer')
            <li class="nav-item">
                <a href="{{route('customer.slot.index')}}" class="nav-link">
                    <i class="nav-icon far fa-image"></i>
                    <p>
                        Slot
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('customer.product.index')}}" class="nav-link">
                    <i class="nav-icon far fa-image"></i>
                    <p>
                        Product
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('customer.promocode.index')}}" class="nav-link">
                    <i class="nav-icon far fa-image"></i>
                    <p>
                        Promocode
                    </p>
                </a>
            </li>
            @endif
        </ul>



    </div>
    <!-- /.sidebar -->
</aside>
