@extends('layouts.site')

@section('content')
    <div class="wholesale">
        <div class="breadcrumbs">
            <a href="/">Home</a>
            <span class="divider">|</span>
            <span>Wholesale</span>
        </div>
        <h1 class="page_title">
            Wholesale
        </h1>
        <div class="container">
            <div class="page_form">
                <div class="page_form__in">
                    <div class="page_form__left">
                        <div class="page_form__title">ARE YOU INTERESTED IN CARRYING GEHWOL PRODUCTS IN YOUR BUSINESS?</div>
                        <div class="page_form__text">
                            Fill out the form below and we will have someone from one of our wholesale parthers get in touch
                        </div>
                        <div class="page_form__right">
                            <form action="/save-wholesale" data-target_modal="contact_us" method="POST" class="product_page__reviews_form wholesale_form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="product_page__reviews_form_inputs">
                                    <input type="text" placeholder="Full Name*" name="name" required
                                        class="contact_form__field contact_form__input">
                                    <input type="text" name="phone" placeholder="Phone Number" required
                                           class="contact_form__field contact_form__input">
                                </div>
                                <div class="product_page__reviews_form_inputs">
                                    <input type="email" name="email" placeholder="Email Address*" required
                                           class="contact_form__field contact_form__input" style="width: 100%;">
{{--                                    <input type="text" name="order_no" placeholder="Order Number" required
                                        class="contact_form__field contact_form__input">--}}
                                </div>
                                <textarea placeholder="Details" name="message" required
                                    class="contact_form__field contact_form__textarea"></textarea>
                                    <!-- TODO file loader needed -->
                                <div class="contact_form__bottom d-flex align-center">
                                    <div class="left" style="width: auto; cursor: pointer!important;">
                                        <button class="button button_secondary button_small cursor-pointer">&nbsp;&nbsp;Send&nbsp;&nbsp;</button>
                                    </div>
                                    <div class="right">
                                        <label class="d-flex align-center">
                                            <input type="checkbox" name="privacy" required>
                                            <div class="checkbox"></div>
                                            <div class="text">Review our <a class="text-decoration-none" href="#">privacy policy</a> here</div>
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="modal" data-modal_name="contact_us">
        <div class="modal__in">
            <div class="modal__closer">
                <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
            </div>
            <div class="modal__body add_to_cart_modal">
                <div class="title">Thanks for request!</div>
                <div class="text">A Gehwol partner will contact you shortly</div>
                <div class="centerred_button">
                    <a href="/" class="button button_secondary button_small">Homepage</a>
                </div>
            </div>
        </div>
        <div class="modal__blur"></div>
    </div>
@endsection
