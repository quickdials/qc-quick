@extends('official.layout.app')
@section('title')
<?php if (!empty($keyword->meta_title)) {
	$key = preg_replace('/{{city}}/i', ucfirst($city), $keyword->meta_title);
	echo trim($key);
} else {
	$key = preg_replace('/{{city}}/i', ucfirst($city), $keyword->keyword);
	echo trim($key);
}
?>
@endsection
@section('keyword')
<?php if (!empty($keyword->meta_keywords)) {
	$msg = preg_replace('/{{city}}/i', ucfirst($city), $keyword->meta_keywords);
	echo trim($msg);
} else {
	$key = preg_replace('/{{city}}/i', ucfirst($city), $keyword->keyword);
	echo trim($key);
} ?>
@endsection
@section('description')
<?php if (!empty($keyword->meta_description)) {
	$descrip = preg_replace('/{{city}}/i', ucfirst($city), $keyword->meta_description);
	echo trim($descrip);
} else {
	$key = preg_replace('/{{city}}/i', ucfirst($city), $keyword->keyword);
	echo trim($key);
} ?>
@endsection
@section('content')
<div class="main-image-section">
	<?php
	if (!empty($keyword->child_banner)) {
		$cicons = unserialize($keyword->child_banner);
		if (!empty($cicons)) {
	?>
			<img src="{{asset($cicons['child_banner']['src'])}}" alt="{{ $cicons['child_banner']['name'] }}">
		<?php  } else { ?>
			<img src="<?php echo asset('client/images/computer-courses-training.jpg'); ?>" alt="computer-courses-training">
			<?php  }
	} else {
		if (!empty($keyword->category_banner)) {
			$cicons = unserialize($keyword->category_banner);
			if ($cicons) {
			?>
				<img src="{{asset($cicons['category_banner']['src'])}}" alt="{{$cicons['category_banner']['name']}}">
			<?php  }
		} else {  ?>
			<img src="<?php echo asset('client/images/computer-courses-training.jpg'); ?>" alt="computer-courses-training">
	<?php }
	} ?>
</div>
<!-- Hero Section -->
<section class="hero">
	<div class="container-subcategories">
		<div class="hero-content">
			<div class="hero-text">
				<h1><?php if (!empty($keyword->keyword)) {
						$key = preg_replace('/{{city}}/i', ucfirst($city), $keyword->keyword);
						echo trim($key);
					} ?> in <?php echo ucfirst($city); ?> </h1>

				<p class="subtitle {{ empty($keyword->child_category) ? 'hidden' : '' }}" style="color: #DFE0E5;">
					@if(!empty($keyword))
					<a href="{{url('child/'.$keyword->child_slug)}}" title="<?php if (!empty($keyword->child_category)) {
																				echo $keyword->child_category;
																			} ?>" style="color: white">
						<?php if (!empty($keyword->child_category)) {
							echo $keyword->child_category;
						} ?>
					</a> /
					<?php if (!empty($keyword->keyword)) {
						echo $keyword->keyword;
					}  ?>
					in <?php echo $city; ?>
					@endif
				</p>
			</div>
			@if(!empty($keyword->ratingvalue))
			@php
			$rating = floatval($keyword->ratingvalue);
			$ratingCount = $keyword->ratingcount ?? 0;
			$fullStars = floor($rating);
			$halfStar = ($rating - $fullStars) >= 0.5;
			$emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
			@endphp
			<div class="hero-extra">
				<div class="hero-rating">
					<p class="subtitle" style="color: #DFE0E5;">
						{{ number_format($rating, 1) }} out of 5 based on {{ $ratingCount }} rating{{ $ratingCount > 1 ? 's' : '' }}
					</p>
					<div class="stars-company-black">
						<div class="stars">
							@for($i = 0; $i < $fullStars; $i++)
								<span class="yellow-star">★</span>
								@endfor

								@if($halfStar)
								<span class="yellow-star">★</span> {{-- optional half star --}}
								@endif

								@for($i = 0; $i < $emptyStars; $i++)
									<span class="white-stars-company-listed">★</span>
									@endfor
						</div>
					</div>
				</div>
			</div>
			@endif

		</div>
	</div>
</section>
<div class="companylisted-heading">
	<h2>Air Hostess</h2>
	@if(isset($keyword) && null!=$keyword->top_description)
	<div class="col-xs-12 top_description" style="margin-top:20px;color:#033967">
		<p title="<?php if (!empty($keyword->keyword)) {
						echo $keyword->keyword;
					} ?> in {{Request::segment(1)}}">
			<?php if (!empty($keyword->top_description)) {
				$keydescription = preg_replace('/{{city}}/i', ucfirst(Request::segment(1)), $keyword->top_description);
				echo trim($keydescription);
			} ?>
		</p>
	</div>
	@endif

	<div class="container-company-listed">
		<div class="sidebar-company-listed ">
			<h2>Quick Enquiry</h2>
			<input type="text" placeholder="Enter your name" class="sidebar-company-listed-input" id="nameInput">
			<input type="tel" placeholder="Your Mobile Number" class="sidebar-company-listed-input" id="phoneInput">
			<button class="sidebar-company-listed-button" id="expertOnlineBtn"><i class="fas fa-user-headset"></i> Expert Online</button>
			<?php $rowCount = 0; ?>
			@if(!empty($subcategory))
			@foreach($subcategory as $child)
			<?php $rowCount++;
			if ($rowCount <= count($clientsList) + 1) { ?>
				<div class="expert-section">
					<div class="expert-badge">
						<?php $assignKeyword = DB::table('keyword')->where('child_category_id', $child->id)->count();
						if ($assignKeyword) {
							echo $assignKeyword;
						} else {
							echo "342";
						}
						?>
						+ Experts Available
					</div>
				</div>
				<div class="expert-title">
					<a href="{{url('child/'.$child->child_slug)}}" title="<?php if (!empty($child->child_category)) echo $child->child_category; ?>">
						<?php if (!empty($child->child_category)) {
							echo $child->child_category;
						} ?>
					</a>
				</div>
				<button class="expert-button">Expert Online </button>
			<?php  } ?>
			@endforeach
			@endif
		</div>

		<!-- Main Content -->
		<div class="main-content-company-listed">
			<div class="header">
				<div class="row">
					<div class="col-lg-4">
						<div class="nav-links" style="border: 1px solid #cbd5e0;">
							<a href="#" class="nav-link active"><img src="{{ asset('client/img/Icon.svg') }}" alt="" height="24px" width="24px"></a>
							<input type="text" placeholder="Search Location" class="nav-link" id="locationInput">
						</div>
					</div>
					<div class="col-lg-8">
						<div class="search-section">
							<input type="text" class="search-input" placeholder="Search Courses" id="courseSearch">
							<button class="search-btn" id="searchButton"><img src="{{ asset('client/img/serchicon.svg') }}" alt="" height="24px" width="24px"> Search</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-9 col-md-9 reviews-box-main mainContainer animation-sectionss">
				@if(!empty($clientsList))
				<?php $n = 0; ?>
				@foreach($clientsList as $client)
				<div class="course-card line-content">
					<div class="course-image">
						<div class="bookmark-icon" data-bookmarked="{{ $client->client_type != 'FreeListing' ? 'true' : 'false' }}">
							@if($client->client_type != 'FreeListing')
							<img src="{{ asset('client/images/ThumbsUp.svg') }}" alt="ThumbsUp">
							@endif
						</div>
						<div class="course-logo">
							<a href="{{ url('business-details').'/'.$client->business_slug }}" title="{{ $client->business_name }}">
								@if(!empty($client->logo))
								<?php $profilePic = unserialize($client->logo); ?>
								<img src="{{ asset($profilePic['large']['src']) }}" alt="{{ $client->business_name }}" height="120" style="width:100%;object-fit:cover;">
								@else
								<img src="{{ asset('client/images/default_pp_small.jpg') }}" alt="Business Logo" height="120" style="width:100%;object-fit:cover;">
								@endif
							</a>
						</div>
					</div>
					<div class="course-content">
						<h3 class="course-title">
							<a href="{{ url('business-details').'/'.$client->business_slug }}" title="{{ $client->business_name }}">
								{{ ucfirst(strtolower(substr($client->business_name, 0, 28))) }}
							</a>
						</h3>
						<div class="course-subtitle">
							{{ strtoupper($client->client_type ?? 'TRAINING PROVIDER') }}
							@if(!empty($client->year_established))
							• SINCE {{ $client->year_established }}
							@endif
						</div>
						<div class="course-description">
							@php
							$addrParts = array_filter([$client->address, $client->city, $client->state, $client->country]);
							$address = implode(', ', $addrParts);
							@endphp
							@if(!empty($address))
							<ul>
								<li>{{ ucfirst($client->city ?? '') }}</li>
								<li>{{ ucfirst($client->state ?? '') }}</li>
							</ul>
							@endif
						</div>
						<div class="course-description">
							Services:
							<ul>
								@php
								$assignedKwds = DB::table('assigned_kwds')
								->join('keyword', 'keyword.id', '=', 'assigned_kwds.kw_id')
								->join('child_category', 'child_category.id', '=', 'assigned_kwds.child_cat_id')
								->select('keyword.keyword', 'child_category.child_category as child_category_name')
								->where('assigned_kwds.client_id', '=', $client->id)
								->limit(2)
								->get();
								@endphp
								@foreach($assignedKwds as $assignedKwd)
								<li>
									<a href="{{ url(generate_slug($assignedKwd->keyword)) }}" title="{{ $assignedKwd->keyword }}" style="color:rgba(11, 16, 52, 0.5)">
										{{ $assignedKwd->keyword }}
									</a>
								</li>
								@endforeach
							</ul>
						</div>
						<div class="course-buttons">
							<a href="{{ url('business-details').'/'.$client->business_slug }}" class="btn btn-primary">View Details</a>
							<a href="javascript:void(0);" class="btn btn-success open-popup" title="{{ $client->business_name }}">Call Now</a>
							<a href="javascript:void(0);" class="btn btn-warning open-popup" title="{{ $client->business_name }}">Get Quote</a>
						</div>
					</div>
					<div class="course-sidebar-company-listed">
						<div class="rating-section">
							<div class="rating-title">User Rating</div>
							<div class="stars-company-listed">
								@php
								if ($client->comment_count > 0) {
								$avgRating = ($client->rating / (5 * $client->comment_count)) * 5;
								$avgRating = number_format($avgRating, 1, '.', '');
								$whole = floor($avgRating);
								$fraction = $avgRating - $whole;
								$remain = 5 - $whole;
								} else {
								$avgRating = 0;
								$whole = $fraction = 0;
								$remain = 5;
								}
								@endphp
								@for($i=0;$i<$whole;$i++)
									<span class="star full">★</span>
									@endfor
									@if($fraction > 0)
									<span class="star half">★</span>
									@endif
									@for($i=0;$i<$remain;$i++)
										<span class="star empty">☆</span>
										@endfor
							</div>
							<div class="rating-text">({{ $avgRating }} Rating out of {{ $client->comment_count ?? 0 }} Votes)</div>
							<div class="course-info-badge">Enquiry Now</div>
						</div>
					</div>
				</div>
				@endforeach
				<style>
					.course-card {
						display: flex;
						border: 1px solid #ddd;
						margin-bottom: 20px;
						padding: 10px;
						border-radius: 8px;
					}

					.course-image {
						flex: 1;
						position: relative;
					}

					.course-content {
						flex: 2;
						/* padding: 10px; */
					}

					.course-sidebar-company-listed {
						flex: 1;
						text-align: center;
						border-left: 1px solid #eee;
						padding: 10px;
					}
				</style>
				@endif
			</div>
		</div>
	</div>

	<div class="wrapper-avi-883 animation-sectionss">
		<div class="img-box-avi-883">
			<img src="{{ asset('client/images/companysectionimages.png') }}" alt="Aviation Management" />
		</div>
		<div class="text-box-avi-883">
			<h1>Top Aviation Management in Raniganj</h1>
			<p>Aviation Management in Raniganj</p>
			<h1>Aviation Management – Build a Thriving Career in the Aviation Industry</h1>
			<p>Looking for the best Aviation Management programs to kickstart your career in the aviation industry?
				quickdials.com connects you with top institutions offering specialized courses in Aviation Management, designed
				to equip students with the skills required for airline operations, airport management, logistics, and more.
				With the growing demand for skilled professionals in aviation, pursuing a Aviation Management course can open
				doors to exciting career opportunities in airlines, airports, and aviation consultancy firms. These programs
				cover key areas such as air transportation, airport security, airline marketing, and financial management,
				ensuring a well-rounded education.
				At quickdials.com, we list verified and reputed aviation institutes that provide industry-relevant training,
				internships, and placement assistance. Whether you're a fresh graduate or a working professional looking to
				switch careers, our platform helps you find the best Aviation Management programs tailored to your needs.
				Explore leading Aviation Management courses today and take your first step toward a successful career in the
				aviation industry.
				Verified Institutes | Industry-Oriented Curriculum | Career Growth Opportunities
				Find the best Aviation Management institutes near you on quickdials.com!
		</div>
	</div>
	@if(!empty($keyword->bottom_description))
	<div class="container">
		<div class="category-description">
			<h2>Top <?php if (!empty($keyword->keyword)) {
						$key = preg_replace('/{{city}}/i', ucwords(str_replace("-", "", $city)), $keyword->keyword);
						echo trim($key);
					} ?> in <?php echo ucwords(str_replace("-", " ", Request::segment(1))); ?></h2>

			<p title="<?php if (!empty($keyword->keyword)) {
							echo $keyword->keyword;
						} ?> in {{Request::segment(1)}}">

				<?php if (!empty($keyword->keyword)) {
					echo $keyword->keyword;
				} ?> in {{ucwords(str_replace("-", " ", Request::segment(1)))}}
			</p>
			<p>
				<?php if (!empty($keyword->bottom_description)) {
					$keydescription = preg_replace('/{{city}}/i', ucwords(str_replace("-", " ", Request::segment(1))), $keyword->bottom_description);
					echo trim($keydescription);
				} ?></p>
		</div>
	</div>
	@endif

	@if(!empty($keyword))
	<?php $kwdsList = App\Models\Keyword::where('child_category_id', $keyword->child_category_id)->where('parent_category_id', $keyword->parent_category_id)->select('keyword', 'icon')->distinct()->get(); ?>
	@if(!empty($kwdsList))
	<div class="courses-section-subcategories">
		<div class="container-subcategories">
			<div class="">
				<h5>Find Services Related to <?php if (!empty($keyword->keyword)) echo $keyword->keyword; ?> </h5>
				<ul class="courses-grid-subcategories animation-sectionss">
					@if(!empty($kwdsList))
					<?php $i = 0;
					$x = 5; ?>
					@foreach($kwdsList as $keyicon)
					<li class="course-card-subcategories" style="text-align:center">
						<?php if (!empty($keyicon->icon)) {
							$data = json_decode($keyicon->icon, true);
							if (!empty($data)) {
						?>
								<img src="{{asset(''.$data['src'])}}" alt="{{ $data['name'] }}" width="25">
						<?php  }
						} ?>
						<a href="{{url(strtolower(Request::segment(1)))}}/<?php echo generate_slug($keyicon->keyword) ?>" title="<?php if (!empty($keyicon->keyword)) {
																																		echo $keyicon->keyword;
																																	} ?> in {{Request::segment(1)}}">
							{{$keyicon->keyword}}
						</a>
					</li>
					@endforeach
					@endif
				</ul>
			</div>
		</div>
	</div>
	@endif
	@endif

	@if(!empty($keyword->faqq1))
	<section class="faq-section-quickdetails">
		<div class="faq-container-quickdetails">
			<h2 class="section-title-subcatgories">
				FAQ:-
				<?php
				if (!empty($keyword->keyword)) {
					$key = preg_replace('/{{city}}/i', ucfirst($city), $keyword->keyword);
					echo trim($key);
				}
				?> in {{ ucfirst(Request::segment(1)) }}
			</h2>

			<div class="faq-list-quickdetails" id="faqListQuickdetails" itemscope itemtype="https://schema.org/FAQPage">

				{{-- FAQ 1 --}}
				@if(!empty($keyword->faqq1))
				<div class="faq-item-quickdetails" data-open="true" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
					<button class="faq-question-quickdetails" aria-expanded="true" aria-controls="answer-1-quickdetails" id="q-1-quickdetails">
						<h3 itemprop="name">
							<strong>
								<?php
								$faqq1 = preg_replace('/{{city}}/i', ucfirst(Request::segment(1)), $keyword->faqq1);
								echo trim($faqq1);
								?>?
							</strong>
						</h3>
						<span class="faq-icon-quickdetails">−</span>
					</button>
					<div id="answer-1-quickdetails" class="faq-answer-quickdetails" role="region" aria-labelledby="q-1-quickdetails" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
						<p itemprop="text">
							<?php
							$faqa1 = preg_replace('/{{city}}/i', ucfirst(Request::segment(1)), $keyword->faqa1);
							echo trim($faqa1);
							?>
						</p>
					</div>
				</div>
				@endif

				{{-- FAQ 2 --}}
				@if(!empty($keyword->faqq2))
				<div class="faq-item-quickdetails" data-open="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
					<button class="faq-question-quickdetails" aria-expanded="false" aria-controls="answer-2-quickdetails" id="q-2-quickdetails">
						<h3 itemprop="name">
							<strong>
								<?php
								$faqq2 = preg_replace('/{{city}}/i', ucfirst(Request::segment(1)), $keyword->faqq2);
								echo trim($faqq2);
								?>?
							</strong>
						</h3>
						<span class="faq-icon-quickdetails">+</span>
					</button>
					<div id="answer-2-quickdetails" class="faq-answer-quickdetails" role="region" aria-labelledby="q-2-quickdetails" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
						<p itemprop="text">
							<?php
							$faqa2 = preg_replace('/{{city}}/i', ucfirst(Request::segment(1)), $keyword->faqa2);
							echo trim($faqa2);
							?>
						</p>
					</div>
				</div>
				@endif

				{{-- FAQ 3 --}}
				@if(!empty($keyword->faqq3))
				<div class="faq-item-quickdetails" data-open="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
					<button class="faq-question-quickdetails" aria-expanded="false" aria-controls="answer-3-quickdetails" id="q-3-quickdetails">
						<h3 itemprop="name">
							<strong>
								<?php
								$faqq3 = preg_replace('/{{city}}/i', ucfirst(Request::segment(1)), $keyword->faqq3);
								echo trim($faqq3);
								?>?
							</strong>
						</h3>
						<span class="faq-icon-quickdetails">+</span>
					</button>
					<div id="answer-3-quickdetails" class="faq-answer-quickdetails" role="region" aria-labelledby="q-3-quickdetails" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
						<p itemprop="text">
							<?php
							$faqa3 = preg_replace('/{{city}}/i', ucfirst(Request::segment(1)), $keyword->faqa3);
							echo trim($faqa3);
							?>
						</p>
					</div>
				</div>
				@endif

				{{-- FAQ 4 --}}
				@if(!empty($keyword->faqq4))
				<div class="faq-item-quickdetails" data-open="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
					<button class="faq-question-quickdetails" aria-expanded="false" aria-controls="answer-4-quickdetails" id="q-4-quickdetails">
						<h3 itemprop="name">
							<strong>
								<?php
								$faqq4 = preg_replace('/{{city}}/i', ucfirst(Request::segment(1)), $keyword->faqq4);
								echo trim($faqq4);
								?>?
							</strong>
						</h3>
						<span class="faq-icon-quickdetails">+</span>
					</button>
					<div id="answer-4-quickdetails" class="faq-answer-quickdetails" role="region" aria-labelledby="q-4-quickdetails" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
						<p itemprop="text">
							<?php
							$faqa4 = preg_replace('/{{city}}/i', ucfirst(Request::segment(1)), $keyword->faqa4);
							echo trim($faqa4);
							?>
						</p>
					</div>
				</div>
				@endif

				{{-- FAQ 5 --}}
				@if(!empty($keyword->faqq5))
				<div class="faq-item-quickdetails" data-open="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
					<button class="faq-question-quickdetails" aria-expanded="false" aria-controls="answer-5-quickdetails" id="q-5-quickdetails">
						<h3 itemprop="name">
							<strong>
								<?php
								$faqq5 = preg_replace('/{{city}}/i', ucfirst(Request::segment(1)), $keyword->faqq5);
								echo trim($faqq5);
								?>?
							</strong>
						</h3>
						<span class="faq-icon-quickdetails">+</span>
					</button>
					<div id="answer-5-quickdetails" class="faq-answer-quickdetails" role="region" aria-labelledby="q-5-quickdetails" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
						<p itemprop="text">
							<?php
							$faqa5 = preg_replace('/{{city}}/i', ucfirst(Request::segment(1)), $keyword->faqa5);
							echo trim($faqa5);
							?>
						</p>
					</div>
				</div>
				@endif

			</div>
		</div>
	</section>
	@endif
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const faqItems = document.querySelectorAll('.faq-item-quickdetails');
			faqItems.forEach(item => {
				const question = item.querySelector('.faq-question-quickdetails');
				const answer = item.querySelector('.faq-answer-quickdetails');
				const icon = item.querySelector('.faq-icon-quickdetails');
				question.addEventListener('click', () => {
					const isActive = item.classList.contains('active');
					faqItems.forEach(i => {
						i.classList.remove('active');
						i.querySelector('.faq-answer-quickdetails').style.maxHeight = null;
						i.querySelector('.faq-icon-quickdetails').textContent = '+';
						i.querySelector('.faq-question-quickdetails').setAttribute('aria-expanded', 'false');
					});
					if (!isActive) {
						item.classList.add('active');
						answer.style.maxHeight = answer.scrollHeight + 'px';
						icon.textContent = '−';
						question.setAttribute('aria-expanded', 'true');
					}
				});
				if (item.classList.contains('active')) {
					answer.style.maxHeight = answer.scrollHeight + 'px';
				}
			});
		});
	</script>

	@if(!empty($keyword))
	<section class="courses-section-subcategories">
		<div class="container-subcategories">
			<h2 class="section-title-subcatgories">
				Find @if (!empty($keyword->keyword))
				{{ $keyword->keyword }}
				@endif in Other Locations
			</h2>
			<div class="courses-grid-subcategories animation-sectionss">
				@php $cities = getCity(); @endphp
				@if(!empty($cities))
				@foreach($cities as $citys)
				<div class="course-card-subcategories">
					<a href="{{ url(strtolower($citys->city)) }}/@if (!empty($keyword->keyword)){{ generate_slug($keyword->keyword) }}@endif" title="@if (!empty($keyword->keyword)){{ $keyword->keyword }}@endif in {{ ucfirst($citys->city) }}">
						@if (!empty($keyword->keyword))
						{{ $keyword->keyword }}
						@endif
						in {{ ucfirst($citys->city) }}
					</a>
				</div>
				@endforeach
				@endif
			</div>
		</div>
	</section>
	@endif

	<div class="inquiry-popup"></div>
	<div class="bestDealpopup">
		<?php
		$value = Cookie::get('showPopup');
		?>
		<a href="javascript:void(0);" class="dealclosebtn">&nbsp;</a>
		<h4>Need Expert Advice ?</h4>
		<div class="jbt"> Fill this form to Grab the best Deals on "<span class="orng"><?php echo $searchedKW . " in "; ?>{{Request::segment(1)}}</span>"</div>
		<div class="bdc">
			<form class="form-inline" action="" method="post" onsubmit="return homeController.saveEnquiry(this)">
				<aside>
					<p><label for="yn">Your Name <span>*</span></label>
						<input type="hidden" name="lead_form" value="1" />
						<input type="hidden" name="kw_text" value="<?php echo $searchedKW; ?>" />
						<input type="hidden" name="city_id" class="city" value="{{Request::segment(1)}}" />
						<input class="jinp" type="text" placeholder="Enter Full Name" name="name">
						<input type="hidden" name="from_page" value="{{ request()->path() }}">
					</p>
					<p>
						<label for="ymn">Your Mobile<span>*</span></label>
						<input class="jinp" type="text" placeholder="Enter Mobile" name="mobile">
					</p>
					<p>
						<label for="yei">Your Email ID <span></span></label>
						<input class="jinp" type="text" placeholder="Enter Email" name="email">
					</p>
					<p>
						<label class="moblab">&nbsp;</label>
						<input class="jbtn" type="submit" name="submit" value="Submit" />
						<input type="reset" class="reset_lead_form hide" value="reset" />
					</p>
				</aside>
			</form>
		</div>

		<section class="bdn">
			<aside class="jpb">
				<p>
					<span class="bul"></span>Your number will be shared only to these experts
				</p>
				<p>
					<span class="bul"></span> Get Free Expert Online Counseling
				</p>
				<p>
					<span class="bul"></span> Get Free Demo Classes
				</p>
				<p>
					<span class="bul"></span> Get Fees & Discounts
				</p>
			</aside>
		</section>
	</div>
	<script>
		function sendData() {
			const name = document.getElementById('name').value;
			//   const email = document.getElementById('email').value;
			const mobile = document.getElementById('mobile').value;
			const kw_text = document.getElementById('kw_text').value;
			const city_id = document.getElementById('city_id').value;
			const from_page = document.getElementById('from_page').value;
			if ((name && mobile) && (mobile.length === 10)) {
				fetch('lead/auto-form-save', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
							'Accept': 'application/json',
							'X-CSRF-TOKEN': '{{ csrf_token() }}'
						},
						body: JSON.stringify({
							name: name,
							mobile: mobile,
							kw_text: kw_text,
							city_id: city_id,
							from_page: from_page
						})
					})
					.then(response => response.json())
					.then(data => {
						// document.getElementById('message').textContent = `Saved: ${data.name} (${data.email})`;
					})
					.catch(error => {
						console.error('Error:', error);
						document.getElementById('message').textContent = 'Error saving data';
						document.getElementById('message').style.color = 'red';
					});
			}
		}
		document.getElementById('mobile').addEventListener('input', sendData);
	</script>
	@endsection