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

                        {!! Form::open(['url' => @$my_route, 'class' => 'form-validate form-horizontal', 'id' => 'form_training',  'onsubmit' => @$chk_validat, 'files' => true]) !!}
                              <div class="form-group">
                                  <label for="trainingType" class="control-label col-lg-2 col-md-4 col-sm-4">Training Type <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                    {!! Form::select('trainingType', $ctrl_parent, @$info->parent_id, ['class' => 'form-control chosen-select', 'id' => 'trainingType', 'data-placeholder'=>'Choose a Training Type']) !!}
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_type"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="trainingTitle" class="control-label col-lg-2 col-md-4 col-sm-4">Training Title <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <input class="form-control" id="trainingTitle" name="trainingTitle" type="text" value="{{ @$info->trc_title }}" />
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_title"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="trainingPublish" class="control-label col-lg-2 col-md-4 col-sm-4">Published <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                    {!! Form::select('trainingPublish', AdminHelper::controlYesNo(), @$info->publish, ['class' => 'form-control', 'id' => 'trainingPublish']) !!}
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="trainingPlace" class="control-label col-lg-2 col-md-4 col-sm-4">Venue <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                    <input id="trainingPlace" class="form-control" name="trainingPlace" />
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4">
                                    <span class="error" id="err_place"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="trainingGalllery" class="control-label col-lg-2 col-md-4 col-sm-4">Gallery </label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                    <input id="trainingGallery" class="form-control" name="trainingGallery" />
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-lg-2 col-md-4 col-sm-4">Banner (1680px X 350px) </label>
                                  <div class="btn-file-image col-lg-6 col-md-4 col-sm-4">
                                    <span class="btn btn-default col-lg-2 col-md-4 col-sm-4">
                                      Browse <input type="file" class="upload" name="trainingBanner" id="trainingBanner" />
                                    </span>
                                    <span class="col-lg-10 col-md-8 col-sm-8 padding-none">
                                      <input id="showBanner" class="form-control" placeholder="Choose a banner" disabled="disabled" />
                                    </span>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4">
                                  @if(!empty(@$info->trc_banner))
                                    <img src="/public/banners/{{ $info->trc_banner }}" height="35px" />
                                  @endif
                                  </div>                                          
                              </div>
                              <div class="form-group">
                                  <label for="trainingCustomize" class="control-label col-lg-2 col-md-4 col-sm-4">It is a </label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <div class="radio">
                                          <label>
                                           <input type="radio" name="trainingCustomize" class="trainingCustomize" value="0" {!! $chk_radio !!} > Training Course 
                                          </label>
                                      </div>
                                      <div class="radio">
                                          <label>
                                            <input type="radio" name="trainingCustomize" class="trainingCustomize" value="1" {!! $chk_radio1 !!}> Custimize Course
                                          </label>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group optional" {!! @$style !!}>
                                  <label for="trainingPrice" class="control-label col-lg-2 col-md-4 col-sm-4">Fee of course ($)<span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <input type="text" class="form-control" name="trainingPrice" id="trainingPrice" value="{{ @$info->trc_price }}"/>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_price"></span>
                                  </div>
                              </div>
                              <div class="form-group optional" {!! @$style !!}>
                                  <label for="trainingLang" class="control-label col-lg-2 col-md-4 col-sm-4">Language <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                  @if(empty($info->trc_id))
                                    {!! Form::select('trainingLang', AdminHelper::ctrl_language(), 'Khmer', ['class' => 'form-control chosen-select', 'id' => 'trainingLang']) !!}
                                  @else
                                    {!! Form::select('trainingLang', AdminHelper::ctrl_language(), @$info->trc_language, ['class' => 'form-control chosen-select', 'id' => 'trainingLang']) !!}
                                  @endif
                                  </div>
                              </div>
                              <div class="form-group optional" {!! @$style !!}>
                                  <label for="trainingFrom" class="control-label col-lg-2 col-md-4 col-sm-4">Start From <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <div class='input-group date' id='datepickerFrom'>
                                          <input type="text" class="form-control datepicker" name="trainingFrom" id="trainingFrom" value="{{ AdminHelper::format_date(@$info->started_from) }}"/>
                                          <span class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                          </span>
                                      </div>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_from"></span>
                                  </div>
                              </div>                              
                              <div class="form-group optional" {!! @$style !!}>
                                  <label for="trainingTo" class="control-label col-lg-2 col-md-4 col-sm-4">Start To</label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <div class='input-group date' id='datepickerTo'>
                                          <input type="text" class="form-control datepicker" name="trainingTo" id="trainingTo" value="{{ AdminHelper::format_date(@$info->started_to) }}"/>
                                          <span class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                          </span>
                                      </div>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_to"></span>
                                  </div>
                              </div>
                              <div class="form-group optional" {!! @$style !!}>
                                  <label for="trainingDuration" class="control-label col-lg-2 col-md-4 col-sm-4">Duration <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <input type="text" class="form-control" name="trainingDuration" id="trainingDuration" value="{{ @$info->trc_duration }}" />
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_duration"></span>
                                  </div>
                              </div>
                              <div class="form-group optional" {!! @$style !!}>
                                  <label for="lastRegister" class="control-label col-lg-2 col-md-4 col-sm-4">Last Registration on </label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <div class='input-group date' id='datepickerTo'>
                                          <input type="text" class="form-control datepicker" name="lastRegister" id="lastRegister" value="{{ AdminHelper::format_date(@$info->last_register) }}"/>
                                          <span class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                          </span>
                                      </div>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_last_register"></span>
                                  </div>
                              </div>
                              <div class="form-group optional" {!! @$style !!}>
                                  <label for="discountRegister" class="control-label col-lg-2 col-md-4 col-sm-4">Discount on registration </label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <input type="text" class="form-control" name="discountRegister" id="discountRegister" value="{{ @$info->trc_discount }}" placeholder="15% off for Early bird registration (before April 13, 2016)" />
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_last_register"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="row-label">
                                      <h4 class="col-lg-2 col-md-2 col-sm-4">Description</h4>
                                      <div class="col-lg-3 col-md-3 col-sm-4">
                                        <span class="btn btn-primary btn-sample">Sample</span> 
                                        <span class="btn btn-default btn-clear">Clear</span> 
                                      </div>
                                      <div class="col-lg-7 col-md-7 col-sm-4"><span class="error" id="err_des"></span></div>
                                    </div>
                                    <textarea class="course-editor" name="trainingDescription" id="trainingDescription">{!! @$info->trc_content !!}</textarea>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-8">
                                  @if(empty(@$info->trc_id))
                                      <button class="btn btn-primary" type="submit">Save New</button>
                                  @else
                                      <button class="btn btn-primary" type="submit">Save Change</button>
                                      <input type="hidden" value="{{ @$info->trc_id }}" name="trainingId" />
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

<div class="modal fade modal-custom" id="modal-message" tabindex="-1" role="dialog" aria-labelledby="ConfirmMsgModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4 class="modal-title">Banner upload error</h4>
      <div class="modal-body">
        <p>Image allow only extension JPG, PNG and GIF, with maximum file size 2MB.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('style')
{!! HTML::style('public/backend/css/bootstrap-datepicker.css') !!}
{!! HTML::style('public/backend/css/chosen.css') !!}
@endsection

@section('script')
<script src="{{ URL::asset('public/backend/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('public/backend/js/component/form-validation-training.js') }}"></script>
<script src="{{ URL::asset('public/backend/js/chosen.jquery.min.js') }}"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
    $(function () {
        $('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            startDate: new Date()
        });  

        $('.datepicker').on('changeDate', function(ev){
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
  $('textarea.course-editor').ckeditor({
    filebrowserImageBrowseUrl: '/laravel-filemanager/show?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl: '/laravel-filemanager/show?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
  });
</script>
@endsection