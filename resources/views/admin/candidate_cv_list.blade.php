@extends('layouts.master_admin')
@section('main_content')
             <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            {!! Form::open(['url' => route('admin.candidate.search'), 'class' => 'navbar-form', 'id' => 'find_candidate']) !!}
                              {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search', 'id' => 'key_word']) !!}
                            {!! Form::close() !!}
                          </header>
                    
                          <div class="table-responsive">
                            <div class="loading"></div>
                            <table class="table" id="result_output">
                              <thead>
                                <tr>
                                  <th width="5%">#</th>
                                  <th width="16%">Full Name</th>
                                  <th width="10%">Position</th>
                                  <th width="6%">Gender</th>
                                  <th width="20%">Contact Info.</th>
                                  <th width="15%">Apply for</th>
                                  <th width="6%">Salary</th>
                                  <th width="10%">CVs</th>
                                  <th width="12%">Date Submit</th>
                                </tr>
                              </thead>
                              <tbody>
                            @foreach($cv_info as $cv)
                                <tr>
                                  <td>{{ $ind++ }}</td>
                                  <td>{{ $cv->full_name }}</td>
                                  <td>{{ $cv->position }}</td>
                                  <td>{{ $cv->gender }}</td>
                                  <td>
                                    <i class="fa fa-phone-square"></i> : {{ $cv->phone }}<br/>
                                    <i class="fa fa-envelope-square"></i> : {{ $cv->email }}
                                  </td>
                                  <td>{{ $cv->job_title }}</td>
                                  <td>$ {{ $cv->salary }}</td>
                                  <td>
                                    <a href="{{ route('admin.candidate.download') }}?cv_file={{ $cv->document }}" class="document-resource"><i class="fa fa-download"></i></a>
                                    <span class="preview-resource" id="{{ $cv->document }}"><i class="fa fa-eye"></i></span>
                                  </td>
                                  <td>{{ date('d F, Y', strtotime($cv->created_at)) }}</td>
                                </tr>  
                            @endforeach
                              </tbody>
                            </table>
                          </div>
                      
                      </section>

                      <nav id="list-pagin">
                      {!! @$cv_info->render() !!}
                      </nav>                      
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

@section('script')
<script type="text/javascript" src="{{ URL::asset('public/backend/js/component/scripts-cv.js') }}"></script>
@endsection