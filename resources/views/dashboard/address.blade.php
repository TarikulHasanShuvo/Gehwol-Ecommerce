@extends('layouts.dashboard')

@section('content')
    <div class="dashboard__title_with_link">
        <div class="dashboard__title">address book</div>
        <a href="/dashboard/address/new" class="dashboard__title_link">add a new address</a>
    </div>
    <div class="dashboard__divider first"></div>
    <div class="dashboard__addresses">
        <div class="dashboard__addresses_top">
            <div class="dashboard__addresses_title">Default delivery Address</div>
            @if(isset($default_address))
                <div class="dashboard__addresses_links">
                    <a href="/dashboard/address/edit/{{ $default_address->id }}">edit</a>
                    <form action="{{ route('dashboard.delete_address', ['id' => $default_address->id ]) }}">
                        @csrf
                        <a class="address-delete cursor-pointer">remove</a>
                    </form>
                </div>
            @endif
        </div>
        <div class="dashboard__addresses_bottom">
            <div class="dashboard__addresses_item">
                <div class="text">
                    @if(isset($default_address))
                        <div>{{ $default_address->first_name }} {{ $default_address->last_name }}</div>
                        <div>{{ $default_address->phone }}</div>
                        <div>{{ $default_address->address_line_1 }} {{ $default_address->address_line_2 }}</div>
                        <div>{{ $default_address->postal_code }}, {{ $default_address->city }}</div>
                        <div>{{ $default_address->state }}, {{ $default_address->country }}</div>
                    @else
                        <h5>No default address found.</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard__divider first"></div>
    <div class="dashboard__addresses">
        <div class="dashboard__addresses_top">
            <div class="dashboard__addresses_title">Other address</div>
        </div>
        <div class="dashboard__addresses_bottom">
            @if(count($addresses) > 0)
                @foreach($addresses as $address)
                    <div class="dashboard__addresses_item">
                        <div>{{ $address->first_name }} {{ $address->last_name }}</div>
                        <div>{{ $address->phone }}</div>
                        <div>{{ $address->address_line_1 }} {{ $address->address_line_2 }}</div>
                        <div>{{ $address->postal_code }}, {{ $address->city }}</div>
                        <div>{{ $address->state }}, {{ $address->country }}</div>

                        <div class="buttons">
                            <div class="dashboard__addresses_links">
                                <a href="/dashboard/address/edit/{{ $address->id }}">edit</a>
                                <form action="{{ route('dashboard.delete_address', ['id' => $address->id ]) }}">
                                    @csrf
                                    <a class="address-delete cursor-pointer">remove</a>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h5>No Address Found.</h5>
            @endif
        </div>
    </div>
@endsection
