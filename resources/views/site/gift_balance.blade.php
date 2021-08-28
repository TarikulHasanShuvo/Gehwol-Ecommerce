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
                <a href="/gift" class="gift_page__button ">Purchase a Gift Certificate</a>
                <a href="/gift/redeem" class="gift_page__button">Redeem a Gift Certificate</a>
                <div class="gift_page__button active">Check Remaining Balance</div>
            </div>
            <div class="gift_page__body">
                <div class="gift_page__balance_left">
                    <div class="cart__left_shipping_title">
                        Check Remaining Balance
                    </div>
                    <div class="cart__left_shipping_subtitle">
                        You can check the balance of a gift certificate by typing the code in to the box below
                    </div>
                    <div class="cart__left_shipping_form_item">
                        <input type="text" name="gift_code" placeholder="Gift Certificate Code*" require>
                    </div>
                    <a href="javascript:void(0)" class="button button_secondary button_small gift-balance">Check balance</a>
                </div>
                <div class="gift_page__balance_right">
                    <div class="gift_page__balance_right_top">
                        <div class="left d-flex align-center">
                            <div class="small">For</div>
                            <div class="big">Full Name</div>
                        </div>
                        <div class="right gift_code">0000-0000-0000-0000</div>
                    </div>
                    <div class="gift_page__balance_right_center">
                        <div class="title">Gift certificate</div>
                        <div class="description">Here you can leave your greeting text</div>
                    </div>
                    <div class="gift_page__balance_right_bottom">
                        <div class="left">
                            <div class="name">From <span class="from_name">Full Name</span></div>
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
    </div>
@endsection
