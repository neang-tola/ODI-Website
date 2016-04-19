<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Models\BackendSlideModel as Slide;
use App\Http\Requests;
use AdminHelper;
use Validator;
use Session;
use Auth;

class BackendSlideshowController extends Controller
{
    public function __construct()
    {
        $chk_role = $this->check_user_role(Auth::user()->role_id);

        if(!empty($chk_role))
        return redirect($chk_role)->send();
    }

    public function index()
    {
        $data['title']          = 'Manage Slideshow';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.slideshow.list') => 'Manage Slideshow']);
        $data['ind']            = 1;
        $data['slide_info']     = Slide::getAllSlide(20);
        $data['slide_info']->setPath('/internal-bkn/loading-slideshow-list');

        return view('admin.slide_list')->with($data);
    }

    public function pagination()
    {
        $print_result       = '';
        $num_currentpage    = Input::get('page');
    
        $perpage            = 20;
        if(empty($num_currentpage)){
            $offset         = 0;
        }else{
            $offset         = $perpage * ($num_currentpage - 1);
        }

        $slideshow_info     = Slide::getAllSlide($perpage, $offset);

        if(!empty($slideshow_info)):
            foreach($slideshow_info as $slide):
                if($slide->img_status == 0){
                    $status = '<span class="status-s" id="status-'. $slide->img_id .'-1"><i class="inactive-button"></i></span>';
                }else{
                    $status = '<span class="status-s" id="status-'. $slide->img_id .'-0"><i class="active-button"></i></span>';
                }
                $print_result .= '
                                <tr>
                                  <td>'. ++$offset .'</td>
                                  <td><span class="slide-title">'. $slide->img_title .'</span></td>
                                  <td class="images"><img src="'. url('public/slideshows/'.$slide->img_name) .'" /></td>
                                  <td>
                                    <span class="order">'. $slide->img_sequense .'</span>
                                  </td>
                                  <td>'. date('d F, Y', strtotime($slide->created_at)) .'</td>
                                  <td>'. $status .'</td>
                                  <td><a href="'. route('admin.slideshow.edit') .'?eid='. $slide->img_id .'"><i class="edit-button"></i></a></td>
                                  <td><i class="del-button" id="del-'. $slide->img_id .'"></i></td>
                                </tr>
                            ';
            endforeach;
        endif;

        echo $print_result;
    }

    public function create()
    {
        $data['title']          = 'Manage Slideshow : New record';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.slideshow.list') => 'Manage Slideshow', 
                                                           route('admin.slideshow.create') => 'New Slideshow']);
        $data['heading_title']  = 'New Slideshow information';
        #$data['max_order']      = Slide::max('img_sequense') + 1;
        $data['my_route']       = route('admin.slideshow.insert');
        $data['chk_validat']    = 'return isValidate_slideshow()';
        $data['ctrl_link']      = Slide::controlLink();

        return view('admin.slide_form')->with($data);
    }

    public function store(Request $request)
    {
        extract($request->input());
        $msg     = '';
        $image   = $request->file('slideImage');

        $rules   = array('slide' => 'required|mimes:png,gif,jpeg');
        $validator = Validator::make(array('slide'=> $image), $rules);

          if ($validator->fails()) {
            // send back to the page with the input data and errors
            $msg = '<div class="alert alert-danger" role="alert">Slideshow image upload <b>fail</b></div>';
          }else {
            // checking file is valid.
            if ($image->isValid()) {
              $img_slide = Slide::uploadSlideShow($image, 'public/slideshows');
              
              if(empty($img_slide)){
                $msg = '<div class="alert alert-danger" role="alert">Slideshow have been added <b>fail</b></div>';
              }else{ 
                // sending back with message
                Slide::insertSlide($img_slide, $slideTitle, $slideCaption, $slidePosition, $slideLink);
                $msg = '<div class="alert alert-success" role="alert">Slideshow have been added <b>successful</b></div>'; 
              }
            }
            else {
              // sending back with error message.
              $msg = '<div class="alert alert-danger" role="alert">Slideshow uploaded image is not valid <b>error</b></div>';
            }
          }

          Session::flash('msg', $msg);
          return redirect()->back();
    }

    public function edit()
    {
        $slide_id               = Input::get('eid'); 
        $data['title']          = 'Manage Slideshow : Edit record';
        $data['breadcrumb']     = AdminHelper::breadcrumb([route('admin.slideshow.list') => 'Manage Slideshow', 
                                                           route('admin.slideshow.edit') => 'Edit Slideshow']);

        $data['heading_title']  = 'Edit Slideshow information';
        $data['my_route']       = route('admin.slideshow.update');
        $data['chk_validat']    = 'return isValidate_update_slideshow()';
        $data['info']           = Slide::getOneRow($slide_id);
        $data['ctrl_link']      = Slide::controlLink();

        return view('admin.slide_form')->with($data);
    }

    public function update(Request $request)
    {
        extract($request->input());
        $msg     = '';
        $image   = $request->file('slideImage');

               
        $img_slide = Slide::uploadSlideShow($image, 'public/slideshows');

                // sending back with message
        $slideshow = Slide::updateSlide($slideId, $img_slide, $slideTitle, $slideCaption, $slidePosition, $slideLink);

        if($slideshow == true){
            $msg = '<div class="alert alert-success" role="alert">Slideshow have been updated <b>successful</b></div>'; 
        }else{
            $msg = '<div class="alert alert-danger" role="alert">Slideshow update was fail <b>error</b></div>';
        }

        Session::flash('msg', $msg);
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $search_val   = $request->input('search');
        $print_result = '';
        $ind = 0;

        if(!empty($search_val)){
            $result_search = Slide::findSlideshow($search_val);

            if(!empty($result_search)):
                foreach($result_search as $slide):
                    if($slide->img_status == 0){
                        $status = '<span class="status-s" id="status-'. $slide->img_id .'-1"><i class="inactive-button"></i></span>';
                    }else{
                        $status = '<span class="status-s" id="status-'. $slide->img_id .'-0"><i class="active-button"></i></span>';
                    }
                    $print_result .= '
                                    <tr>
                                      <td>'. ++$ind .'</td>
                                      <td><span class="slide-title">'. $slide->img_title .'</span></td>
                                      <td class="images"><img src="'. url('public/slideshows/'.$slide->img_name) .'" /></td>
                                      <td>
                                        <span class="order">'. $slide->img_sequense .'</span>
                                      </td>
                                      <td>'. date('d F, Y', strtotime($slide->created_at)) .'</td>
                                      <td>'. $status .'</td>
                                      <td><a href="'. route('admin.slideshow.edit') .'?eid='. $slide->img_id .'"><i class="edit-button"></i></a></td>
                                      <td><i class="del-button" id="del-'. $slide->img_id .'"></i></td>
                                    </tr>
                                ';
                endforeach;
            else:
                $print_result .= '<tr><td colspan="8">
                                    <div class="alert alert-info"><strong>Not found</strong> your key word search not match to Slideshow title.</div>
                                 </td></tr>';
            endif;
        }else{
            $slideshow_info    = slide::getAllSlide(20);

            foreach($slideshow_info as $slide):

                    if($slide->img_status == 0){
                        $status = '<span class="status-s" id="status-'. $slide->img_id .'-1"><i class="inactive-button"></i></span>';
                    }else{
                        $status = '<span class="status-s" id="status-'. $slide->img_id .'-0"><i class="active-button"></i></span>';
                    }
                    $print_result .= '
                                    <tr>
                                      <td>'. ++$ind .'</td>
                                      <td><span class="slide-title">'. $slide->img_title .'</span></td>
                                      <td class="images"><img src="'. url('public/slideshows/'.$slide->img_name) .'" /></td>
                                      <td>
                                        <span class="order">'. $slide->img_sequense .'</span>
                                      </td>
                                      <td>'. date('d F, Y', strtotime($slide->created_at)) .'</td>
                                      <td>'. $status .'</td>
                                      <td><a href="'. route('admin.slideshow.edit') .'?eid='. $slide->img_id .'"><i class="edit-button"></i></a></td>
                                      <td><i class="del-button" id="del-'. $slide->img_id .'"></i></td>
                                    </tr>
                                ';

            endforeach;         
        }

        echo $print_result;
    }

    public function reOrder()
    {
        $user_order   = Input::get('up_order');
        $up_order     = explode('-', $user_order);
        $print_result = '';
        $ind  = 0;

        if(count($up_order) == 2){
            $order    = Slide::updateOrder($up_order[1], $up_order[0]);
            if($order == true){
                $slideshow_info     = Slide::getAllSlide(20);
    
                foreach($slideshow_info as $slide):
                    if($slide->img_status == 0){
                        $status = '<span class="status-s" id="status-'. $slide->img_id .'-1"><i class="inactive-button"></i></span>';
                    }else{
                        $status = '<span class="status-s" id="status-'. $slide->img_id .'-0"><i class="active-button"></i></span>';
                    }
                    $print_result .= '
                                    <tr>
                                      <td>'. ++$ind .'</td>
                                      <td><span class="slide-title">'. $slide->img_title .'</span></td>
                                      <td class="images"><img src="'. url('public/slideshows/'.$slide->img_name) .'" /></td>
                                      <td>
                                        <span class="order">'. $slide->img_sequense .'</span>
                                      </td>
                                      <td>'. date('d F, Y', strtotime($slide->created_at)) .'</td>
                                      <td>'. $status .'</td>
                                      <td><a href="'. route('admin.slideshow.edit') .'?eid='. $slide->img_id .'"><i class="edit-button"></i></a></td>
                                      <td><i class="del-button" id="del-'. $slide->img_id .'"></i></td>
                                    </tr>
                                ';
                endforeach;
       
            }
        } // End count number param past from ajax

        echo $print_result;
    }

    public function destroy()
    {
        $slide_delete    = Input::get('did');

        if(is_numeric($slide_delete)){
            Slide::removeImage($slide_delete);
            $destroy    = Slide::where('img_id', '=', $slide_delete)->delete();

            if($destroy == 1):
                echo 'success';
            else:
                echo 'error';
            endif;     
        }
    }

    public function updateStatus()
    {
        $slide_status  = explode('-', Input::get('sid'));
   
        if(count($slide_status) == 2){
            $slideshow = Slide::where('img_id', '=', $slide_status[0])
                       ->update(['img_status' => $slide_status[1]]);

            if(!empty($slideshow)):
                echo 'success';
            else:
                echo 'error';
            endif;
        }
    }
}
