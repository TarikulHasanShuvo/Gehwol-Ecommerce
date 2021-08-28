@extends('layouts.site')

@section('content')
    <div class="breadcrumbs">
        <a href="/">Home</a>
        <span class="divider">|</span>
        <span>Shipping & Returns</span>
    </div>
    <h1 class="page_title">
        Shipping & Returns
    </h1>
     <div class="banner">
        <div class="container">
            <div class="banner__in share">
                <div class="banner__title red">COVID-19 UPDATE</div>
                <div class="banner__text share">
                    WE ARE CURRENTLY ACCEPTING AND SHIPPING ONLINE ORDERS, HOWEVER DUE TO SLOW DOWNS WITH OUR DELIVERY PARTNERS AND A REDUCTION OF WAREHOUSE STAFF ORDERS ARE CURRENTLY TAKING <span>3-6 DAYS</span> TO BE FULFILLED.
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="about_catalog__title">Returns Policy</div>
        <div class="about_catalog__text">
            You may return all new, unopened items within 30 days of delivery for a full refund of the purchase price of the product. Refund does not include cost of shipping the item to the buyer. Buyer is responsible for return shipping costs unless item is being returned as a result of our error (you received an incorrect or defective item, etc.).
        </div>
        <div class="about_catalog__text">
            You should expect to receive your refund within four weeks of giving your package to the return shipper, however, in many cases you will receive a refund more quickly. This time period includes the transit time for us to receive your return from the shipper (5 to 10 business days), the time it takes us to process your return once we receive it (1 to 3 business days), and the time it takes your bank to process our refund request (2 to 3 business days).
        </div>
        <div class="about_catalog__text">
            If you need to return an item, simply login to your account, view the order using the "Complete Orders" link under the My Account menu and click the Return Item(s) button. We'll notify you via e-mail of your refund once we've received and processed the returned item.
        </div>
        <div class="about_catalog__title">Shipping</div>
        <div class="about_catalog__text">
            We can ship to virtually any address in Canada. We do not ship outside of Canada. Shipping Prices are flat rates and vary by order total. They are calculated after discounts and before taxes.
        </div>
        <div class="about_catalog__text">
            Processing time is normally 1-3 business days for all products in stock. Shipping time is normally 3-5 business days in transit but some more rural areas may take longer.
        </div>
        <div class="about_catalog__title">our catalog</div>


        <nav class="about_catalog__list small">
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
@endsection