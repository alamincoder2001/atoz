<header>
    <div class="header-top d-none d-lg-block bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <p>Email: <a class="header-top-link" href="https://gmail.com/">{{$profile->email}}</a></p>
                    <p>Free Shipping for Minimum Quantity {{$profile->minimum_qty}}</p>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="header-top-nav">
                        <ul class="d-flex flex-wrap justify-content-center align-items-center justify-content-sm-end">
                            @if(Auth::guard('web')->check() || Auth::guard('technician')->check())
                            @if(Auth::guard('web')->check())
                            <li class="dropdown top-nav-item">
                                <a class="top-nav-link" href="#" role="button" id="account" data-bs-toggle="dropdown">My Account <i class="ion-ios-arrow-down"></i></a>
                                <!-- dropdown-menu start -->
                                <ul class="dropdown-menu" aria-labelledby="account">
                                    <li><a class="dropdown-item" href="{{route('customer.dashboard')}}">My Account</a></li>
                                    <li><a class="dropdown-item" href="{{route('customer.logout')}}">Sign Out</a></li>
                                </ul>
                                <!-- dropdown-menu start -->
                            </li>
                            @else
                            <li class="dropdown top-nav-item">
                                <a class="top-nav-link" href="#" role="button" id="account" data-bs-toggle="dropdown">My Account <i class="ion-ios-arrow-down"></i></a>
                                <!-- dropdown-menu start -->
                                <ul class="dropdown-menu" aria-labelledby="account">
                                    <li><a class="dropdown-item" href="{{route('technician.dashboard')}}">My Account</a></li>
                                    <li><a class="dropdown-item" href="{{route('technician.logout')}}">Sign Out</a></li>
                                </ul>
                                <!-- dropdown-menu start -->
                            </li>
                            @endif
                            @else
                            <li class="dropdown top-nav-item">
                                <a class="top-nav-link" href="{{route('showSignUpForm')}}" role="button" id="account">SignUp</a>
                                |
                                <a class="top-nav-link" href="{{route('showSignInForm')}}" role="button" id="account">SignIn</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="active-sticky" class="header-section" style="background-color:{{Auth::guard('web')->check() && Auth::guard('web')->user()->customer_type == 'Wholesale' ? $profile->bg_color : ''}};">
        <div class="container position-relative">
            <div class="row align-items-center">
                <!-- Header Logo Start -->
                <div class="col-6 col-md-3 col-md-3 col-lg-3">
                    <div class="header-logo">
                        <a href="{{route('website')}}"><img src="{{asset($profile->logo)}}" alt="Site Logo" /></a>
                    </div>
                </div>
                <!-- Header Logo End -->

                <!-- Header Menu Start -->
                <div class="col-md-6 col-lg-4 p-lg-0 p-md-0 d-none d-lg-block">
                    <form action="#">
                        <div class="input-group border">
                            <div class="input-group-text">
                                <select class="form-select d-none d-xl-block" aria-label="Default select example">
                                    <option value="0">All categories</option>
                                    <option value="12">Kitchenair</option>
                                    <option value="44">- - Knives</option>
                                    <option value="46">- - - - Baking Dishes</option>
                                    <option value="47">- - - - Ice Cream</option>
                                    <option value="48">- - - - Mandoline Slicers</option>
                                    <option value="49">- - - - Slushy Makers</option>
                                    <option value="75">Decorating Pens</option>
                                </select>

                            </div>
                            <input type="text" class="form-control border-0" placeholder="Enter your search key ... " />
                            <div class="input-group-text">
                                <button class="btn btn-hover-warning btn-primary h-100" style="border-radius: 0;" type="submit">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-6 col-md-9 col-lg-5">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav class="main-menu d-none d-lg-inline-block">
                            <ul class="d-flex">
                                <li class="main-menu-item">
                                    <a class="main-menu-link {{Route::is('website')?'text-warning':''}}" href="{{route('website')}}">Home</a>
                                </li>
                                <li class="position-static main-menu-item">
                                    <a class="main-menu-link {{Route::is('product')?'text-warning':''}}" href="{{route('product')}}">Product</a>
                                </li>
                                <li class="position-static main-menu-item">
                                    <a class="main-menu-link {{Route::is('technician')?'text-warning':''}}" href="{{route('technician')}}">Technician</a>
                                </li>
                                <li class="main-menu-item">
                                    <a class="main-menu-link {{Route::is('blog')?'text-warning':''}}" href="{{route('blog')}}">Blog</a>
                                </li>
                                <li class="main-menu-item">
                                    <a class="main-menu-link {{Route::is('contact')?'text-warning':''}}" href="{{route('contact')}}">Contact</a>
                                </li>
                            </ul>
                        </nav>
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="block-cart-btn-wrapp">
                                <button class="cart-action bg-primary">
                                    <span class="lnr lnr-cart"></span>
                                    <span class="badge bg-dark cartTotalCount">{{\Cart::content()->count()}}</span>
                                </button>

                                <div class="checkout-cart">
                                    <ul class="checkout-scroll">
                                        @if(\Cart::content()->count() > 0)
                                        @foreach(\Cart::content() as $item)
                                        <li class="checkout-cart-list product-cart-remove-{{$item->rowId}}">
                                            <div class="checkout-img">
                                                <img class="product-image" src="{{asset($item->options->image != null ? $item->options->image : '/no-product-image.jpg')}}" alt="img" />
                                                <span class="product-quantity"><label>{{$item->qty}}</label>x</span>
                                            </div>
                                            <div class="checkout-block">
                                                <a class="product-name" href="{{route('product')}}">{{$item->name}}</a>
                                                <span class="product-price">৳ {{ $item->price }}</span>
                                                <a class="remove-cart" row-id="{{$item->rowId}}" onclick="removeCart(event)">
                                                    x
                                                </a>
                                            </div>
                                        </li>
                                        @endforeach
                                        @else
                                        <li class="checkout-cart-list">
                                            <div class="p-4 w-100 text-center">
                                                <img src="{{asset('emptycart.png')}}" width="150">
                                            </div>
                                        </li>
                                        @endif
                                    </ul>

                                    <ul class="list-group checkout-sub-total">
                                        <li class="list-group-item">
                                            <span>Subtotal</span>
                                            <span class="subTotal">৳ <label>{{\Cart::subtotal()}}</label></span>
                                        </li>
                                        <li class="list-group-item">
                                            <span>Total</span>
                                            <span class="Total">৳ <label>{{\Cart::subtotal()}}</label></span>
                                        </li>
                                    </ul>

                                    <!-- checkout-action button start -->
                                    <div class="checkout-action d-flex justify-content-center gap-3">
                                        <a href="{{route('checkout')}}"  class="btn btn-warning btn-hover-primary btn-lg px-5">Checkout</a>
                                        <a href="{{route('cart')}}"  class="btn btn-primary btn-hover-warning btn-lg px-5">View Cart</a>
                                    </div>
                                    <!-- checkout-action button end -->
                                </div>

                            </div>
                            <button class="toggle" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <span class="icon-top"></span>
                                <span class="icon-middle"></span>
                                <span class="icon-bottom"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Header Menu End -->
            </div>
        </div>
    </div>
</header>