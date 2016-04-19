<?php
namespace App\Http\Helpers;
use Session;
use DB;

class Helper{
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

	public static function training_date($start_from=null, $start_to=null)
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
	
    public static function templateTrainingCourse($start=0, $result=array(), $pagin=null, $header=true)
    {
    	$return_result 		= '';
    	$return_arr 		= array();
        $print_result       = '';
        $print_result_m		= '';
    
   		if(!empty($pagin)){
   			$pagination     = '<strong>Page: </strong> '.$pagin;
   		}
	    if(!empty($result)){
	    	foreach($result as $trc){
	    		$url_datail = 'training-course-detail-'.$trc->trc_id.'-'.Helper::encode_title($trc->trc_title);
                $print_result .= '
							<li class="list-body">
								<span class="number">'. ++$start .'</span>
								<span class="position"><a href="'. $url_datail .'" title="'.$trc->trc_title.'">'. $trc->trc_title .'</a></span>
								<span class="category">'. Helper::training_date($trc->started_from, $trc->started_to) .'</span>
								<span class="close-date">'. $trc->trc_language .'</span>
								<span class="location">$ '. $trc->trc_price .'</span>
							</li>
                            ';

                $print_result_m .= '
							<li class="mobile-body-list">
								<div class="course">
									<span><b>Course Title</b>: <a href="'. $url_datail .'" title="'.$trc->trc_title.'">'. $trc->trc_title .'</a></span>
									<span><b>Date</b>: '. Helper::training_date($trc->started_from, $trc->started_to) .'</span>
									<span><b>Language</b>: '. $trc->trc_language .'</span>
									<span><b>Price</b>: $ '. $trc->trc_price .'</span>							
								</div>
							</li>';
			} // End foreach

			if(!empty($print_result)){
				if($header == true){
					$return_result = '
					<div id="tmpTraining" class="blog-table">
						<div class="loading"></div>
						<ul class="content-table-list visible-lg" id="itemContainer">
							<li class="list-header">
								<span class="number">No</span>
								<span class="position">Courses Title</span>
								<span class="category">Date</span>
								<span class="close-date">Language</span>
								<span class="location">Price</span>
							</li>'
						. $print_result .
							'<li class="list-footer">
								<span class="pull-left">'.@$pagination.' </span>
							</li>
						</ul>
						<div class="clear"></div>
						<ul class="content-mobile visible-xs"><li class="first"></li>'
						. $print_result_m .
					   		'<li class="mobile-footer">'.@$pagination.' </li>
					    </ul>
					</div>';

					return $return_result;
				}else{
					$return_arr = ['result' => $print_result, 'mobile' => $print_result_m];
					return $return_arr;
				}
			} 
	    } // End if empty result
    }

    public static function templateCustomizeCourse($start=0, $result=array(), $pagin=null, $header=true)
    {
    	$return_result 		= '';
    	$return_arr 		= array();
        $print_result       = '';
        $print_result_m		= '';
    
   		if(!empty($pagin)){
   			$pagination     = '<strong>Page: </strong> '.$pagin;
   		}

	    if(!empty($result)){
	    	foreach($result as $trc){
                $print_result .= '
							<li class="list-body">
								<span class="number">'. ++$start .'</span>
								<span class="position">'. $trc->trc_title .'</span>
								<span class="category">'. $trc->training_type .'</span>					
							</li>
                            ';

                $print_result_m .= '
							<li class="mobile-body-list">
								<div class="course">
									<span><b>Courses Title</b>: '. $trc->trc_title .'</span>
									<span><b>category</b>: '. $trc->training_type .'</span>						
								</div>
							</li>';
			} // End foreach

			if(!empty($print_result)){
				if($header == true){
					$return_result = '
					<div id="tmpCustomize" class="blog-table">
					<div class="loading"></div>
						<ul class="content-table-list visible-lg" id="customize_training">
							<li class="list-header">
								<span class="number">No</span>
								<span class="position">Courses Title</span>
								<span class="category">Type</span>
							</li>'
						. $print_result .
							'<li class="list-footer">
								<span class="text-center">'.@$pagination.' </span>
							</li>
						</ul>
						<div class="clear"></div>
						<ul class="content-mobile visible-xs"><li class="first"></li>'
						. $print_result_m .
					   		'<li class="mobile-footer">'.@$pagination.' </li>
					    </ul>
					</div>';

					return $return_result;
				}else{
					$return_arr = ['result' => $print_result, 'mobile' => $print_result_m];
					return $return_arr;
				}
			} // check empty row
	    } // End if empty result
    }

    public static function templateJobVacancy($start=0, $result=array(), $pagin=null, $header=true)
    {
    	$return_result 		= '';
    	$return_arr 		= array();
        $print_result       = '';
        $print_result_m		= '';
    
   		if(!empty($pagin)){
   			$pagination     = '<strong>Page: </strong> '.$pagin;
   		}
	    if(!empty($result)){
	    	foreach($result as $job){
	    		$url_detail = $job->job_id.'-'.Helper::encode_title($job->job_title);
                $print_result .= '
							<li class="list-body">
								<span class="number">'. ++$start .'</span>
								<span class="position"><a href="/job-detail-'. $url_detail .'">'. $job->job_title .'</a></span>
								<span class="category">'. $job->cat_name .'</span>
								<span class="close-date">'. date('d F, Y', strtotime($job->close_date)) .'</span>
								<span class="location">'. $job->loc_name .'</span>					
							</li>
                            ';

                $print_result_m .= '
							<li class="mobile-body-list">
								<div class="course">
									<span><b>Position</b>: <a href="/job-detail-'. $url_detail .'">'. $job->job_title .'</a></span>
									<span><b>category</b>: '. $job->cat_name .'</span>						
									<span><b>Close Date</b>: '. date('d F, Y', strtotime($job->close_date)) .'</span>						
									<span><b>Location</b>: '. $job->loc_name .'</span>						
								</div>
							</li>';
			} // End foreach

			if(!empty($print_result)){
				if($header == true){
					$return_result = '
					<div class="blog-table none-bottom">
					<div class="job-search">Job Search <span class="clear-result pull-right"></span></div>
					<form method="post" action="'. route('loading.job.search') .'" class="form" id="searchJob">
						<div class="form-group col-sm-3">
							<label for="job-title">Job Title:</label>
							<input type="text" class="form-control frm-txt" name="job-title" id="job-title"/>	
							<input type="hidden" name="_token" value="'. csrf_token() .'">
						</div>					

						<div class="form-group col-sm-3">
							<label for="job-category">Job Category</label>
					        <div>
					          <select data-placeholder="Choose a Category" class="chosen-select form-control" tabindex="2" name="job-category" id="job-category">
					            '. Helper::ctrl_category() .'
					          </select>
					        </div>
					    </div>

						<div class="form-group col-sm-3">
							<label for="job-location">Location</label>
					        <div>
					          <select data-placeholder="Choose a Location" class="chosen-select form-control" tabindex="2" name="job-location" id="job-location">
					            '. Helper::ctrl_location() .'
					          </select>
					        </div>						
					    </div>

						<div class="form-group blog-btn">
							<input type="submit" value="Search" class="btn btn-search-record" id="submit" name="submit"/>
						</div>
					</form>
					</div>
					<div class="clear"></div>
					<div id="tmpJob" class="blog-table">
					<div class="loading"></div>
						<ul class="content-table-list visible-lg" id="itemContainer">
							<li class="list-header">
								<span class="number">No</span>
								<span class="position">Position</span>
								<span class="category">Category</span>
								<span class="close-date">Close date</span>
								<span class="location">Location</span>
							</li>'
							. $print_result .
							'<li class="list-footer">
								<span class="text-center">'.@$pagination.' </span>
							</li>
						</ul>
						<div class="clear"></div>
						<ul class="content-mobile visible-xs"><li class="first"></li>'
							. $print_result_m .
					   		'<li class="mobile-footer">'.@$pagination.' </li>
					    </ul>
					</div>
				</div>';

					return $return_result;
				}else{
					$return_arr = ['result' => $print_result, 'mobile' => $print_result_m];
					return $return_arr;
				}
			}
	    } // End if empty result

    }

    public static function templateResource($start=0, $result=array(), $pagin=null, $header=true)
    {
    	$return_result 		= '';
    	$return_arr 		= array();
        $print_result       = '';
        $print_result_m		= '';
    
   		if(!empty($pagin)){
   			$pagination     = '<strong>Page: </strong> '.$pagin;
   		}
	    if(!empty($result)){
	    	foreach($result as $res){
                $print_result .= '
							<li class="list-body">
								<span class="number">'. ++$start .'</span>
								<span class="position">'. $res->res_title .'</span>
								<span class="category">'. $res->resource_type .'</span>
								<span class="close-date"><a href="/get-free-resources?resource_file='. $res->res_file .'" class="down_res"><i class="glyphicon glyphicon-download-alt"></i></a></span>					
							</li>
                            ';

                $print_result_m .= '
							<li class="mobile-body-list">
								<div class="course">
									<span><b>Description</b>: '. $res->res_title .'</span>
									<span><b>Category</b>: '. $res->resource_type .'</span>
									<span><b>Download</b>: <a href="/get-free-resources?resource_file='. $res->res_file .'" class="down_res"><i class="glyphicon glyphicon-download-alt"></i></a></span>
								</div>
							</li>';
			} // End foreach

			if(!empty($print_result)){
				if($header == true){
					$return_result = '
					<div id="tmpResource" class="blog-table">
					<div class="loading"></div>
						<ul class="content-table-list visible-lg" id="free_resource">
							<li class="list-header">
								<span class="number">No</span>
								<span class="position">Description</span>
								<span class="category">Category</span>
								<span class="close-date">Download</span>
							</li>'
						. $print_result .
							'<li class="list-footer">
								<span class="text-center">'.@$pagination.' </span>
							</li>
						</ul>
						<div class="clear"></div>
						<ul class="content-mobile visible-xs"><li class="first"></li>'
						. $print_result_m .
					   		'<li class="mobile-footer">'.@$pagination.' </li>
					    </ul>
					</div>';

					return $return_result;
				}else{
					$return_arr = ['result' => $print_result, 'mobile' => $print_result_m];
					return $return_arr;
				}
			}
	    } // End if empty result
    }

	public static function getPositionClass($post=4)
	{
		$cls_post = '';
		switch ($post) {
			case 1:
				$cls_post = 'top-text';
				break;
			case 2:
				$cls_post = 'right-text';
				break;
			case 3:
				$cls_post = 'bottom-text';
				break;
			case 4:
				$cls_post = 'left-text';
				break;
			default:
				# code...
				break;
		}

		return $cls_post;
	}

	public static function formSubmitCV($route=null)
	{
		$submit_cv  = Session::get('msg');
		$submit_cv .= '
				<div class="blog-form-submit-cv">
					<div class="register-cv">CV Register</div>
					<form class="form-horizontal register-frm" method="post" action="'. route('submit.candidate.cv') .'" enctype="multipart/form-data" id="frm_submitcv">
					  <div class="form-group col-sm-6">
					    <label for="full-name" class="col-sm-4 control-label">Full Name :</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control frm-cv" id="fullName" name="fullName" />
					      <input type="hidden" name="_token" value="'. csrf_token() .'">
					    </div>
					  </div>
					  <div class="form-group col-sm-6">
					    <label for="gender" class="col-sm-4 control-label">Gender :</label>
					    <div class="col-sm-8">
					    	<select class="form-control frm-cv" name="gender" id="gender" >
					    		<option value=""></option>
					    		<option value="male">Male</option>
					    		<option value="female">Female</option>
					    	</select>
					    </div>
					  </div>

					  <div class="form-group col-sm-6">
					    <label for="current-position" class="col-sm-4 control-label">Current Position:</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control frm-cv" id="position" name="position" />
					    </div>
					  </div>

					  <div class="form-group col-sm-6">
					    <label for="apply-for" class="col-sm-4 control-label" >Apply For :</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control frm-cv" id="applyFor" name="applyFor" value="'. Session::get('job_title') .'"/>
					    </div>
					  </div>
					  <div class="form-group col-sm-6">
					    <label for="phone" class="col-sm-4 control-label">Phone Number :</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control frm-cv" id="phoneNumber" name="phoneNumber" />
					    </div>
					  </div>

					  <div class="form-group col-sm-6">
					    <label for="salary-expect" class="col-sm-4 control-label">SalaryExspect :</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control frm-cv" id="salaryExpect" name="salaryExpect" />
					    </div>
					  </div>

					  <div class="form-group col-sm-6">
					    <label for="email" class="col-sm-4 control-label">Email :</label>
					    <div class="col-sm-8">
					      <input type="email" class="form-control frm-cv" id="email" name="email" />
					    </div>
					  </div>

					  <div class="form-group col-sm-6">
					    <label for="upload-cv" class="col-sm-4 control-label">Upload CV :</label>
					    <div class="col-sm-8">
							<div class="custom-file-upload" data-toggle="tooltip" data-placement="top" title="">
							    <input type="file" id="file" name="cvfiles" class="form-control frm-cv" />
							</div>					      
					    </div>

					  </div>
					  <div class="form-group col-sm-12">
					    <label for="comments" class="col-sm-2 control-label" >Comment :</label>
					    <div class="col-sm-10">
					      <textarea class="form-control frm-cv margin-left comments-frm" name="comments" id="comments"></textarea>
					    </div>
					  </div>						  					  

					  <div class="form-group col-sm-12">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-search-record margin-left">Submit your CV</button>
					    </div>
					  </div>
					  <div class="clear"></div>
					</form>
				</div>
		';
		return $submit_cv;
	}

	public static function formRegisterTraining()
	{
		$form = Session::get('msg');
		$form .= '
			<div class="register-form">
				<div class="title-form">Training Registration</div>
				<form class="form-horizontal frm-register" method="post" action="'. route('submit.register.online') .'" id="frm_training_register" >
				  <div class="form-group">
				    <label for="fullName" class="col-sm-5 control-label">Full Name :</label>
				    <input type="hidden" name="_token" value="'. csrf_token() .'">
				    <div class="col-sm-6">
				      <input type="text" class="form-control frm-cv" id="fullName" name="fullName"  />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="organization" class="col-sm-5 control-label">Company / Organization :</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control frm-cv" id="organization" name="organization" >
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="position" class="col-sm-5 control-label">Position :</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control frm-cv" id="position" name="position" >
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="email" class="col-sm-5 control-label">Email :</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control frm-cv" id="email" name="email" >
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="contactNumber" class="col-sm-5 control-label">Course Title :</label>
				    <div class="col-sm-6">
				        <div data-toggle="tooltip" data-placement="left" title="" id="err_title">
				          <select data-placeholder="Choose a Title" class="chosen-select form-control frm-cv" tabindex="2" name="trainingTitle" id="trainingTitle" >
				            '. Helper::ctrl_training(Session::get('trc_id')) .'
				          </select>
				        </div>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="contactNumber" class="col-sm-5 control-label">Contact Number :</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control frm-cv" id="contactNumber" name="contactNumber" >
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="number-paticipant" class="col-sm-5 control-label">Number of Paticipant :</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control frm-cv" id="numberPaticipant" name="numberPaticipant" >
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="number-paticipant" class="col-sm-5 control-label">Description :</label>
				    <div class="col-sm-6">
				      <textarea class="form-control frm-cv" id="description" name="description" placeholder=""></textarea>
				    </div>
				  </div>				  				  				  				  				  
				  <div class="form-group">
				    <div class="col-sm-offset-5 col-sm-6">
				      <button type="submit" class="btn btn-search-record">Register</button>
				    </div>
				  </div>
				</form>
			</div>';

		return $form;
	}

	public static function ctrl_category()
	{
		$category = DB::table('tbl_job_category')
						->select('cat_id', 'cat_name')
						->orderBy('sequence')
						->get();

		$control  = '<option value=""></option>';
		foreach($category as $row){
			$control .= '<option value="'. $row->cat_id .'">'. $row->cat_name .'</option>';
		}

		return $control;
	}

	public static function ctrl_location()
	{
		$location = DB::table('tbl_job_location')
						->select('loc_id', 'loc_name')
						->orderBy('sequence')
						->get();

		$control  = '<option value=""></option>';
		foreach($location as $row){
			$control .= '<option value="'. $row->loc_id .'">'. $row->loc_name .'</option>';
		}

		return $control;
	}

	public static function ctrl_training($training_id=null)
	{
		$training = DB::table('tbl_training_course')
						->select('trc_id', 'trc_title')
						->where('customize', 0)
						->where('parent_id', '>', 0)
						->whereRaw('started_from >= CURDATE()')
						->orderBy('trc_title')
						->get();

		$control  = '<option value=""></option>';
		foreach($training as $row){
			if($row->trc_id == $training_id){
				$select = 'selected="selected"';
			}else{
				$select = '';
			}
			$control .= '<option value="'. $row->trc_id .'" '. $select .'>'. $row->trc_title .'</option>';
		}

		return $control;
	}
}

