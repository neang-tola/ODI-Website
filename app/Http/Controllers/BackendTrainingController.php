<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Models\BackendTrainingModel as Training;
use App\Http\Requests;
use Response;
use AdminHelper;
use Validator;
use Session;
use Auth;
use DB;

class BackendTrainingController extends Controller
{
    public function __construct()
    {
        $chk_role = $this->check_training_role(Auth::user()->role_id);

        if(!empty($chk_role))
        return redirect($chk_role)->send();
    }

    public function index()
    {
        $group_by               = @Input::get('bytype');

        $data['title']          = 'Manage Training information';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.training.list') => 'Manage Training']);
        $data['ind']            = 1;
        $data['group']          = $group_by;
        $data['training_drop']  = 'arrow_carrot-down';
        $data['training_submenu'] = 'style="display:block;"';

        $data['training_info']  = Training::getAllTraining($group_by, 20);
        $data['training_info']->setPath('/internal-bkn/loading-training-list');

        return view('admin.training_list')->with($data);
    }

    public function pagination()
    {
        $print_result       = '';
        $num_currentpage    = Input::get('page');
        $group_by           = @Input::get('bytype');

        $perpage            = 20;
        if(empty($num_currentpage)){
            $offset         = 0;
        }else{
            $offset         = $perpage * ($num_currentpage - 1);
        }

        $training_info      = Training::getAllTraining($group_by, $perpage, $offset);

        if(!empty($training_info)):
            foreach($training_info as $trc):

                if($trc->customize == 0){
                    if($trc->num_record == 0){
                        $link = $trc->num_record;
                    }else{
                        $link = '<a href="'.route('admin.trainingjoined.list').'?training_id='. $trc->trc_id .'">'.$trc->num_record.'</a>';
                    }
                    $feild_customize = '<td>'. AdminHelper::started_date($trc->started_from, $trc->started_to) .'</td>
                                        <td class="price">$ '. $trc->trc_price .'</td>
                                        <td class="count"><span class="badge badge-primary">'. $link .'</span></td>';
                }else{
                    $feild_customize = '<td colspan="3">&nbsp;</td>';
                }

                if($trc->publish == 0){
                    $publish = '<span class="status-t" id="status-'. $trc->trc_id .'-1"><i class="inactive-button"></i></span>';
                }else{
                    $publish = '<span class="status-t" id="status-'. $trc->trc_id .'-0"><i class="active-button"></i></span>';
                }

                $print_result .= '
                                <tr>
                                  <td>'. ++$offset .'</td>
                                  <td><span class="training-title">'. $trc->trc_title .'</span></td>
                                  <td>'. $trc->training_type .'</td>
                                  <td>'. $trc->name .'</td>
                                  '. $feild_customize .'
                                  <td>'. $publish .'</td>
                                  <td><a href="'.route('admin.training.edit').'?eid='. $trc->trc_id .'"><i class="edit-button"></i></a></td>
                                  <td><i class="del-button" id="del-'. $trc->trc_id .'"></i></td>
                                </tr>
                            ';
            endforeach;
        endif;

        echo $print_result;
    }

    public function create()
    {
        $data['title']          = 'Manage Training : New record';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.training.list') => 'Manage Training', 
                                                           route('admin.training.create') => 'New Training']);
        $data['heading_title']  = 'New Training information';
        $data['training_drop']  = 'arrow_carrot-down';
        $data['training_submenu'] = 'style="display:block;"';

        $data['ctrl_parent']    = Training::parentControl();
        $data['my_route']       = route('admin.training.insert');
        $data['chk_validat']    = 'return isValidate_form_training()';
        $data['chk_radio']      = 'checked';
        $data['chk_radio1']     = '';

        return view('admin.training_form')->with($data);
    }

    public function store(Request $request)
    {
        extract($request->input());
        $price_arr  = array();
        $banner_arr = array();
        $img_banner = Input::file('trainingBanner');

        $val_insert = array('trc_title'    => $trainingTitle,
                            'parent_id'    => $trainingType,
                            'trc_status'   => 1,
                            'created_by'   => Auth::user()->id,
                            'customize'    => $trainingCustomize,
                            'trc_content'  => $trainingDescription,
                            'trc_place'    => $trainingPlace,
                            'created_at'   => date('Y-m-d H:i:s'));
        
        if($trainingCustomize == 0){
            $price_arr = array('trc_price'     => $trainingPrice,
                               'started_from'  => Training::updateStartDate($trainingFrom),
                               'started_to'    => Training::updateStartDate($trainingTo),
                               'last_register' => Training::updateStartDate($lastRegister),
                               'trc_language'  => $trainingLang,
                               'trc_duration'  => $trainingDuration,
                               'trc_discount'  => $discountRegister);
        }

        $banner = Training::uploadBanner($img_banner, 'public/banners/');

        if(!empty($banner)){
            $banner_arr= array('trc_banner' => $banner);
        }

        $add_training  = DB::table('tbl_training_course')
                        ->insert(array_merge($val_insert, $price_arr, $banner_arr));

        if($add_training == 1){
           Session::flash('msg', '<div class="alert alert-success" role="alert">Training information have been added <b>successful</b></div>');
        }else{
           Session::flash('msg', '<div class="alert alert-danger" role="alert">Training information was added <b>fail</b></div>');
        }
       
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $search_val   = $request->input('search');
        $group_by     = $request->input('customize');
        $print_result = '';
        $ind = 0;

        if(!empty($search_val)){
            $result_search = Training::findTraining($group_by, $search_val);

            if(!empty($result_search)):
                foreach($result_search as $trc):

                if($trc->customize == 0){
                    if($trc->num_record == 0){
                        $link = $trc->num_record;
                    }else{
                        $link = '<a href="'.route('admin.trainingjoined.list').'?training_id='. $trc->trc_id .'">'.$trc->num_record.'</a>';
                    }
                    $feild_customize = '<td>'. AdminHelper::started_date($trc->started_from, $trc->started_to) .'</td>
                                        <td class="price">$ '. $trc->trc_price .'</td>
                                        <td class="count"><span class="badge badge-primary">'. $link .'</span></td>';
                }else{
                    $feild_customize = '<td colspan="3">&nbsp;</td>';
                }

                if($trc->publish == 0){
                    $publish = '<span class="status-t" id="status-'. $trc->trc_id .'-1"><i class="inactive-button"></i></span>';
                }else{
                    $publish = '<span class="status-t" id="status-'. $trc->trc_id .'-0"><i class="active-button"></i></span>';
                }

                $print_result .= '
                                <tr>
                                  <td>'. ++$ind .'</td>
                                  <td><span class="training-title">'. $trc->trc_title .'</span></td>
                                  <td>'. $trc->training_type .'</td>
                                  <td>'. $trc->name .'</td>
                                  '. $feild_customize .'
                                  <td>'. $publish .'</td>
                                  <td><a href="'.route('admin.training.edit').'?eid='. $trc->trc_id .'"><i class="edit-button"></i></a></td>
                                  <td><i class="del-button" id="del-'. $trc->trc_id .'"></i></td>
                                </tr>
                            ';
                endforeach;
            else:
                $print_result .= '<tr><td colspan="9">
                                    <div class="alert alert-info"><strong>Not found</strong> your key word search not match to Training title.</div>
                                 </td></tr>';
            endif;
        }else{
            $training_info     = Training::getAllTraining($group_by, 20);

            foreach($training_info as $trc):

                if($trc->customize == 0){
                    if($trc->num_record == 0){
                        $link = $trc->num_record;
                    }else{
                        $link = '<a href="'.route('admin.trainingjoined.list').'?training_id='. $trc->trc_id .'">'.$trc->num_record.'</a>';
                    }
                    $feild_customize = '<td>'. AdminHelper::started_date($trc->started_from, $trc->started_to) .'</td>
                                        <td class="price">$ '. $trc->trc_price .'</td>
                                        <td class="count"><span class="badge badge-primary">'. $link .'</span></td>';
                }else{
                    $feild_customize = '<td colspan="3">&nbsp;</td>';
                }

                if($trc->publish == 0){
                    $publish = '<span class="status-t" id="status-'. $trc->trc_id .'-1"><i class="inactive-button"></i></span>';
                }else{
                    $publish = '<span class="status-t" id="status-'. $trc->trc_id .'-0"><i class="active-button"></i></span>';
                }

                $print_result .= '
                                <tr>
                                  <td>'. ++$ind .'</td>
                                  <td><span class="training-title">'. $trc->trc_title .'</span></td>
                                  <td>'. $trc->training_type .'</td>
                                  <td>'. $trc->name .'</td>
                                  '. $feild_customize .'
                                  <td>'. $publish .'</td>
                                  <td><a href="'.route('admin.training.edit').'?eid='. $trc->trc_id .'"><i class="edit-button"></i></a></td>
                                  <td><i class="del-button" id="del-'. $trc->trc_id .'"></i></td>
                                </tr>
                            ';
            endforeach;         
        }

        echo $print_result;
    }

    public function edit()
    {
        $training_id  = Input::get('eid');
        
        $data['title']          = 'Manage Training : Edit record';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.training.list') => 'Manage Training', 
                                                           route('admin.training.edit') => 'Edit Training']);

        $data['heading_title']  = 'Edit Training information';
        $data['ctrl_parent']    = Training::parentControl();
        $data['info']           = Training::getOneRow($training_id);
        $data['my_route']       = route('admin.training.update');
        $data['training_drop']  = 'arrow_carrot-down';
        $data['training_submenu'] = 'style="display:block;"';

        if($data['info']->customize == 1){// Check value for form display
            $data['style']      = 'style="display: none;"';
            $data['chk_validat']= 'return isValidate_training()';
            $data['chk_radio']  = '';
            $data['chk_radio1'] = 'checked';
        }else{
            $data['style']      = '';
            $data['chk_validat']= 'return isValidate_form_training()';
            $data['chk_radio']  = 'checked';
            $data['chk_radio1'] = '';
        }
        return view('admin.training_form')->with($data);
    }

    public function update(Request $request)
    {
        extract($request->input());
        $price_arr  = array();
        $banner_arr = array();
        $img_banner = Input::file('trainingBanner');

        $val_insert = array('trc_title'    => $trainingTitle,
                            'parent_id'    => $trainingType,
                            'customize'    => $trainingCustomize,
                            'trc_place'    => $trainingPlace,
                            'trc_content'  => $trainingDescription);

        if($trainingCustomize == 0){
            $price_arr = array('trc_price'     => $trainingPrice,
                               'started_from'  => Training::updateStartDate($trainingFrom),
                               'started_to'    => Training::updateStartDate($trainingTo),
                               'last_register' => Training::updateStartDate($lastRegister),
                               'trc_language'  => $trainingLang,
                               'trc_duration'  => $trainingDuration,
                               'trc_discount'  => $discountRegister);
        }

        $banner = Training::uploadBanner($img_banner, 'public/banners/');

        if(!empty($banner)){
            $banner_arr= array('trc_banner' => $banner);
        }

        $up_training   = DB::table('tbl_training_course')
                        ->where('trc_id', '=', $trainingId)
                        ->update(array_merge($val_insert, $price_arr, $banner_arr));

        if($up_training == 1){
           Session::flash('msg', '<div class="alert alert-success" role="alert">Training information have been updated <b>successful</b></div>');
        }else{
           Session::flash('msg', '<div class="alert alert-danger" role="alert">Training information was updated <b>fail</b></div>');
        }
        
        return redirect()->back();
    }

    public function destroy()
    {
        $trc_delete     = Input::get('did');

        if(is_numeric($trc_delete)){
            $destroy    = Training::where('trc_id', '=', $trc_delete)->delete();

            if($destroy == 1):
                echo 'success';
            else:
                echo 'error';
            endif;     
        }
    }

    public function updateStatus()
    {
        $training_status = explode('-', Input::get('tid'));
   
        if(count($training_status) == 2){
            $training    = Training::where('trc_id', '=', $training_status[0])
                                    ->update(['publish' => $training_status[1]]);

            if(!empty($training)):
                echo 'success';
            else:
                echo 'error';
            endif;
        }
    }

    public function groupTraining()
    {
        $group_by = Input::get('bytype');

        $count_record = Training::countGroup($group_by);
        $print_result = '';
        $ind = 0;

        if(is_numeric($group_by)){

            $result_filter = Training::getAllTraining($group_by, 20);

            foreach($result_filter as $trc):

                if($trc->customize == 0){
                    if($trc->num_record == 0){
                        $link = $trc->num_record;
                    }else{
                        $link = '<a href="'.route('admin.trainingjoined.list').'?training_id='. $trc->trc_id .'">'.$trc->num_record.'</a>';
                    }
                    $feild_customize = '<td>'. AdminHelper::started_date($trc->started_from, $trc->started_to) .'</td>
                                        <td class="price">$ '. $trc->trc_price .'</td>
                                        <td class="count"><span class="badge badge-primary">'. $link .'</span></td>';
                }else{
                    $feild_customize = '<td colspan="3">&nbsp;</td>';
                }

                if($trc->publish == 0){
                    $publish = '<span class="status-t" id="status-'. $trc->trc_id .'-1"><i class="inactive-button"></i></span>';
                }else{
                    $publish = '<span class="status-t" id="status-'. $trc->trc_id .'-0"><i class="active-button"></i></span>';
                }

                $print_result .= '
                                    <tr>
                                      <td>'. ++$ind .'</td>
                                      <td><span class="training-title">'. $trc->trc_title .'</span></td>
                                      <td>'. $trc->training_type .'</td>
                                      <td>'. $trc->name .'</td>
                                      '. $feild_customize .'
                                      </td>'. $publish .'</td>
                                      <td><a href="'.route('admin.training.edit').'?eid='. $trc->trc_id .'"><i class="edit-button"></i></a></td>
                                      <td><i class="del-button" id="del-'. $trc->trc_id .'"></i></td>
                                    </tr>
                                ';
            endforeach;
        }else{
            $training_info     = Training::getAllTraining($group_by, 20);

            foreach($training_info as $trc):

                if($trc->customize == 0){
                    $feild_customize = '<td>'. AdminHelper::started_date($trc->started_from, $trc->started_to) .'</td>
                                        <td class="price">$ '. $trc->trc_price .'</td>
                                        <td class="count">'. AdminHelper::count_joind($trc->trc_id) .'</td>
                                        ';
                }else{
                    $feild_customize = '<td colspan="3">&nbsp;</td>';
                }

                if($trc->publish == 0){
                    $publish = '<span class="status-t" id="status-'. $trc->trc_id .'-1"><i class="inactive-button"></i></span>';
                }else{
                    $publish = '<span class="status-t" id="status-'. $trc->trc_id .'-0"><i class="active-button"></i></span>';
                }

                $print_result .= '
                                    <tr>
                                      <td>'. ++$ind .'</td>
                                      <td><span class="training-title">'. $trc->trc_title .'</span></td>
                                      <td>'. $trc->training_type .'</td>
                                      <td>'. $trc->name .'</td>
                                      '. $feild_customize .'
                                      <td>'. $publish .'</td>
                                      <td><a href="'.route('admin.training.edit').'?eid='. $trc->trc_id .'"><i class="edit-button"></i></a></td>
                                      <td><i class="del-button" id="del-'. $trc->trc_id .'"></i></td>
                                    </tr>
                                ';
            endforeach;         
        }

        $num_page = floor($count_record/20);
        $result   = array('num_page' => $num_page, 'result' => $print_result);
        echo json_encode($result);
    
    }

    public function listType()
    {
        $data['title']          = 'Manage Training Type';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.trainingtype.list') => 'Manage Training Type']);
        $data['training_drop']  = 'arrow_carrot-down';
        $data['training_submenu'] = 'style="display:block;"';

        $data['ind']            = 1;
        $data['type_info']      = Training::getAllTrainingType(20);
        $data['type_info']->setPath('/internal-bkn/loading-training-type-list');

        return view('admin.training_type_list')->with($data);
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

        $training_info      = Training::getAllTrainingType($perpage, $offset);

        if(!empty($training_info)):
            foreach($training_info as $trc):

                $print_result .= '
                                <tr>
                                  <td>'. ++$offset .'</td>
                                  <td><span class="training-title">'. $trc->trc_title .'</span></td>
                                  <td>'. date('d F, Y', strtotime($trc->created_at)) .'</td>
                                  <td><i class="edit-button" id="edit-'. $trc->trc_id .'"></i></td>
                                  <td><i class="del-button" id="del-'. $trc->trc_id .'"></i></td>
                                </tr>
                            ';

            endforeach;
        endif;

        echo $print_result;
    }

    public function insertType()
    {
        $title = Input::get('int_title');
        $trc_id= Input::get('tid');

        $print_result = '';
        $ind   = 0;
        if(!empty($title)){
          
            if(!empty($title)){

                if(is_numeric($trc_id)){ 
                    $my_training = Training::updateTraining($title, $trc_id);
                }else{
                    $my_training = Training::insertTraining($title);
                }

                if($my_training == true){
                    $training_info = Training::getAllTrainingType(20);

                    foreach($training_info as $trc){
                        $print_result .= '
                                <tr>
                                  <td>'. ++$ind .'</td>
                                  <td><span class="training-title">'. $trc->trc_title .'</span></td>
                                  <td>'. date('d F, Y', strtotime($trc->created_at)) .'</td>
                                  <td><i class="edit-button" id="edit-'. $trc->trc_id .'"></i></td>
                                  <td><i class="del-button" id="del-'. $trc->trc_id .'"></i></td>
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
        $trc_delete      = Input::get('did');

        if(is_numeric($trc_delete)){
            $destroy    = DB::table('tbl_training_course')
                            ->where('trc_id', '=', $trc_delete)
                            ->update(['trc_status' => 0]);

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
            $result_search = Training::findTrainingType($search_val);

            if(!empty($result_search)):
                foreach($result_search as $trc):

                    $print_result .= '
                                <tr>
                                  <td>'. ++$ind .'</td>
                                  <td><span class="training-title">'. $trc->trc_title .'</span></td>
                                  <td>'. date('d F, Y', strtotime($trc->created_at)) .'</td>
                                  <td><i class="edit-button" id="edit-'. $trc->trc_id .'"></i></td>
                                  <td><i class="del-button" id="del-'. $trc->trc_id .'"></i></td>
                                </tr>
                            ';
                endforeach;
            else:
                $print_result .= '<tr><td colspan="5">
                                    <div class="alert alert-info"><strong>Not found</strong> your key word search not match to Training type title.</div>
                                 </td></tr>';
            endif;
        }else{
            $training_info     = Training::getAllTrainingType(20);

            foreach($training_info as $trc):

                    $print_result .= '
                                <tr>
                                  <td>'. ++$ind .'</td>
                                  <td><span class="training-title">'. $trc->trc_title .'</span></td>
                                  <td>'. date('d F, Y', strtotime($trc->created_at)) .'</td>
                                  <td><i class="edit-button" id="edit-'. $trc->trc_id .'"></i></td>
                                  <td><i class="del-button" id="del-'. $trc->trc_id .'"></i></td>
                                </tr>
                            ';
            endforeach;         
        }

        echo $print_result;
    }

    static function joinedTraining()
    {
        $training_id = @Input::get('training_id');

        $data['title']          = 'Manage People Joined Training';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.training.list') => 'Manage Training',
                                                           route('admin.trainingjoined.list') => 'Paticipants']);
        $data['training_drop']  = 'arrow_carrot-down';
        $data['training_submenu'] = 'style="display:block;"';
        
        $data['ind']            = 1;
        $data['training_id']    = $training_id;
        $data['join_info']      = Training::getAllTrainingJoin($training_id, 20);
        $data['join_info']->setPath('/internal-bkn/loading-training-joined-list');

        return view('admin.training_joined_list')->with($data);
    }

    static function joinedPagination()
    {
        $print_result       = '';
        $num_currentpage    = Input::get('page');
        $training_id        = @Input::get('trnid');
    
        $perpage            = 20;
        if(empty($num_currentpage)){
            $offset         = 0;
        }else{
            $offset         = $perpage * ($num_currentpage - 1);
        }

        $training_info      = Training::getAllTrainingJoin($training_id, $perpage, $offset);

        if(!empty($training_info)):
            foreach($training_info as $trc):

                $print_result .= '
                                <tr>
                                  <td>'. ++$offset .'</td>
                                  <td>'. $trc->full_name .'</td>
                                  <td>'. $trc->company .'</td>
                                  <td>'. $trc->position .'</td>
                                  <td>'. $trc->trc_title .'</td>
                                  <td>'. $trc->email .'</td>
                                  <td>'. $trc->phone .' / '. $trc->phone_paticipant .'</td>
                                  <td>'. date('d F, Y', strtotime($trc->created_at)) .'</td>
                                  <td>'. AdminHelper::ctrl_joined_status($trc->status, $trc->id) .'</td>
                                </tr>
                            ';

            endforeach;
        endif;

        echo $print_result;
    }

    static function joinedSearch(Request $request)
    {
        $search_val   = $request->input('search');
        $training_id  = $request->input('training_id');

        $print_result = '';
        $ind = 0;

        if(!empty($search_val)){
            $result_search = Training::findTrainingJoin($training_id, $search_val);

            if(!empty($result_search)):
                foreach($result_search as $trc):

                    $print_result .= '
                                <tr>
                                  <td>'. ++$ind .'</td>
                                  <td>'. $trc->full_name .'</td>
                                  <td>'. $trc->company .'</td>
                                  <td>'. $trc->position .'</td>
                                  <td>'. $trc->trc_title .'</td>
                                  <td>'. $trc->email .'</td>
                                  <td>'. $trc->phone .' / '. $trc->phone_paticipant .'</td>
                                  <td>'. date('d F, Y', strtotime($trc->created_at)) .'</td>
                                  <td>'. AdminHelper::ctrl_joined_status($trc->status, $trc->id) .'</td>
                                </tr>
                            ';
                endforeach;
            else:
                $print_result .= '<tr><td colspan="9">
                                    <div class="alert alert-info"><strong>Not found</strong> your key word search not match to Training type title.</div>
                                 </td></tr>';
            endif;
        }else{
            $training_info     = Training::getAllTrainingJoin($training_id, 20);

            foreach($training_info as $trc):

                    $print_result .= '
                                <tr>
                                  <td>'. ++$ind .'</td>
                                  <td>'. $trc->full_name .'</td>
                                  <td>'. $trc->company .'</td>
                                  <td>'. $trc->position .'</td>
                                  <td>'. $trc->trc_title .'</td>
                                  <td>'. $trc->email .'</td>
                                  <td>'. $trc->phone .' / '. $trc->phone_paticipant .'</td>
                                  <td>'. date('d F, Y', strtotime($trc->created_at)) .'</td>
                                  <td>'. AdminHelper::ctrl_joined_status($trc->status, $trc->id) .'</td>
                                </tr>
                            ';
            endforeach;         
        }

        echo $print_result;

    }

    static function joinedStatus()
    {
        $join_id    = Input::get('joinid');
        $status_val = Input::get('status');
        $html       = '';

        if(!empty($join_id)){
            $up_status = DB::table('tbl_join_training')
                            ->where('id', '=', $join_id)
                            ->update(['status' => $status_val]);

            if($up_status == 1){
                $html = AdminHelper::ctrl_joined_status($status_val, $join_id);
            }
        }

        echo $html;
    }
}
