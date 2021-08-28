@extends('layouts.site')

@section('content')
    <div class="breadcrumbs">
        <a href="/">Home</a>
        <span class="divider">|</span>
        <span>About Us</span>
    </div>
    <h1 class="page_title">
        about us
    </h1>
    <div class="banner">
        <div class="container">
            <div class="banner__in">
                <div class="banner__title">Real Spa, Actual Location</div>
                <div class="banner__text">
                    We're not just some warehouse website selling products online - we are a real Spa in North Vancouver
                    Canada with real estheticians and a real reputation for quality. Having been pampering people in
                    Vancouver for over 40 years we have become Canada's best place to find and purchase everything
                    offered by Gehwol.
                </div>
            </div>
        </div>
    </div>
    <div class="about_catalog">
        <div class="container">
            <div class="about_catalog__in d-flex align-center">
                <div class="about_catalog__left">
                    <img src="/img/about_catalog.png" width="100%" alt="">
                </div>
                <div class="about_catalog__right">
                    <div class="about_catalog__title">
                        Real Products
                    </div>
                    <div class="about_catalog__text">
                        We get all of our products direct from the distributor and never ever order cheap products on
                        discount websites or auction sites as some of those have been shown to routinely be either
                        stale-dated or a complete knockoff altogether
                    </div>
                    <div class="about_catalog__title">
                        Awesome Prices
                    </div>
                    <div class="about_catalog__text">
                        We work hard to bring you the products you love at great prices
                    </div>
                    <div class="about_catalog__title">
                        our catalog
                    </div>
                    <nav class="about_catalog__list">
                        <ul>
                            @foreach(\App\Models\ProductCategory::take(7)->get() as $category)
                                <li>
                                    <a href="/category/?sort_by={{ $category->id }}">{{ $category->name }}</a>
                                </li>
                            @endforeach

                            <li>
                                <a href="/category/?sort_by=all">All Products</a>
                            </li>

                            <li>
                                <a href="/category/?sort_by=new">New</a>
                            </li>

                            <li>
                                <a href="/category/?sort_by=professional">Professional</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="about_catalog__info">
                        *We are not the Official Corporate Website for Gehwol. We are not directly affiliated with
                        Corporate Gehwol in any way. We are a Canadian Spa and Retailer of Gehwol Products. For the
                        Official Corporate Gehwol website please see: <a href="http://www.gehwol.com"
                            target="_blank">http://www.gehwol.com</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
