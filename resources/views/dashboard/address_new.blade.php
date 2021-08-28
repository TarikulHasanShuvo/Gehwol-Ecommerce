@extends('layouts.dashboard')

@section('content')
    <div class="dashboard__title_with_link">
        <div class="dashboard__title">Add a new address</div>
        <a href="/dashboard/address" class="dashboard__title_link">Back to addressbook</a>
    </div>
    <div class="dashboard__divider first"></div>
    <form action="{{ route('dashboard.new_address') }}" data-target_modal="add_address" method="POST" class="cart__left_shipping_form w-60 dashboard__form">
        @csrf

        @if(Session::has('status'))
            <p class="alert alert-success" style="background-color: green;color: #fff; padding: 15px;">{{ Session::get('status') }}</p>
        @endif

        @if ($errors->any())
            <div class="col-12 form-group">
                <div class="alert alert-danger" style="background: #ff8000; color: #fff; padding: 10px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <br/>
                </div>
            </div>
        @endif

        <div class="cart__left_shipping_form_group">
            <div class="cart__left_shipping_form_item">
                <input type="text" name="first_name"  placeholder="First Name" value="" required>
            </div>
            <div class="cart__left_shipping_form_item">
                <input type="text"  name="last_name" placeholder="Last Name" value="" required>
            </div>
        </div>
        <div class="cart__left_shipping_form_group">
            <div class="cart__left_shipping_form_item">
                <input type="text" placeholder="Business Name" name="business_name" value="" required>
            </div>
            <div class="cart__left_shipping_form_item">
                <input type="text" placeholder="Phone" name="phone" value="" required>
            </div>
           
        </div>
        <div class="cart__left_shipping_form_group">
            <div class="cart__left_shipping_form_item">
                <input type="text" placeholder="Address Line 1*" name="address_line_1" required>
            </div>
             <div class="cart__left_shipping_form_item">
                <input type="text" placeholder="Address Line 2" name="address_line_2">
            </div>
        </div>
        <div class="cart__left_shipping_form_group">
            <div class="cart__left_shipping_form_item">
                <input type="text" placeholder="Postal Code" name="postal_code" required>
            </div>
            <div class="cart__left_shipping_form_item">
                <select name="city">
                    <option value="">Choose City</option>
                    <option value="Montreal">Montreal</option>
                </select>
            </div>            
        </div>
        <div class="cart__left_shipping_form_group">
            <div class="cart__left_shipping_form_item">
                <select name="state">
                    <option value="">Choose State</option>
                    <option value="Quebec">Quebec</option>
                </select>
            </div>
            <div class="cart__left_shipping_form_item">
                <select name="country">
                    <option value="">Choose Country</option>
                    <option value="Canada">Canada</option>
                </select>
            </div>            
        </div>
        <div class="cart__left_shipping_form_item">
            <div class="cart__left_shipping_radio_left d-flex align-center">
                <label class="d-flex align-center">
                    <input type="checkbox" name="is_default">
                    <div class="cart__left_shipping_radio_input"></div>
                    <div class="cart__left_shipping_radio_text">Use this default address</div>
                </label>
            </div>
        </div>
        <div class="dashboard__form_buttons">
            <div class="dashboard__form_button">
                <button type="submit" class="button button_secondary button_small cursor-pointer">Save address</button>
            </div>
        </div>
    </form>



    <div class="modal" data-modal_name="add_address">
        <div class="modal__in">
            <div class="modal__closer">
                <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
            </div>
            <div class="modal__body add_address">
                <div class="text">New address added successfully</div>
            </div>
        </div>
        <div class="modal__blur"></div>
    </div>
@endsection
