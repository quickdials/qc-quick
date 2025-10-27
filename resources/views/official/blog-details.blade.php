@extends('official.layout.app')
@section('title')
@if (!empty($blogdetails->meta_title)) {!! $blogdetails->meta_title !!}
@else {!! $blogdetails->title !!}
@endif
@endsection
@section('keyword')
@if (!empty($blogdetails->meta_keyword)) {{ $blogdetails->meta_keyword }}
@else Best IT Training Institute in Noida | Delhi | Gurgaon
@endif
@endsection
@section('description')
@if (!empty($blogdetails->meta_description)) {{ $blogdetails->meta_description }}
@else IT Training Institute in Noida | Delhi | Gurgaon for Industrial Training. We conducts IT Software, Hardware, Network & Security Courses training. Corporate Trainer commands all training program. Week Days, Weekend, 6 Week, 6 Months Industrial Training are available
@endif
@endsection
@section('content')
<link href="{{asset('public/official/css/style.css')}}" rel="stylesheet">
<style>
    .post-thumbnail img {
        height: 350px;
        width: 900px;
    }
</style>
<div class="container my-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="content-blog-details">
                @php
                $image = '';
                if (!empty($blogdetails->image)) {
                $imageArray = unserialize($blogdetails->image);
                $image = $imageArray['large']['src'] ?? '';
                }
                @endphp
                @if($image)
                <img src="{{ url($image) }}" alt="{{ $blogdetails->name }}" class="img-fluid mb-4" style="width: 100%; height: 378px;">
                @endif
                <h1 class="text-center">Featured Article</h1>
                <h2 class="text-center blog-details-h2">{{ $blogdetails->name }}</h2>
                <p class="author">
                    {{ \Carbon\Carbon::parse($blogdetails->created_at)->format('M d, Y') }} |
                    {{ round(str_word_count(strip_tags($blogdetails->description ?? '')) / 200) + 1 }} mins read
                </p>
                <div class="entry-content">
                    {!! ucfirst($blogdetails->description) !!}
                </div>
                <div class="entry-content">
                    {!! ucfirst($blogdetails->top_content) !!}
                </div>
                @php
                $image_banner = '';
                if (!empty($blogdetails->image_banner)) {
                $bannerArray = unserialize($blogdetails->image_banner);
                $image_banner = $bannerArray['large']['src'] ?? '';
                }
                @endphp
                @if($image_banner)
                <div class="entry-content">
                    <img src="{{ url($image_banner) }}" title="{{ $blogdetails->name }}" alt="{{ $blogdetails->name }}" style="width: 100%; height: 250px;" />
                </div>
                @endif
                <div class="entry-content">
                    {!! ucfirst($blogdetails->bottom_content) !!}
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="search-box mb-4" style="margin-top: 30px;">
                <h5 class="mb-3">Search Here</h5>
                <form action="{{ url('blog') }}" method="GET" class="input-group">
<input type="text" name="search" class="form-control search-blog-detilas" placeholder="Enter keywords..." value="" style="
    background: rgba(250, 250, 250, 1);
    border: none;
">                    <button class="btn" type="submit">
                        <img src="{{ asset('client/img/seacrh.svg') }}" alt="Search" width="40">
                    </button>
                </form>
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
                            <a href="{{ url('blog/' . $recent->slug) }}">{{ Str::limit($recent->name, 40) }}</a>
                        </h6>
                    </div>
                </div>
                @endforeach
                @else
                <p>No recent posts found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection