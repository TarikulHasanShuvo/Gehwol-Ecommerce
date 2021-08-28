@extends('layouts.site')

@section('content')
    <div class="breadcrumbs">
        <a href="/">Home</a>
        <span class="divider">|</span>
        <span class="text-uppercase">{{ isset($category)?$category->name: $filterBy . ' '.'PRODUCTS'  }}</span>
    </div>
    <h1 class="page_title">
        {{ isset($category)?$category->name: $filterBy . ' '.'PRODUCTS'  }}
    </h1>
    <div class="container">
        <div class="sort">
            <div class="d-flex align-center">
                <div class="sort__title">Filter by:</div>
                <div class="sort__select">
                    <select onchange="location = this.value">
                        @foreach($categories as $category)
                            <option value="/category/?filter_by={{ $category->id }}" {!! $filterBy == $category->id ?'selected':'' !!}>{{ $category->name }}</option>
                        @endforeach
                        <option value="/category/?filter_by=new" {!! $filterBy === 'new'?'selected':'' !!}>NEW</option>
                        <option value="/category/?filter_by=professional" {!! $filterBy === 'professional'?'selected':'' !!}>PROFESSIONAL</option>
                        <option value="/category/?filter_by=all" {!! $filterBy === 'all'?'selected':'' !!}>ALL CATEGORIES</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="catalog_products">
            <div class="catalog_products__in">
                @if(count($products) > 0)
                    @foreach($products as $product)
                        <div class="catalog_products__item">
                            <div class="products__item">
                                <div class="products__item_image">
                                    @if(!empty($product->images) && !empty($product->images[0]->image))
                                        <img src="/storage/images/{{ $product->images[0]->image }}" width="100%"
                                             height="200px" alt="">
                                    @else
                                        <img src="{{ asset('img/no-img.png') }}"
                                             width="100%" height="200px" alt="">
                                    @endif

                                </div>
                                <a href="/product/{{$product->id}}" class="products__item_name">
                                    {{ $product->name ?? '' }}
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
                                    $ {{ $product->price ?? '' }}
                                </div>
                                <div class="products__item_buttons d-flex align-center justify-space-between">
                                    <a href="javascript:void(0)" class="button button_outlied button_small add_to_cart" data-action="{!! route('api.carts.add') !!}" data-product-id="{!! $product->id !!}">Cart</a>
                                    <a href="javascript:void(0)" class="button button_secondary button_small add_to_wishlist" data-action="{!! route('api.wishlists.add') !!}" data-product-id="{!! $product->id !!}">WISHLIST</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                   <div class="no-product">
                       <h1>No products found.</h1>
                   </div>
                @endif
            </div>
            <div class="w-100">
                {{ $products->links('pagination.custom') }}
            </div>
        </div>
    </div>
@endsection
