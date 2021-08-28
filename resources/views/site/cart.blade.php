@extends('layouts.site')

@section('content')
    <div class="breadcrumbs">
        <a href="index.html">Home</a>
        <span class="divider">|</span>
        <span>Shopping Cart</span>
    </div>
    <h1 class="page_title">
        shopping cart
    </h1>
    <div class="container cart">
        <div class="cart__top">
            <div class="cart__steps d-flex align-center">
                <div class="cart__step active">1 -   Shopping Cart</div>
                <div class="cart__arrow">
                    <img src="{{ asset('img/svg/step_arrow_active.svg') }}" width="100%" alt="">
                </div>
                <div class="cart__step">2 -   Shipping</div>
                <div class="cart__arrow">
                    <img src="{{ asset('img/svg/step_arrow.svg') }}" width="100%" alt="">
                </div>
                <div class="cart__step">3 -   Payment method</div>
            </div>
            <div class="cart__clear" id="clear_cart">
                Clear all
            </div>
        </div>
        <div class="cart__body">
            <div class="cart__left">
                <div class="cart__left_titles">
                    <div class="cart__left_title cart__left_size product">Products</div>
                    <div class="cart__left_title cart__left_size price">price</div>
                    <div class="cart__left_title cart__left_size total">total</div>
                </div>
                <div class="cart__left_products">
                    @php
                        $subTotal = 0;
                    @endphp
                     @foreach($carts as $cart)
                        <div class="cart__left_product d-flex" id="cart-item-{!! $cart->id !!}">
                            <div class="cart__left_product_body d-flex cart__left_size product">
                                <div class="cart__left_product_image">
                                    @if($cart->product)
                                    <img src="/storage/images/{{ (isset($cart->product->product_images) && count($cart->product->product_images)) ?  $cart->product->product_images[0]['image'] : ''}}" width="100%" height="200px" alt="">
{{--                                    <img src="/storage/images/{{ $cart->product->images }}" width="100%" alt="">--}}
                                    @endif
                                </div>
                                <div class="cart__left_product_info">
                                    @if($cart->product)
                                        <div class="cart__left_product_top">
                                            <div class="cart__left_product_name">{{ $cart->product->name  }}</div>
                                            <div class="cart__left_product_size">{{ $cart->product->unit_value }} {{ $cart->product->unit_type }}</div><div class="cart__left_product_counter">
                                                <button class="minus change-qty" data-opt-type="subtract" data-id="{!! $cart->id !!}">-</button>
                                                <output class="count">{{ $cart->quantity }}</output>
                                                <button class="plus change-qty" data-opt-type="add" data-id="{!! $cart->id !!}">+</button>
                                            </div>
                                        </div>

                                        <div class="cart__left_product_bottom">
                                            <div data-id="{!! $cart->id !!}" data-rating="{!! $cart->product['rating'] !!}" data-price="{!! number_format($cart->price, 2) !!}" data-name="{!! $cart->product->name !!}" data-src="/storage/images/{{ (isset($cart->product->product_images) && count($cart->product->product_images)) ?  $cart->product->product_images[0]['image'] : ''}}" class="cart__left_product_remove remove_product_button">remove</div>
                                        </div>
                                    @else
                                        <div class="cart__left_product_top">
                                            <div class="cart__left_product_name">Gift Certificate</div>
                                            <div class="cart__left_product_size">${{ $cart->price }}</div>
                                            <div class="cart__left_product_counter">
{{--                                                <button class="minus change-qty" data-opt-type="subtract" data-id="{!! $cart->id !!}">-</button>--}}
                                                <output class="count">{{ $cart->quantity }}</output>
{{--                                                <button class="plus change-qty" data-opt-type="add" data-id="{!! $cart->id !!}">+</button>--}}
                                            </div>
                                        </div>

                                        <div class="cart__left_product_bottom">
                                            <div data-id="{!! $cart->id !!}" data-price="{!! number_format($cart->price, 2) !!}" data-name="Gift Certificate" data-src="" class="cart__left_product_remove remove_product_button">remove</div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="cart__left_product_price cart__left_size price">
                                $<span class="item-unit-price">{{ number_format($cart->price, 2) }}</span>
                            </div>
                            <div class="cart__left_product_price primary cart__left_size total">
                                $<span class="item-row-total">{{ number_format($cart->price * $cart->quantity, 2) }}</span>
                            </div>
                        </div>

                        @php
                            $subTotal += $cart->price * $cart->quantity;
                        @endphp

                    @endforeach
                </div>
                <div class="cart__left_buttons">
                    <a href="/cart/shipping" class="button button_secondary button_small">proceed to checkout</a>
                    <a href="/category" class="cart__left_buttons_continue">continue the shopping</a>
                </div>
            </div>
            <div class="cart__right">
                <div class="cart__right_title">
                    total
                </div>
                <div class="cart__right_total">
                    <div class="left">Subtotal</div>
                    <div class="right">$<span id="cart-sub-total">{{ number_format($subTotal, 2) }}</span></div>
                </div>
                <div class="cart__right_total">
                    <div class="left">shipping</div>
                    <div class="right small">Calculated on checkout</div>
                </div>
                <div class="cart__right_total">
                    <div class="left">canada gst</div>
                    <div class="right">$<span id="cart-gst">{{ number_format($subTotal * 0.05, 2) }}</span></div>
                </div>
                <div class="cart__right_total" style="display: none" id="discount-row">
                    <div class="left">Discount (<span class="gift_name"></span>)</div>
                    <div class="right">$<span id="discount-amount">0</span></div>
                </div>
                <div class="cart__right_coupon">
                    <div class="cart__right_coupon_title">Gift Certificate or Coupon</div>
                    <form class="cart__right_coupon_form">
                        <div class="cart__right_coupon_input">
                            <input type="text" name="gift_code" placeholder="Enter the coupon or certificate code">
                        </div>
                        <div class="cart__right_coupon_button">
                            <button type="button" class="apply-gift">
                                Apply
                            </button>
                        </div>
                    </form>
                    <div class="cart__right_coupon_info">*Only one coupon can be applied to an order </div>
                </div>
                <div class="cart__right_check">
                    <div class="left">total</div>
                    <div class="right">$<span id="cart-total">{{ number_format($subTotal + ($subTotal * 0.05), 2) }}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" data-modal_name="clear_cart">
        <div class="modal__in">
            <div class="modal__closer">
                <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
            </div>
            <div class="modal__body clear_cart">
                <div class="text">Are you sure you want to remove all products from the shopping cart?</div>
                <div class="centerred_button">
                    <a href="javascript:void(0)" class="button button_outlied button_small close_modal remove-cart">Yes</a>
                    <a href="javascript:void(0)" class="button button_secondary button_small close_modal">No</a>
                </div>
            </div>
        </div>
        <div class="modal__blur"></div>
    </div>


    <div class="modal" data-modal_name="empty_cart">
        <div class="modal__in">
            <div class="modal__closer">
                <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
            </div>
            <div class="modal__body empty_cart">
                <div class="text">The shopping cart is empty</div>
                <div class="centerred_button">
                    <a href="/category" class="button button_secondary button_small">Continue Shopping</a>
                </div>
            </div>
        </div>
        <div class="modal__blur"></div>
    </div>

    <div class="modal" data-modal_name="remove_product">
        <div class="modal__in">
            <div class="modal__closer">
                <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
            </div>
            <div class="modal__body clear_cart">
                <div class="text">Are you sure you want to remove this product from the shopping cart?</div>
                <div class="catalog_products__item">
                    <div class="products__item">
                        <div class="products__item_image">
                            <img src="/img/products1.jpg" width="100%" alt="">
                        </div>
                        <a href="/product" class="products__item_name">
                            Gehwol Balm for Dry Rough Skin 75ml
                        </a>
                        <div class="d-flex align-center">
                            <div class="products__item_stars">
                                <div class="products__item_stars_in" style="width: 80%;"></div>
                            </div>
                            <div class="products__item_raiting">
                                Rating: <span id="rating"></span>
                            </div>
                        </div>
                        <div class="products__item_price">
                            $16.95
                        </div>
                    </div>
                </div>
                <div class="centerred_button">
                    <a href="javascript:void(0)" class="button button_outlied button_small remove-cart">Yes</a>
                    <a href="javascript:void(0)" class="button button_secondary button_small close_modal">No</a>
                </div>
            </div>
        </div>
        <div class="modal__blur"></div>
    </div>
@endsection
