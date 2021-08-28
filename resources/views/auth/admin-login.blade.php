@extends('layouts.auth')

@section('content')
    <div class="auth_page__links">
        <span class="auth_page__link active">Admin Login</span>
    </div>

    <form id="login-form"  class="row" action="{{route('admin.login')}}" method="post">
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
                <input type="text" placeholder="Enter Email Address" name="email">
            </div>
            <div class="cart__left_shipping_form_item">
                <input type="password"  placeholder="Password*" name="password">
            </div>
        </div>

        <div class="auth_page__button">
            <button type="submit" class="button button_secondary button_small cursor-pointer">Log In</button>
        </div>
    </form>
@endsection
