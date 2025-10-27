@extends('official.layout.app')
@section('title', 'Blog')
@section('content')
<link href="{{ asset('public/official/css/style.css') }}" rel="stylesheet">
<div class="about-bg page-hearder-area">
    <div class="official-overly"></div>
</div>
<div class="header-blue-quickdetails text-center">
    <h1 class="mb-0" style="padding-top: 10px; font-weight: 500;">News & Blog</h1>
    <p class="mb-0 opacity-75">Recent blog posts</p>
</div>

<div class="container mt-5 my-4">
    <div class="row">
<div class="col-lg-3 col-md-4 mt-5" style="padding-top: 30px;">
            <div class="search-box-quickdetails">
                <h5 class="mb-3">Search Here</h5>
                <div class="input-group" style="background-color: rgba(250, 250, 250, 1);">
                    <input type="text" placeholder="Enter keywords..."
                      style="border: none; background-color: rgba(250, 250, 250, 1);">
                    <button class="btn" style="margin-left:-10px"  > <img class="search-blogs-icons"  src="{{ asset('client/img/seacrh.svg') }}" alt="Search" width="40"></button>
                </div>
            </div>
            <div class="recent-posts mt-4">
                <h5 class="mb-3">Recent Posts</h5>
                @if(!empty($blogrecents))
                @foreach($blogrecents as $recent)
                @php
                $image = '';
                if ($recent->image) {
                $img = unserialize($recent->image);
                $image = $img['large']['src'] ?? '';
                }
                @endphp
                <div class="recent-post-item-quickdetilas mb-3 d-flex">
                    <img src="{{ asset($image) }}" class="recent-post-img me-2" width="80" height="80" style="object-fit: cover;" alt="{{ $recent->name }}">
                    <div class="recent-post-content">
                        <div class="recent-post-meta mb-1">
                            <span><img src="{{ asset('public/images/user 1.svg') }}" alt=""> 10 Likes</span>
                            <span><img src="{{ asset('public/images/Mask group.svg') }}" alt=""> 5 Comments</span>
                        </div>
                        <h6 style="margin-bottom: 0;">
                            <a href="{{ url('blog/' . $recent->slug) }}" style="font-size:12px">{{ Str::limit($recent->name, 40) }}</a>
                        </h6>
                    </div>
                </div>
                @endforeach
                @else
                <p>No recent posts found.</p>
                @endif
            </div>
        </div>
        <div class="col-lg-9 col-md-8 main-content">
<h2 class="mb-4" style="
    font-size: 30px;
    font-weight: 100;
">All Blog Posts</h2>            <div class="row">
                @if(!empty($bloglist) && $bloglist->count())
                @foreach($bloglist as $blog)
                @php
                $image = '';
                if ($blog->image) {
                $img = unserialize($blog->image);
                $image = $img['large']['src'] ?? '';
                }
                @endphp
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="blog-card-quickdetails">
                        <a href="{{ url('blog/' . $blog->slug) }}">
                            <img src="{{ asset($image) }}" alt="{{ $blog->name }}" style="width:100%; height:230px; object-fit:cover;">
                        </a>
                        <div class="blog-card-quickdetails-body mt-2">
                            <span class="category-badge">{{ date('d M Y', strtotime($blog->created_at)) }}</span>
                            <h3>
                                <a href="{{ url('blog/' . $blog->slug) }}">{{ Str::limit($blog->name, 50) }}</a>
                                <img src="{{ asset('client/img/Icon wrap.svg') }}" alt=""  class="icons-arrow-image" style="width: 24px; height: 28px;">
                            </h3>
                            <p>{{ Str::limit(strip_tags($blog->description), 120) }}</p>
                            <div class="blog-meta text-muted">Published {{ $blog->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-12">
                    <p>No blog posts found.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection