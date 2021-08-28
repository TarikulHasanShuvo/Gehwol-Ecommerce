<footer class="footer">
    <div class="container">
        <div class="footer__top">
            <img src="/img/svg/logo_white.svg" width="100%" alt="">
        </div>
        <div class="footer__middle">
            <div class="footer__middle_left">
                <div class="footer__menu">
                    <div class="footer__title">Further info</div>
                    <nav>
                        <ul>
                            <li><a href="/shipping">Shipping & Returns</a></li>
                            <li><a href="/wholesale">Wholesale</a></li>
                            <li><a href="/about">About Us</a></li>
                            <li><a href="/gift">Gift Certification</a></li>
                            <li><a href="/blog">Blog</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="footer__menu">
                    <div class="footer__title">categories</div>
                    <nav>
                        <ul>
                            @foreach(\App\Models\ProductCategory::take(7)->get() as $category)
                                <li>
                                    <a href="/category/?filter_by={{ $category->id }}">{{ $category->name }}</a>
                                </li>
                            @endforeach

                            <li>
                                <a href="/category/?filter_by=all">All Products</a>
                            </li>

                            <li>
                                <a href="/category/?filter_by=new">New</a>
                            </li>

                            <li>
                                <a href="/category/?filter_by=professional">Professional</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                @php($blog = \App\Models\Blog::latest()->first());
                @if(isset($blog->title))
                    <div class="footer__menu">
                        <div class="footer__title">RECENT UPDATES</div>
                        <nav>
                            <ul>
                                <li><a href="/soon"><strong>{{$blog->title}}</strong></a></li>
                            </ul>
                        </nav>
                        <div class="footer__menu_button">
                            <a href="/blog/details/{{$blog->id}}" class="button button_outlied button_small">Learn more</a>
                        </div>
                    </div>
                @endif
            </div>

            <div class="footer__middle_right">
                <div class="footer__title">Our Newsletter</div>
                <form id="news-letter-subscription" action="" data-target_modal="newsletter" method="POST" class="footer__form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="text" name="email" placeholder="Email*" class="footer__form_input" required>
                    <button type="text" class="footer__form_button button button_small cursor-pointer contact_us">Send</button>
                </form>
                <div class="footer__contacts d-flex align-center">
                    <a href="tel:1-855-888-8307" class="footer__contact d-flex align-center">
                        <div class="icon">
                            <img src="/img/svg/phone_white.svg" width="100%" alt="">
                        </div>
                        <div class="text">1-855-888-8307</div>
                    </a>
                    <a href="mailto:hello@gehwolcanada.ca" class="footer__contact d-flex align-center">
                        <div class="icon">
                            <img src="/img/svg/mail_white.svg" width="100%" alt="">
                        </div>
                        <div class="text">hello@gehwolcanada.ca</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="modal" data-modal_name="newsletter">
    <div class="modal__in">
        <div class="modal__closer">
            <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
        </div>
        <div class="modal__body newsletter">
            <div class="title">Thanks!</div>
            <div class="red_text">Subscription to the newsletter was successful</div>
            <div class="text">Now you will receive notifications about events and discounts</div>
            <div class="centerred_button">
                <a href="/" class="button button_secondary button_small">Homepage</a>
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

<div class="modal" data-modal_name="add_to_cart_modal">
    <div class="modal__in">
        <div class="modal__closer">
            <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
        </div>
        <div class="modal__body add_to_cart_modal">
            <div class="title">Thanks!</div>
            <div class="text">Product added to cart</div>
            <div class="d-flex align-center">
                <a href="/" class="button button_outlied button_small close_modal">Continue shopping</a>
                <a href="/cart" class="button button_secondary button_small">Cart</a>
            </div>
        </div>
    </div>
    <div class="modal__blur"></div>
</div>

<div class="modal" data-modal_name="add_to_wishlist_modal">
    <div class="modal__in">
        <div class="modal__closer">
            <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
        </div>
        <div class="modal__body add_to_wishlist_modal">
            <div class="title">Thanks!</div>
            <div class="text">Product added to wishlist</div>
            <div class="d-flex align-center">
                <a href="/" class="button button_outlied button_small close_modal">Continue shopping</a>
                <a href="/dashboard/wishlist" class="button button_secondary button_small">wishlist</a>
            </div>
        </div>
    </div>
    <div class="modal__blur"></div>
</div>