@extends('layouts.master_admin')
@section('main_content')
             <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            {!! Form::open(['url' => route('admin.trainingtype.search'), 'class' => 'navbar-form', 'id' => 'find_training_type']) !!}
                              {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search', 'id' => 'key_word']) !!}
                            {!! Form::close() !!}
                            <div class="pull-right">
                              <button class="btn btn-primary" id="new-button">New Training type</button>
                            </div>
                            <div class="clearfix"></div>
                          </header>
                    
                          <div class="table-responsive">
                            <div class="loading"></div>
                            <table class="table" id="result_output">
                              <thead>
                                <tr>
                                  <th width="5%">#</th>
                                  <th width="60%">Title</th>
                                  <th width="15%">Created Date</th>
                                  <th width="10%">Edit</th>
                                  <th width="10%">Delete</th>
                                </tr>
                              </thead>
                              <tbody>
                            @foreach($type_info as $trc)
                                <tr>
                                  <td>{{ $ind++ }}</td>
                                  <td><span class="training-title">{{ $trc->trc_title }}</span></td>
                                  <td>{{ date('d F, Y', strtotime($trc->created_at)) }}</td>
                                  <td><i class="edit-button" id="edit-{{ $trc->trc_id }}"></i></td>
                                  <td><i class="del-button" id="del-{{ $trc->trc_id }}"></i></td>
                                </tr>  
                            @endforeach
                                <tr><td colspan="5">&nbsp;</td></tr>
                              </tbody>
                            </table>
                          </div>
                      
                      </section>

                      <nav id="list-pagin">
                      {!! @$type_info->render() !!}
                      </nav>                      
                  </div>
              </div>

<div class="modal fade modal-custom" id="confirm-msg-delete" tabindex="-1" role="dialog" aria-labelledby="ConfirmMsgModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4 class="modal-title">Delete Confirmation</h4>
      <div class="modal-body">
        <p>Are you sure? The Training Type "<span></span>", you will remove from training type list.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="confirm-ok">Ok</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ URL::asset('public/backend/js/component/scripts-training-type.js') }}"></script>
@endsection