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
                <div class="gift_page__button active">Redeem a Gift Certificate</div>
                <a href="/gift/balance" class="gift_page__button">Check Remaining Balance</a>
            </div>
            <div class="gift_page__in">
                <div class="cart__left_shipping_title">
                    Purchase a Gift Certificate
                </div>
                <div class="cart__left_shipping_subtitle">
                    This gift certificate will be emailed to the recipient after your order has been paid for
                </div>
                <div class="gift_page__body">
                    <div class="gift_page__left_redeem_item">
                        <div class="gift_page__left_redeem_item_title">Step 1</div>
                        <div class="gift_page__left_redeem_item_text">You need your unique gift certificate code, which is part of the gift certificate that was emailed to you as an attachment. It will look something like Z50-Y6K-COS-402</div>
                    </div>
                    <div class="gift_page__left_redeem_item">
                        <div class="gift_page__left_redeem_item_title">Step 2</div>
                        <div class="gift_page__left_redeem_item_text">Browse the store and add items to your cart as you normally would</div>
                    </div>
                    <div class="gift_page__left_redeem_item">
                        <div class="gift_page__left_redeem_item_title">Step 3</div>
                        <div class="gift_page__left_redeem_item_text">Click the <span>View Cart</span> link to view the contents of your shopping cart</div>
                    </div>
                    <div class="gift_page__left_redeem_item">
                        <div class="gift_page__left_redeem_item_title">Step 4</div>
                        <div class="gift_page__left_redeem_item_text">Type your gift certificate code in to the «Redeem Gift Certificate» box and click «Go»</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
