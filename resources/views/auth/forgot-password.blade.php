@extends('layouts.auth')

@section('content')
    <div class="auth_page__links">
        <span class="auth_page__link active">Forgot Password</span>
    </div>

    <form id="login-form"  class="row" action="{{ route('password.email') }}" method="post">
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
                <input type="text" placeholder="Email address*" name="email" required>
            </div>
        </div>
        <div class="auth_page__button">
            <button type="submit" class="button button_secondary button_small cursor-pointer">Send Password Reset Link</button>
        </div>
    </form>
@endsection
