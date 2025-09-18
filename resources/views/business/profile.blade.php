@extends('business.layouts.app')
@section('title')
Profile Quick Dials
@endsection 
@section('keyword')
Find Best It Training Centre near You, Find Best It Training Institute near You, Find Top 10 IT Training Institute near You, Find Best Entrance Exam Preparation Centre Near you, Top 10 Entrance Exam Centre Near you, Find Best Distance Education Centre Near You, Find Top 10 Distance Education Centre Near You, Find Best School And Colleges Near You, Find Top 10 school And College Near You, Get Education Loan, GET Free career Counselling, Find Best overseas education consultants Near you, Find Top 10 overseas education consultants Near you

@endsection
@section('description')
Find Only Certified Training Institutes, Coaching Centers near you on Quick Dials and Get Free counseling, Free Demo Classes, and Get Placement Assistence.
@endsection
@section('content')	

  <main id="main" class="main">
    <section class="section profile">
      <div class="row">
        
        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

 
 
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Business Information</button>
                </li>

                <li class="nav-item profile_success">
                    </li>
 

              </ul>
              <div class="tab-content pt-2">

             <style>
 .form-control {
            flex: 1;
            padding: 12px;
            background: #f5f5f5;
            border: 2px solid #ddd;
            border-radius: 4px;
            color: #000;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #a5a2c9;
            background: #fff;
        }
         .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 15px;
        }

        .form-group label {
            color: #000;
            font-size: 1em;
            flex: 0 0 150px;
            letter-spacing: 1px;
        }

              @media (max-width: 768px) {
           
            .form-group {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-group label {
                flex: none;
            }

            .form-control {
                width: 100%;
                border-radius: 4px;
            }

            .verify-btn, .image-upload button, .save-btn {
                border-radius: 4px;
            }
        }
    .help-block{  
    color: #ff0000;
    position: relative;

    margin-top: 61px;
    display: block;
    margin-left: -207px;
    }
        
              </style>
             

                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">



                <form class="profile_info" method="POST" onsubmit="return businessController.editProfileInfo(this,<?php echo (isset($client->id)? $client->id:""); ?>)">
                <input type="hidden" name="business_id" value="{{ old('middle_name',(isset($client)) ? $client->id:"")}}">
                      
                 
 
                 
                <div class="form-group">
                    <label>Business Name:</label>
                  
                      <input type="hidden" name="business_id" value="{{ old('middle_name',(isset($client)) ? $client->id:"")}}">
                       <input name="business_name" type="text" class="form-control" value="{{ old('business_name',(isset($client)) ? $client->business_name:"")}}">
                    <label>*Email:</label>
                      <input name="email" type="email" class="form-control" id="Email" value="{{ old('email',(isset($client)) ? $client->email:"")}}" placeholder="Please enter Email" readonly>
                </div>
                <div class="form-group">
                    <label>Address:</label>
                     <textarea name="address" class="form-control" style="height: 100px"> {{ old('address',(isset($client)) ? $client->address:"")}}</textarea>
                    <label>Landmark:</label>
                    <input name="landmark" type="text" class="form-control"   value="{{ old('landmark',(isset($client)) ? $client->landmark:"")}}">
                </div>
                <div class="form-group">
                  <label>State:</label>                     
						      <select class="select2-single-state form-control state" name="state" onchange="get_city(this.value);">
						      @if($states)
                      @foreach($states as $state)
                

                  <option value="{{$state->id}}"  @if ($state->id== old('state'))
                        selected="selected"	
                      @else
                      {{ (isset($client) && $client->state == $state->id ) ? "selected":"" }} @endif>{{$state->name}}</option>
                        @endforeach
                        @endif
						    </select>
                    <label>City:</label>
                    <select class="form-control dropdown-arrow dropdown-arrow-inverse city-form show_cityList" name="business_city">
						<option value="">Select City</option>
						@if(!empty($client->business_city))
						<option value="{{$client->business_city}}" selected>{{$client->city}}</option>
						@endif
						
						</select>
            
                    
                </div>

              <div class="form-group">
                    <label>Area:</label>
                    <input type="text" class="form-control" name="area" value="{{ old('area',(isset($client->area)) ? $client->area:"")}}" placeholder="Enter Area">
                    <label>Pincode:</label>
                    <input type="text" class="form-control" value="{{ old('pincode',(isset($client->pincode)) ? $client->pincode:"")}}" placeholder="Enter Pincode">
                </div>
                <div class="form-group">
                    <label>Country:</label>
                  
                  <select class="form-control" name="country"> 
                  <option value="101" @if ('101'== old('country'))
                  selected="selected"	
                  @else
                  {{ (isset($client) && $client->country == '101' ) ? "selected":"" }} @endif>India</option>
                  </select>

                    <label>year of Establishment:</label>              
                    
                    <select class="form-control" id="year_of_estb" name="year_of_estb">

                    <option value="">Select Year</option>
                    <?php for($i= 1970; $i<=2050; $i++){ ?>
                    <option value="<?php echo $i; ?>"  @if ($i == old('year_of_estb'))
                    selected="selected"	
                    @else
                    {{ (isset($client) && $client->year_of_estb == $i ) ? "selected":"" }} @endif><?php echo $i; ?></option>
                    <?php  } ?>
                    </select>
                    
                </div>
                <div class="form-group">
               
                    <label>Business Info:</label>
                   
                     <textarea name="business_intro" class="form-control" id="about" style="height: 100px">{{ old('business_intro',(isset($client->business_intro)) ? $client->business_intro:"")}}</textarea>
                    
                </div>

                <div class="form-group">              
                    <label>Certifications(Comma separated if more than 1):</label>
                        <input name="certifications" type="text" class="form-control" value="{{ old('certifications',(isset($client->certifications)) ? $client->certifications:"")}}">
                </div>
            

                <?php $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
								$times = ["24:00"=>"Open 24 Hrs","00:00"=>"00:00","00:30"=>"00:30","01:00"=>"01:00","01:30"=>"01:30","02:00"=>"02:00","02:30"=>"02:30","03:00"=>"03:00","03:30"=>"03:30","04:00"=>"04:00","04:30"=>"04:30","05:00"=>"05:00","05:30"=>"05:30","06:00"=>"06:00","06:30"=>"06:30","07:00"=>"07:00","07:30"=>"07:30","08:00"=>"08:00","08:30"=>"08:30","09:00"=>"09:00","09:30"=>"09:30","10:00"=>"10:00","10:30"=>"10:30","11:00"=>"11:00","11:30"=>"11:30","12:00"=>"12:00","12:30"=>"12:30","13:00"=>"13:00","13:30"=>"13:30","14:00"=>"14:00","14:30"=>"14:30","15:00"=>"15:00","15:30"=>"15:30","16:00"=>"16:00","16:30"=>"16:30","17:00"=>"17:00","17:30"=>"17:30","18:00"=>"18:00","18:30"=>"18:30","19:00"=>"19:00","19:30"=>"19:30","20:00"=>"20:00","20:30"=>"20:30","21:00"=>"21:00","21:30"=>"21:30","22:00"=>"22:00","22:30"=>"22:30","23:00"=>"23:00","23:30"=>"23:30",""=>"Closed"];
						 if(!empty($client->time)){
								$time = unserialize($client->time);
								foreach($days as $day): ?>
									<div class="form-group">
										<div class="col-md-12" style="display: flex;">
											<div class="col-md-3">
												<div class="row">
													<label class="time[<?php echo $day; ?>][from]"><?php echo ucfirst($day); ?> :</label>
												</div>
											</div>
											<div class="col-md-3">
												<div class="row">
													<select class="form-control input-sm inline-space time-from" data-time="<?php echo $time[$day]['from']; ?>" id="time[<?php echo $day; ?>][from]" name="time[<?php echo $day; ?>][from]">
														<?php $dataValue = 1440;
														$matchStatus = 1;
														if(null!=$time){
															foreach($times as $key=>$value){
																if($time[$day]['from'] == $key){
																	if($key=='10:00')
																		$matchStatus = 1;
																	else
																		$matchStatus = 0;
																}
															}
														}
														foreach($times as $key=>$value):
														$selected = '';
														if($time[$day]['from'] == $key){
															$selected = 'selected';
														}
														if($dataValue == 1440){
															echo "<option data-time_in_min = \"".$dataValue."\" value=\"".$key."\" ".$selected."> ".$value." </option>";
															$dataValue = 0;
														}else{
															if(empty($key)){
																echo "<option data-time_in_min = \"\" value=\"\"> ".$value." </option>";
															}else{
																if($matchStatus==1 && $dataValue==600){
																	$selected = 'selected';
																}
																echo "<option data-time_in_min = \"".$dataValue."\" value=\"".$key."\" ".$selected."> ".$value." </option>";
																$dataValue += 30;
																if($dataValue == 1440) $dataValue = 0;
															}
														}
														endforeach;
														?>
													</select>
												</div>
											</div>
											<div class="col-md-1 text-center">
												<div class="row">
													<label for="time[<?php echo $day; ?>][to]">To</label>
												</div>
											</div>
											<div class="col-md-3">
												<div class="row">
													<select class="form-control input-sm inline-space time-to" data-time="<?php echo $time[$day]['to']; ?>" id="time[<?php echo $day; ?>][to]" name="time[<?php echo $day; ?>][to]">
														<?php $dataValue = 1440;
														$matchStatus = 1;
														if(null!=$time){
															foreach($times as $key=>$value){
																if($time[$day]['to'] == $key){
																	if($key=='19:00')
																		$matchStatus = 1;
																	else
																		$matchStatus = 0;
																}
															}
														}
														foreach($times as $key=>$value):
														$selected = '';
														if($time[$day]['to'] == $key){
															$selected = 'selected';
														}						
														if($dataValue == 1440){
															echo "<option data-time_in_min = \"".$dataValue."\" value=\"".$key."\" ".$selected."> ".$value." </option>";
															$dataValue = 0;
														}else{
															if(empty($key)){
																echo "<option data-time_in_min = \"\" value=\"\"> ".$value." </option>";
															}else{
																if($matchStatus==1 && $dataValue==1140){
																	$selected = 'selected';
																}
																echo "<option data-time_in_min = \"".$dataValue."\" value=\"".$key."\" ".$selected."> ".$value." </option>";
																$dataValue += 30;
																if($dataValue == 1440) $dataValue = 0;
															}
														}
														endforeach;
														?>
													</select>
												</div>
											</div>
										</div>
									</div>								
								<?php 
              
              
              endforeach; } ?>
              
                   <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Hours of Operation</label>
                      <div class="col-md-4 col-lg-4">
                         <label class="radio-inline"><input type="radio" name="display_hofo" value="0" <?php echo (empty($client->display_hofo) || $client->display_hofo == '0')?"checked":""; ?>>Display Hours of Operation</label>
                      </div>
                       <div class="col-md-4 col-lg-5">
                         <label class="radio-inline"><input type="radio" name="display_hofo" value="1" <?php echo (!empty($client->display_hofo) || $client->display_hofo == '1')?"checked":""; ?>>Do Not Display Hours of Operation</label>
                      </div>
                    </div>
                 
            <div class="text-center"> 
                 <input type="hidden" name="savePersonal" value="savePersonalForm">
                <button type="submit" class="btn btn-primary">Save & Continue</button>
        
              </div>
 

                  
                  </form><!-- End Profile Edit Form -->

                 
                </div>

                 
                
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

<script>	
	window.onload = function()
	{
		var state 	='<?php echo $client->state; ?>';
		var city 	= '<?php echo $client->business_city; ?>';	 
		get_city(state,city); 
	}	 

function get_city(state,city){
	var token = $('input[name=_token]').val();
	$.ajax({
	type: "post",	 
	url: "{{URl('business/cities/getajaxcities')}}",
	data: {sid:state,cid:city},
	headers: {'X-CSRF-TOKEN': token},		
	cache: false,
	success: function(data)
	{
		$(".show_cityList").html(data);
	}
	});
}
</script>
 @endsection