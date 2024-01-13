@extends('layouts.fronted_master')
@section('title', ' - Service Single Page')

@push('front_style')
    <style>
        #customScrol {
            zoom: 0.9;
            scroll-behavior: smooth;
        }
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #ffffff;
            border-right: 5px solid #cf58f6;
            font-weight: 700;
        }

        /* service card */
        .single-listing-item .listing-image .listing-tag a {
            color: #b654f1;
        }

        .single-listing-item .listing-image .listing-tag:hover {
            background-color: #863ed2 !important;
        }

        .single-listing-item:hover .listing-image .listing-tag,
        .single-listing-item:focus .listing-image .listing-tag {
            background-color: #863ed2 !important;
        }
        /* .page-title-area { position: relative; z-index: 1; padding-top: 95px; padding-bottom: 0; background-color: #742f8d; } */
        .breadcame{display: flex; justify-content: flex-start; margin: -147px 0 0 -80px;}
        .list-style{list-style: square; font-size: 17px; color: #6001ff !important;}

        /* price card */
        #element{position:fixed;bottom:0;right: 0; border: 1px solid #d75efb45;box-shadow: -12px 0px 20px 5px #d75efb1c;}
        /* card-btn */
        .default-btn { background-color: #a755f7 !important; color: #ffffff; }
        .default-btn:hover {background-color: #6001ff !important; }
    </style>
@endpush

@section('front_content')
    <!-- Start Page Title Area -->
    {{-- <section class="page-title-area" style="background-image: url({{ asset('frontend/assets/img/laptopservicing.jpg') }})"> --}}
    <section class="page-title-area" style="background-image: url({{ asset(''.$service->image) }})">
        <div class="container">
            <ul class="breadcame">
                <li class="list-style">
                    <a href="{{ url('/') }}" class="text-white">Home</a>
                </li>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <li class="list-style">
                    <a href="" class="text-white">@if(isset($service->category->name)) {{ $service->category->name }} @endif</a>
                </li>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <li class="list-style">
                    <a href="javascript:void(0)" class="text-white" >{{ $service->name }}</a>
                </li>
            </ul>
            <div class="page-title-content">
                <h2 style="line-height: 1.14; letter-spacing: .5px; color: #fff; margin-bottom: 17px;">{{ $service->name }}</h2>

                {{-- <span class="text-white mt-3" style="border: 1px solid #bb54fa;padding: 10px;background-color: #bb54fa;border-radius: 3px;">
                    <i class='bx bxs-star' style="color: #fff !important;font-size:17px"></i> 4.5 out of 5
                </span>
                <br>
                <span class="reviews-total mt-3 d-inline-block text-white">
                    (2 reviews)
                </span> --}}
            </div>
        </div>
    </section>
    <!-- End Page Title Area -->

{{-- {{ dd(request()->url()) }} --}}

<!-- End listing Details Area -->
    <section class="listing-area mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3" style="border-right: 1px solid #d75efb45;box-shadow: 5px 0px 7px 0px #d75efb1c;">
                    {{-- <div style="position: fixed; padding-top: 15px;"> --}}
                    <div>
                        <nav id="service-all" class="navbar navbar-light bg-light">
                            <nav class="nav nav-pills flex-column">
                                <a class="nav-link fw-bold active" href="#overview">Service</a>
                                {{-- <a class="nav-link fw-bold ser_faq_txt" onclick="serviceActive('faq')" href="#faq">FAQ</a>
                                <a class="nav-link fw-bold ser_details_txt" onclick="serviceActive('details')" href="#details">Details</a> --}}
                                {{-- <a class="nav-link fw-bold ser_review_txt" onclick="serviceActive('review')" href="#review">Review</a> --}}
                            </nav>
                        </nav>
                    </div>
                </div>

                <div class="col-md-9 col-lg-9 col-xl-9 col-xxl-9" id="customScrol">

                    <div data-bs-spy="scroll" data-bs-target="#service-all" data-bs-offset="0" tabindex="0">

                        <section class="listing-area">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-9 col-md-12">
                                        <div class="listing-details-desc" id="overview">
                                            <h3 class="text-capitalize mb-3" style="margin-bottom: 25px !important; color: #7b3edb;">Overview Of {{ $service->name }} </h3>
                                            {!! $service->description !!}
                                        </div>

                                        {{-- <div class="listing-details-desc" id="faq">
                                            <div class="container">
                                                <h3>FAQ</h3>
                                                <div class="tab faq-accordion-tab">

                                                    <div class="tab-content">
                                                        <div class="tabs-item">
                                                            <div class="faq-accordion">
                                                                <ul class="accordion">
                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title active" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What shipping methods are available?
                                                                        </a>

                                                                        <div class="accordion-content show">
                                                                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What are shipping times and costs?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What payment methods can I use?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <ul>
                                                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                                                                <li>Comero features a Fast Checkout option, allowing you to securely save your credit card details so that you don't have to re-enter them for future purchases.</li>
                                                                                <li>PayPal: Shop easily online without having to enter your credit card details on the website. Your account will be charged once the order is completed. To register for a PayPal account, visit the website paypal.com.</li>
                                                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            Can I use my own domain name?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <p>Absolutely! Simply point your domain directly to your new Evel. You do not need to use a subdomain or any other temporary domain name placeholder.</p>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What kind of customer service do you offer?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <p>Our ecommerce consultants are here to answer your questions. In addition to FREE phone support, you can contact our consultants via email or live chat.</p>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="tabs-item">
                                                            <div class="faq-accordion">
                                                                <ul class="accordion">
                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title active" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What shipping methods are available?
                                                                        </a>

                                                                        <div class="accordion-content show">
                                                                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What are shipping times and costs?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What payment methods can I use?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <ul>
                                                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                                                                <li>Comero features a Fast Checkout option, allowing you to securely save your credit card details so that you don't have to re-enter them for future purchases.</li>
                                                                                <li>PayPal: Shop easily online without having to enter your credit card details on the website. Your account will be charged once the order is completed. To register for a PayPal account, visit the website paypal.com.</li>
                                                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            Can I use my own domain name?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <p>Absolutely! Simply point your domain directly to your new Evel. You do not need to use a subdomain or any other temporary domain name placeholder.</p>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What kind of customer service do you offer?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <p>Our ecommerce consultants are here to answer your questions. In addition to FREE phone support, you can contact our consultants via email or live chat.</p>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="tabs-item">
                                                            <div class="faq-accordion">
                                                                <ul class="accordion">
                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title active" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What shipping methods are available?
                                                                        </a>

                                                                        <div class="accordion-content show">
                                                                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What are shipping times and costs?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What payment methods can I use?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <ul>
                                                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                                                                <li>Comero features a Fast Checkout option, allowing you to securely save your credit card details so that you don't have to re-enter them for future purchases.</li>
                                                                                <li>PayPal: Shop easily online without having to enter your credit card details on the website. Your account will be charged once the order is completed. To register for a PayPal account, visit the website paypal.com.</li>
                                                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            Can I use my own domain name?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <p>Absolutely! Simply point your domain directly to your new Evel. You do not need to use a subdomain or any other temporary domain name placeholder.</p>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What kind of customer service do you offer?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <p>Our ecommerce consultants are here to answer your questions. In addition to FREE phone support, you can contact our consultants via email or live chat.</p>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="tabs-item">
                                                            <div class="faq-accordion">
                                                                <ul class="accordion">
                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title active" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What shipping methods are available?
                                                                        </a>

                                                                        <div class="accordion-content show">
                                                                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What are shipping times and costs?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What payment methods can I use?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <ul>
                                                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                                                                <li>Comero features a Fast Checkout option, allowing you to securely save your credit card details so that you don't have to re-enter them for future purchases.</li>
                                                                                <li>PayPal: Shop easily online without having to enter your credit card details on the website. Your account will be charged once the order is completed. To register for a PayPal account, visit the website paypal.com.</li>
                                                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            Can I use my own domain name?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <p>Absolutely! Simply point your domain directly to your new Evel. You do not need to use a subdomain or any other temporary domain name placeholder.</p>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What kind of customer service do you offer?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <p>Our ecommerce consultants are here to answer your questions. In addition to FREE phone support, you can contact our consultants via email or live chat.</p>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="tabs-item">
                                                            <div class="faq-accordion">
                                                                <ul class="accordion">
                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title active" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What shipping methods are available?
                                                                        </a>

                                                                        <div class="accordion-content show">
                                                                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What are shipping times and costs?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What payment methods can I use?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <ul>
                                                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                                                                <li>Comero features a Fast Checkout option, allowing you to securely save your credit card details so that you don't have to re-enter them for future purchases.</li>
                                                                                <li>PayPal: Shop easily online without having to enter your credit card details on the website. Your account will be charged once the order is completed. To register for a PayPal account, visit the website paypal.com.</li>
                                                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            Can I use my own domain name?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <p>Absolutely! Simply point your domain directly to your new Evel. You do not need to use a subdomain or any other temporary domain name placeholder.</p>
                                                                        </div>
                                                                    </li>

                                                                    <li class="accordion-item">
                                                                        <a class="accordion-title" href="javascript:void(0)">
                                                                            <i class="bx bx-chevron-down"></i>
                                                                            What kind of customer service do you offer?
                                                                        </a>

                                                                        <div class="accordion-content">
                                                                            <p>Our ecommerce consultants are here to answer your questions. In addition to FREE phone support, you can contact our consultants via email or live chat.</p>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="description-features-list">
                                                <li>Feasibility and Economic Studies</li>
                                                <li>Design Coordination</li>
                                                <li>Pro Forma Financial Analysis</li>
                                                <li>Scheduling</li>
                                                <li>Contact Cegotiation</li>
                                            </ul>
                                            <ul class="description-features-list">
                                                <li>Feasibility and Economic Studies</li>
                                                <li>Design Coordination</li>
                                                <li>Pro Forma Financial Analysis</li>
                                                <li>Scheduling</li>
                                                <li>Contact Cegotiation</li>
                                            </ul>
                                            <ul class="description-features-list">
                                                <li>Feasibility and Economic Studies</li>
                                                <li>Design Coordination</li>
                                                <li>Pro Forma Financial Analysis</li>
                                                <li>Scheduling</li>
                                                <li>Contact Cegotiation</li>
                                            </ul>
                                        </div>

                                        <div class="listing-details-desc" id="details">
                                            <h3>Description</h3>
                                            <p><strong>Hi! Welcome to Certified Graphic Design with Free Project Course, the only course you need to become a BI Analyst.</strong></p>
                                            <p>We are proud to present you this one-of-a-kind opportunity. There are several online listing teaching some of the skills related to the BI Analyst profession. The truth of the matter is that none of them completely prepare you.</p>

                                            <ul class="description-features-list">
                                                <li>Feasibility and Economic Studies</li>
                                                <li>Design Coordination</li>
                                                <li>Pro Forma Financial Analysis</li>
                                                <li>Scheduling</li>
                                                <li>Contact Cegotiation</li>
                                            </ul>
                                            <h3>Description</h3>
                                            <p><strong>Hi! Welcome to Certified Graphic Design with Free Project Course, the only course you need to become a BI Analyst.</strong></p>
                                            <p>We are proud to present you this one-of-a-kind opportunity. There are several online listing teaching some of the skills related to the BI Analyst profession. The truth of the matter is that none of them completely prepare you.</p>

                                            <ul class="description-features-list">
                                                <li>Feasibility and Economic Studies</li>
                                                <li>Design Coordination</li>
                                                <li>Pro Forma Financial Analysis</li>
                                                <li>Scheduling</li>
                                                <li>Contact Cegotiation</li>
                                            </ul>
                                            <h3>Description</h3>
                                            <p><strong>Hi! Welcome to Certified Graphic Design with Free Project Course, the only course you need to become a BI Analyst.</strong></p>
                                            <p>We are proud to present you this one-of-a-kind opportunity. There are several online listing teaching some of the skills related to the BI Analyst profession. The truth of the matter is that none of them completely prepare you.</p>

                                            <ul class="description-features-list">
                                                <li>Feasibility and Economic Studies</li>
                                                <li>Design Coordination</li>
                                                <li>Pro Forma Financial Analysis</li>
                                                <li>Scheduling</li>
                                                <li>Contact Cegotiation</li>
                                            </ul>
                                            <h3>Description</h3>
                                            <p><strong>Hi! Welcome to Certified Graphic Design with Free Project Course, the only course you need to become a BI Analyst.</strong></p>
                                            <p>We are proud to present you this one-of-a-kind opportunity. There are several online listing teaching some of the skills related to the BI Analyst profession. The truth of the matter is that none of them completely prepare you.</p>

                                            <ul class="description-features-list">
                                                <li>Feasibility and Economic Studies</li>
                                                <li>Design Coordination</li>
                                                <li>Pro Forma Financial Analysis</li>
                                                <li>Scheduling</li>
                                                <li>Contact Cegotiation</li>
                                            </ul>
                                        </div> --}}

                                        {{-- <div class="listing-details-desc" id="review">
                                            <div class="listing-review-comments">
                                                <h3>3 Reviews</h3>

                                                <div class="user-review">
                                                    <img src="{{ asset('frontend/assets/img/user1.jpg') }}" alt="image">

                                                    <div class="review-rating">
                                                        <div class="review-stars">
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                        </div>

                                                        <span class="d-inline-block">James Anderson</span>
                                                    </div>

                                                    <span class="d-block sub-comment">Excellent</span>
                                                    <p>Very well built theme, couldn't be happier with it. Can't wait for future updates to see what else they add in.</p>
                                                </div>

                                                <div class="user-review">
                                                    <img src="{{ asset('frontend/assets/img/user2.jpg') }}" alt="image">

                                                    <div class="review-rating">
                                                        <div class="review-stars">
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                        </div>

                                                        <span class="d-inline-block">Sarah Taylor</span>
                                                    </div>

                                                    <span class="d-block sub-comment">Video Quality!</span>
                                                    <p>Was really easy to implement and they quickly answer my additional questions!</p>
                                                </div>

                                                <div class="user-review">
                                                    <img src="{{ asset('frontend/assets/img/user3.jpg') }}" alt="image">

                                                    <div class="review-rating">
                                                        <div class="review-stars">
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                        </div>

                                                        <span class="d-inline-block">David Warner</span>
                                                    </div>

                                                    <span class="d-block sub-comment">Perfect Coding!</span>
                                                    <p>Stunning design, very dedicated crew who welcome new ideas suggested by customers, nice support.</p>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="col-lg-3"> </div>
                                </div>
                            </div>
                        </section>

                    </div>

                </div>
            </div>

            <div class="card" id="element">
                <div class="card-body">
                    <h3>{{ $service->name }}</h3>
                    <div class="listing-details-header">
                        <div class="align-items-center">
                            <div class="listing-price">
                                {{-- <div class="listing-review">
                                    <div class="review-stars">
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                    </div>
                                    <span class="reviews-total d-inline-block">(2 reviews)</span>
                                </div> --}}

                                <ul class="list-group list-group-flush border-0">
                                    {{-- <li class="list-group-item">
                                        <a href="javascript:void(0)" onclick="cartModal('AC Installation')">
                                            <span style="float: left; color:rgba(0,0,0,.9)">AC Installation</span>
                                            <i class="bx bx-chevron-right" style="font-size: 25px;font-weight: bold;float: right;"></i>
                                        </a>
                                    </li> --}}
                                    <li class="list-group-item mt-1 border-0">
                                        @auth
                                            <a href="javascript:void(0)" onclick="orderNow({{ $service->id }})" class="btn btn-sm btn-success">
                                                <span style="">Order Now</span>
                                                <i class="bx bx-chevron-right" style="font-size: 25px;font-weight: bold;float: right;"></i>
                                            </a>
                                            @else
                                            <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="showLoginRegisterOption()">
                                                <span style="">Order Now</span>
                                                <i class="bx bx-chevron-right" style="font-size: 25px;font-weight: bold;float: right;"></i>
                                            </a>
                                        @endauth
                                    </li>
                                </ul>

                                {{-- <div class="price" style="color:#a755f7">৳ 399</div>
                                <a href="javascript:void(0)" class="default-btn">Order Now!</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('front_script')
    <script>
        function serviceActive(name)
        {
            $('.ser_faq_txt').removeClass('active');
            $('.ser_review_txt').removeClass('active');
            $('.ser_details_txt').removeClass('active');

            $('.ser_'+name+'_txt').addClass('active');
        }
    </script>
@endpush
