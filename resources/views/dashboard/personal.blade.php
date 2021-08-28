@extends('layouts.dashboard')

@section('content')
    @if(Session::has('success'))
        <p class="alert alert-success" style="background-color: green;color: #fff; padding: 15px;">{{Session::get('success')}}</p>
    @endif

    @if(Session::has('error'))
        <p class="alert alert-danger" style="background-color: #ff8000;color: #fff; padding: 15px;">{{Session::get('error')}}</p>
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

    <div class="dashboard__title">personal info</div>
    <div class="dashboard__divider first"></div>
    <div class="cart__left_shipping_form w-60 dashboard__form">
        <form id="login-form"  class="row" action="{{route('update_info')}}" method="post">
            @csrf

            <br/>
            <div class="cart__left_shipping_form_group">
                <div class="cart__left_shipping_form_item">
                    <input type="text" placeholder="First Name" name="first_name" value="{{ Auth::user()->first_name }}">
                </div>
                <div class="cart__left_shipping_form_item">
                    <input type="text" placeholder="Last Name" name="last_name" value="{{ Auth::user()->last_name }}">
                </div>
            </div>
            <div class="cart__left_shipping_form_group">
                <div class="cart__left_shipping_form_item">
                    <input type="text" placeholder="Phone" name="phone" value="{{ Auth::user()->phone }}">
                </div>
                <div class="cart__left_shipping_form_item">
                    <input type="email" placeholder="Email*" name="email" value="{{ Auth::user()->email }}" require>
                </div>

            </div>
            <div class="cart__left_shipping_form_item">
                <input type="text" placeholder="Business Name" name="business_name" value="{{ Auth::user()->business_name }}">
            </div>
            <div class="cart__left_shipping_form_group">
                <div class="cart__left_shipping_form_item">
                    <input type="text" placeholder="Customer Number" name="customer_number" value="{{ Auth::user()->customer_number }}">
                </div>
                 <div class="cart__left_shipping_form_item">
                    <input type="text" placeholder="City" name="city" value="{{ Auth::user()->city }}">
                </div>
            </div>
            <div class="cart__left_shipping_form_group">
                <div class="cart__left_shipping_form_item">
                    <input type="text" placeholder="State" name="state" value="{{ Auth::user()->state }}">
                </div>
    {{--            <div class="cart__left_shipping_form_item">--}}
    {{--                <select>--}}
    {{--                    <option value="Choose State">Choose State</option>--}}
    {{--                    <option value="Quebec">Quebec</option>--}}
    {{--                    <option value="Quebec">Quebec</option>--}}
    {{--                    <option value="Quebec">Quebec</option>--}}
    {{--                    <option value="Quebec">Quebec</option>--}}
    {{--                </select>--}}
    {{--            </div>--}}
                <div class="cart__left_shipping_form_item">
                    <input type="text" placeholder="Postal Code" name="postal_code" value="{{ Auth::user()->postal_code }}">
                </div>
            </div>

            <div class="dashboard__form_buttons">
                <div class="dashboard__form_button">
                    <button class="button button_secondary button_small">Save data changes</button>
                </div>
            </div>
        </form>
    </div>

    <div class="dashboard__divider second"></div>

    <div class="dashboard__title">Change password</div>

    <form id="login-form"  class="row" action="{{route('users.change_pass')}}" method="post">
        @csrf

        <div class="cart__left_shipping_form w-60 dashboard__form">
            <div class="cart__left_shipping_form_group">
                <div class="cart__left_shipping_form_item">
                    <input type="password" placeholder="Current Password*" name="current_password" required>
                </div>
            </div>
            <div class="cart__left_shipping_form_group">
                <div class="cart__left_shipping_form_item">
                    <input type="password" placeholder="New Password*" name="password" required>
                </div>
            </div>
            <div class="cart__left_shipping_form_group">
                <div class="cart__left_shipping_form_item">
                    <input type="password" placeholder="Confirm Password*" name="password_confirmation" required>
                </div>
            </div>

            <div class="dashboard__form_buttons">
                <div class="dashboard__form_button">
                    <button type="submit" class="button button_grey button_small cursor-pointer">Save</button>
                </div>
            </div>
        </div>
    </form>

    <div class="dashboard__divider second"></div>

    <div class="dashboard__title">newsletter</div>

    <div class="cart__left_shipping_form dashboard__form">
        <div class="cart__left_shipping_radio_left d-flex align-center">
            <form action="{{route('users.newsletter_subscription')}}" id="newsletter-subscription" method="post">
                @csrf
                <label class="d-flex align-center">
                    @php($newsletter = \App\Models\NewsLetterSubscription::where('email', Auth::user()->email)->first())
                    <input type="checkbox" name="newsletter_subscription" {!! isset($newsletter)?'checked': '' !!}>
                    <div class="cart__left_shipping_radio_input"></div>
                    <div class="cart__left_shipping_radio_text">I agree to receive e-mail and sms newsletters from Gehwol</div>
                </label>

                <div class="dashboard__form_buttons">
                    <div class="dashboard__form_button">
                        <button type="submit" class="button button_grey button_small cursor-pointer">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
