@extends('layouts.master_site')

@section('slide_banner')
    <div class="banner">
        @if(!empty($training_info->trc_banner))
        <img src="public/banners/{{ $training_info->trc_banner }}">
        @endif
        <a href="/register-online" class="pull-right btn btn-search-record btn-lg btn-apply btn-on-banner">Register Now</a>
        <div class="date_register">
            <ul>
            @if(!empty($training_info->started_from))
                <li><label> Date : {{ Helper::training_date($training_info->started_from, $training_info->started_to) }}</label></li>
            @endif
            @if(!empty($training_info->trc_place))
                <li><label> Venue : {{ $training_info->trc_place }}</li>
            @endif
            @if(!empty($training_info->trc_price))
                <li><label> Fee : USD {{ $training_info->trc_price }}</label></li>
            @endif
            @if(!empty($training_info->trc_discount))
                <li><label> {{ $training_info->trc_discount }}</label></li>
            @endif
            @if(!empty($training_info->last_register))
                <li><label> Last registration by {{ date('F d, Y', strtotime($training_info->last_register)) }}</label></li>
            @endif
            </ul>
        </div>
    </div><!-- /.banner -->
@endsection

@section('nav_main_block')
    <div class="row nav-main-block">
        <nav class="nav-mobile visible-sm">
            <a href="javascript:void(0);"><i class="fa fa-bars"></i> Menu</a>
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
                        <form class="" action="#" method="post">
                            <input type="text" placeholder="Search" class="pull-left"/>
                            <button type="submit" class="pull-right"><i class="fa fa-search fa-2x"></i></button>
                            <div class="clearfix"></div>
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
    <div class="container">
        <div class="clear-space"><!-- Content -->
            {!! $training_info->trc_content !!}
        </div>
    </div>
@endsection

@section('script')
	{!! HTML::script('public/site/js/home.js') !!}
@endsection