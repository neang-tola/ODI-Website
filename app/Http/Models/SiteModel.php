<?php

namespace App\Http\Models;

use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Helper;

class SiteModel extends Model
{
    static function getMenu($active_id=null, $lang_id=1)
    {
    	$menu_list  = '';
    	$print_menu = '';

    		$enable_list = DB::table('tbl_menu');
			$enable_list->select('enable_list');
		if(empty($active_id)){
    		$enable_list->where('m_id', 1);
		}else{
			$enable_list->where('m_id', $active_id);
		}
    		$result = $enable_list->first();

    	if(!empty($result->enable_list)){
    		$list = explode(',', $result->enable_list);
    	}else{
    		$list = array();
    	}
  

	    $menu = DB::table('tbl_menu as m')
	    				->join('tbl_menu_translate as mt', 'mt.m_id', '=', 'm.m_id')
	    				->select('m.m_id', 'mt.mnt_title', 'm.m_link', 'm.m_image', 'm.m_image_hover', 'm.m_link_type')
	    				->where('m.m_status', 1)
	    				->where('mt.lang_id', $lang_id)
	    				->whereIn('m.m_id', $list)
	    				->skip(0)
	    				->take(10)
	    				->orderBy('m.m_sequense')
	    				->get();

	    if(!empty($menu)){
	    	foreach ($menu as $m) {
	    		if($m->m_id == $active_id)		
	    			$image  = $m->m_image_hover;
	    		else
	    			$image  = $m->m_image;

	    		if($m->m_id  == 1){
	    			$link_url = '/';
	    			$link_tar = '';
	    		}else{
		    		if($m->m_link_type == 'external'){
		    			$link_url = 'http://'.$m->m_link;
		    			$link_tar = 'target="_blank"';
		    		}else{
		    			$link_url = '/'.$m->m_link;
		    			$link_tar = '';
		    		}
	    		}

	    		$menu_list .= '
				 		<li>
				 			<a href="'.$link_url.'" title="'. $m->mnt_title .'" '.$link_tar.'>
				 				<img src="/public/menu_icons/'. $image .'" alt="'. $m->mnt_title .'" />
				 				<span>'.$m->mnt_title.'</span>
				 			</a>
				 		</li>'; 
	    	}

	    	$print_menu = '<ul class="box-menu clearbox">'
	    					.$menu_list.
	    				  '</ul>';
	    }

	    return $print_menu;
    }

    static function getSlideshow()
    {
    	$slide_list   = '';
    	$nav_list	  = '';
    	$print_slide  = '';
    	$ind 		  = 0;
	    $slideshow    = DB::table('tbl_image')
	    				->select('img_name', 'img_title', 'img_content_l', 'img_position_l', 'img_content_r', 'img_position_r', 'link_to')
	    				->where('img_status', 1)
	    				->get();

	    if(!empty($slideshow)){
	    	foreach($slideshow as $img){
		    	if( $ind == 0){
		    		$li_active 	= 'active';
/*			    	if(!empty($img->link_to)){
			    		$link_img   = '<a href="/'. $img->link_to .'"><img src="'. url('public/slideshows/'.$img->img_name) .'" alt="'. $img->img_title .'"></a>';
			    	}else{
			    		$link_img   = '<img src="'. url('public/slideshows/'.$img->img_name) .'" alt="'. $img->img_title .'">';
			    	}*/

		    	}else{
		    		$li_active = '';
		    	}

		    	$slide_list .= '
							<div style="background: url('. url('public/slideshows/'.$img->img_name) .');">
								<div class="container">
									<div class="row">
										<div class="col-sm-6">
											<div>
												'. $img->img_content_l .'
											</div>
										</div>
										<div class="col-sm-6">
											<div>
												'. $img->img_content_r .'
											</div> 
										</div> 
									</div>			
								</div>
							</div>';

	    		// slide navigation
	    		//$nav_list  .= '<li data-target="#mySlider" data-slide-to="'.$ind.'" class="'. $li_active .'">'. $img->img_title .'</li>';
	    		$nav_list  .= '<li data-slider="'. $ind .'" class="'. $li_active .'">'. $img->img_title .'</li>';
	    		$ind++;
	    	} // End lood slideshow
	    	
	    	$print_slide .= '
					<div class="main-slider">	
					    <div dir="ltr" class="home-sliders">
			     			'. $slide_list .'
			     		</div>
			     		<ol class="carousel-indicators carousel-indicators-text">'. $nav_list .'</ol>
			     	</div>
			   ';
	    	
	    }
	    return $print_slide;
    }

    static function getSlideshow_image()
    {
    	$slide_list   = '';

    	$ind 		  = 0;
	    $slideshow    = DB::table('tbl_image')
	    				->select('img_name', 'img_title', 'img_content_l', 'img_position_l', 'img_content_r', 'img_position_r', 'link_to')
	    				->where('img_status', 1)
	    				->get();

	    if(!empty($slideshow)){
	    	foreach($slideshow as $img){
		    	if( $ind > 0){
			    	if(!empty($img->link_to)){
			    		$link_img   = '<a href="/'. $img->link_to .'"><img src="'. url('public/slideshows/'.$img->img_name) .'" alt="'. $img->img_title .'"></a>';
			    	}else{
			    		$link_img   = '<img src="'. url('public/slideshows/'.$img->img_name) .'" alt="'. $img->img_title .'">';
			    	}
		    		// slideshow
		    		$slide_list .= '
			        <div class="item" style="background: url('. url('public/slideshows/'.$img->img_name) .')">
			        	<div class="container">
				        	<div class="row">
						        <div class="col-sm-6 caption-img">
						        	<div class="img-slider">
						        		'. $img->img_content_l .'
						        	</div>
						        </div>
						        <div class="col-sm-6 caption-text">
						            <div class="img-slider">
						            	'. $img->img_content_r .'
						            </div>
						        </div>
					        </div>
				        </div>
			        </div>';
		    	}

	    		$ind++;
	    	} // End lood slideshow
	    	
	    }
	    return $slide_list;
    }

	static function getPartner()
	{
		$partner_list = '';
		$li_partner   = '';
		$ul_partner	  = '';
		$print_partner= '';
		$i = 0;
		$partners = DB::table('tbl_gallery as g')
					->join('tbl_image as i', 'i.conditional_id', '=', 'g.gal_id')
					->select('i.img_name', 'g.gal_title')
					->where('g.gal_status', '=', 1)
					->get();

		if(!empty($partners)){
			foreach($partners as $partner) {
				if($i == 0){
					$active   = 'active';
				}else{
					$active   = '';
				}

				$li_partner  .= '<div><img src="' .url('public/gallery/thumb/'.$partner->img_name) .'" alt="'. $partner->gal_title .'-'. $i .'"/></div>';

				if(($i+1) % 2 == 0){
					if($i == 1){
						$active_s = 'active';
					}else{
						$active_s = '';
					}
					$ul_partner .= '
						<div class="item '.$active_s.'">
					      <ul class="partner">'
							. $li_partner .
						 '</ul>
						</div>';
					$li_partner = '';
				}			

				$partner_list .= '
	            <div>
	            	<div class="image">
                 	<img src="' .url('public/gallery/thumb/'.$partner->img_name) .'" class="img-responsive center-block" alt="'. $partner->gal_title .'-'. $i .'"/>
                 	</div>
             	</div>
				';
				$i++;
			}

			$print_partner = '<div  class="logo-partner-slider"> '. $partner_list .'</div>';

		}

		return $print_partner;
	}

	static function getContent($alias=null, $lang_id=1)
	{
		if(!empty($alias)){
			$content = DB::table('tbl_menu as m')
						   ->select('m.m_id', 'm.cnt_id', 'm.block_search', 'ct.ctt_title', 'ct.ctt_des', 'c.meta_key', 'c.meta_des', 'c.con_plus', 'c.con_remark', 'c.gal_id', 'i.img_name', 'i.img_position_l', 'i.img_content_l', 'i.img_position_r', 'i.img_content_r')
						   ->join('tbl_menu_translate as mt', function($join) use ($lang_id){
						   		$join->on('mt.m_id', '=', 'm.m_id');
						   		$join->on('mt.lang_id', '=', DB::raw($lang_id));
						   })
						   ->join('tbl_content as c', 'c.con_id', '=', 'm.con_id')
						   ->join('tbl_content_translate as ct', function($con) use ($lang_id){
						   		$con->on('ct.con_id', '=', 'c.con_id');
						   		$con->on('ct.lang_id', '=', DB::raw($lang_id));
						   })
						   ->leftJoin('tbl_image as i', 'i.img_id', '=', 'c.img_id')
						   ->where('m.m_link', '=', $alias)
						   ->first();

			return $content;
		}
	}

    static function getTrainingInfo($limit=1, $offset=0)
    {
    	if($offset > 0):
	    	$training = DB::table('tbl_training_course as t');
	    	$training->select('t.trc_id', 't.trc_title', 't.trc_price', 't.trc_duration', 't.started_from', 't.started_to', 't.trc_language', 't.gal_id');
            $training->join('tbl_training_course as tt', 'tt.trc_id', '=', 't.parent_id');
	    	
            $training->where('t.trc_status', '=', 1);
            $training->where('t.parent_id', '>', 0);
            $training->where('t.customize', '=', 0);
            $training->whereRaw('t.started_from >= CURDATE()');
	    	$training->skip($offset);
	    	$training->take($limit);
	    	$training->orderBy('t.started_from');
	    	$result   = $training->get();
	    else:
	    	$training = DB::table('tbl_training_course as t');
	    	$training->select('t.trc_id', 't.trc_title', 't.trc_price', 't.trc_duration', 't.started_from', 't.started_to', 't.trc_language', 't.gal_id');
            $training->join('tbl_training_course as tt', 'tt.trc_id', '=', 't.parent_id');

            $training->where('t.trc_status', '=', 1);
            $training->where('t.parent_id', '>', 0);
            $training->where('t.customize', '=', 0);
            $training->whereRaw('t.started_from >= CURDATE()');
            $training->orderBy('t.started_from');
	    	$result   = $training->paginate($limit);

	    endif;

	    return $result;
    }

    static function getTrainingCus($limit=1, $offset=0)
    {
    	if($offset > 0):
	    	$training = DB::table('tbl_training_course as t');
	    	$training->select('t.trc_id', 't.trc_title', 'tt.trc_title as training_type');
            $training->join('tbl_training_course as tt', 'tt.trc_id', '=', 't.parent_id');
	    	
            $training->where('t.trc_status', '=', 1);
            $training->where('t.parent_id', '>', 0);
            $training->where('t.customize', '=', 1);
	    	$training->skip($offset);
	    	$training->take($limit);
	    	$training->orderBy('t.created_at', 'desc');
	    	$result   = $training->get();
	    else:
	    	$training = DB::table('tbl_training_course as t');
	    	$training->select('t.trc_id', 't.trc_title', 'tt.trc_title as training_type');
            $training->join('tbl_training_course as tt', 'tt.trc_id', '=', 't.parent_id');

            $training->where('t.trc_status', '=', 1);
            $training->where('t.parent_id', '>', 0);
            $training->where('t.customize', '=', 1);
            $training->orderBy('t.created_at', 'desc');
	    	$result   = $training->paginate($limit);

	    endif;

	    return $result;
    }

    static function getJobinfo($limit=1, $offset=0)
    {
    	if($offset > 0):
	    	$vacancy = DB::table('tbl_job_vacancy as jv')
	    				->select('jv.job_id', 'jv.job_title', 'jv.close_date', 'c.cat_name', 'l.loc_name')
	    				->join('tbl_job_category as c', 'c.cat_id', '=', 'jv.cat_id')
	    				->join('tbl_job_location as l', 'l.loc_id', '=', 'jv.loc_id')
	    				->whereRaw('jv.close_date >= CURDATE()')
	    				->skip($offset)
	    				->take($limit)
	    				->orderBy('jv.job_id', 'desc')
	    				->get();
	    else:
	    	$vacancy = DB::table('tbl_job_vacancy as jv')
	    				->select('jv.job_id', 'jv.job_title', 'jv.close_date', 'c.cat_name', 'l.loc_name')
	    				->join('tbl_job_category as c', 'c.cat_id', '=', 'jv.cat_id')
	    				->join('tbl_job_location as l', 'l.loc_id', '=', 'jv.loc_id')
	    				->whereRaw('jv.close_date >= CURDATE()')
	    				->orderBy('jv.job_id', 'desc')
	    				->paginate($limit);

	    endif;

	    return $vacancy;
    }

    static function getResourceInfo($limit=1, $offset=0)
    {
    	if($offset > 0):
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

    public static function findJobInfo($limit=1, $offset=0, $condition=null)
    {
    	if($offset > 0):
	    	$vacancy = DB::table('tbl_job_vacancy as jv')
	    				->select('jv.job_id', 'jv.job_title', 'jv.close_date', 'c.cat_name', 'l.loc_name')
	    				->join('tbl_job_category as c', 'c.cat_id', '=', 'jv.cat_id')
	    				->join('tbl_job_location as l', 'l.loc_id', '=', 'jv.loc_id')
	    				->whereRaw('jv.close_date >= CURDATE() '.$condition)
	    				->skip($offset)
	    				->take($limit)
	    				->orderBy('jv.job_id', 'desc')
	    				->get();
	    else:
	    	$vacancy = DB::table('tbl_job_vacancy as jv')
	    				->select('jv.job_id', 'jv.job_title', 'jv.close_date', 'c.cat_name', 'l.loc_name')
	    				->join('tbl_job_category as c', 'c.cat_id', '=', 'jv.cat_id')
	    				->join('tbl_job_location as l', 'l.loc_id', '=', 'jv.loc_id')
	    				->whereRaw('jv.close_date >= CURDATE() '.$condition)
	    				->orderBy('jv.job_id', 'desc')
	    				->paginate($limit);

	    endif;

	    return $vacancy;
    }

    public static function getJobDetail($job_id=null)
    {
    	if(!empty($job_id)){
	    	$job_detail = DB::table('tbl_job_vacancy as jv')
	    				->select('jv.job_id', 'jv.job_title', 'jv.close_date', 'jv.job_des', 'jv.how_apply', 'jv.job_required', 'c.cat_name', 'l.loc_name')
	    				->join('tbl_job_category as c', 'c.cat_id', '=', 'jv.cat_id')
	    				->join('tbl_job_location as l', 'l.loc_id', '=', 'jv.loc_id')
	    				->where('jv.job_id', $job_id)
	    				->first();

	    	return $job_detail;
    	}
    }

    public static function getTrainingDetail($training_id=null)
    {
    	if(!empty($training_id)){
    		$training = DB::table('tbl_training_course')
    						->where('trc_id', $training_id)
    						->first();

    		return $training;
    	}
    }

    public static function registerTainer($val_add=array())
    {
    	if(!empty($val_add)){
	    	$result = DB::table('tbl_join_training')->insert($val_add);

	    	if($result == 1){
	    		return true;
	    	}else{
	    		return false;
	    	}
	    }
    }

    public static function registerCandidate($val_cv = array())
	{
		if(!empty($val_cv)){
			$add_cv = DB::table('tbl_candidate_cv')->insert($val_cv);

			if($add_cv == 1){ 
				return true; 
			}else{
				return false;
			}
		}
	}

    static function uploadDocument($doc_file=null, $destinationPath=null)
    {
        if(!empty($doc_file)){
            $filename   = rand(100, 999).'_'.$doc_file->getClientOriginalName();

            $success_up = $doc_file->move($destinationPath, $filename);

            return $filename;
        }
    }

    static function getCotnentSEO($con_id=null, $lang_id=1)
    {
    	if(!empty($con_id)){
    		$content = DB::table('tbl_content as c')
    					->select('ct.ctt_title as title', 'c.meta_key', 'c.meta_des')
						->join('tbl_content_translate as ct', function($con) use ($lang_id){
						   		$con->on('ct.con_id', '=', 'c.con_id');
						   		$con->on('ct.lang_id', '=', DB::raw($lang_id));
						})
						->where('c.con_id', $con_id)
						->first();

			return $content;
    	}
    }
}
