@extends('layouts.app')

@section('content')

    @include('layouts.menubar')

    <link rel="stylesheet" type="text/css" href="{{ asset('front/styles/cart_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/styles/cart_responsive.css') }}">

    <!-- Cart -->
    <div class="cart_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart_container">
                        <div class="cart_title">Order's products details</div>
                        <div class="cart_items">
                            <ul class="cart_list">
                                @foreach($details as $detail)
                                    <li class="cart_item clearfix">
                                        <div class="cart_item_image text-center"><br>
                                            <img src="{{ URL::to($detail->product->image_one) }}" style="height: 90px; width: 70px;" alt="">
                                        </div>
                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title">Name</div>
                                                <div class="cart_item_text">{{ $detail->product_name }}</div>
                                            </div>
                                            @if($detail->color == null)
                                            @else
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title">Color</div>
                                                    <div class="cart_item_text"> {{ $detail->color }}</div>
                                                </div>
                                            @endif
                                            @if($detail->size == null)
                                            @else
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title">Size</div>
                                                    <div class="cart_item_text"> {{ $detail->size }}</div>
                                                </div>
                                            @endif
                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title">Quantity</div>
                                                <div class="cart_item_text"> {{ $detail->quantity }}</div>
                                            </div>
                                            <div class="cart_item_price cart_info_col">
                                                <div class="cart_item_title">Price (per item)</div>
                                                <div class="cart_item_text">${{ $detail->single_price }}</div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="cart_buttons">
                            <a href="{{ route('dashboard') }}"  class="button cart_button_checkout">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('front/js/cart_custom.js') }}"></script>

@endsection
