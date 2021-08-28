@extends('layouts.site')

@section('content')
    <div class="gift_page">
        <div class="breadcrumbs">
            <a href="/">Home</a>
            <span class="divider">|</span>
            <span>Gift Certificates</span>
        </div>
        <h1 class="page_title">
            Gift Certificates
        </h1>
        <div class="container">
            <div class="gift_page__top">
                <div class="gift_page__button active">Purchase a Gift Certificate</div>
                <a href="/gift/redeem" class="gift_page__button">Redeem a Gift Certificate</a>
                <a href="/gift/balance" class="gift_page__button">Check Remaining Balance</a>
            </div>
            <div class="gift_page__body">
                <div class="gift_page__purchase_left">
                      <div class="cart__left_shipping_title">
                          Purchase a Gift Certificate
                      </div>
                      <div class="cart__left_shipping_subtitle">
                          This gift certificate will be emailed to the recipient after your order has been paid for
                      </div>
                    <form action="{{ route('carts.gift') }}"  method="post">
                        @if($errors->any())
                            <div class="col-12 form-group" style="margin-bottom: 10px">
                                <div class="alert alert-danger" style="background: #ff8000; color: #fff; padding: 10px;">
                                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                                </div>
                            </div>
                        @endif

                        @csrf
                        <div class="cart__left_shipping_form">
                            <div class="cart__left_shipping_form_group">
                                <div class="cart__left_shipping_form_item">
                                    <input type="text" name="recipient_name" placeholder="Recipient's Name*" required>
                                </div>
                                <div class="cart__left_shipping_form_item">
                                    <input type="text" name="client_name" placeholder="Your Name*" required>
                                </div>
                            </div>
                            <div class="cart__left_shipping_form_group">
                                <div class="cart__left_shipping_form_item">
                                    <input type="email" name="recipient_email" placeholder="Recipient's Email*" required>
                                </div>
                                <div class="cart__left_shipping_form_item">
                                    <input type="email" name="client_email" placeholder="Your Email*" required>
                                </div>
                            </div>
                            <div class="cart__left_shipping_form_item">
                                <textarea name="message" placeholder="Your Message"></textarea>
                            </div>
                            <div class="cart__left_shipping_form_group">
                                <div class="cart__left_shipping_form_item">
                                    <input type="number" name="amount" placeholder="Amount*" required min="10" max="25000">
                                </div>
                                <div class="cart__left_shipping_form_item">
{{--                                    <input type="date" name="date_of_birth">--}}
                                    <select name="type" required>
                                        <option value="">Select Type*</option>
                                        <option value="Birthday">Birthday</option>
                                    </select>
                                </div>
                            </div>
                            <div class="gift_page__purchase_left_form_desc">
                                *Value must be between $10.00 and $250.00
                            </div>
                        </div>
                        <div class="cart__left_shipping_radio">
                            <div class="cart__left_shipping_radio_left d-flex align-center">
                                <label class="d-flex align-center">
                                    <input type="checkbox" required>
                                    <div class="cart__left_shipping_radio_input"></div>
                                    <div class="cart__left_shipping_radio_text">*I understand that gift certificates are non-refundable</div>
                                </label>
                            </div>
                        </div>
                        <div class="gift_page__purchase_left_buttons">
                            <button type="submit" class="button button_secondary button_small cursor-pointer">add to cart</button>
                            <a href="#" class="button button_outlied button_small preview_gift_opener">Preview</a>
                        </div>
                    </form>
                  </div>
                <div class="gift_page__purchase_right">
                    <img src="{{ asset('img/gift_purchase_bg.jpg') }}" width="100%" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="modal" data-modal_name="gift_preview">
        <div class="modal__in">
            <div class="modal__closer">
                <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
            </div>
            <div class="modal__body gift_preview">
                <div class="title">Preview Gift Certificate</div>
                <div class="gift_page__balance_right">
                    <div class="gift_page__balance_right_top">
                        <div class="left d-flex align-center">
                            <div class="small">For</div>
                            <div class="big">Full Name</div>
                        </div>
                        <div class="right">0000-0000-0000-0000</div>
                    </div>
                    <div class="gift_page__balance_right_center">
                        <div class="title">Gift certificate</div>
                        <div class="description">Here you can leave your greeting text</div>
                    </div>
                    <div class="gift_page__balance_right_bottom">
                        <div class="left">
                            <div class="name">From Full Name</div>
                            <div class="link">Redeem your gift certificate at <a href="https://www.gehwolcanada.ca" target="_blank">https://www.gehwolcanada.ca</a></div>
                        </div>
                        <div class="right">
                            <div class="value">$12345678</div>
                            <div class="logo">
                                <img src="{{asset('/img/svg/logo.svg')}}" width="100%" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal__blur"></div>
    </div>
@endsection
