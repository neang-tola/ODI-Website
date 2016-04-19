@extends('layouts.master_admin')
@section('main_content')
             <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            {!! Form::open(['url' => route('admin.job.search'), 'class' => 'navbar-form', 'id' => 'find_job']) !!}
                              {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search', 'id' => 'key_word']) !!}
                            {!! Form::close() !!}
                            <div class="pull-right">
                              <a href="{{ route('admin.job.create') }}" class="btn btn-primary">New Job Vacancy</a>
                            </div>
                            <div class="clearfix"></div>
                          </header>
                    
                          <div class="table-responsive">
                            <div class="loading"></div>
                            <table class="table" id="result_output">
                              <thead>
                                <tr>
                                  <th width="5%">#</th>
                                  <th width="25%">Job Title</th>
                                  <th width="20%">Category</th>
                                  <th width="12%">Location</th>
                                  <th width="10%">Created By</th>
                                  <th width="10%">Closing Date</th>
                                  <th width="6%">Publish</th>
                                  <th width="6%">Edit</th>
                                  <th width="6%">Delete</th>
                                </tr>
                              </thead>
                              <tbody>
                            @foreach($job_info as $job)
                                <tr>
                                  <td>{{ $ind++ }}</td>
                                  <td><span class="job-title">{{ $job->job_title }}</span></td>
                                  <td>{{ $job->cat_name }}</td>
                                  <td>{{ $job->loc_name }}</td>
                                  <td>{{ $job->name }}</td>
                                  <td>{{ date('d, F Y', strtotime($job->close_date)) }}</td>
                              @if($job->publish == 0)
                                  <td><span class="status-j" id="status-{{ $job->job_id }}-1"><i class="inactive-button"></i></span></td>
                              @else
                                  <td><span class="status-j" id="status-{{ $job->job_id }}-0"><i class="active-button"></i></span></td>
                              @endif
                                  <td><a href="{{ route('admin.job.edit') .'?eid='. $job->job_id }}"><i class="edit-button"></i></a></td>
                                  <td><i class="del-button" id="del-{{ $job->job_id }}"></i></td>
                                </tr>  
                            @endforeach
                              </tbody>
                            </table>
                          </div>
                      
                      </section>

                      <nav id="list-pagin">
                      {!! @$job_info->render() !!}
                      </nav>                      
                  </div>
              </div>

<div class="modal fade modal-custom" id="confirm-msg-delete" tabindex="-1" role="dialog" aria-labelledby="ConfirmMsgModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4 class="modal-title">Delete Confirmation</h4>
      <div class="modal-body">
        <p>Are you sure? The Job Title "<span></span>", you will remove from job list.</p>
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
<script type="text/javascript" src="{{ URL::asset('public/backend/js/component/scripts-job.js') }}"></script>
@endsection