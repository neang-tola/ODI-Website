@extends('layouts.master_site')

	@section('main_content')
	<div class="container">
				<div class="blog-form-submit-cv form-setting">
					<div class="register-cv">Job Alert Criteria</div>
					<form class="form-horizontal register-frm" method="post" action="{{ route('save.criteria.setting') }}" id="frm_setcriteria">
					  <div class="form-group col-sm-6">
					    <label for="full-name" class="col-sm-4 control-label">Full Name :</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control frm-cv" id="fullName" name="fullName" />
					      <input type="hidden" name="_token" value="{{ csrf_token() }}">
					    </div>
					  </div>
					  <div class="form-group col-sm-6">
					    <label for="gender" class="col-sm-4 control-label">Gender :</label>
					    <div class="col-sm-8">
					    	<select class="form-control frm-cv" name="gender" id="gender" >
					    		<option value=""></option>
					    		<option value="male">Male</option>
					    		<option value="female">Female</option>
					    	</select>
					    </div>
					  </div>

					  <div class="form-group col-sm-6">
					    <label for="current-position" class="col-sm-4 control-label">Current Position:</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control frm-cv" id="position" name="position" />
					    </div>
					  </div>

					  <div class="form-group col-sm-6">
					    <label for="apply-for" class="col-sm-4 control-label" >Apply For :</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control frm-cv" id="applyFor" name="applyFor" value="'. Session::get('job_title') .'"/>
					    </div>
					  </div>
					  <div class="form-group col-sm-6">
					    <label for="phone" class="col-sm-4 control-label">Phone Number :</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control frm-cv" id="phoneNumber" name="phoneNumber" />
					    </div>
					  </div>

					  <div class="form-group col-sm-6">
					    <label for="salary-expect" class="col-sm-4 control-label">SalaryExspect :</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control frm-cv" id="salaryExpect" name="salaryExpect" />
					    </div>
					  </div>

					  <div class="form-group col-sm-6">
					    <label for="email" class="col-sm-4 control-label">Email :</label>
					    <div class="col-sm-8">
					      <input type="email" class="form-control frm-cv" id="email" name="email" />
					    </div>
					  </div>

					  <div class="form-group col-sm-6">
					    <label for="upload-cv" class="col-sm-4 control-label">Upload CV :</label>
					    <div class="col-sm-8">
							<div class="custom-file-upload" data-toggle="tooltip" data-placement="top" title="">
							    <input type="file" id="file" name="cvfiles" class="form-control frm-cv" />
							</div>					      
					    </div>

					  </div>
					  <div class="form-group col-sm-12">
					    <label for="comments" class="col-sm-2 control-label" >Comment :</label>
					    <div class="col-sm-10">
					      <textarea class="form-control frm-cv margin-left comments-frm" name="comments" id="comments"></textarea>
					    </div>
					  </div>						  					  

					  <div class="form-group col-sm-12">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-search-record margin-left">Save Setting</button>
					    </div>
					  </div>
					  <div class="clear"></div>
					</form>
				</div>
	</div>
	@endsection

@section('script')
	{!! HTML::script('public/site/js/home.js') !!}
@endsection