@extends('client.layouts.app')
@section('title')
@if(!empty($part_id->meta_title))
<?php
$key = preg_replace('/in {{city}}/i', '', $part_id->meta_title);
echo trim($key);   ?>
@else
@if(!empty($part_id->parent_category)){!!$part_id->parent_category!!}@endif

@endif
@endsection
@section('keyword')
<?php if (!empty($part_id->meta_keywords)) {
	$msg = preg_replace('/in {{city}}/i', ' ', $part_id->meta_keywords);
	echo trim($msg);
} ?>
@endsection
@section('description')
<?php if (!empty($part_id->meta_description)) {
	$descrip = preg_replace('/{{city}}/i', ' ', $part_id->meta_description);
	echo trim($descrip);
} ?>
@endsection
@section('content')
<div class="main-image-section-subcategories">
	<img src="{{ asset('client/images/subcategoryimage.png') }}" alt="Professional Courses">
</div>
<section class="hero-subcategories">
	<div class="container-subcategories">
		<div class="hero-subcategories-content ">
			<div class="hero-subcategories-text">
				<h1 class=""><?php if (!empty($part_id->parent_category)) {
									echo $part_id->parent_category;
								} ?></h1>
				<p class="subtitle" style="color: #DFE0E5;">
					<a style="color: #DFE0E5;" href="{{url('categories/')}}/<?php if (!empty($part_id->parent_category)) {
																				echo generate_slug($part_id->parent_category);
																			} ?>">
						Categories /
						<?php if (!empty($part_id->parent_category)) {
							echo $part_id->parent_category;
						} ?>
					</a>
				</p>

			</div>
			<div class="hero-subcategories-extra">
				<div class="hero-subcategories-rating-subcategories">
					<p class="subtitle" style="color: #DFE0E5; padding-top:10px"><?php if (!empty($part_id->ratingvalue)) {
																	echo number_format((float)$part_id->ratingvalue, 1, '.', '');
																} else {
																	echo "1.0";
																} ?> out of 5 based on {{$part_id->ratingcount or ""}} rating</p>
					@if(!empty($part_id))
					<div class="rating-subcategories">
						<div class="stars">
							<?php
							$rating = $part_id->ratingvalue;
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
<section class="courses-section-subcategories">
	<div class="container-subcategories">
		<h2 class="section-title-subcatgories animation-sectionss">Explore Professional Courses Categories</h2>
		<div class="courses-grid-subcategories animation-sectionss">
			@if(!empty($businessServices))
			@foreach($businessServices as $parent)
			<div class="course-card-subcategories">
				<?php if (!empty($parent->pc_icon)) {
					$cicons = unserialize($parent->pc_icon);
					if (!empty($cicons)) {
				?>
						<img src="{{asset(''.$cicons['pc_icon']['src'])}}" alt="{{ $cicons['pc_icon']['name'] }}" style="width:30px">
					<?php  } else { ?>
						<img src="<?php echo asset('images/it-training.png'); ?>" alt="it-training">
				<?php  }
				} ?>
				<a href="{{url('/child/'.$parent->child_slug)}}" title="<?php if (!empty($parent->child_category)) {
																			echo $parent->child_category;
																		} ?>">
					<?php if (!empty($parent->child_category)) {
						echo $parent->child_category;
					} ?>
				</a>
			</div>
			@endforeach
			@endif
		</div>
</section>

@if(!empty($part_id->faqq1))
<section class="faq-section-quickdetails">
	<div class="faq-container-quickdetails">
		<h2 class="section-title-subcatgories">FAQ:-
			<?php if (!empty($part_id->parent_category)) {
				echo $part_id->parent_category;
			} ?>
		</h2>
		<div class="faq-list-quickdetails" id="faqListQuickdetails">
			<div class="faq-item-quickdetails" data-open="true">
				<button class="faq-question-quickdetails" aria-expanded="true" aria-controls="answer-1-quickdetails"
					id="q-1-quickdetails">
					<h3>
						<strong>
							<?php if (!empty($part_id->faqq1)) {
								echo $part_id->faqq1;
							} ?>?
						</strong>
					</h3>
					<span class="faq-icon-quickdetails">−</span>
				</button>
				<div id="answer-1-quickdetails" class="faq-answer-quickdetails" role="region" aria-labelledby="q-1-quickdetails">
					<p>
						<?php if (!empty($part_id->faqa1)) {
							echo $part_id->faqa1;
						} ?>
					</p>
				</div>
			</div>
			<div class="faq-item-quickdetails" data-open="false">
				<button class="faq-question-quickdetails" aria-expanded="false" aria-controls="answer-2-quickdetails"
					id="q-2-quickdetails">
					<h3>
						<strong>
							<?php if (!empty($part_id->faqq2)) {
								echo $part_id->faqq2;
							} ?>?
						</strong>
					</h3>
					<span class="faq-icon-quickdetails">−</span>
				</button>
				<div id="answer-2-quickdetails" class="faq-answer-quickdetails" role="region" aria-labelledby="q-2-quickdetails">
					<p>
						<?php if (!empty($part_id->faqa2)) {
							echo $part_id->faqa2;
						} ?>
					</p>
				</div>
			</div>
			<div class="faq-item-quickdetails" data-open="false">
				<button class="faq-question-quickdetails" aria-expanded="false" aria-controls="answer-3-quickdetails"
					id="q-3-quickdetails">
					<h3>
						<strong>
							<?php if (!empty($part_id->faqq3)) {
								echo $part_id->faqq3;
							} ?>?
						</strong>
					</h3>
					<span class="faq-icon-quickdetails">−</span>
				</button>
				<div id="answer-3-quickdetails" class="faq-answer-quickdetails" role="region" aria-labelledby="q-3-quickdetails">
					<p>
						<?php if (!empty($part_id->faqa3)) {
							echo $part_id->faqa3;
						} ?>
					</p>
				</div>
			</div>
			<div class="faq-item-quickdetails" data-open="false">
				<button class="faq-question-quickdetails" aria-expanded="false" aria-controls="answer-4-quickdetails"
					id="q-4-quickdetails">
					<h3>
						<strong>
							<?php if (!empty($part_id->faqq4)) {
								echo $part_id->faqq4;
							} ?>?
						</strong>
					</h3>
					<span class="faq-icon-quickdetails">−</span>
				</button>
				<div id="answer-4-quickdetails" class="faq-answer-quickdetails" role="region" aria-labelledby="q-4-quickdetails">
					<p>
						<?php if (!empty($part_id->faqa4)) {
							echo $part_id->faqa4;
						} ?>
					</p>
				</div>
			</div>
			<div class="faq-item-quickdetails" data-open="false">
				<button class="faq-question-quickdetails" aria-expanded="false" aria-controls="answer-5-quickdetails"
					id="q-5-quickdetails">
					<h3>
						<strong>
							<?php if (!empty($part_id->faqq5)) {
								echo $part_id->faqq5;
							} ?>?
						</strong>
					</h3>
					<span class="faq-icon-quickdetails">−</span>
				</button>
				<div id="answer-5-quickdetails" class="faq-answer-quickdetails" role="region" aria-labelledby="q-5-quickdetails">
					<p>
						<?php if (!empty($part_id->faqa5)) {
							echo $part_id->faqa5;
						} ?>
					</p>
				</div>
			</div>
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

<div class="container-main animation-sectionss" style="padding:8px">
	<div class="container">
		<div class="main-content-home-page">
			<div class="hero-image">
				<img src="{{ asset('client/images/main-sections.jpg') }}" alt="Professional businessman in modern office">
			</div>
			<div class="cta-section">
				<div class="cta-content">
					<h2 class="cta-title animation-sectionss">Do you have any Requirement in your mind?</h2>
					<div class="cta-buttons">
						<a href="#" class="btn btn-secondary">Get Started</a>
						<a href="#" class="btn btn-primary">Get Quote</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="inquiry-popup"></div>

<div class="bestDealpopup">

	<a href="javascript:void(0);" class="dealclosebtn">&nbsp;</a>

	<h4>Need Expert Advice </h4>
	<div class="jbt"> Fill this form to Grab the best Deals on "<span class="orng"><?php if ($part_id->parent_category) {
																						echo $part_id->parent_category;
																					} ?></span>"</div>
	<div class="bdc">

		<form class="form-inline" action="" method="post" onsubmit="return homeController.saveEnquiry(this)">
			<aside>

				<p><label for="yn">Your Name <span>*</span></label>
					<input type="hidden" name="lead_form" value="1" />
					<input type="hidden" name="kw_text" value="<?php echo $part_id->parent_category; ?>" />
					<input type="hidden" name="city_id" class="cityList" value="" />
					<input class="jinp" type="text" placeholder="Enter Full Name" name="name" value="">
					<input type="hidden" name="from_page" value="{{ request()->path() }}">
				</p>
				<p>
					<label for="ymn">Your Mobile<span>*</span></label>
					<input class="jinp" type="tel" placeholder="Enter Mobile" name="mobile" value="">
				</p>
				<p>
					<label for="yei">Your Email ID <span></span></label>
					<input class="jinp" type="text" placeholder="Enter Email" name="email" value="">
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
@endsection