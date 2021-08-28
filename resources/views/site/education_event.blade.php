@extends('layouts.site')

@section('content')
    <div class="breadcrumbs">
        <a href="index.html">Home</a>
        <span class="divider">|</span>
        <span>Education</span>
        <span class="divider">|</span>
        <span>Registration for the event</span>
    </div>
    <h1 class="page_title">
        Registration for the event
    </h1>
    <div class="container education_event">
        <form action="/forms/register_for_event" data-target_modal="register_for_event" method="POST" class="cart__body ajax_form">
            <div class="cart__left">
                <div class="cart__left_shipping_title">
                    your information
                </div>
                <div class="cart__left_shipping_subtitle">
                   To register for the event check or enter your personal details below in the form
                </div>
                <div class="cart__left_shipping_form">
                    <div class="cart__left_shipping_form_group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="cart__left_shipping_form_item">
                            <input type="text" name="name" required placeholder="Name*" value="Marrisa Gold">
                        </div>
                        <div class="cart__left_shipping_form_item">
                            <input type="email" name="email" required placeholder="Email" value="gold1212@gmail.com">
                        </div>
                    </div>
                </div>
                <div class="cart__left_buttons">
                    <button href="#" class="button button_secondary button_small">register this event</button>
                    <a href="/education" class="cart__left_buttons_continue">back to the calendar</a>
                </div>
            </div>
            <div class="cart__right">
                <div class="cart__right_title">
                    event schedule details
                </div>
                <div class="education_event__subtitle">
                    Uniqcure  and mymask, mini facials to maximize your treatments
                </div>
                <div class="education_event__total">
                    <div class="cart__right_total">
                        <div class="left">Date</div>
                        <div class="right">April 01, 2021</div>
                    </div>
                    <div class="cart__right_total">
                        <div class="left">Time</div>
                        <div class="right">12:00 pm - 01:00 pm</div>
                    </div>
                    <div class="cart__right_total">
                        <div class="left">Total Seat</div>
                        <div class="right">50</div>
                    </div>
                    <div class="cart__right_total">
                        <div class="left">Your Ticket</div>
                        <div class="right">30</div>
                    </div>
                    <div class="cart__right_total">
                        <div class="left">Event author</div>
                        <div class="right">Ashley Durbano</div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal" data-modal_name="register_for_event">
        <div class="modal__in">
            <div class="modal__closer">
                <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
            </div>
            <div class="modal__body newsletter">
                <div class="title">
                    You have successfully register for the event
                </div>
                <div class="red_text">We are glad that you are with us!</div>
                <div class="text">On April 01, at 11: 45 pm, you will receive a link to Zoom to your email address. See you soon at the event</div>
                <div class="centerred_button">
                    <a href="/" class="button button_secondary button_small">Homepage</a>
                </div>
            </div>
        </div>
        <div class="modal__blur"></div>
    </div>
@endsection
