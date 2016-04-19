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

                        {!! Form::open(['url' => @$my_route, 'class' => 'form-validate form-horizontal', 'id' => 'form_slideshow',  'onsubmit' => 'return isValidate_slideshow()', 'files' => true]) !!}
                              <div class="form-group">
                                  <label for="slideTitle" class="control-label col-lg-2 col-md-4 col-sm-4">Slideshow Title <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                      <input type="text" class="form-control" id="slideTitle" name="slideTitle" value="{{ @$info->img_title }}"/>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_title"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="slideStatus" class="control-label col-lg-2 col-md-4 col-sm-4">Status <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                    {!! Form::select('slideStatus', AdminHelper::controlStatus(), @$info->img_status, ['class' => 'form-control', 'id' => 'slideStatus']) !!}
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="slideOrder" class="control-label col-lg-2 col-md-4 col-sm-4">Order <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                @if(empty(@$info->img_id))
                                    <input type="text" class="form-control" id="slideOrder" value="{{ @$max_order }}" />
                                @else
                                    <input type="text" class="form-control" id="slideOrder" value="{{ @$info->img_sequense }}" />
                                @endif
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4">
                                    <span class="error" id="err_order"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-lg-2 col-md-4 col-sm-4">Image Slideshow <span class="required">*</span></label>
                                  <div class="btn-file-image col-lg-6 col-md-4 col-sm-4">
                                    <span class="btn btn-default col-lg-2 col-md-4 col-sm-4">
                                      Browse <input type="file" class="upload" name="slideImage" id="slideImage" />
                                    </span>
                                    <span class="col-lg-10 col-md-8 col-sm-8 padding-none">
                                      <input id="showImage" class="form-control" placeholder="Choose a Image 1680px X 350px" disabled="disabled" />
                                    </span>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4">
                                  @if(!empty(@$info->img_name))
                                    <img src="/public/slideshows/{{ $info->img_name }}" height="35px" />
                                  @endif
                                  </div>                                          
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-lg-2 col-md-4 col-sm-4">Caption Position <strong>(Left)</strong></label>
                                  <div class="col-lg-10 col-md-8 col-sm-8">
                                    <div class="row">
                                      <div class="col-lg-7 col-md-7 col-sm-7">
                                        <select class="form-control" name="leftCaption" id="leftCaption">
                                          <option value="">Choose Caption Type</option>
                                          <option value="1">Image</option>
                                          <option value="2">Text</option>
                                        </select>
                                      </div>
                                      <div class="col-lg-5 col-md-5 col-sm-5">
                                          <span class="error" id="err_lcaption"></span>
                                      </div>
                                    </div> <!-- End row -->
                                    <div class="row margin-row">

                                      <div class="col-lg-12 col-md-12 col-sm-12" id="leftText">
                                        <textarea class="form-control my-editor" name="leftTextCaption" id="leftTextCaption"></textarea>
                                      </div>
                                      <div class="btn-file-image col-lg-7 col-md-7 col-sm-7" id="leftImage">
                                            <span class="btn btn-default col-lg-2 col-md-4 col-sm-4">
                                              Browse <input type="file" class="upload" name="leftImageCaption" id="leftImageCaption" />
                                            </span>
                                            <span class="col-lg-10 col-md-8 col-sm-8 padding-none">
                                              <input id="captionImageLeft" class="form-control" placeholder="Choose a image side 400px X 300px" disabled="disabled" />
                                            </span>
                                      </div>
                                      <div class="col-lg-5 col-md-5 col-sm-5">
                                          <span class="error" id="err_limage"></span>
                                      </div>
                                    </div> <!-- End row -->                                    
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-lg-2 col-md-4 col-sm-4">Caption Position <strong>(Right)</strong></label>
                                  <div class="col-lg-10 col-md-8 col-sm-8">
                                    <div class="row">
                                      <div class="col-lg-7 col-md-7 col-sm-7">
                                        <select class="form-control" name="rightCaption" id="rightCaption">
                                          <option value="">Choose Caption Type</option>
                                          <option value="1">Image</option>
                                          <option value="2">Text</option>
                                        </select>
                                      </div>
                                      <div class="col-lg-5 col-md-5 col-sm-5">
                                          <span class="error" id="err_rcaption"></span>
                                      </div>
                                    </div> <!-- End row -->
                                    <div class="row margin-row">
                                      <div class="col-lg-12 col-md-12 col-sm-12" id="rightText">
                                        <textarea class="form-control my-editor" name="rightTextCaption" id="rightTextCaption"></textarea>
                                      </div>
                                      <div class="btn-file-image col-lg-7 col-md-7 col-sm-7" id="rightImage">
                                            <span class="btn btn-default col-lg-2 col-md-4 col-sm-4">
                                              Browse <input type="file" class="upload" name="rightImageCaption" id="rightImageCaption" />
                                            </span>
                                            <span class="col-lg-10 col-md-8 col-sm-8 padding-none">
                                              <input id="captionImageRight" class="form-control" placeholder="Choose a image side 400px X 300px" disabled="disabled" />
                                            </span>
                                      </div>
                                      <div class="col-lg-5 col-md-5 col-sm-5">
                                          <span class="error" id="err_rimage"></span>
                                      </div>
                                    </div> <!-- End row -->                                    
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-8">
                                  @if(empty(@$info->img_id))
                                      <button class="btn btn-primary" type="submit">Save New</button>
                                  @else
                                      <button class="btn btn-primary" type="submit">Save Change</button>
                                      <input type="hidden" value="{{ @$info->img_id }}" name="slideId" />
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
      <h4 class="modal-title">Slide upload error</h4>
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

@section('script')
<script src="{{ URL::asset('public/backend/js/component/form-validation-slide.js') }}"></script>
<script src="{{ URL::asset('public/backend/js/chosen.jquery.min.js') }}"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
  $('textarea.my-editor').ckeditor({
    filebrowserImageBrowseUrl: '/laravel-filemanager/show?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl: '/laravel-filemanager/show?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
  });
</script>
@endsection