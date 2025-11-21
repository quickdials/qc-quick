@extends('client.layouts.app')
@section('title')
Quick Dials
@endsection
@section('keyword')
Find Best It Training Centre near You, Find Best It Training Institute near You, Find Top 10 IT Training Institute near You, Find Best Entrance Exam Preparation Centre Near you, Top 10 Entrance Exam Centre Near you, Find Best Distance Education Centre Near You, Find Top 10 Distance Education Centre Near You, Find Best School And Colleges Near You, Find Top 10 school And College Near You, Get Education Loan, GET Free career Counselling, Find Best overseas education consultants Near you, Find Top 10 overseas education consultants Near you
@endsection
@section('description')
Find Only Certified Training Institutes, Coaching Centers near you on quickdials and Get Free counseling, Free Demo Classes, and Get Placement Assistence.
@endsection
@section('content')
<!-- Hero-homepage Section -->
<section class="hero-homepage">
  <div class="overlay">
    <h1>Find and provide services with ease.</h1>
    <p>List Your Business for Free with India’s Local Search Engine & Grow Your Brand Online.</p>
    <div class="search-bar-homepage">
      <div class="input-box-homepage" style="border-right:1px solid #fdded6;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="white" height="30px" width="30px"><path d="M128 252.6C128 148.4 214 64 320 64C426 64 512 148.4 512 252.6C512 371.9 391.8 514.9 341.6 569.4C329.8 582.2 310.1 582.2 298.3 569.4C248.1 514.9 127.9 371.9 127.9 252.6zM320 320C355.3 320 384 291.3 384 256C384 220.7 355.3 192 320 192C284.7 192 256 220.7 256 256C256 291.3 284.7 320 320 320z"/></svg>      <form action="/searchlist" method="GET" class="search-form" autocomplete="off"> </form>
          <input type="text" placeholder="Location">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="white" height="30px" width="30px">
  <path d="M231 256l107-107c9.4-9.4 9.4-24.6 0-34L325 102c-9.4-9.4-24.6-9.4-34 0L184 209 77 102c-9.4-9.4-24.6-9.4-34 0L46 115c-9.4 9.4-9.4 24.6 0 34l107 107L46 363c-9.4 9.4-9.4 24.6 0 34l13 13c9.4 9.4 24.6 9.4 34 0l107-107 107 107c9.4 9.4 24.6 9.4 34 0l13-13c9.4-9.4 9.4-24.6 0-34L231 256z"/>
</svg>
      </div>

      <div class="input-box-homepage" style="border-bottom:none">
        <input type="text" placeholder="Select service" class="mobile-inputs">
      <button class="search-btn-homepage">
     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="white" height="25px" width="25px"><path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/></svg>      </button>
            </div>
      </form>
      <!-- <script>
        const clearBtn = document.getElementById('clearBtn');
        const searchInput = document.getElementById('searchInput');
        clearBtn.addEventListener('click', () => {
          searchInput.value = '';
        });
      </script> -->
    </div>
  </div>
  <div class="companydetailsbanner-homepage">
    <img src="{{ asset('client/img/homepagebanner1.jpg') }}" alt="" class="active1">
    <img src="{{ asset('client/img/homepagebanner2.jpg') }}" alt="" class="active2">
    <img src="{{ asset('client/img/homepagebanner3.jpg') }}" alt="" class="active3">
    <img src="{{ asset('client/img/homepagebanner2.jpg') }}" alt="" class="active4">
    <img src="{{ asset('client/img/homepagebanner4.jpg') }}" alt="" class="active5">
  </div>
</section>

<section class="categories-section-country ">
  <div class="animation-sectionss">
  <div class="categories-section-title ">
    <h2 class="categories-title  ">Explore Some Of Our Categories</h2>
  </div>
  <div class="categories-grid-country ">
    <a href="{{ url('categories/professional-courses') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('img/IT-Training.png') }}" alt="IT Courses">
      </div>
      <span class="category-name">IT Courses</span>
    </a>
    <a href="{{ url('child/wedding-planning') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('img/wedding.png') }}" alt="Wedding Planning">
      </div>
      <span class="category-name">Wedding Planning</span>
    </a>
    <a href="{{ url('categories/electric-services') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('img/electric-services.png') }}" alt="Electric Services">
      </div>
      <span class="category-name">Electric Services</span>
    </a>
    <a href="{{ url('categories/entrance-exams-coaching') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('img/government-exam.png') }}" alt="Government Exam">
      </div>
      <span class="category-name">Government Exam</span>
    </a>
    <a href="{{ url('categories/study-abroad') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('img/study-abroad.png') }}" alt="Study Abroad">
      </div>
      <span class="category-name">Study Abroad</span>
    </a>
    <a href="{{ url('categories/spa-beauty') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('img/Spa & Beauty.png') }}" alt="Spa & Beauty">
      </div>
      <span class="category-name">Spa & Beauty</span>
    </a>
    <a href="{{ url('categories/repairs-services') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('img/Repairs-Services.png') }}" alt="Repair Services">
      </div>
      <span class="category-name">Repair Services</span>
    </a>
    <a href="{{ url('categories/packers-movers') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('img/Packers-movers.png') }}" alt="Packers & Movers">
      </div>
      <span class="category-name">Packers & Movers</span>
    </a>
    <a href="{{ url('interior-designer') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('img/interior-design.png') }}" alt="Interior Design">
      </div>
      <span class="category-name">Interior Design</span>
    </a>
    <a href="{{ url('event-organisers') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('img/Event-organizers.png') }}" alt="Event Organizers">
      </div>
      <span class="category-name">Event Organizers</span>
    </a>
    <a href="{{ url('categories/contractors') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('img/contractors.png') }}" alt="Contractors">
      </div>
      <span class="category-name">Contractors</span>
    </a>
    <a href="{{ url('categories/distance-education') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('img/Education.png') }}" alt="Education">
      </div>
      <span class="category-name">Education</span>
    </a>
    <a href="{{ url('categories/medical') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('img/Medical.png') }}" alt="Medical">
      </div>
      <span class="category-name">Medical</span>
    </a>
    <a href="{{ url('categories/loan') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('img/Loan.png') }}" alt="Loan">
      </div>
      <span class="category-name">Loan</span>
    </a>
    <a href="{{ url('categories/yoga') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('img/Yoga.png') }}" alt="Yoga">
      </div>
      <span class="category-name">Yoga</span>
    </a>
    <a href="{{ url('categories/web-technologies') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('images/Web-Designers.png') }}" alt="Web Designers">
      </div>
      <span class="category-name">Web Designers</span>
    </a>
    <a href="{{ url('job-training') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('img/Jobs.png') }}" alt="Jobs">
      </div>
      <span class="category-name">Jobs</span>
    </a>
    <a href="{{ url('tours-and-travels') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('images/tour-travels.png') }}" alt="Tours & Travels">
      </div>
      <span class="category-name">Tours & Travels</span>
    </a>
    <a href="{{ url('school-tuition') }}" class="category-item-country">
      <div class="category-icon">
        <img src="{{ asset('images/school.png') }}" alt="Schools">
      </div>
      <span class="category-name">Schools</span>
    </a>
        <a href="{{ url('school-tuition') }}" class="category-item-country">
      <div class="category-icon">
 <div class="more-categories-">
    <svg width="40" height="40" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
      <path d="M20 7H4" stroke="white" stroke-width="1.5" stroke-linecap="round"></path>
      <path d="M20 12H4" stroke="white" stroke-width="1.5" stroke-linecap="round"></path>
      <path d="M20 17H4" stroke="white" stroke-width="1.5" stroke-linecap="round"></path>
    </svg>
</div>
      </div>
      <span class="category-name">More Categories</span>
    </a>
  </div>
  </div>
</section>

<!-- Categories Block -->
<div class="container">
  <div class="section-header text-center">
    <!-- <h2 class="section-title">Explore More Categories</h2> -->
  </div>
  <div class="categories-wrapper">
    <div class="categories-grid-header">
      <h1 class="categories-heading blue">Popular Search</h1>
      <!-- <p class="categories-desc">Lorem ipsum dolor sit amet Sed at viverra eu.</p> -->
    </div>

    <div class="row popular-list animation-sectionss">

      <!-- Category Item Start -->
      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('/categories/computer-courses')}}" title="IT Training">
              <img src="popular/IT-Training.jpg" alt="IT Training">
              <div class="image-label">IT Training</div>
            </a>
          </div>
        </div>
      </div>
      <!-- Category Item End -->

      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('/categories/entrance-exams-coaching')}}" title="Entrance Exam">
              <img src="popular/Entrance-Exam.jpg" alt="Entrance Exam">
              <div class="image-label">Entrance Exam</div>
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('/categories/packers-movers')}}" title="Packers & Movers">
              <img src="popular/Packers-Movers.jpg" alt="Packers & Movers">
              <div class="image-label">Packers & Movers</div>
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('/categories/interior-designer')}}" title="Interior Design">
              <img src="popular/Interior-design.jpg" alt="Interior Design">
              <div class="image-label">Interior Design</div>
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('/real-estate-agent')}}" title="Real Estate Agents">
              <img src="popular/real-estate-agent.jpg" alt="Real Estate Agents">
              <div class="image-label">Real Estate Agents</div>
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('/carpenters')}}" title="Carpenters">
              <img src="popular/carpenter.jpg" alt="Carpenters">
              <div class="image-label">Carpenters</div>
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
  <div class="categories-wrapper row">
    <div class="categories-grid-header">
      <h1 class="categories-heading orange">Repairs & Services</h1>
      <!-- <p class="categories-desc">
        Lorem ipsum dolor sit amet Sed at viverra eu.
      </p> -->
    </div>

    <div class="row popular-list animation-sectionss">
      <!-- AC Service -->
      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{ url('/ac-service') }}" title="AC Service">
              <img src="popular/AC-Service.jpg" alt="AC Service">
              <div class="image-label">AC Service</div>
            </a>
          </div>
        </div>
      </div>

      <!-- Car Service -->
      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{ url('/car-service') }}" title="Car Services">
              <img src="popular/car-services.jpg" alt="Car Services">
              <div class="image-label">Car Services</div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{ url('/laundry-service') }}" title="Car Services">
              <img src="popular/washing-machines.jpg" alt="Car Services">
              <div class="image-label">Laundry Services</div>
            </a>
          </div>
        </div>
      </div>


      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{ url('/electricity-service') }}" title="Car Services">
              <img src="popular/Electricity-Services.jpg" alt="Car Services">
              <div class="image-label">Electrician Services</div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="" title="Car Services">
              <img src="popular/Hotel-Services.jpg" alt="Car Services">
              <div class="image-label">Hotels </div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('/categories/clinical-research-training')}}" title="Car Services">
              <img src="popular/Fitness-Services.jpg" alt="Car Services">
              <div class="image-label">Health & Fitness </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="categories-wrapper">
    <div class="categories-grid-header">
      <h1 class="categories-heading orange">Wedding Planning</h1>
      <!-- <p class="categories-desc">
        Lorem ipsum dolor sit amet Sed at viverra eu.
      </p> -->
    </div>

    <div class="row popular-list animation-sectionss">

      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('catering-services')}}" title="Catering Services">
              <img src="popular/Catering-Services.jpg" alt="Catering Services">
              <div class="image-label">Catering Services</div>
            </a>
          </div>
        </div>
      </div>


      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('/banquet-halls')}}" title="Banquet Halls">
              <img src="popular/Banquet-Halls.jpg" alt="Banquet Halls">
              <div class="image-label">Banquet Halls</div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('stage-decorators')}}" title="Stage Decorators">
              <img src="popular/Stage-Decorators.jpg" alt="Stage Decorators">
              <div class="image-label">Stage Decorators</div>
            </a>
          </div>
        </div>
      </div>


      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('makeup-artists')}}" title="Makeup Artists">
              <img src="popular/makeup-artists.jpg" alt="Makeup Artists">
              <div class="image-label">Makeup Artists</div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('mehendi-artists')}}" title="Mehendi Artist">
              <img src="popular/Mehendi-Artists.jpg" alt="Mehendi Artist">
              <div class="image-label">Mehendi Artists </div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('bridal-wear')}}" title="Bridal Wear">
              <img src="popular/Bridal-Wear.jpg" alt="Bridal Wear">
              <div class="image-label">Bridal Wear </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="categories-wrapper">
    <div class="categories-grid-header">
      <h1 class="categories-heading orange">Entrance Exams </h1>
      <!-- <p class="categories-desc">
        Lorem ipsum dolor sit amet Sed at viverra eu.
      </p> -->
    </div>

    <div class="row popular-list animation-sectionss">

      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('/categories/entrance-exams-coaching')}}" title="Catering Services">
              <img src="popular/air-force-navy.jpg" alt="Air Force & Navy / SSR / MR">
              <div class="image-label">Air Force & Navy / SSR / MR</div>
            </a>
          </div>
        </div>
      </div>


      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('/categories/entrance-exams-coaching')}}" title="UPSC & IAS">
              <img src="popular/UPSC-IAS.jpg" alt="UPSC & IAS">
              <div class="image-label">UPSC & IAS</div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('/ssc-cgl')}}" title="SSC CGL JEE ">
              <img src="popular/SSC-CGL-JEE.jpg" alt="SSC CGL JEE ">
              <div class="image-label">SSC CGL JEE </div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('/rrb-ntpc-coaching')}}" title="NTPC & RRB Railway">
              <img src="popular/NTPC-RRB-Railway.jpg" alt="NTPC & RRB Railway">
              <div class="image-label">NTPC & RRB Railway</div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('/cat-coaching')}}" title="CAT/NEET">
              <img src="popular/CAT-exam.jpg" alt="CAT/NEET">
              <div class="image-label">CAT/NEET</div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6">
        <div class="popular-div">
          <div class="image-wrapper">
            <a href="{{url('/ctet-coaching')}}" title="CTET Super TET">
              <img src="popular/CTET-Super-TET.jpg" alt="CTET Super TET">
              <div class="image-label">CTET Super TET </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Categories Section -->
  <section class="categories-section-country animation-sectionss" style="background-color: white;">
    <div class="categories-section-title">
      <h2 class="categories-title">Study Abroad</h2>
    </div>
    @if(!empty($studyAbroad))
    @php $counter = 0; @endphp
    @foreach($studyAbroad as $study)
    @if($study->child_slug != 'overseas-journalism-education-consultants' && $study->child_slug != 'overseas-engineering-education-consultant')
    @if($counter % 8 == 0)
    <div class="categories-grid-country-study">
      @endif
      <a href="{{ url('/child/' . $study->child_slug) }}" class="category-item-country">
        <div class="category-icon">
          @php
          if (!empty($study->pc_icon)) {
          $icons = unserialize($study->pc_icon);
          $iconSrc = asset($icons['pc_icon']['src']);
          $iconAlt = $icons['pc_icon']['name'];
          } else {
          $iconSrc = asset('images/it-training.png');
          $iconAlt = 'Default Icon';
          }
          @endphp
          <img src="{{ $iconSrc }}" alt="{{ $iconAlt }}">
        </div>
        <span class="category-name">
          {{ !empty($study->child_category) ? \Illuminate\Support\Str::limit($study->child_category, 18) : 'Study Category' }}
        </span>
      </a>
      @php $counter++; @endphp
      @if($counter % 8 == 0)
    </div>
    @endif
    @endif
    @endforeach
    {{-- Close last open row if items are not divisible by 8 --}}
    @if($counter % 8 != 0)
</div>
@endif
@endif
</section>

<div class="stats-section ">
  <div class="stats-grid animation-sectionss">
    <div class="stat-item">
      <div class="stat-number">2023</div>
      <div class="stat-label">Since 2023<br>Founded</div>
    </div>
    <div class="stat-item">
      <div class="stat-number">350+</div>
      <div class="stat-label">Happy Clients<br>Registered Users</div>
    </div>
    <div class="stat-item">
      <div class="stat-number">200+</div>
      <div class="stat-label">Satisfied Clients</div>
    </div>
    <div class="stat-item">
      <div class="stat-number">6000+</div>
      <div class="stat-label">Business Keywords</div>
    </div>
    <div class="stat-item">
      <div class="stat-number">200+</div>
      <div class="stat-label">Years<br>Team Experience</div>
    </div>
    <div class="stat-item">
      <div class="stat-number">3+</div>
      <div class="stat-label">Countries</div>
    </div>
  </div>
</div>
<div class="container-main animation-sectionss">
  <div class="container" style="padding:0;">
    <div class="main-content-home-page">
      <div class="hero-image">
        <img src="{{ asset('client/images/main-sections.jpg') }}" alt="Professional businessman in modern office">
      </div>
      <div class="cta-section">
        <div class="cta-content">
          <h2 class="cta-title ">Do you have any Requirement in your mind?</h2>
          <div class="cta-buttons">
            <a href="#" class="btn btn-secondary">Get Started</a>
            <a href="#" class="btn btn-primary">Get Quote</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Blog Section -->
<div class="home-blog-section animation-sectionss">
  <h2 class="home-blog-title "><b>Blog Post</b></h2>
  @if(!empty($blogdetails) && count($blogdetails) > 0)
  <div class="home-blog-grid">
    @foreach($blogdetails as $blog)
    @php
    $image = '';
    if (!empty($blog->image)) {
    $imgData = unserialize($blog->image);
    $image = isset($imgData['large']['src']) ? asset($imgData['large']['src']) : '';
    }
    $title = $blog->name ?? 'Blog Title';
    $desc = strip_tags($blog->description ?? '');
    $descShort = strlen($desc) > 120 ? substr($desc, 0, 120) . '...' : $desc;
    @endphp
    <div class="home-blog-card animation-sectionss">
      <img src="{{ $image }}" class="blog-image" alt="{{ $title }}">
      <div class="home-blog-content">
        <h3 class="home-blog-card-title">
          <a href="{{ url('blog/' . $blog->slug) }}">{{ $title }}</a>
        </h3>
        <p class="blog-excerpt">
          {{ ucfirst($descShort) }}
        </p>
        <a href="{{ url('blog/' . $blog->slug) }}" class="home-blog-read-more">Read More</a>
      </div>
    </div>
    @endforeach
  </div>
  <div class="text-center mt-3">
    <a href="{{ url('/blog') }}" class="viewall-txt">View All</a>
  </div>
  @else
  <div class="text-center">
    <div class="title_icon"><img src="{{ asset('client/images/logo.png') }}" alt="logo"></div>
    <nav><a href="{{url('/blog')}}" class="login-btn">View All</a></nav>
  </div>
  @endif
</div>


<div class="banner_botton_open">
  <a href="javascript:void(0);" class="connectedclosebtn">&nbsp;</a>
  <div class="jbt"> Fill this form to Grab the best Deals on <span class="orng">QuickInd</span></div>
  <div class="popup">
    <form class="lead_form" onsubmit="return homeController.saveEnquiry(this)" method="POST">
      <aside>
        <label>Your name<span>*</span></label>
        <div class="popup-form">
          {{ csrf_field()}}
          <input class="form-control home-popup-form" type="text" placeholder="Enter Full Name" name="name" value="">
          <input type="hidden" name="from_page" value="home">
        </div>
        <label>Your Mobile<span>*</span></label>
        <div class="popup-form">
          <input class="form-control home-popup-form" type="tel" placeholder="Enter Mobile" name="mobile" value="">
        </div>
        <label>Your Email ID<span>*</span></label>
        <div class="popup-form">
          <input class="form-control home-popup-form" type="text" placeholder="Enter Email" name="email" value="">
        </div>
        <label>City<span>*</span></label>
        <div class="popup-form" id="select-city-proceed">
          <select class="dropdown-arrow dropdown-arrow-inverse home-popup-form select2-single city" name="city_id">
            <option value="">Select City</option>
          </select>
        </div>
        <label>Interested in<span>*</span></label>
        <div class="popup-form">
          <input type="text" placeholder="Type text" class="form-control city-form home-search" name="kw_text" autocomplete="off">
        </div>
        <div class="ajax-suggest ajax-suggest-lead-ajax" style="display: none;">
          <ul></ul>
        </div>
        <p>
          <label class="moblab">&nbsp;</label>
          <input class="jbtn" type="submit" value="Submit" />
          <input type="reset" class="reset_lead_form hide" value="reset" />
        </p>
      </aside>
    </form>
  </div>
  <section>
    <div class="jpb">
      <p> Your number will be shared only to these experts</p>
      <p>
        <span class="bul"></span> Get Free Expert Online Counseling
      </p>
      <p>
        <span class="bul"></span> Get Free Demo Classes
      </p>
      <p>
        <span class="bul"></span> Get Fees & Discounts
      </p>
    </div>
  </section>
</div>
</div>
<div class="connectedpopup">
  <a href="javascript:void(0);" class="connectedclosebtn">&nbsp;</a>
  <div class="jbt"> Fill this form and get best deals from "<span class="orng">QuickInd</span>"</div>
  <div class="popup">
    <form class="lead_form" onsubmit="return homeController.saveEnquiry(this)">
      <aside>
        <label>Your name<span>*</span></label>
        <div class="popup-form">
          <input class="form-control city-form" type="text" placeholder="Enter Full Name" name="name" value="">
          <input type="hidden" name="lead_form" value="1">
        </div>
        <label>Your Mobile<span>*</span></label>
        <div class="popup-form">
          <input class="form-control city-form" type="tel" placeholder="Enter Mobile" name="mobile" value="">
        </div>
        <label>Your Email ID<span>*</span></label>
        <div class="popup-form">
          <input class="form-control city-form" type="text" placeholder="Enter Email" name="email" value="">
        </div>
        <label>City<span>*</span></label>
        <div class="popup-form" id="select-city-proceed">
          <select class="dropdown-arrow dropdown-arrow-inverse city-form select2-single city" name="city_id">
            <option value="">Select City</option>
          </select>
        </div>
        <label>Interested in<span>*</span></label>
        <div class="popup-form">
          <input type="text" placeholder="Type text" class="form-control city-form home-search" name="kw_text" autocomplete="off">
        </div>
        <div class="ajax-suggest ajax-suggest-lead-ajax" style="display: none;">
          <ul></ul>
        </div>
        <p>
          <label class="moblab">&nbsp;</label>
          <input class="jbtn" type="submit" value="Submit" />
          <input type="reset" class="reset_lead_form hide" value="reset" />
        </p>
      </aside>
    </form>
  </div>
  <section>
    <div class="jpb">
      <p>
        <span class="bul"></span> Your requirement is sent to the selected relevant businesses
      </p>
      <p>
        <span class="bul"></span> Businesses compete with each other to get you the Best Deal
      </p>
      <p>
        <span class="bul"></span> You choose whichever suits you best
      </p>
      <p>
        <span class="bul"></span> Contact Info sent to you by SMS/Email
      </p>
    </div>
  </section>
</div>
@endsection