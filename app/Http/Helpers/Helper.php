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
	    		$url_datail = '/training-course-detail-'.$trc->trc_id.'-'.Helper::encode_title($trc->trc_title);
                $print_result .= '
							<tr>
								<td>'. ++$start .'</td>
								<td class="title"><a href="'. $url_datail .'" title="'.$trc->trc_title.'">'. $trc->trc_title .'</a></td>
								<td>'. Helper::training_date($trc->started_from, $trc->started_to) .'</td>
								<td>'. $trc->trc_duration .'</td>
								<td>'. $trc->trc_language .'</td>
								<td>$ '. $trc->trc_price .'</td>
								<td><a href="/register-online?course='. $trc->trc_id .'">Register</a></td>
							</li>
                            ';

                $print_result_m .= '
							<li class="mobile-body-list">
								<div class="course">
									<span><b>Course Title</b>: <a href="'. $url_datail .'" title="'.$trc->trc_title.'">'. $trc->trc_title .'</a></span>
									<span><b>Date</b>: '. Helper::training_date($trc->started_from, $trc->started_to) .'</span>
									<span><b>Duration</b>: '. $trc->trc_duration .'</span>
									<span><b>Language</b>: '. $trc->trc_language .'</span>
									<span><b>Price</b>: $ '. $trc->trc_price .'</span>
									<span><b>Register</b>: <a href="/register-online?course='. $trc->trc_id .'"> Register </a></span>						
								</div>
							</li>';
			} // End foreach

			if(!empty($print_result)){
				if($header == true){
					$return_result = '
					<div id="tmpTraining" class="table-responsive">
						<div class="loading"></div>
						<table class="table visible-lg" id="result_output">
		                	<thead>
			                	<tr>
			                       <th width="5%">No</th>
			                       <th width="40%">Course Title</th>
			                       <th width="15%">Date</th>
			                       <th width="10%">Duration</th>
			                       <th width="10%">Language</th>
			                       <th width="10%">Price</th>
			                       <th width="10%" class="last">&nbsp;</th>
			                    </tr>
		                	</thead>
							<tbody>'
							. $print_result .
							'</thead>
							<tfoot>
								<td colspan="7">'.@$pagination.' </td>
							</tfoot>
						</table>
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
							<tr>
								<td>'. ++$start .'</td>
								<td class="title">'. $trc->trc_title .'</td>
								<td>'. $trc->training_type .'</td>					
							</tr>
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
					<div id="tmpCustomize" class="table-responsive">
					<div class="loading"></div>
						<table class="table visible-lg" id="result_output">
		                	<thead>
			                	<tr>
			                       <th width="5%">No</th>
			                       <th width="70%">Courses Title</th>
			                       <th width="25%" class="last">Type</th>
			                    </tr>
		                	</thead>
		                	<tbody>'
								. $print_result .
						   '</tbody>
						   <tfoot>
						   		<tr>
									<td colspan="3">'.@$pagination.' </td>
								</tr>
							</tfoot>
						</table>
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
	    		$url_detail = '/job-detail-'.$job->job_id.'-'.Helper::encode_title($job->job_title);
                $print_result .= '
							<tr>
								<td>'. ++$start .'</td>
								<td class="title"><a href="/job-detail-'. $url_detail .'">'. $job->job_title .'</a></td>
								<td class="title">'. $job->cat_name .'</td>
								<td>'. date('d F, Y', strtotime($job->close_date)) .'</td>
								<td>'. $job->loc_name .'</td>					
							</tr>
                            ';

                $print_result_m .= '
							<li class="mobile-body-list">
								<div class="course">
									<span><b>Position</b>: <a href="'. $url_detail .'">'. $job->job_title .'</a></span>
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
					<div id="tmpJob" class="table-responsive">
						<div class="loading"></div>
						<table class="table visible-lg" id="result_output">
							<thead>
								<tr>
									<th width="5%">No</th>
									<th width="46%">Position</th>
									<th width="20%">Category</th>
									<th width="12%">Close Date</th>
									<th width="12%" class="last">Location</th>
								</tr>
							</thead>
							<tbody>'
							. $print_result .
						   '</tbody>
						    <tfoot>
						    	<tr>
									<td colspan="5"><span class="footer">'. @$pagination .'</span></td>
								</tr>
							</tfoot>
						</table>
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
								<tr>
									<td>'. ++$start .'</td>
									<td class="title">'. $res->res_title .'</td>
									<td class="title">'. $res->resource_type .'</td>
									<td><a href="/get-free-resources?resource_file='. $res->res_file .'"><span class="down_res"><i class="glyphicon glyphicon-download-alt"></i></span></a></td>					
								</tr>
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
					<div id="tmpResource" class="table-responsive">
						<div class="loading"></div>
						<table class="table visible-lg" id="result_output">
							<thead>
								<tr>
									<th width="5%">No</th>
									<th width="65%">Description</th>
									<th width="20%">Category</th>
									<th width="10%" class="last">Download</th>
								</tr>
							</thead>
							<tbody>'
							. $print_result .
						   '</tbody>
						    <tfoot>
						    	<tr>
									<td colspan="4">'.@$pagination.' </td>
								</tr>
							</tfoot>
						</table>
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

	public static function formRegisterTraining($trc_id=null)
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
				            '. Helper::ctrl_training($trc_id) .'
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

	public static function templateGallery($gallery_id=null)
	{
		$gallery_list  = '';
		$ind  = 0;

		if(!empty($gallery_id)){
			$my_gallery= Helper::getGallery($gallery_id);
			if(!empty($my_gallery))
			{
				foreach ($my_gallery as $gal) {
					if($ind == 0){	$active = 'active';
					}else{			$active = '';	}

					$gallery_list .= '<div class="item '.$active.'">
										<img src="/public/gallery/'.$gal->img_name.'" alt="Gallery-'. $ind .'" />
									  </div>';
					$ind++;
				}

				$print_gallery = '
	            <div id="gallery" class="carousel slide carousel-fade" data-ride="carousel">
	                <div class="carousel-inner">
	                    '. $gallery_list .'
	                </div>
	                <!-- Carousel nav -->
	                <a class="left carousel-control" href="#gallery" role="button" data-slide="prev">
	                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	                    <span class="sr-only">Previous</span>
	                </a>
	                <a class="right carousel-control" href="#gallery" role="button" data-slide="next">
	                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	                    <span class="sr-only">Next</span>
	                </a>
	            </div>';

	            return $print_gallery;
	        }
        }
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

	public static function getGallery($gal_id=NULL)
	{
		$gallery = DB::table('tbl_image')
						->select('img_name')
						->where('conditional_type', 3)
						->where('conditional_id', $gal_id)
						->get();

		if(!empty($gallery))
			return $gallery;
	}

	public static function templateAlertTraining($result=array(), $receiver_name=null, $training_date=null, $url=null)
	{
		$print_tmp  = '';
		$ind		= 0;
		if(!empty($result)){

			foreach($result as $row){
				$url_datail = $url.'/training-course-detail-'.$row->trc_id.'-'.Helper::encode_title($row->trc_title);
				$print_tmp .= '
					<tr>
						<td style="border: 1px solid #dddddd; text-align:center; padding: 7px 5px;">'. ++$ind .'</td>
						<td style="border: 1px solid #dddddd; padding: 5px"><a href="'. $url_datail .'" target="_blank">'. $row->trc_title .'</a></td>
						<td style="border: 1px solid #dddddd; text-align:center; padding: 7px 5px;">'. Helper::training_date($row->started_from, $row->started_to) .'</td>
						<td style="border: 1px solid #dddddd; text-align:center; padding: 7px 5px;">'. $row->trc_duration .'</td>
						<td style="border: 1px solid #dddddd; text-align:center; padding: 7px 5px;">'. $row->trc_language .'</td>
						<td style="border: 1px solid #dddddd; text-align:center; padding: 7px 5px;">$ '. $row->trc_price .'</td>
					</tr>
				';
			}

			$print_result = '
				<p style="font-family: Cambria, Georgia, serif; font-size: 16px color: #333;"><strong>Dear '. $receiver_name .'</strong></p>
				<p style="font-family: Cambria, Georgia, serif; font-size: 14px color: #333;">Warmest greeting from ODI Asia!</p>
				 
				<p style="font-family: Cambria, Georgia, serif; font-size: 14px color: #333;">Are you looking for practical training courses on business and leadership skills?<br/>
				We are pleased to share with you our upcoming training courses in <strong>'. $training_date .'</strong>.</p>
				 
				<p style="font-family: Cambria, Georgia, serif; font-size: 14px color: #333;">Feel free to contact us if you are interested in any course, our training team is looking forward to answer your inquiry and help you to understand how you will benefit from the courses.</p>
				<h2 style="text-align:center; color:#00ADEF; ont-family: Cambria, Georgia, serif; font-size: 22px;">
				Public Training Schedule in '. $training_date .'
				</h2>
				<table style="border-collapse: collapse; width:100%">
					<tr>
						<th style="background: #00ADEF; border: 1px solid #dddddd; color: #FFF; padding: 10px 0; text-align:center; width:5%;">No</th>
						<th style="background: #00ADEF; border: 1px solid #dddddd; color: #FFF; padding: 10px 0; text-align:center; width:50%;">Course Title</th>
						<th style="background: #00ADEF; border: 1px solid #dddddd; color: #FFF; padding: 10px 0; text-align:center; width:15%;">Dates</th>
						<th style="background: #00ADEF; border: 1px solid #dddddd; color: #FFF; padding: 10px 0; text-align:center; width:10%;">Duration</th>
						<th style="background: #00ADEF; border: 1px solid #dddddd; color: #FFF; padding: 10px 0; text-align:center; width:10%;">Language</th>
						<th style="background: #00ADEF; border: 1px solid #dddddd; color: #FFF; padding: 10px 0; text-align:center; width:10%;">Fee</th>
					</tr>
				  '. $print_tmp .'
				</table>

				<p style="font-family: Cambria, Georgia, serif; font-size: 14px color: #333;">
				<strong>Please click on the course title to view detail course outline.</strong>
				</p>
				<br/><br/>
				<p>Best Regards,<br/>Nisay</p>
				<br/><br/>
				<img src="'. $url .'/public/_images/logo-odi.png" />
				<p style="color: #00ADEF;"><strong>Ms. KONG Sennisay</strong><br/>
				Training Department<br/>
				Office : +855 23 722 431<br/>
				Mobile : +855 77 333 534<br/>
				Email : <a href="mailto:training2@odi-asia.com">training2@odi-asia.com</a><br/>
				Website : <a href="http://www.odi-asia.com" target="_blank" style="color: #00ADEF;">www.odi-asia.com</a><br/>
				Address : Bayon Building, 4th Floor, No. 33-34, Sangkat Monorom,
				Khan 7 Makara, Phnom Penh, Cambodia.</p>';
			

			return $print_result;
		}
	}

	public static function templateAlertJob($result=array(), $url=null)
	{
		if(!empty($result)){
			$print_tmp = '';
			$ind 	   = 0;
			foreach($result as $row){
	    		$url_detail = $url.'/job-detail-'.$row->job_id.'-'.Helper::encode_title($row->job_title);
                $print_tmp .= '
							<tr>
								<td style="border: 1px solid #dddddd; text-align:center;">'. ++$ind .'</td>
								<td style="border: 1px solid #dddddd; padding: 7px 5px;"><a href="'. $url_detail .'" target="_blank">'. $row->job_title .'</a> <sup style="color: #00ADEF">New</sup></td>
								<td style="border: 1px solid #dddddd; text-align:center; padding: 7px 5px;">'. date('d F, Y', strtotime($row->close_date)) .'</td>
								<td style="border: 1px solid #dddddd; text-align:center; padding: 7px 5px;">'. $row->loc_name .'</td>					
							</tr>
                            ';
			}

			$print_result = '
				<p style="font-family: Cambria, Georgia, serif; font-size: 16px color: #333;">Dear Prospect candidate,</p>
				<p style="font-family: Cambria, Georgia, serif; font-size: 14px color: #333;">Are you looking to advance your career? Many new jobs are waiting for you.</p>

				<table style="border-collapse: collapse; width:100%">
					<tr>
						<th colspan="4" style="background: #00ADEF; border: 1px solid #00ADEF; border-bottom: 1px solid #dddddd; color: #FFF; padding: 7px 0; text-align:center; width:100%;">Job Announcement</th>
					</tr>
					<tr>
						<td style="border: 1px solid #dddddd; text-align:center; padding: 10px 0;"><strong>No</strong></td>
						<td style="border: 1px solid #dddddd; text-align:center; padding: 10px 0;"><strong>Position</strong></td>
						<td style="border: 1px solid #dddddd; text-align:center; padding: 10px 0;"><strong>Closing Date</strong></td>
						<td style="border: 1px solid #dddddd; text-align:center; padding: 10px 0;"><strong>Location</strong></td>
					</tr>
				  '. $print_tmp .'
				</table>

				<p>Click to view the detail of the job.<br/>
				Our recruitment is happy to welcome all your questions and assist you to find your dream employer.</p>
				</p>
				<br/><br/>
				<p>Best Regards,<br/>Recruitment Team</p>
				<br/><br/>
				<img src="'. $url .'/public/_images/logo-odi.png" />
				<p style="color: #00ADEF;"><strong>Ms. CHEN Rany</strong><br/>
				Recruitment Department<br/>
				Office : +855 23 722 431<br/>
				Mobile : +855 77 333 423 / +855 77 333 524<br/>
				Email : <a href="mailto:recruitment@odi-asia.com">recruitment@odi-asia.com</a><br/>
				Website : <a href="http://www.odi-asia.com" target="_blank" style="color: #00ADEF;">www.odi-asia.com</a><br/>
				Address : Bayon Building, 4th Floor, No. 33-34, Sangkat Monorom,
				Khan 7 Makara, Phnom Penh, Cambodia.</p>';
			

			return $print_result;
		}
	}
}	

