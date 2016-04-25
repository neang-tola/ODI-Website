<?php
namespace App\Http\Helpers;
use DB;

class AdminHelper{
	public static function Position($post_id=null)
	{
		if(!empty($post_id)){
			
			switch($post_id):
				case 1:
					$post_title = 'Top';
					break;
				case 2:
					$post_title = 'Right';
					break;
				case 3:
					$post_title = 'Bottom';
					break;
				case 4:
					$post_title = 'Left';
					break;
				default:
					$post_title = '';
					break;
			endswitch;
			return $post_title;
		}
	}
	
	public static function Role($role_id=Null)
	{
		if(!empty($role_id)){
			
			switch($role_id):
				case 1:
					$role_name = 'Admin';
					break;
				case 2:
					$role_name = 'Training';
					break;
				case 3:
					$role_name = 'Recruitment';
					break;
				case 4:
					$role_name = 'Member';
					break;
				default:
					$role_name = '';
					break;
			endswitch;
			return $role_name;
		}
	}

	public static function getSubMenu($parent_id=1)
	{
		$print_submenu = '';

    	$lang_id = DB::table('tbl_language')
    				   ->select('lang_id')
    				   ->where('lang_status', '=', 1)
    				   ->first();

		if($parent_id > 1){
			$sub_menu = DB::table('tbl_menu as m')
	    				->join('tbl_content as c', 'c.con_id', '=', 'm.con_id')
	    				->select('m_id', 'm.m_title', 'm.m_link_type', 'm.m_post', 'm.m_status', 'c.con_title')
	    				->where('m.m_parent', '=', $parent_id)
	    				->get();
		}

		if(!empty($sub_menu)){
			foreach($sub_menu as $menu):
                if($menu->m_status == 0){
                    $status = '<span class="status-m" id="status-'. $menu->m_id .'-1"><i class="inactive-button"></i></span>';
                }else{
                    $status = '<span class="status-m" id="status-'. $menu->m_id .'-0"><i class="active-button"></i></span>';
                }
				
				$print_submenu .= '
                                <tr>
                                  <td class="none-border">&nbsp;</td>
                                  <td class="sub-border">-- <span class="menu-title">'. $menu->m_title .'</span></td>
                                  <td class="sub-border">'. AdminHelper::Position($menu->m_post) .'</td>
                                  <td class="sub-border">'. $menu->m_link_type .'</td>
                                  <td class="sub-border">'. $menu->con_title .'</td>
                                  <td class="sub-border">'.$status.'</td>
                                  <td class="sub-border"><a href="'. route('admin.menu.edit') .'?mid='. $menu->m_id .'"><i class="edit-button"></i></a></td>
                                  <td class="sub-border"><i class="del-button" id="del-'. $menu->m_id .'"></i></td>
                                </tr>
							';
			endforeach;
		}

		return $print_submenu;
	}

	public static function getActiveLanguage()
	{	
		$my_lang     = array();
    	$my_language = DB::table('tbl_language')
    				   ->select('lang_id', 'lang_title')
    				   ->where('lang_status', '=', 1)
    				   ->get();

    	foreach($my_language as $lng){
    		$my_lang[$lng->lang_id] = $lng->lang_title; 
    	}
    	$return = array('lang_count' => count($my_language), 'lang_info' => $my_lang);
    	return  $return;
	}

	public static function controlStatus()
	{
		$control = array(0 => 'Inactive', 1 => 'Active');
		return $control;
	}

	public static function controlYesNo()
	{
		$control = array(0 => 'No', 1 => 'Yes');
		return $control;
	}

	public static function controlTypeLink()
	{
		$control = array('internal' => 'Internal Link', 'external' => 'External Link');
		return $control;
	}

	public static function controlContentType()
	{
		$return  = array();
		$control = DB::table('tbl_content_type')
					   ->select('cnt_id', 'cnt_title')
					   ->orderBy('cnt_title')
					   ->where('cnt_status', '=', 1)
					   ->orderBy('cnt_title')
					   ->get();

		foreach($control as $ctrl):
			$return[$ctrl->cnt_id] = $ctrl->cnt_title;
		endforeach;

		return $return;
	}

	public static function controlPosition($status=null)
	{
		if(empty($status)){
			$control = array(1 => 'Top', 2 => 'Right', 3 => 'Bottom', 4 => 'Left');
		}else{
			$control = array('' => 'Choose Position', 1 => 'Top', 2 => 'Right', 3 => 'Bottom', 4 => 'Left');
		}

		return $control;
	}

	public static function controlRole($selected=null)
	{
		if(!empty($selected)){
			$control = array(1 => 'Admin', 2 => 'Training', 3 => 'Recruitment', 4 => 'Member');
		}else{
			$control = array('' => 'Choose Role', 1 => 'Admin', 2 => 'Training', 3 => 'Recruitment', 4 => 'Member');
		}

		return $control;
	}

	public static function controlGallery()
	{
		$gallery = DB::table('tbl_gallery')
					->select('gal_id', 'gal_title')
					->orderBy('gal_title')
					->get();

		if(!empty($gallery)){
			$control[''] = '';
			foreach ($gallery as $gal) {
				$control[$gal->gal_id] = $gal->gal_title;
			}

			return $control;
		}
	}

	public static function controlParent($selected=null, $mid=null)
	{
		$return  = array();
		if(empty($selected)){
			$control = DB::table('tbl_menu')
						   ->select('m_id', 'm_title')
						   ->where('m_parent', '=', 0)
						   ->where('m_id', '>', 1)
						   ->orderBy('m_title')
						   ->get();
		}else{
			$control = DB::table('tbl_menu')
						   ->select('m_id', 'm_title')
						   ->where('m_parent', '=', 0)
						   ->where('m_id', '>', 1)
						   ->where('m_id', '<>', $mid) 
						   ->orderBy('m_title')
						   ->get();
		}
		
		$return[0]	= 'Parent';
		foreach($control as $row):
			$return[$row->m_id] = $row->m_title;
		endforeach;

		return $return;
	}

	public static function controlTypeCaption()
	{
		$control[''] = 'Choose a Caption type';
		$control[1]  = 'Image';
		$control[2]	 = 'Text';

		return $control;
	}

	public static function encode_title($title=null)
	{
		if(!empty($title)){
			$en_title    = trim($title);
			$str		 = str_ireplace(' ', '-', $en_title);
			$form_format = array('(', ')', '!', '?', '|', '/','&','+');
			$url_format  = str_ireplace($form_format, '', $str); 

			return strtolower($url_format);
		}
	}
	
	public static function removeHTTP($str_http=null)
	{
		if(!empty($str_http)){
			$en_http     = trim($str_http);
			$form_format = array('http', 'http//', 'http://', 'https', 'https//', 'https://');
			$url_protocol= str_ireplace($form_format, '', $en_http ); 

			return strtolower($url_protocol);
		}
	}

	public static function breadcrumb($url=array())
	{
		$list_url = '';
		$i = 0;
		$dashboard = array(route('admin.dashboard') => 'Dashboard');

		$breadcrumb= array_merge($dashboard, $url);

		$last_breadcrumb = count($breadcrumb);

		foreach ($breadcrumb as $key => $value) {
			if(++$i == $last_breadcrumb):
				$list_url .= '<li>'.$value.'</li>';
			else:
				$list_url .= '<li><a href="'.$key.'">'.$value.'</a></li>';
			endif;
		}

		$str_breadcrumb = '
	                           <ol class="breadcrumb">
	                              '.$list_url.'
	                           </ol>
		';
		return $str_breadcrumb;
	}

	public static function started_date($start_from=null, $start_to=null)
	{
		$str_date = '';
		if(!empty($start_from)){
			if(!empty($start_to)){
				$day = substr($start_from, 8, 2);
				$str_date = $day .' - '. date('d, F Y', strtotime($start_to));
			}else{
				$str_date = date('d, F Y', strtotime($start_from));
			}
		}

		return $str_date;
	}

	public static function format_date($date_val=null)
	{
		if(!empty($date_val)){
			return date('d-m-Y', strtotime($date_val));
		}
	}

	public static function ctrl_joined_status($status_val=1, $id=null)
	{
		if($status_val == 1){
				$control = '
                            <div class="btn-group training" role="group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Joined <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="join-status" id="paticipant-'.$id.'-1"><a href="javascript:;" >Joined <i class="fa fa-check"></i></a></li>
                                    <li class="join-status" id="paticipant-'.$id.'-0"><a href="javascript:;">Canceled</a></li>
                                </ul>
                            </div>
							';
		}else{
				$control = '
                            <div class="btn-group training" role="group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Canceled <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="join-status" id="paticipant-'.$id.'-1"><a href="javascript:;" >Joined</a></li>
                                    <li class="join-status" id="paticipant-'.$id.'-0"><a href="javascript:;">Canceled <i class="fa fa-check"></i></a></li>
                                </ul>
                            </div>
							';
		}

		return $control;
	}

	public static function ctrl_language()
	{
		$control  = array();
		$language = DB::table('tbl_language')
						->select('lang_title')->get();
		foreach($language as $lng){
			$control[$lng->lang_title] = $lng->lang_title;
		}
		return $control;
	}

    public static function base64url_encode($data) {
      return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}