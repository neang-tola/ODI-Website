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

                        {!! Form::open(['url' => @$my_route, 'class' => 'form-validate form-horizontal', 'id' => 'form_training',  'onsubmit' => 'return isValidate_form_job()']) !!}
                              <div class="form-group">
                                  <label for="jobTitle" class="control-label col-lg-2 col-md-4 col-sm-4">Training Title <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <input class="form-control" id="jobTitle" name="jobTitle" type="text" value="{{ @$info->job_title }}" />
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_title"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="jobCategory" class="control-label col-lg-2 col-md-4 col-sm-4">Category <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                    {!! Form::select('jobCategory', @$ctrl_category, @$info->cat_id, ['class' => 'form-control chosen-select', 'data-placeholder'=>'Choose a Category', 'id' => 'jobCategory']) !!}
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_category"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="jobLocation" class="control-label col-lg-2 col-md-4 col-sm-4">Location <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      {!! Form::select('jobLocation', @$ctrl_location, @$info->loc_id, ['class' => 'form-control chosen-select', 'data-placeholder' => 'Choose a Location', 'id' => 'jobLocation']) !!}
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_location"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="jobCloseDate" class="control-label col-lg-2 col-md-4 col-sm-4">Closing Date <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <div class='input-group date' id='jobCloseDate'>
                                      @if(!empty(@$info->job_id))
                                          <input type="text" class="form-control" name="closeDate" id="closeDate" value="{{ AdminHelper::format_date(@$info->close_date) }}"/>
                                      @else
                                          <input type="text" class="form-control" name="closeDate" id="closeDate" value="{{ @$closing_date }}"/>
                                      @endif
                                          <span class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                          </span>
                                      </div>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_close_date"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="jobPublish" class="control-label col-lg-2 col-md-4 col-sm-4">Published <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                    {!! Form::select('jobPublish', AdminHelper::controlYesNo(), @$info->publish, ['class' => 'form-control', 'id' => 'jobPublish']) !!}
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="row-label">
                                      <h4 class="col-lg-2 col-md-2 col-sm-4">Job Description <span class="required">*</span></h4>
                                      <div class="col-lg-3 col-md-3 col-sm-4">
                                        <span class="btn btn-primary btn-sample-des">Sample Description</span> 
                                        <span class="btn btn-default btn-clear">Clear</span> 
                                      </div>
                                      <div class="col-lg-7 col-md-7 col-sm-4"><span class="error" id="err_des"></span></div>
                                    </div>
                                    <textarea class="editor" name="jobDescription" id="jobDescription">{!! @$info->job_des !!}</textarea>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="row-label">
                                      <h4 class="col-lg-2 col-md-2 col-sm-4">Job Requirement <span class="required">*</span></h4>
                                      <div class="col-lg-3 col-md-3 col-sm-4">
                                        <span class="btn btn-primary btn-sample-req">Sample Requirement</span> 
                                        <span class="btn btn-default btn-clear">Clear</span> 
                                      </div>
                                      <div class="col-lg-7 col-md-7 col-sm-4"><span class="error" id="err_required"></span></div>
                                    </div>
                                    <textarea class="editor" name="jobRequirement" id="jobRequirement">{!! @$info->job_required !!}</textarea>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="row-label">
                                      <h4 class="col-lg-2 col-md-2 col-sm-4">How to Apply job </h4>
                                      <div class="col-lg-3 col-md-3 col-sm-4">
                                        <span class="btn btn-primary btn-sample-apply">Sample Text Apply</span> 
                                        <span class="btn btn-default btn-clear">Clear</span> 
                                      </div>
                                      <div class="col-lg-7 col-md-7 col-sm-4"><span class="error" id="err_apply"></span></div>
                                    </div>
                                    <textarea class="editor" name="jobApplyText" id="jobApplyText">{!! @$info->how_apply !!}</textarea>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-8">
                                  @if(empty(@$info->job_id))
                                      <button class="btn btn-primary" type="submit">Save New</button>
                                  @else
                                      <button class="btn btn-primary" type="submit">Save Change</button>
                                      <input type="hidden" value="{{ @$info->job_id }}" name="jobId" />
                                  @endif
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

@section('style')
{!! HTML::style('public/backend/css/bootstrap-datepicker.css') !!}
{!! HTML::style('public/backend/css/chosen.css') !!}
@endsection

@section('script')
<script src="{{ URL::asset('public/backend/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('public/backend/js/component/form-validation-job.js') }}"></script>
<script src="{{ URL::asset('public/backend/js/chosen.jquery.min.js') }}"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>

<script type="text/javascript">
    $(function () {
        $('#closeDate').datepicker({
            format: "dd-mm-yyyy",
            startDate: new Date()
        });  

        $('#closeDate').on('changeDate', function(ev){
          $(this).datepicker('hide');
        });

    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    });

  $('textarea.editor').ckeditor({
    filebrowserImageBrowseUrl: '/laravel-filemanager/show?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl: '/laravel-filemanager/show?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
  });
</script>
@endsection