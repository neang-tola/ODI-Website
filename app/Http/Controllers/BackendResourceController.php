<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Models\BackendResourceModel as Resource;
use App\Http\Requests;
use Response;
use AdminHelper;
use Validator;
use Session;
use DB;
use Auth;

class BackendResourceController extends Controller
{
    public function __construct()
    {
        $chk_role = $this->check_user_role(Auth::user()->role_id);

        if(!empty($chk_role))
        return redirect($chk_role)->send();
    }

    public function index()
    {
        $data['title']          = 'Manage Resource information';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.resource.list') => 'Manage Resource']);
        $data['resource_drop']  = 'arrow_carrot-down';
        $data['resource_submenu'] = 'style="display:block;"';

        $data['ind']            = 1;
        $data['resource_info']  = Resource::getAllResource(20);
        $data['resource_info']->setPath('/internal-bkn/loading-resource-list');

        return view('admin.resource_list')->with($data);
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

        $resource_info      = Resource::getAllResource($perpage, $offset);

        if(!empty($resource_info)):
            foreach($resource_info as $res):
                if(!empty($res->res_file)){
                    $file = '<a href="'. route('admin.resource.download') .'?document_file='. $res->res_file .'" class="down-source">
                                <i class="fa fa-download"></i>
                             </a><span class="preview-resource" id="'. $res->res_file .'"><i class="fa fa-eye"></i></span>';
                }

                $print_result .= '
                                <tr>
                                  <td>'. ++$offset .'</td>
                                  <td><span class="resource-title">'. $res->res_title .'</span></td>
                                  <td>'. $res->resource_type .'</td>
                                  <td>'. @$file .'</td>
                                  <td><a href="'.route('admin.resource.edit').'?eid='. $res->res_id .'"><i class="edit-button"></i></a></td>
                                  <td><i class="del-button" id="del-'. $res->res_id .'"></i></td>
                                </tr>
                            ';
            endforeach;
        endif;

        echo $print_result;
    }

    public function create()
    {
        $data['title']          = 'Manage Resource : New record';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.resource.list') => 'Manage Resource', 
                                                           route('admin.resource.create') => 'New Resource']);
        $data['heading_title']  = 'New Resource information';
        $data['resource_drop']  = 'arrow_carrot-down';
        $data['resource_submenu'] = 'style="display:block;"';

        $data['ctrl_parent']    = Resource::parentControl();

        return view('admin.resource_form')->with($data);
    }

    public function store(Request $request)
    {
        extract($request->input());
        
        $document   = Input::file('resourceDoc');

        $rules = array('document' => 'required|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,pptm'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
        $validator = Validator::make(array('document'=> $document), $rules);

        if($validator->passes()){
            $resource_doc= Resource::uploadDocument($document, 'public/files');

            $val_insert = array('res_title'    => $resourceTitle,
                                'parent_id'    => $resourceType,
                                'res_status'   => 1,
                                'res_file'     => @$resource_doc,
                                'created_at'   => date('Y-m-d H:i:s'));

            $add_resource= DB::table('tbl_resource')->insert($val_insert);

            if($add_resource == 1){
                Session::flash('msg', '<div class="alert alert-success" role="alert">Resource information have been added <b>successful</b></div>');
            }else{
                Session::flash('msg', '<div class="alert alert-danger" role="alert">Resource information was added <b>fail</b></div>');
            }
        }else{
            Session::flash('msg', '<div class="alert alert-danger" role="alert">Document upload <b>fail</b>. We allow only(pdf, doc, docx, xls, xlsx, ppt, pptx, pptm) extension. Maximum file size 10MB.</div>');
        }
        return redirect()->back();
    }

    public function download()
    {
        $file_name   = Input::get('document_file');

        if(!empty($file_name)){
            //$my_file = explode('_', $file_name, 2);
            $file    = "./public/files/".$file_name;
            return Response::download($file);
        }
    }

    public function search(Request $request)
    {
        $search_val   = $request->input('search');
        $print_result = '';
        $ind = 0;

        if(!empty($search_val)){
            $result_search = Resource::findResource($search_val);

            if(!empty($result_search)):
                foreach($result_search as $res):

                if(!empty($res->res_file)){
                    $file = '<a href="'. route('admin.resource.download') .'?document_file='. $res->res_file .'" class="down-source">
                                <i class="fa fa-download"></i>
                             </a><span class="preview-resource" id="'. $res->res_file .'"><i class="fa fa-eye"></i></span>';
                }

                    $print_result .= '
                                <tr>
                                  <td>'. ++$ind .'</td>
                                  <td><span class="resource-title">'. $res->res_title .'</span></td>
                                  <td>'. $res->resource_type .'</td>
                                  <td>'. @$file .'</td>
                                  <td><a href="'.route('admin.resource.edit').'?eid='. $res->res_id .'"><i class="edit-button"></i></a></td>
                                  <td><i class="del-button" id="del-'. $res->res_id .'"></i></td>
                                </tr>
                            ';
                endforeach;
            else:
                $print_result .= '<tr><td colspan="6">
                                    <div class="alert alert-info"><strong>Not found</strong> your key word search not match to Resource title.</div>
                                 </td></tr>';
            endif;
        }else{
            $resource_info     = Resource::getAllResource(20);

            foreach($resource_info as $res):

                if(!empty($res->res_file)){
                    $file = '<a href="'. route('admin.resource.download') .'?document_file='. $res->res_file .'" class="down-source">
                                <i class="fa fa-download"></i>
                             </a><span class="preview-resource" id="'. $res->res_file .'"><i class="fa fa-eye"></i></span>';
                }
                
                    $print_result .= '
                                <tr>
                                  <td>'. ++$ind .'</td>
                                  <td><span class="resource-title">'. $res->res_title .'</span></td>
                                  <td>'. $res->resource_type .'</td>
                                  <td>'. @$file .'</td>
                                  <td><a href="'.route('admin.resource.edit').'?eid='. $res->res_id .'"><i class="edit-button"></i></a></td>
                                  <td><i class="del-button" id="del-'. $res->res_id .'"></i></td>
                                </tr>
                            ';
            endforeach;         
        }

        echo $print_result;
    }

    public function edit()
    {
        $resource_id  = Input::get('eid');

        $data['title']          = 'Manage Resource : Edit record';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.resource.list') => 'Manage Resource', 
                                                           route('admin.resource.edit') => 'Edit Resource']);
        $data['heading_title']  = 'Edit Resource information';
        $data['resource_drop']  = 'arrow_carrot-down';
        $data['resource_submenu'] = 'style="display:block;"';

        $data['ctrl_parent']    = Resource::parentControl();
        $data['info']           = Resource::getOneRow($resource_id);

        return view('admin.resource_form')->with($data);
    }

    public function update(Request $request)
    {
        extract($request->input());
        $up_doc    = array();
        $document  = Input::file('resourceDoc');

        $rules     = array('document' => 'required|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,pptm'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
        $validator = Validator::make(array('document' => $document), $rules);


        if($validator->passes()){
            $resource_doc= Resource::uploadDocument($document, 'public/files');
            if(!empty($resource_doc)){
                Resource::removeDocument($resourceId); // remove old file from folder
                $up_doc  = array('res_file' => $resource_doc); 
            }
        }   

            $val_update  = array('res_title'    => $resourceTitle,
                                'parent_id'    => $resourceType,
                                'res_status'   => 1,
                                'updated_at'   => date('Y-m-d H:i:s'));

            $up_resource = DB::table('tbl_resource')
                            ->where('res_id', '=', $resourceId)
                            ->update(array_merge($val_update, $up_doc));

        if($up_resource == 1){
                Session::flash('msg', '<div class="alert alert-success" role="alert">Resource information have been updated <b>successful</b></div>');
        }else{
                Session::flash('msg', '<div class="alert alert-danger" role="alert">Resource information was updated <b>fail</b></div>');
        }
        
        return redirect()->back();
    }

    public function destroy()
    {
        $res_delete     = Input::get('did');

        if(is_numeric($res_delete)){
            $destroy    = Resource::removeResource($res_delete);

            if($destroy == 1):
                echo 'success';
            else:
                echo 'error';
            endif;     
        }
    }

    public function listType()
    {
        $data['title']          = 'Manage Resource Type';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.resourcetype.list') => 'Manage Resource Type']);
        $data['resource_drop']  = 'arrow_carrot-down';
        $data['resource_submenu'] = 'style="display:block;"';
        
        $data['ind']            = 1;
        $data['type_info']      = Resource::getAllResourceType(20);
        $data['type_info']->setPath('/internal-bkn/loading-resource-type-list');

        return view('admin.resource_type_list')->with($data);
    }

    public function paginationType()
    {
        $print_result       = '';
        $num_currentpage    = Input::get('page');
    
        $perpage            = 20;
        if(empty($num_currentpage)){
            $offset         = 0;
        }else{
            $offset         = $perpage * ($num_currentpage - 1);
        }

        $resource_info      = Resource::getAllResourceType($perpage, $offset);

        if(!empty($resource_info)):
            foreach($resource_info as $res):

                $print_result .= '
                                <tr>
                                  <td>'. ++$offset .'</td>
                                  <td><span class="resource-title">'. $res->res_title .'</span></td>
                                  <td>'. date('d F, Y', strtotime($res->created_at)) .'</td>
                                  <td><i class="edit-button" id="edit-'. $res->res_id .'"></i></td>
                                  <td><i class="del-button" id="del-'. $res->res_id .'"></i></td>
                                </tr>
                            ';

            endforeach;
        endif;

        echo $print_result;
    }

    public function insertType()
    {
        $title = Input::get('int_title');
        $res_id= Input::get('rid');

        $print_result = '';
        $ind   = 0;
        if(!empty($title)){
          
            if(!empty($title)){

                if(is_numeric($res_id)){ 
                    $my_resource = Resource::updateResource($title, $res_id);
                }else{
                    $my_resource = Resource::insertResource($title);
                }

                if($my_resource == true){
                    $resource_info = Resource::getAllResourceType(20);

                    foreach($resource_info as $res){
                        $print_result .= '
                                <tr>
                                  <td>'. ++$ind .'</td>
                                  <td><span class="resource-title">'. $res->res_title .'</span></td>
                                  <td>'. date('d F, Y', strtotime($res->created_at)) .'</td>
                                  <td><i class="edit-button" id="edit-'. $res->res_id .'"></i></td>
                                  <td><i class="del-button" id="del-'. $res->res_id .'"></i></td>
                                </tr>
                            ';
                    }
                }
            }
        }
        echo $print_result;
    }

    public function deleteType()
    {
        $res_delete      = Input::get('did');

        if(is_numeric($res_delete)){
            $destroy    = DB::table('tbl_resource')
                            ->where('res_id', '=', $res_delete)
                            ->update(['res_status' => 0]);

            if($destroy == 1):
                echo 'success';
            else:
                echo 'error';
            endif;     
        }
    }

    public function searchType(Request $request)
    {
        $search_val   = $request->input('search');
        $print_result = '';
        $ind = 0;

        if(!empty($search_val)){
            $result_search = Resource::findResourceType($search_val);

            if(!empty($result_search)):
                foreach($result_search as $res):

                    $print_result .= '
                                <tr>
                                  <td>'. ++$ind .'</td>
                                  <td><span class="resource-title">'. $res->res_title .'</span></td>
                                  <td>'. date('d F, Y', strtotime($res->created_at)) .'</td>
                                  <td><i class="edit-button" id="edit-'. $res->res_id .'"></i></td>
                                  <td><i class="del-button" id="del-'. $res->res_id .'"></i></td>
                                </tr>
                            ';
                endforeach;
            else:
                $print_result .= '<tr><td colspan="5">
                                    <div class="alert alert-info"><strong>Not found</strong> your key word search not match to Resource type title.</div>
                                 </td></tr>';
            endif;
        }else{
            $resource_info     = Resource::getAllResourceType(20);

            foreach($resource_info as $res):

                    $print_result .= '
                                <tr>
                                  <td>'. ++$ind .'</td>
                                  <td><span class="resource-title">'. $res->res_title .'</span></td>
                                  <td>'. date('d F, Y', strtotime($res->created_at)) .'</td>
                                  <td><i class="edit-button" id="edit-'. $res->res_id .'"></i></td>
                                  <td><i class="del-button" id="del-'. $res->res_id .'"></i></td>
                                </tr>
                            ';
            endforeach;         
        }

        echo $print_result;
    }
}
