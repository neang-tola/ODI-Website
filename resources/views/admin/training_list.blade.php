@extends('layouts.master_admin')
@section('main_content')
             <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            {!! Form::open(['url' => route('admin.training.search'), 'class' => 'navbar-form-training', 'id' => 'find_training']) !!}
                              <div class="col-lg-6 col-md-6 col-sm-6">
                              {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search', 'id' => 'key_word']) !!}
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4"> 
                              {!! Form::select('customize', ['' => 'Group by', 0 => 'Training Course', 1 => 'Customize Course'], '', ['class' => 'form-control', 'id' => 'group_by']) !!}
                              </div>
                              <div class="col-lg-2 col-md-2 col-sm-2">
                                <a href="{{ route('admin.training.create') }}" class="btn btn-primary" >New Training Course</a>
                              </div>
                            {!! Form::close() !!}
                          </header>
                    
                          <div class="table-responsive">
                            <div class="loading"></div>
                            <table class="table" id="result_output">
                              <thead>
                                <tr>
                                  <th width="5%">#</th>
                                  <th width="22%">Title</th>
                                  <th width="14%">Training Type</th>
                                  <th width="10%">Created By</th>
                                  <th width="15%">Start Date</th>
                                  <th width="6%">Price</th>
                                  <th width="10%">Paticipants</th>
                                  <th width="6%">Publish</th>
                                  <th width="6%">Edit</th>
                                  <th width="6%">Delete</th>
                                </tr>
                              </thead>
                              <tbody>
                            @foreach($training_info as $trc)
                                <tr>
                                  <td>{{ $ind++ }}</td>
                                  <td><span class="training-title">{{ $trc->trc_title }}</span></td>
                                  <td>{{ $trc->training_type }}</td>
                                  <td>{{ $trc->name }}</td>
                              @if($trc->customize == 0)
                                  <td>{{ AdminHelper::started_date($trc->started_from, $trc->started_to) }}</td>
                                  <td class="price">$ {{ $trc->trc_price }}</td>
                                @if($trc->num_record == 0)
                                  <td class="count"><span class="badge badge-primary">{{ $trc->num_record }}</span></td>
                                @else
                                  <td class="count">
                                    <span class="badge badge-primary">
                                      <a href="{{ route('admin.trainingjoined.list') .'?training_id='. $trc->trc_id }}">{{ $trc->num_record }}</a>
                                    </span>
                                  </td>
                                @endif
                              @else
                                  <td colspan="3">&nbsp;</td>
                              @endif

                              @if($trc->publish == 0)
                                  <td><span class="status-t" id="status-{{ $trc->trc_id }}-1"><i class="inactive-button"></i></span></td>
                              @else
                                  <td><span class="status-t" id="status-{{ $trc->trc_id }}-0"><i class="active-button"></i></span></td>
                              @endif
                                  <td><a href="{{ route('admin.training.edit') .'?eid='. $trc->trc_id }}"><i class="edit-button"></i></a></td>
                                  <td><i class="del-button" id="del-{{ $trc->trc_id }}"></i></td>
                                </tr>  
                            @endforeach
                              </tbody>
                            </table>
                          </div>
                      
                      </section>

                      <nav id="list-pagin">
                    @if(!empty($group))
                      {!! @$training_info->appends(['bytype' => $group])->render() !!}
                    @else
                      {!! @$training_info->render() !!}
                    @endif
                      </nav>                      
                  </div>
              </div>

<div class="modal fade modal-custom" id="confirm-msg-delete" tabindex="-1" role="dialog" aria-labelledby="ConfirmMsgModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4 class="modal-title">Delete Confirmation</h4>
      <div class="modal-body">
        <p>Are you sure? The Training Course "<span></span>", you will remove from list of training course.</p>
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
<script type="text/javascript" src="{{ URL::asset('public/backend/js/component/scripts-training.js') }}"></script>
@endsection