@extends('layouts.master_site')

@section('slide_banner')
	{!! $slideshow !!}
@endsection

@section('nav_main_block')
	<div class="row nav-main-block">
	    <nav class="nav-mobile visible-xs">
	    	<span class="menu-responsive"><i class="fa fa-bars"></i> Menu</span>
	    </nav>	
		<div class="container">
			<div class="row">
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
						<a href="/free-resources" class="down_resource"><img src="/public/_images/download.png" /></a>
					</div>
				 </div>				
			</div>
		</div>
	</div>
@endsection

@section('main_content')
	<div class="container">
		{!! Helper::templateTrainingCourse(0, $training_info, $training_info->render()) !!}	
	</div>	
@endsection

@section('script')
	{!! HTML::script('public/site/js/home.js') !!}
	<script type="text/javascript">
		var slideshow = $('#mySlider').html();
		if(slideshow.length > 0){
			$.get('/loading-image-slideshow', function(result){
				if(result != ''){
					$('#mySlider .item').after(result);
				}
			});
		}
	</script>
@endsection