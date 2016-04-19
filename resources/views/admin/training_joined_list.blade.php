@extends('layouts.master_admin')
@section('main_content')
             <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            {!! Form::open(['url' => route('admin.trainingjoined.search'), 'class' => 'navbar-form', 'id' => 'find_training_joined']) !!}
                              {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search', 'id' => 'key_word']) !!}
                              <input type="hidden" name="training_id" value="{{ $training_id }}" id="trainingId" />
                            {!! Form::close() !!}
                          </header>
                    
                          <div class="table-responsive">
                            <div class="loading"></div>
                            <table class="table" id="result_output">
                              <thead>
                                <tr>
                                  <th width="5%">#</th>
                                  <th width="15%">Full Name</th>
                                  <th width="15%">Company Name</th>
                                  <th width="10%">Position</th>
                                  <th width="15%">Training Title</th>
                                  <th width="10%">Email Address</th>
                                  <th width="10%">Phone</th>
                                  <th width="10%">Register on</th>
                                  <th width="10%">Status</th>
                                </tr>
                              </thead>
                              <tbody>
                            @foreach($join_info as $trc)
                                <tr>
                                  <td>{{ $ind++ }}</td>
                                  <td>{{ $trc->full_name }}</td>
                                  <td>{{ $trc->company }}</td>
                                  <td>{{ $trc->position }}</td>
                                  <td>{{ $trc->trc_title }}</td>
                                  <td>{{ $trc->email }}</td>
                                  <td>{{ $trc->phone .' / '. $trc->phone_paticipant }}</td>
                                  <td>{{ date('d F, Y', strtotime($trc->created_at)) }}</td>
                                  <td>{!! AdminHelper::ctrl_joined_status($trc->status, $trc->id) !!}</td>
                                </tr>  
                            @endforeach
                              </tbody>
                            </table>
                          </div>
                      
                      </section>

                      <nav id="list-pagin">
                    @if(!empty($training_id))
                      {!! @$join_info->appends(['trnid' => $training_id])->render() !!}
                    @else
                      {!! @$join_info->render() !!}
                    @endif
                      </nav>                      
                  </div>
              </div>

@endsection

@section('script')
<script type="text/javascript" src="{{ URL::asset('public/backend/js/component/scripts-training-joined.js') }}"></script>
@endsection