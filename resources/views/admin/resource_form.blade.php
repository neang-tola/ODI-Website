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
                        @if(empty(@$info->res_id))
                        {!! Form::open(['url' => route('admin.resource.insert'), 'class' => 'form-validate form-horizontal', 'id' => 'form_resource',  'onsubmit' => 'return isValidate_form_resource()', 'files' => true]) !!}
                        @else
                        {!! Form::open(['url' => route('admin.resource.update'), 'class' => 'form-validate form-horizontal', 'id' => 'form_resource',  'onsubmit' => 'return isValidate_update_resource()', 'files' => true]) !!}
                        @endif
                              <div class="form-group">
                                  <label for="resourceType" class="control-label col-lg-2 col-md-4 col-sm-4">Resource Type <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                    {!! Form::select('resourceType', $ctrl_parent, @$info->parent_id, ['class' => 'form-control chosen-select', 'id' => 'resourceType', 'data-placeholder' => 'Choose a Resource Type']) !!}
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_type"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="resourceTitle" class="control-label col-lg-2 col-md-4 col-sm-4">Resource Title <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <input class="form-control" id="resourceTitle" name="resourceTitle" type="text" value="{{ @$info->res_title }}" />
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_title"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                              @if(empty(@$info->res_id))
                                  <label for="resourceDoc" class="control-label col-lg-2 col-md-4 col-sm-4">Documentation <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <div class="btn-file-image">
                                        <span class="btn btn-default col-lg-2 col-md-4 col-sm-4">
                                            Browse <input type="file" class="upload" name="resourceDoc" id="resourceDoc" />
                                        </span>
                                        <span class="col-lg-10 col-md-8 col-sm-8 padding-none">
                                            <input id="uploadFile" class="form-control" placeholder="Choose document" disabled="disabled" />
                                        </span>
                                      </div>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_doc"></span>
                                  </div>
                              @else
                                  <label for="resourceDoc" class="control-label col-lg-2 col-md-4 col-sm-4">Documentation </label>
                                  <input type="hidden" value="{{ @$info->res_id }}" name="resourceId" />
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <div class="btn-file-image">
                                        <span class="btn btn-default col-lg-2 col-md-4 col-sm-4">
                                            Browse <input type="file" class="upload" name="resourceDoc" id="resourceDoc" />
                                        </span>
                                        <span class="col-lg-10 col-md-8 col-sm-8 padding-none">
                                            <input id="uploadFile" class="form-control" placeholder="Choose document" disabled="disabled" />
                                        </span>
                                      </div>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                  @if(!empty(@$info->res_file))
                                    <span class="preview-resource" id="{{ @$info->res_file }}"><i class="fa fa-eye"></i></span>
                                  @endif
                                  </div>
                              @endif    

                              </div>                          
                              <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-8">
                                  @if(empty(@$info->res_id))
                                      <button class="btn btn-primary" type="submit">Save New</button>
                                  @else
                                      <button class="btn btn-primary" type="submit">Save Change</button>
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
      <h4 class="modal-title">Documentation Upload error</h4>
      <div class="modal-body">
        <p>Docuementation allow only extension DOC, DOCX, XLS, XLSX and PDF, with maximum file size 2MB.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="view-document" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="document-show">
          <iframe id="previewModal" style="width: 100%; height: 500px;" src=""></iframe>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="close-img"></i></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('style')
{!! HTML::style('public/backend/css/chosen.css') !!}
@endsection
@section('script')
<script src="{{ URL::asset('public/backend/js/component/form-validation-resource.js') }}"></script>
<script src="{{ URL::asset('public/backend/js/chosen.jquery.min.js') }}"></script>
<script type="text/javascript">
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
</script>
@endsection