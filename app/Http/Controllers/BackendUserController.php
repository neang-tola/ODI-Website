<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Models\BackendUserModel as User;
use App\Http\Requests;
use AdminHelper;
use Session;
use Hash;
use Auth;
use DB;

class BackendUserController extends Controller
{
    public function __construct()
    {
        $chk_role = $this->check_user_role(Auth::user()->role_id);

        if(!empty($chk_role))
        return redirect($chk_role)->send();
    }
    
    public function index()
    {
        $data['title']          = 'Manage User list';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.user.list') => 'Manage User']);
        $data['ind']            = 1;
        $data['user_info']      = User::getAllUsers(20);
        $data['user_info']->setPath('/internal-bkn/loading-user-list');

        return view('admin.user_list')->with($data);
    }

    public function pagination()
    {
        $print_result       = '';
        $num_currentpage    = Input::get('page');
    
        $perpage            = 20;
        if(empty($num_currentpage)){
            $offset         = 0;
        }else{
            $offset         = $perpage * ($num_currentpage - 1);
        }

        $user_info       = User::getAllUsers($perpage, $offset);

        if(!empty($user_info)):
            foreach($user_info as $u):
                if($u->id == 1 || $u->id == Auth::user()->id){
                    $delete = '&nbsp;';
                }else{
                    $delete = '<i class="del-button" id="del-'. $u->id .'"></i>';
                }
                $print_result .= '
                                <tr>
                                  <td>'. ++$offset .'</td>
                                  <td><span class="user-name">'. $u->name .'</span></td>
                                  <td>'. $u->email .'</td>
                                  <td>'. AdminHelper::Role($u->role_id) .'</td>
                                  <td><a href="'. route('admin.user.edit') .'?uid='. $u->id .'"><i class="edit-button"></i></a></td>
                                  <td>'. $delete .'</td>
                                </tr>
                            ';
            endforeach;
        endif;

        echo $print_result;
    }

    public function create()
    {
        $data['title']          = 'Manage user : New User';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.user.list') => 'Manage User', 
                                                           route('admin.user.create') => 'New User']);
        $data['heading_title']  = 'New User information';
        $data['my_route']       = route('admin.user.store');
        $data['chk_validat']    = 'return isValidate_form_user();';

        return view('admin.user_form')->with($data);
    }

    public function store(Request $request)
    {
        extract($request->input());

        $insert_val = array('name'  => $userName,
                            'email' => $userEmail,
                            'password'       => Hash::make($userPassword),
                            'role_id'        => $userRole,
                            'remember_token' => csrf_token(),
                            'created_at'     => date('Y-m-d H:i:s'),
                            'updated_at'     => date('Y-m-d H:i:s'));

        $add_user   = DB::table('users')->insert($insert_val); 

        if($add_user == 1){
            Session::flash('msg', '<div class="alert alert-success" role="alert">User information have been added <b>successful</b></div>');
        }else{
            Session::flash('msg', '<div class="alert alert-danger" role="alert">User information was added <b>fail</b></div>');
        }

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $search_val   = $request->input('search');
        $print_result = '';
        $ind = 0;

        if(!empty($search_val)){
            $result_search = User::findUser($search_val);

            if(!empty($result_search)):
                foreach($result_search as $u):
                    if($u->id == 1 || $u->id == Auth::user()->id){
                        $delete = '&nbsp;';
                    }else{
                        $delete = '<i class="del-button" id="del-'. $u->id .'"></i>';
                    }

                    $print_result .= '
                                    <tr>
                                      <td>'. ++$ind .'</td>
                                      <td><span class="user-name">'. $u->name .'</span></td>
                                      <td>'. $u->email .'</td>
                                      <td>'. AdminHelper::Role($u->role_id) .'</td>
                                      <td><a href="'. route('admin.user.edit') .'?uid='. $u->id .'"><i class="edit-button"></i></a></td>
                                      <td>'. $delete .'</td>
                                    </tr>
                                ';
                endforeach;
            else:
                $print_result .= '<tr><td colspan="6">
                                    <div class="alert alert-info"><strong>Not found</strong> your key word search not match to User Name.</div>
                                 </td></tr>';
            endif;
        }else{
            $user_info     = User::getAllUsers(20);

            foreach($user_info as $u):
                if($u->id == 1 || $u->id == Auth::user()->id){
                    $delete = '&nbsp;';
                }else{
                    $delete = '<i class="del-button" id="del-'. $u->id .'"></i>';
                }

                $print_result .= '
                                    <tr>
                                      <td>'. ++$ind .'</td>
                                      <td><span class="user-name">'. $u->name .'</span></td>
                                      <td>'. $u->email .'</td>
                                      <td>'. AdminHelper::Role($u->role_id) .'</td>
                                      <td><a href="'. route('admin.user.edit') .'?uid='. $u->id .'"><i class="edit-button"></i></a></td>
                                      <td>'. $delete .'</td>
                                    </tr>
                                ';
            endforeach;         
        }

        echo $print_result;
    }

    public function edit()
    {
        $user_id  = Input::get('uid');

        $data['title']          = 'Manage User : Edit User';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.user.list') => 'Manage User', 
                                                           route('admin.user.edit') => 'Edit User']);
        $data['heading_title']  = 'Edit User information';
        $data['info']           = User::getOneRow($user_id);
        $data['my_route']       = route('admin.user.update');
        $data['chk_validat']    = 'return isValidate_update_user();';        

        return view('admin.user_form')->with($data);
    }

    public function update(Request $request)
    {
        extract($request->input());
        $reset = array();

        if(!empty($userPassword)){
            $reset  = array('password' => Hash::make($userPassword));
        }

        $update_val = array('name'  => $userName,
                            'email' => $userEmail,
                            'role_id'        => $userRole,
                            'updated_at'     => date('Y-m-d H:i:s'));

        $up_user    = DB::table('users')
                        ->where('id', $userId)
                        ->update(array_merge($update_val, $reset)); 

        if($up_user == 1){
            Session::flash('msg', '<div class="alert alert-success" role="alert">User information have been updated <b>successful</b></div>');
        }else{
            Session::flash('msg', '<div class="alert alert-danger" role="alert">User information was updated <b>fail</b></div>');
        }

        return redirect()->back();
    }

    public function destroy()
    {
        $user_delete    = Input::get('did');

        if(is_numeric($user_delete)){
            $destroy    = User::deleteUser($user_delete);

            if($destroy == 1):
                echo 'success';
            else:
                echo 'error';
            endif;     
        }
    }

    public function updateStatus()
    {
        $cat_status   = explode('-', Input::get('cid'));
   
        if(count($cat_status) == 2){
            $category = Category::where('cat_id', '=', $cat_status[0])
                       ->update(['cat_status' => $cat_status[1]]);

            if(!empty($category)):
                echo 'success';
            else:
                echo 'error';
            endif;
        }
    }
}
