<div class="header__menu_opener">
    <div></div>
    <div></div>
    <div></div>
</div>
<header class="header">
    <div class="header__top">
        <div class="container d-flex align-center justify-space-between">
            <a href="/" class="header__logo">
                <img src="{{asset('/img/svg/logo.svg')}}" width="100%" alt="">
            </a>
            <div class="header__top_right d-flex align-center">

                <nav class="header__top_menu">
                    <ul>
                        <li>
                            <a href="/">Home</a>
                        </li>

                        <li>
                            <a href="/shipping">Shipping & Returns</a>
                        </li>

                        <li>
                            <a href="/education">Education</a>
                        </li>

                        <li>
                            <a href="/gift">Gift Certificates</a>
                        </li>

                        <li>
                            <a href="/wholesale">Wholesale</a>
                        </li>

                        <li>
                            <a href="/blog">Blog</a>
                        </li>

                        <li>
                            <a href="/about">About Us</a>
                        </li>

                        <li>
                            <a href="/contact_us">Contact Us</a>
                        </li>

                    </ul>
                </nav>

                <a href="tel:1-855-888-8307" class="header__phone d-flex align-center">
                    <div class="icon">
                        <img src="/img/svg/phone_blue.svg" width="100%" alt="">
                    </div>
                    <div class="text">1-855-888-8307</div>
                </a>

            </div>
            
        </div>
    </div>
    @php($categories = \App\Models\ProductCategory::take(7)->get());
    <div class="header__bottom">
        <div class="container d-flex align-center justify-space-between">
            <div class="header__bottom_left">
                <nav class="header__bottom_menu">
                    <ul>
                        @foreach($categories as $category)
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
            <div class="header__bottom_right">
                <div class="header__buttons d-flex align-center">
                    <a href="#" class="header__button search_opener">
                        <div class="icon">
                            <img src="/img/svg/search.svg" width="100%" alt="">
                        </div>
                    </a>
                    <a href="/dashboard/wishlist" class="header__button">
                        <div class="icon">
                            <img src="/img/svg/heart.svg" width="100%" alt="">
                        </div>
                        <div class="count" id="wish_count">0</div>
                    </a>
                    <a href="/cart" class="header__button">
                        <div class="icon">
                            <img src="/img/svg/cart.svg" width="100%" alt="">
                        </div>
                        <div class="count" id="cart_count">0</div>
                    </a>
                    <div class="divider"></div>
                    @if(Auth::check())
                        <a href="/dashboard" class="header__button">
                            <div class="icon">
                                <img src="/img/svg/profile.svg" width="100%" alt="">
                            </div>
                            <div class="text"><b>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</b></div>
                        </a>
                    @else
                        <a href="/login" class="header__button">
                            <div class="icon">
                                <img src="/img/svg/profile.svg" width="100%" alt="">
                            </div>
                            <div class="text">Log In</div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </header>
    <div class="search__popup">
        <div class="search__closer">
            <svg width="100%" viewBox="0 0 23 23" fill="none"><path d="M6.30314 6.3033L16.9097 16.9099M16.9097 6.3033L6.30314 16.9099" stroke="#E45A54" stroke-linecap="round"/></svg>
        </div>
        <div class="search__in">
            <div class="search__title">Search</div>
            <form action="/search" method="get" class="search__bar">
                <input type="text" name="q" placeholder="Search">
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 22 23" fill="none"><path d="M21.738 21.404L16.6106 16.0436C16.2612 15.6783 15.6954 15.6783 15.346 16.0436C14.9966 16.4085 14.9966 17.0007 15.346 17.3656L20.4734 22.7261C20.6481 22.9087 20.8767 23 21.1057 23C21.3343 23 21.5633 22.9087 21.738 22.7261C22.0873 22.3611 22.0873 21.769 21.738 21.404Z" fill="#E45A54"/><path d="M9.68833 0C4.34633 0 0 4.54389 0 10.1287C0 15.7138 4.34633 20.2574 9.68833 20.2574C15.0306 20.2574 19.3767 15.7138 19.3767 10.1287C19.3767 4.54389 15.0306 0 9.68833 0ZM9.68833 18.3876C5.33246 18.3876 1.78862 14.6826 1.78862 10.1288C1.78862 5.57489 5.33246 1.86992 9.68833 1.86992C14.0442 1.86992 17.588 5.57485 17.588 10.1287C17.588 14.6826 14.0442 18.3876 9.68833 18.3876Z" fill="#E45A54"/></svg>
                </button>
            </form>
            <div class="search__links">
                <div class="title">
                    quick links
                </div>
                <ul class="links">
                    @foreach($categories as $category)
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
            </div>
        </div>
        
        <div class="search__blur"></div>
    </div>
