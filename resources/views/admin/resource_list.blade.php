@extends('layouts.master_admin')
@section('main_content')
             <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            {!! Form::open(['url' => route('admin.resource.search'), 'class' => 'navbar-form', 'id' => 'find_resource']) !!}
                              {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search', 'id' => 'key_word']) !!}
                            {!! Form::close() !!}
                            <div class="pull-right">
                              <a href="{{ route('admin.resource.create') }}" class="btn btn-primary">New Resource</a>
                            </div>
                            <div class="clearfix"></div>
                          </header>
                    
                          <div class="table-responsive">
                            <div class="loading"></div>
                            <table class="table" id="result_output">
                              <thead>
                                <tr>
                                  <th width="5%">#</th>
                                  <th width="40%">Title</th>
                                  <th width="20%">Resource Type</th>
                                  <th width="15%">Documentation</th>
                                  <th width="10%">Edit</th>
                                  <th width="10%">Delete</th>
                                </tr>
                              </thead>
                              <tbody>
                            @foreach($resource_info as $res)
                                <tr>
                                  <td>{{ $ind++ }}</td>
                                  <td><span class="resource-title">{{ $res->res_title }}</span></td>
                                  <td>{{ $res->resource_type }}</td>
                              @if(!empty($res->res_file))
                                  <td>
                                    <a href="{{ route('admin.resource.download') }}?document_file={{ $res->res_file }}" class="document-resource"><i class="fa fa-download"></i></a>
                                    <span class="preview-resource" id="{{ $res->res_file }}"><i class="fa fa-eye"></i></span>
                                  </td>
                              @else
                                  <td>&nbsp;</td>
                              @endif
                                  <td><a href="{{ route('admin.resource.edit') }}?eid={{ $res->res_id }}"><i class="edit-button" id="edit-{{ $res->res_id }}"></i></a></td>
                                  <td><i class="del-button" id="del-{{ $res->res_id }}"></i></td>
                                </tr>  
                            @endforeach
                              </tbody>
                            </table>
                          </div>
                      
                      </section>

                      <nav id="list-pagin">
                      {!! @$resource_info->render() !!}
                      </nav>                      
                  </div>
              </div>

<div class="modal fade modal-custom" id="confirm-msg-delete" tabindex="-1" role="dialog" aria-labelledby="ConfirmMsgModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4 class="modal-title">Delete Confirmation</h4>
      <div class="modal-body">
        <p>Are you sure? The Resource Type "<span></span>", you will remove from resource list.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="confirm-ok">Ok</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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

@section('script')
<script type="text/javascript" src="{{ URL::asset('public/backend/js/component/scripts-resource.js') }}"></script>
@endsection