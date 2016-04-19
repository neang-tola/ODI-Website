<?php

namespace App\Http\Models;

use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

class BackendUserModel extends Model
{
    protected $table = 'users';

    static function getAllUsers($limit=null, $offset=null)
    {
    	if(!empty($offset)):
	    	$user = DB::table('users')
                        ->select('id', 'email', 'name', 'created_at', 'role_id')
	    				->skip($offset)
	    				->take($limit)
	    				->get();
	    else:
	    	$user = DB::table('users')
                        ->select('id', 'email', 'name', 'created_at', 'role_id')
	    				->paginate($limit);

	    endif;

	    return $user;
    }

    static function findUser($keyword=null)
    {
	    $user = DB::table('users')
                        ->select('id', 'email', 'name', 'created_at', 'role_id')
	    				->where('email', 'like', '%'.$keyword.'%')
	    				->get();

	    return $user;
    }

    static function deleteUser($did=null)
    {
    	if($did == 1){
    		return 0;
    	}else{
	    	$delete = DB::table('users')->where('id', '=', $did)->delete();
	    	return $delete;
	    }
    }

    static function getOneRow($aid=null)
    {
    	if(!empty($aid)){
    		$user = DB::table('users')
                           ->select('id', 'email', 'name', 'role_id')
    					   ->where('id', '=', $aid)
    					   ->first();

    		return $user;
    	}
    }
}
