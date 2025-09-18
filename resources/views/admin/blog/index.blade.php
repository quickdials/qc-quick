<?php echo View::make('admin/header'); ?>

       <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><a href="{{url('developer/blog/blogdetails')}}">Blog Details</a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
					@if(Session::has('success'))
						<div class="alert alert-success">
							{{Session::get('success')}}
						</div>
					@endif
					@if(Session::has('failed'))
						<div class="alert alert-danger">
							{{Session::get('failed')}}
						</div>
					@endif					
                    <div class="panel panel-info">
                        <div class="panel-body">
						
							<div class=" row">
							 
									 
									<div class="col-md-12 text-right">
										<h4><u><a href="{{url('developer/blog/add')}}">Add Blog</a></u></h4>
									</div>
									 
									 
								 
								 
							</div>
						
						@if(Request::segment(3)=='edit' || Request::segment(3)=='add'	)
						<div class=" row form-group{{ $errors->has('mode') ? ' has-error' : '' }}">
					<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
						{{ csrf_field() }}
					<div class="form-group">
						<label for="name" class="col-md-2 control-label">Name</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="name" placeholder="Enter Bog Name" value="{{ old('name',(isset($edit_data)) ? $edit_data->name:"")}}">
							@if ($errors->has('name'))
								<span class="error alert-danger">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
							@endif
						</div>
					</div>							
								
								<div class="form-group">
									<label for="meta_title" class="col-md-2 control-label">Meta Title</label>
									<div class="col-md-7">
										<textarea class="form-control" name="meta_title" placeholder="Enter Meta Title">{{ old('meta_title',(isset($edit_data)) ? $edit_data->meta_title:"")}}</textarea>
										@if ($errors->has('meta_title'))
											<span class="error alert-danger">
												<strong>{{ $errors->first('meta_title') }}</strong>
											</span>
										@endif
									</div>
								</div>
								@if(Request::segment(3)=='edit')
								<div class="form-group">
									<label for="slug" class="col-md-2 control-label">Slug</label>
									<div class="col-md-7">
										<input class="form-control" name="slug" placeholder="Enter slug" value="{{ old('slug',(isset($edit_data)) ? $edit_data->slug:"")}}"> 
										@if ($errors->has('slug'))
											<span class="error alert-danger">
												<strong>{{ $errors->first('slug') }}</strong>
											</span>
										@endif
									</div>
								</div>
								@endif

								<div class="form-group">
									<label for="meta_keywords" class="col-md-2 control-label">Meta Keywords</label>
									<div class="col-md-7">
										<textarea class="form-control" name="meta_keywords" placeholder="Enter Meta Keywords">{{ old('meta_title',(isset($edit_data)) ? $edit_data->meta_keywords:"")}}</textarea>
										@if ($errors->has('meta_keywords'))
											<span class="error alert-danger">
												<strong>{{ $errors->first('meta_keywords') }}</strong>
											</span>
										@endif
									</div>
								</div>
								
								<div class="form-group">
									<label for="meta_description" class="col-md-2 control-label">Meta Description</label>
									<div class="col-md-7">
										<textarea class="form-control" name="meta_description" placeholder="Enter Meta Description">{{ old('meta_description',(isset($edit_data)) ? $edit_data->meta_description:"")}}</textarea>
										@if ($errors->has('meta_description'))
											<span class="error alert-danger">
												<strong>{{ $errors->first('meta_description') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<label for="description" class="col-md-2 control-label">Description</label>
									<div class="col-md-10">
										<textarea class="form-control tinymce-selector" name="description" placeholder="Enter Description" rows="15">{{ old('description',(isset($edit_data)) ? $edit_data->description:"")}}</textarea>
										@if ($errors->has('description'))
											<span class="error alert-danger">
												<strong>{{ $errors->first('description') }}</strong>
											</span>
										@endif
									</div>
								</div>
								
								<div class="form-group">
									<label for="image" class="col-md-2 control-label">Image<span>*</span></label>
									<div class="col-md-7">
										
										<span class="blog-block">
									 
										<?php 
										if(!empty($edit_data->image)){
									 	$image = unserialize($edit_data->image);
										$image = $image['large']['src'];
										?>
										@if(isset($image)&&!empty($image))
										<img src="{{url($image)}}" style="height:75px;width:75px;">
										<a href="{{url('developer/blog/del_icon/'.$edit_data->id)}}" title="remove"><i class="fa fa-times fa-fw" aria-hidden="true"></i></a>
										<input type="hidden" class="" name="image" value="{{ $edit_data->image }}" >
										@endif
										<?php  }else{ ?>
										 <input type="file" class="form-control" name="image"  accept=".jpg, .jpeg, .png, .webp">
 										<?php  } ?>
										@if ($errors->has('image'))
											<span class="error alert-danger">
												<strong>{{ $errors->first('image') }}</strong>
											</span>
										@endif
										</span>
									</div>
								</div>
								
								<div class="form-group">
									<label for="top_content" class="col-md-2 control-label">Top Content</label>
									<div class="col-md-10">
										<textarea class="form-control" name="top_content" placeholder="Enter Top Content" rows="8">{{ old('top_content',(isset($edit_data)) ? $edit_data->top_content:"")}}</textarea>
										@if ($errors->has('top_content'))
											<span class="error alert-danger">
												<strong>{{ $errors->first('top_content') }}</strong>
											</span>
										@endif
									</div>
								</div>

									<div class="form-group">
									<label for="image" class="col-md-2 control-label">Image banner<span>*</span></label>
									<div class="col-md-7">
										
										<span class="blog-block">									 
										<?php 
										if(!empty($edit_data->image_banner)){
									 	$bimage = unserialize($edit_data->image_banner);
										$imagev = $bimage['large']['src'];
										?>
										@if(isset($imagev)&&!empty($imagev))
										<img src="{{url($imagev)}}" style="height:75px;width:75px;">
										<a href="{{url('developer/blog/del_blog_banner/'.$edit_data->id)}}" title="remove"><i class="fa fa-times fa-fw" aria-hidden="true"></i></a>
										<input type="hidden" class="" name="image_banner" value="{{ $edit_data->image_banner }}" >
										@endif
										<?php  }else{ ?>
										 <input type="file" class="form-control" name="image_banner"  accept=".jpg, .jpeg, .png, .webp">
 										<?php  } ?>
										@if ($errors->has('image_banner'))
											<span class="error alert-danger">
												<strong>{{ $errors->first('image_banner') }}</strong>
											</span>
										@endif
										</span>
									</div>
								</div>
								<div class="form-group">
									<label for="bottom_content" class="col-md-2 control-label">Bottom Content</label>
									<div class="col-md-10">
										<textarea class="form-control" name="bottom_content" placeholder="Enter bottom content" rows="15">{{ old('bottom_content',(isset($edit_data)) ? $edit_data->bottom_content:"")}}</textarea>
										@if ($errors->has('bottom_content'))
											<span class="error alert-danger">
												<strong>{{ $errors->first('bottom_content') }}</strong>
											</span>
										@endif
									</div>
								</div>
								 

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-primary" name="submit" value="{{$button}}">
											 Submit
										</button>
									</div>
								</div>
									 
								</form>
							</div>
							@else
									
								 
                            <table width="100%" class="table table-striped table-bordered table-hover" id="datatable-blogdetails">
                                <thead>
                                    <tr>
                                        <th>Name</th>
										<th>Title</th>                                        
										<th>Image</th>                                        
										<th>Status</th>                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
								<tfoot>
                                    <tr>
										<th>Name</th>
										<th>Title</th>                                        
										<th>Image</th>                                       
										<th>Status</th>                                       
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        
							
							@endif
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

		 
			<!-- deleteKeywordModal -->
			<div id="deleteClient" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
					</div>
				</div>
			</div>
			<!-- deleteKeywordModal -->
        </div>
        <!-- /#page-wrapper -->

<?php echo View::make('admin/footer'); ?>