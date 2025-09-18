@extends('client.layouts.app')
@section('title')
Quick Dials- Business Services
@endsection 
@section('keyword')
Quick Dials-  Business Services list 
@endsection
@section('description'),  
Quick Dials- Business Services POPULAR CATEGORIES, B2B & BUSINESS SERVICES
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
                    if(!empty($child_id->child_banner)){
                    $cicons= unserialize($child_id->child_banner); 
                    if (!empty($cicons)) {
                    ?>
                    
                    <img src="{{asset(''.$cicons['child_banner']['src'])}}" alt="{{ $cicons['child_banner']['name'] }}">
                    
                    <?php  }else{ ?>
                    
                    <img src="<?php echo asset('client/images/computer-courses-training.jpg'); ?>" alt="computer-courses-training">
                    <?php  } }else{ 
                        
                        if(!empty($child_id->child_banner)){
                    $cicons= unserialize($child_id->child_banner); 
                    if($cicons){
                    ?>
                    
                    <img src="{{asset(''.$cicons['child_banner']['src'])}}" alt="{{ $cicons['child_banner']['name']}}">
                    
                    
                    <?php  } }else{  ?>
                    <img src="<?php echo asset('client/images/computer-courses-training.jpg'); ?>" alt="computer-courses-training">
                    
                    <?php } } ?>
                </div>
        </div>
    </div>
  

    
<div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 form-section">
            <div class="col-xs-9 col-sm-9 col-md-9 removeLeftSpace">
                <div class="hdTitle">				 
				  
                        @if(!empty($child_id)) 	 
                        <?php
                        $rating = $child_id->ratingvalue;
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
				<div class="text-primary" itemprop="name"><h1><?php if(!empty($child_id->child_category)) { echo $child_id->child_category; } ?></h1></div>
				<div itemprop="aggregateRating"
				itemscope itemtype="https://schema.org/AggregateRating">
				<img itemprop="image" src="{{ asset('client/images/'.$stars) }}"  alt="{{$stars}}"/>
				<span itemprop="ratingValue"><?php if(!empty($child_id->ratingvalue)) { echo number_format((float)$child_id->ratingvalue, 1, '.', '');  }else{ echo "1.0"; } ?></span>
				out of <span itemprop="bestRating"></span>
				based on <span itemprop="ratingCount">{{$child_id->ratingcount or ""}}</span> ratings
				</div>    
				</div>
				<div class="keyword-cotegory-text">	 			
		
			 <a href="{{url('child/')}}/<?php if(!empty($child_id->child_category)) { echo generate_slug($child_id->child_category); } ?>" >Categories / <?php if(!empty($child_id->child_category)) { echo $child_id->child_category; } ?></a> 

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
	    
	    
		@if(!empty($childCategory))
			@foreach($childCategory as $child)
            @if(!empty($child->keyword))
            <li class="">
            <?php  if(!empty($child->icon)){

            $data = json_decode($child->icon, true);
            if (!empty($data)) {
            ?>

            <img src="{{asset(''.$data['src'])}}" alt="{{ $data['name'] }}" >

            <?php  }   } ?>
            <a href="{{generate_slug($child->keyword)}}" title="<?php if(!empty($child->keyword)) { echo $child->keyword; } ?>" class="keystore"><?php if(!empty($child->keyword)) { echo $child->keyword; } ?></a> 


            </li>@endif
	   
	   @endforeach
	   @endif
	   
	   </ul>
	   </div>
	   </div>
	   
	   
	  
	   
	   
	   
	   
	   
	   
	 
        <div class="clearfix"></div>
    </div>
    
       
@endsection