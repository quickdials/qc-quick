<?php echo View::make('admin/header'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Categories</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
					@if(Session::has('success_msg'))
						<div class="alert alert-success">
							{{Session::get('success_msg')}}
						</div>
					@endif
					@if(Session::has('danger'))
						<div class="alert alert-danger">
							{{Session::get('danger')}}
						</div>
					@endif					
                    <div class="panel panel-info">
                        <div class="panel-body">
							<div class="nc-form row form-group{{ $errors->has('parent_category') ? ' has-error' : '' }}">
								<form method="POST" action="/developer/editStoreCategory" enctype="multipart/form-data">
									{{ csrf_field() }}
										<div class="col-lg-4">
								<input type="hidden" name="id" value="{{$edit_data->id}}">
										<label for="parent_category">Category:</label>
										<input type="text" class="form-control" name="parent_category" id="parent_category" placeholder="Enter Parent Category" value="{{ old('parent_category',(isset($edit_data)) ? $edit_data->parent_category:"")}}">
										@if ($errors->has('parent_category'))
											<span class="help-block">
												<strong>{{ $errors->first('parent_category') }}</strong>
											</span>
										@endif
									</div>
									<div class="col-lg-4">
										<label for="pc_icon">Category Banner</label>
									 											@if(!empty($edit_data->category_banner))
										<?php 
									 
										$image = unserialize($edit_data->category_banner);
										$image = $image['category_banner']['src'];

										?>
										@if(isset($image)&&!empty($image))
										<img src="{{url(''.$image)}}" style="height:75px;width:75px;">
										<a href="{{url('developer/category/del_banner/'.$edit_data->id)}}" title="remove"><i class="fa fa-remove fa-trash" aria-hidden="true"></i></a>
										<input type="hidden" class="" name="category_banner" value="{{ $edit_data->category_banner }}" >
										
										@endif
										@else
											<input type="file" class="form-control" name="category_banner">
										@endif
										
										@if ($errors->has('category_banner'))
											<span class="help-block">
												<strong>{{ $errors->first('category_banner') }}</strong>
											</span>
										@endif
										
									
									</div>
										 
									<div class="col-lg-4">
										<label for="pc_icon">Icon</label>
									 	
									 		
									 @if(isset($edit_data->pc_icon) && $edit_data->pc_icon !='NULL')
									 
										<?php 
									 
										$image = unserialize($edit_data->pc_icon);
										$image = $image['pc_icon']['src'];

										?>
										@if(isset($image) && !empty($image))
										<img src="{{url(''.$image)}}" style="height:75px;width:75px;">
										<a href="{{url('developer/category/del_icon/'.$edit_data->id)}}" title="remove"><i class="fa fa-remove fa-trash" aria-hidden="true"></i></a>
										<input type="hidden" class="" name="pc_icon" value="{{ $edit_data->pc_icon }}" >
										 @endif
										@else
										<input type="file" class="form-control" name="pc_icon">
										@endif
										
										@if ($errors->has('pc_icon'))
											<span class="help-block">
												<strong>{{ $errors->first('pc_icon') }}</strong>
											</span>
										@endif
										</div>
											<div class="col-lg-4">
											<input type="submit" class="btn btn-info btn-block" class="form-control" name="submit" style="margin-top:10px;">
									 
									</div>
									
								</form>
							</div>
							
							  
                            <!-- /.table-responsive -->
						
							 
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

		 
        </div>
        <!-- /#page-wrapper -->

<?php echo View::make('admin/footer'); ?>
