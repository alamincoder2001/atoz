<script src="{{asset('frontend')}}/assets/js/vendor/vendor.min.js"></script>
<script src="{{asset('frontend')}}/assets/js/plugins/plugins.min.js"></script>
<script src="{{asset('frontend')}}/assets/js/notify.js"></script>
<script src="{{asset('frontend')}}/assets/js/main.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function addCart(id, wishlist = null) {
        $.ajax({
            url: location.origin + "/addcart",
            method: "POST",
            dataType: "JSON",
            data: {
                id: id,
                quantity: 1
            },
            beforeSend: () => {
                $(".checkout-scroll").html("")
                $(".cartImage").removeClass("d-none")
            },
            success: res => {
                if (res.status) {
                    $.notify(res.msg, "success");
                } else {
                    $.notify(res.msg, "error");
                }
                $.each(res.content, (index, value) => {
                    let row = `
                        <li class="checkout-cart-list">
                            <div class="checkout-img">
                                <img class="product-image" src="${value.options.image != null ? location.origin+"/"+value.options.image: location.origin+'/no-product-image.jpg'}" alt="img" />
                                <span class="product-quantity">${value.qty}x</span>
                            </div>
                            <div class="checkout-block">
                                <a class="product-name" href="{{route('service')}}">${value.name}</a>
                                <!--<span class="product-price">৳ ${value.price}</span>-->
                                <a class="remove-cart" row-id="${value.rowId}" onclick="removeCart(event)">
                                    x
                                </a>
                            </div>
                        </li>
                    `;
                    $(".checkout-scroll").append(row)
                })

                // total calculate
                $(".subTotal label").text(res.subtotal)
                $(".Total label").text(res.subtotal)
                $(".cartTotalCount").text(res.cartCount)

                if (wishlist != null) {
                    $.ajax({
                        url: location.origin + "/deletewishlist",
                        method: "POST",
                        data: {
                            service_id: id
                        },
                        success: res => {
                            $(".wishlist-" + id).remove();
                            if (res.content == 0) {
                                let row = `
                            <tr>
                                <td colspan="6" class="text-center">
                                    Service Not Found
                                </td>
                            </tr>
                            `;
                                $("#wishlistTable").find("table tbody").html(row)
                            }

                        }
                    })
                }
            },
            complete: () => {
                setTimeout(() => {
                    $(".cartImage").addClass("d-none")
                }, 500)
            }
        })
    }

    function removeCart(event) {
        event.preventDefault();

        $.ajax({
            url: location.origin + "/removecart",
            method: "POST",
            dataType: "JSON",
            data: {
                rowId: event.target.getAttribute("row-id")
            },
            success: res => {
                $.notify(res.msg, "success");
                event.target.offsetParent.parentElement.remove()
                $("." + event.target.getAttribute("row-id")).remove()
                //calculate total
                $(".subTotal label").text(res.subtotal)
                $(".Total label").text(res.subtotal)
                $(".cartTotalCount").text(res.cartCount)

                // cart total
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

    // add wishlist
    function addWishlist(id) {
        $.ajax({
            url: location.origin + "/addwishlist",
            method: "POST",
            data: {
                id: id
            },
            success: res => {
                if (res.login) {
                    $.notify(res.login, "success")
                    setTimeout(() => {
                        location.href = "/login"
                    }, 500)
                } else {
                    $.notify(res.msg, res.status)
                }
            }
        })
    }

    // search product
    async function SearchProduct(event) {
        event.preventDefault();
        let serviceName;
        if (event.target.id == 'serviceName') {
            serviceName = event.target.value;
        } else {
            serviceName = $("#serviceName").val();
        }
        if (serviceName != '') {
            await $.ajax({
                url: "/search/service",
                method: "POST",
                dataType: "JSON",
                data: {
                    serviceName: serviceName
                },
                success: res => {
                    $(".serviceShow ul").html('');
                    $(".serviceShow").removeClass('d-none');
                    if (res.length > 0) {
                        $.each(res, (index, value) => {
                            let row = `
                                    <li>
                                        <a href="/service-single/${value.slug}" class="text-white d-flex align-items-center gap-2 mb-1">
                                            <img src="${value.image ? value.image :'/noImage.jpg'}" width="30">
                                            <span>${value.name}</span>                                        
                                        </a>
                                    </li>
                            `;
                            $(".serviceShow ul").append(row);
                        })
                    } else {
                        $(".serviceShow ul").html(`<li class="text-white text-center">Not Found Product</li>`);
                    }
                }
            })
        } else {
            $(".serviceShow").addClass('d-none');
        }
    }
</script>
@stack('webjs')