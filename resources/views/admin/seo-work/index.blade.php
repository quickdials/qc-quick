<?php echo View::make('admin/header'); ?>
<style>
	.assign-elements {
		list-style-type: none;
	}

	.assign-elements ul li {
		padding: 5px;

	}

	.dropdown-menu-right li {
		list-style-type: circle;
	}
</style>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-9 col-md-6 col-sm-12"><a href="{{ url('developer/seo-work') }}">
					<h3>{{$data['title']}}</h3>
				</a></div>

			<div class="col-lg-3 col-md-6 col-sm-12">
				<div class="d-flex flex-row-reverse">
					<div class="page_action">
						<button type="button" class="btn btn-primary"
							style="color:#fff;margin-top:10px;margin-bottom: 20px;"><a
								href="{{url('developer/seo-work/add')}}" style="color:#fff"> <i class="fa fa-plus"
									aria-hidden="true"></i> Add SEO Work</a></button>


					</div>
					<div class="p-2 d-flex">

					</div>
				</div>
			</div>
		</div>

		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-info">
				<div class="panel-body">
					@if(Request::segment(3) == 'add' || Request::segment(3) == 'edit')
						<div class="nc-form row form-group{{ $errors->has('city') ? ' has-error' : '' }}">
							@if(Request::segment(3) == 'add')
								<form class="seo_work" method="post" onsubmit="return seoWorkController.saveSeoWork(this)"
									autocomplete="off" enctype="multipart/form-data">

							@elseif(Request::segment(3) == 'edit')

									<form class="seo_work" method="post" autocomplete="off" action=""
										onsubmit="return seoWorkController.editSaveSeoWork(this,<?php echo (isset($edit_data->id) ? $edit_data->id : ""); ?>)"
										enctype="multipart/form-data">

									@endif
									{{ csrf_field() }}
									<div class="col-lg-6">
									 
										<label for="State">Keyword<sup><i style="color:red" class="fa fa-asterisk fa-fw"
													aria-hidden="true"></i></sup>:</label>
										<select class="form-control select2-single" name="keyword">
											<option value="">Select keyword</option>
											@if(!empty($keywords))
												@foreach($keywords as $key => $val)
													<option value="{{$val}}" @if ($val == old('keyword')) selected="selected" @else {{ (isset($edit_data) && $edit_data->keyword == $val) ? "selected" : "" }} @endif>
														{{ $val}}</option>

												@endforeach
											@endif
										</select>
										@if ($errors->has('keyword'))
											<span class="help-block">
												<strong>{{ $errors->first('keyword') }}</strong>
											</span>
										@endif
									</div>


									<div class="col-lg-6">
										<label for="State">Website<sup><i style="color:red" class="fa fa-asterisk fa-fw"
													aria-hidden="true"></i></sup>:</label>

										<select class="form-control select2-single" name="website">
											<option value="">Select website</option>
											@if(!empty($classifiedProfiles))
												@foreach($classifiedProfiles as $profile)
													<option value="{{$profile->website}}" @if ($profile->website == old('website'))
													selected="selected" @else {{ (isset($edit_data) && $edit_data->website == $profile->website) ? "selected" : "" }} @endif>
														{{ $profile->website}}</option>

												@endforeach
											@endif
										</select>


										@if ($errors->has('website'))
											<span class="help-block">
												<strong>{{ $errors->first('website') }}</strong>
											</span>
										@endif
									</div>


									<div class="col-lg-6">
										<label for="State">Backlink<sup><i style="color:red" class="fa fa-asterisk fa-fw"
													aria-hidden="true"></i></sup>:</label>

										<input type="text" class="form-control" name="backlink"
											placeholder="Enter back link"
											value="{{ old('backlink', (isset($edit_data)) ? $edit_data->backlink : "")}}">
										@if ($errors->has('backlink'))
											<span class="help-block">
												<strong>{{ $errors->first('backlink') }}</strong>
											</span>
										@endif
									</div>

									<div class="col-lg-6">
										<label for="State">Index Status<sup><i style="color:red"
													class="fa fa-asterisk fa-fw" aria-hidden="true"></i></sup>: </label>
										<select class="form-control" name="index_status">
											<option value="">Select Index Status</option>
											<option value="complete" @if ("complete" == old('index_status'))
											selected="selected" @else {{ (isset($edit_data) && $edit_data->index_status == 'complete') ? "selected" : "" }} @endif>Complete
											</option>
											<option value="pending" @if ("pending" == old('index_status')) selected="selected"
											@else {{ (isset($edit_data) && $edit_data->index_status == "pending") ? "selected" : "" }} @endif>Pending</option>
										</select>


										@if ($errors->has('index_status'))
											<span class="help-block">
												<strong>{{ $errors->first('index_status') }}</strong>
											</span>
										@endif
									</div>

									<div class="col-lg-6">
										<label for="State">index value:</label>
										<input type="text" class="form-control" name="index_value"
											placeholder="Enter index value"
											value="{{ old('index_value', (isset($edit_data)) ? $edit_data->index_value : "")}}">
										@if ($errors->has('index_value'))
											<span class="help-block">
												<strong>{{ $errors->first('index_value') }}</strong>
											</span>
										@endif
									</div>

									<div class="col-lg-6">
										<label for="State">City<sup><i style="color:red" class="fa fa-asterisk fa-fw"
													aria-hidden="true"></i></sup>: </label>

										<select class="form-control select2-single" name="city">
											<option value="">Select city</option>
											@if(!empty($citieslists))
												@foreach($citieslists as $cities)
													<option value="{{$cities->city}}" @if ($cities->city == old('city'))
													selected="selected" @else {{ (isset($edit_data) && $edit_data->city == $cities->city) ? "selected" : "" }} @endif>
														{{ $cities->city}}</option>

												@endforeach
											@endif
										</select>
										@if ($errors->has('city'))
											<span class="help-block">
												<strong>{{ $errors->first('city') }}</strong>
											</span>
										@endif
									</div>

									<div class="col-lg-3">
										<input type="submit" class="btn btn-info btn-block" class="form-control"
											style="margin-top:25px;">
									</div>


								</form>
						</div>
					@else
						<div class="table-responsive table-virtical-grid">
							<table width="100%" class="table table-striped table-bordered table-hover"
								id="datatable-seo-work">
								<thead>
									<tr>
										<th><input type="checkbox" id="check-all" class="check-box"></th>
										<th>Keyword</th>
										<th>Backlink</th>
										<th>Email</th>
										<th>Password</th>
										<th>City</th>
										<th>Date</th>
										<th>Owner </th>
										<th>Action</th>

									</tr>
								</thead>

							</table>
						</div>
					@endif
				</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->


</div>


<!-- /#page-wrapper -->

<?php echo View::make('admin/footer'); ?>