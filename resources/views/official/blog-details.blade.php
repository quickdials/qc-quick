@extends('client.layouts.app')
@section('title') 
    @if (!empty($blogdetails->meta_title)) {!! $blogdetails->meta_title !!} 
    @else {!! $blogdetails->title !!} 
    @endif 
@endsection 

@section('keyword') 
    @if (!empty($blogdetails->meta_keyword)) {{ $blogdetails->meta_keyword }} 
    @else Best IT Training Institute in Noida | Delhi | Gurgaon 
    @endif 
@endsection 

@section('description') 
    @if (!empty($blogdetails->meta_description)) {{ $blogdetails->meta_description }} 
    @else  IT Training Institute in Noida | Delhi | Gurgaon for Industrial Training. We conducts IT Software, Hardware, Network & Security Courses training. Corporate Trainer commands all training program. Week Days, Weekend, 6 Week, 6 Months Industrial Training are available 
    @endif 
@endsection
@section('content')
 

  <link href="{{asset('public/official/css/style.css')}}" rel="stylesheet">
 <style>
 .post-thumbnail img{
	     height: 350px;
    width: 900px;
 }
 </style>
  
  <!-- END Header -->
  <div class="blog-page area-padding" style="margin-top: 100px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <div class="page-head-blog">
            <div class="single-blog-page">
              <!-- search option start -->
          
              <!-- search option end -->
            </div>
            <div class="single-blog-page">
              <!-- recent start -->
              <div class="left-blog">
                <h4>Recent post</h4>
                <div class="recent-post">
                  <!-- start single post -->
                 @if(!empty($bloglist))
					 @foreach($bloglist as $blog)
						<?php 
						if($blog->image!=''){
						$image = unserialize($blog->image);
						$image = $image['large']['src'];
					 
						}
						?>
				 <div class="recent-single-post">
                    <div class="post-img">
                      <a href="{{url('blog/'.$blog->slug)}}">
						<img src="<?php echo (isset($image)?url($image):"");  ?>" width="70px" height="52px" title="{{$blog->name}}" alt="{{$blog->name}}">
						</a>
						</div>
                    <div class="pst-content">
                     <p> <a href="{{url('blog/'.$blog->slug)}}">{{$blog->name}}</a></p>
                    </div>
                  </div>
				  @endforeach
				  @endif
				  
                
                  
                </div>
              </div>
              <!-- recent end -->
            </div>
         
             
             
          </div>
        </div>
		
        <!-- End left sidebar -->
        <!-- Start single blog -->
        <div class="col-md-9 col-sm-9 col-xs-12">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
           
              <article class="blog-post-wrapper">
                <div class="post-thumbnail">
					<?php 
          $image="";
						if($blogdetails->image!=''){
						$image = unserialize($blogdetails->image);
						//$image = $image['thumbnail']['src'];
						$image = $image['large']['src'];
						}
						?>
                  <img src="<?php echo (isset($image)?url($image):"");  ?>" title="{{$blogdetails->name}}" alt="{{$blogdetails->name}}" width: 900px; height: 350px;/>
                </div>
                <div class="post-information">
                  <h1>{{$blogdetails->name}}</h1>
                  <div class="entry-meta">
                    <!--<span class="author-meta"><i class="fa fa-user"></i> <a href="javascript:void(0)">admin</a></span>-->
                    <span><i class="fa fa-clock-o"></i> <?php echo date('d M Y',strtotime($blogdetails->created_at)); ?></span>
                  
                  </div>
                  <div class="entry-content">
                   <p> <?php echo ucfirst(($blogdetails->description)); ?></p>
                    
				 
                  </div>


                   <div class="entry-content">
                    <p><?php echo ucfirst(($blogdetails->top_content)); ?></p>
                    
				 
                  </div>



                   <div class="entry-content">

                    <?php 
                    $image_banner="";
                    if($blogdetails->image_banner!=''){
                    $image_banner = unserialize($blogdetails->image_banner);
             
                    $image_banner = $image_banner['large']['src'];
                    }
                    ?>
                    <img src="<?php echo (isset($image_banner)?url($image_banner):"");  ?>" title="{{$blogdetails->name}}" alt="{{$blogdetails->name}}" style="width: 900px; height: 250px;"/>
                    </div>
                   <div class="entry-content">
                   <p> <?php echo ucfirst(($blogdetails->bottom_content)); ?></p>
                    
				 
                  </div>





                </div>
              </article>
              <div class="clear"></div>
			  
			  
			   
              
			 
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Blog Area -->
  <div class="clearfix"></div>
@endsection
