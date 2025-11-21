@extends('official.layout.app')
@section('title')
Quick Dials- Training in {{$client->business_name}}
@endsection
@section('keyword')
Quick Dials- Training in {{$client->business_name}}
@endsection
@section('description')
Quick Dials- Training in {{$client->business_name}}
@endsection
@section('content')
    <div class="company-details-first-top">
        <div class="company-details-first-top-images">
            <img src="{{ asset('client/img/bannercompanyDetaisls (1).png') }}" alt="" />
            <img src="{{ asset('client/img/comp.png') }}" alt="" class="mobile-view-hidden" />
            <div class="four-grid-company">
                <img src="{{ asset('client/img/bannercompanyDetaisls (2).png') }}" alt="" />
                <img src="{{ asset('client/img/companydetislabannersmain (1).png') }}" alt="" />
                <img src="{{ asset('client/img/companydetislabannersmain (2).png') }}" alt="" />
                <div class="banner-container">
                    <img src="{{ asset('client/img/companydetislabannersmain (3).png') }}" alt="Banner" />
                </div>
            </div>
        </div>
    </div>
    <div class="container">

    <div class="clearfix"></div>
    <div class="profile-container-companydetails-page  animation-sectionss">
        <div class="profile-card-company">
            @php
            $image = '#';
            $imageName = 'logo';
            if (!empty($client->logo)) {
            $logo = unserialize($client->logo);
            if (!isset($logo['thumbnail'])) {
            $logo['thumbnail'] = $logo['large'];
            }
            $image = $logo['large']['src'];
            $imageName = $logo['large']['name'];
            }
            @endphp
            <img src="{{ asset($image) }}" class="img-responsive" alt="{{ $imageName }}">
            <div class="hero-rating" style="padding-top: 2px">
                <div class="rating">
                    <div class="stars">
                        @php
                        $whole = floor($avgRating);
                        $fraction = $avgRating - $whole;
                        $remain = 5 - $whole;
                        @endphp
                        @for ($i = 0; $i < $whole; $i++)
                            <i class="fullStar"></i>
                            @endfor
                            @if ($fraction > 0 && $fraction < 1)
                                <i class="hlfStar"></i>
                                @php $remain--; @endphp
                                @endif
                                @for ($i = 0; $i < $remain; $i++)
                                    <i class="emptyStar1"></i>
                                    @endfor
                    </div>
                </div>
                <p class="subtitle-companyDetails">{{ $avgRating }} out of 5 based on {{ $count }} rating(s)</p>
            </div>
            <div class="info">
                <img src="{{ asset('client/img/Vector.svg') }}" alt="Location" />
                {{ $client->address ?? 'Address not available' }}
            </div>
            <div class="info">
                <img src="{{ asset('client/img/Vector (1).svg') }}" alt="Mail" />
                <a href="{{ !empty($client->email) ? 'mailto:' . $client->email : '#' }}">Send Enquiry By Mail</a>
            </div>
            <div class="info">
                <img src="{{ asset('client/img/Vector (2).svg') }}" alt="Phone" />
                <a href="{{ !empty($client->website) ? buildWebsiteURL($client->website) : '#' }}" target="_blank">
                    {{ $client->mobile ?? '+91-XXXXXXXXXX' }}
                </a>
            </div>
            <div class="info-established">
                <strong>Year Established</strong>
                <div class="years">{{ $client->year_of_estb ?? 'N/A' }}</div>
            </div>
        </div>

        <!-- About Company Section -->
        <div class="about-company">
            <h3>{{ $client->business_name }}</h3>
            <div style="padding-left:15px;">
                <h3>About Company</h3>
                <p>
                    {!! Str::limit($client->business_intro, 1000) !!}
                    <a href="#" data-toggle="modal" data-target="#businessIntroModal">..More</a>
                </p>
            </div>
            <?php
            $i = 1;
            $firstHalf = $secondHalf = $inPopupArr = [];
            foreach ($assignedKwds as $assignedKwd) {
                $inPopupArr[$assignedKwd->child_category_name][] = $assignedKwd->keyword;
                if ($i <= 40) {
                    $serviceHtml = '<div class="course-card-subcategories">' . htmlspecialchars($assignedKwd->keyword) . '</div>';
                    if ($i % 2 == 0) {
                        $secondHalf[] = $serviceHtml;
                    } else {
                        $firstHalf[] = $serviceHtml;
                    }
                    ++$i;
                }
            }
            ?>
            <div class="inner-intro">
              <h1 style="color:black">Service Offered</h1>
                <div class="col-md-6">
                    <div class="services">
                        <div class="services-list">
                            <?php echo implode("\n", $firstHalf); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="services">
                        <div class="services-list">
                            <?php echo implode("\n", $secondHalf); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .complaint-details-icons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .city-item {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            border-radius: 4px;
        }
    </style>
    <div class="complaint-details-banners animation-sectionss">
        <h1>Serving in City/Cities</h1>
        <div class="complaint-details-icons">
            @if(!empty($assignedCity))
            @foreach($assignedCity as $city)
            <div class="city-item">
                <img src="{{ asset('client/img/locationorange.svg') }}" alt="Location Icon" />
                <span>{{ $city->city }}</span>
            </div>
            @endforeach
            @else
            <div class="city-item">
                <span>No cities available</span>
            </div>
            @endif
        </div>
    </div>
    <div class="pre-wedding-company-detials animation-sectionss">
        <div class="content-pre-wedding-company-detials">
            <div class="categories-wrapper-pre-wedding-company-details" style="border: none">
                <div class="categories-grid-pre-wedding-company-details">
                    @if (!empty($categories))
                    @foreach ($categories as $category)
                    <div>
                        <img src="{{ asset($category['image'] ?? 'client/images/quickdetilsecondimage.png') }}" alt="{{ $category['name'] ?? 'Category' }}" class="category-image-pre-wedding-compay-details" />
                        <div class="category-label-pre-wedding-company-details">
                            {{ $category['name'] ?? '' }}
                        </div>
                    </div>
                    @endforeach
                    @else
                    @for ($i = 0; $i < 6; $i++)
                        <div>
                        <img src="{{ asset('client/img/quickdetilsecondimage.png') }}" alt="Category" class="category-image-pre-wedding-compay-details" />
                        <div class="category-label-pre-wedding-company-details">Category {{ $i + 1 }}</div>
                </div>
                @endfor
                @endif
            </div>
        </div>
    </div>

<!-- Dynamic Enquiry Form -->
<div class="form-pre-wedding     animation-sectionss">
  <form
    class="formaling lead_form"
    action=""
    method="post"
    onsubmit="return homeController.saveEnquiry(this)"
  >
    <input type="hidden" name="lead_form" value="1" />
    <input type="hidden" name="city_id" class="cityList" />
    <input type="hidden" class="home-search" name="kw_text" autocomplete="off" />
    <input type="hidden" name="from_page" value="{{ request()->path() }}" />


    <div class="fieldblock">
      <label>Your Name*</label>
      <input
        type="text"
        placeholder="Enter your name"
        class="form-control"
        name="name"
        required
      />
    </div>

    <div class="fieldblock">
      <label>Mobile*</label>
      <input
        type="tel"
        placeholder="Enter mobile number"
        class="form-control"
        name="mobile"
        required
      />
    </div>

    <div class="fieldblock">
      <label>Email*</label>
      <input
        type="email"
        placeholder="Enter your email"
        class="form-control"
        name="email"
        required
      />
    </div>

    <div class="fieldblock">
      <label>Remarks</label>
      <textarea
        class="form-control"
        rows="3"
        placeholder="Provide any specific details for your need"
        name="remark"
      ></textarea>
    </div>

    <div class="btn-wrapper" style="margin-left:80px">
      <input
        type="submit"
        class="btn btn-primary submit-btn-2"
        value="Get Quotes"
      />
    </div>
  </form>
</div>

</div>
@if(count($comments) > 0)
<div class="container-company-details animation-sectionss">
    <div class="reviews-container-company-details">
        <h2 class="section-title-company-details">REVIEWS & RATING</h2>
        <div class="reviews-grid-company-details">
            @foreach($comments as $comment)
            <div class="review-card-company-details">
                <img src="{{ asset('client/images/compaydetialscardsimage.png') }}" alt="" />
                <p class="review-text-company-details">
                    {!! $comment->comment_content !!}
                </p>
                <div class="reviewer-company-details">
                    <div class="reviewer-company-details-avatar">
                        <img src="{{ asset('client/images/user.png') }}" alt="user" />
                    </div>
                    <div class="compandetials-section-starss">
                        <div class="reviewer-company-details-name">
                            {{ $comment->comment_author }}
                        </div>
                        <div class="stars-company-details">
                            @php
                            $whole = floor($comment->rating);
                            $fraction = $comment->rating - $whole;
                            $remain = 5 - $whole;
                            @endphp
                            @for($i = 0; $i < $whole; $i++)
                                <a href="javascript:void(0)" class="emptystar fullstar"></a>
                                @endfor
                                @if($fraction > 0 && $fraction < 1)
                                    <a href="javascript:void(0)" class="emptystar halfstar"></a>
                                    @php $remain--; @endphp
                                    @endif
                                    @for($i = 0; $i < $remain; $i++)
                                        <a href="javascript:void(0)" class="emptystar"></a>
                                        @endfor
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
<div class="Related-section">
<h1>Add Related Keyword Search</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis velit voluptatem ad similique dolores repellendus perspiciatis! Facilis fuga excepturi illo quod adipisci, expedita soluta possimus maiores tenetur laboriosam voluptates dolorum.</p>    
</div>
<div class="Related-section">
<h1>Add Box Certified Document</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis velit voluptatem ad similique dolores repellendus perspiciatis! Facilis fuga excepturi illo quod adipisci, expedita soluta possimus maiores tenetur laboriosam voluptates dolorum.</p>    
</div>
    
<div>
<h1 class="highlights-h1">Highlights From the business</h1>
<div class="categories-grid-country ">
    <a href="http://127.0.0.1:8000/categories/professional-courses" class="category-item-country">
      <div class="category-icon">
        <img src="http://127.0.0.1:8000/img/IT-Training.png" alt="IT Courses">
      </div>
      <span class="category-name">IT Courses</span>
    </a>
    <a href="http://127.0.0.1:8000/child/wedding-planning" class="category-item-country">
      <div class="category-icon">
        <img src="http://127.0.0.1:8000/img/wedding.png" alt="Wedding Planning">
      </div>
      <span class="category-name">Wedding Planning</span>
    </a>
    <a href="http://127.0.0.1:8000/categories/electric-services" class="category-item-country">
      <div class="category-icon">
        <img src="http://127.0.0.1:8000/img/electric-services.png" alt="Electric Services">
      </div>
      <span class="category-name">Electric Services</span>
    </a>
    <a href="http://127.0.0.1:8000/categories/entrance-exams-coaching" class="category-item-country">
      <div class="category-icon">
        <img src="http://127.0.0.1:8000/img/government-exam.png" alt="Government Exam">
      </div>
      <span class="category-name">Government Exam</span>
    </a>
  </div>
</div>
  <div class="Related-section">
<h1>Add multiple Review</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis velit voluptatem ad similique dolores repellendus perspiciatis! Facilis fuga excepturi illo quod adipisci, expedita soluta possimus maiores tenetur laboriosam voluptates dolorum.</p>    
</div>
<div class="container-company-details animation-sectionss">
    <!-- Write Review Form -->
    <div class="write-review-company-details">
        <h3 class="section-title-company-details">WRITE A REVIEW</h3>
        <div class="col-md-12 rate-txt">
            <div class="col-md-6 rate-txt removeLeftSpace">
                <p>Please rate your experience</p>
            </div>
            <div class="col-md-6 ratingstar text-right removeRightSpace">
                <a href="javascript:void(0)">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="s_rating emptyStar" data-s_rating="{{ $i }}"></i>
                        @endfor
                </a>
            </div>
        </div>
    <form id="commentform" method="POST" onsubmit="return submitComment(this)" class="p-4 border rounded bg-light">
  @csrf
  <input type="hidden" name="s_rating" value="">

  <!-- Name Field -->
  <div class="form-group row mb-3">
    <label class="col-sm-2 col-form-label fw-bold">
      Name <sup><i class="fa fa-asterisk text-danger"></i></sup>
    </label>
    <div class="col-sm-10">
      <input type="text" name="comment_author" class="form-control" placeholder="Enter Name" required>
    </div>
  </div>

  <!-- Mobile Field -->
  <div class="form-group row mb-3">
    <label class="col-sm-2 col-form-label fw-bold">
      Mobile <sup><i class="fa fa-asterisk text-danger"></i></sup>
    </label>
    <div class="col-sm-10">
      <input type="text" name="comment_author_phone" class="form-control" placeholder="Enter Phone" required>
    </div>
  </div>

  <!-- Email Field -->
  <div class="form-group row mb-3">
    <label class="col-sm-2 col-form-label fw-bold">
      Email Id <sup><i class="fa fa-asterisk text-danger"></i></sup>
    </label>
    <div class="col-sm-10">
      <input type="email" name="comment_author_email" class="form-control" placeholder="Enter Email" required>
    </div>
  </div>

  <!-- Comment Field -->
  <div class="form-group row mb-4">
    <label class="col-sm-2 col-form-label fw-bold">
      Comment
    </label>
    <div class="col-sm-10">
      <textarea name="comment_content" class="form-control" rows="4" placeholder="Enter your comment..." required></textarea>
    </div>
  </div>

  <!-- Buttons -->
<div  style="
    display: flex;
    justify-content: end;
">
    <input type="submit" class="btn btn-primary" value="Submit" >
  </div>   
  </div>
</form>

    </div>
</div>
</div>

<div class="Company-details-banner-descrption animation-sectionss">
    <h1>Airborne Air Hostess Academy in , Delhi</h1>
    <p>
        @php
        $relKeywords = App\Models\Keyword::select('keyword')
        ->where('child_category_id', '1')
        ->get();
        @endphp

        @if($relKeywords->count())
        @foreach($relKeywords as $index => $relKeyword)
        <a href="{{ url('/search?keyword=' . urlencode($relKeyword->keyword)) }}" style="color:white;" class="keystore">
            {{ $relKeyword->keyword }}
        </a>@if(!$loop->last) | @endif
        @endforeach
        @else
        No related keywords found.
        @endif
    </p>
</div>

<script>
    $('.home-search').val(localStorage.getItem('keyword'));
</script>
@endsection