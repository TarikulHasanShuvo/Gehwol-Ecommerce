@extends('layouts.auth')

@section('content')
    <div class="auth_page__links">
        <span class="auth_page__link active">login</span>
        <a href="/register" class="auth_page__link">register</a>
    </div>

    <form id="login-form"  class="row" action="{{route('login')}}" method="post">
        @csrf

        @if(Session::has('status'))
            <p class="alert alert-success" style="background-color: green;color: #fff; padding: 15px;">{{Session::get('status')}}</p>
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
                <select name="type">
                    <option value="Esthetician">Esthetician</option>
                    <option value="Customer">Customer</option>
                </select>
            </div>
            <div class="cart__left_shipping_form_item">
                <input type="text" placeholder="Email address*" name="email" required>
            </div>
            <div class="cart__left_shipping_form_item">
                <input type="password" placeholder="Password*" name="password" required>
            </div>
            <div class="auth_page__bottom">
                <div class="cart__left_shipping_radio_left d-flex align-center">
                    <label class="d-flex align-center">
                        <input type="checkbox" name="remember">
                        <div class="cart__left_shipping_radio_input"></div>
                        <div class="cart__left_shipping_radio_text">Remember me</div>
                    </label>
                </div>
                <a href="/forgot-password" class="auth_page__forgot">Lost your password?</a>
            </div>
        </div>
        <div class="auth_page__button">
            <button type="submit" class="button button_secondary button_small cursor-pointer">Log In</button>
        </div>
    </form>
@endsection
