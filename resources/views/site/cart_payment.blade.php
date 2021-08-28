@extends('layouts.site')

@section('content')
    <div class="breadcrumbs">
        <a href="index.html">Home</a>
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
                <div class="cart__step">1 - Shopping Cart</div>
                <div class="cart__arrow">
                    <img src="{{ asset('img/svg/step_arrow.svg') }}" width="100%" alt="">
                </div>
                <div class="cart__step">2 - Shipping</div>
                <div class="cart__arrow">
                    <img src="{{ asset('img/svg/step_arrow.svg') }}" width="100%" alt="">
                </div>
                <div class="cart__step active">3 - Payment method</div>
            </div>
        </div>
        <div class="cart__body">
            @php
                $total = $order->total;
                $gift = null;
                $discount = $order->discount;
                if(\Illuminate\Support\Facades\Cookie::has('_gft_au_'.auth()->id())) {
                    $gift = json_decode(\Illuminate\Support\Facades\Cookie::get('_gft_au_'.auth()->id()), true);
                    $discount = $gift['available_balance'];

                    if($discount > $total)
                    {
                        $discount = $total;
                    }
                    $total -= $discount;
                }
            @endphp

            <div class="cart__left">

                <div class="cart__left_shipping_title">
                    {{ ($total > 0)?'Enter Card Information':'Confirm Order' }}
                </div>
                <form method="POST" action="{{ route('orders.payment', $order->id) }}" class="w-60 card-form">

                    @if(session('message'))
                        <p class="alert alert-success">{{ session('message') }}</p>
                    @endif

                    @if(session('error'))
                        <div class="col-12 form-group">
                            <div class="alert alert-danger" style="background: #ff8000; color: #fff; padding: 10px;">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif

                    @csrf

                    @if($gift)
                        <input type="hidden" name="gift_code" value="{!! $gift['gift_card_code'] !!}">
                    @endif
                    @if($total > 0)
                        <input type="hidden" name="payment_method" class="payment-method">
                        {{--                <form class="w-60 ajax_form" action="/forms/payment" data-target_modal="payment_details" method="POST" >--}}

                        <div id="card-errors" role="alert"></div>

{{--                        <div class="cart__left_shipping_radio">--}}
{{--                            <div class="cart__left_shipping_radio_left d-flex align-center">--}}
{{--                                <label class="d-flex align-center fixed_width">--}}
{{--                                    <input type="radio" checked name="card_type">--}}
{{--                                    <div class="cart__left_shipping_radio_input"></div>--}}
{{--                                    <div class="cart__left_shipping_radio_text">Mastercard</div>--}}
{{--                                </label>--}}
{{--                                <div class="price icon">--}}
{{--                                    <img src="{{ asset('img/svg/mastercard.svg') }}" height="100%" alt="">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="cart__left_shipping_radio_left d-flex align-center">--}}
{{--                                <label class="d-flex align-center fixed_width">--}}
{{--                                    <input type="radio" name="card_type">--}}
{{--                                    <div class="cart__left_shipping_radio_input"></div>--}}
{{--                                    <div class="cart__left_shipping_radio_text">VISA</div>--}}
{{--                                </label>--}}
{{--                                <div class="price icon">--}}
{{--                                    <img src="{{ asset('img/svg/visa.svg') }}" height="100%" alt="">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="cart__left_shipping_radio_left d-flex align-center">--}}
{{--                                <label class="d-flex align-center fixed_width">--}}
{{--                                    <input type="radio" name="card_type">--}}
{{--                                    <div class="cart__left_shipping_radio_input"></div>--}}
{{--                                    <div class="cart__left_shipping_radio_text">PayPal</div>--}}
{{--                                </label>--}}
{{--                                <div class="price icon">--}}
{{--                                    <img src="{{ asset('img/svg/paypal.svg') }}" height="100%" alt="">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="cart__left_shipping_form payment_form">

                            <div class="cart__left_shipping_form_item">
                                <input type="text" name="card_holder_name" placeholder="Cardholder's Name" required>
                            </div>
                            {{--                        <input class="StripeElement mb-3" name="card_holder_name" placeholder="Card holder name" required>--}}
                            <div class="col-lg-4 col-md-6">
                                <div id="card-element"></div>
                            </div>

                            {{--                        <div class="cart__left_shipping_form_item card_number">--}}
                            {{--                            <input id="ccn" name="card_number" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="19" placeholder="0000 0000 0000 0000">--}}
                            {{--                        </div>--}}

                            {{--                        <div class="cart__left_shipping_form_group">--}}
                            {{--                            <div class="cart__left_shipping_form_item">--}}
                            {{--                                <input type="text" name="card_date" placeholder="MM/YY">--}}
                            {{--                            </div>--}}
                            {{--                            <div class="cart__left_shipping_form_item cvc_number">--}}
                            {{--                                <input type="text" name="card_cvc" placeholder="CVC (Security code)">--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                        </div>

                        <div class="cart__left_buttons payment_form">
                            <button type="submit" class="button button_secondary button_small pay cursor-pointer">Pay for order
                            </button>
                            <a href="/cart/shipping" class="cart__left_buttons_continue">Back to shipping</a>
                        </div>

                    @else
                        <div class="cart__left_buttons">
                            <button type="submit" class="button button_secondary button_small">Place order</button>
                            <a href="/cart/shipping" class="cart__left_buttons_continue">Back to shipping</a>
                        </div>
                    @endif

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

                    @foreach($orderGifts as $cart)
                        <div class="cart__right_product">
                            <div class="cart__right_product_image">

                            </div>
                            <div class="cart__right_product_info">
                                <div class="cart__right_product_top">
                                    <div class="cart__right_product_title">Gift Certificate</div>
                                </div>
                                <div class="cart__right_product_size">
                                    ${{ $cart->unit_price }}
                                </div>
                                <div class="cart__right_product_bottom">
                                    <div class="cart__right_product_counter">
                                        <output class="count">{{ $cart->quantity }}</output>
                                    </div>
                                    <div class="cart__right_product_price">
                                        ${{ number_format($cart->unit_price * $cart->quantity, 2) }}</div>
                                </div>
                            </div>
                        </div>
                        @php
                            $subTotal += $cart->unit_price * $cart->quantity;
                        @endphp
                    @endforeach

                    @foreach($orderProducts as $cart)
                        <div class="cart__right_product">
                            <div class="cart__right_product_image">
                                <img src="/storage/images/{{ (isset($cart->product->product_images) && count($cart->product->product_images)) ?  $cart->product->product_images[0]['image'] : ''}}"
                                     style="width: 100%; max-height: 120px" alt="">
                                {{--                                <img src="{{ asset('img/cart_product.jpg') }}" width="100%" alt="">--}}
                            </div>
                            <div class="cart__right_product_info">
                                <div class="cart__right_product_top">
                                    <div class="cart__right_product_title">{{ $cart->product->name  }}</div>
                                    {{--                                    <div class="cart__right_product_delete">--}}
                                    {{--                                        <img src="{{ asset('img/svg/delete.svg') }}" width="100%" alt="">--}}
                                    {{--                                    </div>--}}
                                </div>
                                <div class="cart__right_product_size">
                                    75 ml
                                </div>
                                <div class="cart__right_product_bottom">
                                    <div class="cart__right_product_counter">
                                        {{--                                        <button class="minus">-</button>--}}
                                        <output class="count">{{ $cart->quantity }}</output>
                                        {{--                                        <button class="plus">+</button>--}}
                                    </div>
                                    <div class="cart__right_product_price">
                                        ${{ number_format($cart->unit_price * $cart->quantity, 2) }}</div>
                                </div>
                            </div>
                        </div>
                        @php
                            $subTotal += $cart->unit_price * $cart->quantity;
                        @endphp
                    @endforeach
                </div>
                <div class="cart__right_totals">
                    <div class="cart__right_total">
                        <div class="left">Subtotal</div>
                        <div class="right">${{ number_format($subTotal, 2) }}</div>
                    </div>
                    <div class="cart__right_total">
                        <div class="left">shipping</div>
                        <div class="right">${{ number_format($order->shipping_charge, 2) }}</div>
                    </div>
                    <div class="cart__right_total">
                        <div class="left">canada gst</div>
                        <div class="right">$<span id="cart-gst">{{ number_format($order->gst, 2) }}</span></div>
                    </div>


                    @if($discount > 0)
                        <div class="cart__right_total">
                            <div class="left">Discount {{ $gift?'('.$gift['name'].')':'' }}</div>
                            <div class="right">${{ number_format($discount, 2) }}</div>
                        </div>
                    @endif
                </div>
                <div class="cart__right_check">
                    <div class="left">total</div>
                    <div class="right">${{ number_format($total, 2) }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" data-modal_name="payment_details">
        <div class="modal__in">
{{--            <div class="modal__closer">--}}
{{--                <svg width="100%" viewBox="0 0 23 23" fill="none">--}}
{{--                    <path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54"--}}
{{--                          stroke-linecap="round"/>--}}
{{--                </svg>--}}
{{--            </div>--}}
            <div class="modal__body payment_details">
                <div class="payment_details__left">
                    <div class="title">Thank you for your order!</div>
                    <div class="text">
                        Your order number is <a href="/dashboard/orders/{{ $order->order_uid }}" style="text-decoration: none"><span>{{ $order->order_uid }}</span></a>
                    </div>
                    <div class="text">
                        You can track <a href="/dashboard/orders" style="text-decoration: none"><span>your order</span></a> in your personal account
                    </div>
                    <a href="/category?sort_by=all" class="button button_secondary button_small">Continue Shopping</a>
                    <a href="/dashboard/orders" class="button button_secondary button_small">View Orders</a>
                </div>
                <div class="payment_details__right">
                    <div class="title">Your order</div>
                    <div class="cart__right_totals border-none">
                        @foreach($orderProducts as $item)
                            <div class="cart__right_total">
                                <div class="left">{{ $item->product->name }}, 75 ml</div>
                                <div class="right">${{ number_format($item->unit_price * $item->quantity, 2) }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="cart__right_totals">
                        <div class="cart__right_total">
                            <div class="left">Subtotal</div>
                            <div class="right">${{ number_format($subTotal, 2) }}</div>
                        </div>
                        <div class="cart__right_total">
                            <div class="left">shipping</div>
                            <div class="right">${{ number_format($order->shipping_charge, 2) }}</div>
                        </div>
                        <div class="cart__right_total">
                            <div class="left">canada gst</div>
                            <div class="right">${{ number_format($order->gst, 2) }}</div>
                        </div>
                        <div class="cart__right_total">
                            <div class="left">Discount</div>
                            <div class="right">${{ number_format($order->discount, 2) }}</div>
                        </div>
                    </div>
                    <div class="cart__right_check">
                        <div class="left">total</div>
                        <div class="right">${{ number_format($order->total, 2) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal__blur"></div>
    </div>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        let stripe = Stripe("{{ config('stripe.key') }}");
        let elements = stripe.elements();
        let style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        let card = elements.create('card', {style: style});
        card.mount('#card-element');
        let paymentMethod = null;
        $('.card-form').on('submit', function (e) {
            $('button.pay').attr('disabled', true);
            if (paymentMethod) {
                return true
            }
            stripe.confirmCardSetup(
                "{{ $intent->client_secret }}",
                {
                    payment_method: {
                        card: card,
                        billing_details: {
                            name: $('input[name=card_holder_name]').val(),
                        }
                    }
                }
            ).then(function (result) {
                if (result.error) {
                    $('#card-errors').text(result.error.message);
                    $('button.pay').removeAttr('disabled')
                } else {
                    console.log(result, '==result222');
                    paymentMethod = result.setupIntent.payment_method;
                    $('.payment-method').val(paymentMethod);
                    $('.card-form').submit()
                }
            });
            return false
        })
    </script>
@endsection
