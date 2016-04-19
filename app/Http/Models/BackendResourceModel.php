<?php

namespace App\Http\Models;

use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class BackendResourceModel extends Model
{
    protected $table = 'tbl_resource';

    static function getAllResource($limit=null, $offset=null)
    {
    	if(!empty($offset)):
	    	$resource = DB::table('tbl_resource as r')
	    				->select('r.res_id', 'r.res_title', 'r.res_file', 'rr.res_title as resource_type')
                        ->join('tbl_resource as rr', 'rr.res_id', '=', 'r.parent_id')
                        ->where('r.res_status', '=', 1)
                        ->where('r.parent_id', '>', 0)
	    				->skip($offset)
	    				->take($limit)
	    				->orderBy('r.res_id', 'desc')
	    				->get();
	    else:
            $resource = DB::table('tbl_resource as r')
                        ->select('r.res_id', 'r.res_title', 'r.res_file', 'rr.res_title as resource_type')
                        ->join('tbl_resource as rr', 'rr.res_id', '=', 'r.parent_id')
                        ->where('r.res_status', '=', 1)
                        ->where('r.parent_id', '>', 0)
                        ->orderBy('r.res_id', 'desc')
	    				->paginate($limit);

	    endif;

	    return $resource;
    }

    static function getAllResourceType($limit=null, $offset=null)
    {

        if(!empty($offset)):
                $resource = DB::table('tbl_resource')
                            ->select('res_id', 'res_title', 'created_at')
                            ->where('parent_id', '=', 0)
                            ->where('res_status', '=', 1)
                            ->skip($offset)
                            ->take($limit)
                            ->orderBy('res_id', 'desc')
                            ->get();
        else:
                $resource = DB::table('tbl_resource')
                            ->select('res_id', 'res_title', 'created_at')
                            ->where('parent_id', '=', 0)
                            ->where('res_status', '=', 1)
                            ->orderBy('res_id', 'desc')
                            ->paginate($limit);

        endif;

        return $resource;
        
    }

    static function findResource($keyword=null)
    {
        if(!empty($keyword)){
            $resource = DB::table('tbl_resource as r')
                        ->select('r.res_id', 'r.res_title', 'r.res_file', 'rr.res_title as resource_type')
                        ->join('tbl_resource as rr', 'rr.res_id', '=', 'r.parent_id')
                        ->where('r.res_status', '=', 1)
                        ->where('r.parent_id', '>', 0)
                        ->where('r.res_title', 'like', '%'.$keyword.'%')
                        ->orderBy('r.res_id', 'desc')
                        ->get();

            return $resource;
        }
    }

    static function findResourceType($keyword=null)
    {
        if(!empty($keyword))
        {
            $resource = DB::table('tbl_resource')
                            ->select('res_id', 'res_title', 'res_file', 'created_at')
                            ->where('res_status', '=', 1)
                            ->where('parent_id', '=', 0)
                            ->where('res_title', 'like', '%'.$keyword.'%')
                            ->orderBy('res_id', 'desc')
                            ->get();

            return $resource;
        }
    }

    static function getOneRow($rid=null)
    {
        if(!empty($rid)){
            $resource = DB::table('tbl_resource')
                           ->where('res_status', '=', 1)
                           ->where('res_id', '=', $rid)
                           ->first();

            return $resource;
        }
    }

    static function insertResource($title=null, $res_type=null)
    {
        if(!empty($res_type)){
            $my_val = ['res_title' => $title, 'parent_id' => $res_type, 'created_at'=> date('Y-m-d H:i:s')];
        }else{
            $my_val = ['res_title' => $title, 'parent_id' => 0, 'created_at'=> date('Y-m-d H:i:s')];
        }
        
        $resource = DB::table('tbl_resource')->insert($my_val);
        if($resource == 1)
            return true;
        else
            return false;
    }    

    static function updateResource($title=null, $res_id=null, $parent_id=null)
    {
        if(!empty($parent_id)){
            $my_val = ['res_title' => $title, 'parent_id' => $parent_id, 'updated_at' => date('Y-m-d H:i:s')];
        }else{
            $my_val = ['res_title' => $title, 'updated_at' => date('Y-m-d H:i:s')];
        }
        $resource = DB::table('tbl_resource')->where('res_id', '=', $res_id)->update($my_val);

        if($resource == 1)
            return true;
        else
            return false;
    }

    static function parentControl()
    {
        $control = array();

        $resource= DB::table('tbl_resource')
                    ->select('res_id', 'res_title')
                    ->where('res_status', '=', 1)
                    ->where('parent_id', '=', 0)
                    ->get();

        $control[''] = '';
        if(!empty($resource)){
            foreach ($resource as $res) {
                $control[$res->res_id] = $res->res_title;
            }
        }

        return $control;
    }

    static function uploadDocument($doc_file=null, $destinationPath=null)
    {
        if(!empty($doc_file)){
            $filename   = rand(100, 999).'_'.$doc_file->getClientOriginalName();

            $success_up = $doc_file->move($destinationPath, $filename);

            return $filename;
        }
    }

    static function removeResource($res_id=null)
    {
        if(!empty($res_id)){
            $resource = BackendResourceModel::getOneRow($res_id);
            if(!empty($resource->res_file)){
                @unlink('public/files/'. $resource->res_file);
            }

            $delete   = DB::table('tbl_resource')
                        ->where('res_id', '=', $res_id)
                        ->delete();

            return $delete;
        }
    }

    static function removeDocument($res_id=null)
    {
        if(!empty($res_id)){
            $resource = BackendResourceModel::getOneRow($res_id);
            if(!empty($resource->res_file)){
                @unlink('public/files/'. $resource->res_file);
            }
        }
    }
}
