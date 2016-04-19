@extends('layouts.master_site')
@section('main_content')
	<div class="content-member-form">
		<div class="member-form col-sm-3 col-sm-offset-4">
		<h2>Member Login</h2>
		<form method="post" action="{{ route('check.member.login') }}" autocomplete="off">
		  <div class="form-group">
		    <input type="email" class="form-control frm-txt txt-user" id="email" name="memberMail" placeholder="Email Address" />
		  </div>
		  <div class="form-group">
		    <input type="password" class="form-control frm-txt txt-pass" id="password" name="memberPassword" placeholder="Password" />
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		  </div>
		  <button type="submit" class="btn btn-member-login">Login</button>
		  <div class="error">{{ Session::get('msg') }}</div>
		</form>
		</div>
	</div>
@endsection