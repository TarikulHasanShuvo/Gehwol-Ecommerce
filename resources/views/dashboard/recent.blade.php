@extends('layouts.dashboard')

@section('content')
    <div class="dashboard__title_with_link">
        <div class="d-flex align-center">
            <div class="dashboard__title">Recent Products</div>
        </div>
         <a href="#" class="dashboard__title_link">continue the shopping</a>
    </div>
    <div class="dashboard__divider first"></div>

    <div class="catalog_products__in">
        @if(count($recentProducts) > 0)
            @foreach($recentProducts as $product)
            <div class="catalog_products__item dashboard__wishlist_product">
                <div class="products__item">
                    <div class="products__item_image">
                        <img src="/storage/images/{{ !empty($product['images']) ?  $product['images'][0]['image'] : ''}}" width="100%" height="200px" alt="">
                    </div>
                    <a href="/product/{{ $product['id'] }}" class="products__item_name">
                        {{ $product->name }}
                    </a>
                    <div class="d-flex align-center">
                        <div class="products__item_stars">
                            <div class="products__item_stars_in" style="width: {{ 20*$product['rating'] }}%;"></div>
                        </div>
                        <div class="products__item_raiting">
                            Rating: {{ round($product['rating'],1) }}
                        </div>
                    </div>
                    <div class="products__item_price">
                        ${{ number_format($product->price,2)  }}
                    </div>
                    <div class="products__item_buttons d-flex align-center justify-space-between">
                        <a href="javascript:void(0)" class="button button_outlied button_small add_to_cart" data-action="{!! route('api.carts.add') !!}" data-product-id="{!! $product->id !!}">Cart</a>
                        <a href="javascript:void(0)" class="button button_secondary button_small add_to_wishlist" data-action="{!! route('api.wishlists.add') !!}" data-product-id="{!! $product['id'] !!}">WISHLIST</a>
                    </div>
                </div>
            </div>
        @endforeach
        @else
            <h5>No Recent Product Found.</h5>
        @endif
    </div>

    @if ($recentProducts->lastPage() > 1)
        <div class="catalog_products__pages">
            <a href="{{ $recentProducts->url(1) }}" class="prev arrow {{ ($recentProducts->currentPage() == 1) ? ' disabled' : '' }}">
                <img src="/img/svg/arrow.svg" width="100%" alt="">
            </a>

            @for ($i = 1; $i <= $recentProducts->lastPage(); $i++)
                <a href="{{ $recentProducts->url($i) }}" class="page {{ ($recentProducts->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endfor

            <a href="{{ $recentProducts->url($recentProducts->currentPage()+1) }}" class="next arrow {{ ($recentProducts->currentPage() == $recentProducts->lastPage()) ? ' disabled' : '' }}">
                <img src="/img/svg/arrow.svg" width="100%" alt="">
            </a>
        </div>
    @endif

    <div class="modal" data-modal_name="recent_empty">
        <div class="modal__in">
            <div class="modal__closer">
                <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
            </div>
            <div class="modal__body clear_orders">
                <div class="text">The recent products is empty</div>
                <div class="d-flex align-center justify-center">
                    <a href="/" class="button button_secondary button_small close_modal">Homepage</a>
                </div>
            </div>
        </div>
        <div class="modal__blur"></div>
    </div>
@endsection
