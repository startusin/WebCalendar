<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{asset('assets/js/config.js')}}"></script>
    <script src="{{asset('assets/vendors/simplebar/simplebar.min.js')}}"></script>

    <style class="anchorjs"></style>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link href="{{asset('assets/vendors/simplebar/simplebar.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/theme-rtl.css')}}" rel="stylesheet" id="style-rtl" disabled="true">
    <link href="{{asset('assets/css/theme.css')}}" rel="stylesheet" id="style-default">
    <link href="{{asset('assets/css/user-rtl.css')}}" rel="stylesheet" id="user-style-rtl" disabled="true">
    <link href="{{asset('assets/css/user.css')}}" rel="stylesheet" id="user-style-default">
    <link href="{{asset('assets/vendors/choices/choices.min.css')}}" rel="stylesheet" />

</head>
<body>
<main class="main" id="top">
    <div class="container" data-layout="container">
        <script>
            var isFluid = JSON.parse(localStorage.getItem('isFluid'));
            if (isFluid) {
                var container = document.querySelector('[data-layout]');
                container.classList.remove('container');
                container.classList.add('container-fluid');
            }
        </script>
        <nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
            <script>
                var navbarStyle = localStorage.getItem("navbarStyle");
                if (navbarStyle && navbarStyle !== 'transparent') {
                    document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
                }
            </script>
            <div class="d-flex align-items-center">
                <div class="toggle-icon-wrapper">

                    <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Toggle Navigation" data-bs-original-title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

                </div><a class="navbar-brand" href="../index.html">
                    <div class="d-flex align-items-center py-3"><img class="me-2" src="../assets/img/icons/spot-illustrations/falcon.png" alt="" width="40"><span class="font-sans-serif text-primary">falcon</span>
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
                <div class="navbar-vertical-content scrollbar">
                    <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                        <li class="nav-item">
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#dashboard" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="dashboard">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-chart-pie fa-w-17" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-pie" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 544 512" data-fa-i2svg=""><path fill="currentColor" d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z"></path></svg><!-- <span class="fas fa-chart-pie"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Dashboard</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="dashboard">
                                <li class="nav-item"><a class="nav-link" href="../index.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Default</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../dashboard/analytics.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Analytics</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../dashboard/crm.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">CRM</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../dashboard/e-commerce.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">E commerce</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../dashboard/lms.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">LMS</span><span class="badge rounded-pill ms-2 badge-subtle-success">New</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../dashboard/project-management.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Management</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../dashboard/saas.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">SaaS</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../dashboard/support-desk.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Support desk</span><span class="badge rounded-pill ms-2 badge-subtle-success">New</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <!-- label-->
                            <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                                <div class="col-auto navbar-vertical-label">App
                                </div>
                                <div class="col ps-0">
                                    <hr class="mb-0 navbar-vertical-divider">
                                </div>
                            </div>
                            <!-- parent pages--><a class="nav-link" href="../app/calendar.html" role="button">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-calendar-alt fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calendar-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm320-196c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM192 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM64 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path></svg><!-- <span class="fas fa-calendar-alt"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Calendar</span>
                                </div>
                            </a>
                            <!-- parent pages--><a class="nav-link" href="../app/chat.html" role="button">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-comments fa-w-18" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="comments" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M416 192c0-88.4-93.1-160-208-160S0 103.6 0 192c0 34.3 14.1 65.9 38 92-13.4 30.2-35.5 54.2-35.8 54.5-2.2 2.3-2.8 5.7-1.5 8.7S4.8 352 8 352c36.6 0 66.9-12.3 88.7-25 32.2 15.7 70.3 25 111.3 25 114.9 0 208-71.6 208-160zm122 220c23.9-26 38-57.7 38-92 0-66.9-53.5-124.2-129.3-148.1.9 6.6 1.3 13.3 1.3 20.1 0 105.9-107.7 192-240 192-10.8 0-21.3-.8-31.7-1.9C207.8 439.6 281.8 480 368 480c41 0 79.1-9.2 111.3-25 21.8 12.7 52.1 25 88.7 25 3.2 0 6.1-1.9 7.3-4.8 1.3-2.9.7-6.3-1.5-8.7-.3-.3-22.4-24.2-35.8-54.5z"></path></svg><!-- <span class="fas fa-comments"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Chat</span>
                                </div>
                            </a>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#email" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="email">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-envelope-open fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope-open" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M512 464c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V200.724a48 48 0 0 1 18.387-37.776c24.913-19.529 45.501-35.365 164.2-121.511C199.412 29.17 232.797-.347 256 .003c23.198-.354 56.596 29.172 73.413 41.433 118.687 86.137 139.303 101.995 164.2 121.512A48 48 0 0 1 512 200.724V464zm-65.666-196.605c-2.563-3.728-7.7-4.595-11.339-1.907-22.845 16.873-55.462 40.705-105.582 77.079-16.825 12.266-50.21 41.781-73.413 41.43-23.211.344-56.559-29.143-73.413-41.43-50.114-36.37-82.734-60.204-105.582-77.079-3.639-2.688-8.776-1.821-11.339 1.907l-9.072 13.196a7.998 7.998 0 0 0 1.839 10.967c22.887 16.899 55.454 40.69 105.303 76.868 20.274 14.781 56.524 47.813 92.264 47.573 35.724.242 71.961-32.771 92.263-47.573 49.85-36.179 82.418-59.97 105.303-76.868a7.998 7.998 0 0 0 1.839-10.967l-9.071-13.196z"></path></svg><!-- <span class="fas fa-envelope-open"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Email</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="email">
                                <li class="nav-item"><a class="nav-link" href="../app/email/inbox.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Inbox</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/email/email-detail.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Email detail</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/email/compose.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Compose</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#events" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="events">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-calendar-day fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calendar-day" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 7.2-16 16-16h96c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16v-96zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path></svg><!-- <span class="fas fa-calendar-day"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Events</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="events">
                                <li class="nav-item"><a class="nav-link" href="../app/events/create-an-event.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Create an event</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/events/event-detail.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Event detail</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/events/event-list.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Event list</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#e-commerce" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="e-commerce">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-shopping-cart fa-w-18" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="shopping-cart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path></svg><!-- <span class="fas fa-shopping-cart"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">E commerce</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="e-commerce">
                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#product" data-bs-toggle="collapse" aria-expanded="false" aria-controls="e-commerce">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Product</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <ul class="nav collapse" id="product">
                                        <li class="nav-item"><a class="nav-link" href="../app/e-commerce/product/product-list.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Product list</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../app/e-commerce/product/product-grid.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Product grid</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../app/e-commerce/product/product-details.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Product details</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../app/e-commerce/product/add-product.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Add product</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#orders" data-bs-toggle="collapse" aria-expanded="false" aria-controls="e-commerce">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Orders</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <ul class="nav collapse" id="orders">
                                        <li class="nav-item"><a class="nav-link" href="../app/e-commerce/orders/order-list.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Order list</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../app/e-commerce/orders/order-details.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Order details</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/e-commerce/customers.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Customers</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/e-commerce/customer-details.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Customer details</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/e-commerce/shopping-cart.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Shopping cart</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/e-commerce/checkout.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Checkout</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/e-commerce/billing.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Billing</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/e-commerce/invoice.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Invoice</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#e-learning" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="e-learning">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-graduation-cap fa-w-20" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="graduation-cap" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M622.34 153.2L343.4 67.5c-15.2-4.67-31.6-4.67-46.79 0L17.66 153.2c-23.54 7.23-23.54 38.36 0 45.59l48.63 14.94c-10.67 13.19-17.23 29.28-17.88 46.9C38.78 266.15 32 276.11 32 288c0 10.78 5.68 19.85 13.86 25.65L20.33 428.53C18.11 438.52 25.71 448 35.94 448h56.11c10.24 0 17.84-9.48 15.62-19.47L82.14 313.65C90.32 307.85 96 298.78 96 288c0-11.57-6.47-21.25-15.66-26.87.76-15.02 8.44-28.3 20.69-36.72L296.6 284.5c9.06 2.78 26.44 6.25 46.79 0l278.95-85.7c23.55-7.24 23.55-38.36 0-45.6zM352.79 315.09c-28.53 8.76-52.84 3.92-65.59 0l-145.02-44.55L128 384c0 35.35 85.96 64 192 64s192-28.65 192-64l-14.18-113.47-145.03 44.56z"></path></svg><!-- <span class="fas fa-graduation-cap"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">E learning</span><span class="badge rounded-pill ms-2 badge-subtle-success">New</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="e-learning">
                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#course" data-bs-toggle="collapse" aria-expanded="false" aria-controls="e-learning">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Course</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <ul class="nav collapse" id="course">
                                        <li class="nav-item"><a class="nav-link" href="../app/e-learning/course/course-list.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Course list</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../app/e-learning/course/course-grid.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Course grid</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../app/e-learning/course/course-details.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Course details</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../app/e-learning/course/create-a-course.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Create a course</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/e-learning/student-overview.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Student overview</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/e-learning/trainer-profile.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Trainer profile</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link" href="../app/kanban.html" role="button">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-trello fa-w-14" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="trello" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M392.3 32H56.1C25.1 32 0 57.1 0 88c-.1 0 0-4 0 336 0 30.9 25.1 56 56 56h336.2c30.8-.2 55.7-25.2 55.7-56V88c.1-30.8-24.8-55.8-55.6-56zM197 371.3c-.2 14.7-12.1 26.6-26.9 26.6H87.4c-14.8.1-26.9-11.8-27-26.6V117.1c0-14.8 12-26.9 26.9-26.9h82.9c14.8 0 26.9 12 26.9 26.9v254.2zm193.1-112c0 14.8-12 26.9-26.9 26.9h-81c-14.8 0-26.9-12-26.9-26.9V117.2c0-14.8 12-26.9 26.8-26.9h81.1c14.8 0 26.9 12 26.9 26.9v142.1z"></path></svg><!-- <span class="fab fa-trello"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Kanban</span>
                                </div>
                            </a>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#social" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="social">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-share-alt fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="share-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M352 320c-22.608 0-43.387 7.819-59.79 20.895l-102.486-64.054a96.551 96.551 0 0 0 0-41.683l102.486-64.054C308.613 184.181 329.392 192 352 192c53.019 0 96-42.981 96-96S405.019 0 352 0s-96 42.981-96 96c0 7.158.79 14.13 2.276 20.841L155.79 180.895C139.387 167.819 118.608 160 96 160c-53.019 0-96 42.981-96 96s42.981 96 96 96c22.608 0 43.387-7.819 59.79-20.895l102.486 64.054A96.301 96.301 0 0 0 256 416c0 53.019 42.981 96 96 96s96-42.981 96-96-42.981-96-96-96z"></path></svg><!-- <span class="fas fa-share-alt"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Social</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="social">
                                <li class="nav-item"><a class="nav-link" href="../app/social/feed.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Feed</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/social/activity-log.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Activity log</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/social/notifications.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Notifications</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/social/followers.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Followers</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#support-desk" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="support-desk">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-ticket-alt fa-w-18" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ticket-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M128 160h320v192H128V160zm400 96c0 26.51 21.49 48 48 48v96c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48v-96c26.51 0 48-21.49 48-48s-21.49-48-48-48v-96c0-26.51 21.49-48 48-48h480c26.51 0 48 21.49 48 48v96c-26.51 0-48 21.49-48 48zm-48-104c0-13.255-10.745-24-24-24H120c-13.255 0-24 10.745-24 24v208c0 13.255 10.745 24 24 24h336c13.255 0 24-10.745 24-24V152z"></path></svg><!-- <span class="fas fa-ticket-alt"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Support desk</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="support-desk">
                                <li class="nav-item"><a class="nav-link" href="../app/support-desk/table-view.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Table view</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/support-desk/card-view.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Card view</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/support-desk/contacts.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Contacts</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/support-desk/contact-details.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Contact details</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/support-desk/tickets-preview.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Tickets preview</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/support-desk/quick-links.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Quick links</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../app/support-desk/reports.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Reports</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <!-- label-->
                            <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                                <div class="col-auto navbar-vertical-label">Pages
                                </div>
                                <div class="col ps-0">
                                    <hr class="mb-0 navbar-vertical-divider">
                                </div>
                            </div>
                            <!-- parent pages--><a class="nav-link" href="../pages/starter.html" role="button">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-flag fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="flag" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M349.565 98.783C295.978 98.783 251.721 64 184.348 64c-24.955 0-47.309 4.384-68.045 12.013a55.947 55.947 0 0 0 3.586-23.562C118.117 24.015 94.806 1.206 66.338.048 34.345-1.254 8 24.296 8 56c0 19.026 9.497 35.825 24 45.945V488c0 13.255 10.745 24 24 24h16c13.255 0 24-10.745 24-24v-94.4c28.311-12.064 63.582-22.122 114.435-22.122 53.588 0 97.844 34.783 165.217 34.783 48.169 0 86.667-16.294 122.505-40.858C506.84 359.452 512 349.571 512 339.045v-243.1c0-23.393-24.269-38.87-45.485-29.016-34.338 15.948-76.454 31.854-116.95 31.854z"></path></svg><!-- <span class="fas fa-flag"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Starter</span>
                                </div>
                            </a>
                            <!-- parent pages--><a class="nav-link" href="../pages/landing.html" role="button">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-globe fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="globe" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg=""><path fill="currentColor" d="M336.5 160C322 70.7 287.8 8 248 8s-74 62.7-88.5 152h177zM152 256c0 22.2 1.2 43.5 3.3 64h185.3c2.1-20.5 3.3-41.8 3.3-64s-1.2-43.5-3.3-64H155.3c-2.1 20.5-3.3 41.8-3.3 64zm324.7-96c-28.6-67.9-86.5-120.4-158-141.6 24.4 33.8 41.2 84.7 50 141.6h108zM177.2 18.4C105.8 39.6 47.8 92.1 19.3 160h108c8.7-56.9 25.5-107.8 49.9-141.6zM487.4 192H372.7c2.1 21 3.3 42.5 3.3 64s-1.2 43-3.3 64h114.6c5.5-20.5 8.6-41.8 8.6-64s-3.1-43.5-8.5-64zM120 256c0-21.5 1.2-43 3.3-64H8.6C3.2 212.5 0 233.8 0 256s3.2 43.5 8.6 64h114.6c-2-21-3.2-42.5-3.2-64zm39.5 96c14.5 89.3 48.7 152 88.5 152s74-62.7 88.5-152h-177zm159.3 141.6c71.4-21.2 129.4-73.7 158-141.6h-108c-8.8 56.9-25.6 107.8-50 141.6zM19.3 352c28.6 67.9 86.5 120.4 158 141.6-24.4-33.8-41.2-84.7-50-141.6h-108z"></path></svg><!-- <span class="fas fa-globe"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Landing</span>
                                </div>
                            </a>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#authentication" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="authentication">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-lock fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="lock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z"></path></svg><!-- <span class="fas fa-lock"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Authentication</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="authentication">
                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#simple" data-bs-toggle="collapse" aria-expanded="false" aria-controls="authentication">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Simple</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <ul class="nav collapse" id="simple">
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/simple/login.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Login</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/simple/logout.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Logout</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/simple/register.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Register</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/simple/forgot-password.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Forgot password</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/simple/confirm-mail.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Confirm mail</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/simple/reset-password.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Reset password</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/simple/lock-screen.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Lock screen</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#card" data-bs-toggle="collapse" aria-expanded="false" aria-controls="authentication">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Card</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <ul class="nav collapse" id="card">
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/card/login.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Login</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/card/logout.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Logout</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/card/register.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Register</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/card/forgot-password.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Forgot password</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/card/confirm-mail.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Confirm mail</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/card/reset-password.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Reset password</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/card/lock-screen.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Lock screen</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#split" data-bs-toggle="collapse" aria-expanded="false" aria-controls="authentication">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Split</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <ul class="nav collapse" id="split">
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/split/login.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Login</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/split/logout.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Logout</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/split/register.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Register</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/split/forgot-password.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Forgot password</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/split/confirm-mail.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Confirm mail</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/split/reset-password.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Reset password</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../pages/authentication/split/lock-screen.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Lock screen</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../pages/authentication/wizard.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Wizard</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../#authentication-modal" data-bs-toggle="modal">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Modal</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#user" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="user">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-user fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path></svg><!-- <span class="fas fa-user"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">User</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="user">
                                <li class="nav-item"><a class="nav-link" href="../pages/user/profile.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Profile</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../pages/user/settings.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Settings</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#pricing" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="pricing">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-tags fa-w-20" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="tags" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M497.941 225.941L286.059 14.059A48 48 0 0 0 252.118 0H48C21.49 0 0 21.49 0 48v204.118a48 48 0 0 0 14.059 33.941l211.882 211.882c18.744 18.745 49.136 18.746 67.882 0l204.118-204.118c18.745-18.745 18.745-49.137 0-67.882zM112 160c-26.51 0-48-21.49-48-48s21.49-48 48-48 48 21.49 48 48-21.49 48-48 48zm513.941 133.823L421.823 497.941c-18.745 18.745-49.137 18.745-67.882 0l-.36-.36L527.64 323.522c16.999-16.999 26.36-39.6 26.36-63.64s-9.362-46.641-26.36-63.64L331.397 0h48.721a48 48 0 0 1 33.941 14.059l211.882 211.882c18.745 18.745 18.745 49.137 0 67.882z"></path></svg><!-- <span class="fas fa-tags"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Pricing</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="pricing">
                                <li class="nav-item"><a class="nav-link" href="../pages/pricing/pricing-default.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Pricing default</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../pages/pricing/pricing-alt.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Pricing alt</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#faq" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="faq">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-question-circle fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="question-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zM262.655 90c-54.497 0-89.255 22.957-116.549 63.758-3.536 5.286-2.353 12.415 2.715 16.258l34.699 26.31c5.205 3.947 12.621 3.008 16.665-2.122 17.864-22.658 30.113-35.797 57.303-35.797 20.429 0 45.698 13.148 45.698 32.958 0 14.976-12.363 22.667-32.534 33.976C247.128 238.528 216 254.941 216 296v4c0 6.627 5.373 12 12 12h56c6.627 0 12-5.373 12-12v-1.333c0-28.462 83.186-29.647 83.186-106.667 0-58.002-60.165-102-116.531-102zM256 338c-25.365 0-46 20.635-46 46 0 25.364 20.635 46 46 46s46-20.636 46-46c0-25.365-20.635-46-46-46z"></path></svg><!-- <span class="fas fa-question-circle"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Faq</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="faq">
                                <li class="nav-item"><a class="nav-link" href="../pages/faq/faq-basic.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Faq basic</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../pages/faq/faq-alt.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Faq alt</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../pages/faq/faq-accordion.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Faq accordion</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#errors" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="errors">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-exclamation-triangle fa-w-18" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="exclamation-triangle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z"></path></svg><!-- <span class="fas fa-exclamation-triangle"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Errors</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="errors">
                                <li class="nav-item"><a class="nav-link" href="../pages/errors/404.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">404</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../pages/errors/500.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">500</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#miscellaneous" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="miscellaneous">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-thumbtack fa-w-12" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="thumbtack" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M298.028 214.267L285.793 96H328c13.255 0 24-10.745 24-24V24c0-13.255-10.745-24-24-24H56C42.745 0 32 10.745 32 24v48c0 13.255 10.745 24 24 24h42.207L85.972 214.267C37.465 236.82 0 277.261 0 328c0 13.255 10.745 24 24 24h136v104.007c0 1.242.289 2.467.845 3.578l24 48c2.941 5.882 11.364 5.893 14.311 0l24-48a8.008 8.008 0 0 0 .845-3.578V352h136c13.255 0 24-10.745 24-24-.001-51.183-37.983-91.42-85.973-113.733z"></path></svg><!-- <span class="fas fa-thumbtack"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Miscellaneous</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="miscellaneous">
                                <li class="nav-item"><a class="nav-link" href="../pages/miscellaneous/associations.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Associations</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../pages/miscellaneous/invite-people.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Invite people</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../pages/miscellaneous/privacy-policy.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Privacy policy</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#Layouts" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="Layouts">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-window-restore fa-w-16" aria-hidden="true" focusable="false" data-prefix="far" data-icon="window-restore" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 0H144c-26.5 0-48 21.5-48 48v48H48c-26.5 0-48 21.5-48 48v320c0 26.5 21.5 48 48 48h320c26.5 0 48-21.5 48-48v-48h48c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48zm-96 464H48V256h320v208zm96-96h-48V144c0-26.5-21.5-48-48-48H144V48h320v320z"></path></svg><!-- <span class="far fa-window-restore"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Layouts</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="Layouts">
                                <li class="nav-item"><a class="nav-link" href="../demo/navbar-vertical.html" target="_blank">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Navbar vertical</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../demo/navbar-top.html" target="_blank">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Top nav</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../demo/navbar-double-top.html" target="_blank">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Double top</span><span class="badge rounded-pill ms-2 badge-subtle-success">New</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../demo/combo-nav.html" target="_blank">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Combo nav</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <!-- label-->
                            <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                                <div class="col-auto navbar-vertical-label">Modules
                                </div>
                                <div class="col ps-0">
                                    <hr class="mb-0 navbar-vertical-divider">
                                </div>
                            </div>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#forms" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="forms">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-file-alt fa-w-12" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="file-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm64 236c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-64c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-72v8c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12zm96-114.1v6.1H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9z"></path></svg><!-- <span class="fas fa-file-alt"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Forms</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="forms">
                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#basic" data-bs-toggle="collapse" aria-expanded="false" aria-controls="forms">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Basic</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <ul class="nav collapse" id="basic">
                                        <li class="nav-item"><a class="nav-link" href="../modules/forms/basic/form-control.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Form control</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/forms/basic/input-group.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Input group</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/forms/basic/select.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Select</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/forms/basic/checks.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Checks</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/forms/basic/range.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Range</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/forms/basic/layout.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Layout</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#advance" data-bs-toggle="collapse" aria-expanded="false" aria-controls="forms">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Advance</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <ul class="nav collapse" id="advance">
                                        <li class="nav-item"><a class="nav-link" href="../modules/forms/advance/advance-select.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Advance select</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/forms/advance/date-picker.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Date picker</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/forms/advance/editor.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Editor</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/forms/advance/emoji-button.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Emoji button</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/forms/advance/file-uploader.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">File uploader</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/forms/advance/input-mask.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Input mask</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/forms/advance/range-slider.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Range slider</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/forms/advance/rating.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Rating</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/forms/floating-labels.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Floating labels</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/forms/wizard.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Wizard</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/forms/validation.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Validation</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#tables" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="tables">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-table fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM224 416H64v-96h160v96zm0-160H64v-96h160v96zm224 160H288v-96h160v96zm0-160H288v-96h160v96z"></path></svg><!-- <span class="fas fa-table"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Tables</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="tables">
                                <li class="nav-item"><a class="nav-link" href="../modules/tables/basic-tables.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Basic tables</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/tables/advance-tables.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Advance tables</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/tables/bulk-select.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Bulk select</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#charts" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="charts">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-chart-line fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-line" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M496 384H64V80c0-8.84-7.16-16-16-16H16C7.16 64 0 71.16 0 80v336c0 17.67 14.33 32 32 32h464c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16zM464 96H345.94c-21.38 0-32.09 25.85-16.97 40.97l32.4 32.4L288 242.75l-73.37-73.37c-12.5-12.5-32.76-12.5-45.25 0l-68.69 68.69c-6.25 6.25-6.25 16.38 0 22.63l22.62 22.62c6.25 6.25 16.38 6.25 22.63 0L192 237.25l73.37 73.37c12.5 12.5 32.76 12.5 45.25 0l96-96 32.4 32.4c15.12 15.12 40.97 4.41 40.97-16.97V112c.01-8.84-7.15-16-15.99-16z"></path></svg><!-- <span class="fas fa-chart-line"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Charts</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="charts">
                                <li class="nav-item"><a class="nav-link" href="../modules/charts/chartjs.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Chartjs</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/charts/d3js.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">D3js</span><span class="badge rounded-pill ms-2 badge-subtle-success">New</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#eCharts" data-bs-toggle="collapse" aria-expanded="false" aria-controls="charts">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">ECharts</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <ul class="nav collapse" id="eCharts">
                                        <li class="nav-item"><a class="nav-link" href="../modules/charts/echarts/line-charts.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Line charts</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/charts/echarts/bar-charts.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Bar charts</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/charts/echarts/candlestick-charts.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Candlestick charts</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/charts/echarts/geo-map.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Geo map</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/charts/echarts/scatter-charts.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Scatter charts</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/charts/echarts/pie-charts.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Pie charts</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/charts/echarts/gauge-charts.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Gauge charts</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/charts/echarts/radar-charts.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Radar charts</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/charts/echarts/heatmap-charts.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Heatmap charts</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/charts/echarts/how-to-use.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">How to use</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#icons" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="icons">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-shapes fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="shapes" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M128,256A128,128,0,1,0,256,384,128,128,0,0,0,128,256Zm379-54.86L400.07,18.29a37.26,37.26,0,0,0-64.14,0L229,201.14C214.76,225.52,232.58,256,261.09,256H474.91C503.42,256,521.24,225.52,507,201.14ZM480,288H320a32,32,0,0,0-32,32V480a32,32,0,0,0,32,32H480a32,32,0,0,0,32-32V320A32,32,0,0,0,480,288Z"></path></svg><!-- <span class="fas fa-shapes"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Icons</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="icons">
                                <li class="nav-item"><a class="nav-link" href="../modules/icons/font-awesome.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Font awesome</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/icons/bootstrap-icons.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Bootstrap icons</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/icons/feather.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Feather</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/icons/material-icons.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Material icons</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#maps" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="maps">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-map fa-w-18" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M0 117.66v346.32c0 11.32 11.43 19.06 21.94 14.86L160 416V32L20.12 87.95A32.006 32.006 0 0 0 0 117.66zM192 416l192 64V96L192 32v384zM554.06 33.16L416 96v384l139.88-55.95A31.996 31.996 0 0 0 576 394.34V48.02c0-11.32-11.43-19.06-21.94-14.86z"></path></svg><!-- <span class="fas fa-map"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Maps</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="maps">
                                <li class="nav-item"><a class="nav-link" href="../modules/maps/google-map.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Google map</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/maps/leaflet-map.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Leaflet map</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#components" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="components">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-puzzle-piece fa-w-18" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="puzzle-piece" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M519.442 288.651c-41.519 0-59.5 31.593-82.058 31.593C377.409 320.244 432 144 432 144s-196.288 80-196.288-3.297c0-35.827 36.288-46.25 36.288-85.985C272 19.216 243.885 0 210.539 0c-34.654 0-66.366 18.891-66.366 56.346 0 41.364 31.711 59.277 31.711 81.75C175.885 207.719 0 166.758 0 166.758v333.237s178.635 41.047 178.635-28.662c0-22.473-40-40.107-40-81.471 0-37.456 29.25-56.346 63.577-56.346 33.673 0 61.788 19.216 61.788 54.717 0 39.735-36.288 50.158-36.288 85.985 0 60.803 129.675 25.73 181.23 25.73 0 0-34.725-120.101 25.827-120.101 35.962 0 46.423 36.152 86.308 36.152C556.712 416 576 387.99 576 354.443c0-34.199-18.962-65.792-56.558-65.792z"></path></svg><!-- <span class="fas fa-puzzle-piece"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Components</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="components">
                                <li class="nav-item"><a class="nav-link" href="../modules/components/accordion.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Accordion</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/alerts.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Alerts</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/anchor.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Anchor</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/animated-icons.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Animated icons</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/background.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Background</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/badges.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Badges</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/bottom-bar.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Bottom bar</span><span class="badge rounded-pill ms-2 badge-subtle-success">New</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/breadcrumbs.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Breadcrumbs</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/buttons.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Buttons</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/calendar.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Calendar</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/cards.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Cards</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#carousel" data-bs-toggle="collapse" aria-expanded="false" aria-controls="components">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Carousel</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <ul class="nav collapse" id="carousel">
                                        <li class="nav-item"><a class="nav-link" href="../modules/components/carousel/bootstrap.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Bootstrap</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/components/carousel/swiper.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Swiper</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/collapse.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Collapse</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/cookie-notice.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Cookie notice</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/countup.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Countup</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/draggable.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Draggable</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/dropdowns.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Dropdowns</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/jquery-components.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Jquery</span><span class="badge rounded-pill ms-2 badge-subtle-success">New</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/list-group.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">List group</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/modals.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Modals</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#navs-_and_-Tabs" data-bs-toggle="collapse" aria-expanded="false" aria-controls="components">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Navs &amp; Tabs</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <ul class="nav collapse" id="navs-_and_-Tabs">
                                        <li class="nav-item"><a class="nav-link" href="../modules/components/navs-and-tabs/navs.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Navs</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/components/navs-and-tabs/navbar.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Navbar</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/components/navs-and-tabs/vertical-navbar.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Navbar vertical</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/components/navs-and-tabs/top-navbar.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Top nav</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/components/navs-and-tabs/double-top-navbar.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Double top</span><span class="badge rounded-pill ms-2 badge-subtle-success">New</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/components/navs-and-tabs/combo-navbar.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Combo nav</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/components/navs-and-tabs/tabs.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Tabs</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/offcanvas.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Offcanvas</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#pictures" data-bs-toggle="collapse" aria-expanded="false" aria-controls="components">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Pictures</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <ul class="nav collapse" id="pictures">
                                        <li class="nav-item"><a class="nav-link" href="../modules/components/pictures/avatar.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Avatar</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/components/pictures/images.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Images</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/components/pictures/figures.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Figures</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/components/pictures/hoverbox.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Hoverbox</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/components/pictures/lightbox.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Lightbox</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/progress-bar.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Progress bar</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/placeholder.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Placeholder</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/pagination.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Pagination</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/popovers.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Popovers</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/scrollspy.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Scrollspy</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/search.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Search</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/spinners.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Spinners</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/timeline.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Timeline</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/toasts.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Toasts</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/tooltips.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Tooltips</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/treeview.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Treeview</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/components/typed-text.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Typed text</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#videos" data-bs-toggle="collapse" aria-expanded="false" aria-controls="components">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Videos</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <ul class="nav collapse" id="videos">
                                        <li class="nav-item"><a class="nav-link" href="../modules/components/videos/embed.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Embed</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../modules/components/videos/plyr.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Plyr</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#utilities" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="utilities">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-fire fa-w-12" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="fire" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M216 23.86c0-23.8-30.65-32.77-44.15-13.04C48 191.85 224 200 224 288c0 35.63-29.11 64.46-64.85 63.99-35.17-.45-63.15-29.77-63.15-64.94v-85.51c0-21.7-26.47-32.23-41.43-16.5C27.8 213.16 0 261.33 0 320c0 105.87 86.13 192 192 192s192-86.13 192-192c0-170.29-168-193-168-296.14z"></path></svg><!-- <span class="fas fa-fire"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Utilities</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="utilities">
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/background.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Background</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/borders.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Borders</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/clearfix.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Clearfix</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/colors.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Colors</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/colored-links.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Colored links</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/display.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Display</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/flex.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Flex</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/float.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Float</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/focus-ring.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Focus ring</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/grid.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Grid</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/icon-link.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Icon link</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/overlayscrollbar.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Overlay scrollbar</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/position.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Position</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/ratio.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Ratio</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/spacing.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Spacing</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/sizing.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Sizing</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/stretched-link.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Stretched link</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/text-truncation.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Text truncation</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/typography.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Typography</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/vertical-align.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Vertical align</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/vertical-rule.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Vertical rule</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/visibility.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Visibility</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../modules/utilities/visually-hidden.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Visually hidden</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link" href="../widgets.html" role="button">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-poll fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="poll" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM160 368c0 8.84-7.16 16-16 16h-32c-8.84 0-16-7.16-16-16V240c0-8.84 7.16-16 16-16h32c8.84 0 16 7.16 16 16v128zm96 0c0 8.84-7.16 16-16 16h-32c-8.84 0-16-7.16-16-16V144c0-8.84 7.16-16 16-16h32c8.84 0 16 7.16 16 16v224zm96 0c0 8.84-7.16 16-16 16h-32c-8.84 0-16-7.16-16-16v-64c0-8.84 7.16-16 16-16h32c8.84 0 16 7.16 16 16v64z"></path></svg><!-- <span class="fas fa-poll"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Widgets</span>
                                </div>
                            </a>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#multi-level" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="multi-level">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-layer-group fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="layer-group" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M12.41 148.02l232.94 105.67c6.8 3.09 14.49 3.09 21.29 0l232.94-105.67c16.55-7.51 16.55-32.52 0-40.03L266.65 2.31a25.607 25.607 0 0 0-21.29 0L12.41 107.98c-16.55 7.51-16.55 32.53 0 40.04zm487.18 88.28l-58.09-26.33-161.64 73.27c-7.56 3.43-15.59 5.17-23.86 5.17s-16.29-1.74-23.86-5.17L70.51 209.97l-58.1 26.33c-16.55 7.5-16.55 32.5 0 40l232.94 105.59c6.8 3.08 14.49 3.08 21.29 0L499.59 276.3c16.55-7.5 16.55-32.5 0-40zm0 127.8l-57.87-26.23-161.86 73.37c-7.56 3.43-15.59 5.17-23.86 5.17s-16.29-1.74-23.86-5.17L70.29 337.87 12.41 364.1c-16.55 7.5-16.55 32.5 0 40l232.94 105.59c6.8 3.08 14.49 3.08 21.29 0L499.59 404.1c16.55-7.5 16.55-32.5 0-40z"></path></svg><!-- <span class="fas fa-layer-group"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Multi level</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="multi-level">
                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#level-two" data-bs-toggle="collapse" aria-expanded="false" aria-controls="multi-level">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Level two</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <ul class="nav collapse" id="level-two">
                                        <li class="nav-item"><a class="nav-link" href="../#!.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Item 1</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="../#!.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Item 2</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#level-three" data-bs-toggle="collapse" aria-expanded="false" aria-controls="multi-level">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Level three</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <ul class="nav collapse" id="level-three">
                                        <li class="nav-item"><a class="nav-link" href="../#!.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Item 3</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#item-4" data-bs-toggle="collapse" aria-expanded="false" aria-controls="level-three">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Item 4</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                            <ul class="nav collapse" id="item-4">
                                                <li class="nav-item"><a class="nav-link" href="../#!.html">
                                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Item 5</span>
                                                        </div>
                                                    </a>
                                                    <!-- more inner pages-->
                                                </li>
                                                <li class="nav-item"><a class="nav-link" href="../#!.html">
                                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Item 6</span>
                                                        </div>
                                                    </a>
                                                    <!-- more inner pages-->
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#level-four" data-bs-toggle="collapse" aria-expanded="false" aria-controls="multi-level">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Level four</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <ul class="nav collapse" id="level-four">
                                        <li class="nav-item"><a class="nav-link" href="../#!.html">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Item 6</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#item-7" data-bs-toggle="collapse" aria-expanded="false" aria-controls="level-four">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Item 7</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                            <ul class="nav collapse" id="item-7">
                                                <li class="nav-item"><a class="nav-link" href="../#!.html">
                                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Item 8</span>
                                                        </div>
                                                    </a>
                                                    <!-- more inner pages-->
                                                </li>
                                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#item-9" data-bs-toggle="collapse" aria-expanded="false" aria-controls="item-7">
                                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Item 9</span>
                                                        </div>
                                                    </a>
                                                    <!-- more inner pages-->
                                                    <ul class="nav collapse" id="item-9">
                                                        <li class="nav-item"><a class="nav-link" href="../#!.html">
                                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Item 10</span>
                                                                </div>
                                                            </a>
                                                            <!-- more inner pages-->
                                                        </li>
                                                        <li class="nav-item"><a class="nav-link" href="../#!.html">
                                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Item 11</span>
                                                                </div>
                                                            </a>
                                                            <!-- more inner pages-->
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <!-- label-->
                            <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                                <div class="col-auto navbar-vertical-label">Documentation
                                </div>
                                <div class="col ps-0">
                                    <hr class="mb-0 navbar-vertical-divider">
                                </div>
                            </div>
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#customization" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="customization">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-wrench fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="wrench" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M507.73 109.1c-2.24-9.03-13.54-12.09-20.12-5.51l-74.36 74.36-67.88-11.31-11.31-67.88 74.36-74.36c6.62-6.62 3.43-17.9-5.66-20.16-47.38-11.74-99.55.91-136.58 37.93-39.64 39.64-50.55 97.1-34.05 147.2L18.74 402.76c-24.99 24.99-24.99 65.51 0 90.5 24.99 24.99 65.51 24.99 90.5 0l213.21-213.21c50.12 16.71 107.47 5.68 147.37-34.22 37.07-37.07 49.7-89.32 37.91-136.73zM64 472c-13.25 0-24-10.75-24-24 0-13.26 10.75-24 24-24s24 10.74 24 24c0 13.25-10.75 24-24 24z"></path></svg><!-- <span class="fas fa-wrench"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Customization</span>
                                </div>
                            </a>
                            <ul class="nav collapse" id="customization">
                                <li class="nav-item"><a class="nav-link" href="../documentation/customization/configuration.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Configuration</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../documentation/customization/styling.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Styling</span><span class="badge rounded-pill ms-2 badge-subtle-success">Updated</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../documentation/customization/dark-mode.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Dark mode</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../documentation/customization/plugin.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Plugin</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                            <!-- parent pages--><a class="nav-link" href="../documentation/faq.html" role="button">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-question-circle fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="question-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zM262.655 90c-54.497 0-89.255 22.957-116.549 63.758-3.536 5.286-2.353 12.415 2.715 16.258l34.699 26.31c5.205 3.947 12.621 3.008 16.665-2.122 17.864-22.658 30.113-35.797 57.303-35.797 20.429 0 45.698 13.148 45.698 32.958 0 14.976-12.363 22.667-32.534 33.976C247.128 238.528 216 254.941 216 296v4c0 6.627 5.373 12 12 12h56c6.627 0 12-5.373 12-12v-1.333c0-28.462 83.186-29.647 83.186-106.667 0-58.002-60.165-102-116.531-102zM256 338c-25.365 0-46 20.635-46 46 0 25.364 20.635 46 46 46s46-20.636 46-46c0-25.365-20.635-46-46-46z"></path></svg><!-- <span class="fas fa-question-circle"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Faq</span>
                                </div>
                            </a>
                            <!-- parent pages--><a class="nav-link" href="../documentation/gulp.html" role="button">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-gulp fa-w-8" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="gulp" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg=""><path fill="currentColor" d="M209.8 391.1l-14.1 24.6-4.6 80.2c0 8.9-28.3 16.1-63.1 16.1s-63.1-7.2-63.1-16.1l-5.8-79.4-14.9-25.4c41.2 17.3 126 16.7 165.6 0zm-196-253.3l13.6 125.5c5.9-20 20.8-47 40-55.2 6.3-2.7 12.7-2.7 18.7.9 5.2 3 9.6 9.3 10.1 11.8 1.2 6.5-2 9.1-4.5 9.1-3 0-5.3-4.6-6.8-7.3-4.1-7.3-10.3-7.6-16.9-2.8-6.9 5-12.9 13.4-17.1 20.7-5.1 8.8-9.4 18.5-12 28.2-1.5 5.6-2.9 14.6-.6 19.9 1 2.2 2.5 3.6 4.9 3.6 5 0 12.3-6.6 15.8-10.1 4.5-4.5 10.3-11.5 12.5-16l5.2-15.5c2.6-6.8 9.9-5.6 9.9 0 0 10.2-3.7 13.6-10 34.7-5.8 19.5-7.6 25.8-7.6 25.8-.7 2.8-3.4 7.5-6.3 7.5-1.2 0-2.1-.4-2.6-1.2-1-1.4-.9-5.3-.8-6.3.2-3.2 6.3-22.2 7.3-25.2-2 2.2-4.1 4.4-6.4 6.6-5.4 5.1-14.1 11.8-21.5 11.8-3.4 0-5.6-.9-7.7-2.4l7.6 79.6c2 5 39.2 17.1 88.2 17.1 49.1 0 86.3-12.2 88.2-17.1l10.9-94.6c-5.7 5.2-12.3 11.6-19.6 14.8-5.4 2.3-17.4 3.8-17.4-5.7 0-5.2 9.1-14.8 14.4-21.5 1.4-1.7 4.7-5.9 4.7-8.1 0-2.9-6-2.2-11.7 2.5-3.2 2.7-6.2 6.3-8.7 9.7-4.3 6-6.6 11.2-8.5 15.5-6.2 14.2-4.1 8.6-9.1 22-5 13.3-4.2 11.8-5.2 14-.9 1.9-2.2 3.5-4 4.5-1.9 1-4.5.9-6.1-.3-.9-.6-1.3-1.9-1.3-3.7 0-.9.1-1.8.3-2.7 1.5-6.1 7.8-18.1 15-34.3 1.6-3.7 1-2.6.8-2.3-6.2 6-10.9 8.9-14.4 10.5-5.8 2.6-13 2.6-14.5-4.1-.1-.4-.1-.8-.2-1.2-11.8 9.2-24.3 11.7-20-8.1-4.6 8.2-12.6 14.9-22.4 14.9-4.1 0-7.1-1.4-8.6-5.1-2.3-5.5 1.3-14.9 4.6-23.8 1.7-4.5 4-9.9 7.1-16.2 1.6-3.4 4.2-5.4 7.6-4.5.6.2 1.1.4 1.6.7 2.6 1.8 1.6 4.5.3 7.2-3.8 7.5-7.1 13-9.3 20.8-.9 3.3-2 9 1.5 9 2.4 0 4.7-.8 6.9-2.4 4.6-3.4 8.3-8.5 11.1-13.5 2-3.6 4.4-8.3 5.6-12.3.5-1.7 1.1-3.3 1.8-4.8 1.1-2.5 2.6-5.1 5.2-5.1 1.3 0 2.4.5 3.2 1.5 1.7 2.2 1.3 4.5.4 6.9-2 5.6-4.7 10.6-6.9 16.7-1.3 3.5-2.7 8-2.7 11.7 0 3.4 3.7 2.6 6.8 1.2 2.4-1.1 4.8-2.8 6.8-4.5 1.2-4.9.9-3.8 26.4-68.2 1.3-3.3 3.7-4.7 6.1-4.7 1.2 0 2.2.4 3.2 1.1 1.7 1.3 1.7 4.1 1 6.2-.7 1.9-.6 1.3-4.5 10.5-5.2 12.1-8.6 20.8-13.2 31.9-1.9 4.6-7.7 18.9-8.7 22.3-.6 2.2-1.3 5.8 1 5.8 5.4 0 19.3-13.1 23.1-17 .2-.3.5-.4.9-.6.6-1.9 1.2-3.7 1.7-5.5 1.4-3.8 2.7-8.2 5.3-11.3.8-1 1.7-1.6 2.7-1.6 2.8 0 4.2 1.2 4.2 4 0 1.1-.7 5.1-1.1 6.2 1.4-1.5 2.9-3 4.5-4.5 15-13.9 25.7-6.8 25.7.2 0 7.4-8.9 17.7-13.8 23.4-1.6 1.9-4.9 5.4-5 6.4 0 1.3.9 1.8 2.2 1.8 2 0 6.4-3.5 8-4.7 5-3.9 11.8-9.9 16.6-14.1l14.8-136.8c-30.5 17.1-197.6 17.2-228.3.2zm229.7-8.5c0 21-231.2 21-231.2 0 0-8.8 51.8-15.9 115.6-15.9 9 0 17.8.1 26.3.4l12.6-48.7L228.1.6c1.4-1.4 5.8-.2 9.9 3.5s6.6 7.9 5.3 9.3l-.1.1L185.9 74l-10 40.7c39.9 2.6 67.6 8.1 67.6 14.6zm-69.4 4.6c0-.8-.9-1.5-2.5-2.1l-.2.8c0 1.3-5 2.4-11.1 2.4s-11.1-1.1-11.1-2.4c0-.1 0-.2.1-.3l.2-.7c-1.8.6-3 1.4-3 2.3 0 2.1 6.2 3.7 13.7 3.7 7.7.1 13.9-1.6 13.9-3.7z"></path></svg><!-- <span class="fab fa-gulp"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Gulp</span>
                                </div>
                            </a>
                            <!-- parent pages--><a class="nav-link" href="../documentation/design-file.html" role="button">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-palette fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="palette" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M204.3 5C104.9 24.4 24.8 104.3 5.2 203.4c-37 187 131.7 326.4 258.8 306.7 41.2-6.4 61.4-54.6 42.5-91.7-23.1-45.4 9.9-98.4 60.9-98.4h79.7c35.8 0 64.8-29.6 64.9-65.3C511.5 97.1 368.1-26.9 204.3 5zM96 320c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm32-128c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128-64c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 64c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z"></path></svg><!-- <span class="fas fa-palette"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Design file</span>
                                </div>
                            </a>
                            <!-- parent pages--><a class="nav-link" href="../changelog.html" role="button">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-code-branch fa-w-12" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="code-branch" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M384 144c0-44.2-35.8-80-80-80s-80 35.8-80 80c0 36.4 24.3 67.1 57.5 76.8-.6 16.1-4.2 28.5-11 36.9-15.4 19.2-49.3 22.4-85.2 25.7-28.2 2.6-57.4 5.4-81.3 16.9v-144c32.5-10.2 56-40.5 56-76.3 0-44.2-35.8-80-80-80S0 35.8 0 80c0 35.8 23.5 66.1 56 76.3v199.3C23.5 365.9 0 396.2 0 432c0 44.2 35.8 80 80 80s80-35.8 80-80c0-34-21.2-63.1-51.2-74.6 3.1-5.2 7.8-9.8 14.9-13.4 16.2-8.2 40.4-10.4 66.1-12.8 42.2-3.9 90-8.4 118.2-43.4 14-17.4 21.1-39.8 21.6-67.9 31.6-10.8 54.4-40.7 54.4-75.9zM80 64c8.8 0 16 7.2 16 16s-7.2 16-16 16-16-7.2-16-16 7.2-16 16-16zm0 384c-8.8 0-16-7.2-16-16s7.2-16 16-16 16 7.2 16 16-7.2 16-16 16zm224-320c8.8 0 16 7.2 16 16s-7.2 16-16 16-16-7.2-16-16 7.2-16 16-16z"></path></svg><!-- <span class="fas fa-code-branch"></span> Font Awesome fontawesome.com --></span><span class="nav-link-text ps-1">Changelog</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="settings mb-3">
                        <div class="card shadow-none">
                            <div class="card-body alert mb-0" role="alert">
                                <div class="btn-close-falcon-container">
                                    <button class="btn btn-link btn-close-falcon p-0" aria-label="Close" data-bs-dismiss="alert"></button>
                                </div>
                                <div class="text-center"><img src="../assets/img/icons/spot-illustrations/navbar-vertical.png" alt="" width="80">
                                    <p class="fs-11 mt-2">Loving what you see? <br>Get your copy of <a href="#!">Falcon</a></p>
                                    <div class="d-grid"><a class="btn btn-sm btn-primary" href="https://themes.getbootstrap.com/product/falcon-admin-dashboard-webapp-template/" target="_blank">Purchase</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="content">
            <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">

                <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
                <a class="navbar-brand me-1 me-sm-3" href="../index.html">
                    <div class="d-flex align-items-center"><img class="me-2" src="../assets/img/icons/spot-illustrations/falcon.png" alt="" width="40"><span class="font-sans-serif text-primary">falcon</span>
                    </div>
                </a>
                <ul class="navbar-nav align-items-center d-none d-lg-block">
                    <li class="nav-item">
                        <div class="search-box" data-list="{&quot;valueNames&quot;:[&quot;title&quot;]}">
                            <form class="position-relative" data-bs-toggle="search" data-bs-display="static" aria-expanded="false">
                                <input class="form-control search-input fuzzy-search" type="search" placeholder="Search..." aria-label="Search">
                                <svg class="svg-inline--fa fa-search fa-w-16 search-box-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path></svg><!-- <span class="fas fa-search search-box-icon"></span> Font Awesome fontawesome.com -->

                            </form>
                            <div class="btn-close-falcon-container position-absolute end-0 top-50 translate-middle shadow-none" data-bs-dismiss="search">
                                <button class="btn btn-link btn-close-falcon p-0" aria-label="Close"></button>
                            </div>
                            <div class="dropdown-menu border font-base start-0 mt-2 py-0 overflow-hidden w-100">
                                <div class="scrollbar list py-3" style="max-height: 24rem;"><h6 class="dropdown-header fw-medium text-uppercase px-x1 fs-11 pt-0 pb-2">Recently Browsed</h6><a class="dropdown-item fs-10 px-x1 py-1 hover-primary" href="../app/events/event-detail.html">
                                        <div class="d-flex align-items-center">
                                            <svg class="svg-inline--fa fa-circle fa-w-16 me-2 text-300 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path></svg><!-- <span class="fas fa-circle me-2 text-300 fs-11"></span> Font Awesome fontawesome.com -->

                                            <div class="fw-normal title">Pages <svg class="svg-inline--fa fa-chevron-right fa-w-10 mx-1 text-500 fs-11" data-fa-transform="shrink-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="" style="transform-origin: 0.3125em 0.5em;"><g transform="translate(160 256)"><g transform="translate(0, 0)  scale(0.875, 0.875)  rotate(0 0 0)"><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" transform="translate(-160 -256)"></path></g></g></svg><!-- <span class="fas fa-chevron-right mx-1 text-500 fs-11" data-fa-transform="shrink-2"></span> Font Awesome fontawesome.com --> Events</div>
                                        </div>
                                    </a><a class="dropdown-item fs-10 px-x1 py-1 hover-primary" href="../app/e-commerce/customers.html">
                                        <div class="d-flex align-items-center">
                                            <svg class="svg-inline--fa fa-circle fa-w-16 me-2 text-300 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path></svg><!-- <span class="fas fa-circle me-2 text-300 fs-11"></span> Font Awesome fontawesome.com -->

                                            <div class="fw-normal title">E-commerce <svg class="svg-inline--fa fa-chevron-right fa-w-10 mx-1 text-500 fs-11" data-fa-transform="shrink-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="" style="transform-origin: 0.3125em 0.5em;"><g transform="translate(160 256)"><g transform="translate(0, 0)  scale(0.875, 0.875)  rotate(0 0 0)"><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" transform="translate(-160 -256)"></path></g></g></svg><!-- <span class="fas fa-chevron-right mx-1 text-500 fs-11" data-fa-transform="shrink-2"></span> Font Awesome fontawesome.com --> Customers</div>
                                        </div>
                                    </a><hr class="text-200 dark__text-900"><h6 class="dropdown-header fw-medium text-uppercase px-x1 fs-11 pt-0 pb-2">Suggested Filter</h6><a class="dropdown-item px-x1 py-1 fs-9" href="../app/e-commerce/customers.html">
                                        <div class="d-flex align-items-center"><span class="badge fw-medium text-decoration-none me-2 badge-subtle-warning">customers:</span>
                                            <div class="flex-1 fs-10 title">All customers list</div>
                                        </div>
                                    </a><a class="dropdown-item px-x1 py-1 fs-9" href="../app/events/event-detail.html">
                                        <div class="d-flex align-items-center"><span class="badge fw-medium text-decoration-none me-2 badge-subtle-success">events:</span>
                                            <div class="flex-1 fs-10 title">Latest events in current month</div>
                                        </div>
                                    </a><a class="dropdown-item px-x1 py-1 fs-9" href="../app/e-commerce/product/product-grid.html">
                                        <div class="d-flex align-items-center"><span class="badge fw-medium text-decoration-none me-2 badge-subtle-info">products:</span>
                                            <div class="flex-1 fs-10 title">Most popular products</div>
                                        </div>
                                    </a><hr class="text-200 dark__text-900"><h6 class="dropdown-header fw-medium text-uppercase px-x1 fs-11 pt-0 pb-2">Files</h6><a class="dropdown-item px-x1 py-2" href="#!">
                                        <div class="d-flex align-items-center">
                                            <div class="file-thumbnail me-2"><img class="border h-100 w-100 object-fit-cover rounded-3" src="../assets/img/products/3-thumb.png" alt=""></div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 title">iPhone</h6>
                                                <p class="fs-11 mb-0 d-flex"><span class="fw-semi-bold">Antony</span><span class="fw-medium text-600 ms-2">27 Sep at 10:30 AM</span></p>
                                            </div>
                                        </div>
                                    </a><a class="dropdown-item px-x1 py-2" href="#!">
                                        <div class="d-flex align-items-center">
                                            <div class="file-thumbnail me-2"><img class="img-fluid" src="../assets/img/icons/zip.png" alt=""></div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 title">Falcon v1.8.2</h6>
                                                <p class="fs-11 mb-0 d-flex"><span class="fw-semi-bold">John</span><span class="fw-medium text-600 ms-2">30 Sep at 12:30 PM</span></p>
                                            </div>
                                        </div>
                                    </a><hr class="text-200 dark__text-900"><h6 class="dropdown-header fw-medium text-uppercase px-x1 fs-11 pt-0 pb-2">Members</h6><a class="dropdown-item px-x1 py-2" href="../pages/user/profile.html">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-l status-online me-2">
                                                <img class="rounded-circle" src="../assets/img/team/1.jpg" alt="">

                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 title">Anna Karinina</h6>
                                                <p class="fs-11 mb-0 d-flex">Technext Limited</p>
                                            </div>
                                        </div>
                                    </a><a class="dropdown-item px-x1 py-2" href="../pages/user/profile.html">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-l me-2">
                                                <img class="rounded-circle" src="../assets/img/team/2.jpg" alt="">

                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 title">Antony Hopkins</h6>
                                                <p class="fs-11 mb-0 d-flex">Brain Trust</p>
                                            </div>
                                        </div>
                                    </a><a class="dropdown-item px-x1 py-2" href="../pages/user/profile.html">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-l me-2">
                                                <img class="rounded-circle" src="../assets/img/team/3.jpg" alt="">

                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 title">Emma Watson</h6>
                                                <p class="fs-11 mb-0 d-flex">Google</p>
                                            </div>
                                        </div>
                                    </a></div>
                                <div class="text-center mt-n3">
                                    <p class="fallback fw-bold fs-8 d-none">No Result Found.</p>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
                    <li class="nav-item ps-2 pe-0">
                        <div class="dropdown theme-control-dropdown"><a class="nav-link d-flex align-items-center dropdown-toggle fa-icon-wait fs-9 pe-1 py-0" href="#" role="button" id="themeSwitchDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg class="svg-inline--fa fa-sun fa-w-16 fs-7" data-fa-transform="shrink-2" data-theme-dropdown-toggle-icon="light" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sun" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.5em;"><g transform="translate(256 256)"><g transform="translate(0, 0)  scale(0.875, 0.875)  rotate(0 0 0)"><path fill="currentColor" d="M256 160c-52.9 0-96 43.1-96 96s43.1 96 96 96 96-43.1 96-96-43.1-96-96-96zm246.4 80.5l-94.7-47.3 33.5-100.4c4.5-13.6-8.4-26.5-21.9-21.9l-100.4 33.5-47.4-94.8c-6.4-12.8-24.6-12.8-31 0l-47.3 94.7L92.7 70.8c-13.6-4.5-26.5 8.4-21.9 21.9l33.5 100.4-94.7 47.4c-12.8 6.4-12.8 24.6 0 31l94.7 47.3-33.5 100.5c-4.5 13.6 8.4 26.5 21.9 21.9l100.4-33.5 47.3 94.7c6.4 12.8 24.6 12.8 31 0l47.3-94.7 100.4 33.5c13.6 4.5 26.5-8.4 21.9-21.9l-33.5-100.4 94.7-47.3c13-6.5 13-24.7.2-31.1zm-155.9 106c-49.9 49.9-131.1 49.9-181 0-49.9-49.9-49.9-131.1 0-181 49.9-49.9 131.1-49.9 181 0 49.9 49.9 49.9 131.1 0 181z" transform="translate(-256 -256)"></path></g></g></svg><!-- <span class="fas fa-sun fs-7" data-fa-transform="shrink-2" data-theme-dropdown-toggle-icon="light"></span> Font Awesome fontawesome.com --><svg class="svg-inline--fa fa-moon fa-w-16 fs-7 d-none" data-fa-transform="shrink-3" data-theme-dropdown-toggle-icon="dark" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="moon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.5em;"><g transform="translate(256 256)"><g transform="translate(0, 0)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M283.211 512c78.962 0 151.079-35.925 198.857-94.792 7.068-8.708-.639-21.43-11.562-19.35-124.203 23.654-238.262-71.576-238.262-196.954 0-72.222 38.662-138.635 101.498-174.394 9.686-5.512 7.25-20.197-3.756-22.23A258.156 258.156 0 0 0 283.211 0c-141.309 0-256 114.511-256 256 0 141.309 114.511 256 256 256z" transform="translate(-256 -256)"></path></g></g></svg><!-- <span class="fas fa-moon fs-7 d-none" data-fa-transform="shrink-3" data-theme-dropdown-toggle-icon="dark"></span> Font Awesome fontawesome.com --><svg class="svg-inline--fa fa-adjust fa-w-16 fs-7 d-none" data-fa-transform="shrink-2" data-theme-dropdown-toggle-icon="auto" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="adjust" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.5em;"><g transform="translate(256 256)"><g transform="translate(0, 0)  scale(0.875, 0.875)  rotate(0 0 0)"><path fill="currentColor" d="M8 256c0 136.966 111.033 248 248 248s248-111.034 248-248S392.966 8 256 8 8 119.033 8 256zm248 184V72c101.705 0 184 82.311 184 184 0 101.705-82.311 184-184 184z" transform="translate(-256 -256)"></path></g></g></svg><!-- <span class="fas fa-adjust fs-7 d-none" data-fa-transform="shrink-2" data-theme-dropdown-toggle-icon="auto"></span> Font Awesome fontawesome.com --></a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-caret border py-0 mt-3" aria-labelledby="themeSwitchDropdown">
                                <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                    <button class="dropdown-item d-flex align-items-center gap-2 active" type="button" value="light" data-theme-control="theme"><svg class="svg-inline--fa fa-sun fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sun" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 160c-52.9 0-96 43.1-96 96s43.1 96 96 96 96-43.1 96-96-43.1-96-96-96zm246.4 80.5l-94.7-47.3 33.5-100.4c4.5-13.6-8.4-26.5-21.9-21.9l-100.4 33.5-47.4-94.8c-6.4-12.8-24.6-12.8-31 0l-47.3 94.7L92.7 70.8c-13.6-4.5-26.5 8.4-21.9 21.9l33.5 100.4-94.7 47.4c-12.8 6.4-12.8 24.6 0 31l94.7 47.3-33.5 100.5c-4.5 13.6 8.4 26.5 21.9 21.9l100.4-33.5 47.3 94.7c6.4 12.8 24.6 12.8 31 0l47.3-94.7 100.4 33.5c13.6 4.5 26.5-8.4 21.9-21.9l-33.5-100.4 94.7-47.3c13-6.5 13-24.7.2-31.1zm-155.9 106c-49.9 49.9-131.1 49.9-181 0-49.9-49.9-49.9-131.1 0-181 49.9-49.9 131.1-49.9 181 0 49.9 49.9 49.9 131.1 0 181z"></path></svg><!-- <span class="fas fa-sun"></span> Font Awesome fontawesome.com -->Light<svg class="svg-inline--fa fa-check fa-w-16 dropdown-check-icon ms-auto text-600" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path></svg><!-- <span class="fas fa-check dropdown-check-icon ms-auto text-600"></span> Font Awesome fontawesome.com --></button>
                                    <button class="dropdown-item d-flex align-items-center gap-2" type="button" value="dark" data-theme-control="theme"><svg class="svg-inline--fa fa-moon fa-w-16" data-fa-transform="" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="moon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M283.211 512c78.962 0 151.079-35.925 198.857-94.792 7.068-8.708-.639-21.43-11.562-19.35-124.203 23.654-238.262-71.576-238.262-196.954 0-72.222 38.662-138.635 101.498-174.394 9.686-5.512 7.25-20.197-3.756-22.23A258.156 258.156 0 0 0 283.211 0c-141.309 0-256 114.511-256 256 0 141.309 114.511 256 256 256z"></path></svg><!-- <span class="fas fa-moon" data-fa-transform=""></span> Font Awesome fontawesome.com -->Dark<svg class="svg-inline--fa fa-check fa-w-16 dropdown-check-icon ms-auto text-600" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path></svg><!-- <span class="fas fa-check dropdown-check-icon ms-auto text-600"></span> Font Awesome fontawesome.com --></button>
                                    <button class="dropdown-item d-flex align-items-center gap-2" type="button" value="auto" data-theme-control="theme"><svg class="svg-inline--fa fa-adjust fa-w-16" data-fa-transform="" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="adjust" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M8 256c0 136.966 111.033 248 248 248s248-111.034 248-248S392.966 8 256 8 8 119.033 8 256zm248 184V72c101.705 0 184 82.311 184 184 0 101.705-82.311 184-184 184z"></path></svg><!-- <span class="fas fa-adjust" data-fa-transform=""></span> Font Awesome fontawesome.com -->Auto<svg class="svg-inline--fa fa-check fa-w-16 dropdown-check-icon ms-auto text-600" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path></svg><!-- <span class="fas fa-check dropdown-check-icon ms-auto text-600"></span> Font Awesome fontawesome.com --></button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item d-none d-sm-block">
                        <a class="nav-link px-0 notification-indicator notification-indicator-warning notification-indicator-fill fa-icon-wait" href="../app/e-commerce/shopping-cart.html"><svg class="svg-inline--fa fa-shopping-cart fa-w-18" data-fa-transform="shrink-7" style="font-size: 33px;transform-origin: 0.5625em 0.5em;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="shopping-cart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><g transform="translate(288 256)"><g transform="translate(0, 0)  scale(0.5625, 0.5625)  rotate(0 0 0)"><path fill="currentColor" d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z" transform="translate(-288 -256)"></path></g></g></svg><!-- <span class="fas fa-shopping-cart" data-fa-transform="shrink-7" style="font-size: 33px;"></span> Font Awesome fontawesome.com --><span class="notification-indicator-number">1</span></a>

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link notification-indicator notification-indicator-primary px-0 fa-icon-wait" id="navbarDropdownNotification" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hide-on-body-scroll="data-hide-on-body-scroll"><svg class="svg-inline--fa fa-bell fa-w-14" data-fa-transform="shrink-6" style="font-size: 33px;transform-origin: 0.4375em 0.5em;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><g transform="translate(224 256)"><g transform="translate(0, 0)  scale(0.625, 0.625)  rotate(0 0 0)"><path fill="currentColor" d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z" transform="translate(-224 -256)"></path></g></g></svg><!-- <span class="fas fa-bell" data-fa-transform="shrink-6" style="font-size: 33px;"></span> Font Awesome fontawesome.com --></a>
                        <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-menu-notification dropdown-caret-bg" aria-labelledby="navbarDropdownNotification">
                            <div class="card card-notification shadow-none">
                                <div class="card-header">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <h6 class="card-header-title mb-0">Notifications</h6>
                                        </div>
                                        <div class="col-auto ps-0 ps-sm-3"><a class="card-link fw-normal" href="#">Mark all as read</a></div>
                                    </div>
                                </div>
                                <div class="scrollbar-overlay" style="max-height:19rem" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;"><div class="simplebar-content" style="padding: 0px;">
                                                        <div class="list-group list-group-flush fw-normal fs-10">
                                                            <div class="list-group-title border-bottom">NEW</div>
                                                            <div class="list-group-item">
                                                                <a class="notification notification-flush notification-unread" href="#!">
                                                                    <div class="notification-avatar">
                                                                        <div class="avatar avatar-2xl me-3">
                                                                            <img class="rounded-circle" src="../assets/img/team/1-thumb.png" alt="">

                                                                        </div>
                                                                    </div>
                                                                    <div class="notification-body">
                                                                        <p class="mb-1"><strong>Emma Watson</strong> replied to your comment : "Hello world 😍"</p>
                                                                        <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">💬</span>Just now</span>

                                                                    </div>
                                                                </a>

                                                            </div>
                                                            <div class="list-group-item">
                                                                <a class="notification notification-flush notification-unread" href="#!">
                                                                    <div class="notification-avatar">
                                                                        <div class="avatar avatar-2xl me-3">
                                                                            <div class="avatar-name rounded-circle"><span>AB</span></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="notification-body">
                                                                        <p class="mb-1"><strong>Albert Brooks</strong> reacted to <strong>Mia Khalifa's</strong> status</p>
                                                                        <span class="notification-time"><svg class="svg-inline--fa fa-gratipay fa-w-16 me-2 text-danger" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="gratipay" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg=""><path fill="currentColor" d="M248 8C111.1 8 0 119.1 0 256s111.1 248 248 248 248-111.1 248-248S384.9 8 248 8zm114.6 226.4l-113 152.7-112.7-152.7c-8.7-11.9-19.1-50.4 13.6-72 28.1-18.1 54.6-4.2 68.5 11.9 15.9 17.9 46.6 16.9 61.7 0 13.9-16.1 40.4-30 68.1-11.9 32.9 21.6 22.6 60 13.8 72z"></path></svg><!-- <span class="me-2 fab fa-gratipay text-danger"></span> Font Awesome fontawesome.com -->9hr</span>

                                                                    </div>
                                                                </a>

                                                            </div>
                                                            <div class="list-group-title border-bottom">EARLIER</div>
                                                            <div class="list-group-item">
                                                                <a class="notification notification-flush" href="#!">
                                                                    <div class="notification-avatar">
                                                                        <div class="avatar avatar-2xl me-3">
                                                                            <img class="rounded-circle" src="../assets/img/icons/weather-sm.jpg" alt="">

                                                                        </div>
                                                                    </div>
                                                                    <div class="notification-body">
                                                                        <p class="mb-1">The forecast today shows a low of 20℃ in California. See today's weather.</p>
                                                                        <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🌤️</span>1d</span>

                                                                    </div>
                                                                </a>

                                                            </div>
                                                            <div class="list-group-item">
                                                                <a class="border-bottom-0 notification-unread  notification notification-flush" href="#!">
                                                                    <div class="notification-avatar">
                                                                        <div class="avatar avatar-xl me-3">
                                                                            <img class="rounded-circle" src="../assets/img/logos/oxford.png" alt="">

                                                                        </div>
                                                                    </div>
                                                                    <div class="notification-body">
                                                                        <p class="mb-1"><strong>University of Oxford</strong> created an event : "Causal Inference Hilary 2019"</p>
                                                                        <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">✌️</span>1w</span>

                                                                    </div>
                                                                </a>

                                                            </div>
                                                            <div class="list-group-item">
                                                                <a class="border-bottom-0 notification notification-flush" href="#!">
                                                                    <div class="notification-avatar">
                                                                        <div class="avatar avatar-xl me-3">
                                                                            <img class="rounded-circle" src="../assets/img/team/10.jpg" alt="">

                                                                        </div>
                                                                    </div>
                                                                    <div class="notification-body">
                                                                        <p class="mb-1"><strong>James Cameron</strong> invited to join the group: United Nations International Children's Fund</p>
                                                                        <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🙋‍</span>2d</span>

                                                                    </div>
                                                                </a>

                                                            </div>
                                                        </div>
                                                    </div></div></div></div><div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="height: 0px; display: none;"></div></div></div>
                                <div class="card-footer text-center border-top"><a class="card-link d-block" href="../app/social/notifications.html">View all</a></div>
                            </div>
                        </div>

                    </li>
                    <li class="nav-item dropdown px-1">
                        <a class="nav-link fa-icon-wait nine-dots p-1" id="navbarDropdownMenu" role="button" data-hide-on-body-scroll="data-hide-on-body-scroll" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="43" viewBox="0 0 16 16" fill="none">
                                <circle cx="2" cy="2" r="2" fill="#6C6E71"></circle>
                                <circle cx="2" cy="8" r="2" fill="#6C6E71"></circle>
                                <circle cx="2" cy="14" r="2" fill="#6C6E71"></circle>
                                <circle cx="8" cy="8" r="2" fill="#6C6E71"></circle>
                                <circle cx="8" cy="14" r="2" fill="#6C6E71"></circle>
                                <circle cx="14" cy="8" r="2" fill="#6C6E71"></circle>
                                <circle cx="14" cy="14" r="2" fill="#6C6E71"></circle>
                                <circle cx="8" cy="2" r="2" fill="#6C6E71"></circle>
                                <circle cx="14" cy="2" r="2" fill="#6C6E71"></circle>
                            </svg></a>
                        <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-caret-bg" aria-labelledby="navbarDropdownMenu">
                            <div class="card shadow-none">
                                <div class="scrollbar-overlay nine-dots-dropdown" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;"><div class="simplebar-content" style="padding: 0px;">
                                                        <div class="card-body px-3">
                                                            <div class="row text-center gx-0 gy-0">
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="../pages/user/profile.html" target="_blank">
                                                                        <div class="avatar avatar-2xl"> <img class="rounded-circle" src="../assets/img/team/3.jpg" alt=""></div>
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11">Account</p>
                                                                    </a></div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="https://themewagon.com/" target="_blank"><img class="rounded" src="../assets/img/nav-icons/themewagon.png" alt="" width="40" height="40">
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11 pt-1">Themewagon</p>
                                                                    </a></div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="https://mailbluster.com/" target="_blank"><img class="rounded" src="../assets/img/nav-icons/mailbluster.png" alt="" width="40" height="40">
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11 pt-1">Mailbluster</p>
                                                                    </a></div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="#!" target="_blank"><img class="rounded" src="../assets/img/nav-icons/google.png" alt="" width="40" height="40">
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11 pt-1">Google</p>
                                                                    </a></div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="#!" target="_blank"><img class="rounded" src="../assets/img/nav-icons/spotify.png" alt="" width="40" height="40">
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11 pt-1">Spotify</p>
                                                                    </a></div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="#!" target="_blank"><img class="rounded" src="../assets/img/nav-icons/steam.png" alt="" width="40" height="40">
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11 pt-1">Steam</p>
                                                                    </a></div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="#!" target="_blank"><img class="rounded" src="../assets/img/nav-icons/github-light.png" alt="" width="40" height="40">
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11 pt-1">Github</p>
                                                                    </a></div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="#!" target="_blank"><img class="rounded" src="../assets/img/nav-icons/discord.png" alt="" width="40" height="40">
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11 pt-1">Discord</p>
                                                                    </a></div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="#!" target="_blank"><img class="rounded" src="../assets/img/nav-icons/xbox.png" alt="" width="40" height="40">
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11 pt-1">xbox</p>
                                                                    </a></div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="#!" target="_blank"><img class="rounded" src="../assets/img/nav-icons/trello.png" alt="" width="40" height="40">
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11 pt-1">Kanban</p>
                                                                    </a></div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="#!" target="_blank"><img class="rounded" src="../assets/img/nav-icons/hp.png" alt="" width="40" height="40">
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11 pt-1">Hp</p>
                                                                    </a></div>
                                                                <div class="col-12">
                                                                    <hr class="my-3 mx-n3 bg-200">
                                                                </div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="#!" target="_blank"><img class="rounded" src="../assets/img/nav-icons/linkedin.png" alt="" width="40" height="40">
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11 pt-1">Linkedin</p>
                                                                    </a></div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="#!" target="_blank"><img class="rounded" src="../assets/img/nav-icons/twitter.png" alt="" width="40" height="40">
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11 pt-1">Twitter</p>
                                                                    </a></div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="#!" target="_blank"><img class="rounded" src="../assets/img/nav-icons/facebook.png" alt="" width="40" height="40">
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11 pt-1">Facebook</p>
                                                                    </a></div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="#!" target="_blank"><img class="rounded" src="../assets/img/nav-icons/instagram.png" alt="" width="40" height="40">
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11 pt-1">Instagram</p>
                                                                    </a></div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="#!" target="_blank"><img class="rounded" src="../assets/img/nav-icons/pinterest.png" alt="" width="40" height="40">
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11 pt-1">Pinterest</p>
                                                                    </a></div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="#!" target="_blank"><img class="rounded" src="../assets/img/nav-icons/slack.png" alt="" width="40" height="40">
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11 pt-1">Slack</p>
                                                                    </a></div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="#!" target="_blank"><img class="rounded" src="../assets/img/nav-icons/deviantart.png" alt="" width="40" height="40">
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11 pt-1">Deviantart</p>
                                                                    </a></div>
                                                                <div class="col-4"><a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="../app/events/event-detail.html" target="_blank">
                                                                        <div class="avatar avatar-2xl">
                                                                            <div class="avatar-name rounded-circle bg-primary-subtle text-primary"><span class="fs-7">E</span></div>
                                                                        </div>
                                                                        <p class="mb-0 fw-medium text-800 text-truncate fs-11">Events</p>
                                                                    </a></div>
                                                                <div class="col-12"><a class="btn btn-outline-primary btn-sm mt-4" href="#!">Show more</a></div>
                                                            </div>
                                                        </div>
                                                    </div></div></div></div><div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="height: 0px; display: none;"></div></div></div>
                            </div>
                        </div>

                    </li>
                    <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-xl">
                                <img class="rounded-circle" src="../assets/img/team/3-thumb.png" alt="">

                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                            <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                <a class="dropdown-item fw-bold text-warning" href="#!"><svg class="svg-inline--fa fa-crown fa-w-20 me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="crown" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M528 448H112c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm64-320c-26.5 0-48 21.5-48 48 0 7.1 1.6 13.7 4.4 19.8L476 239.2c-15.4 9.2-35.3 4-44.2-11.6L350.3 85C361 76.2 368 63 368 48c0-26.5-21.5-48-48-48s-48 21.5-48 48c0 15 7 28.2 17.7 37l-81.5 142.6c-8.9 15.6-28.9 20.8-44.2 11.6l-72.3-43.4c2.7-6 4.4-12.7 4.4-19.8 0-26.5-21.5-48-48-48S0 149.5 0 176s21.5 48 48 48c2.6 0 5.2-.4 7.7-.8L128 416h384l72.3-192.8c2.5.4 5.1.8 7.7.8 26.5 0 48-21.5 48-48s-21.5-48-48-48z"></path></svg><!-- <span class="fas fa-crown me-1"></span> Font Awesome fontawesome.com --><span>Go Pro</span></a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#!">Set status</a>
                                <a class="dropdown-item" href="../pages/user/profile.html">Profile &amp; account</a>
                                <a class="dropdown-item" href="#!">Feedback</a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../pages/user/settings.html">Settings</a>
                                <a class="dropdown-item" href="../pages/authentication/card/logout.html">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="card mb-3">
                <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/icons/spot-illustrations/corner-4.png);">
                </div>
                <!--/.bg-holder-->

                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">Getting Started</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0" data-anchor="data-anchor" id="quick-start">Quick start<a class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#" href="#quick-start" style="padding-left: 0.375em;"></a></h5>
                </div>
                <div class="card-body bg-body-tertiary">
                    <label for="organizerMultiple">Multiple</label>
                    <select class="form-select js-choice" id="organizerMultiple" multiple="multiple" size="1" name="organizerMultiple" data-options='{"removeItemButton":true,"placeholder":true}'>
                        <option value="">Select organizer...</option>
                        <option>Massachusetts Institute of Technology</option>
                        <option>University of Chicago</option>
                        <option>GSAS Open Labs At Harvard</option>
                        <option>California Institute of Technology</option>
                    </select>

                    <input class="form-control search-input fuzzy-search" type="search" placeholder="Search..." aria-label="Search">
                    <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" />


                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0" data-anchor="data-anchor" id="setting-up-build-system">Setting up Build system<a class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#" href="#setting-up-build-system" style="padding-left: 0.375em;"></a></h5>
                </div>
                <div class="card-body bg-body-tertiary">
                    <p>Unzip the <code>Falcon-v3.19.0.zip</code> to any folder and open a command line or terminal at that location.
                        theme's dev tools require <a href="https://nodejs.org/en/" target="_blank">Node</a> and <a href="https://git-scm.com/" target="_blank">Git</a> . If you do not have them in your machine, please install their latest stable version from their corresponding website. As you have <span class="fw-black text-black">Node and Git installed and accessible from your terminal or command line</span>, install <a href="https://gulpjs.com/" target="_blank">Gulp CLI</a> package
                        globally with the following command:
                    </p>
                    <pre class="language-html" tabindex="0"><code class="language-html">npm i gulp-cli -g
</code></pre>
                    <p class="mt-4">When you’re done, install the rest of the theme’s dependencies with:</p>
                    <pre class="language-html" tabindex="0"><code class="language-html">npm i
</code></pre>
                    <p class="mt-4">Now run:</p>
                    <pre class="language-html" tabindex="0"><code class="language-html">gulp
</code></pre>
                    <p class="mt-4">Running gulp will compile the SCSS, transpile the javascript, copy all required libraries form <code>node_modules</code> to the corresponding <code>public/assets/vendors </code> directory and will open a browser window to <code>public/index.html</code></p>
                    <p>All of the following folders are monitored for changes, which will tell the browser to reload automatically after any changes are made:</p>
                    <pre class="language-html" tabindex="0"><code class="language-html">public/assets/fonts/
public/assets/video/
public/assets/img/
public/vendors
src/pug/
src/scss/
src/js/
</code></pre>
                    <p class="mt-4">Now you can edit any <code>pug</code> file from <code>src/pug</code>, change SCSS variable with <code>scss/_user-variables.scss</code>, or write your own SCSS code in <code>scss/_user.scss</code> and add or update <code>javaScript</code> from <code>src/js</code> directory.</p>
                    <div class="alert alert-warning">Running the <code>gulp</code> command will discard and regenerate all the files in following directories:</div>
                    <pre class="language-html" tabindex="0"><code class="language-html">public/**/*.html
public/assets/css/
public/assets/js/
public/vendors
</code></pre>
                    <p class="mt-4">Hit <code>Ctrl+C</code> or just close the command line window to stop the server.</p>
                    <p>Happy editing!</p>
                </div>
            </div>
            <footer class="footer">
                <div class="row g-0 justify-content-between fs-10 mt-4 mb-3">
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 text-600">Thank you for creating with Falcon <span class="d-none d-sm-inline-block">| </span><br class="d-sm-none"> 2023 © <a href="https://themewagon.com">Themewagon</a></p>
                    </div>
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 text-600">v3.19.0</p>
                    </div>
                </div>
            </footer>
        </div>
        <div class="modal fade" id="authentication-modal" tabindex="-1" role="dialog" aria-labelledby="authentication-modal-label" aria-hidden="true">
            <div class="modal-dialog mt-6" role="document">
                <div class="modal-content border-0">
                    <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
                        <div class="position-relative z-1">
                            <h4 class="mb-0 text-white" id="authentication-modal-label">Register</h4>
                            <p class="fs-10 mb-0 text-white">Please create your free Falcon account</p>
                        </div>
                        <button class="btn-close position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-4 px-5">
                        <form>
                            <div class="mb-3">
                                <label class="form-label" for="modal-auth-name">Name</label>
                                <input class="form-control" type="text" autocomplete="on" id="modal-auth-name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="modal-auth-email">Email address</label>
                                <input class="form-control" type="email" autocomplete="on" id="modal-auth-email">
                            </div>
                            <div class="row gx-2">
                                <div class="mb-3 col-sm-6">
                                    <label class="form-label" for="modal-auth-password">Password</label>
                                    <input class="form-control" type="password" autocomplete="on" id="modal-auth-password">
                                </div>
                                <div class="mb-3 col-sm-6">
                                    <label class="form-label" for="modal-auth-confirm-password">Confirm Password</label>
                                    <input class="form-control" type="password" autocomplete="on" id="modal-auth-confirm-password">
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="modal-auth-register-checkbox">
                                <label class="form-label" for="modal-auth-register-checkbox">I accept the <a href="#!">terms </a>and <a class="white-space-nowrap" href="#!">privacy policy</a></label>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Register</button>
                            </div>
                        </form>
                        <div class="position-relative mt-5">
                            <hr>
                            <div class="divider-content-center">or register with</div>
                        </div>
                        <div class="row g-2 mt-2">
                            <div class="col-sm-6"><a class="btn btn-outline-google-plus btn-sm d-block w-100" href="#"><svg class="svg-inline--fa fa-google-plus-g fa-w-20 me-2" data-fa-transform="grow-8" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google-plus-g" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="" style="transform-origin: 0.625em 0.5em;"><g transform="translate(320 256)"><g transform="translate(0, 0)  scale(1.5, 1.5)  rotate(0 0 0)"><path fill="currentColor" d="M386.061 228.496c1.834 9.692 3.143 19.384 3.143 31.956C389.204 370.205 315.599 448 204.8 448c-106.084 0-192-85.915-192-192s85.916-192 192-192c51.864 0 95.083 18.859 128.611 50.292l-52.126 50.03c-14.145-13.621-39.028-29.599-76.485-29.599-65.484 0-118.92 54.221-118.92 121.277 0 67.056 53.436 121.277 118.92 121.277 75.961 0 104.513-54.745 108.965-82.773H204.8v-66.009h181.261zm185.406 6.437V179.2h-56.001v55.733h-55.733v56.001h55.733v55.733h56.001v-55.733H627.2v-56.001h-55.733z" transform="translate(-320 -256)"></path></g></g></svg><!-- <span class="fab fa-google-plus-g me-2" data-fa-transform="grow-8"></span> Font Awesome fontawesome.com --> google</a></div>
                            <div class="col-sm-6"><a class="btn btn-outline-facebook btn-sm d-block w-100" href="#"><svg class="svg-inline--fa fa-facebook-square fa-w-14 me-2" data-fa-transform="grow-8" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-square" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="" style="transform-origin: 0.4375em 0.5em;"><g transform="translate(224 256)"><g transform="translate(0, 0)  scale(1.5, 1.5)  rotate(0 0 0)"><path fill="currentColor" d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z" transform="translate(-224 -256)"></path></g></g></svg><!-- <span class="fab fa-facebook-square me-2" data-fa-transform="grow-8"></span> Font Awesome fontawesome.com --> facebook</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>


<script src="{{asset('assets/vendors/popper/popper.min.js')}}"></script>
<script src="{{asset('assets/vendors/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/vendors/anchorjs/anchor.min.js')}}"></script>
<script src="{{asset('assets/vendors/is/is.min.js')}}"></script>
<script src="{{asset('assets/vendors/prism/prism.js')}}"></script>
<script src="{{asset('assets/vendors/fontawesome/all.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
<script src="{{asset('assets/vendors/lodash/lodash.min.js')}}"></script>
<script src="{{asset('assets/vendors/list.js/list.min.js')}}"></script>
<script src="{{asset('assets/js/theme.js')}}"></script>

<script src="{{asset('assets/vendors/choices/choices.min.js')}}"></script>
<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>
</body>
</html>
