@extends('layouts.site')

@section('meta-page-url', url()->current())
@section('meta-title', 'Gehwol | '. $product->name)
@section('description', $product->description)
@section('meta-image-url', (isset($product['images']) && count($product['images']))?asset('storage/images/'.$product['images'][0]['image']):asset('/img/products1.jpg'))

@section('content')
    <div class="breadcrumbs">
        <a href="/">Home</a>
        <span class="divider">|</span>
        <span>{{ $product->name ?? '' }} </span>

    </div>
    <div class="product_page">
        <div class="container">
            <div class="product_page__top">
                <div class="product_page__images">
                    <div class="product_page__slider">
                        @foreach($product->images as $image)
                            <a href="/storage/images/{{ $image->image }}" class="product_page__slider_item" data-jbox-image="gallery1">
                                <img src="/storage/images/{{ $image->image }}" alt="">
                            </a>
                        @endforeach

                        <a href="/img/product_slider.jpg" class="product_page__slider_item" data-jbox-image="gallery1">

                            <img src="/storage/images/{{ $product->images }}" alt="">

                        </a>
                        <a href="/img/slider.jpg" class="product_page__slider_item" data-jbox-image="gallery1">
                            <img src="/img/slider.jpg" alt="">
                        </a>
                        <a href="/img/product_slider.jpg" class="product_page__slider_item" data-jbox-image="gallery1">
                            <img src="/img/product_slider.jpg" alt="">
                        </a>
                    </div>
                    <div class="product_page__thumbs">
                        <div class="product_page__thumbs_in">
                            @foreach($product->images as $image)
                                <div class="product_page__thumb">
                                    <img src="/storage/images/{{ $image->image }}" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="product_page__marks">
                        @if(isset($product->new) && $product->new == 1)
                            <div class="product_page__mark new">NEW</div>
                        @endif
                        {{--@if(isset($product->professional))
                            <div class="product_page__mark sale">PROFESSIONAL</div>
                        @endif--}}
                    </div>
                    <div class="product_page__buttons">
                        <div class="product_page__button add_to_wishlist" data-action="{!! route('api.wishlists.add') !!}" data-product-id="{!! $product['id'] !!}">
                            <img src="/img/svg/button_heart.svg" width="100%" alt="">
                        </div>
                        <div class="product_page__button fullscreen">
                            <img src="/img/svg/button_fullscreen.svg" width="100%" alt="">
                        </div>
                    </div>
                </div>
                <div class="product_page__info">
                    <h1 class="product_page__name">{{ $product->name ?? '' }} </h1>
                    <div class="product_page__description">
                        {{ $product->name ?? '' }}
                    </div>
                    <div class="product_page__raiting">
                        <div class="d-flex align-center">
                            <div class="products__item_stars">
                                <div class="products__item_stars_in" style="width: {{ 20*$product->rating }}%;"></div>
                            </div>
                            <div class="products__item_raiting">
                                Rating: {{ round($product->rating,1) }}
                            </div>
                        </div>
                        <div class="products__item_raiting product_page__rev_count">
                            {{ count($productReviews) }} reviews
                        </div>
                    </div>
                    <div class="product_page__prices">
                        <div class="product_page__price">${{ number_format($product->price,2) }}</div>
                        @if(!empty($product->original_price ) && $product->original_price > 0)
                            <div class="product_page__price_old">$ {{ !empty($product->original_price ) && $product->original_price > 0 ? number_format($product->original_price,2) : 0 }}</div>
                        @endif
                    </div>
                    <div class="d-flex align-center">
                        <div class="product_page__counter">
                            <button id="minus">-</button>
                            <output id="count">1</output>
                            <button id="plus">+</button>
                        </div>
                        <button class="product_page__add_to_cart button button_seconary button_small add_to_cart" data-action="{!! route('api.carts.add') !!}" data-product-id="{!! $product->id !!}" data-page="product-view">
                            Add to cart
                        </button>
                    </div>
                    <div class="product_page__share d-flex">
                        <div class="product_page__share_item">
                            <div class="title">Share</div>
                            <div class="d-flex align-center">
                                <a type="button" role="button" title="Share on twitter"
                                   href="https://twitter.com/intent/tweet?url={{ url()->current() }}"
                                   rel="noopener">
                                    <img src="/img/svg/twitter.svg" width="100%" height="100%" alt="twitter">
                                </a>

                                <div class="fb-share-button" data-href="{{ url()->current() }}" data-layout="button" data-size="small" style="width: 75px"></div>
{{--                                <a href="#">--}}
{{--                                    <img src="/img/svg/facebook.svg" width="100%" height="100%" alt="">--}}
{{--                                </a>--}}
                                <a href="mailto:?subject=I wanted you to see this product&amp;body=Check out this url {{ url()->current() }}">
                                    <img src="/img/svg/mail.svg" width="100%" height="100%" alt="mail">
                                </a>
                            </div>
                        </div>
                        <div class="product_page__share_item">
                            <div class="title">Save</div>
                            <div class="d-flex align-center">
{{--                                <a href="#">--}}
{{--                                    <img src="/img/svg/pinterest.svg" width="100%" height="100%" alt="">--}}
{{--                                </a>--}}

                                <a data-pin-do="buttonPin" data-pin-tall="true" data-pin-round="true" href="https://www.pinterest.com/pin/create/button/?url={!! url()->current() !!}&media={!! (isset($product['images']) && count($product['images']))?asset('storage/images/'.$product['images'][0]['image']):asset('/img/products1.jpg') !!}&description={!! $product->description !!}">
                                    <img src="/img/svg/pinterest.svg" width="100%" height="100%" alt="pinterest">
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="product_page__expand">
                        <div class="product_page__expand_item">
                            <div class="product_page__expand_title">
                                <div class="text">Product Description</div>
                                <div class="icon">
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="product_page__expand_body">
                                <div class="d-flex align-start product_page__expand_body_items">
                                    <div class="product_page__expand_body_item">
                                        <div class="title">Product Code / UPC Code</div>
                                        <div class="text">{{ $product->code }}  {{ $product->code ? ' / '.$product->code : '' }} </div>
                                    </div>
                                    <div class="product_page__expand_body_item">
                                        <div class="title">Range</div>
                                        <div class="text">{{ !empty($product->productRange) ? $product->productRange->name : ''}}</div>
                                    </div>
                                </div>

                                <div class="d-flex align-start product_page__expand_body_items">
                                    <div class="product_page__expand_body_item">
                                        <div class="title">Category / BL Category</div>

                                        <div class="text">{{ !empty($product->product_category) ? $product->product_category->name : '' }}
                                            {{ !empty($product->productBlCategory) ? ' / '.$product->productBlCategory->name : '' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-start product_page__expand_body_items">
                                    <div class="product_page__expand_body_item">
                                        <div class="title">Brand</div>
                                        <div class="text">{{ $product->brand ?? '' }}</div>
                                    </div>
                                    <div class="product_page__expand_body_item">
                                        <div class="title">Type</div>
                                        <div class="text">{{ !empty($product->productType) ? $product->productType->name : '' }}</div>
                                    </div>
                                </div>
                                <div class="product_page__expand_body_items">
                                    <div class="product_page__expand_body_item">
                                        <div class="title">Description</div>
                                        <div class="text">{{ $product->description ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product_page__expand_item">
                            <div class="product_page__expand_title">
                                <div class="text">Ingredients</div>
                                <div class="icon">
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="product_page__expand_body">
                                <div class="d-flex align-start product_page__expand_body_items">
                                    <div class="product_page__expand_body_item">
                                        <div class="title">Description</div>
                                        <div class="text">{{ $product->ingredient ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product_page__expand_item">
                            <div class="product_page__expand_title">
                                <div class="text">Application</div>
                                <div class="icon">
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="product_page__expand_body">
                                <div class="d-flex align-start product_page__expand_body_items">
                                    <div class="product_page__expand_body_item">
                                        <div class="title">Who can use</div>
                                        <div class="text">{{ $product->who_can_use ?? '' }}</div>
                                    </div>
                                </div>
                                <div class="d-flex align-start product_page__expand_body_items">
                                    <div class="product_page__expand_body_item">
                                        <div class="title">How to use</div>
                                        <div class="text">{{ $product->how_to_use ?? ''}}</div>
                                    </div>
                                </div>
                                <div class="d-flex align-start product_page__expand_body_items">
                                    <div class="product_page__expand_body_item">
                                        <div class="title">Who can use</div>
                                        <div class="text">{{ $product->whats_it_for ?? '' }}</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_page__print">
                    <!-- TODO continue here -->
                </div>
            </div>
        </div>
        <div class="product_page__middle">
            @if(count($relatedProducts) > 0)
                <div class="products">
                <div class="container">
                    <div class="products__title">
                        Related products
                    </div>
                    <div class="products__items">
                        @foreach($relatedProducts as $relProduct)
                            <div class="products__item">
                                <div class="products__item_image">
                                    @if(isset($relProduct['images'][0]['image']))
                                        <img src="/storage/images/{{ $relProduct['images'][0]['image'] }}" width="100%" height="250px" alt="Product Image">
                                    @else
                                        <img src="/img/products1.jpg" width="100%" alt="">
                                    @endif

                                </div>
                                <a href="/product/{{ $relProduct['id'] }}" class="products__item_name">
                                    {{ $relProduct['name']  }}
                                </a>
                                <div class="d-flex align-center">
                                    <div class="products__item_stars">
                                        <div class="products__item_stars_in" style="width: {{ 20*$relProduct['rating'] }}%;"></div>
                                    </div>
                                    <div class="products__item_raiting">
                                        Rating: {{ round($relProduct['rating'],1) }}
                                    </div>
                                </div>
                                <div class="products__item_price">
                                    ${{ number_format($relProduct['price'], 2)  }}
                                </div>
                                <div class="products__item_buttons d-flex align-center justify-space-between">
                                    <a href="javascript:void(0)" class="button button_outlied button_small add_to_cart" data-action="{!! route('api.carts.add') !!}" data-product-id="{!! $relProduct['id'] !!}">Cart</a>
                                    <a href="javascript:void(0)" class="button button_secondary button_small add_to_wishlist" data-action="{!! route('api.wishlists.add') !!}" data-product-id="{!! $relProduct['id'] !!}">WISHLIST</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            @if(count($recentlyViewdProducts) > 0)
                <div class="products">
                <div class="container">
                    <div class="products__title">
                        You recently watched
                    </div>
                    <div class="products__items">
                        @foreach($recentlyViewdProducts as $rProduct)
                            <div class="products__item">
                                <div class="products__item_image">
                                    @if(isset($rProduct['images'][0]['image']))
                                        <img src="/storage/images/{{ $rProduct['images'][0]['image'] }}" width="100%" height="250px" alt="Product Image">
                                    @else
                                        <img src="/img/products1.jpg" width="100%" alt="">
                                    @endif

                                </div>
                                <a href="/product/{{ $rProduct['id'] }}" class="products__item_name">
                                    {{ $rProduct['name']  }}
                                </a>
                                <div class="d-flex align-center">
                                    <div class="products__item_stars">
                                        <div class="products__item_stars_in" style="width: {{ 20*$rProduct['rating'] }}%;"></div>
                                    </div>
                                    <div class="products__item_raiting">
                                        Rating: {{ round($rProduct['rating'],1) }}
                                    </div>
                                </div>
                                <div class="products__item_price">
                                    ${{ number_format($rProduct['price'],2)  }}
                                </div>
                                <div class="products__item_buttons d-flex align-center justify-space-between">
                                    <a href="javascript:void(0)" class="button button_outlied button_small add_to_cart" data-action="{!! route('api.carts.add') !!}" data-product-id="{!! $rProduct['id'] !!}">Cart</a>
                                    <a href="javascript:void(0)" class="button button_secondary button_small add_to_wishlist" data-action="{!! route('api.wishlists.add') !!}" data-product-id="{!! $rProduct['id'] !!}">WISHLIST</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="product_page__bottom">
            <div class="container">
                <div class="product_page__reviews">
                    <div class="product_page__reviews_left">
                        <div class="products__title">
                            Product reviews
                        </div>
                        <div class="product_page__reviews_raiting d-flex align-center">
                            <div class="product_page__reviews_stars">
                                <div class="product_page__reviews_stars_count" style="width: {{ 20*$product->rating }}%;"></div>
                            </div>
                            <div class="product_page__reviews_count">Rating: {{ round($product->rating, 1) }}</div>
                        </div>

                        @php
                            $ratingPerPerson = ["5"=>0, "4"=>0, "3"=>0, "2"=>0, "1"=>0];
                            foreach ($productReviews as $pr) {
                                $ratingPerPerson[$pr['rating']] += 1;
                            }
                        @endphp

                        <div class="product_page__progress">
                            <div class="product_page__progress_item d-flex align-center">
                                <div class="text"><span>5</span> / 5</div>
                                <div class="progress">
                                    <div class="progress_count" style="width: {!! count($productReviews)?($ratingPerPerson[5]*100)/count($productReviews):0 !!}%"></div>
                                </div>
                                <div class="text text-right">{!! count($productReviews)?round(($ratingPerPerson[5]*100)/count($productReviews),1):0 !!} %</div>
                            </div>
                            <div class="product_page__progress_item d-flex align-center">
                                <div class="text"><span>4</span> / 5</div>
                                <div class="progress">
                                    <div class="progress_count" style="width: {!! count($productReviews)?($ratingPerPerson[4]*100)/count($productReviews):0 !!}%"></div>
                                </div>
                                <div class="text text-right">{!! count($productReviews)?round(($ratingPerPerson[4]*100)/count($productReviews),1):0 !!} %</div>
                            </div>
                            <div class="product_page__progress_item d-flex align-center">
                                <div class="text"><span>3</span> / 5</div>
                                <div class="progress">
                                    <div class="progress_count" style="width: {!! count($productReviews)?($ratingPerPerson[3]*100)/count($productReviews):0 !!}%"></div>
                                </div>
                                <div class="text text-right">{!! count($productReviews)?round(($ratingPerPerson[3]*100)/count($productReviews),1):0 !!} %</div>
                            </div>
                            <div class="product_page__progress_item d-flex align-center">
                                <div class="text"><span>2</span> / 5</div>
                                <div class="progress">
                                    <div class="progress_count" style="width: {!! count($productReviews)?($ratingPerPerson[2]*100)/count($productReviews):0 !!}%"></div>
                                </div>
                                <div class="text text-right">{!! count($productReviews)?round(($ratingPerPerson[2]*100)/count($productReviews),1):0 !!} %</div>
                            </div>
                            <div class="product_page__progress_item d-flex align-center">
                                <div class="text"><span>1</span> / 5</div>
                                <div class="progress">
                                    <div class="progress_count" style="width: {!! count($productReviews)?($ratingPerPerson[1]*100)/count($productReviews):0 !!}%"></div>
                                </div>
                                <div class="text text-right">{!! count($productReviews)?round(($ratingPerPerson[1]*100)/count($productReviews), 1):0 !!} %</div>
                            </div>
                        </div>
                        {{--<div class="product_page__reviews_add_button">
                            <button class="button button_secondary button_small">Write a review</button>
                        </div>--}}
                    </div>
                    <div class="product_page__reviews_right">
                        <div class="product_page__reviews_right_title">{{ count($productReviews) }} reviews</div>
                        <div class="product_page__reviews_items">
                            @foreach($productReviews as $review)
                                <div class="product_page__reviews_item">
                                    <div class="top d-flex align-center">
                                        <div class="title">Excellent</div>
                                        <div class="raiting">
                                            <div class="raiting_in" style="width: {{ $review['rating']*20 }}%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="middle">
                                        {{ $review['message'] }}
                                    </div>
                                    <div class="bottom">
                                        <div class="text">Author: {{ $review['reviewer_name'] }}</div>
                                        <div class="text">{{ date('j F, Y H:i:s', strtotime($review['created_at'])) }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
{{--                        <a href="#" class="button button_outlied button_small">More reviews</a>--}}{{----}}
                        <div class="product_page__reviews_form">
                            <div class="products__title">
                                Your review
                            </div>
                            <form action="/product/add-reviews/{{ request()->route('id') }}"  method="POST" class="ajax_review_form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="product_page__reviews_form_stars">
                                    <div class="rate">
                                        <input type="radio" id="star5" name="rating" value="5"/>
                                        <label for="star5"></label>
                                        <input type="radio" id="star4" name="rating" value="4"/>
                                        <label for="star4"></label>
                                        <input type="radio" id="star3" name="rating" value="3"/>
                                        <label for="star3"></label>
                                        <input type="radio" id="star2" name="rating" value="2"/>
                                        <label for="star2"></label>
                                        <input type="radio" id="star1" name="rating" value="1"/>
                                        <label for="star1"></label>
                                    </div>
                                </div>

                                <div class="product_page__reviews_form_inputs">
                                    <input type="text" placeholder="Name*" name="name" required
                                        class="contact_form__field contact_form__input"/>
                                    <input type="email" placeholder="Email*" name="email" required
                                        class="contact_form__field contact_form__input"/>
                                </div>

                                <textarea placeholder="Message*" name="message" required
                                    class="contact_form__field contact_form__textarea"></textarea>

                                <div class="contact_form__bottom d-flex align-center">
                                    <div class="left" style="width: auto;">
                                        <button type="submit" class="button button_secondary button_small cursor-pointer">Add&nbsp;a&nbsp;review</button>
                                    </div>
                                    <div class="right">
                                        <label class="d-flex align-center">
                                            <input type="checkbox" name="privacy" required>
                                            <div class="checkbox"></div>
                                            <div class="text">Review our <a href="#" class="text-decoration-none">privacy policy</a> here</div>
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="review-success-modal" data-modal_name="review-success-modal">
        <div class="modal__in">
            <div class="review_modal_close">
                <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
            </div>
            <div class="modal__body newsletter">
                <div class="title">Thanks!</div>
                <div class="text">We are very glad that you left your review about the product</div>
                <div class="centerred_button">
                    <a href="{{ route('category.products') }}" class="button button_outlied button_small">Continue shopping</a>
                </div>
            </div>
        </div>
        <div class="modal__blur"></div>
    </div>

    <div class="modal" id="review-error-modal" data-modal_name="review-error-modal">
        <div class="modal__in">
            <div class="modal__closer">
                <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
            </div>
            <div class="modal__body newsletter">
                <div class="title">Something went wrong.</div>
                <div class="review-error-modal-error-msg text-danger"></div>
            </div>
        </div>
        <div class="modal__blur"></div>
    </div>
@endsection
