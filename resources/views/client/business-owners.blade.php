@extends('client.layouts.app')
@section('title')
Quick Dials- Local search, IT Training, Playschool, overseas education
@endsection 
@section('keyword')
Quick Dials- Local search, IT Training, Playschool, overseas education
@endsection
@section('description')
Quick Dials- Local search, IT Training, Playschool, overseas education
@endsection
@section('content')	
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"  />
<?php
$authClient = 0;
 
if(Auth::guard('clients')->check()){
	$authClient = 1;
	$showFirstForm = 1;
	if(Session::has('show_first_form'))
		$showFirstForm = 0;
	if(Session::has('show_second_form'))
		$showFirstForm = 0;
	if(Session::has('show_third_form'))
		$showFirstForm = 0;
	if(Session::has('show_fourth_form'))
		$showFirstForm = 0;
}
?>
 
<?php 
 
if(!$authClient): ?>
<style>

@media(max-width:767px){
	#first_image, #second_image, #third_image {
    color: #787878;
    font-size: 18px;
    font-weight: bold;    
    float: left;
    margin: -27px 5px 1px 48px;
}
.faq-details h4.check-title {
    color: #444;
    font-size: 13px !important;
    font-weight: 500;
    margin-bottom: 0;
    line-height: 25px !important;
}
	.growthbusiness {
    width: 99%;
    float: left;
    margin-top: 0;
    margin-bottom: 60px;
    position: relative;
    padding: 0px 0px;
    margin-left: 0px;
   height: auto !important;
    background-repeat: no-repeat;
    background-image: url(../client/images/bg-image.png);
}
.business-clientBlock .img-responsive{ 
    width: 34px;
    float: left;
    margin-left: -50px;
	    margin-bottom: 15px;
	}
.business-clientBlock span {
    color: #787878;
    font-size: 16px;
    font-weight: bold;
    display: block;
    margin-top: 4px;
	margin-top: 5px;
    width: 232px;

}
}
 
</style>


<style>
    
.banner-stepsInternalEven {
    top: 76px;
    width: 100%;
    left: 22.3%;
    display: flex;
    gap:5px
    }
    
 
 .bstep1:first-child {
  margin-left: 0;

}
.reactLogin .bstep1 {
  width: 41%;

  text-align: center;

}


 
.banimgInt.{
display: block;
  font-size: 20px;
}

.login-icDim {
  width: 55px;
  height: 55px;
}

 .banner-stepsInternalEven p {
  display: inline-block;
  color: #343434 !important;
  font-size: 17px;
  
  margin-top: 10px;
  text-align: center;
}

 .bstep1 {
 
  text-align: center;
  border: 0.5px solid #ccc;
  padding: 10px;
  text-align: center;
  margin-bottom: 5px;
  border-radius: 15px;
  box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important;
  transition: all .2s ease-out;
  will-change: transform;
  background: #ffffff;
  width: 125px;
  height: 150px;
}
.banimghdr{
    margin-top: 5px;
}
</style>
<div class="business-banner" id="signup">
<div class="container">
<div class="row">


<div class="col-sm-4 col-md-4 col-xs-12">
<div class="business-quickrequestfotm" >
<h1 class="hide">Business Owners</h1>
<h2>List Your Business </h2>
<?php if(count($errors)>0): ?>
	<div class="alert alert-danger">
		@foreach($errors->all() as $error)
		{{ $error }}.<br>
		@endforeach 
	</div>
<?php endif;  ?>
@if(Session::has('success_msg'))
	<div class="alert alert-success">
		{{Session::get('success_msg')}}
	</div>
@endif
@if(Session::has('danger_msg'))
	<div class="alert alert-danger">
		{{Session::get('danger_msg')}}
	</div>
@endif


<form class="form-style-9" id="business-form" action="{{url('/business-owners')}}" method="POST">
{{csrf_field()}}

<p><input type="text" placeholder="Business/Company Name" class="pull-left" autocomplete="off" name="business_name" value="{{old('business_name')}}"></p>

<p><input type="email" class="field-style pull-left"  placeholder="Enter Email" name="email" value="{{old('email')}}"></p>
<p><input type="tel" class="field-style pull-right" placeholder="Enter Mobile Number" name="mobile" value="{{old('mobile')}}"></p> 

<p><input class="pull-left" type="submit" name="initial_form_submit" value="Start Your Business"></p>
</form>


</div>
</div>

<div class="col-sm-4 col-md-4 col-xs-12">
    <img class="img-responsive" src="<?php echo asset('client/images/growing.svg'); ?>" style="width: 500px;height: 316px;" alt="growing">
 
</div>


<div class="col-sm-4 col-md-4 col-xs-12">
   
 <div class="banner-steps banner-stepsInternalEven" ><div class="bstep1">
     
     <img class="banimgInt" style="height: 37px; width: 37px;" src="{{asset('images/grow-client.png')}}" alt="buyer"> 
     <figcaption class="banimghdr" style="display: block; font-size: 20px;"> <span class="count">{{$clients}}</span>  +</figcaption><figcaption class="banimgDir" style="display: none;"> Grow your Business </figcaption><p class="banimgInt">Grow Client</p>
     
     <p class="banimgDir" style="display: none;">Sell to buyers anytime, anywhere</p></div>
     
     <div class="bstep1">
         <img style="width: 47px;" class="banimgInt" src="{{asset('images/Suppliers.png')}}" alt="supplier">
         
       <figcaption class="banimghdr" style="display: block; font-size: 20px;"> <span class="count">8.1</span> K+</figcaption>
       <p class="banimgInt">Suppliers</p></div>
       
       <div class="bstep1"><img class="banimgInt" style="width: 37px;" src="{{asset('images/Products-services-grow.png')}}" alt="Products-services-grow"> 
       
       <figcaption class="banimghdr" style="display: block; font-size: 20px;"> <span class="count">11.3</span> K+</figcaption><p class="banimgInt">Products &amp; Services</p>
       </div>
       </div>
       
       <div class="banner-steps banner-stepsInternalEven" ><div class="bstep1">
     
     <img class="banimgInt" style="height: 37px; width: 37px;" src="{{asset('images/keyword-grow.png')}}" alt="prodnserv"> 
     <figcaption class="banimghdr" style="display: block; font-size: 20px;"> <span class="count">{{ $keyword }}</span>  +</figcaption><figcaption class="banimgDir" style="display: none;"> Grow your Business </figcaption><p class="banimgInt">Keyword</p>
     
     <p class="banimgDir" style="display: none;">Sell to buyers anytime, anywhere</p></div>
     
     <div class="bstep1">
         <img style="width: 47px;" class="banimgInt" src="{{asset('images/Store-grow.png')}}" alt="prodnserv">
         
       <figcaption class="banimghdr" style="display: block; font-size: 20px;"> <span class="count">21</span>+</figcaption>
       <p class="banimgInt">Store</p></div>
       
       <div class="bstep1"><img class="banimgInt" style="width: 37px;" src="{{asset('images/Platform.png')}}" alt="prodnserv"> 
       
       <figcaption class="banimghdr" style="display: block; font-size: 20px;"> <span class="count">11.3</span> K+</figcaption><p class="banimgInt">Platform</p></div>
       </div>
       
       
       
</div>



</div>
</div>
</div>


<style>
  
.grow-bus{
      margin: auto;
}
</style>


<div class="container">
        <div class="main-section">
            <div class="features">
                <h2>Grow Your Business</h2>
                <div class="feature-item">
                    <i class="fa fa-chart-line"></i>
                    <img src="img/growbusi.png" style="top: -13px; width: 39px; position: relative; left: 0px;" alt="growbusi">
                    <div class="grow-bus">
                        <h3>Grow Your Business</h3>
                        <p>Sell to buyers anytime, anywhere</p>
                    </div>
                </div>
                <div class="feature-item">
                    <img src="img/zerocast.png" style="top: -13px; width: 39px; position: relative; left: 0px;" alt="zerocast">
                    <div class="grow-bus">
                        <h3>Zero Cost</h3>
                        <p>No commission or transaction fee</p>
                    </div>
                </div>
                <div class="feature-item">
                     <img src="img/mybusiness.png" style="top: -13px; width: 39px; position: relative; left: 0px;" alt="mybusiness">
                    <div class="grow-bus">
                        <h3>Manage Your Business Better</h3>
                        <p>Lead Management System & other features</p>
                    </div>
                </div>
            </div>

            <div class="steps">
                <div class="step">
                    <h3>Create Account</h3>
                    <p>Add your name and phone number to get started</p>
                </div>
                <div class="step">
                    <h3>Add Business</h3>
                    <p>Add the name, e-mail of your company, store/business.</p>
                </div>
                <div class="step">
                    <h3>Add Products/Services</h3>
                    <p>Minimum 3 products/services needed for your free listing page.</p>
                </div>
            </div>
        </div>
    </div>

    <style>
    

     
        .main-section {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .features {
            flex: 1;
            padding: 20px;
            background-color: #e8f0fe;
            border-radius: 8px;
        }

        .features h2 {
            font-size: 24px;
            color: #1a73e8;
            margin-bottom: 20px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .feature-item i {
            font-size: 24px;
            color: #1a73e8;
            margin-right: 10px;
        }

        .feature-item h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .feature-item p {
            font-size: 14px;
            color: #666;
        }

        .steps {
            flex: 2;
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .step {
            flex: 1;
            text-align: center;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            position: relative;
        }

        .step:not(:last-child)::after {
            content: '>';
            position: absolute;
            right: -17px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
            color: #1a73e8;
        }

        .step h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .step p {
            font-size: 14px;
            color: #666;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-section {
                flex-direction: column;
                padding: 20px;
            }

            .features {
                margin-bottom: 20px;
            }

            .steps {
                flex-direction: column;
            }

            .step:not(:last-child)::after {
                content: '↓';
                right: 50%;
                top: auto;
                bottom: -23px;
                transform: translateX(50%);
            }

            .step {
                margin-bottom: 20px;
            }
        }

        @media (max-width: 480px) {
            .features h2 {
                font-size: 20px;
            }

            .feature-item h3 {
                font-size: 16px;
            }

            .feature-item p, .step p {
                font-size: 12px;
            }

            .step h3 {
                font-size: 16px;
            }
        }
    </style>
    <style>
      /* Base Styles */
:root {
    /* Light Theme */
    --primary: #3b82f6;
    --primary-dark: #1e40af;
    --secondary: #1e3a8a;
    --text-dark: #1f2937;
    --text-light: #6b7280;
    --white: #ffffff;
    --off-white: #f9fafb;
    --gray-light: #f3f4f6;
    --gray: #e5e7eb;
    --background: #ffffff;
    --section-light-bg: #f9fafb;
    --section-dark-bg: #f3f4f6;
    --card-bg: #ffffff;
    --card-shadow: rgba(0, 0, 0, 0.05);
    --card-shadow-hover: rgba(0, 0, 0, 0.1);
    --footer-bg: #1a202c;
    --footer-text: #a0aec0;
    --header-bg: #ffffff;
    --header-shadow: rgba(0, 0, 0, 0.1);
    --logo-text: #1e3a8a;
}

.dark-theme {
    /* Dark Theme */
    --primary: #60a5fa;
    --primary-dark: #3b82f6;
    --secondary: #4b5eAA;
    --text-dark: #e5e7eb;
    --text-light: #9ca3af;
    --white: #1f2937;
    --off-white: #374151;
    --gray-light: #4b5563;
    --gray: #6b7280;
    --background: #111827;
    --section-light-bg: #1f2937;
    --section-dark-bg: #374151;
    --card-bg: #293444;
    --card-shadow: rgba(255, 254, 254, 0.05);
    --card-shadow-hover: rgba(255, 255, 255, 0.1);
    --footer-bg: #0f172a;
    --footer-text: #d1d5db;
    --header-bg: #1f2937;
    --header-shadow: rgba(255, 255, 255, 0.3);
    --logo-text: #e5e7eb;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    font-family: 'Inter', sans-serif;
    color: var(--text-dark);
    line-height: 1.6;
    background-color: var(--background);
    overflow-x: hidden;
}

a {
    text-decoration: none;
    color: inherit;
}

img {
    max-width: 100%;
}

 
/* Header & Navigation */
header {
    background-color: var(--header-bg);
    box-shadow: 0 2px 10px var(--header-shadow);
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
    transition: all 0.3s ease;
}

header.scrolled {
    padding: 0.5rem 0;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.2rem 0;
}

.logo {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--logo-text);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.logo i {
    color: var(--primary);
}

.nav-links {
    display: flex;
    gap: 2rem;
    align-items: center;
}

.nav-link {
    font-weight: 500;
    transition: color 0.3s ease;
    position: relative;
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 0;
    height: 2px;
    background-color: var(--primary);
    transition: width 0.3s ease;
}

.nav-link:hover {
    color: var(--primary);
}

.nav-link:hover::after {
    width: 100%;
}

.cta-button {
    background-color: var(--primary);
    color: var(--white);
    padding: 0.7rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid var(--primary);
    box-shadow: 0 4px 6px rgba(59, 130, 246, 0.25);
}

.cta-button:hover {
    background-color: var(--primary-dark);
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(59, 130, 246, 0.3);
}

.cta-button.outline {
    background-color: transparent;
    color: var(--off-white);
}

.cta-button.outline:hover {
    background-color: var(--primary);
    color: var(--white);
}

.mobile-menu-btn {
    display: none;
    background: none;
    border: none;
    font-size: 1.5rem;
    color: var(--text-dark);
    cursor: pointer;
}

.theme-toggle {
    width: 40px;
    height: 40px;
    background: none;
    border: none;
    font-size: 1.5rem;
    color: var(--text-dark);
    cursor: pointer;
    transition: color 0.3s ease, transform 0.3s ease;
    padding: 0.5rem;
    border-radius: 50%;
}

.theme-toggle:hover {
    color: var(--primary);
    transform: rotate(15deg);
}

.theme-toggle i {
    transition: transform 0.3s ease;
}

.dark-theme .theme-toggle i.fa-sun {
    display: none;
}

.dark-theme .theme-toggle i.fa-moon {
    display: inline;
}

.theme-toggle i.fa-moon {
    display: none;
}

/* Hero Section */
.hero {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: var(--white);
    padding: 10rem 0 6rem;
    position: relative;
    overflow: hidden;
}

.hero::before {
    content: '';
    position: absolute;
    top: -10%;
    right: -10%;
    width: 60%;
    height: 70%;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    pointer-events: none;
}

.hero::after {
    content: '';
    position: absolute;
    bottom: -20%;
    left: -10%;
    width: 80%;
    height: 70%;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    pointer-events: none;
}

.hero-content {
    text-align: center;
    position: relative;
    z-index: 1;    
    margin: 0 auto;
}

.hero h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 2.5rem;
    opacity: 0.9;
}

.hero-cta {
    display: inline-flex;
    gap: 1rem;
}

.floating-elements {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    overflow: hidden;
    pointer-events: none;
}

.floating-element {
    position: absolute;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 15s infinite linear;
}

.floating-element:nth-child(1) {
    width: 80px;
    height: 80px;
    top: 15%;
    left: 10%;
    animation-duration: 25s;
}

.floating-element:nth-child(2) {
    width: 60px;
    height: 60px;
    top: 20%;
    right: 20%;
    animation-duration: 18s;
    animation-delay: 2s;
}

.floating-element:nth-child(3) {
    width: 40px;
    height: 40px;
    bottom: 30%;
    left: 30%;
    animation-duration: 20s;
    animation-delay: 1s;
}

.floating-element:nth-child(4) {
    width: 100px;
    height: 100px;
    bottom: 20%;
    right: 10%;
    animation-duration: 22s;
    animation-delay: 3s;
}

@keyframes float {
    0% {
        transform: translate(0, 0) rotate(0deg);
    }

    25% {
        transform: translate(10px, 20px) rotate(90deg);
    }

    50% {
        transform: translate(20px, 0px) rotate(180deg);
    }

    75% {
        transform: translate(10px, -20px) rotate(270deg);
    }

    100% {
        transform: translate(0, 0) rotate(360deg);
    }
}

/* Section Styles */
section {
    padding: 6rem 0;
}

section.light {
    background-color: var(--section-light-bg);
}

section.dark {
    background-color: var(--section-dark-bg);
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    position: relative;
    display: inline-block;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background: var(--primary);
}

.section-subtitle {
    font-size: 1.1rem;
    color: var(--text-light);
    max-width: 700px;
    margin: 0 auto;
}

/* Features Section */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.feature-card {
    background-color: var(--card-bg);
    border-radius: 10px;
    padding: 2rem;
    text-align: center;
    box-shadow: 0 5px 15px var(--card-shadow);
    transition: all 0.4s ease;
    position: relative;
    z-index: 1;
    overflow: hidden;
}

.feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 0;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(30, 58, 138, 0.1));
    z-index: -1;
    transition: height 0.4s ease;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px var(--card-shadow-hover);
}

.feature-card:hover::before {
    height: 100%;
}

.feature-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--primary);
    color: var(--white);
    border-radius: 50%;
    font-size: 2rem;
    transition: all 0.3s ease;
}

.feature-card:hover .feature-icon {
    transform: rotateY(360deg);
    background-color: var(--primary-dark);
}

.feature-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.feature-description {
    color: var(--text-light);
}

/* How It Works Section */
.steps-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    position: relative;
}

.step-connector {
    position: absolute;
    top: 50px;
    left: calc(16.67% + 25px);
    width: calc(100% - 33.33% - 50px);
    height: 3px;
    background-color: var(--primary);
    z-index: 0;
}

.step {
    text-align: center;
    position: relative;
    z-index: 1;
}

.step-number {
    width: 60px;
    height: 60px;
    background-color: var(--primary);
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0 auto 1.5rem;
    position: relative;
    transition: all 0.3s ease;
}

.step:hover .step-number {
    transform: scale(1.1);
    box-shadow: 0 0 0 5px rgba(59, 130, 246, 0.3);
}

.step-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.step-description {
    color: var(--text-light);
}

/* Pricing Section */
.pricing-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    max-width: 900px;
    margin: 0 auto;
}

.pricing-card {
    background-color: var(--card-bg);
    border-radius: 10px;
    padding: 3rem 2rem;
    text-align: center;
    box-shadow: 0 5px 15px var(--card-shadow);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.pricing-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    z-index: -1;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    transition: height 0.3s ease;
}

.pricing-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px var(--card-shadow-hover);
}

.pricing-card:hover::before {
    height: 100px;
}

.pricing-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
}

.pricing-card:hover .pricing-title {
    color: var(--white);
}

.pricing-description {
    color: var(--text-light);
    margin-bottom: 1.5rem;
    min-height: 80px;
}

.pricing-price {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--primary);
    margin-bottom: 2rem;
}

/* Testimonials Section */
.testimonials-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.testimonial-card {
    background-color: var(--card-bg);
    border-radius: 10px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    position: relative;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px var(--card-shadow-hover);
}

.testimonial-text {
    color: var(--text-light);
    margin-bottom: 1.5rem;
    position: relative;
    padding-top: 1.5rem;
}

.testimonial-text::before {
    content: '\201C';
    position: absolute;
    top: -10px;
    left: -5px;
    font-size: 4rem;
    color: var(--primary);
    opacity: 0.3;
    line-height: 1;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.testimonial-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: var(--gray);
    overflow: hidden;
}

.testimonial-info h4 {
    font-weight: 600;
}

.testimonial-info p {
    color: var(--text-light);
    font-size: 0.9rem;
}

/* CTA Section */
.cta-section {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: var(--white);
    text-align: center;
    padding: 5rem 0;
    position: relative;
    overflow: hidden;
}

.cta-section::before,
.cta-section::after {
    content: '';
    position: absolute;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.05);
}

.cta-section::before {
    top: -150px;
    right: -100px;
}

.cta-section::after {
    bottom: -150px;
    left: -100px;
}

.cta-content {
    position: relative;
    z-index: 1;
    max-width: 700px;
    margin: 0 auto;
}

.cta-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
}

.cta-description {
    font-size: 1.1rem;
    margin-bottom: 2.5rem;
    opacity: 0.9;
}

/* Footer */
footer {
    background-color: var(--footer-bg);
    color: var(--footer-text);
    padding: 4rem 0 2rem;
}

.footer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.footer-column h3 {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    position: relative;
    padding-bottom: 0.5rem;
}

.footer-column h3::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 2px;
    background-color: var(--primary);
}

.footer-column p {
    color: var(--footer-text);
    margin-bottom: 1rem;
}

.footer-links {
    list-style: none;
}

.footer-links li {
    margin-bottom: 0.8rem;
}

.footer-links a {
    color: var(--footer-text);
    transition: color 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.footer-links a i {
    margin-right: 0.5rem;
    font-size: 0.8rem;
}

.footer-links a:hover {
    color: var(--primary);
}

.footer-bottom {
    text-align: center;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--footer-text);
    font-size: 0.9rem;
}

.social-links {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.social-link {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.social-link:hover {
    background-color: var(--primary);
    transform: translateY(-3px);
}

/* Animation Classes */
.fade-in {
    opacity: 1;
    transform: translateY(30px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.fade-in.active {
    opacity: 1;
    transform: translateY(0);
}

.fade-in-left {
    opacity: 1;
    transform: translateX(-50px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.fade-in-left.active {
    opacity: 1;
    transform: translateX(0);
}

.fade-in-right {
    opacity: 1;
    transform: translateX(50px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.fade-in-right.active {
    opacity: 1;
    transform: translateX(0);
}

.scale-in {
    opacity: 0;
    transform: scale(0.8);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.scale-in.active {
    opacity: 1;
    transform: scale(1);
}

/* Benefits Section */
.benefits-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 3rem;
}

.benefit-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.benefit-icon {
    width: 70px;
    height: 70px;
    background-color: rgba(59, 130, 246, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: var(--primary);
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
}

.benefit-item:hover .benefit-icon {
    background-color: var(--primary);
    color: var(--white);
    transform: rotateY(180deg);
}

.benefit-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.benefit-description {
    color: var(--text-light);
}

/* Stats Section */
.stats-section {
    background: linear-gradient(rgba(30, 58, 138, 0.9), rgba(30, 58, 138, 0.9)), url('https://images.unsplash.com/photo-1497215842964-222b430dc094?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    color: var(--white);
    text-align: center;
    padding: 6rem 0;
}

.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 3rem;
    margin-top: 3rem;
}

.stat-item {
    padding: 1.5rem;
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    background: linear-gradient(90deg, #ffffff, #a5b4fc);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.stat-label {
    font-size: 1.1rem;
    opacity: 0.9;
}

/* Use Cases Section */
.use-cases-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.use-case-card {
    background-color: var(--card-bg);
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.use-case-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px var(--card-shadow-hover);
}

.use-case-image {
    height: 200px;
    background-size: cover;
    background-position: center;
    position: relative;
}

.use-case-image::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.4));
}

.use-case-content {
    padding: 2rem;
}

.use-case-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.use-case-description {
    color: var(--text-light);
    margin-bottom: 1.5rem;
}

/* FAQ Section */
.faq-container {
    max-width: 800px;
    margin: 0 auto;
}

.faq-item {
    margin-bottom: 1.5rem;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    background-color: var(--card-bg);
}

.faq-question {
    padding: 1.5rem;
    background-color: var(--card-bg);
    font-weight: 600;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s ease;
}

.faq-question:hover {
    color: var(--primary);
}

.faq-question i {
    transition: transform 0.3s ease;
}

.faq-answer {
    padding: 0 1.5rem;
    max-height: 0;
    overflow: hidden;
    transition: all 0.3s ease;
    color: var(--text-light);
}

.faq-item.active .faq-question {
    color: var(--primary);
}

.faq-item.active .faq-question i {
    transform: rotate(180deg);
}

.faq-item.active .faq-answer {
    padding: 0 1.5rem 1.5rem;
    max-height: 1000px;
}

/* Team Section */
.team-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.team-member {
    background-color: var(--card-bg);
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.team-member:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px var(--card-shadow-hover);
}

.team-photo {
    height: 250px;
    background-size: cover;
    background-position: center;
    position: relative;
    overflow: hidden;
}

.team-photo::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.7));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.team-member:hover .team-photo::before {
    opacity: 1;
}

.team-social {
    position: absolute;
    bottom: -50px;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: center;
    gap: 1rem;
    padding: 1rem 0;
    transition: bottom 0.3s ease;
    z-index: 1;
}

.team-member:hover .team-social {
    bottom: 0;
}

.team-social-link {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background-color: var(--white);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.team-social-link:hover {
    background-color: var(--primary);
    color: var(--white);
    transform: translateY(-3px);
}

.team-info {
    padding: 1.5rem;
    text-align: center;
}

.team-name {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.team-position {
    color: var(--primary);
    font-weight: 500;
    margin-bottom: 1rem;
}

.team-bio {
    color: var(--text-light);
    font-size: 0.9rem;
}

/* Blog Section */
.blog-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.blog-card {
    background-color: var(--card-bg);
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.blog-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px var(--card-shadow-hover);
}

.blog-image {
    height: 200px;
    background-size: cover;
    background-position: center;
}

.blog-content {
    padding: 2rem;
}

.blog-date {
    color: var(--primary);
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.blog-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1rem;
    transition: color 0.3s ease;
}

.blog-card:hover .blog-title {
    color: var(--primary);
}

.blog-excerpt {
    color: var(--text-light);
    margin-bottom: 1.5rem;
}

.blog-link {
    color: var(--primary);
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: gap 0.3s ease;
}

.blog-link:hover {
    gap: 0.8rem;
}

/* Contact Form Section */
.contact-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 3rem;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.contact-icon {
    width: 50px;
    height: 50px;
    background-color: rgba(59, 130, 246, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: var(--primary);
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.contact-item:hover .contact-icon {
    background-color: var(--primary);
    color: var(--white);
}

.contact-text h4 {
    font-weight: 600;
    margin-bottom: 0.3rem;
}

.contact-text p {
    color: var(--text-light);
}

.contact-form {
    background-color: var(--card-bg);
    border-radius: 10px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.form-control {
    width: 100%;
    padding: 0.8rem 1rem;
    border: 1px solid var(--gray);
    border-radius: 5px;
    font-family: inherit;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
}

textarea.form-control {
    min-height: 150px;
    resize: vertical;
}

.form-button {
    width: 100%;
    padding: 1rem;
    border: none;
    border-radius: 5px;
    background-color: var(--primary);
    color: var(--white);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.form-button:hover {
    background-color: var(--primary-dark);
    transform: translateY(-3px);
}

/* Partners Section */
.partners-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 3rem;
}

.partner-logo {
    max-width: 150px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    filter: grayscale(100%);
    opacity: 0.7;
    transition: all 0.3s ease;
}

.partner-logo:hover {
    filter: grayscale(0%);
    opacity: 1;
    transform: scale(1.1);
}

.partner-logo img {
    max-width: 100%;
    max-height: 100%;
}

/* Responsive Styles */
@media (max-width: 992px) {
    .hero h1 {
        font-size: 2.8rem;
    }

    .section-title {
        font-size: 2.2rem;
    }

    .step-connector {
        display: none;
    }
}

@media (max-width: 768px) {
    .nav-links {
        position: fixed;
        top: 0;
        right: -100%;
        width: 70%;
        height: 100vh;
        background-color: var(--card-bg);
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: right 0.3s ease;
        box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .nav-links.active {
        right: 0;
    }

    .mobile-menu-btn {
        display: block;
        z-index: 1001;
    }

    .mobile-menu-btn.active i::before {
        content: '\f00d';
    }

    .theme-toggle {
        margin: 1rem 0;
    }

    .hero h1 {
        font-size: 2.2rem;
    }

    .hero p {
        font-size: 1rem;
    }

    .hero-cta {
        flex-direction: column;
        gap: 1rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .cta-title {
        font-size: 2rem;
    }
}

@media (max-width: 576px) {
    .hero h1 {
        font-size: 1.8rem;
    }

    .section-title {
        font-size: 1.8rem;
    }

    .feature-card,
    .pricing-card,
    .testimonial-card {
        padding: 1.5rem;
    }
    .pricing-card:hover::before {
    height: 80px;
}
}
    </style>

 
 







 <section class="hero" id="home">
      <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
      </div>
      <div class="container">
        <div class="hero-content">
          <h1 class="fade-in">List Your Business for FREE on QuickDials</h1>
          <p class="fade-in" style="transition-delay: 0.2s">
           India’s Local Search Engine – Reach {{$clients}} + Buyers and Skyrocket Your Business Growth

          </p>
          <div class="hero-cta fade-in" style="transition-delay: 0.4s">
            <a href="#signup" class="cta-button">Try for Free</a>
            <a href="#learnmore" class="cta-button outline">Learn More</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section class="light" id="features">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title fade-in">
            Powerful Features for Your Business
          </h2>
          <p class="section-subtitle fade-in">
            Discover how Lead can transform your workforce management with
            these powerful tools.
          </p>
        </div>
        <div class="features-grid">
          <!-- Feature 1 -->
          <div class="feature-card fade-in-left">
            <div class="feature-icon">             
              <img src="{{ asset('img/google-maps.png')}}" alt="Google map">
            </div>
            <h3 class="feature-title">📍Google Maps Optimization</h3>
            <p class="feature-description">
              Improve your local visibility by optimizing Google Business Profile with keywords, reviews.
            </p>
          </div>
          <!-- Feature 2 -->
          <div class="feature-card fade-in" style="transition-delay: 0.2s">
            <div class="feature-icon">           
                <img src="{{ asset('img/local-keyword.png')}}" alt="local-keyword">
              
            </div>
            <h3 class="feature-title">🏷️Local Keyword Targeting</h3>
            <p class="feature-description">
              Rank for city-specific or “near me” search terms to drive local traffic and qualified leads.
            </p>
          </div>
          <!-- Feature 3 -->
          <div
            class="feature-card fade-in-right"
            style="transition-delay: 0.4s"
          >
            <div class="feature-icon">              
                <img src="{{ asset('img/call-form.png')}}" alt="call-form">
            </div>
            <h3 class="feature-title">📞 Call & Form Tracking</h3>
            <p class="feature-description">
              Monitor how many calls and form submissions come from local searches and specific landing pages.
            </p>
          </div>
          <!-- Feature 4 -->
          <div class="feature-card fade-in-left" style="transition-delay: 0.2s">
            <div class="feature-icon">             
             <img src="{{ asset('img/lead-capture.png')}}" alt="lead-capture">
              
            </div>
            <h3 class="feature-title">🛠️ Lead Capture Landing Pages</h3>
            <p class="feature-description">
             Create location-specific landing pages designed to convert local visitors into leads
            </p>
          </div>
          <!-- Feature 5 -->
          <div class="feature-card fade-in" style="transition-delay: 0.4s">
            <div class="feature-icon">
              
                <img src="{{ asset('img/review-putation.png')}}" alt="review-putation">
              
            </div>
            <h3 class="feature-title">⭐ Review & Reputation Management</h3>
            <p class="feature-description">
              Encourage and manage customer reviews to boost credibility and local rankings.
            </p>
          </div>
          <!-- Feature 6 -->
          <div
            class="feature-card fade-in-right"
            style="transition-delay: 0.6s"
          >
            <div class="feature-icon">

            <img src="{{ asset('img/citation-building.png')}}" alt="citation-building">
              
            </div>
            <h3 class="feature-title">🧭 Citation Building & Local Listings</h3>
            <p class="feature-description">
              Submit your business info to trusted local directories to improve consistency and authority.
            </p>
          </div>
          <!-- Feature 7 -->
        
    
           
         
        </div>
      </div>
    </section>
 <!-- #region -->

    <!-- Stats Section -->
    <section class="stats-section">
      <div class="container">
        <h2 class="section-title fade-in" style="color: white">
        Grow business
        </h2>
        <p
          class="section-subtitle fade-in"
          style="color: rgba(255, 255, 255, 0.8)"
        >
          Join thousands of businesses that trust Lead for their workforce
          management needs.
        </p>
        <div class="stats-container">
          <div class="stat-item fade-in">
            <div class="stat-number" id="stat1">{{$clients}}+</div>
            <div class="stat-label" style="color: rgba(255, 255, 255, 0.8)">
              Active Client
            </div>
          </div>
          <div class="stat-item fade-in" style="transition-delay: 0.2s">
            <div class="stat-number" id="stat2">25,000+</div>
            <div class="stat-label" style="color: rgba(255, 255, 255, 0.8)">
              Employees Tracked
            </div>
          </div>
          <div class="stat-item fade-in" style="transition-delay: 0.4s">
            <div class="stat-number" id="stat3">100%</div>
            <div class="stat-label" style="color: rgba(255, 255, 255, 0.8)">
              Customer Satisfaction
            </div>
          </div>
          <div class="stat-item fade-in" style="transition-delay: 0.6s">
            <div class="stat-number" id="stat4">35%</div>
            <div class="stat-label" style="color: rgba(255, 255, 255, 0.8)">
              Average Lead Increase
            </div>
          </div>
        </div>
      </div>
    </section>

  

     

    <!-- CTA Section -->
    <section class="cta-section" id="learnmore">
      <div class="container">
        <div class="cta-content">
          <h2 class="cta-title fade-in">How Quick Dials help You to Grow your Business</h2>
        
       
        </div>
      </div>
    </section>
  
  



<style>
.growthbusiness {
    width: 99%;
    float: left;
    margin-top: 0;
    margin-bottom: 60px;
    position: relative;
    padding: 0px 0px;
    margin-left: 0px;
    height: 490px;
    background-repeat: no-repeat;
    background-image: url(../client/images/bg-image.png);
}
#faq {
    width: 99%;
    float: left;
    margin-top: 0;
    margin-bottom: 60px;
    position: relative;
    padding: 0px 0px;
    margin-left: 0px;
    height: auto;
    background-repeat: no-repeat;
    background-image: url(../client/images/bg-image.png);
}
.growthbusiness li{
	list-style-type:square;
	margin-left: 18px;
}
</style>
  <div class="blog" >
            <div class="tab-content">  
<div class="" >
 <div class="growthbusiness">
 
			 
      <div class="col-md-12">    
            
     <div class="col-md-6">           
     <h3> <a href="javascript:void(0)">How Quick Dials help You to Grow your Business?</a></h3>
     <p>Quick Dials helps grow your business by boosting local visibility, generating quality leads, and connecting you with customers searching for your services.</p>
		<h3> <a href="javascript:void(0)">What is Quick Dials?</a></h3>
		<p>Quick Dials is a comprehensive search platform designed for students, parents, and professionals seeking reliable information across India's diverse education landscape and industrial sectors. India offers a wide spectrum of opportunities, spanning education, manufacturing, services, and core industries.</p>
        <ul>
            <li>🎓 Education: From schools and coaching centers to higher education institutions.</li>
            <li>🏭 Manufacturing: Including automotive, pharmaceuticals, textiles, and chemicals.</li>
            <li>💼 Service Industries: Such as IT, finance, tourism, and healthcare.</li>
            <li>⚙️ Core Sectors: Covering India’s Eight Core Industries — electricity, steel, refinery products, crude oil, coal, cement, natural gas, and fertilizers.</li>
        </ul>

  <h3> <a href="javascript:void(0)"> Benefits you will get after associating with us:</a></h3>
               
 
<ul><li>If the provided leads are out of your locality or category, we work on the same to replace it as soon as possible.</li>
<li>We have the policy to refund on those leads that failed to commit.</li>
<li>We provide end to end support to deliver the best needed.</li>
<li>The information about leads will be distributed by SMS on your registered number and mailing on your registered email id.</li>

</ul>

		
	</div>
            
       <div class="col-md-6">
                 <h3> <a href="javascript:void(0)">Why choose Quick Dials for growing your business?</a></h3>
               
<p>There are a few aspects that make us different from others and the aim directed towards helping the users and the client to get the best opportunity because:</p>
<ul><li>The work module is very different from others.</li>
<li>We follow the conversion module.</li>
<li>We provide dual manually verified leads to your business.</li></ul><br>
<p>These aspects make us different from others but there are few more things that make us unique and pops up the priority for you to choose us:</p>
<ul><li>	The leads are generated in both ways organic and inorganic</li>
<li>	We have a co-branding relationship with our own channel partners making us more capable and worthy to choose.</li>
<li>	The leads provided by us are all verified twice by our expert counselors, in order to provide you genuine candidates.</li></ul>

<h3> <a href="javascript:void(0)">contact Us :</a></h3>
		<p>Contact: +91 70113 10265, Email: info@quickdials.com, Website: www.quickdials.com.</p>
		<p>Other ways can be; by registering your business as a free listing, don’t worry, our marketing team is always happy to find you.</p>



			    
			            
               
               
           
            </div> 
			
			  
            </div>
             
         
     
 
</div>
</div>
                     

              

 
           
            </div>
			  
 
		
 
        </div>
		
		
		
 <?php endif; ?>
<div class="clearfix"></div>
<div class="wrap-middle-section">
<div class="container">


<!-- <div class="clearfix"></div> -->

 
<!-- Slide Section -->

<!--Start New Section-->
<h2 class="business-title text-center">Benefits of listing your business with Quick Dials</h2>
<div class="business-clientBlock">
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
		<img class="img-responsive" src="<?php echo asset('client/images/business/group.png'); ?>" alt="Leads that Convert to Business" />
		<span>Leads that Convert to Business</span>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
		<img class="img-responsive" src="<?php echo asset('client/images/business/profile.png'); ?>" alt="Ready-to-Share Profile" />
		<span>Ready-to-Share Profile</span>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
		<img class="img-responsive" src="<?php echo asset('client/images/business/head_phone.png'); ?>" alt="Reliable Customer Support" />
		<span>Reliable Customer Support</span>
	</div>
</div>

 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <style>
 .faq-details h4.check-title {
    color: #444;
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 0;
    line-height: 25px;
}
 
.panel-default>.panel-heading {
    background-color: transparent;
    border: medium none;
    color: #333;
}
.panel-heading {
    padding: 1px 15px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
} 
.faq-details a span.acc-icons {
    position: relative;
}
.faq-details a span.acc-icons::before {
    color: #333;
    content: "";
    font-family: fontawesome;
    font-size: 24px;
    height: 40px;
    left: -51px;
    line-height: 39px;
    position: absolute;
    text-align: center;
    top: -10px;
    width: 42px;
}
.faq-details h4.check-title a.active, .faq-details a.active span.acc-icons::before {
    color: #3EC1D5;
}
.faq-details h4.check-title a {
    color: #333;
    display: block;
    font-weight: 700;
    letter-spacing: 2px;
    margin-left: 40px;
    padding: 6px 10px;
    text-decoration: none;
}
::selection {
    background: #3EC1D5;
    text-shadow: none;
}
.faq-details a.active span.acc-icons::before {
    content: "";
    font-family: fontawesome;
    font-size: 24px;
    height: 40px;
    left: -51px;
    line-height: 39px;
    position: absolute;
    text-align: center;
    top: -10px;
    width: 42px;
}
 </style>
<div id="faq" class="faq-area area-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>FAQ's</h2>
          </div>
        </div>
      </div>
      <div class="row">
	  
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="faq-details">
            <div class="panel-group" id="accordion">
             
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
					<a data-toggle="collapse" class="" data-parent="#accordion" href="#check1">
                        <span class="acc-icons"></span> What is Quick Dials?
						</a></h4>
                </div>
                <div id="check1" class="panel-collapse collapse in">
                  <div class="panel-body">
                    <p>
                     Quick Dials is an extensive search engine for the students, parents, and Professionals, Quick Dials Only Deals In Education Sector and helps students to grab their right opportunity, and helps business owners to grow their business.
                    </p>
                  </div>
                </div>
              </div>
            
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#check2">
                        <span class="acc-icons"></span>Why choose Quick Dials for growing your business?
						</a></h4>
                </div>
                <div id="check2" class="panel-collapse collapse">
                  <div class="panel-body">
                    <p>
                      Our Work Module Is Completely Different, we work on the Conversion module, and we Provide you  Dual Manually Verified Leads to your Business. 
                    </p>
                  </div>
                </div>
              </div>
               
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#check3">                                          <span class="acc-icons"></span>What Happen If my leads commitment did not get fulfilled?
						</a>
						</h4>
                </div>
                <div id="check3" class="panel-collapse collapse ">
                  <div class="panel-body">
                    <p>
                      In case we are unable to fulfill our committed no of leads, we will refund your remaining amount.
                    </p>  

					 
                  </div>
                </div>
              </div>
             
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#check4">
                                                <span class="acc-icons"></span> What happens if I received a lead from out of my city/category?
											</a>
										</h4>
                </div>
                <div id="check4" class="panel-collapse collapse">
                  <div class="panel-body">
                    <p>
                     If you get a lead which is either out from your Locality or Category Then we will replace it as soon as possible.
                    </p>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div><div class="col-md-6 col-sm-6 col-xs-12">
          <div class="faq-details">
            <div class="panel-group" id="accordions">
             
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
				 <a data-toggle="collapse" class="" data-parent="#accordions" href="#check5">
                    <span class="acc-icons"></span>How Diffrent your leads quality from others?
					</a></h4>
                </div>
                <div id="check5" class="panel-collapse collapse">
                  <div class="panel-body">
                    <p>
					our leads are dual manually verified by our expert counselors, so no need to worry about it.
                    </p>
                  </div>
                </div>
              </div>
               
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
					<a data-toggle="collapse" data-parent="#accordions" href="#check6"><span class="acc-icons"></span>How do you generate leads?</a>
						</h4>
                </div>
                <div id="check6" class="panel-collapse collapse">
                  <div class="panel-body">
                    <p>
                    we generate leads organically as well as inorganic leads, and we have Our own channels partners
                    </p>
                  </div>
                </div>
              </div>
              
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
					<a data-toggle="collapse" data-parent="#accordions" href="#check7">
                        <span class="acc-icons"></span>How will I get Leads?
					</a>
				</h4>
                </div>
                <div id="check7" class="panel-collapse collapse ">
                  <div class="panel-body">
                    <p>
                     You will receive Leads on your Registered contact no through sms, and also on Your registered Email Id.
                    </p>
                  </div>
                </div>
              </div>
              
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
					<a data-toggle="collapse" data-parent="#accordions" href="#check8">
                        <span class="acc-icons"></span>I Need More info?
					</a>
				</h4>
                </div>
                <div id="check8" class="panel-collapse collapse">
                  <div class="panel-body">
                    <p>
                    For More Info & any Queries, you can Contact Us on +91 70113 10265 or reach out to us via e-mail @ info@quickdials.com, or list your business as free listing, our marketing team Will Contact you Soon.
                    </p>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
		
		
        
      </div>
      <!-- end Row -->
    </div>
  </div>
 


</div>
</div>
<div class="clearfix"></div>

<script>
 
$(function() {
  setTimeout(function() {
    $('.business_success').fadeOut('fast');
  }, 5000);
});
</script>
 

@endsection
