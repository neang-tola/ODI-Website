<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="{!! trim(@$meta_des) !!}">
    <meta name="keyword" content="{!! @$meta_key !!}">
    <meta name="author" content="Web Bits">
    <link rel="shortcut icon" href="/public/favicon.png">

    <title>{{ @$title }}</title>

    <!-- Bootstrap core CSS -->
    {!! HTML::style('public/site/css/font-awesome.css') !!}
    {!! HTML::style('public/site/css/bootstrap.min.css') !!}

    {!! HTML::script('public/site/js/ie-emulation-modes-warning.js') !!}
    {!! HTML::style('public/site/css/odi-site.css') !!}
  @yield('style')
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="navbar-wrapper">
      <div class="container">
        <a href="index.php">
  		    <div class="logo"><a href="/" alt="ODI Home Page"><img src="{{ URL::asset('public/_images/logo.png') }}" alt="ODI Logo" /></a></div>
        </a>
      </div>
    </div>
	@yield('slide_banner')

  @yield('nav_main_block')
	
	@yield('main_content')		
		<!-- Row partner -->
    @if(!empty($partner_logo))
		<div class="show-partner">
			<div class="container-fluid">
            {!! $partner_logo !!}
			</div>
		</div>
	 @endif

	<div class="bottom-block">
		<div class="container">
			<h3 class="company-footer">ODI Asia Co., Ltd.</h3>			
			<ul class="info-odi pull-left">
				<li><i class="fa fa-home"></i>: <span>Bayon Building 4th Floor, No. 33-34, George Dimitrov (St.114), <br>Sangkat Monorom, Khan 7 Makara, 12251 Phnom Penh, Cambodia.</span></li>
				<li><img src="{{ URL::asset('public/_images/phone-footer.png') }}" alt="phone" width="18"> : <span>(855) 23 722 431</span></li>
				<li><i class="fa fa-envelope-o"></i> : <span>odi@odi-asia.com</span></li>
				<li><i class="fa fa-globe"></i> : <span>www.odi-asia.com</span></li>
			</ul>
			<ul class="media-social-odi pull-right">
				<li><a href="#"><i class="fa fa-facebook"></i></a></li>
				<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
			</ul>
      <div class="clearfix"></div>
      <p class="pull-right copyright">Copyright &copy; ODI Asia Co., Ltd. All rights reserved.</p>			
		</div>	
	</div>

    {!! HTML::script('public/site/js/jquery.min.js') !!}
    {!! HTML::script('public/site/js/bootstrap.min.js') !!}
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    {!! HTML::script('public/site/js/holder.min.js') !!}
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    {!! HTML::script('public/site/js/ie10-viewport-bug-workaround.js') !!}
    {!! HTML::script('public/site/js/modernizr.js') !!}
    {!! HTML::script('public/site/js/main.js') !!}
    @yield('script')
  </body>
</html>