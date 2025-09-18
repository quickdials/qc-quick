@extends('client.layouts.app')
@section('title')
 
 	 
<?php  if(!empty($keyword->meta_title)){
$key = preg_replace('/{{city}}/i',ucfirst($city),$keyword->meta_title);
echo trim($key); }else{
$key = preg_replace('/{{city}}/i',ucfirst($city),$keyword->keyword);
echo trim($key);
}
?>
 
@endsection 
@section('keyword')
<?php if(!empty($keyword->meta_keywords)){
$msg = preg_replace('/{{city}}/i',ucfirst($city),$keyword->meta_keywords);
echo trim($msg); }else{
$key = preg_replace('/{{city}}/i',ucfirst($city),$keyword->keyword);
echo trim($key);
} ?>
@endsection
@section('description')
<?php if(!empty($keyword->meta_description)){
$descrip = preg_replace('/{{city}}/i',ucfirst($city),$keyword->meta_description);
echo trim($descrip); }else{
$key = preg_replace('/{{city}}/i',ucfirst($city),$keyword->keyword);
echo trim($key);
} ?> 
@endsection
@section('content')	 
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 third-add-section">
               
                 <?php  
                    if(!empty($keyword->child_banner)){
                    $cicons= unserialize($keyword->child_banner); 
                    if (!empty($cicons)) {
                    ?>
                    
                    <img src="{{asset($cicons['child_banner']['src'])}}" alt="{{ $cicons['child_banner']['name'] }}">
                    
                    <?php  }else{ ?>
                    
                    <img src="<?php echo asset('client/images/computer-courses-training.jpg'); ?>" alt="computer-courses-training">
                    <?php  } }else{ 
                        
                        if(!empty($keyword->category_banner)){
                    $cicons= unserialize($keyword->category_banner); 
                    if($cicons){
                    ?>
                    
                    <img src="{{asset($cicons['category_banner']['src'])}}" alt="{{$cicons['category_banner']['name']}}">
                    
                    
                    <?php  } }else{  ?>
                    <img src="<?php echo asset('client/images/computer-courses-training.jpg'); ?>" alt="computer-courses-training">
                    
                    <?php } } ?>  
                
                </div>
        </div>
    </div>
<?php 
if(!empty($keyword) || !empty($clientsList)  ){ ?>
   <div class="clearfix"></div>
    
    <div class="container">
        <div class="form-section">
            <div class="removeLeftSpace">
                <div class="hdTitle">
       	@if(!empty($keyword))	
        <?php
        $rating = $keyword->ratingvalue;
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
                <div class="text-primary" itemprop="name"><h1><?php  if(!empty($keyword->keyword)){ $key = preg_replace('/{{city}}/i',ucfirst($city),$keyword->keyword); echo trim($key); } ?> in <?php echo ucfirst($city); ?> </h1></div>
                <div itemprop="aggregateRating"
                itemscope itemtype="https://schema.org/AggregateRating">
                <img itemprop="image" src="{{ asset('client/images/'.$stars) }}"  alt="5 Star Rating: Very Good"/>
                <span itemprop="ratingValue"><?php if(!empty($keyword->ratingvalue)) { echo number_format((float)$keyword->ratingvalue, 1, '.', '');  }else{ echo "1.0"; } ?></span>
                out of <span itemprop="bestRating"></span>
                based on <span itemprop="ratingCount">{{$keyword->ratingcount }}</span> ratings
                </div>    
                </div>
                @endif
        <div class="keyword-cotegory-text">	 			
		
			 @if(!empty($keyword))
			<a href="{{url('child/'.$keyword->child_slug)}}" title="<?php if(!empty($keyword->child_category)){  echo $keyword->child_category; } ?>"><?php if(!empty($keyword->child_category)){  echo $keyword->child_category; } ?></a> / <?php if(!empty($keyword->keyword)){  echo $keyword->keyword; }  ?> in <?php echo $city; ?>			 
			 @endif			 
			 </div>
			 </div>
            </div>
		</div>
		@if(isset($keyword) && null!=$keyword->top_description)
		<div class="col-xs-12 top_description" style="margin-top:20px;color:#033967">		    
		<p title="<?php if(!empty($keyword->keyword)) { echo $keyword->keyword; } ?> in {{Request::segment(1)}}"><?php  if(!empty($keyword->top_description)){
		$keydescription = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$keyword->top_description);
		echo trim($keydescription); } ?></p> 
		</div>
		@endif
    </div>
    <div class="clearfix"></div>
    <script>
        $(document).ready(function() {
            $('.proceedBtn').click(function() {
                $('.proceedBtn').hide();
                $('.stopprocess').show();
                $('.formDiv').slideDown();
            });

            $('.stopprocess').click(function() {
                $('.stopprocess').removeAttr("style");
                $('.proceedBtn').show();
                $('.formDiv').slideUp();
            });

            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
	
    <div class="container">

        <div class="col-sm-9 col-md-9 reviews-box-main mainContainer">
            <a href="#top"></a>
			@if(!empty($clientsList))
				<?php $n=0;?>
				@foreach($clientsList as $client)
				
				<div class="col-sm-12 col-md-12 reviews-box-1 line-content">
				    <div class="client-list-first">
					<div class="col-sm-4 col-md-4 serchlist-img "><a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name }}">
						<?php if(null != $client->logo){
							$profilePic = unserialize($client->logo);
							?><img src="<?php echo asset(''.$profilePic['large']['src']); ?>" alt="{{$client->business_name}}" title="{{$client->business_name}}" height="141" /><?php
						}else{
							?><img src="<?php echo asset('client/images/default_pp_small.jpg'); ?>" alt="Business Logo" title="Business Logo" height="141" style="width:100%" /><?php
						}
						?>
						@if($client->client_type != 'FreeListing')
						<p><a href="#"><i class="fa fa-fw fa fa-thumbs-up serchlist-location-icon" aria-hidden="true"></i></a></p>
						@endif
						</a>
					</div>
					<div class="col-sm-6 col-md-6 aboutcomp">
				 
				 
						<a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name }}">
							<span class="serchlist-txt-1">
								<i class="fa fa-fw fa-university serchlist-icon" aria-hidden="true"></i>						 							
								<?php echo ucfirst(strtolower(substr($client->business_name,0,28)));?>  
							</span>
							<?php
								$badge = $client->sold_on_position;
							?>
						 
							 
						</a>
				 
						<div class="certified" <?php if($client->certified_status==1){ ?> style="background-image: url(../client/images/certified-icon.png);" <?php } ?>>
						 
						<?php
							$arr=[];
							if(!empty($client->address)){
								$arr['address'] = $client->address;
							}
							if(!empty($client->landmark)){
								$arr['landmark'] = $client->landmark;
							}
							if(!empty($client->city)){
								$arr['city'] = $client->city;
							}
							if(!empty($client->state)){
								$arr['state'] = $client->state;
							}
							if(!empty($client->country)){
								$arr['country'] = $client->country;
							}
							$addr = getAddress($arr,30);
							if($addr->ispositiveresponse){
							?>
								<div class="serchlist-txt">
									<i class="fa fa-fw fa fa-street-view icon" aria-hidden="true"></i>
									<?php if($addr->issubstr): ?>
										<a href="{{ url('business-details')."/".$client->business_slug }}">{{ ucfirst(strtolower($addr->substr)) }}</a>
										<a href="#" data-toggle="tooltip" data-placement="bottom" title="{{ $addr->fullstr }}">more</a>
									<?php else: ?>
										<a href="{{ url('business-details')."/".$client->business_slug }}">{{ ucfirst(strtolower($addr->substr)) }}</a>
									<?php endif; ?>
								</div>
							<?php						
							}
						?>
						 
						 
						<div class="serchlist-txt"><i class="fa fa-fw fa-clock-o serchlist-icon" aria-hidden="true"></i>
							<a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name }}"><span class="serchlist-txt">
							<?php
							if(!empty($client->time)){
								$times = unserialize($client->time);
								$today =  strtolower(date('l'));
								echo "Opening Hrs (".$times[$today]['from']." - ".$times[$today]['to'].")";
							}else{
								echo "No working hours available";
							}
							?>
							</span></a>
						</div>
							<div class="serchlist-txt" >
							<i class="fa fa-fw fa fa-cog serchlist-icon" aria-hidden="true"></i>
							<span class="serchlist-txt">
								<div class="col-md-12 service-text" >
								<ul>
								<?php
								
						$assignedKwds = DB::table('assigned_kwds')
							  ->join('keyword','keyword.id','=','assigned_kwds.kw_id')
							  ->join('child_category','child_category.id','=','assigned_kwds.child_cat_id')
							  ->select('keyword.keyword','child_category.child_category as child_category_name')
							  ->where('assigned_kwds.client_id','=',$client->id)
							  ->limit(2)
							  ->get();
								$firstHalf = [];
								$secondHalf = [];
								$i = 1;
								$inPopupArr = [];
								foreach($assignedKwds as $assignedKwd){										 
								?>
								
								<li>
								<a href="<?php echo generate_slug($assignedKwd->keyword) ?>" title="{{$assignedKwd->keyword}}" class="keystore"><?php echo $assignedKwd->keyword; ?></a>
								</li>
											 <?php  }  ?>
							</ul>
									</div>
							
									 
							 </span>
						</div>
						</div>
					 
						<div class="serchlist-txt-btn"><a href="javascript:void(0);" title="{{$client->business_name }}" class="sms-view open-popup"><span>Enquiry Now</span></a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" title="{{$client->business_name }}" class="whatsapp-view open-popup"><span><i class="fa fa-whatsapp"></i> WhatsApp</span></a> &nbsp;&nbsp;&nbsp;<a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name }}" class="sms-view"><span>Vew Details</span></a></div>
					
					 
					</div>
					</div>
                    <div class="client-list-second" >
					<div class="col-sm-2 col-md-2 btnBox">
						<a href="{{ url('business-details')."/".$client->business_slug }}"><span class="serchlist-txt-1">User Rating</span></a>
						<div class="serchlist-txt">
							<?php
								if($client->comment_count>0){
									$avgRating = ($client->rating/(5*$client->comment_count))*5;
									$avgRating = number_format($avgRating, 1, '.', '');
									$whole = floor($avgRating);
									$fraction = $avgRating - $whole;
									$remain = 5-$whole;
									for($i=0;$i<$whole;++$i){
									 
										echo "<a href='".url('business-details')."/".$client->business_slug."' class='emptystar fullstar'></a>";
									}
									if($fraction>0&&$fraction<1){
								 
										echo "<a href='".url('business-details')."/".$client->business_slug."' class='emptystar halfstar'></a>";
										--$remain;
									}
									for($i=0;$i<$remain;++$i){
									 
										echo "<a href='".url('business-details')."/".$client->business_slug."' class='emptystar'></a>";
									}
								}else{
									$avgRating = 0.0;
									for($i=0;$i<5;++$i){
									 
										echo "<a href='".url('business-details')."/".$client->business_slug."' class='emptystar'></a>";
									}									
								}
							?>
					 
							<a href="{{ url('business-details')."/".$client->business_slug }}"><span class="serchlist-rating">({{$avgRating or "0"}} Rating out of {{$client->comment_count or "0"}} Votes)</span></a>
						</div>
					<button class="serchlist-btn" title="Best Offer {{$client->business_name }}">Enquiry Now</button>
					</div>

					<div class="col-sm-12 col-md-12" style="padding-left:0;">
						<div class="clickBlick"><a href="{{ url('business-details').'/'.$client->business_slug.'/#rewandrate' }}" title="{{$client->business_name }}"><i class="fa fa-fw fa fa-sun-o" aria-hidden="true"></i></a><a href="{{ url('business-details').'/'.$client->business_slug.'' }}" title="{{$client->business_name }}"><span>Click here to view your friend rating</span></a></div>
					</div>
					
					</div>
				</div>
				@endforeach
			@endif
				 
			
			 <ul id="pagin" ></ul>
<style>


 


.current .btn-info{
color: green;
}

#pagin li {
display: inline-block;
padding: 6px;
margin: 5px;
background-color: #C94A30; 
}

#pagin li a{
color: #fff;
}
</style>
 <script>
 
//Pagination
	pageSize = 10;
	var pageCount =  $(".line-content").length / pageSize;
    
     for(var i = 0 ; i<pageCount;i++){
        
       $("#pagin").append('<li><a href="#top">'+(i+1)+'</a></li> ');
     }
        $("#pagin li").first().find("a").addClass("current")
    showPage = function(page) {
	    $(".line-content").hide();
	    $(".line-content").each(function(n) {
	        if (n >= pageSize * (page - 1) && n < pageSize * page)
	            $(this).show();
	    });        
	}
    
	showPage(1);

	$("#pagin li a").click(function() {
	    $("#pagin li a").removeClass("current btn btn-info");
	    $(this).addClass("current btn btn-info");
	    showPage(parseInt($(this).text())) 
	});
	</script>
			
			
 
			@if(!empty($onlyClients))
				@foreach($onlyClients as $client)
				<div class="col-sm-12 col-md-12 reviews-box-1">
					<div class="col-sm-4 col-md-4 serchlist-img "><a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name }}">
						<?php if(!empty($client->logo)){
							$profilePic = unserialize($client->logo);
							?><img src="<?php echo asset($profilePic['large']['src']); ?>" alt="Logo" height="141" /><?php
						}else{
							?><img src="<?php echo asset('client/images/default_pp_small.jpg'); ?>" alt="Logo" height="141" style="width:100%" /><?php
						}
						?>
						@if($client->client_type != 'FreeListing')
						<p><a href="javascript:void(0)"><i class="fa fa-fw fa fa-thumbs-up serchlist-location-icon" aria-hidden="true"></i></a></p>
						@endif
						</a>
					</div>
					 <div class="col-sm-5 col-md-5 aboutcomp">
			 
						 
						<a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name }}">
							<span class="serchlist-txt-1">
								<i class="fa fa-fw fa-university serchlist-icon" aria-hidden="true"></i>						 							
								<?php echo ucfirst(substr($client->business_name,0,28));?>
							</span>
						 
							<img src="<?php echo asset('client/images/preferred.png'); ?>" alt="preferred">
							 
						</a>
				 
						<div class="certified" <?php if($client->certified_status==1){ ?> style="background-image: url(../client/images/certified-icon.png);" <?php } ?>>
						 
						<?php
							$arr=[];
							if(!empty($client->address)){
								$arr['address'] = $client->address;
							}
							if(!empty($client->landmark)){
								$arr['landmark'] = $client->landmark;
							}
							if(!empty($client->city)){
								$arr['city'] = $client->city;
							}
							if(!empty($client->state)){
								$arr['state'] = $client->state;
							}
							if(!empty($client->country)){
								$arr['country'] = $client->country;
							}
							$addr = getAddress($arr,30);
							if($addr->ispositiveresponse){
							?>
								<div class="serchlist-txt">
									<i class="fa fa-fw fa fa-street-view icon" aria-hidden="true"></i>
									<?php if($addr->issubstr): ?>
										<a href="{{ url('business-details')."/".$client->business_slug }}">{{ $addr->substr }}</a>
										<a href="#" data-toggle="tooltip" data-placement="bottom" title="{{ $addr->fullstr }}">more</a>
									<?php else: ?>
										<a href="{{ url('business-details')."/".$client->business_slug }}">{{ $addr->substr }}</a>
									<?php endif; ?>
								</div>
							<?php
							}
						?>
						 
						 
						<div class="serchlist-txt"><i class="fa fa-fw fa-clock-o serchlist-icon" aria-hidden="true"></i>
							<a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name }}"><span class="serchlist-txt">
							<?php
							if(!empty($client->time)){
								$times = unserialize($client->time);
								$today =  strtolower(date('l'));
								echo "Opening Hrs (Today ".$times[$today]['from']." - ".$times[$today]['to'].")";
							}else{
								echo "No working hours available";
							}
							?>
							</span></a>
						</div>
							<div class="serchlist-txt" >
							<i class="fa fa-fw fa fa-cog serchlist-icon" aria-hidden="true"></i>
							<span class="serchlist-txt">
								<div class="col-md-12 service-text" >
								<ul>
								<?php
								
							$assignedKwds = DB::table('assigned_kwds')
							  ->join('keyword','keyword.id','=','assigned_kwds.kw_id')
							  ->join('child_category','child_category.id','=','assigned_kwds.child_cat_id')
							  ->select('keyword.keyword','child_category.child_category as child_category_name')
							  ->where('assigned_kwds.client_id','=',$client->id)
							  ->limit(2)
							  ->get();

 

					  
									$firstHalf = [];
									$secondHalf = [];
									$i = 1;
									$inPopupArr = [];
									foreach($assignedKwds as $assignedKwd){										 
												 ?>
								
										 <li>
											<a href="{{url(Request::segment(1))}}/<?php echo generate_slug($assignedKwd->keyword) ?>" title="{{$assignedKwd->keyword}}"><?php echo $assignedKwd->keyword; ?></a>
										</li>
												 
												 
												 <?php  }  ?>
							</ul>
									</div>
							
									 
							 </span>
						</div>
						</div>
					 
						<div class="serchlist-txt-btn"><a href="javascript:void(0);" title="{{$client->business_name }}" class="sms-view open-popup"><span>Enquiry Now</span></a>&nbsp;&nbsp;&nbsp;<a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name }}" class="sms-view"><span>View Details</span></a></div>
					
					 
					</div>

					<div class="col-sm-2 col-md-2 btnBox">
						<a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name }}"><span class="serchlist-txt-1">User Rating</span></a>
						<div class="serchlist-txt">
							<?php
								if($client->comment_count>0){
									$avgRating = ($client->rating/(5*$client->comment_count))*5;
									$avgRating = number_format($avgRating, 1, '.', '');
									$whole = floor($avgRating);
									$fraction = $avgRating - $whole;
									$remain = 5-$whole;
									for($i=0;$i<$whole;++$i){
									 
										echo "<a href='".url('business-details')."/".$client->business_slug."' class='emptystar fullstar'></a>";
									}
									if($fraction>0&&$fraction<1){
								
										echo "<a href='".url('business-details')."/".$client->business_slug."' class='emptystar halfstar'></a>";
										--$remain;
									}
									for($i=0;$i<$remain;++$i){
							
										echo "<a href='".url('business-details')."/".$client->business_slug."' class='emptystar'></a>";
									}
								}else{
									$avgRating = 0.0;
									for($i=0;$i<5;++$i){
								
										echo "<a href='".url('business-details')."/".$client->business_slug."' class='emptystar'></a>";
									}									
								}
							?>
							
							<a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name }}"><span class="serchlist-rating">({{$avgRating or "0"}} Rating out of {{$client->comment_count or "0"}} Votes)</span></a>
						</div>
						<button class="serchlist-btn">Best Offer</button>
					</div>

					<div class="col-sm-12 col-md-12" style="padding-left:0;">
						<div class="clickBlick"><a href="{{ url('business-details').'/'.$client->business_slug }}"><i class="fa fa-fw fa fa-sun-o" aria-hidden="true"></i></a><a href="{{ url('business-details').'/'.$client->business_slug }}" title="{{$client->business_name }}"><span>Click here to view your friend rating</span></a></div>
					</div>
				</div>
				@endforeach
			@endif
        </div>
        <style>
        .rightsidedata{
      
        }
        </style>
        <div class="col-sm-3 col-md-3 side-data reviews-box-1 scroll-on rightsidedata">
     
 <style>
 .form-side strong{ color:#0076d7; }
 .form-side{   
    border: 1px solid #ddd;
    border-radius: 5px; 
     
 }
 .side-row-form {
    margin-top: 10px;
    
    text-align: center;
    display: grid
;
}
 </style>
 <div class="side-row-form ">
      <div class="form-side">
                    <h4>Quick Enquiry</h4>
                   
                    <form class="formaling lead_form" onsubmit="return homeController.saveTwoEnquiry(this)" method="POST">
                        {{ csrf_field() }} 
                         <div class="fieldblock">
                           
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <input type="text" placeholder="Your Name" class=" form-control city-form" id="name" name="name">
                                 
                        <input type="hidden" name="lead_form" value="1" />
						<input type="hidden" name="kw_text" id="kw_text" value="<?php echo $searchedKW; ?>" />
						<input type="hidden" name="city_id" id="city_id" class="city" value="{{Request::segment(1)}}" />
						<input type="hidden" name="from_page" id="from_page" value="{{ request()->path() }}">
						
                            </div>
                        </div>
                         
                        <div class="fieldblock">
                             
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <input type="tel" placeholder="Your Mobile Number" class="form-control city-form" id="mobile" name="mobile">
                            </div>
                        </div>
                        
                         
                        <div class="fieldblock">
 
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                
								<input type="submit" class="btn btn-primary submit-btn-2" value="Send Enquiry" />
								<input type="reset" class="reset_lead_form hide" value="reset" />
                                
                        </div>
                    </form>
                </div>
     
     </div>
 
        <?php
		
		$rowCount =0; ?>
			@if(!empty($subcategory))
				@foreach($subcategory as $child)
				<?php $rowCount++; 
				
				if($rowCount <= count($clientsList)+ 1 ){ ?>
				
					<div class="side-row-1">
						<div class="side-data-txt-1">
						<a href="{{url('child/'.$child->child_slug)}}" title="<?php if(!empty($child->child_category)){  echo $child->child_category; } ?>" ><?php if(!empty($child->child_category)){  echo $child->child_category; } ?></a>
						</div>
						<div class="side-txt">
						<span class="expert-count"><?php 	$assignKeyword = DB::table('keyword')->where('child_category_id', $child->id)->count(); 
						if($assignKeyword){
						echo $assignKeyword;
						}else{

						echo "342";
						}

						?>+ </span>Experts Available	
						</div> 
							
							<div class="btn btn-primary side-data-btn">Expert Advice</div>	 				
					</div>
				<?php  } ?>
				@endforeach
			@endif
			
			
	  
	 
        </div>
    </div>
 
	  
		<div class="clearfix"></div>
		<br>
		@if(!empty($keyword->bottom_description))
		<div class="container"> 		 
		<div class="category-description">  
		<h2>Top <?php  if(!empty($keyword->keyword)){ $key = preg_replace('/{{city}}/i',ucwords(str_replace("-", "", $city)),$keyword->keyword); echo trim($key); } ?> in <?php echo ucwords(str_replace("-", " ", Request::segment(1))); ?></h2>
		
		<p title="<?php if(!empty($keyword->keyword)) { echo $keyword->keyword; } ?> in {{Request::segment(1)}}">
		
		<?php if(!empty($keyword->keyword)) { echo $keyword->keyword; } ?> in {{ucwords(str_replace("-", " ", Request::segment(1)))}}
		</p>
		<p>
		<?php  if(!empty($keyword->bottom_description)){
		$keydescription = preg_replace('/{{city}}/i',ucwords(str_replace("-", " ", Request::segment(1))),$keyword->bottom_description);
		echo trim($keydescription); } ?></p>	 
		</div>
		
		 
		</div>
		@endif
		
		
 
	 @if(!empty($keyword))
	  <?php   $kwdsList = App\Models\Keyword::where('child_category_id',$keyword->child_category_id)
			   ->where('parent_category_id',$keyword->parent_category_id)
			   ->select('keyword','icon')
			   ->distinct()
			   ->get(); 			  
			   
			   ?>
	  @if(!empty($kwdsList))
		  
      <div class="container">
	    
	  <div class="category-box">
	   <div class="course-program">
	    
	   <h5>Find Services Related to <?php if(!empty($keyword->keyword)) { echo $keyword->keyword; } ?> </h5>
	   	<ul class="row">	
			
	 
		@if(!empty($kwdsList))
		<?php $i = 0; $x = 5; ?>
			@foreach($kwdsList as $keyicon)
			 
	   <li class="col-sm-3 col-md-3">
            <?php  if(!empty($keyicon->icon)){
            
            $data = json_decode($keyicon->icon, true);
            if (!empty($data)) {
            ?>
            
            <img src="{{asset(''.$data['src'])}}" alt="{{ $data['name'] }}" width="25">
            
            <?php  }   } ?>
	       
	       <a href="{{url(strtolower(Request::segment(1)))}}/<?php echo generate_slug($keyicon->keyword) ?>" title="<?php if(!empty($keyicon->keyword)) { echo $keyicon->keyword; } ?> in {{Request::segment(1)}}" >{{$keyicon->keyword}}</a></li>
	   
	   @endforeach
	   @endif
	   </ul>
	   </div>
	 </div>
	 
	  
	 </div>
      @endif
	  @endif


		
		@if(!empty($keyword->faqq1))
		<div class="container"> 		 
		<div class="category-description">  
		<h4>FAQ:- <?php  if(!empty($keyword->keyword)){ $key = preg_replace('/{{city}}/i',ucfirst($city),$keyword->keyword); echo trim($key); } ?> in <?php echo ucfirst(Request::segment(1)); ?></h4> 
			<div itemscope itemtype="https://schema.org/FAQPage">
			<?php if(!empty($keyword->faqq1)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($keyword->faqq1)){
			$faqq1 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$keyword->faqq1);
			echo trim($faqq1); } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" style="display: block;">
			<div itemprop="text">
			<?php  if(!empty($keyword->faqa1)){
			$faqa1 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$keyword->faqa1);
			echo trim($faqa1); } ?>
			 

			</div>
			</div>
			</div>
			<?php } ?>


			<?php if(!empty($keyword->faqq2)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($keyword->faqq2)){
			$faqq2 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$keyword->faqq2);
			echo trim($faqq2); } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
			<?php  if(!empty($keyword->faqa2)){
			$faqa2 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$keyword->faqa2);
			echo trim($faqa2); } ?>
		 
			</div>
			</div>
			</div>
			<?php } ?>		
			<?php if(!empty($keyword->faqq3)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($keyword->faqq3)){
			$faqq3 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$keyword->faqq3);
			echo trim($faqq3); } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
			<?php  if(!empty($keyword->faqa3)){
			$faqa3 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$keyword->faqa3);
			echo trim($faqa3); } ?>
			 
			</div>
			</div>
			</div>
			<?php } ?>		
			<?php if(!empty($keyword->faqq4)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($keyword->faqq4)){
			$faqq4 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$keyword->faqq4);
			echo trim($faqq4); } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
			<?php  if(!empty($keyword->faqa4)){
			$faqa4 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$keyword->faqa4);
			echo trim($faqa4); } ?>
			 
			</div>
			</div>
			</div>
			<?php } ?>		
			<?php if(!empty($keyword->faqq5)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($keyword->faqq5)){
			$faqq5 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$keyword->faqq5);
			echo trim($faqq5); } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
			<?php  if(!empty($keyword->faqa5)){
			$faqa5 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$keyword->faqa5);
			echo trim($faqa5); } ?>
		 
			</div>
			</div>
			</div>
			<?php } ?>


			</div>
		
		</div>
		
		 
		</div>
		@endif
	 
	 	
	 
      @if(!empty($keyword))
      <div class="container">
	  <div class="category-box">
	   <div class="course-program">
	   <h5>Find <?php if(!empty($keyword->keyword)) { echo $keyword->keyword; } ?> other Location</h5>
	   	<ul class="row">	
	   	<?php $cities = getCity(); ?>
		@if(!empty($cities))
			<?php $i = 0; $x = 5; ?>
			@foreach($cities as $citys)
				 
	   <li class="col-sm-3 col-md-3"><a href="{{url(strtolower($citys->city))}}/<?php if(!empty($keyword->keyword)) { echo generate_slug($keyword->keyword); } ?>" title="<?php if(!empty($keyword->keyword)) { echo $keyword->keyword; } ?> in {{Request::segment(1)}}">@if(!empty($keyword->keyword)){!!$keyword->keyword!!}@endif in {{$citys->city}}</a></li>	   
	   @endforeach
	   @endif
	   
	   </ul>
	   </div>
	 </div>
	 </div>
      @endif 
	  
	  
	  
	   <div class="clearfix"></div>
	 <br>
	
	  
      <?php }else{ ?>
	  
	     
			<div class="container">
			 
			<div class="row">
			<div class="col-sm-12 col-md-12 banner-details">
			<h4 class="Oops-txt">Oops! No Result Found </h4>
			<h2 class="error-txt"></h2>
			</div>
			</div>
			 
			</div>
 <div class="clearfix"></div>
    <div class="container">
	 
	  <div class="add-section">
	   <div class="col-xs-12"> 				
			
		<?php if(!empty($clientLists)): ?>
			<?php foreach($clientLists as $client):
				$image = '';
				if($client->logo!=''):
					$image = unserialize($client->logo);
					$image = $image['large']['src'];
				
			?>
			
				<div class="col-md-3">
				<div class="inner-client-div">
			 
				<figure><img class="" src="<?php echo asset($image); ?>" alt="{{ $client->business_name }}" style="width:100%;"></figure>
				<div class="grid-info">
					<h3><a href="{{url('business-details').'/'.generate_slug($client->business_slug)}}" title="{{$client->business_name}}" tabindex="0"><div title="{{$client->business_name}}"><strong>{{$client->business_name}}</strong></div></a></h3>
				
					<strong>{{ucfirst($client->city)}}</strong>
					<a href="{{url('business-details').'/'.generate_slug($client->business_slug)}}" class="get-quotes" tabindex="0">View</a>
				</div>
				</div></div>
				
				
			<?php 
			endif;
			endforeach; 
			
			endif
			?>
                </div>
                </div>
                </div>
	  
	  <?php  } ?>
	  
<div class="inquiry-popup"></div>

    <div class="bestDealpopup"> 
		<?php 	

$value = Cookie::get('showPopup');	 
	//	if(Auth::guard('clients')->check() || ($value =="yes"))
			?>
        <a href="javascript:void(0);" class="dealclosebtn">&nbsp;</a> 

	   <h4>Need Expert Advice ?</h4>
        <div class="jbt"> Fill this form to Grab the best Deals on "<span class="orng"><?php echo $searchedKW." in "; ?>{{Request::segment(1)}}</span>"</div>
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
                        <input class="jinp" type="text" placeholder="Enter Mobile" name="mobile"  >
                    </p>
                    <p>
                        <label for="yei">Your Email ID <span></span></label>
                        <input class="jinp" type="text" placeholder="Enter Email" name="email"  >
                    </p>
                    <p>
                        <label class="moblab">&nbsp;</label>
						<!--<input class="jbtn" type="submit" value="Submit" />-->
						<input class="jbtn" type="submit" name="submit" value="Submit" />
						<input type="reset" class="reset_lead_form hide" value="reset" />
                        <!--button type="button" class="jbtn">Submit</button-->
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
    
    
    <script>
        function sendData() {
            const name = document.getElementById('name').value;
         //   const email = document.getElementById('email').value;
            const mobile = document.getElementById('mobile').value;
            const kw_text = document.getElementById('kw_text').value;
            const city_id = document.getElementById('city_id').value;
            const from_page = document.getElementById('from_page').value;
 
            if ((name && mobile) && (mobile.length ===10)) {
                fetch('lead/auto-form-save', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name: name, mobile: mobile,kw_text:kw_text,city_id:city_id,from_page:from_page })
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

      //  document.getElementById('name').addEventListener('input', sendData);
       // document.getElementById('email').addEventListener('input', sendData);
        document.getElementById('mobile').addEventListener('input', sendData);
     //   document.getElementById('kw_text').addEventListener('input', sendData);
     //   document.getElementById('city_id').addEventListener('input', sendData);
    </script>
@endsection