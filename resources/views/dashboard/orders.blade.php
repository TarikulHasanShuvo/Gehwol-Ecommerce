@extends('layouts.dashboard')

@section('content')
    <div class="dashboard__title_with_link">
        <div class="d-flex align-center">
            <div class="dashboard__title">Order history</div>
            <div class="dashboard__order_count">Number of orders: {{ count($orders) }}</div>
        </div>
         <a href="#" class="dashboard__title_link clear_order_list">Clear all</a>
    </div>
    <div class="dashboard__order_top">
        <div class="dashboard__order_table_head dashboard__order_width order">Order</div>
        <div class="dashboard__order_table_head dashboard__order_width date">DAte</div>
        <div class="dashboard__order_table_head dashboard__order_width recipient">Recipient</div>
        <div class="dashboard__order_table_head dashboard__order_width total">Total</div>
        <div class="dashboard__order_table_head dashboard__order_width status">Status</div>
    </div>
    <div class="dashboard__order_items">
        @foreach($orders as $order)
        <div class="dashboard__order_item">
            <div class="dashboard__order_width order">
                <div class="text">{{ $order->order_uid }}</div>
            </div>
            <div class="dashboard__order_width date">
                <div class="text">{{ date('j F, Y', strtotime($order->order_date)) }}</div>
            </div>
            <div class="dashboard__order_width recipient">
                <div class="text">{{ $order->ship_first_name . ' '. $order->ship_last_name }}</div>
            </div>
            <div class="dashboard__order_width total">
                <div class="text">${{ number_format($order->total, 2) }}</div>
            </div>
            <div class="dashboard__order_width status">
                <div class="order_status">
                    <div class="dashboard__order_status">{{ $order->status }}</div>
                    <div class="delete_button">
                        <a href="/dashboard/orders/{!! $order->order_uid !!}" class="text">More detailed</a>
                        <div class="devider"></div>
                        <div class="icon">
                            <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>




    <div class="modal" data-modal_name="clear_orders">
        <div class="modal__in">
            <div class="modal__closer">
                <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
            </div>
            <div class="modal__body clear_orders">
                <div class="text">Are you sure you want to clear your wish list?</div>
                <div class="d-flex align-center justify-center">
                    <a href="#" class="button button_outlied button_small close_modal">Yes</a>
                    <a href="#" class="button button_secondary button_small close_modal">No</a>
                </div>
            </div>
        </div>
        <div class="modal__blur"></div>
    </div>

    <div class="modal" data-modal_name="orders_empty">
        <div class="modal__in">
            <div class="modal__closer">
                <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
            </div>
            <div class="modal__body clear_orders">
                <div class="text">The wish list is empty</div>
                <div class="d-flex align-center justify-center">
                    <a href="/category" class="button button_secondary button_small">Continue Shopping</a>
                </div>
            </div>
        </div>
        <div class="modal__blur"></div>
    </div>
@endsection
