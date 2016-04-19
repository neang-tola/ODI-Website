@extends('layouts.master_site')

	@section('main_content')
	<div class="container">
		<div class="header">
			<h2 class="pull-left">{{ $job_info->job_title }}</h2>
			<a href="/submit-cv" class="pull-right btn btn-search-record btn-lg btn-apply">Apply Now</a>
		</div>
	</div>		
	<div class="listdown-odi">
		<div class="blog-title">
			<div class="container">
				<div class="title">Responsibilities:</div>
			</div>
		</div>
		<div class="container">			
			{!! $job_info->job_des !!}
		</div>
		<div class="blog-title">
			<div class="container">
				<div class="title">Requirements:</div>
			</div>
		</div>
		<div class="container">			
			{!! $job_info->job_required !!}
		</div>
		<div class="blog-title">
			<div class="container">
				<div class="title">How to apply:</div>
			</div>
		</div>
		<div class="container">	
		@if(!empty($job_info->how_apply))
			{!! $job_info->how_apply !!}
		@else
			<p>Interested applicants meeting the above requirements should send their CV and cover letter to <a href="#">recruitment@odi-asia.com</a> with the expected salary <b>before 31 March 2016.</b> Please kindly state. </p>
		@endif
		</div>	
	</div>
	@endsection

@section('script')
	{!! HTML::script('public/site/js/home.js') !!}
@endsection