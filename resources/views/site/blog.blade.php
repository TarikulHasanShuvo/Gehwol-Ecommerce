@extends('layouts.site')

@section('content')
    <div class="breadcrumbs">
        <a href="/">Home</a>
        <span class="divider">|</span>
        <span>Blog Post</span>
    </div>
    <h1 class="page_title">
        Blog Post
    </h1>
    <div class="container blog">
        <div class="blog__items">
            @foreach ($blogs as $blog)
                <div class="blog__item">
                    <div class="blog__item_top">
                        <div class="blog__item_image">
                            <img src="{{ asset('storage/images/'.$blog->image) }}" width="100%" height="241px" alt="">
                        </div>
                        <div class="blog__item_title">
                           {{ $blog->title ?? "" }} on {{ \Carbon\Carbon::parse($blog->created_at ?? \Carbon\Carbon::now())->format('M d') }}
                        </div>
                        <div class="blog__item_descroption">
                            {{ substr(strip_tags(html_entity_decode($blog->description)), 0, 90) }} ...
                        </div>
                    </div>
                    <div class="blog__item_buttons">
                        <a href="/blog/details/{{$blog->id}}" class="button button_outlied button_small">Learn More</a>
                        <div class="blog__item_buttons_date">
                            {{ \Carbon\Carbon::parse($blog->created_at ?? \Carbon\Carbon::now())->format('M d, Y')}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
      <div class="w-100">
          {{ $blogs->links('pagination.custom') }}
      </div>
{{--        <div class="catalog_products__pages">--}}
{{--            <a href="{{$blogs[0]['url']}}" class="prev arrow">--}}
{{--                <img src="/img/svg/arrow.svg" width="100%" alt="">--}}
{{--            </a>--}}
{{--            <span href="#" class="page">1</span>--}}
{{--            <a href="#" class="page">2</a>--}}
{{--            <a href="#" class="page">3</a>--}}
{{--            <a href="{{$blogs['next_page_url']}}" class="next arrow">--}}
{{--                <img src="/img/svg/arrow.svg" width="100%" alt="">--}}
{{--            </a>--}}
{{--        </div>--}}

    </div>
@endsection
