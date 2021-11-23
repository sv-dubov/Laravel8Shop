<!-- Footer -->

<footer class="footer">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 footer_col">
                <div class="footer_column footer_contact">
                    <div class="logo_container">
                        <div class="logo"><a href="{{ url('/') }}">{{ $siteInfo->company_name }}</a></div>
                    </div>
                    <div class="footer_title">Got Question? Call Us 24/7</div>
                    <div class="footer_phone">{{ $siteInfo->phone_two }}</div>
                    <div class="footer_contact_text">
                        <p>{{ $siteInfo->company_address }}</p>
                    </div>
                    <div class="footer_social">
                        <ul>
                            @if($siteInfo->facebook != null)
                                <li><a href="{{ $siteInfo->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                            @endif
                            @if($siteInfo->twitter != null)
                                <li><a href="{{ $siteInfo->twitter }}"><i class="fab fa-twitter"></i></a></li>
                            @endif
                            @if($siteInfo->youtube != null)
                                <li><a href="{{ $siteInfo->youtube }}"><i class="fab fa-youtube"></i></a></li>
                            @endif
                            @if($siteInfo->instagram != null)
                                <li><a href="{{ $siteInfo->instagram }}"><i class="fab fa-instagram"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 offset-lg-2">
                <div class="footer_column">
                    <div class="footer_title">Find it Fast</div>
                    <ul class="footer_list">
                        @foreach($childrenCategoriesOne as $child)
                            <li><a href="#">{{$child->category_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="footer_column">
                    <ul class="footer_list footer_list_2">
                        @foreach($childrenCategoriesTwo as $child)
                            <li><a href="#">{{$child->category_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="footer_column">
                    <div class="footer_title">Customer Care</div>
                    <ul class="footer_list">
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Order Tracking</a></li>
                        <li><a href="#">Wish List</a></li>
                        <li><a href="#">Customer Services</a></li>
                        <li><a href="#">Returns / Exchange</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Product Support</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</footer>

<!-- Copyright -->

<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                    <div class="copyright_content"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                    <div class="logos ml-sm-auto">
                        <ul class="logos_list">
                            <li><a href="#"><img src="{{ asset('front/images/logos_1.png')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('front/images/logos_2.png')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('front/images/logos_3.png')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('front/images/logos_4.png')}}" alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
