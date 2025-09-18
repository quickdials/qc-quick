<?php echo View::make('admin/header'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Child Categories</h1>
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
							<div class="nc-form row form-group{{ $errors->has('child_category') ? ' has-error' : '' }}">
								<form method="POST" action="/developer/child_category" enctype="multipart/form-data">
									{{ csrf_field() }}
									<div class="col-lg-4">
										<label for="parent_category_id">Select Parent Category:</label>
										<select name="parent_category_id" id="parent_category_id" class="form-control select2-single">
											<?php foreach($parent_categories as $parent_category): ?>
											<option value="<?php echo $parent_category->id; ?>"><?php echo $parent_category->parent_category; ?></option>
											<?php endforeach; ?>
										</select>
										 
									</div>
									 
									<div class="col-lg-4">
										<label for="child_category">Add New Child Category:</label>
										<input type="text" class="form-control" name="child_category" id="child_category" placeholder="Enter Child Category" value="{{ old('child_category') }}">
										@if ($errors->has('child_category'))
											<span class="help-block">
												<strong>{{ $errors->first('child_category') }}</strong>
											</span>
										@endif										
									 
									</div>
									
										<div class="col-lg-4">
										<label for="icon">Child Banner:(1170*165)</label>
										<input type="file" class="form-control" name="child_banner" placeholder="upload icon" >
										@if ($errors->has('child_banner'))
											<span class="help-block">
												<strong>{{ $errors->first('child_banner') }}</strong>
											</span>
										@endif										
									 
									</div>
									
									
										<div class="col-lg-4">
										<label for="icon">Icon:(65*65Pixels)</label>
										<input type="file" class="form-control" name="pc_icon" id="pc_icon" placeholder="upload icon" >
										@if ($errors->has('pc_icon'))
											<span class="help-block">
												<strong>{{ $errors->first('pc_icon') }}</strong>
											</span>
										@endif										
										<input type="submit" class="btn btn-info btn-block" class="form-control" style="margin-top:10px;">
									</div>
									
								</form>
							</div>
							
							 <div class="table-responsive table-virtical-grid">
                            <table width="100%" class="table table-bordered table-hover table-striped" id="dataTables-child_categories">
                                <thead>
                                    <tr>
                                        <th>Child Category</th>
                                        <th>Parent Category</th>
                                         <th>Banner</th>
                                        <th>Icon</th>
                                        <th>Status</th>
                                        <th>Action </th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
								<?php if(isset($child_categories) && count($child_categories)>0): ?>
									<?php foreach($child_categories as $child_category): ?>
                                    <tr>
                                        <td>{{ $child_category->child_category }}</td>
                                        <td>{{ $child_category->parent_category }}</td>
                                          <td> <?php  if(!empty($child_category->child_banner)){
                                        $vicons= unserialize($child_category->child_banner); ?> 
                                        <img src="{{asset(''.$vicons['child_banner']['src'])}}" width="100" alt="{{$vicons['child_banner']['name']}}">	 <?php 
                                        } ?></td>
                                        
                                        
                                        <td> <?php  if(!empty($child_category->pc_icon)){
                                        $vicons= unserialize($child_category->pc_icon); ?> 
                                        <img src="{{asset(''.$vicons['pc_icon']['src'])}}" width="100" alt="{{$vicons['pc_icon']['name']}}">	 <?php 
                                        } ?></td>
										<td>
										<?php 
									 
										if($child_category->status=='1'){ ?>
										<a href="javascript:ChildController.status({{ $child_category->id}},0)" title="category status" class="btn btn-success" >Active</a>
									<?php 	}else{ ?>
										 <a href="javascript:ChildController.status({{ $child_category->id}},1)" title="category status" class="btn btn-danger" >Inactive</a>
									<?php 	}

										?></td>
                                        <td><a href="{{url('developer/editChildCategory/'.$child_category->id)}}" ><i class="fa fa-edit fa-fw" aria-hidden="true"></i></a> 
										@if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('delete_child_category'))                                       
									   <a href="javascript:void(0)" onclick="javascript:deleteChildCategory({{$child_category->id}},this)"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></a>
									   	@endif
									   </td>
									
                                    </tr>
									<?php endforeach; ?>
										<?php else: ?>
                                </tbody>
                            </table>
							</div>
                            <!-- /.table-responsive -->
						
							<div class="alert alert-danger">
								No Child Category Found !!
							</div>
							<?php endif; ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

			<!-- Modal -->
			<!--<div id="updateChildCategoryModal" class="modal fade" role="dialog">-->
			<!--	<div class="modal-dialog modal-sm">-->

			 
			<!--	<div class="modal-content">-->
			<!--		<form method="POST" action="/developer/child_category/update">-->
			<!--			<div class="form-group">-->
			<!--				<div class="modal-header">-->
			<!--					<button type="button" class="close" data-dismiss="modal">&times;</button>-->
			<!--				</div>-->
			<!--				<div class="modal-body">-->
			<!--					{{ csrf_field() }}-->
			<!--					<input type="hidden" name="id">-->

			<!--					<label>Select Parent Category:</label>-->
			<!--					<select name="parent_category_id" class="form-control select2-single" style="width:100%">-->
			<!--						<?php foreach($parent_categories as $parent_category): ?>-->
			<!--						<option value="<?php echo $parent_category->id; ?>"><?php echo $parent_category->parent_category; ?></option>-->
			<!--						<?php endforeach; ?>-->
			<!--					</select>-->
								
			<!--					<label style="margin-top:34px;">Enter Child Category:</label>-->
			<!--					<input type="text" class="form-control" name="child_category" placeholder="Enter Child Category">								-->
			<!--				</div>-->
			<!--				<div class="modal-footer">-->
			<!--					<button type="submit" class="btn btn-info">Update</button>-->
			<!--				</div>-->
			<!--			</div>-->
			<!--		</form>-->
			<!--	</div>-->

			<!--	</div>-->
			<!--</div>-->
			
			
			<!-- Modal -->
        </div>
        <!-- /#page-wrapper -->

<?php echo View::make('admin/footer'); ?>
