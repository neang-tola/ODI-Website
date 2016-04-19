<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Models\SiteModel as MySite;
use Session;
use Helper;

class AjaxController extends Controller
{
    public function loadingPartner()
    {
    	echo MySite::getPartner();
    }

    public function loadingSlideshow()
    {
        echo MySite::getSlideshow_image();
    }
    
    public function loadingTrainingCourse()
    {
        $num_currentpage    = Input::get('page');
    
        $perpage            = 20;
        if(empty($num_currentpage)){
            $offset         = 0;
        }else{
            $offset         = $perpage * ($num_currentpage - 1);
        }

        $training_info      = MySite::getTrainingInfo($perpage, $offset);
        $template			= Helper::templateTrainingCourse($offset, $training_info, null, false);

        $return_result 		= ['result' => $template['result'], 'mobile' => $template['mobile']];

        echo json_encode($return_result);
    }

    public function loadingCustomizeTraining()
    {
        $num_currentpage    = Input::get('page');
    
        $perpage            = 20;
        if(empty($num_currentpage)){
            $offset         = 0;
        }else{
            $offset         = $perpage * ($num_currentpage - 1);
        }

        $training_info      = MySite::getTrainingCus($perpage, $offset);
        $template           = Helper::templateCustomizeCourse($offset, $training_info, null, false);

        $return_result      = ['result' => $template['result'], 'mobile' => $template['mobile']];

        echo json_encode($return_result);
    }

    public function loadingResource()
    {
        $num_currentpage    = Input::get('page');
    
        $perpage            = 20;
        if(empty($num_currentpage)){
            $offset         = 0;
        }else{
            $offset         = $perpage * ($num_currentpage - 1);
        }

        $resource_info      = MySite::getResourceInfo($perpage, $offset);
        $template           = Helper::templateResource($offset, $resource_info, null, false);

        $return_result      = ['result' => $template['result'], 'mobile' => $template['mobile']];

        echo json_encode($return_result);
    }

    public function loadingJob()
    {
        $num_currentpage    = Input::get('page');
    
        $perpage            = 30;
        if(empty($num_currentpage)){
            $offset         = 0;
        }else{
            $offset         = $perpage * ($num_currentpage - 1);
        }

        $jobvacancy_info    = MySite::getJobInfo($perpage, $offset);
        $template           = Helper::templateJobVacancy($offset, $jobvacancy_info, null, false);

        $return_result      = ['result' => $template['result'], 'mobile' => $template['mobile']];

        echo json_encode($return_result);
    }

    public function loadingJobSearch(Request $request)
    {
        $condition  = '';
        $job_title  = $request->input('job-title');
        $job_cat    = $request->input('job-category');
        $job_loc    = $request->input('job-location');

        if(!empty($job_title))
            $condition .= 'AND jv.job_title LIKE "%'. $job_title .'%" ';
        if(!empty($job_cat))
            $condition .= 'AND jv.cat_id = '. $job_cat .' ';
        if(!empty($job_loc))
            $condition .= 'AND jv.loc_id = '. $job_loc;

        $job_info       = MySite::findJobInfo(30, 0, $condition);
        $template       = Helper::templateJobVacancy(0, $job_info, null, false);

        $return_result  = ['result' => $template['result'], 'mobile' => $template['mobile']];

        echo json_encode($return_result);
    }

    public function clearJobResult()
    {
        $jobvacancy_info    = MySite::getJobInfo(30);
        $template           = Helper::templateJobVacancy(0, $jobvacancy_info, null, false);

        $return_result      = ['result' => $template['result'], 'mobile' => $template['mobile']];

        echo json_encode($return_result);
    }
}
