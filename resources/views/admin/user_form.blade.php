@extends('layouts.master_admin')
@section('main_content')
          <!--overview start-->
              
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <section class="panel">
                  <header class="panel-heading">{{ @$heading_title }}</header>
                  <div class="panel-body">
                    <div class="form">
                        {!! Session::get('msg') !!} 

                        {!! Form::open(['url' => @$my_route, 'class' => 'form-validate form-horizontal', 'id' => 'form_user',  'onsubmit' => @$chk_validat]) !!}
                              <div class="form-group">
                                  <label for="userName" class="control-label col-lg-2 col-md-4 col-sm-4">User Name <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <input class="form-control" id="userName" name="userName" type="text" value="{{ @$info->name }}" />
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_name"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="userEmail" class="control-label col-lg-2 col-md-4 col-sm-4">Email <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                    <input type="text" name="userEmail" id="userEmail" value="{{ @$info->email }}" class="form-control"/>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4">
                                    <span class="error" id="err_email"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="userRole" class="control-label col-lg-2 col-md-4 col-sm-4">Role <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                    {!! Form::select('userRole', AdminHelper::controlRole(@$info->role_id), @$info->role_id, ['class' => 'form-control', 'id' => 'userRole']) !!} 
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4">
                                    <span class="error" id="err_role"></span>
                                  </div>
                              </div>
                            @if(empty(@$info->id))
                              <div class="form-group">
                                  <label for="userPassword" class="control-label col-lg-2 col-md-4 col-sm-4">Password <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <input type="password" name="userPassword" id="userPassword" class="form-control" />
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4">
                                    <span class="error" id="err_password"></span>
                                  </div>                                  
                              </div>                           
                              <div class="form-group">
                                  <label for="userConfirmPassword" class="control-label col-lg-2 col-md-4 col-sm-4">Confirm Password <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <input type="password" name="userConfirmPassword" id="userConfirmPassword" class="form-control" />
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4">
                                    <span class="error" id="err_confirm"></span>
                                  </div>                                  
                              </div>  
                              <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-8">
                                      <button class="btn btn-primary" type="submit">Save New</button>
                                      <button class="btn btn-default" type="reset">Cancel</button>
                                  </div>
                              </div>
                            @else
                              <div class="form-group">
                                  <label for="resetPassword" class="control-label col-lg-2 col-md-4 col-sm-4">Reset Password</label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <input type="password" name="userPassword" id="resetPassword" class="form-control" />
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4">
                                    <span class="error" id="err_password"></span>
                                  </div>                                  
                              </div>                           
                              <div class="form-group">
                                  <label for="confirmPassword" class="control-label col-lg-2 col-md-4 col-sm-4">Confirm Password</label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <input type="password" name="userConfirmPassword" id="confirmPassword" class="form-control" />
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4">
                                    <span class="error" id="err_conpassword"></span>
                                  </div>                                  
                              </div>                             
                              <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-8">
                                      <button class="btn btn-primary" type="submit">Save Change</button>
                                      <button class="btn btn-default" type="reset">Cancel</button>
                                      <input type="hidden" value="{{ @$info->id }}" name="userId" />
                                  </div>
                              </div>
                            @endif
                            {!! Form::close() !!}

                          </div>
                        </div>
                      </section>
                  </div>
          </div> <!-- End Row  -->

@endsection

@section('script')
<script src="{{ URL::asset('public/backend/js/component/form-validation-user.js') }}"></script>
@endsection