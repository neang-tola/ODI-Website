@extends('layouts.master_site')
@section('slide_banner')
	@if(!empty(@$content->img_name))
	    <div class="banner">
			<img src="/public/slideshows/{{ $content->img_name }}" alt="{{ $content->img_name }}" class="img-responsive" />
			<div class="carousel-caption">
				<div class="row">
					<div class="col-sm-6">
						<div class="carousel-caption">
							{!! $content->img_content_l !!}
						</div>
					</div>
					<div class="col-sm-6">
					   <div class="carousel-caption">
					      	{!! $content->img_content_r !!}
						</div>
					</div>
				</div>
			</div>
	      </div>
	    </div><!-- /.banner -->
	@endif
@endsection

@section('nav_main_block')
	<div class="row nav-main-block">
	    <nav class="nav-mobile visible-xs">
	    	<span class="menu-responsive"><i class="fa fa-bars"></i> Menu</span>
	    </nav>	
		<div class="container">
			<div class="row">
			@if($content->block_search == 0)
				<div class="col-lg-12 col-md-12 col-sm-12">
				 	{!! @$menu !!}
				</div>			
			@else
				<div class="col-lg-8 col-md-8 col-sm-8 none-pad-left none-pad-right">
				 	{!! @$menu !!}
				 </div>
				 <div class="col-lg-4 col-md-4 col-sm-4">
				 	
				 	<div class="search-block">
				 		<form action="{{ route('find.result') }}" method="post" autocomplete="off" id="search_form">
					 		<input type="text" name="search" id="search" placeholder="Search" class="pull-left"/>
					 		<button type="submit" class="pull-right"><i class="fa fa-search fa-2x"></i></button>
					 		<div class="clearfix"></div>
					 		<input type="hidden" name="_token" value="{{ csrf_token() }}">
				 		</form>
				 	</div>
					<div class="download-block">
						@if(Request::segment(1) == 'free-resources')
						    <a href="#" class="down_resource"><img src="/public/_images/idownload.png" /></a>
						@else
							<a href="/free-resources" class="down_resource"><img src="/public/_images/download.png" /> </a>
						@endif
					</div>
				 </div>
			@endif
			</div>
		</div>
	</div>
@endsection

@section('main_content')

@if(@$content->cnt_id == 5)
	<div class="container">
		<div class="clear-space">
			<div class="address-contents">
				{!! @$content->ctt_des !!}
			</div>	
		</div>	
	</div>
	<div class="map">
		{!! $content->con_remark !!}
	</div>	
@else
	<div class="container">
		<div class="clear-space">
			{!! Helper::templateGallery($content->gal_id) !!}
			<article class="blog-article">
				{!! @$content->ctt_des !!}
			</article>
			<div class="clearfix"></div>
			{!! @$content_info !!}
		</div>
	</div>
@endif

@endsection

@section('style')
	{!! HTML::style('public/site/css/chosen.css') !!}
	{!! HTML::style('public/site/css/bootstrapValidator.css') !!}
@endsection

@section('script')
	{!! HTML::script('public/site/js/chosen.jquery.js') !!}
	{!! HTML::script('public/site/js/home.js') !!}
	{!! HTML::script('public/site/js/bootstrapValidator.min.js') !!}
	{!! HTML::script('public/site/js/form-validation.js') !!}
	<script type="text/javascript">
	    var config = {
	      '.chosen-select'           : {},
	      '.chosen-select-deselect'  : {allow_single_deselect:true},
	      '.chosen-select-no-single' : {disable_search_threshold:6},
	      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
	      '.chosen-select-width'     : {width:"95%"}
	    }
	    for (var selector in config) {
	      $(selector).chosen(config[selector]);
	    }
	</script>
@endsection