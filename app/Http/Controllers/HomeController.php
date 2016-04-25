<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Models\SiteModel as MySite;
use Validator;
use Response;
use Session;
use Helper;
use Mail;

class HomeController extends Controller
{
    public function index()
    {
        $seo = MySite::getCotnentSEO(1);
        $data['title']          = $seo->title;
        $data['meta_key']       = $seo->meta_key;
        $data['meta_des']       = $seo->meta_des;
        $data['menu']           = MySite::getMenu();
        $data['slideshow']      = MySite::getSlideshow();
        $data['partner_logo']   = MySite::getPartner();

        $data['training_info']  = MySite::getTrainingInfo(20);
        $data['training_info']->setPath('/loading-training-course');
        
        return view('site.index')->with($data);
    }

    public function page($slug)
    {
        $data['content']        = MySite::getContent($slug);
        if(!empty($data['content'])){
            $data['menu']           = MySite::getMenu(@$data['content']->m_id);

            $data['title']          = $data['content']->ctt_title;
            $data['meta_key']       = $data['content']->meta_key;
            $data['meta_des']       = $data['content']->meta_des;

            switch (@$data['content']->con_plus) {
                case 1:
                    $training  = MySite::getTrainingInfo(20);
                    $training->setPath('/loading-training-course');
                    $data['content_info'] = Helper::templateTrainingCourse(0, $training, $training->render());
                    break;
                case 2:
                    $customize = MySite::getTrainingCus(20);
                    $customize->setPath('/loading-customize-training');
                    $data['content_info'] = Helper::templateCustomizeCourse(0, $customize, $customize->render());
                    break;
                case 3:
                    $job       = MySite::getJobInfo(30);
                    $job->setPath('/loading-job-vacancy');
                    $data['content_info'] = Helper::templateJobVacancy(0, $job, $job->render());
                    break;
                case 4:
                    $resource  = MySite::getResourceInfo(20);
                    $resource->setPath('/loading-resources');
                    $data['content_info'] = Helper::templateResource(0, $resource, $resource->render());
                    break;
                case 5:
                    $data['content_info'] = Helper::formSubmitCV();
                    break;
                case 6:
                    $training_id = Input::get('course');
                    if(!empty($training_id)){
                        $trc_id  = $training_id; 
                    }else{
                        $trc_id  = Session::get('trc_id');
                    }

                    $data['content_info'] = Helper::formRegisterTraining(@$trc_id);
                    break;
                default:
                    $data['content_info'] = '';
                    break;
            }

            $data['partner_logo']   = MySite::getPartner();

            return view('site.page')->with($data);
        }
        else{
            abort(404);
        }
    }

    public function download()
    {
        $file_name   = Input::get('resource_file');

        if(!empty($file_name)){
            if(Session::get('role') == 4){
                $file    = "./public/files/".$file_name;
                return Response::download($file);
            }else{
                return redirect('/odi-member-login');
            }
        }
    }

    public function jobDetail($job_id, $jod_title)
    {
        $data['job_info']       = MySite::getJobDetail($job_id);

        $data['title']          = $data['job_info']->job_title;
        $data['meta_key']       = '';
        $data['meta_des']       = strip_tags($data['job_info']->job_des);

        $data['partner_logo']   = MySite::getPartner();
        Session::flash('job_title', $data['job_info']->job_title);

        return view('site.job_detail')->with($data);
    }

    public function trainingDetail($training_id, $training_title)
    {
        Session::flash('trc_id', $training_id);
        $data['training_info']  = MySite::getTrainingDetail($training_id);
        $data['title']          = $data['training_info']->trc_title;
        $data['meta_key']       = '';
        $data['meta_des']       = strip_tags($data['training_info']->trc_content);

        $data['content']        = MySite::getContent('training');
        $data['menu']           = MySite::getMenu(@$data['content']->m_id);
        $data['partner_logo']   = MySite::getPartner();

        return view('site.training_detail')->with($data);
    }

    public function registerOnline(Request $request)
    {
        extract($request->input());

        $val_register = array('full_name'   => @$fullName,
                              'company'     => @$organization,
                              'position'    => @$position,
                              'email'       => @$email,
                              'phone'       => @$contactNumber,
                              'trc_id'      => @$trainingTitle,
                              'phone_paticipant' => @$numberPaticipant,
                              'description' => @$description,
                              'created_at'  => date('Y-m-d H:i:s'));

        $add_trainer  = MySite::registerTainer($val_register);
        $to_email     = MySite::getEmail();

        if($add_trainer == true){
            $data['text']       = 'Today we have member register for training course.<br/>
                                   Trainer Name : '. $fullName .'<br/>
                                   Course Title : '. MySite::getTrainingTitle($trainingTitle) .'<br/>
                                   Register on  : '. date('d F, Y');

            Mail::send('site.template_mail_odi', $data, function($mail){
                $mail->to($to_email['training'])->subject('Alert from ODI-Asia :: Training Course Register');
            });

            $msg = '<div class="alert alert-success" role="alert">Registration of training course is <b>successful</b></div>';
        }else{
            $msg = '<div class="alert alert-danger" role="alert">Registration of training course is <b>fail</b></div>';
        }

        Session::flash('msg', $msg);

        return redirect()->back();
    }

    public function candidateCV(Request $request)
    {
        extract($request->input());

        $document  = Input::file('cvfiles');

        $rules     = array('document' => 'required|max:10240|mimes:pdf,doc,docx'); 
        $validator = Validator::make(array('document'=> $document), $rules);

        if($validator->passes()){
            $candidate_doc = MySite::uploadDocument($document, 'public/candidate_cvs');

            $cv_rgister = array('full_name' => $fullName,
                                'gender'   => $gender,
                                'position' => $position,
                                'job_title'=> $applyFor,
                                'phone'    => $phoneNumber,
                                'email'    => $email,
                                'salary'   => $salaryExpect,
                                'document' => $candidate_doc,
                                'comment'  => $comments,
                                'created_at' => date('Y-m-d H:i:s'));

            $add_candidate = MySite::registerCandidate($cv_rgister);
            $to_email      = MySite::getEmail();

            if($add_candidate == true){

                $data['text']       = 'Today we got CV from candidate.<br/>
                                       Candidate Name : '. $fullName .'<br/>
                                       Apply Position : '. $applyFor .'<br/>
                                       Register on  : '. date('d F, Y');

                Mail::send('site.template_mail_odi', $data, function($mail){
                    $mail->to($to_email['job'])->subject('Alert from ODI-Asia :: Candidate Submit CV');
                });
                $msg = '<div class="alert alert-danger" role="alert">Your CV have been submited <b>successful</b></div>';
            }
        }else{
            $msg = '<div class="alert alert-danger" role="alert">Your CV have problem during upload <b>Error</b></div>';
        }

        Session::flash('msg', $msg);

        return redirect()->back();
    }

    public function settingAlertJob()
    {
        $data['content']        = MySite::getContent('submit-cv');
        if(!empty($data['content'])){
            $data['menu']       = MySite::getMenu(@$data['content']->m_id);

            $data['title']      = 'Set up job alert criteria';
            $data['meta_key']   = $data['content']->meta_key;
            $data['meta_des']   = $data['content']->meta_des;

            return view('site.job_alert_setting')->with($data);
        }
    }

    public function saveAlertJob(Request $request)
    {

    }
    
    public function searchContent(Request $request)
    {
        $keyword = $request->input('search');

        $data['title']          = 'Found the result form ODI-Asia';
        $data['meta_key']       = 'search content, search training, search job vacancy';
        $data['meta_des']       = 'Found the result for user such as content from article information, training information and job vacancy';
        $data['menu']           = MySite::getMenu();
        $data['slideshow']      = MySite::getSlideshow();

        $data['training']       = MySite::findTrainingInfo($keyword);
        $data['article']        = MySite::findContentInfo($keyword);
        $data['job_vacancy']    = MySite::findContentJobInfo($keyword);
        $data['search']         = $keyword;
        $data['partner_logo']   = MySite::getPartner();
        
        return view('site.result_search')->with($data);
    }
}
