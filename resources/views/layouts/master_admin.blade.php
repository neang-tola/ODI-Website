<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/public/favicon.png">

    <title>{{ @$title }}</title>

    <!-- Bootstrap CSS -->   
    {!! HTML::style('public/backend/css/bootstrap.min.css') !!} 
    <!-- bootstrap theme -->
    {!! HTML::style('public/backend/css/bootstrap-theme.css') !!}
    <!--external css-->
    <!-- font icon -->
    {!! HTML::style('public/backend/css/elegant-icons-style.css') !!}
    {!! HTML::style('public/backend/css/font-awesome.min.css') !!}  

    {!! HTML::style('public/backend/css/style.css') !!}
    {!! HTML::style('public/backend/css/style-responsive.css') !!}
	  {!! HTML::style('public/backend/css/jquery-ui-1.10.4.min.css') !!}
    @yield('style')
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
     
      <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>
            <!--logo start-->
            <a href="{{ route('admin.dashboard') }}" class="logo">ODI <span class="lite">Internal User</span></a>
            <!--logo end-->

            <div class="top-nav notification-row">                
                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="username">{{ Auth::user()->name }}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li class="eborder-top">
                                <a href="{{ route('admin.change.password') }}"><i class="icon_key_alt"></i> Change Password</a>
                            </li>
                            <li>
                                <a href="{{ route('internal.logout') }}"><i class="icon_profile"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>      
      <!--header end-->

      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">
                  <li>
                      <a href="{{ route('admin.dashboard') }}">
                          <i class="icon_house_alt"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                @if(Auth::user()->role_id == 2)
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_documents_alt"></i>
                          <span>Training</span>
                        @if(empty($training_drop))
                          <span class="menu-arrow arrow_carrot-right"></span>
                        @else
                          <span class="menu-arrow {!! $training_drop !!}"></span>
                        @endif
                      </a>
                      <ul class="sub" {!! @$training_submenu !!}>                 
                          <li><a href="{{ route('admin.training.list') }}"><span>Manage Training</span></a></li>         
                          <li><a href="{{ route('admin.trainingtype.list') }}"><span>Taining Type</span></a></li>
                          <li><a href="{{ route('admin.trainingjoined.list') }}"><span>Paticipants</span></a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="{{ route('admin.gallery.list') }}">
                        <i class="icon_table"></i><span>Manage Gallery</span>
                      </a>
                  </li>  
                @elseif(Auth::user()->role_id == 3)
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_documents_alt"></i>
                          <span>Recruitment</span>
                        @if(empty($recruitment_drop))
                          <span class="menu-arrow arrow_carrot-right"></span>
                        @else
                          <span class="menu-arrow {!! $recruitment_drop !!}"></span>
                        @endif
                      </a>
                      <ul class="sub" {!! @$recruitment_submenu !!}>                 
                          <li><a href="{{ route('admin.job.list') }}"><span>Manage Jobs</span></a></li>         
                          <li><a href="{{ route('admin.candidate.list') }}"><span>Manage CVs</span></a></li>
                      </ul>
                  </li>
                @else
        				  <li>
        					    <a href="{{ route('admin.menu.list') }}">
                        <i class="icon_document_alt"></i><span>Manage Menu</span>
                      </a>
        				  </li>
        				  <li>
        					    <a href="{{ route('admin.article.list') }}">
                        <i class="icon_documents_alt"></i><span>Manage Article</span>
                      </a>
        				  </li>  
        				  <li>
        					    <a href="{{ route('admin.contact.list') }}">
                        <i class="icon_genius"></i><span>Manage Contact</span>
                      </a>
        				  </li>           				  				  
        				  <li>
        					    <a href="{{ route('admin.slideshow.list') }}">
                        <i class="icon_desktop"></i><span>Manage Slideshow</span>
                      </a>
        				  </li>		  
                  <li>
                      <a href="{{ route('admin.gallery.list') }}">
                        <i class="icon_table"></i><span>Manage Gallery</span>
                      </a>
                  </li>        				  
                  <li>
        					    <a href="{{ route('admin.user.list') }}">
                        <i class="icon_table"></i><span>Manage Users</span>
                      </a>
        				  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_documents_alt"></i>
                          <span>Resources</span>
                        @if(empty($resource_drop))
                          <span class="menu-arrow arrow_carrot-right"></span>
                        @else
                          <span class="menu-arrow {!! $resource_drop !!}"></span>
                        @endif
                      </a>
                      <ul class="sub" {!! @$resource_submenu !!}>                 
                          <li><a href="{{ route('admin.resource.list') }}"><span>Manage Resources</span></a></li>         
                          <li><a href="{{ route('admin.resourcetype.list') }}"><span>Resource Type</span></a></li>
                      </ul>
                  </li>                  
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_documents_alt"></i>
                          <span>Training</span>
                        @if(empty($training_drop))
                          <span class="menu-arrow arrow_carrot-right"></span>
                        @else
                          <span class="menu-arrow {!! $training_drop !!}"></span>
                        @endif
                      </a>
                      <ul class="sub" {!! @$training_submenu !!}>                 
                          <li><a href="{{ route('admin.training.list') }}"><span>Manage Training</span></a></li>         
                          <li><a href="{{ route('admin.trainingtype.list') }}"><span>Taining Type</span></a></li>
                          <li><a href="{{ route('admin.trainingjoined.list') }}"><span>Paticipants</span></a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_documents_alt"></i>
                          <span>Recruitment</span>
                        @if(empty($recruitment_drop))
                          <span class="menu-arrow arrow_carrot-right"></span>
                        @else
                          <span class="menu-arrow {!! $recruitment_drop !!}"></span>
                        @endif
                      </a>
                      <ul class="sub" {!! @$recruitment_submenu !!}>                 
                          <li><a href="{{ route('admin.job.list') }}"><span>Manage Jobs</span></a></li>         
                          <li><a href="{{ route('admin.candidate.list') }}"><span>Manage CVs</span></a></li>
                      </ul>
                  </li>
                @endif
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">  
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
              {!! $breadcrumb !!}
              </div>
            </div>
          
              @yield('main_content')          
          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->

    <!-- javascripts -->

    {!! HTML::script('public/backend/js/jquery.min.js') !!}
    {!! HTML::script('public/backend/js/bootstrap.min.js') !!}

    {!! HTML::script('public/backend/js/jquery.nicescroll.js') !!}
    {!! HTML::script('public/backend/js/jquery.scrollTo.min.js') !!}
    {!! HTML::script('public/backend/js/scripts.js') !!}
    @yield('script')
  </body>
</html>
