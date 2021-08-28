@extends('layouts.dashboard')

@section('content')
    <div class="dashboard__title_with_link">
        <div class="d-flex align-center">
            <div class="dashboard__title">Order #{!! $order->order_uid !!}</div>
            <div class="dashboard__order_status">{{ $order->status }}</div>
        </div>
        <div class="dashboard__order_print" onclick="window.print();">
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 20 20" fill="none">
                <path d="M6.09375 17.6562H13.9062C14.2299 17.6562 14.4922 17.394 14.4922 17.0703C14.4922 16.7467 14.2299 16.4844 13.9062 16.4844H6.09375C5.77011 16.4844 5.50781 16.7467 5.50781 17.0703C5.50781 17.394 5.77011 17.6562 6.09375 17.6562Z" fill="#A5A5A5"/>
                <path d="M6.09375 15.3125H13.9062C14.2299 15.3125 14.4922 15.0502 14.4922 14.7266C14.4922 14.4029 14.2299 14.1406 13.9062 14.1406H6.09375C5.77011 14.1406 5.50781 14.4029 5.50781 14.7266C5.50781 15.0502 5.77011 15.3125 6.09375 15.3125Z" fill="#A5A5A5"/>
                <path d="M18.6328 5.58594H16.7578V1.36719C16.7578 0.613251 16.1446 0 15.3906 0H4.60938C3.85544 0 3.24219 0.613251 3.24219 1.36719V5.58594H1.36719C0.613251 5.58594 0 6.19919 0 6.95312V15.3906C0 16.1446 0.613251 16.7578 1.36719 16.7578H3.24219V18.6328C3.24219 19.3867 3.85544 20 4.60938 20H15.3906C16.1446 20 16.7578 19.3867 16.7578 18.6328V16.7578H18.6328C19.3867 16.7578 20 16.1446 20 15.3906V6.95312C20 6.19919 19.3867 5.58594 18.6328 5.58594ZM4.41406 1.36719C4.41406 1.25946 4.50165 1.17188 4.60938 1.17188H15.3906C15.4984 1.17188 15.5859 1.25946 15.5859 1.36719V5.58594H4.41406V1.36719ZM15.5859 18.6328C15.5859 18.7405 15.4984 18.8281 15.3906 18.8281H4.60938C4.50165 18.8281 4.41406 18.7405 4.41406 18.6328V12.9688H15.5859V18.6328ZM18.8281 15.3906C18.8281 15.4984 18.7405 15.5859 18.6328 15.5859H16.7578V12.3828C16.7578 12.0592 16.4955 11.7969 16.1719 11.7969H3.82812C3.50449 11.7969 3.24219 12.0592 3.24219 12.3828V15.5859H1.36719C1.25946 15.5859 1.17188 15.4984 1.17188 15.3906V6.95312C1.17188 6.8454 1.25946 6.75781 1.36719 6.75781H18.6328C18.7405 6.75781 18.8281 6.8454 18.8281 6.95312V15.3906Z" fill="#A5A5A5"/>
                <path d="M17.4609 8.71094C17.4609 9.03458 17.1986 9.29688 16.875 9.29688C16.5514 9.29688 16.2891 9.03458 16.2891 8.71094C16.2891 8.3873 16.5514 8.125 16.875 8.125C17.1986 8.125 17.4609 8.3873 17.4609 8.71094Z" fill="#A5A5A5"/>
            </svg>
        </div>
    </div>
    <div class="dashboard__order_top">
        <div class="dashboard__order_table_head dashboard__order_width products_head">Products</div>
        <div class="dashboard__order_table_head dashboard__order_width code">Code</div>
        <div class="dashboard__order_table_head dashboard__order_width order_date">Date</div>
        <div class="dashboard__order_table_head dashboard__order_width price">Price</div>
        <div class="dashboard__order_table_head dashboard__order_width quantity">QUANTITY</div>
        <div class="dashboard__order_table_head dashboard__order_width order_total">Total</div>
    </div>
    <div class="dashboard__order_items">
        @php
            $subTotal = 0;
        @endphp

        @foreach($order->gift_certificates as $item)
            <div class="dashboard__order_item">
                <div class="dashboard__order_width products_head">
                    <div class="d-flex align-start">
                        <div class="dashboard__order_image">

                        </div>
                        <div class="dashboard__order_text text">Gift Certificate, ${{ $item->unit_price }}</div>
                    </div>
                </div>
                <div class="dashboard__order_width text code">

                </div>
                <div class="dashboard__order_width text order_date">{{ date('j F, Y', strtotime($order->order_date)) }}</div>
                <div class="dashboard__order_width text price">${{ $item->unit_price }}</div>
                <div class="dashboard__order_width text quantity">{{ $item->quantity }}</div>
                <div class="dashboard__order_width text order_total">${{ number_format($item->unit_price * $item->quantity, 2) }}</div>
            </div>

            @php
                $subTotal += $item->unit_price * $item->quantity;
            @endphp
        @endforeach

        @foreach($order->products as $item)
            <div class="dashboard__order_item">
                <div class="dashboard__order_width products_head">
                    <div class="d-flex align-start">
                        <div class="dashboard__order_image">
                            <img src="/storage/images/{{ (isset($item->product->product_images) && count($item->product->product_images)) ?  $item->product->product_images[0]['image'] : ''}}" style="width: 100%; max-height: 120px" alt="">
{{--                            <img src="{{ asset('img/product_slider.jpg') }}" alt="">--}}
                        </div>
                        <div class="dashboard__order_text text">{{ $item->product->name }}, 75 ml</div>
                    </div>
                </div>
                <div class="dashboard__order_width text code">
                    {{ $item->product->code }}
                </div>
                <div class="dashboard__order_width text order_date">{{ date('j F, Y', strtotime($order->order_date)) }}</div>
                <div class="dashboard__order_width text price">${{ $item->unit_price }}</div>
                <div class="dashboard__order_width text quantity">{{ $item->quantity }}</div>
                <div class="dashboard__order_width text order_total">${{ number_format($item->unit_price * $item->quantity, 2) }}</div>
            </div>

            @php
                $subTotal += $item->unit_price * $item->quantity;
            @endphp
        @endforeach
    </div>
    <div class="dashboard__order_totals">
        <div class="dashboard__order_total_item">
            <div class="left">Subtotal</div>
            <div class="right">${{ number_format($subTotal, 2) }}</div>
        </div>
        <div class="dashboard__order_total_item">
            <div class="left">shipping</div>
            <div class="right">${{ number_format($order->shipping_charge, 2) }}</div>
        </div>
        <div class="dashboard__order_total_item">
            <div class="left">canada gst</div>
            <div class="right">${{ number_format($order->gst, 2) }}</div>
        </div>
        <div class="dashboard__order_total_item">
            <div class="left">Discount</div>
            <div class="right">${{ number_format($order->discount, 2) }}</div>
        </div>
        <div class="dashboard__order_total_item_divider"></div>
        <div class="dashboard__order_total_item">
            <div class="left">total</div>
            <div class="total">${{ number_format($order->total, 2) }}</div>
        </div>
    </div>
    <div class="dashboard__order_shipping">
        <div class="dashboard__title">Shipping Information</div>
        <div class="dashboard__order_shipping_items d-flex align-start">
            <div class="dashboard__order_shipping_item">
                <div class="dashboard__addresses_top">
                    <div class="dashboard__addresses_title">
                        Shipping address
                    </div>
                </div>
                <div class="dashboard__addresses_item">
                    <div class="text">
                        <div>{{ $order->ship_first_name . ' '. $order->ship_last_name }}</div>
                        <div>{{ $order->ship_phone }}</div>
                        <div>{{ $order->ship_address_line_1 }}</div>
                        @if($order->ship_address_line_2)
                        <div>{{ $order->ship_address_line_2 }}</div>
                        @endif
                        <div>{{ $order->ship_city . ', '.$order->ship_state.', '.$order->ship_postal_code }}</div>
                        <div>{{ $order->ship_country }}</div>
                    </div>
                </div>
            </div>
            <div class="dashboard__order_shipping_item">
                <div class="dashboard__addresses_top">
                    <div class="dashboard__addresses_title">
                        Shipping method
                    </div>
                </div>
                <div class="dashboard__addresses_item">
                    <div class="text">
                        <div>{{ ucwords(str_replace('_',' ',$order->shipping_method)) }}</div>
                    </div>
                </div>
            </div>
            <div class="dashboard__order_shipping_item">
                <div class="dashboard__addresses_top">
                    <div class="dashboard__addresses_title">
                        Shipping Date
                    </div>
                </div>
                <div class="dashboard__addresses_item">
                    <div class="text">
                        <div>{{ $order->shipped_date?date('j F, Y', strtotime($order->shipped_date)):'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
