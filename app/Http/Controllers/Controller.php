<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function check_user_role($role_id=null)
    {
    	switch ($role_id) {
    		case 1:
    			$user_role = 'admin';
    			$redirect  = '';
    			break;
    		case 2:
    			$user_role = 'Training';
    			$redirect  = '/internal-bkn/manage-training-list';
    			break;
    		case 3: 
    			$user_role = 'Recruitment';
    			$redirect  = '/internal-bkn/manage-job-list';
    			break;
    		default:
    			$user_role = 'Member';
    			$redirect  = '/free-resources';
    			break;
    	}

    	if(!empty($redirect))
    	return $redirect;
    }
    
    public static function check_training_role($role_id=null)
    {
    	switch ($role_id) {
    		case 1:
    			$user_role = 'admin';
    			$redirect  = '';
    			break;
    		case 2:
    			$user_role = 'Training';
    			$redirect  = '';
    			break;
    		case 3: 
    			$user_role = 'Recruitment';
    			$redirect  = '/internal-bkn/manage-job-list';
    			break;
    		default:
    			$user_role = 'Member';
    			$redirect  = '/free-resources';
    			break;
    	}

    	if(!empty($redirect))
    	return $redirect;
    }

    public static function check_recruitment_role($role_id=null)
    {
    	switch ($role_id) {
    		case 1:
    			$user_role = 'admin';
    			$redirect  = '';
    			break;
    		case 2:
    			$user_role = 'Training';
    			$redirect  = '/internal-bkn/manage-training-list';
    			break;
    		case 3: 
    			$user_role = 'Recruitment';
    			$redirect  = '';
    			break;
    		default:
    			$user_role = 'Member';
    			$redirect  = '/free-resources';
    			break;
    	}

    	if(!empty($redirect))
    	return $redirect;
    }
}
