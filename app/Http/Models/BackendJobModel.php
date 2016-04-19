<?php

namespace App\Http\Models;

use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

class BackendJobModel extends Model
{
    protected $table = 'tbl_job_vacancy';

    static function getAllJobs($limit=null, $offset=null)
    {
    	if(!empty($offset)):
	    	$vacancy = DB::table('tbl_job_vacancy as jv')
	    				->select('jv.job_id', 'jv.job_title', 'jv.close_date', 'c.cat_name', 'l.loc_name', 'u.name', 'jv.publish')
	    				->join('tbl_job_category as c', 'c.cat_id', '=', 'jv.cat_id')
	    				->join('tbl_job_location as l', 'l.loc_id', '=', 'jv.loc_id')
	    				->join('users as u', 'u.id', '=', 'jv.created_by')
	    				->skip($offset)
	    				->take($limit)
	    				->orderBy('jv.job_id', 'desc')
	    				->get();
	    else:
	    	$vacancy = DB::table('tbl_job_vacancy as jv')
	    				->select('jv.job_id', 'jv.job_title', 'jv.close_date', 'c.cat_name', 'l.loc_name', 'u.name', 'jv.publish')
	    				->join('tbl_job_category as c', 'c.cat_id', '=', 'jv.cat_id')
	    				->join('tbl_job_location as l', 'l.loc_id', '=', 'jv.loc_id')
	    				->join('users as u', 'u.id', '=', 'jv.created_by')
	    				->orderBy('jv.job_id', 'desc')
	    				->paginate($limit);

	    endif;

	    return $vacancy;
    }

    static function findJob($keyword=null)
    {
	    $vacancy = DB::table('tbl_job_vacancy as jv')
	    				->select('jv.job_id', 'jv.job_title', 'jv.close_date', 'c.cat_name', 'l.loc_name', 'u.name', 'jv.publish')
	    				->join('tbl_job_category as c', 'c.cat_id', '=', 'jv.cat_id')
	    				->join('tbl_job_location as l', 'l.loc_id', '=', 'jv.loc_id')
	    				->join('users as u', 'u.id', '=', 'jv.created_by')
	    				->where('jv.job_title', 'like', '%'.$keyword.'%')
	    				->orderBy('jv.job_id', 'desc')
	    				->get();

	    return $vacancy;
    }

    static function getOneRow($jid=null)
    {
    	if(!empty($jid)){
    		$vacancy = DB::table('tbl_job_vacancy')
    					   ->where('job_id', '=', $jid)
    					   ->first();

    		return $vacancy;
    	}
    }

    static function bindingCategory()
    {
    	$control  = array();

    	$category = DB::table('tbl_job_category')
    					->select('cat_id', 'cat_name')
    					->where('status', 1)
    					->orderBy('sequence')
    					->get();

    	$control[''] = '';
    	foreach($category as $cat){
    		$control[$cat->cat_id] = $cat->cat_name;
    	}

    	return $control;
    }

    static function bindingLocation()
    {
    	$control  = array();

    	$location = DB::table('tbl_job_location')
    					->select('loc_id', 'loc_name')
    					->where('status', 1)
    					->orderBy('sequence')
    					->get();

    	$control[''] = '';
    	foreach($location as $loc){
    		$control[$loc->loc_id] = $loc->loc_name;
    	}

    	return $control;
    }

    static function changeDateFormat($val_date=null)
    {
        if(!empty($val_date)){
            return date('Y-m-d', strtotime($val_date));
        }
    }

    static function getCandidateCV($limit=null, $offset=null)
    {
    	if(!empty($offset)){
    		$candidate = DB::table('tbl_candidate_cv')
    						->select('full_name', 'gender', 'position', 'salary', 'phone', 'email', 'document', 'job_title', 'created_at')
    						->skip($offset)
	    					->take($limit)
    						->orderBy('created_at', 'desc')
    						->get();

    	}else{
    		$candidate = DB::table('tbl_candidate_cv as c')
    						->select('full_name', 'gender', 'position', 'salary', 'phone', 'email', 'document', 'job_title', 'created_at')
    						->orderBy('created_at', 'desc')
    						->paginate($limit);
    	}

    	return $candidate;
    }

    static function findCandidate($keyword=null)
    {
    	if(!empty($keyword)){
	    	$candidate = DB::table('tbl_candidate_cv')
	    					->select('full_name', 'gender', 'position', 'salary', 'phone', 'email', 'document', 'job_title', 'created_at')
		    				->where('full_name', 'like', '%'.$keyword.'%')
		    				->orWhere('position', 'like', '%'.$keyword.'%')
		    				->orderBy('created_at', 'desc')
		    				->get();

		    return $candidate;
    	}
    }
 }
