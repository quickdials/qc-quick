@extends('official.layout.app')
@section('title')
Quick Dials- Business Services
@endsection
@section('keyword')
Quick Dials- Business Services list
@endsection
@section('description'),
Quick Dials- Business Services POPULAR CATEGORIES, B2B & BUSINESS SERVICES
@endsection
@section('content')

<div class="main-image-section-subcategories">
  <img src="{{ asset('client/images/entrance-exams-coaching.jpg') }}" alt="Professional Courses">
</div>
<section class="hero">
  <div class="container-childsubcategories">
    <div class="hero-content">
      <div class="hero-text">
        <h1 class=""><?php if (!empty($child_id->child_category)) {
                        echo $child_id->child_category;
                      } ?></h1>
        <a style="color:black;" href="{{url('child/')}}/<?php if (!empty($child_id->child_category)) {
                                                              echo generate_slug($child_id->child_category);
                                                            } ?>">Categories / <?php if (!empty($child_id->child_category)) {
                                                                                  echo $child_id->child_category;
                                                                                } ?></a>
      </div>
      <div class="hero-subcategories-extra">
        <div class="hero-subcategories-rating-subcategories">
          <p class="subtitle" style="color: black; padding-top: 2px;">
            <?php if (!empty($child_id->ratingvalue)) {
              echo number_format((float)$child_id->ratingvalue, 1, '.', '');
            } else {
              echo "1.0";
            } ?>
            out of 5 based on {{$child_id->ratingcount or ""}} rating</p>
          @if(!empty($child_id))
          <div class="rating-subcategories">
            <div class="stars">
              <?php
              $rating = $child_id->ratingvalue;
              $stars = 'star_4.75_new.png';
              $ext = '.png';
              switch ($rating) {
                case 0:
                  $stars = 'star_1' . $ext;
                  break;
                case 2:
                  $stars = 'star_2' . $ext;
                  break;
                case 3:
                  $stars = 'star_3' . $ext;
                  break;
                case 3.5:
                  $stars = 'star_3.5_new' . $ext;
                  break;
                case 4:
                  $stars = 'star_4' . $ext;
                  break;
                case 4.5:
                  $stars = 'star_4.5_new' . $ext;
                  break;
                case 4.75:
                  $stars = 'star_4.75_new' . $ext;
                  break;
                case 5:
                  $stars = 'star_5_new' . $ext;
                  break;
              }
              ?>
              <img class="image" src="{{ asset('client/images/'.$stars) }}" alt="{{$stars}}">
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Courses -->
<section class="courses-section ">
  <div class="container-childsubcategories " >
    <div class="courses-grid-categories ">
      @if(!empty($childCategory))
      @foreach($childCategory as $child)
      <div class="course-card-subcategories">
        @if(!empty($child->keyword))
        <?php if (!empty($child->icon)) {
          $data = json_decode($child->icon, true);
          if (!empty($data)) {
        ?>
            <img src="{{asset(''.$data['src'])}}" alt="{{ $data['name'] }}">
        <?php  }
        } ?>
        <a href="{{generate_slug($child->keyword)}}" title="<?php if (!empty($child->keyword)) {
                                                              echo $child->keyword;
                                                            } ?>" class="keystore"><?php if (!empty($child->keyword)) {
                                                                                      echo $child->keyword;
                                                                                    } ?></a>
        @endif
      </div>
      @endforeach
      @endif
    </div>
</section>

<div class="container-main animation-sectionss" style="padding:8px">
  <div class="container">
    <!-- Main Content -->
    <div class="main-content-home-page">
      <div class="hero-image">
        <img src="{{ asset('client/images/main-sections.jpg') }}" alt="Professional businessman in modern office">
      </div>
      <div class="cta-section">
        <div class="cta-content">
          <h2 class="cta-title">Do you have any Requirement in your mind?</h2>
          <div class="cta-buttons">
            <a href="#" class="btn btn-secondary">Get Started</a>
            <a href="#" class="btn btn-primary">Get Quote</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection