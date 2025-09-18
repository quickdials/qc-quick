@extends('client.layouts.app')
@section('title')
@if(!empty($part_id->meta_title))	
<?php   
$key = preg_replace('/in {{city}}/i','',$part_id->meta_title);
echo trim($key);   ?>
@else
	@if(!empty($part_id->parent_category)){!!$part_id->parent_category!!}@endif  

@endif
@endsection 
@section('keyword')
<?php if(!empty($part_id->meta_keywords)){
$msg = preg_replace('/in {{city}}/i',' ',$part_id->meta_keywords);
echo trim($msg); } ?>
@endsection
@section('description')
<?php if(!empty($part_id->meta_description)){
$descrip = preg_replace('/{{city}}/i',' ',$part_id->meta_description);
echo trim($descrip); } ?> 
@endsection
@section('content')	

 
	<style>
		.inner-client-div .grid-info h3{
			height:auto;
		}
		.inner-client-div .grid-info .get-quotes{
			margin-top:-25px;
		}
		.font-11{
			font-size:11px;
		}
		.course-program ul li {
        	border: 0.5px solid#ccc;
            padding: 12px 14px;
            text-align: center;
            margin: 5px 0px 24px 70px;
            display: inline-flex;
            grid-gap: 46px 106px;
            box-shadow: 0 0 10px 0 #e3e3e3;
		    
		}
		.course-program ul li:hover{ background: linear-gradient(180deg, #ecf4f3, #f1f5f5)
		  }
	</style>
	
	<div class="container">
        <div class="row"> 
            <div class="col-xs-12 col-sm-12 col-md-12 third-add-section">
        
                  <?php  
                     
                    if(!empty($part_id->child_banner)){
                    $cicons= unserialize($part_id->child_banner); 
                    if (!empty($cicons)) {
                    ?>
                    
                    <img src="{{asset(''.$cicons['child_banner']['src'])}}" alt="{{$cicons['child_banner']['name']}}">
                    
                    <?php  }else{ ?>
                    
                    <img src="<?php echo asset('client/images/computer-courses-training.jpg'); ?>" alt="computer-courses-training">
                    <?php  } }else{ 
                        
                        if(!empty($part_id->category_banner)){
                    $cicons= unserialize($part_id->category_banner); 
                    if($cicons){
                    ?>
                    
                    <img src="{{asset(''.$cicons['category_banner']['src'])}}" alt="{{$cicons['category_banner']['name']}}">
                    
                    
                    <?php  } }else{  ?>
                    <img src="<?php echo asset('client/images/computer-courses-training.jpg'); ?>" alt="computer-courses-training" >
                    
                    <?php } } ?>  
                
                </div>
        </div>
    </div>
 

<div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 form-section">
            <div class="col-xs-9 col-sm-9 col-md-9 removeLeftSpace">
                <div class="hdTitle">				 
					
                        @if(!empty($part_id)) 	 
                        <?php
                        $rating = $part_id->ratingvalue;
                        $stars = 'star_4.75_new.png';
                        $ext = '.png'; 
                        switch($rating){  
                        case 0:
                        $stars = 'star_1'.$ext;
                        break;
                        case 2:
                        $stars = 'star_2'.$ext;
                        break;
                        case 3:
                        $stars = 'star_3'.$ext;
                        break;
                        case 3.5:
                        $stars = 'star_3.5_new'.$ext;
                        break;
                        case 4:
                        $stars = 'star_4'.$ext;
                        break;
                        case 4.5:
                        $stars = 'star_4.5_new'.$ext;
                        break;
                        case 4.75:
                        $stars = 'star_4.75_new'.$ext;
                        break;
                        case 5:
                        $stars = 'star_5_new'.$ext;
                        break;
                        }
                        ?>
				 
				<div itemscope itemtype="https://schema.org/Product" style="font-size: 12px;font-weight: 500;">			 
				<div class="text-primary" itemprop="name"><h1><?php if(!empty($part_id->parent_category)) { echo $part_id->parent_category; } ?></h1></div>
				<div itemprop="aggregateRating"
				itemscope itemtype="https://schema.org/AggregateRating">
				<img itemprop="image" src="{{ asset('client/images/'.$stars) }}"  alt="{{$stars}}"/>
				<span itemprop="ratingValue"><?php if(!empty($part_id->ratingvalue)) { echo number_format((float)$part_id->ratingvalue, 1, '.', '');  }else{ echo "1.0"; } ?></span>
				out of <span itemprop="bestRating"></span>
				based on <span itemprop="ratingCount">{{$part_id->ratingcount or ""}}</span> ratings
				</div>    
				</div>
				<div class="keyword-cotegory-text">	 			
		
			 <a href="{{url('categories/')}}/<?php if(!empty($part_id->parent_category)) { echo generate_slug($part_id->parent_category); } ?>" >Categories / <?php if(!empty($part_id->parent_category)) { echo $part_id->parent_category; } ?></a> 

			 </div>
					 
@endif
					</div>
            </div>
              
 
        </div>
       
	 
    </div>
   
    
	   
	    <div class="container">
      
 
       
       
        <div class="category-box">
	   <div class="business-services">
	   	<ul class="content-list intent">	
	   	
	    
		@if(!empty($businessServices))
			@foreach($businessServices as $parent)
 
	<li class=""><?php  if(!empty($parent->pc_icon)){
                    $cicons= unserialize($parent->pc_icon); 
                    if (!empty($cicons)) {
                    ?>
                    
                    <img src="{{asset(''.$cicons['pc_icon']['src'])}}" alt="{{ $cicons['pc_icon']['name'] }}" style="width:30px" >
                    
                    <?php  }else{ ?>
                    
                    <img src="<?php echo asset('images/it-training.png'); ?>" alt="it-training" >
                    <?php  } } ?><a href="{{url('/child/'.$parent->child_slug)}}" title="<?php if(!empty($parent->child_category)){  echo $parent->child_category; } ?>" ><?php if(!empty($parent->child_category)){  echo $parent->child_category; } ?></a> </li>
	   
	   @endforeach
	   @endif
	   
	   </ul>
	   </div>
	   </div>
	   </div>
	   
	  
	  
	  
	   
	   	@if(!empty($part_id->faqq1))
		<div class="container"> 		 
		<div class="category-description">  
		<h4>FAQ:- <?php  if(!empty($part_id->parent_category)){ echo $part_id->parent_category; } ?> </h4> 
			<div itemscope itemtype="https://schema.org/FAQPage">
			<?php if(!empty($part_id->faqq1)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($part_id->faqq1)){
			echo $part_id->faqq1;  } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" style="display: block;">
			<div itemprop="text">
			<?php  if(!empty($part_id->faqa1)){
			echo $part_id->faqa1;
			  } ?>
			 

			</div>
			</div>
			</div>
			<?php } ?>


			<?php if(!empty($part_id->faqq2)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($part_id->faqq2)){
		echo $part_id->faqq2; } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
			<?php  if(!empty($part_id->faqa2)){
			echo $part_id->faqa2;
			 } ?>
		 
			</div>
			</div>
			</div>
			<?php } ?>		
			<?php if(!empty($part_id->faqq3)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($part_id->faqq3)){
			echo $part_id->faqq3;
		     } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
			<?php  if(!empty($part_id->faqa3)){
		echo $part_id->faqa3;
			 } ?>
			 
			</div>
			</div>
			</div>
			<?php } ?>		
			<?php if(!empty($part_id->faqq4)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($part_id->faqq4)){
			echo $part_id->faqq4;
		         } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
			<?php  if(!empty($part_id->faqa4)){
			echo $part_id->faqa4;
		  } ?>
			 
			</div>
			</div>
			</div>
			<?php } ?>		
			<?php if(!empty($part_id->faqq5)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($part_id->faqq5)){
			echo $part_id->faqq5;
			 } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
			<?php  if(!empty($part_id->faqa5)){
			echo $part_id->faqa5;
			 } ?>
		 
			</div>
			</div>
			</div>
			<?php } ?>


			</div>
		
		</div>
		
		 
		</div>
		@endif  
	 
      
    </div>
    
       	  
<div class="inquiry-popup"></div>

    <div class="bestDealpopup"> 
		 
        <a href="javascript:void(0);" class="dealclosebtn">&nbsp;</a> 

	   <h4>Need Expert Advice </h4>
        <div class="jbt"> Fill this form to Grab the best Deals on "<span class="orng"><?php if($part_id->parent_category){ echo $part_id->parent_category; } ?></span>"</div>
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
                    <span class="bul"></span> Get Free Expert Online Counseling</p>
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