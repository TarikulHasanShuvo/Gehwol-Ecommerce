@extends('layouts.auth')

@section('content')
    <div class="auth_page__links">
        <a href="/login" class="auth_page__link">login</a>
        <span class="auth_page__link active">register</span>
    </div>

    <form id="login-form"  class="row" action="{{route('register')}}" method="post">
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

        <br/>

        <div class="cart__left_shipping_form">
            <div class="cart__left_shipping_form_item">
                <select name="type" required>
                    <option value="esthetician">Esthetician</option>
                    <option value="customer">Customer</option>
                </select>
            </div>
            <div class="cart__left_shipping_form_group">
                <div class="cart__left_shipping_form_item">
                    <input type="text" placeholder="First Name*" name="first_name" required>
                </div>
                <div class="cart__left_shipping_form_item">
                    <input type="text" placeholder="Last Name*" name="last_name" required>
                </div>
            </div>
            <div class="cart__left_shipping_form_group">
                <div class="cart__left_shipping_form_item">
                    <input type="email" placeholder="Email address*" name="email" required>
                </div>
                <div class="cart__left_shipping_form_item">
                    <input type="text" placeholder="Phone Number" name="phone" required>
                </div>
            </div>

            <div class="cart__left_shipping_form_group">
                <div class="cart__left_shipping_form_item">
                    <input type="password" placeholder="Password" name="password" required>
                </div>

                <div class="cart__left_shipping_form_item">
                    <input type="text" placeholder="Business Name*" name="business_name" required>
                </div>
            </div>

            <div class="cart__left_shipping_form_group">
                <div class="cart__left_shipping_form_item">
                    <input type="text" placeholder="Customer Number" name="customer_number">
                </div>
                <div class="cart__left_shipping_form_item">
                    <input type="text" placeholder="City" name="city">
                </div>
            </div>
            <div class="cart__left_shipping_form_group">
                <div class="cart__left_shipping_form_item">
                    <input type="text" placeholder="State" name="state">
{{--                    <select>--}}
{{--                        <option value="Choose a State">Choose a State</option>--}}
{{--                        <option value="Choose a State">Choose a State</option>--}}
{{--                    </select>--}}
                </div>
                <div class="cart__left_shipping_form_item">
                    <input type="text" placeholder="Postal Code" name="postal_code">
                </div>
            </div>
            {{--<div class="auth_page__bottom">
                <span>A password will be sent to your email address</span>
            </div>--}}
        </div>
        <div class="auth_page__button">
            <button type="submit" class="button button_secondary button_small cursor-pointer">Register</button>
        </div>
    </form>
@endsection
