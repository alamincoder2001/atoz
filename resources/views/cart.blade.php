@extends("layouts.fronted_master")
@section("title", " - Cart Page")
@section("content")
<nav class="breadcrumb-section section-py bg-light2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="bread-crumb-title">Cart Page</h3>
            </div>
        </div>
    </div>
</nav>

<section class="whish-list-section section-py" style="padding: 15px 0 !important;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="title text-capitalize">Your cart items</h3>
                <div class="table-responsive cartTable">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col"></th>
                                <th class="text-center" scope="col">Service Image</th>
                                <th class="text-center" scope="col">Service Name</th>
                                <th class="text-center" scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @if(\Cart::content()->count() > 0)
                            @foreach(\Cart::content() as $item)
                            <tr class="{{$item->rowId}}">
                                <td>{{$i++}}</td>
                                <th class="text-center" scope="row">
                                    <img src="{{asset($item->options->image != null ? $item->options->image : '/no-product-image.jpg')}}" width="55" alt="img">
                                </th>
                                <td class="text-center">
                                    <span class="whish-title">{{$item->name}}</span>
                                </td>
                                <td class="text-center">
                                    <a onclick="cartDelete('{{$item->rowId}}')" style="cursor: pointer;background: red;padding: 4px 7px;border-radius: 50%;color: white;font-weight: 600;"><span>X</span></a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" class="text-center">
                                    <img src="{{asset('emptycart.png')}}" width="150">
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="check-out-section section-pb">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <a href="{{route('service')}}" class="btn btn-warning text-white d-block">Continue to Shopping</a>
            </div>
            <div class="col-lg-5 mt-4 mt-lg-0">
                <div class="your-order-area">
                    <!-- <div class="your-order-wrap gray-bg-4">
                        <div class="your-order-product-info">
                            <div class="your-order-bottom">
                                <ul>
                                    <li class="your-order-shipping">SubTotal</li>
                                    <li>৳ <span class="cartSubTotal">{{\Cart::subtotal()}}</span></li>
                                </ul>
                            </div>
                            <div class="your-order-total mb-0">
                                <ul>
                                    <li class="order-total">Total</li>
                                    <li>৳ <span class="cartTotal">{{\Cart::subtotal()}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
                    <div class="Place-order mt-2 text-end">
                        <a class="btn btn-primary btn-hover-warning text-capitalize my-2 my-sm-0" href="{{route('checkout')}}">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push("webjs")
<script>
    function cartUpdate(event,id) {
        let cartUnitprice = $("."+id).find(".cartUnitprice label").text()
        let qty = $(".cartQty-" + id).val();
        if (event.target.className == 'count-btn increment' || event.target.className == 'lnr lnr-chevron-up') {
            qty = +qty + 1;
        }else{
            if(qty > 1){
                qty -= 1;
            }
        }
        let cartTotalPrice = qty * parseFloat(cartUnitprice)
        $("."+id).find(".cartUnitTotalPrice label").text(cartTotalPrice)
        $(".product-cart-remove-"+id).find('.product-quantity label').text(qty)
        $.ajax({
            url: location.origin + "/updatecart",
            method: "POST",
            dataType: "JSON",
            data: {
                rowId: id,
                quantity: qty
            },
            success: res => {
                //calculate total
                $(".subTotal label").text(res.subtotal)
                $(".Total label").text(res.subtotal)
                $(".cartTotalCount").text(res.cartCount)

                $(".cartTotal").text(res.subtotal)
                $(".cartSubTotal").text(res.subtotal)
            }
        })
    }

    function cartDelete(id) {
        $.ajax({
            url: location.origin + "/removecart",
            method: "POST",
            dataType: "JSON",
            data: {
                rowId: id
            },
            success: res => {
                $.notify(res.msg, "success");
                $("." + id).remove()
                $(".product-cart-remove-"+id).remove()

                //calculate total
                $(".subTotal label").text(res.subtotal)
                $(".Total label").text(res.subtotal)
                $(".cartTotalCount").text(res.cartCount)

                $(".cartTotal").text(res.subtotal)
                $(".cartSubTotal").text(res.subtotal)

                if (res.cartCount == 0) {
                    let row = `
                        <li class="checkout-cart-list">
                            <div class="p-4 w-100 text-center">
                                <img src="${location.origin+"/emptycart.png"}" width="150">
                            </div>
                        </li>
                    `;
                    $(".checkout-scroll").html(row);

                    let row1 = `
                            <tr>
                                <td colspan="7" class="text-center">
                                    <img src="${location.origin+"/emptycart.png"}" width="150">
                                </td>
                            </tr>                          
                        `;

                    $(".cartTable tbody").html(row1)
                }
            }
        })
    }
</script>
@endpush