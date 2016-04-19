<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Models\BackendJobModel as Recruitment;
use App\Http\Requests;
use AdminHelper;
use Response;
use Session;
use Auth;
use DB;

class BackendRecruitmentController extends Controller
{
    public function __construct()
    {
        $chk_role = $this->check_recruitment_role(Auth::user()->role_id);

        if(!empty($chk_role))
        return redirect($chk_role)->send();
    }

    public function index()
    {
        $data['title']          = 'Manage Recruitment list';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.job.list') => 'Manage Jobs']);
        $data['ind']            = 1;

        $data['recruitment_drop'] = 'arrow_carrot-down';
        $data['recruitment_submenu'] = 'style="display:block;"';

        $data['job_info']       = Recruitment::getAllJobs(20);
        $data['job_info']->setPath('/internal-bkn/loading-job-list');

        return view('admin.job_list')->with($data);
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

        $vacancy_info       = Recruitment::getAllJobs($perpage, $offset);

        if(!empty($vacancy_info)):
            foreach($vacancy_info as $job):

                if($job->publish == 0){
                    $publish = '<span class="status-j" id="status-'. $job->job_id .'-1"><i class="inactive-button"></i></span>';
                }else{
                    $publish = '<span class="status-j" id="status-'. $job->job_id .'-0"><i class="active-button"></i></span>';
                }
                $print_result .= '
                                <tr>
                                  <td>'. ++$offset .'</td>
                                  <td><span class="job-title">'. $job->job_title .'</span></td>
                                  <td>'. $job->cat_name .'</td>
                                  <td>'. $job->loc_name .'</td>
                                  <td>'. $job->name .'</td>
                                  <td>'. date('d, F Y', strtotime($job->close_date)) .'</td>
                                  <td>'. $publish .'</td>
                                  <td><a href="'. route('admin.job.edit') .'?eid='. $job->job_id .'"><i class="edit-button"></i></a></td>
                                  <td><i class="del-button" id="del-'. $job->job_id .'"></i></td>
                                </tr>
                            ';
            endforeach;
        endif;

        echo $print_result;
    }

    public function create()
    {
        $data['title']          = 'Manage Recruitment : New Job vacancy';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.job.list') => 'Manage Jobs', 
                                                           route('admin.job.create') => 'New Job vacancy']);

        $data['my_route']       = route('admin.job.insert');
        $data['heading_title']  = 'New Job information';
        $data['recruitment_drop'] = 'arrow_carrot-down';
        $data['recruitment_submenu'] = 'style="display:block;"';

        $data['closing_date']   = date("d-m-Y", strtotime("+1 month", time()));
        $data['ctrl_category']  = Recruitment::bindingCategory();
        $data['ctrl_location']  = Recruitment::bindingLocation();

        return view('admin.job_form')->with($data);
    }

    public function store(Request $request)
    {
        extract($request->input());

        $val_insert = array('job_title'    => $jobTitle,
                            'cat_id'       => $jobCategory,
                            'loc_id'       => $jobLocation,
                            'close_date'   => Recruitment::changeDateFormat($closeDate),
                            'post_date'    => date('Y-m-d'),
                            'created_by'   => Auth::user()->id,
                            'job_des'      => $jobDescription,
                            'job_required' => $jobRequirement,
                            'how_apply'    => $jobApplyText,
                            'publish'      => $jobPublish,
                            'created_at'   => date('Y-m-d H:i:s'));

        $add_job    = DB::table('tbl_job_vacancy')->insert($val_insert);

        if($add_job == 1){
            
            Session::flash('msg', '<div class="alert alert-success" role="alert">New Job information have been added <b>successful</b></div>');
        }else{
            Session::flash('msg', '<div class="alert alert-danger" role="alert">New Job information was added <b>fail</b></div>');
        }

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $search_val   = $request->input('search');
        $print_result = '';
        $ind = 0;

        if(!empty($search_val)){
            $result_search = Recruitment::findJob($search_val);

            if(!empty($result_search)):
                foreach($result_search as $job):
                    if($job->publish == 0){
                        $publish = '<span class="status-j" id="status-'. $job->job_id .'-1"><i class="inactive-button"></i></span>';
                    }else{
                        $publish = '<span class="status-j" id="status-'. $job->job_id .'-0"><i class="active-button"></i></span>';
                    }

                    $print_result .= '
                                    <tr>
                                      <td>'. ++$ind .'</td>
                                      <td><span class="job-title">'. $job->job_title .'</span></td>
                                      <td>'. $job->cat_name .'</td>
                                      <td>'. $job->loc_name .'</td>
                                      <td>'. $job->name .'</td>
                                      <td>'. date('d, F Y', strtotime($job->close_date)) .'</td>
                                      <td>'. $publish .'</td>
                                      <td><a href="'. route('admin.job.edit') .'?eid='. $job->job_id .'"><i class="edit-button"></i></a></td>
                                      <td><i class="del-button" id="del-'. $job->job_id .'"></i></td>
                                    </tr>
                                ';
                endforeach;
            else:
                $print_result .= '<tr><td colspan="8">
                                    <div class="alert alert-info"><strong>Not found</strong> your key word search not match to Job title.</div>
                                 </td></tr>';
            endif;
        }else{
            $vacancy_info     = Recruitment::getAllJobs(20);

            foreach($vacancy_info as $job):

                if($job->publish == 0){
                    $publish = '<span class="status-j" id="status-'. $job->job_id .'-1"><i class="inactive-button"></i></span>';
                }else{
                    $publish = '<span class="status-j" id="status-'. $job->job_id .'-0"><i class="active-button"></i></span>';
                }
                $print_result .= '
                                    <tr>
                                      <td>'. ++$ind .'</td>
                                      <td><span class="job-title">'. $job->job_title .'</span></td>
                                      <td>'. $job->cat_name .'</td>
                                      <td>'. $job->loc_name .'</td>
                                      <td>'. $job->name .'</td>
                                      <td>'. date('d, F Y', strtotime($job->close_date)) .'</td>
                                      <td>'. $publish .'</td>
                                      <td><a href="'. route('admin.job.edit') .'?eid='. $job->job_id .'"><i class="edit-button"></i></a></td>
                                      <td><i class="del-button" id="del-'. $job->job_id .'"></i></td>
                                    </tr>
                                ';
            endforeach;         
        }

        echo $print_result;
    }

    public function edit()
    {
        $job_id  = Input::get('eid');

        $data['title']          = 'Manage Jov vacancy : Edit job vacancy';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.job.list') => 'Manage Jobs', 
                                                           route('admin.job.edit') => 'Edit job vacancy']);

        $data['my_route']       = route('admin.job.update');
        $data['heading_title']  = 'Edit Job information';
        $data['recruitment_drop'] = 'arrow_carrot-down';
        $data['recruitment_submenu'] = 'style="display:block;"';

        $data['info']           = Recruitment::getOneRow($job_id);
        $data['ctrl_category']  = Recruitment::bindingCategory();
        $data['ctrl_location']  = Recruitment::bindingLocation();

        return view('admin.job_form')->with($data);
    }

    public function update(Request $request)
    {
        extract($request->input());

        $val_update = array('job_title'    => $jobTitle,
                            'cat_id'       => $jobCategory,
                            'loc_id'       => $jobLocation,
                            'close_date'   => Recruitment::changeDateFormat($closeDate),
                            'job_des'      => $jobDescription,
                            'job_required' => $jobRequirement,
                            'how_apply'    => $jobApplyText,
                            'publish'      => $jobPublish,
                            'updated_at'   => date('Y-m-d H:i:s'));

        $up_job     = DB::table('tbl_job_vacancy')->where('job_id', '=', $jobId)->update($val_update);

        if($up_job == 1){

            Session::flash('msg', '<div class="alert alert-success" role="alert">Job information have been updated <b>successful</b></div>');
        }else{
            Session::flash('msg', '<div class="alert alert-danger" role="alert">Job information was updated <b>fail</b></div>');
        }

        return redirect()->back();
    }

    public function destroy()
    {
        $job_delete     = Input::get('did');

        if(is_numeric($job_delete)){
            $destroy    = Recruitment::where('job_id', '=', $job_delete)->delete();

            if($destroy == 1):
                echo 'success';
            else:
                echo 'error';
            endif;     
        }
    }

    public function updateStatus()
    {
        $job_status = explode('-', Input::get('jid'));
   
        if(count($job_status) == 2){
            $job    = Recruitment::where('job_id', '=', $job_status[0])
                       ->update(['publish' => $job_status[1]]);

            if(!empty($job)):
                echo 'success';
            else:
                echo 'error';
            endif;
        }
    }

    public function candidate()
    {
        $data['title']          = 'Manage Recruitment : Candidate CVs';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.job.list') => 'Manage Jobs', 
                                                           route('admin.candidate.list') => 'Candidate CVs']);

        $data['heading_title']  = 'Candidate CVs information';
        $data['recruitment_drop'] = 'arrow_carrot-down';
        $data['recruitment_submenu'] = 'style="display:block;"';
        
        $data['ind']            = 1;
        $data['cv_info']        = Recruitment::getCandidateCV(20);
        $data['cv_info']->setPath('/internal-bkn/loading-candidate-cv-list');

        return view('admin.candidate_cv_list')->with($data);
    }

    public function candidatePagination()
    {
        $print_result       = '';
        $num_currentpage    = Input::get('page');
    
        $perpage            = 20;
        if(empty($num_currentpage)){
            $offset         = 0;
        }else{
            $offset         = $perpage * ($num_currentpage - 1);
        }

        $candidate_info     = Recruitment::getCandidateCV($perpage, $offset);

        if(!empty($candidate_info)):
            foreach($candidate_info as $cv):

                $print_result .= '
                                <tr>
                                  <td>'. ++$offset .'</td>
                                  <td>'. $cv->full_name .'</td>
                                  <td>'. $cv->position .'</td>
                                  <td>'. $cv->gender .'</td>
                                  <td>
                                    <i class="fa fa-phone-square"></i> : '. $cv->phone .'<br/>
                                    <i class="fa fa-envelope-square"></i> : '. $cv->email .'
                                  </td>
                                  <td>'. $cv->job_title .'</td>
                                  <td>$ '. $cv->salary .'</td>
                                  <td>
                                    <a href="'. route('admin.candidate.download') .'?cv_file='. $cv->document .'" class="document-resource"><i class="fa fa-download"></i></a>
                                    <span class="preview-resource" id="'. $cv->document .'"><i class="fa fa-eye"></i></span>
                                  </td>
                                  <td>'. date('d F, Y', strtotime($cv->created_at)) .'</td>
                                </tr>
                            ';
            endforeach;
        endif;

        echo $print_result;
    }

    public function candidateSearch(Request $request)
    {
        $search_val   = $request->input('search');
        $print_result = '';
        $ind = 0;

        if(!empty($search_val)){
            $result_search = Recruitment::findCandidate($search_val);

            if(!empty($result_search)):
                foreach($result_search as $cv):

                    $print_result .= '
                                <tr>
                                  <td>'. ++$ind .'</td>
                                  <td>'. $cv->full_name .'</td>
                                  <td>'. $cv->position .'</td>
                                  <td>'. $cv->gender .'</td>
                                  <td>
                                    <i class="fa fa-phone-square"></i> : '. $cv->phone .'<br/>
                                    <i class="fa fa-envelope-square"></i> : '. $cv->email .'
                                  </td>
                                  <td>'. $cv->job_title .'</td>
                                  <td>$ '. $cv->salary .'</td>
                                  <td>
                                    <a href="'. route('admin.candidate.download') .'?cv_file='. $cv->document .'" class="document-resource"><i class="fa fa-download"></i></a>
                                    <span class="preview-resource" id="'. $cv->document .'"><i class="fa fa-eye"></i></span>
                                  </td>
                                  <td>'. date('d F, Y', strtotime($cv->created_at)) .'</td>
                                </tr>
                                ';
                endforeach;
            else:
                $print_result .= '<tr><td colspan="9">
                                    <div class="alert alert-info"><strong>Not found</strong> your key word search not match to Candidate Name.</div>
                                 </td></tr>';
            endif;
        }else{
            $candidate_info     = Recruitment::getCandidateCV(20);

            foreach($candidate_info as $cv):

                $print_result .= '
                                <tr>
                                  <td>'. ++$ind .'</td>
                                  <td>'. $cv->full_name .'</td>
                                  <td>'. $cv->position .'</td>
                                  <td>'. $cv->gender .'</td>
                                  <td>
                                    <i class="fa fa-phone-square"></i> : '. $cv->phone .'<br/>
                                    <i class="fa fa-envelope-square"></i> : '. $cv->email .'
                                  </td>
                                  <td>'. $cv->job_title .'</td>
                                  <td>$ '. $cv->salary .'</td>
                                  <td>
                                    <a href="'. route('admin.candidate.download') .'?cv_file='. $cv->document .'" class="document-resource"><i class="fa fa-download"></i></a>
                                    <span class="preview-resource" id="'. $cv->document .'"><i class="fa fa-eye"></i></span>
                                  </td>
                                  <td>'. date('d F, Y', strtotime($cv->created_at)) .'</td>
                                </tr>
                                ';
            endforeach;         
        }

        echo $print_result;
    }

    public function candidateDownload()
    {
        $file_name   = Input::get('cv_file');

        if(!empty($file_name)){
            //$my_file = explode('_', $file_name, 2);
            $file    = "./public/candidate_cvs/".$file_name;
            return @Response::download($file);
        }
    }
}
