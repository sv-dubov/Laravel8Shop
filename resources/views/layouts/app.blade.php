<!DOCTYPE html>
<html lang="en">
<head>
    <title>OneTech</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ asset('front/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/plugins/slick-1.8.0/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/styles/responsive.css') }}">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>

<div class="super_container">

    <!-- Header -->

    <header class="header">

        <!-- Top Bar -->

        <div class="top_bar">
            <div class="container">
                <div class="row">
                    <div class="col d-flex flex-row">
                        <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('front/images/phone.png')}}" alt=""></div>{{ $siteInfo->phone_one }}</div>
                        <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('front/images/mail.png')}}" alt=""></div><a href="mailto:{{ $siteInfo->email }}">{{ $siteInfo->email }}</a></div>
                        <div class="top_bar_content ml-auto">
                            @guest
                            @else
                                <div class="top_bar_menu">
                                    <ul class="standard_dropdown top_bar_dropdown">
                                        <li>
                                            <a href="" data-toggle="modal" data-target="#exampleModal">Order tracking</a>
                                        </li>
                                    </ul>
                                </div>
                            @endguest
                            <div class="top_bar_menu">
                                <ul class="standard_dropdown top_bar_dropdown">
                                    <li>
                                        <a href="#">$ US dollar<i class="fas fa-chevron-down"></i></a>
                                        <ul>
                                            <li><a href="#">EUR Euro</a></li>
                                            <li><a href="#">GBP British Pound</a></li>
                                            <li><a href="#">JPY Japanese Yen</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="top_bar_user">
                                @guest
                                    <div class="user_icon"><img src="{{ asset ('front/images/user.svg') }}" alt=""></div>
                                    <div><a href="{{ route('login') }}">Sign in/Sign up</a></div>
                                @else
                                    <ul class="standard_dropdown top_bar_dropdown">
                                        <li>
                                            <a href="/dashboard">
                                                <div class="user_icon">
                                                    <img src="{{ asset('front/images/user.svg')}}" alt="">
                                                </div> Profile<i class="fas fa-chevron-down"></i>
                                            </a>
                                            <ul>
                                                <li><a href="{{ route('user.wishlist') }}">Wishlist</a></li>
                                                <li><a href="{{ route('user.checkout') }}">Checkout</a></li>
                                                <li><a href="#">Others</a></li>
                                                <li><a href="{{ route('user.logout') }}">Sign out</a></li>
                                            </ul>
                                        </li>

                                    </ul>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Main -->

        @if (session('status'))
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('status') }}
            </div>
        @endif

        <div class="header_main">
            <div class="container">
                <div class="row">

                    <!-- Logo -->
                    <div class="col-lg-2 col-sm-3 col-3 order-1">
                        <div class="logo_container">
                            <div class="logo"><a href="{{ url('/') }}">OneTech</a></div>
                        </div>
                    </div>

                    <!-- Search -->
                    <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                        <div class="header_search">
                            <div class="header_search_content">
                                <div class="header_search_form_container">
                                    <form class="header_search_form clearfix" action="{{ route('product.search') }}" method="post">
                                        @csrf
                                        <input class="header_search_input" type="search" name="search" placeholder="Search for products..." required>
                                        <div class="custom_dropdown">
                                            <div class="custom_dropdown_list">
                                                <span class="custom_dropdown_placeholder clc">All Categories</span>
                                                <i class="fas fa-chevron-down"></i>
                                                <ul class="custom_list clc">
                                                    <li><a class="clc" href="#">All Categories</a></li>
                                                    @foreach($parentCategories as $row)
                                                        <li><a class="clc" href="#">{{ $row->category_name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{ asset ('front/images/search.png') }}" alt=""></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Wishlist -->
                    <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                        <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                            <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                                @guest
                                @else
                                <div class="wishlist_icon"><img src="{{ asset ('front/images/heart.png') }}" alt=""></div>
                                <div class="wishlist_content">
                                    <div class="wishlist_text"><a href="#">Wishlist</a></div>
                                    <div class="wishlist_count">{{ count($getWishlist) }}</div>
                                </div>
                                @endguest
                            </div>

                            <!-- Cart -->
                            <div class="cart">
                                <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                    <div class="cart_icon">
                                        <img src="{{ asset('front/images/cart.png')}}" alt="">
                                        <div class="cart_count"><span>{{ Cart::count() }}</span></div>
                                    </div>
                                    <div class="cart_content">
                                        <div class="cart_text"><a href="{{ route('show.cart') }}">Cart</a></div>
                                        <div class="cart_price">${{ Cart::subtotal() }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
        @yield('content')

    @include('layouts.footer')
</div>

<!--Order Traking Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Your status code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.order.tracking') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label>Status Code</label>
                        <input type="text" name="code" class="form-control" placeholder="Fill your order status code" required>
                    </div>
                    <div class="contact_form_button text-center">
                        <button type="submit" class="btn btn-primary">Track now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('front/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('front/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('front/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/plugins/greensock/TweenMax.min.js') }}"></script>
<script src="{{ asset('front/plugins/greensock/TimelineMax.min.js') }}"></script>
<script src="{{ asset('front/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
<script src="{{ asset('front/plugins/greensock/animation.gsap.min.js') }}"></script>
<script src="{{ asset('front/plugins/greensock/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('front/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('front/plugins/slick-1.8.0/slick.js') }}"></script>
<script src="{{ asset('front/plugins/easing/easing.js') }}"></script>
<script src="{{ asset('front/js/custom.js') }}"></script>
<script src="{{ asset('front/js/product_custom.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $("document").ready(function(){
        setTimeout(function(){
            $("div.alert").remove();
        }, 6000 );
    });
</script>
</body>

</html>
