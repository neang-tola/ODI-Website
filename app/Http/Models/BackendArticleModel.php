<?php

namespace App\Http\Models;

use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

class BackendArticleModel extends Model
{
    protected $table = 'tbl_content';

    static function getAllArticle($limit=null, $offset=null)
    {
    	if(!empty($offset)):
	    	$article = DB::table('tbl_content')
	    				->select('con_id', 'con_title', 'con_front', 'created_at')
	    				->whereIn('cnt_id', [1,4])
	    				->skip($offset)
	    				->take($limit)
	    				->orderBy('created_at', 'desc')
	    				->get();
	    else:
	    	$article = DB::table('tbl_content')
	    				->select('con_id', 'con_title', 'con_front', 'created_at')
	    				->whereIn('cnt_id', [1,4])
	    				->orderBy('created_at', 'desc')
	    				->paginate($limit);

	    endif;

	    return $article;
    }

    static function findArticle($keyword=null)
    {
	    $article = DB::table('tbl_content')
	    				->select('con_id', 'con_title', 'con_front', 'created_at')
	    				->whereIn('cnt_id', [1,4])
	    				->where('con_title', 'like', '%'.$keyword.'%')
	    				->orderBy('created_at', 'desc')
	    				->get();

	    return $article;
    }

    static function getArticleTitle($aid=null)
    {
		if(!empty($aid)){
			$title_article = DB::table('tbl_language as lng')
							->leftJoin('tbl_content_translate as ct', function($join) use ($aid)
							{
								$join->on('lng.lang_id', '=', 'ct.lang_id');
								$join->on('ct.con_id', '=', DB::raw($aid));
							})
							->select('lng.lang_id', 'ct.ctt_id', 'ct.ctt_title', 'ct.ctt_des', 'lng.lang_title')
							->where('lng.lang_status', '=', 1)
							->get();

		}else{
			$title_article = DB::table('tbl_language')
							->select('lang_id', 'lang_title')
							->where('lang_status', '=', 1)
							->get();
		}
		return array('lang_count' => count($title_article), 'lang_info' => $title_article);
    }

    static function deleteArticle($did=null)
    {
    	if($did == 1 || $did == 2 || $did == 8 || $did == 16 || $did == 18){
    		return 0;
    	}else{
	    	DB::table('tbl_content_translate')->where('con_id', '=', $did)->delete();

	    	$delete = DB::table('tbl_content')->where('con_id', '=', $did)->delete();
	    	return $delete;
	    }
    }

    static function getOneRow($aid=null)
    {
    	if(!empty($aid)){
    		$article = DB::table('tbl_content')
    					   ->whereIn('cnt_id', [1,4])
    					   ->where('con_id', '=', $aid)
    					   ->first();

    		return $article;
    	}
    }

    static function getContact()
    {
    	$contact = DB::table('tbl_content')
    				->where('cnt_id', '=', 5)
    				->first();

    	return $contact;
    }

    static function controlSlide()
    {
    	$slideshow = DB::table('tbl_image')
    					->select('img_id', 'img_title')
    					->where('conditional_type', 6)
                        ->orderBy('img_title')
    					->get();

    	if(!empty($slideshow)){
    		$control[''] = '';
    		foreach($slideshow as $img){
    			$control[$img->img_id] = $img->img_title;
    		}
    		return $control;
    	}
    }

    static function controlAddionalContent()
    {
    	$control[''] = '';
    	$control[1]  = 'Training Course';
    	$control[2]  = 'Customize Training';
    	$control[3]  = 'Listing Job Vacancy';
    	$control[4]  = 'Listing Free Resource';
    	$control[5]  = 'Form Submit CV';
    	$control[6]  = 'Form Training Register';

    	return $control;
    }
}
