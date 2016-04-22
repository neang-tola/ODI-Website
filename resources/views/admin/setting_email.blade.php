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
                        {!! Form::open(['url' => route('admin.save.email'), 'class' => 'form-validate form-horizontal', 'id' => 'form_email',  'onsubmit' => 'return isValidate_email();']) !!}
                              <div class="form-group">
                                  <label for="alertFromCandidate" class="control-label col-lg-2 col-md-4 col-sm-4">Recieve Email while Candidate submit CV <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                    <textarea class="form-control" name="alertFromCandidate" id="alertFromCandidate">{{ $info->email_job }}</textarea>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <div class="guide">Please split user email by semicolon ( <b>;</b> ) </div>
                                    <span class="error" id="err_candidate"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="alertFromTrainer" class="control-label col-lg-2 col-md-4 col-sm-4">Receive Email while Trainer register <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <textarea class="form-control" name="alertFromTrainer" id="alertFromTrainer">{{ $info->email_training }}</textarea>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <div class="guide">Please split user email by semicolon ( <b>;</b> ) </div>
                                    <span class="error" id="err_trainer"></span>
                                  </div>
                              </div>   
              
                              <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-8">
                                      <button class="btn btn-primary" type="submit">Save Change</button>
                                      <button class="btn btn-default" type="reset">Cancel</button>
                                  </div>
                              </div>
                            {!! Form::close() !!}

                          </div>
                        </div>
                      </section>
                  </div>
          </div> <!-- End Row  -->
@endsection

@section('script')
<script src="{{ URL::asset('public/backend/js/component/form-validation-setting.js') }}"></script>
@endsection