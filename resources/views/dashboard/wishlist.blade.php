@extends('layouts.dashboard')

@section('content')
    <div class="dashboard__title_with_link">
        <div class="d-flex align-center">
            <div class="dashboard__title">Wish List</div>
        </div>
         <a href="#" class="dashboard__title_link">continue the shopping</a>
    </div>
    <div class="dashboard__divider first"></div>
    @if(count($wishlists) > 0)
        <div class="dashboard__clear">
            <a href="javascript:void(0)" class="clear_wishlist">Clear All</a>
        </div>
    @endif
    <div class="catalog_products__in">
        @if(count($wishlists) > 0)
            @foreach($wishlists as $list)
            <div class="catalog_products__item dashboard__wishlist_product" id="wishlist-item-{!! $list->id !!}">
                <div class="products__item">
                    <a href="javascript:void(0)" class="products__item_delete remove-wishlist" data-id="{!! $list->id !!}">
                        <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
                    </a>
                    <div class="products__item_image">
                        @if((isset($list->product->images) && count($list->product->images)))
                            <img src="/storage/images/{{$list->product->images[0]->image }}" width="100%"
                                 height="200px" alt="">
                        @else
                            <img src="{{ asset('img/no-img.png') }}"
                                 width="100%" height="200px" alt="">
                        @endif
                    </div>
                    <a href="/product" class="products__item_name">
                        {{ $list->product->name  }}
                    </a>
                    <div class="d-flex align-center">
                        <div class="products__item_stars">
                            <div class="products__item_stars_in" style="width: {{ 20*$list->product['rating'] }}%;"></div>
                        </div>
                        <div class="products__item_raiting">
                            Rating: {{ round($list->product['rating'],1) }}
                        </div>
                    </div>
                    <div class="products__item_price">
                        ${{ number_format($list->product->price, 2) }}
                    </div>
                    <div class="products__item_buttons d-flex align-center justify-space-between">
                        <a href="javascript:void(0)" class="button full_width button_outlied button_small add_to_cart" data-action="{!! route('api.carts.add') !!}" data-product-id="{!! $list['product_id'] !!}">Add to Cart</a>
                    </div>
                </div>
            </div>
        @endforeach
        @else
            <h5 style="margin-top:25px;">No Wishlist Found.</h5>
        @endif
    </div>

    @if ($wishlists->lastPage() > 1)
        <div class="catalog_products__pages">
            <a href="{{ $wishlists->url(1) }}" class="prev arrow {{ ($wishlists->currentPage() == 1) ? ' disabled' : '' }}">
                <img src="/img/svg/arrow.svg" width="100%" alt="">
            </a>

            @for ($i = 1; $i <= $wishlists->lastPage(); $i++)
                <a href="{{ $wishlists->url($i) }}" class="page {{ ($wishlists->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endfor

            <a href="{{ $wishlists->url($wishlists->currentPage()+1) }}" class="next arrow {{ ($wishlists->currentPage() == $wishlists->lastPage()) ? ' disabled' : '' }}">
                <img src="/img/svg/arrow.svg" width="100%" alt="">
            </a>
        </div>
    @endif

    <div class="modal" data-modal_name="clear_wishlist">
        <div class="modal__in">
            <div class="modal__closer">
                <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
            </div>
            <div class="modal__body clear_orders">
                <div class="text">Are you sure you want to clear your wish list?</div>
                <div class="d-flex align-center justify-center">
                    <a href="javascript:void(0)" class="button button_outlied button_small close_modal remove-wishlist">Yes</a>
                    <a href="javascript:void(0)" class="button button_secondary button_small close_modal">No</a>
                </div>
            </div>
        </div>
        <div class="modal__blur"></div>
    </div>

    <div class="modal" data-modal_name="wishlist_empty">
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
