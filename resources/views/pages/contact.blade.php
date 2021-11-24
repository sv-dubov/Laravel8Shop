@extends('layouts.app')

@section('content')

    @include('layouts.menubar')

    <link rel="stylesheet" type="text/css" href="{{ asset('front/styles/contact_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/styles/contact_responsive.css') }}">

    <!-- Contact Info -->
    <div class="contact_info">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">
                        <!-- Contact Item -->
                        <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                            <div class="contact_info_image"><img src="{{ asset('front/images/contact_1.png')}}" alt=""></div>
                            <div class="contact_info_content">
                                <div class="contact_info_title">Our phone</div>
                                <div class="contact_info_text">{{ $info->phone_one }}</div>
                            </div>
                        </div>
                        <!-- Contact Item -->
                        <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                            <div class="contact_info_image"><img src="{{ asset('front/images/contact_2.png')}}" alt=""></div>
                            <div class="contact_info_content">
                                <div class="contact_info_title">Our e-mail</div>
                                <div class="contact_info_text">{{ $info->email }}</div>
                            </div>
                        </div>
                        <!-- Contact Item -->
                        <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                            <div class="contact_info_image"><img src="{{ asset('front/images/contact_3.png')}}" alt=""></div>
                            <div class="contact_info_content">
                                <div class="contact_info_title">Our address</div>
                                <div class="contact_info_text">{{ $info->company_address }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form -->
    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="contact_form_container">
                        <div class="contact_form_title">Get in Touch</div>
                        <form method="post" action="{{ route('contact.form') }}" id="contact_form">
                            @csrf
                            <div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
                                <input type="text" id="contact_form_name" class="contact_form_name input_field" placeholder="*Your name" value="{{ old('name') }}" data-error="Name is required" name="name" required>
                                <input type="email" id="contact_form_email" class="contact_form_email input_field" placeholder="*Your e-mail" value="{{ old('email') }}" data-error="E-mail is required" name="email" required>
                                <input type="text" id="contact_form_phone" class="contact_form_phone input_field" placeholder="Your phone number" value="{{ old('phone') }}" name="phone">
                            </div>
                            <div class="contact_form_text">
                                <textarea id="contact_form_message" class="text_field contact_form_message" name="message" rows="4" placeholder="*Your message" data-error="Please, write us a message" required>{{ old('message') }}</textarea>
                            </div>
                            <div class="contact_form_button text-center">
                                <button type="submit" class="button contact_submit_button">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel"></div>
    </div>

    <script src="{{ asset('front/js/contact_custom.js') }}"></script>

@endsection
