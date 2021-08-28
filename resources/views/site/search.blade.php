@extends('layouts.site')

@section('content')
    <div class="breadcrumbs">
        <a href="index.html">Home</a>
        <span class="divider">|</span>
        <span>Search for the word "{{ $q }}"</span>
    </div>
    <h1 class="page_title">
        search
    </h1>
    <div class="container blog">
        <form action="/search" method="get" class="search__bar">
            <input type="text" name="q" value="{{ $q?$q:'' }}" placeholder="Search">
            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 22 23" fill="none"><path d="M21.738 21.404L16.6106 16.0436C16.2612 15.6783 15.6954 15.6783 15.346 16.0436C14.9966 16.4085 14.9966 17.0007 15.346 17.3656L20.4734 22.7261C20.6481 22.9087 20.8767 23 21.1057 23C21.3343 23 21.5633 22.9087 21.738 22.7261C22.0873 22.3611 22.0873 21.769 21.738 21.404Z" fill="#E45A54"></path><path d="M9.68833 0C4.34633 0 0 4.54389 0 10.1287C0 15.7138 4.34633 20.2574 9.68833 20.2574C15.0306 20.2574 19.3767 15.7138 19.3767 10.1287C19.3767 4.54389 15.0306 0 9.68833 0ZM9.68833 18.3876C5.33246 18.3876 1.78862 14.6826 1.78862 10.1288C1.78862 5.57489 5.33246 1.86992 9.68833 1.86992C14.0442 1.86992 17.588 5.57485 17.588 10.1287C17.588 14.6826 14.0442 18.3876 9.68833 18.3876Z" fill="#E45A54"></path></svg>
            </button>
        </form>
        <div class="blog__top_buttons d-flex align-center">
            <a href="/search?q={{ $q?$q:'' }}" class="blog__top_button button button_outlied button_small {!! $itemType !== 'all'?'blog__top_button_disabled':'' !!}">All ({{$searchResults->total_product + $searchResults->total_blog}})</a>
            <a href="/search?item_type=product&q={{ $q?$q:'' }}" class="blog__top_button button button_outlied button_small {!! $itemType !== 'product'?'blog__top_button_disabled':'' !!}">Products ({{$searchResults->total_product}})</a>
            <a href="/search?item_type=content&q={{ $q?$q:'' }}" class="blog__top_button button button_outlied button_small {!! $itemType !== 'content'?'blog__top_button_disabled':'' !!}">Content ({{$searchResults->total_blog}})</a>
        </div>
        <div class="blog__items">
            @foreach($searchResults as $item)
                @if($item['item_type'] === 'blog')
                <div class="blog__item search_result">
                    <div class="blog__item_top">
                        <div class="blog__item_image search_result">
                            <img src="{{ asset('storage/images/'.$item['image']) }}" width="100%" alt="{{ $item['title'] }}" height="243">
                        </div>
                        <div class="blog__item_title search_result">
                            {{ $item['title'] }}
                        </div>
                        <div class="blog__item_descroption search_result">
                            {{ substr(strip_tags(html_entity_decode($item['description'])), 0, 110) }} ...
                        </div>
                    </div>
                    <div class="blog__item_buttons">
                        <a href="/blog/details/{{$item['id']}}" class="button button_outlied button_small">Learn More</a>
                        <div class="blog__item_buttons_date">
                            {{ date('F j, Y', strtotime($item['updated_at'])) }}
                        </div>
                    </div>
                </div>
                @else
                <div class="catalog_products__item">
                    <div class="products__item">
                        <div class="products__item_image">
                            <img src="{{ ($item['first_image'] && $item['first_image']['image'])?'/storage/images/'.$item['first_image']['image']:asset('img/no-img.png') }}" width="100%" height="243" alt="{{ $item['name'] }}">
                        </div>
                        <a href="/product/{{ $item['id'] }}" class="products__item_name">
                            {{ $item['name'] }} {{ $item['unit_value'] }}{{ $item['unit_type'] }}
                        </a>
                        <div class="d-flex align-center">
                            <div class="products__item_stars">
                                <div class="products__item_stars_in" style="width: {{ 20*$item['rating'] }}%;"></div>
                            </div>
                            <div class="products__item_raiting">
                                Rating: {{ round($item['rating'],1) }}
                            </div>
                        </div>
                        <div class="products__item_price">
                            ${{ $item['price'] }}
                        </div>
                        <div class="products__item_buttons d-flex align-center justify-space-between">
                            <a href="javascript:void(0)" class="button button_outlied button_small add_to_cart" data-action="{!! route('api.carts.add') !!}" data-product-id="{!! $item['id'] !!}">Cart</a>
                            <a href="javascript:void(0)" class="button button_secondary button_small add_to_wishlist" data-action="{!! route('api.wishlists.add') !!}" data-product-id="{!! $item['id'] !!}">WISHLIST</a>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        @if ($searchResults->lastPage() > 1)
            <div class="catalog_products__pages">
                <a href="{{ $searchResults->url(1) }}" class="prev arrow {{ ($searchResults->currentPage() == 1) ? ' disabled' : '' }}">
                    <img src="/img/svg/arrow.svg" width="100%" alt="">
                </a>

                @for ($i = 1; $i <= $searchResults->lastPage(); $i++)
                    <a href="{{ $searchResults->url($i) }}" class="page {{ ($searchResults->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
                @endfor

                <a href="{{ $searchResults->url($searchResults->currentPage()+1) }}" class="next arrow {{ ($searchResults->currentPage() == $searchResults->lastPage()) ? ' disabled' : '' }}">
                    <img src="/img/svg/arrow.svg" width="100%" alt="">
                </a>
            </div>
        @endif

    </div>
@endsection
