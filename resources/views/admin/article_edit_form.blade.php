@extends('layouts.master_admin')
@section('main_content')
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <section class="panel">
                  <header class="panel-heading">{{ @$heading_title }}</header>
                  <div class="panel-body">
                    <div class="form">
                        {!! Session::get('msg') !!} 

                        {!! Form::open(['url' => route('admin.article.update'), 'class' => 'form-validate form-horizontal', 'id' => 'form_article',  'onsubmit' => 'return isValidate_form_article()']) !!}
                          @if($info_translate['lang_count'] == 1)
                              <div class="form-group">
                                  <label for="articleTitle" class="control-label col-lg-2 col-md-4 col-sm-4">Article Title <span class="required">*</span></label>
                                  <div class="col-lg-6 col-md-4 col-sm-4">
                                  @foreach($info_translate['lang_info'] as $lang_val)
                                      <input type="hidden" name="langId[]" value="{{ $lang_val->lang_id }}" />
                                      <input type="hidden" name="articleTId[]" value="{{ $lang_val->ctt_id }}" />
                                      <input class="form-control" id="articleTitle" name="articleTitle[]" type="text" value="{{ $lang_val->ctt_title }}" />
                                  @endforeach
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                    <span class="error" id="err_title"></span>
                                  </div>
                              </div>
                            @if($info->con_id > 1)
                              <div class="form-group">
                                  <label for="articleDes" class="control-label col-lg-2 col-md-4 col-sm-4"> 
                                    Description <span class="required">*</span>
                                    <div><span class="error" id="err_des"></span></div>
                                  </label>
                                  <div class="col-lg-10 col-md-8 col-sm-8">
                                      <textarea class="form-control articleDes" id="articleDes" name="articleDes[]" >{{ @$lang_val->ctt_des }}</textarea>
                                  </div>
                              </div>
                            @endif
                          @else
                              <div class="form-tab">
                              <?php
                                $i  = 1;
                                $print_li      = '';
                                $print_content = '';

                                foreach($info_translate['lang_info'] as $lang_val){

                                  if($i == 1){
                                    $print_li .= '
                                                <li class="active">
                                                  <a href="#tab-'. strtolower(@$lang_val->lang_title) .'" data-toggle="tab">'. @$lang_val->lang_title .'</a>
                                                </li>';
                                    $print_content .= '
                                                <div id="tab-'. strtolower(@$lang_val->lang_title) .'" class="tab-pane active">
                                                  <div class="form-group">
                                                    <label for="articleDes" class="control-label col-lg-2 col-md-4 col-sm-4"> 
                                                      Article Title <span class="required">*</span>
                                                    </label>
                                                    <div class="col-lg-6 col-md-4 col-sm-4">
                                                        <input type="hidden" name="langId[]" value="'. @$lang_val->lang_id .'" />
                                                        <input type="hidden" name="articleTId[]" value="'. @$lang_val->ctt_id .'" />
                                                        <input class=" form-control" id="articleTitle" name="articleTitle[]" type="text" value="'.@$lang_val->ctt_title.'" />
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 padtop">
                                                      <span class="error" id="err_title"></span>
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="articleDes" class="control-label col-lg-2 col-md-4 col-sm-4"> 
                                                      Description <span class="required">*</span>
                                                      <div><span class="error" id="err_des"></span></div>
                                                    </label>
                                                    <div class="col-lg-10 col-md-8 col-sm-8">
                                                        <textarea class="form-control articleDes" id="articleDes" name="articleDes[]">' .@$lang_val->ctt_des .'</textarea>
                                                    </div>
                                                  </div>
                                                </div>';
                                  }else{
                                    $print_li .= '
                                                <li class="">
                                                  <a href="#tab-'. strtolower(@$lang_val->lang_title) .'" data-toggle="tab">'. @$lang_val->lang_title .'</a>
                                                </li>';
                                    $print_content .= '
                                                <div id="tab-'. strtolower(@$lang_val->lang_title) .'" class="tab-pane">
                                                  <div class="form-group">
                                                    <label for="articleTitle" class="control-label col-lg-2 col-md-4 col-sm-4">Article Title </label>
                                                    <div class="col-lg-6 col-md-4 col-sm-4">
                                                        <input type="hidden" name="langId[]" value="'. @$lang_val->lang_id .'" />
                                                        <input type="hidden" name="articleTId[]" value="'. @$lang_val->ctt_id .'" />
                                                        <input class="form-control" name="articleTitle[]" type="text" value="'.@$lang_val->ctt_title.'" />
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="articleDes" class="control-label col-lg-2 col-md-4 col-sm-4"> Description </label>
                                                    <div class="col-lg-10 col-md-8 col-sm-8">
                                                        <textarea class="form-control articleDes" name="articleDes[]" >' .@$lang_val->ctt_des .'</textarea>
                                                    </div>
                                                  </div>
                                                </div>';
                                  }
                                  $i++;
                                }
                              ?>
                                <!--start tab-->
                                <section class="panel">
                                    <header class="panel-heading tab-bg-primary ">
                                        <ul class="nav nav-tabs">
                                          {!! $print_li !!}
                                        </ul>
                                      </header>
                                      <div class="panel-body">
                                        <div class="tab-content">
                                          {!! $print_content !!}
                                        </div>
                                      </div>
                                  </section>
                                  <!-- end tab -->
                                </div>
                          @endif
                                <div class="form-group">
                                    <label for="articleBanner" class="control-label col-lg-2 col-md-4 col-sm-4">Banner from slide</label>
                                    <div class="col-lg-6 col-md-4 col-sm-4">
                                        {!! Form::select('articleBanner', $ctrl_image_slide, $info->img_id, ['class' => 'form-control chosen-select', 'id' => 'articleBanner', 'data-placeholder' => 'Choose a banner image']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="articleAdditional" class="control-label col-lg-2 col-md-4 col-sm-4"> Additional Content</label>
                                    <div class="col-lg-6 col-md-4 col-sm-4">
                                        {!! Form::select('articleAddition', $ctrl_additional, $info->con_plus, ['class' => 'form-control chosen-select', 'id' => 'articleAdditional', 'data-placeholder' => 'Choose a Additional Content']) !!}
                                    </div>
                                </div>
                          {{--
                                      <div class="form-group">
                                          <label for="articleShowFront" class="control-label col-lg-2 col-md-4 col-sm-4">Show front page status </label>
                                          <div class="col-lg-6 col-md-4 col-sm-4">
                                              {!! Form::select('articleShowFront', AdminHelper::controlYesNo(), $info->con_front, ['class' => 'form-control', 'id' => 'articleShowFront']) !!}
                                          </div>
                                      </div>
                          --}}
                                      <div class="form-group">
                                          <label for="articleMetakey" class="control-label col-lg-2 col-md-4 col-sm-4">Meta Keyword </label>
                                          <div class="col-lg-6 col-md-4 col-sm-4">
                                              <textarea class="form-control" cols="30" id="articleMetakey" name="articleMetakey" cols="3">{{ $info->meta_key }}</textarea>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="articleMetades" class="control-label col-lg-2 col-md-4 col-sm-4">Meta Description</label>
                                          <div class="col-lg-6 col-md-4 col-sm-4">
                                              <input type="hidden" id="articleId" name="articleId" value="{{ $info->con_id }}" />
                                              <textarea class="form-control" id="articleMetades" name="articleMetades" cols="3">{{ $info->meta_des }}</textarea>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
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

@section('style')
  {!! HTML::style('public/backend/css/chosen.css') !!}
@endsection

@section('script')
<script src="{{ URL::asset('public/backend/js/component/form-validation-article.js') }}"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
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

  $('textarea.articleDes').ckeditor({
    filebrowserImageBrowseUrl: '/laravel-filemanager/show?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl: '/laravel-filemanager/show?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
  });
</script>
@endsection