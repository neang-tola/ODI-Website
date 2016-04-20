<?php

namespace App\Http\Models;

use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class BackendSlideModel extends Model
{
    protected $table = 'tbl_image';

    static function getAllSlide($limit=null, $offset=null)
    {
    	if(!empty($offset)):
	    	$image = DB::table('tbl_image')
	    				->select('img_id', 'img_name', 'img_title', 'img_status', 'created_at', 'img_sequense')
	    				->where('conditional_type', '=', 6)
	    				->skip($offset)
	    				->take($limit)
	    				->orderBy('img_sequense')
	    				->get();
	    else:
	    	$image = DB::table('tbl_image')
	    				->select('img_id', 'img_name', 'img_title', 'img_status', 'created_at', 'img_sequense')
	    				->where('conditional_type', '=', 6)
	    				->orderBy('img_sequense')
	    				->paginate($limit);

	    endif;

	    return $image;
    }

    static function findSlideshow($keyword=null)
    {
        if(!empty($keyword)){
            $slide = DB::table('tbl_image')
                        ->select('img_id', 'img_name', 'img_title', 'img_status', 'created_at', 'img_sequense')
                        ->where('conditional_type', '=', 6)
                        ->where('img_title', 'like', '%'.$keyword.'%')
                        ->orderBy('img_sequense')
                        ->get();

            return $slide;
        }
    }

    static function getOneRow($slide_id=null)
    {
        if(is_numeric($slide_id)){
            $slide = DB::table('tbl_image')
                        ->where('conditional_type', '=', 6)
                        ->where('img_id', '=', $slide_id)
                        ->first();

            return $slide;
        }
    }

    static function insertSlide($insert_info=array())
    {
    	if(!empty($insert_info)){
    		$max_order = BackendSlideModel::max('img_sequense');
            $insert_val= array('img_sequense' => $max_order + 1);

    		$slide = DB::table('tbl_image')
    					->insert(array_merge($insert_val, $insert_info));

    		if($slide == 1)
    			return true;
    		else
    			return false;
    	}
    }

    static function updateSlide($img_id=null, $insert_info=array())
    {
        if(is_numeric($img_id)){ 
            if(!empty($insert_info)){
                $slide = DB::table('tbl_image')
                            ->where('img_id', '=', $img_id)
                            ->update($insert_info);

                if($slide == 1)
                    return true;
                else
                    return false;
            }
        }
    }

    static function removeImage($img_id=null)
    {
        if(!empty($img_id)){
            $image   = BackendSlideModel::getOneRow($img_id);
            
            if(!empty($image->img_name)){
                $slide_path = 'public/slideshows/'.$image->img_name;
                @unlink($slide_path);
            }

            if($image->img_position_l == 1){
                $image_path = 'public/slideshows/'.$image->img_content_l;
                @unlink($image_path);
            }

            if($image->img_position_r == 1){
                $image_path = 'public/slideshows/'.$image->img_content_r;
                @unlink($image_path);
            }
        }
    }

    static function updateOrder($id=null, $order_val=null)
    {
        if(!empty($id)){
            $update_order = DB::table('tbl_image')
                                ->where('img_id', '=', $id)
                                ->update(['img_sequense' => $order_val]);
            if($update_order == 1){
                return true;
            }else{
                return false;
            }
        }
    }

    static function uploadSlideShow($image=null, $pathImage=null)
    {
        if(!empty($image)){

              $extension = $image->getClientOriginalExtension(); // getting image extension
              $fileName  = rand(11111111, 99999999).'.'.$extension; // renameing image
              $image->move($pathImage, $fileName); // uploading file to given path

              $new_slide = 's_'.$fileName;
              
              $img_slide = Image::make($pathImage.'/'.$fileName);
              $img_slide->resize(1680, 350, function($r){
                    $r->aspectRatio();
                    $r->upsize();
              });
              $img_slide->save($pathImage.'/'.$new_slide);

              @unlink($pathImage.'/'.$fileName);

              return $new_slide;
        }
    }

    static function uploadImage($image=null, $pathImage=null)
    {
        if(!empty($image)){

              $extension = $image->getClientOriginalExtension(); // getting image extension
              $fileName  = rand(11111111, 99999999).'.'.$extension; // renameing image
              $image->move($pathImage, $fileName); // uploading file to given path

              return $fileName;
        }
    }

    static function controlLink()
    {
        $menu_link = DB::table('tbl_menu')
                        ->select('m_link', 'm_title')
                        ->where('m_link', '<>', '')
                        ->where('m_status', 1)
                        ->get();

        if(!empty($menu_link)){
            $control[''] = '';
            foreach($menu_link as $link){
                $control[$link->m_link] = $link->m_title;
            }

            return $control;
        }
    }
}
