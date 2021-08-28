@extends('layouts.site')

@section('content')
<div class="slider">
    <div class="slider__back">
        <div class="slider__back_item">
            <img src="/img/slider.jpg" alt="">
        </div>
        <div class="slider__back_item">
            <img src="/img/slider.jpg" alt="">
        </div>
        <div class="slider__back_item">
            <img src="/img/slider.jpg" alt="">
        </div>
    </div>
    <div class="container">
        <div class="slider__front">
            <div class="slider__front_item">
                <div class="slider__front_item_top">
                    <div class="slider__front_title">Covid-19 update</div>
                    <div class="slider__front_text">We are still accepting and shipping orders and processing time
                        is
                        averaging 4 business days</div>
                </div>
                <a href="#" class="slider__front_button button button_primary">Learn More</a>
            </div>
            <div class="slider__front_item">
                <div class="slider__front_item_top">
                    <div class="slider__front_title">Covid-19 update</div>
                    <div class="slider__front_text">We are still accepting</div>
                </div>
                <a href="#" class="slider__front_button button button_primary">Learn More</a>
            </div>
            <div class="slider__front_item">
                <div class="slider__front_item_top">
                    <div class="slider__front_title">Covid-19 update</div>
                    <div class="slider__front_text">We are still accepting</div>
                </div>
                <a href="#" class="slider__front_button button button_primary">Learn More</a>
            </div>
        </div>
    </div>
</div>

@if(count($blogs) > 0)
    <div class="news">
    <div class="container">
        <div class="news__title">
            news
        </div>
        <div class="news__items">
            @foreach($blogs as $blog)
                <div class="news__item">
                    <div class="news__item_name">
                        {{ $blog->title ?? "" }} on {{ \Carbon\Carbon::parse($blog->created_at ?? \Carbon\Carbon::now())->format('M d') }}
                    </div>
                    <div class="news__item_image">
                        <img src="{{ asset('storage/images/'.$blog->image) }}" width="100%" height="241px" alt="">
                    </div>
                    <div class="news__item_date">{{ \Carbon\Carbon::parse($blog->created_at ?? \Carbon\Carbon::now())->format('M d') }}</div>
                    <div class="news__item_description">
                        {{ substr(strip_tags(html_entity_decode($blog->description)), 0, 90) }} ...
                    </div>
                    <a href="/blog/details/{{$blog->id}}" class="news__item_button button button_outlied">Learn More</a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<div class="products">
    <div class="container">
        <div class="products__title">
            professional products
        </div>
        <div class="products__items">
            @foreach($professionalProducts as $professionalProduct)
                <div class="products__item">
                    <div class="products__item_image">
                        @if(!empty($professionalProduct->images) && !empty($professionalProduct->images[0]->image))
                            <img src="/storage/images/{{ $professionalProduct->images[0]->image }}" width="100%"
                                 height="200px" alt="">
                        @else
                            <img src="{{ asset('img/no-img.png') }}"
                                 width="100%" height="200px" alt="">
                        @endif
                    </div>

                    <a href="/product/{{ $professionalProduct->id }}" class="products__item_name">
                        {{ $professionalProduct->name ?? '' }}
                    </a>
                    <div class="d-flex align-center">
                        <div class="products__item_stars">
                            <div class="products__item_stars_in" style="width: {{ 20*$professionalProduct['rating'] }}%;">

                            </div>
                        </div>
                        <div class="products__item_raiting">
                            Rating: {{ round($professionalProduct['rating'],1) }}
                        </div>
                    </div>
                    <div class="products__item_price">
                        ${{ $professionalProduct->price ?? '' }}
                    </div>
                    <div class="products__item_buttons d-flex align-center justify-space-between">
                        <a href="javascript:void(0)" class="button button_outlied button_small add_to_cart" data-action="{!! route('api.carts.add') !!}" data-product-id="{!! $professionalProduct->id !!}">Cart</a>
                        <a href="javascript:void(0)" class="button button_secondary button_small add_to_wishlist" data-action="{!! route('api.wishlists.add') !!}" data-product-id="{!! $professionalProduct->id !!}">WISHLIST</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="new_products">
    <div class="container">
        <div class="new_products__title">
            new products
        </div>
        <div class="d-flex justify-space-between position-relative">
            <div class="new_products__latest">
                <div class="new_products__latest_left">
                    <div class="new_products__latest_top">
                        <div class="title">
                            Check out the latest Gehwol products
                        </div>
                        <div class="subtitle">
                            Maybe you'll find some new favorites among them?
                        </div>
                    </div>
                    <a href="#" class="button button_light">Learn More</a>
                </div>
                <div class="new_products__latest_right">
                    <img src="/img/latest_product.png" width="100%" alt="">
                </div>
            </div>
            <div class="new_products__items">
                @foreach($newProducts as $newProduct)
                    <div class="products__item">
                        <div class="products__item_image">
                            @if(!empty($newProduct->images) && !empty($newProduct->images[0]->image))
                                <img src="/storage/images/{{ $newProduct->images[0]->image }}" width="100%"
                                     height="250px" alt="">
                            @else
                                <img src="{{ asset('img/no-img.png') }}"
                                     width="100%" height="250px" alt="">
                            @endif
                        </div>
                        <a href="/product/{{ $newProduct->id }}" class="products__item_name">
                            {{ $newProduct->name ?? '' }}
                        </a>
                        <div class="d-flex align-center">
                            <div class="products__item_stars">
                                <div class="products__item_stars_in" style="width: {{ 20*$newProduct['rating'] }}%;"></div>
                            </div>
                            <div class="products__item_raiting">
                                Rating: {{ round($newProduct['rating'],1) }}
                            </div>
                        </div>
                        <div class="products__item_price">
                            ${{ $newProduct->price ?? '' }}
                        </div>
                        <div class="products__item_buttons d-flex align-center justify-space-between">
                            <a href="javascript:void(0)" class="button button_outlied button_small add_to_cart" data-action="{!! route('api.carts.add') !!}" data-product-id="{!! $newProduct->id !!}">Cart</a>
                            <a href="javascript:void(0)" class="button button_secondary button_small add_to_wishlist" data-action="{!! route('api.wishlists.add') !!}" data-product-id="{!! $newProduct->id !!}">WISHLIST</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="products">
    <div class="container">
        <div class="products__title">
            Featured products
        </div>
        <div class="products__items">
            @foreach($allProducts as $allProduct)
                <div class="products__item">
                    <div class="products__item_image">
                        @if(!empty($allProduct->images) && !empty($allProduct->images[0]->image))
                            <img src="/storage/images/{{ $allProduct->images[0]->image }}" width="100%"
                                 height="200px" alt="">
                        @else
                            <img src="{{ asset('img/no-img.png') }}"
                                 width="100%" height="200px" alt="">
                        @endif
                    </div>
                    <a href="/product/{{ $allProduct->id }}" class="products__item_name">
                        {{ $allProduct->name ?? '' }}
                    </a>
                    <div class="d-flex align-center">
                        <div class="products__item_stars">
                            <div class="products__item_stars_in" style="width: {{ 20*$allProduct['rating'] }}%;"></div>
                        </div>
                        <div class="products__item_raiting">
                            Rating: {{ round($allProduct['rating'],1) }}
                        </div>
                    </div>
                    <div class="products__item_price">
                        ${{ $allProduct->price ?? '' }}
                    </div>
                    <div class="products__item_buttons d-flex align-center justify-space-between">
                        <a href="javascript:void(0)" class="button button_outlied button_small add_to_cart" data-action="{!! route('api.carts.add') !!}" data-product-id="{!! $allProduct->id !!}">Cart</a>
                        <a href="javascript:void(0)" class="button button_secondary button_small add_to_wishlist" data-action="{!! route('api.wishlists.add') !!}" data-product-id="{!! $allProduct->id !!}">WISHLIST</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="bestsellers">
    <div class="bestsellers__leaf first">
        <img src="/img/leaf1.png" width="100%" alt="">
    </div>
    <div class="bestsellers__leaf second">
        <img src="/img/leaf2.png" width="100%" alt="">
    </div>
    <div class="bestsellers__leaf third">
        <img src="/img/leaf3.png" width="100%" alt="">
    </div>
    <div class="bestsellers__leaf fourth">
        <img src="/img/leaf4.png" width="100%" alt="">
    </div>
    <div class="bestsellers__leaf fiveth">
        <img src="/img/leaf5.png" width="100%" alt="">
    </div>
    <div class="bestsellers__water">
        <img src="/img/water2.png" width="100%" alt="">
    </div>
    <div class="container">
        <div class="bestsellers__title">
            Gehwol Bestsellers
        </div>
        <div class="bestsellers__first">
            <div class="bestsellers__first_left">
                <img src="/img/bestsellers_first.png" width="100%" alt="">
            </div>
            <div class="bestsellers__first_right">
                <div class="bestsellers__first_title">
                    <div class="line">
                        <div class="line_in"></div>
                    </div>
                    Gehwol Fusskraft Red Rich for Dry Skin (2 sizes)
                </div>
                <div class="bestsellers__first_text">
                    <div>
                        <strong>
                            For cold feet – warming
                        </strong>
                    </div>
                    Active Ingredients: Skin friendly emollient cream base, Lanolin, essential oils of rosemary,
                    mountain pine, and lavender, camphor, extract of ginger, extract of paprika, farnesol,
                    climbazole
                </div>
                <div class="bestsellers__first_text">
                    The warming balm for dry skin gives relief for tired, strained and sore feet. Revitalizing
                    camphor,
                    extracts from paprika and ginger, as well as essential oils from rosemary and mountain pine,
                    stimulate circulation and have a warming effect.
                </div>
                {{--<div class="bestsellers__first_buttons">
                    <a href="#" class="bestsellers__first_button button button_secondary">Learn More</a>
                    <a href="#" class="bestsellers__first_button button button_outlined_white">cart</a>
                </div>--}}
            </div>
        </div>
        <div class="bestsellers__second">
            <div class="bestsellers__second_text first">
                The high quality ingredients naturally balance the protective properties of the skin
                <div class="line">
                    <div class="line_in"></div>
                </div>
            </div>
            <div class="bestsellers__second_text second">
                FDA approved. Dermatologically tested
                <div class="line">
                    <div class="line_in"></div>
                </div>
            </div>
            <div class="bestsellers__second_text third">
                Optimal care of dry and sensitive skin
                <div class="line">
                    <div class="line_in"></div>
                </div>
            </div>
            <div class="bestsellers__second_text fourth">
                Suitable for diabetics
                <div class="line">
                    <div class="line_in"></div>
                </div>
            </div>
            <div class="bestsellers__second_text fiveth">
                The cream helps protect against itching and fungal infections
                <div class="line">
                    <div class="line_in"></div>
                </div>
            </div>
            <div class="bestsellers__second_product">
                <img src="/img/bestsellers_second.png" width="100%" alt="">
            </div>
        </div>
    </div>
</div>
<div class="gift">
    <div class="container">
        <div class="gift__in">
            <div class="gift__left">
                <img src="/img/gift_image.png" width="100%" alt="">
            </div>
            <div class="gift__right">
                <div class="gift__title">
                    GIFT WITH PURCHASE
                </div>
                <div class="gift__price">
                    <div class="small">Of</div>
                    <div class="big">$100</div>
                    <div class="small">or more</div>
                </div>
                <div class="gift__description">
                    Receive a Free Full Sized Gewhol Extra Cream When You Place and Order of $100 or More
                </div>
                <div class="gift__info">
                    (After Discounts and Excluding Taxes and Shipping)
                </div>
            </div>
        </div>
    </div>
</div>
<div class="info">
    <div class="container">
        <div class="info__in">
            <div class="info__icon">
                <img src="/img/svg/ca_leaf.svg" width="100%" alt="">
            </div>
            <div class="info__text">GEHWOLCANADA.CA, THE BEST PLACE TO BUY GEHWOL FOOT CARE PRODUCTS IN CANADA</div>
        </div>
    </div>
</div>

@if(count($recentlyViewdProducts) > 0)
    <div class="products">
        <div class="container">
            <div class="products__title">
                Last Seen
            </div>
            <div class="products__items">
                @foreach($recentlyViewdProducts as $product)
                    <div class="products__item">
                        <div class="products__item_image">
                            @if(isset($product['images'][0]['image']))
                                <img src="/storage/images/{{ $product['images'][0]['image'] }}" width="100%" height="250px" alt="Product Image">
                            @else
                                <img src="/img/products1.jpg" width="100%" alt="">
                            @endif

                        </div>
                        <a href="/product/{{ $product['id'] }}" class="products__item_name">
                            {{ $product['name']  }}
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
                            ${{ $product['price']  }}
                        </div>
                        <div class="products__item_buttons d-flex align-center justify-space-between">
                            <a href="javascript:void(0)" class="button button_outlied button_small add_to_cart" data-action="{!! route('api.carts.add') !!}" data-product-id="{!! $product['id'] !!}">Cart</a>
                            <a href="javascript:void(0)" class="button button_secondary button_small add_to_wishlist" data-action="{!! route('api.wishlists.add') !!}" data-product-id="{!! $product['id'] !!}">WISHLIST</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
<div class="contact_form">
    <div class="container-sm d-flex">
        <div class="contact_form__left">
            <div class="contact_form__title">Contact us</div>
            <div class="contact_form__subtitle">GehwolCanada.ca, the best place to buy Gehwol Foot Care Products in
                Canada</div>
            <div class="contact_form__contacts">
                You can contact us using <span>the form</span> on the right, email us directly at <a
                    href="mailto:hello@gehwolcanada.ca">hello@gehwolcanada.ca</a> or call <a
                    href="tel:1-855-348-0888">1-855-348-0888</a>
            </div>
        </div>
        <div class="contact_form__right">
            <form id="contact-form" data-target_modal="contact_us" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="text" placeholder="Name*" name="name" required
                    class="contact_form__field contact_form__input">
                <input type="email" placeholder="Email*" name="email" required
                    class="contact_form__field contact_form__input">
                <input type="number" placeholder="Phone" name="phone" required
                    class="contact_form__field contact_form__input">
                <input type="text" name="order_no" placeholder="Order Number" required
                       class="contact_form__field contact_form__input">
                <textarea placeholder="Message*" name="message" required
                    class="contact_form__field contact_form__textarea"></textarea>
                <div class="contact_form__bottom d-flex align-center">
                    <div class="left">
                        <button class="button button_secondary button_small cursor-pointer">Send</button>
                    </div>
                    <div class="right">
                        <label class="d-flex align-center">
                            <input name="privacy" type="checkbox" required>
                            <div class="checkbox"></div>
                            <div class="text">Review our <a href="#" class="text-decoration-none">privacy policy</a> here</div>
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="contact-conform-modal" class="modal" data-modal_name="contact_us">
    <div class="modal__in">
        <div class="modal__closer">
            <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
        </div>
        <div class="modal__body add_to_cart_modal">
            <div class="title">Thanks!</div>
            <div class="text">Our manager will contact you as soon as possible and answer all your questions</div>
            <div class="modal__close cursor-pointer">
                <a href="/" class="button button_secondary button_small">Homepage</a>
            </div>
        </div>
    </div>
    <div class="modal__blur"></div>
</div>
@endsection
