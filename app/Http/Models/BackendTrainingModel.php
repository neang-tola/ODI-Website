<?php
namespace App\Http\Models;

use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class BackendTrainingModel extends Model
{
    protected $table = 'tbl_training_course';

    static function getAllTraining($group=null, $limit=null, $offset=null)
    {
    	if(!empty($offset)):
	    	$training = DB::table('tbl_training_course as t');
	    	$training->select('t.trc_id', 't.trc_title', 't.customize', 't.trc_price', 't.started_from', 't.started_to', 'tt.trc_title as training_type', 'u.name', 't.publish');
            $training->selectRaw('(select count(s.id) from tbl_join_training as s where s.trc_id = t.trc_id and s.status = 1) as num_record');
            $training->join('tbl_training_course as tt', 'tt.trc_id', '=', 't.parent_id');
            $training->join('users as u', 'u.id', '=', 't.created_by');

            if(is_numeric($group))
            $training->where('t.customize', '=', $group);

            $training->where('t.trc_status', '=', 1);
            $training->where('t.parent_id', '>', 0);
	    	$training->skip($offset);
	    	$training->take($limit);
	    	$training->orderBy('t.trc_id', 'desc');
	    	$result  = $training->get();
	    else:
            $training = DB::table('tbl_training_course as t');
            $training->select('t.trc_id', 't.trc_title', 't.customize', 't.trc_price', 't.started_from', 't.started_to', 'tt.trc_title as training_type', 'u.name', 't.publish');
            $training->selectRaw('(select count(s.id) from tbl_join_training as s where s.trc_id = t.trc_id and s.status = 1) as num_record');
            $training->join('tbl_training_course as tt', 'tt.trc_id', '=', 't.parent_id');
            $training->join('users as u', 'u.id', '=', 't.created_by');

            if(is_numeric($group))
            $training->where('t.customize', '=', $group);

            $training->where('t.trc_status', '=', 1);
            $training->where('t.parent_id', '>', 0);
            $training->orderBy('t.trc_id', 'desc');
	    	$result  = $training->paginate($limit);

	    endif;

	    return $result;
    }

    static function getAllTrainingType($limit=null, $offset=null)
    {

        if(!empty($offset)):
                $training = DB::table('tbl_training_course')
                            ->select('trc_id', 'trc_title', 'created_at')
                            ->where('parent_id', '=', 0)
                            ->where('trc_status', '=', 1)
                            ->skip($offset)
                            ->take($limit)
                            ->orderBy('trc_id', 'desc')
                            ->get();
        else:
                $training = DB::table('tbl_training_course')
                            ->select('trc_id', 'trc_title', 'created_at')
                            ->where('parent_id', '=', 0)
                            ->where('trc_status', '=', 1)
                            ->orderBy('trc_id', 'desc')
                            ->paginate($limit);

        endif;

        return $training;
        
    }

    static function getAllTrainingJoin($id=null, $limit=null, $offset=null)
    {
        if(!empty($offset)):
                $training = DB::table('tbl_join_training as j');
                $training->select('j.*', 't.trc_title');
                $training->join('tbl_training_course as t', 't.trc_id', '=', 'j.trc_id');
            if(is_numeric($id))
                $training->where('j.trc_id', '=', $id);
            
                $training->skip($offset);
                $training->take($limit);
                $training->orderBy('j.created_at', 'desc');
                $result = $training->get();
        else:
                $training = DB::table('tbl_join_training as j');
                $training->select('j.*', 't.trc_title');
                $training->join('tbl_training_course as t', 't.trc_id', '=', 'j.trc_id');
            if(is_numeric($id))
                $training->where('j.trc_id', '=', $id);
            
                $training->orderBy('j.created_at', 'desc');
                $result = $training->paginate($limit);

        endif;

        return $result;
        
    }

    static function findTraining($customize=null, $keyword=null)
    {
        if(!empty($keyword)){
            $training = DB::table('tbl_training_course as t');
            $training->select('t.trc_id', 't.trc_title', 't.customize', 't.trc_price', 't.started_from', 't.started_to', 'tt.trc_title as training_type', 'u.name', 't.publish');
            $training->selectRaw('(select count(s.id) from tbl_join_training as s where s.trc_id = t.trc_id and s.status = 1) as num_record');
            $training->join('tbl_training_course as tt', 'tt.trc_id', '=', 't.parent_id');
            $training->join('users as u', 'u.id', '=', 't.created_by');

            if(is_numeric($customize))
            $training->where('t.customize', '=', $customize);

            $training->where('t.trc_status', '=', 1);
            $training->where('t.parent_id', '>', 0);
            $training->where('t.trc_title', 'like', '%'.$keyword.'%');
            $training->orderBy('t.trc_id', 'desc');
            $result  = $training->get();

            return $result;
        }
    }

    static function findTrainingType($keyword=null)
    {
        if(!empty($keyword))
        {
            $training = DB::table('tbl_training_course')
                            ->select('trc_id', 'trc_title', 'created_at')
                            ->where('trc_status', '=', 1)
                            ->where('parent_id', '=', 0)
                            ->where('trc_title', 'like', '%'.$keyword.'%')
                            ->orderBy('trc_id', 'desc')
                            ->get();

            return $training;
        }
    }

    static function findTrainingJoin($id=null, $keyword=null)
    {
        if(!empty($keyword))
        {
            $training = DB::table('tbl_join_training as j');
            $training->distinct('j.*', 't.trc_title');
            $training->join('tbl_training_course as t', 't.trc_id', '=', 'j.trc_id');

            if(is_numeric($id))
            $training->where('j.trc_id', '=', $id);

            $training->where(function($qry) use ($keyword){
                $qry->orWhere('j.full_name', 'like', '%'.$keyword.'%');
                $qry->orWhere('j.company', 'like', '%'.$keyword.'%');
            });
            $training->orderBy('j.created_at', 'desc');
            $result = $training->get();

            return $result;
        }
    }

    static function getOneRow($tid=null)
    {
        if(!empty($tid)){
            $training = DB::table('tbl_training_course')
                           ->where('trc_status', '=', 1)
                           ->where('trc_id', '=', $tid)
                           ->first();

            return $training;
        }
    }

    static function insertTraining($title=null, $trc_type=null)
    {
        if(!empty($trc_type)){
            $my_val = ['trc_title' => $title, 'parent_id' => $trc_type, 'created_at'=> date('Y-m-d H:i:s')];
        }else{
            $my_val = ['trc_title' => $title, 'parent_id' => 0, 'created_at'=> date('Y-m-d H:i:s')];
        }
        
        $training = DB::table('tbl_training_course')->insert($my_val);
        if($training == 1)
            return true;
        else
            return false;
    }    

    static function updateTraining($title=null, $trc_id=null, $parent_id=null)
    { 
        if(!empty($parent_id)){
            $my_val = ['trc_title' => $title, 'parent_id' => $parent_id, 'updated_at' => date('Y-m-d H:i:s')];
        }else{
            $my_val = ['trc_title' => $title, 'updated_at' => date('Y-m-d H:i:s')];
        }
        $training = DB::table('tbl_training_course')->where('trc_id', '=', $trc_id)->update($my_val);

        if($training == 1)
            return true;
        else
            return false;
    }

    static function parentControl()
    {
        $control = array();

        $training= DB::table('tbl_training_course')
                    ->select('trc_id', 'trc_title')
                    ->where('trc_status', '=', 1)
                    ->where('parent_id', '=', 0)
                    ->get();

        $control[''] = '';
        if(!empty($training)){
            foreach ($training as $trc) {
                $control[$trc->trc_id] = $trc->trc_title;
            }
        }

        return $control;
    }

    static function updateStartDate($val_date=null)
    {
        if(!empty($val_date)){
            return date('Y-m-d', strtotime($val_date));
        }
    }
   
    static function countGroup($group=null)
    { 
        $my_count = BackendTrainingModel::where('customize', '=', $group)->count();
        return $my_count;
    }

    static function uploadBanner($image=null, $pathImage=null, $trc_id=null)
    {
        if(!empty($image)){

            $extension  = $image->getClientOriginalExtension(); // getting image extension
            $fileName   = rand(11111111, 99999999).'.'.$extension; // renameing image
            $image->move($pathImage, $fileName); // uploading file to given path

            $new_banner = 'b_'.$fileName;
              
            $img_banner = Image::make($pathImage.'/'.$fileName);
            $img_banner->resize(1680, 350, function($r){
                    $r->aspectRatio();
                    $r->upsize();
            });
            $img_banner->save($pathImage.'/'.$new_banner);

            @unlink($pathImage.'/'.$fileName);

            if(is_numeric($trc_id)){
                $img_remove = BackendTrainingModel::getOneRow($trc_id);
                if(!empty($img_remove->trc_banner)){
                    @unlink($pathImage.'/'.$img_remove->trc_banner);
                }
            }
            
            return $new_banner;
        }
    }
}
