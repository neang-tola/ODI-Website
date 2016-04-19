@extends('layouts.master_admin')
@section('main_content')
             <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            {!! Form::open(['url' => route('admin.user.search'), 'class' => 'navbar-form', 'id' => 'find_user']) !!}
                              {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search', 'id' => 'key_word']) !!}
                            {!! Form::close() !!}
                            <div class="pull-right">
                              <a href="{{ route('admin.user.create') }}" class="btn btn-primary">New User</a>
                            </div>
                            <div class="clearfix"></div>
                          </header>
                    
                          <div class="table-responsive">
                            <div class="loading"></div>
                            <table class="table" id="result_output">
                              <thead>
                                <tr>
                                  <th width="5%">#</th>
                                  <th width="25%">User Name</th>
                                  <th width="40%">Email</th>
                                  <th width="10%">Rule</th>
                                  <th width="10%">Edit</th>
                                  <th width="10%">Delete</th>
                                </tr>
                              </thead>
                              <tbody>
                            @foreach($user_info as $user)
                                <tr>
                                  <td>{{ $ind++ }}</td>
                                  <td><span class="user-name">{{ $user->name }}</span></td>
                                  <td>{{ $user->email }}</td>
                                  <td>{{ AdminHelper::Role($user->role_id) }}</td>
                                  <td><a href="{{ route('admin.user.edit') }}?uid={{ $user->id }}"><i class="edit-button"></i></a></td>
                                @if($user->id == 1 || $user->id == Auth::user()->id)
                                  <td>&nbsp;</td>
                                @else
                                  <td><i class="del-button" id="del-{{ $user->id }}"></i></td>
                                @endif
                                </tr>  
                            @endforeach
                    
                              </tbody>
                            </table>
                          </div>
                      
                      </section>

                      <nav id="list-pagin">
                      {!! @$user_info->render() !!}
                      </nav>                      
                  </div>
              </div>

<div class="modal fade modal-custom" id="confirm-msg-delete" tabindex="-1" role="dialog" aria-labelledby="ConfirmMsgModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4 class="modal-title">Delete Confirmation</h4>
      <div class="modal-body">
        <p>Are you sure? User name "<span></span>", you will remove from user list.</p>
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
<script type="text/javascript" src="{{ URL::asset('public/backend/js/component/scripts-user.js') }}"></script>
@endsection