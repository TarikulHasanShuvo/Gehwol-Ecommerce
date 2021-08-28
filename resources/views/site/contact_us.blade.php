@extends('layouts.site')

@section('content')
    <div class="contact_us">
        <div class="breadcrumbs">
            <a href="index.html">Home</a>
            <span class="divider">|</span>
            <span>Contact us</span>
        </div>
        <h1 class="page_title">
            Contact us
        </h1>
        <div class="container">
            <div class="page_form">
                <div class="page_form__in">
                    <div class="page_form__left">
                        <div class="page_form__title">Support Service</div>
                        <div class="page_form__text">
                            Please get in touch if you have any questions regarding a current or upcoming order with us as well as for any other questions.
                        </div>
                        <div class="page_form__text hasMargin">
                            You can contact us using the form on the right, email us directly  or call:
                        </div>           
                        <a href="tel:1-855-888-8307" class="header__phone d-flex align-center">
                            <div class="icon">
                                <img src="/img/svg/phone_blue.svg" width="100%" alt="">
                            </div>
                            <div class="text">1-855-888-8307</div>
                        </a>     
                        <a href="mailto:hello@gehwolcanada.ca" class="header__phone d-flex align-center">
                            <div class="icon">
                                <img src="/img/svg/mail_blue.svg" width="100%" alt="">
                            </div>
                            <div class="text">hello@gehwolcanada.ca</div>
                        </a>     
                        <div class="page_form__info">
                            Although we are not Gehwol Corporate we will try our best to help you with any questions you have regarding Gehwol products, usage and information in Canada
                        </div>
                    </div>
                    <div class="page_form__right">
                        <form id="contact-form" action="" data-target_modal="contact_us" method="POST" class="product_page__reviews_form ajax_for">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="product_page__reviews_form_inputs">
                                <input type="text" placeholder="Full Name*" name="name" required
                                    class="contact_form__field contact_form__input">
                                <input type="email" name="email" placeholder="Email Address*" required
                                    class="contact_form__field contact_form__input">
                            </div>
                            <div class="product_page__reviews_form_inputs">
                                <input type="text" name="phone" placeholder="Phone Number" required
                                    class="contact_form__field contact_form__input">
                                <input type="text" name="order_no" placeholder="Order Number" required
                                    class="contact_form__field contact_form__input">
                            </div>
                            <textarea placeholder="Details" name="message" required
                                class="contact_form__field contact_form__textarea"></textarea>
                                <!-- TODO file loader needed -->
                            <div class="contact_form__bottom d-flex align-center">
                                <div class="left" style="width: auto;">
                                    <button class="button button_secondary button_small cursor-pointer contact_us">&nbsp;&nbsp;Send&nbsp;&nbsp;</button>
                                </div>
                                <div class="right">
                                    <label class="d-flex align-center">
                                        <input type="checkbox" name="privacy" required>
                                        <div class="checkbox"></div>
                                        <div class="text">Review our <a href="#" class="text-decoration-none">privacy policy</a> here</div>
                                    </label>
                                </div>
                            </div>
                        </form>
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
                <div class="title">Thanks!</div>
                <div class="text">Our manager will contact you as soon as possible and answer all your questions</div>
                <div class="centerred_button">
                    <a href="/" class="button button_secondary button_small">Homepage</a>
                </div>
            </div>
        </div>
        <div class="modal__blur"></div>
    </div>
@endsection
