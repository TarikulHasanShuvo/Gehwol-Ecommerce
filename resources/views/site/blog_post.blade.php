@extends('layouts.site')

@section('content')
    <div class="breadcrumbs">
        <a href="/">Home</a>
        <span class="divider">|</span>
        <span>Blog Post</span>
        <span class="divider">|</span>
        <span> {{ $blog->title ?? "" }} on {{ \Carbon\Carbon::parse($blog->created_at ?? \Carbon\Carbon::now())->format('M d') }}</span>
    </div>

    <div class="container">
        <h1 class="page_title">
            {{ $blog->title ?? "" }} on {{ \Carbon\Carbon::parse($blog->created_at ?? \Carbon\Carbon::now())->format('M d') }}
        </h1>
    </div>

    <div class="container blog_post">
        <div class="blog_post__left">
            <div class="blog_post__left_info">
                <div class="blog__item_buttons_date">
                    {{ \Carbon\Carbon::parse($blog->created_at ?? \Carbon\Carbon::now())->format('M d, Y')}}
                </div>
                <div class="d-flex align-center">
                    <div class="blog__item_buttons_date">
                        Author: {{ $blog->user->first_name ?? ""}} {{  $blog->user->last_name ?? "" }}
                    </div>
                    {{--<div class="blog_post__socials">
                        <a href="#" class="blog_post__social">
                            <img src="{{ asset('img/svg/facebook_grey.svg') }}" width="100%" height="100%" alt="" />
                        </a>
                        <a href="#" class="blog_post__social">
                            <img src="{{ asset('img/svg/instagram.svg') }}" width="100%" alt="" />
                        </a>
                    </div>--}}
                </div>
            </div>
            <div class="blog_post__image">
                <img src="{{ asset('storage/images/'.$blog->image) }}" width="100%" alt="">
            </div>
            <div class="about_catalog__text">
                {!!  $blog->description ?? "" !!}
            </div>

        </div>
        <div class="blog_post__right">
            <div class="blog_post__right_title">Latest Articles:</div>
            <div class="blog_post__right_items">
                @foreach ($latestBlogs as $latestBlog)
                    <a href="/blog/details/{{$latestBlog->id}}" class="blog_post__right_item">
                        <div class="blog_post__right_item_image">
                            <img src="{{ asset('storage/images/'.$latestBlog->image) }}" width="100%" alt="">
                        </div>
                        <div class="blog_post__right_item_info">
                            <div class="title"> {{ $latestBlog->title ?? "" }} on {{ \Carbon\Carbon::parse($latestBlog->created_at ?? \Carbon\Carbon::now())->format('M d Y') }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
