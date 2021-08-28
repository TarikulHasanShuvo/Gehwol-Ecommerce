@extends('layouts.dashboard')

@section('content')
    <div class="dashboard__title_with_link">
        <div class="d-flex align-center">
            <div class="dashboard__title">Event history</div>
            <div class="dashboard__order_count">Number of orders:     1</div>
        </div>
         <a href="#" class="dashboard__title_link">Clear all</a>
    </div>
    <div class="dashboard__order_top">
        <div class="dashboard__order_table_head dashboard__order_width name">Event name</div>
        <div class="dashboard__order_table_head dashboard__order_width date">DAte</div>
        <div class="dashboard__order_table_head dashboard__order_width time">Time</div>
        <div class="dashboard__order_table_head dashboard__order_width ticket">Your Ticket</div>
        <div class="dashboard__order_table_head dashboard__order_width author">Event author</div>
        <div class="dashboard__order_table_head dashboard__order_width status">Status</div>
    </div>
    <div class="dashboard__order_items">
        <div class="dashboard__order_item">
            <div class="dashboard__order_width name">
                <div class="text">Uniqcure  and mymask, mini facials to maximize your treatments</div>
            </div>
            <div class="dashboard__order_width date">
                <div class="text">March 25, 2021</div>
            </div>
            <div class="dashboard__order_width time">
                <div class="text">12:00 pm - 01:00 pm</div>
            </div>
            <div class="dashboard__order_width ticket">
                <div class="text">30</div>
            </div>
            <div class="dashboard__order_width author">
                <div class="text">Ashley Durbano</div>
            </div>
            <div class="dashboard__order_width status">
                <div class="order_status">
                    <div class="dashboard__order_status">Expected</div>
                    <div class="delete_button">
                        <div class="icon">
                            <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard__order_item">
            <div class="dashboard__order_width name">
                <div class="text">Uniqcure  and mymask, mini facials to maximize your treatments</div>
            </div>
            <div class="dashboard__order_width date">
                <div class="text">March 25, 2021</div>
            </div>
            <div class="dashboard__order_width time">
                <div class="text">12:00 pm - 01:00 pm</div>
            </div>
            <div class="dashboard__order_width ticket">
                <div class="text">30</div>
            </div>
            <div class="dashboard__order_width author">
                <div class="text">Ashley Durbano</div>
            </div>
            <div class="dashboard__order_width status">
                <div class="order_status">
                    <div class="dashboard__order_status completed">Completed</div>
                    <div class="delete_button">
                        <div class="icon">
                            <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
