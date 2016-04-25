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
					 		<input type="text" name="search" id="search" placeholder="Search" class="pull-left" value="{{ @$search }}" />
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
		<div class="row">
		@if(!empty($article))
			<h4 class="result">Article</h4>
			<ul class="found-result">
			@foreach($article as $row)
				<li>
					<a href="/{{ $row->m_link }}" title="{{ $row->ctt_title }}">{!! str_ireplace($search, '<b>'.$search.'</b>', $row->ctt_title) !!}</a>
				@if(!empty(stripos(strip_tags($row->ctt_des), $search)))
					<div class="content">
					{!! Helper::viewDescription(strip_tags($row->ctt_des), $search) !!}
					</div>
				@endif
				</li>
			@endforeach
			</ul>
		@endif

		@if(!empty($training))
			<h4 class="result">Training Course</h4>
			<ul class="found-result">
			@foreach($training as $trc)
				<li>
					<a href="/training-course-detail-{!! $trc->trc_id.'-'. Helper::encode_title($trc->trc_title) !!}" title="{{ $trc->trc_title }}">{!! str_ireplace($search, '<b>'.$search.'</b>', $trc->trc_title) !!}</a>
				@if(!empty(stripos(strip_tags($trc->trc_content), $search)))
					<div class="content">
					{!! Helper::viewDescription(strip_tags($trc->trc_content), $search) !!}
					</div>
				@endif
				</li>
			@endforeach
			</ul>
		@endif

		@if(!empty($job_vacancy))
			<h4 class="result">Job Vacancy</h4>
			<ul class="found-result">
			@foreach($job_vacancy as $job)
				<li>
					<a href="/job-detail-{!! $job->job_id.'-'.Helper::encode_title($job->job_title) !!}" title="{{ $job->job_title }}">{!! str_ireplace($search, '<b>'.$search.'</b>', $job->job_title) !!}</a>
				@if(!empty(stripos(strip_tags($job->job_des), $search)))
					<div class="content">
					{!! Helper::viewDescription(strip_tags($job->job_des), $search) !!}
					</div>
				@endif
				</li>
			@endforeach
			</ul>
		@endif

		@if(empty($article) && empty($training) && empty($job_vacancy))
		<div class="not-found-result">
			<div class="alert alert-warning" role="alert">The result <b>Not Found</b> match to your keyword search.</div>
		</div>
		@endif
		</div>
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