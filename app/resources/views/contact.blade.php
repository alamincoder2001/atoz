@extends("layouts.fronted_master")
@section("title", " - Home")
@section("content")
<nav class="breadcrumb-section bg-light2 section-py">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="bread-crumb-title">contact</h3>
            </div>
        </div>
    </div>
</nav>
<!-- Service Section Start -->
<section class="contact-section section-py">
    <div class="container">
        <div class="row mb-n7">
            <div class="col-lg-6 mb-7">
                <form id="contactForm" class="row" method="POST">
                    <!-- assets/php/contact.php -->
                    <div class="col-12 col-sm-6 mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name*" autocomplete="off"/>
                    </div>

                    <div class="col-12 col-sm-6 mb-3">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Your Email*" autocomplete="off"/>
                    </div>

                    <div class="col-12 mb-3">
                        <textarea class="form-control massage-control" name="massage" id="massage" cols="30" rows="10" placeholder="Message" autocomplete="off"></textarea>
                    </div>
                    <div class="col-12 text-center">
                        <button id="contactSubmit" type="submit" class="btn btn-warning btn-hover-primary">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-lg-6 mb-7">
                <div class="contact-address text-center">
                    <!-- address-list start -->
                    <div class="address-list" style="border: 1px dashed #b3a9a9;margin-bottom:8px;">
                        <iframe style="width:100%;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.3280951562897!2d90.36650911429808!3d23.806929392532837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c0d6f6b8c2ff%3A0x3b138861ee9c8c30!2sMirpur%2010%20Roundabout%2C%20Dhaka%201216!5e0!3m2!1sen!2sbd!4v1674280613607!5m2!1sen!2sbd" width="555" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <!-- address-list start -->
                    <div class="address-list">
                        <h4 class="title">Office Addres</h4>
                        <p>
                            245 Southern Street, Apartment no. 174 Central Twon, New
                            Yourk, USa
                        </p>
                    </div>
                    <!-- address-list end -->
                    <!-- address-list start -->
                    <div class="address-list">
                        <h4 class="title">Phone Number</h4>
                        <ul>
                            <li>
                                <a class="phone-number" href="tel:+12345678987">+12345 678 987</a>
                            </li>
                            <li>
                                <a class="phone-number" href="tel:+98745612321">+98745 612 321</a>
                            </li>
                        </ul>
                    </div>
                    <!-- address-list end -->
                    <!-- address-list start -->
                    <div class="address-list">
                        <h4 class="title">Web Address</h4>
                        <ul>
                            <li>
                                <a class="mailto" href="mailto:info@example.com">info@example.com</a>
                            </li>
                            <li>
                                <a class="mailto" href="mailto:www.example.com">www.example.com</a>
                            </li>
                        </ul>
                    </div>
                    <!-- address-list end -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Service Section ENd -->
@endsection