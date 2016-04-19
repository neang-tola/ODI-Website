@extends('layouts.master_admin')
@section('main_content')

             <div class="row">
                  <div class="col-lg-12">
                      {!! Session::get('msg') !!}
                      <section class="panel">
                          <header class="panel-heading">
                            {!! Form::open(['url' => route('admin.slideshow.search'), 'class' => 'navbar-form', 'id' => 'find_slideshow']) !!}
                              {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search', 'id' => 'key_word']) !!}
                            {!! Form::close() !!}
                            <div class="pull-right">
                              <a href="{{ route('admin.slideshow.create') }}" class="btn btn-primary">New Slideshow</a>
                            </div>
                            <div class="clearfix"></div>
                          </header>
                          <div class="table-responsive">
                            <div class="loading"></div>
                            <table class="table" id="result_output">
                              <thead>
                                <tr>
                                  <th width="5%">#</th>
                                  <th width="22%">Slide Title</th>
                                  <th width="30%">Image</th>
                                  <th width="10%">Order</th>
                                  <th width="15%">Create Date</th>
                                  <th width="6%">Status</th>
                                  <th width="6%">Edit</th>
                                  <th width="6%">Delete</th>
                                </tr>
                              </thead>
                              <tbody>
                        @foreach($slide_info as $slide)
                                <tr>
                                  <td>{{ $ind++ }}</td>
                                  <td><span class="slide-title">{{ $slide->img_title }}</span></td>
                                  <td class="images"><img src="{{ url('public/slideshows/'.$slide->img_name) }}" /></td>
                                  <td><span class="order">{{ $slide->img_sequense }}</span></td>
                                  <td>{{ date('d F, Y', strtotime($slide->created_at)) }}</td>
                              @if($slide->img_status == 0)
                                  <td><span class="status-s" id="status-{{ $slide->img_id }}-1"><i class="inactive-button"></i></span></td>
                              @else
                                  <td><span class="status-s" id="status-{{ $slide->img_id }}-0"><i class="active-button"></i></span></td>
                              @endif
                                  <td><a href="{{ route('admin.slideshow.edit') .'?eid='. $slide->img_id }}"><i class="edit-button"></i></a></td>
                                  <td><i class="del-button" id="del-{{ $slide->img_id }}"></i></td>
                                </tr>  
                        @endforeach
                              </tbody>
                            </table>
                          </div>
 
                      </section>

                      <nav id="list-pagin">
                      {!! @$slide_info->render() !!}
                      </nav>                      
                  </div>
              </div>

<div class="modal fade modal-custom" id="confirm-msg-delete" tabindex="-1" role="dialog" aria-labelledby="ConfirmMsgModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4 class="modal-title">Delete Confirmation</h4>
      <div class="modal-body">
        <p>Are you sure? You want remove this image from slideshow list.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="confirm-ok">Ok</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="view-image" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="img-show"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="close-img"></i></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('script')
<script type="text/javascript" src="{{ URL::asset('public/backend/js/component/scripts-slideshow.js') }}"></script>
@endsection