@extends('layouts.site')

@section('content')

    @php
        $hasProduct = false;
        foreach ($carts as $cart) {
            if($cart->product) {
                $hasProduct = true;
            }
        }
    @endphp

        <div class="breadcrumbs">
            <a href="/">Home</a>
            <span class="divider">|</span>
            <span>Shopping Cart</span>
            <span class="divider">|</span>
            <span>Shipping</span>
        </div>
        <h1 class="page_title">
            shipping
        </h1>
        <div class="container cart">
            <div class="cart__top">
                <div class="cart__steps d-flex align-center">
                    <div class="cart__step">1 -   Shopping Cart</div>
                    <div class="cart__arrow">
                        <img src="{{ asset('img/svg/step_arrow.svg') }}" width="100%" alt="">
                    </div>
                    <div class="cart__step active">2 -   Shipping</div>
                    <div class="cart__arrow">
                        <img src="{{ asset('img/svg/step_arrow_active.svg') }}" width="100%" alt="">
                    </div>
                    <div class="cart__step">3 -   Payment method</div>
                </div>
            </div>
            <div class="cart__body">
                <div class="cart__left">

                    <div class="cart__left_shipping_title">
                        Shipping address
                    </div>

                    <form id="order-form"  class="row" action="{{route('orders.store')}}" method="post">
                        @csrf

                        @if(Session::has('status'))
                            <p class="alert alert-success">{{Session::get('status')}}</p>
                        @endif

                        @if ($errors->any())
                            <div class="col-12 form-group">
                                <div class="alert alert-danger" style="background: #ff8000; color: #fff; padding: 10px;">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <div class="cart__left_shipping_radio">
                            @if(count($addresses) > 0)
                            <div class="cart__left_shipping_radio_left d-flex align-center">
                                <label class="d-flex align-center">
                                    <input type="radio" checked name="address" value="new">
                                    <div class="cart__left_shipping_radio_input"></div>
                                    <div class="cart__left_shipping_radio_text">Add a new address</div>
                                </label>
                            </div>
                            <div class="cart__left_shipping_radio_left d-flex align-center">
                                <label class="d-flex align-center">
                                    <input type="radio" name="address" value="old">
                                    <div class="cart__left_shipping_radio_input"></div>
                                    <div class="cart__left_shipping_radio_text">Use an existing address</div>
                                </label>
                            </div>
                            @endif
                        </div>
                        <div class="cart__left_shipping_form">
                            @if(count($addresses) > 0)
                            <input type="hidden" name="address_array" value="{{ json_encode($addresses, true) }}" />
                            <div class="cart__left_shipping_form_item">
                                <select id="addressSelection" style="display: none">
                                    <option value="">Select Address</option>
                                    @foreach($addresses as $address)
                                        <option value="{!! $address['id'] !!}">{{ $address['first_name'] .' '. $address['last_name'].', '.$address['phone'].', '.$address['address_line_1'].', '.$address['city'].', '.$address['state'].', '.$address['postal_code'].', '.$address['country'] }} {{ isset($address['is_default']) && $address['is_default'] == 1?'(Default Address)':'' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            @if(count($addresses)<1)
                                <input type="hidden" name="address" value="new"/>
                            @endif
                            <div class="cart__left_shipping_form_group">
                                <div class="cart__left_shipping_form_item">
                                    <input type="text" placeholder="First Name*" name="ship_first_name" required>
                                </div>
                                <div class="cart__left_shipping_form_item">
                                    <input type="text" placeholder="Last Name*" name="ship_last_name" required>
                                </div>
                            </div>
                            <div class="cart__left_shipping_form_group">
                                <div class="cart__left_shipping_form_item">
                                    <input type="text" placeholder="Bussiness Name*" name="ship_business_name" required>
                                </div>
                                <div class="cart__left_shipping_form_item">
                                    <input type="text" placeholder="Phone*" name="ship_phone" required>
                                </div>
                            </div>
                            <div class="cart__left_shipping_form_group">
                                <div class="cart__left_shipping_form_item">
                                    <input type="text" placeholder="Address Line 1*" name="ship_address_line_1" required>
                                </div>
                                <div class="cart__left_shipping_form_item">
                                    <input type="text" placeholder="Address Line 2" name="ship_address_line_2">
                                </div>
                            </div>

                            <div class="cart__left_shipping_form_group">
                                <div class="cart__left_shipping_form_item">
                                    <input type="text" placeholder="Postal code*" name="ship_postal_code" required>
                                </div>

                                <div class="cart__left_shipping_form_item">
                                    <select name="ship_city" required>
                                        <option value="">Choose City</option>
                                        <option value="Montreal">Montreal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="cart__left_shipping_form_group">
                                <div class="cart__left_shipping_form_item">
                                    <select name="ship_state" required>
                                        <option value="">Select State*</option>
                                        <option value="Quebec">Quebec</option>
                                    </select>
                                </div>

                                <div class="cart__left_shipping_form_item">
                                    <select name="ship_country" required>
                                        <option value="">Select Country*</option>
                                        <option value="Canada">Canada</option>
                                    </select>
                                </div>
                            </div>

                            <div class="cart__left_shipping_form_item">
                                <textarea placeholder="Order comment" name="comments"></textarea>
                            </div>
                        </div>

                        @if($hasProduct)
                        <div class="cart__left_shipping_title">
                            shipping method {{ $hasProduct }}
                        </div>
                        <div class="cart__left_shipping_radio">
                            <div class="cart__left_shipping_radio_left d-flex align-center">
                                <label class="d-flex align-center fixed_width">
                                    <input type="radio" checked name="shipping_method" value="canada_post">
                                    <div class="cart__left_shipping_radio_input"></div>
                                    <div class="cart__left_shipping_radio_text">Canada Post</div>
                                </label>
                                <div class="price">
                                    $11.95
                                </div>
                            </div>
                            <div class="cart__left_shipping_radio_left d-flex align-center">
                                <label class="d-flex align-center fixed_width">
                                    <input type="radio" name="shipping_method" value="courier">
                                    <div class="cart__left_shipping_radio_input"></div>
                                    <div class="cart__left_shipping_radio_text">Courier</div>
                                </label>
                                <div class="price">
                                    $19.95
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="cart__left_shipping_radio">
                            <div class="cart__left_shipping_radio_left d-flex align-center">
                                <label class="d-flex align-center">
                                    <input type="checkbox" name="tnc" required>
                                    <div class="cart__left_shipping_radio_input"></div>
                                    <div class="cart__left_shipping_radio_text">*I agree to the terms of <a href="#">shipping and return</a> of the product and have read the <a href="#">privacy policy</a></div>
                                </label>
                            </div>
                        </div>
                        <div class="cart__left_buttons">
                            <button type="submit" class="button button_secondary button_small cursor-pointer">Payment</button>
{{--                            <a href="/cart/payment" class="button button_secondary button_small">Payment</a>--}}
                            <a href="/cart" class="cart__left_buttons_continue">back to shopping cart</a>
                        </div>
                    </form>
                </div>
                <div class="cart__right">
                    <div class="cart__right_title">
                        Your order
                    </div>
                    <div class="cart__right_products">
                        @php
                            $subTotal = 0;
                        @endphp
                        @foreach($carts as $cart)

                            <div class="cart__right_product" id="cart-item-{!! $cart->id !!}">
                                <div class="cart__right_product_image">
                                    @if($cart->product)
                                        @php
                                            $hasProduct = true;
                                        @endphp
                                    <img src="/storage/images/{{ (isset($cart->product->product_images) && count($cart->product->product_images)) ?  $cart->product->product_images[0]['image'] : ''}}" style="width: 100%; max-height: 120px" alt="">
{{--                                   <img src="{{ asset('img/cart_product.jpg') }}" width="100%" alt="">--}}
                                    @endif
                                </div>
                                <div class="cart__right_product_info">
                                    @if($cart->product)
                                        <div class="cart__right_product_top">
                                            <div class="cart__right_product_title">{{ $cart->product->name  }}</div>
                                            <div class="cart__right_product_delete">
{{--                                                <img src="{{ asset('img/svg/delete.svg') }}" width="100%" alt="">--}}
                                            </div>
                                        </div>
                                        <div class="cart__right_product_size">
                                            75 ml
                                        </div>
                                        <div class="cart__right_product_bottom">
                                            <div class="cart__right_product_counter">
                                                <button class="minus change-qty" data-opt-type="subtract" data-id="{!! $cart->id !!}">-</button>
                                                <output class="count">{{ $cart->quantity }}</output>
                                                <button class="plus change-qty" data-opt-type="add" data-id="{!! $cart->id !!}">+</button>
                                            </div>
                                            <div class="cart__right_product_price">$<span class="item-row-total">{{ number_format($cart->price * $cart->quantity, 2) }}</span></div>
                                        </div>
                                    @else
                                        <div class="cart__right_product_top">
                                            <div class="cart__right_product_title">Gift Certificate</div>
                                            <div class="cart__right_product_delete">
{{--                                                <img src="{{ asset('img/svg/delete.svg') }}" width="100%" alt="">--}}
                                            </div>
                                        </div>
                                        <div class="cart__right_product_size">${{ $cart->price }}</div>

                                        <div class="cart__right_product_bottom">
                                            <div class="cart__right_product_counter">
                                                <output class="count">{{ $cart->quantity }}</output>
                                            </div>
                                            <div class="cart__right_product_price">$<span class="item-row-total">{{ number_format($cart->price * $cart->quantity, 2) }}</span></div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @php
                                $subTotal += $cart->price * $cart->quantity;
                            @endphp
                        @endforeach
                    </div>

                    <div class="cart__right_totals">
                        <div class="cart__right_total">
                            <div class="left">Subtotal</div>
                            <div class="right">$<span id="cart-sub-total">{{ number_format($subTotal, 2) }}</span></div>
                        </div>
                        <div class="cart__right_total">
                            <div class="left">shipping</div>
                            <div class="right">$<span id="shipping-charge">{{ $hasProduct?11.95:0.00 }}</span></div>
                        </div>
                        <div class="cart__right_total">
                            <div class="left">canada gst</div>
                            <div class="right">$<span id="cart-gst">{{ number_format($subTotal * 0.05, 2) }}</span></div>
                        </div>
                        @php
                            $subTotal += $hasProduct?11.95:0.00; //adding shipping charge
                            $total = $subTotal + ($subTotal * 0.05);
                            $gift = null;
                            $discount = 0;
                            if(\Illuminate\Support\Facades\Cookie::has('_gft_au_'.auth()->id())) {
                                $gift = json_decode(\Illuminate\Support\Facades\Cookie::get('_gft_au_'.auth()->id()), true);
                                $discount = $gift['available_balance'];
                            }

                            if($discount > $total)
                            {
                                $discount = $total;
                            }
                            $total -= $discount;
                        @endphp
                        @if($gift)
                        <div class="cart__right_total" id="discount-row">
                            <div class="left">Discount (<span class="gift_name">{{ $gift['name'] }}</span>)</div>
                            <div class="right">$<span id="discount-amount" data-balance="{!! $gift['available_balance'] !!}">{{ number_format($discount, 2) }}</span></div>
                        </div>
                        @endif
                    </div>

                    <div class="cart__right_check">
                        <div class="left">total</div>
                        <div class="right">$<span id="cart-total">{{ number_format($total, 2) }}</span></div>
                    </div>
                </div>
            </div>
        </div>
@endsection
