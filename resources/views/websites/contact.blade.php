@extends('layouts.fronted_master')
@section('title', ' - Service Single Page')

@push('front_style')

@endpush

@section('front_content')



<!-- End listing Details Area -->
    <section class="listing-area mt-5">
        <div class="container" style="margin-top: 150px">

            <div class="row mb-n7">
                <div class="col-lg-6 mb-7" style="border-radius: 5px; box-shadow: 0 0 20px 3px #ce5cf63d; padding: 30px;">
                    <form id="contactForm" class="row" method="POST">
                        <!-- assets/php/contact.php -->
                        <div class="col-12 col-sm-6 mb-3">
                            <input type="text" class="form-control" style="border: 1px solid #ce5cf691; background-color: white; height: 40px;" id="name" name="name" placeholder="Your Name*" autocomplete="off"/>
                        </div>

                        <div class="col-12 col-sm-6 mb-3">
                            <input type="text" class="form-control" style="border: 1px solid #ce5cf691; background-color: white; height: 40px;" id="email" name="email" placeholder="Your Email*" autocomplete="off"/>
                        </div>

                        <div class="col-12 mb-3">
                            <textarea class="form-control massage-control" style="border: 1px solid #ce5cf691; background-color: white;" name="massage" id="massage" cols="30" rows="10" placeholder="Message" autocomplete="off"></textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button id="contactSubmit" style="color: #000; background-color: #ce5cf6; border-color: #ce5cf6; color: white;" type="submit" class="btn btn-warning btn-hover-primary">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-6 mb-7" >
                    <div class="contact-address text-center" style="border-radius: 5px; box-shadow: 0 0 20px 3px #ce5cf63d; padding: 30px;">

                        <div class="address-list pb-2">
                            <h5 class="title text-start">Office Addres</h5>
                            <p class="text-start">
                                {{ $profile->address }}
                            </p>
                        </div>
                        <!-- address-list end -->
                        <!-- address-list start -->
                        <div class="address-list pb-2">
                            <h5 class="title text-start">Phone Number</h5>
                            <p class="text-start">
                                <a class="phone-number text-start" href="tel:{{ $profile->mobile }}">
                                    {{ $profile->mobile }}
                                </a>
                            </p>
                            @if(isset($profile->mobile_second) && $profile->mobile_second != null)
                                <p class="text-start">
                                    <a class="phone-number" href="tel:{{ $profile->mobile }}">{{ $profile->mobile }}</a>
                                </p>
                            @endif
                        </div>
                        <!-- address-list end -->
                        <!-- address-list start -->
                        <div class="address-list pb-2">
                            <h5 class="title text-start">Web Address</h5>
                            <p class="text-start">
                                <a class="mailto" href="mailto:{{ $profile->email }}">{{ $profile->email }}</a>
                            </p>
                            @if(isset($profile->email_second) && $profile->email_second != null)
                                <p class="text-start">
                                    <a class="mailto" href="mailto:{{ $profile->email_second }}">{{ $profile->email_second }}</a>
                                <p>
                            @endif
                        </div>
                        <!-- address-list end -->

                         <!-- address-list start -->
                         <div class="address-list" style="border: 1px dashed #b3a9a9;margin-bottom:8px;">
                            <iframe style="width:100%;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.3280951562897!2d90.36650911429808!3d23.806929392532837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c0d6f6b8c2ff%3A0x3b138861ee9c8c30!2sMirpur%2010%20Roundabout%2C%20Dhaka%201216!5e0!3m2!1sen!2sbd!4v1674280613607!5m2!1sen!2sbd" width="555" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <!-- address-list start -->
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('front_script')
    <script>

    </script>
@endpush
