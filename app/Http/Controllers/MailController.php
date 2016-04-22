<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Models\SiteModel as MySite;
use Helper;
use Mail;

class MailController extends Controller
{
    public function index()
    {
    	$data['Title'] = 'Here is my title';
    	$data['Email'] = 'I will express my email.' ;

/*    	Mail::send('templateEmail', ['data' => $data], function($mail) use ($data){
    		$mail->to('tolarainy@gmail.com', 'rainy')->from('toladev@odi-asia.com')->subject('Test mail');
    	});*/
		Mail::send('site.template_alert_job', ['user' => 'Tasol Solution Pvt Ltd'], function ($m){
			//$m->from('varsadedj@gmail.com', 'Laravel Testing');
			$m->to('tolarainy@gmail.com', 'Rainy')->subject('Testing Email');
		});
    }

    public function sendJobAlert()
    {
    	$data['ind'] = 0;
    	$data['result'] = MySite::getJobInfo(30);

    	return view('site.template_alert_candidate')->with($data);
    }

    public function sendTrainingAlert()
    {
    	$data['ind'] = 0;
    	$data['result'] = MySite::getTrainingInfo(30);
    	$data['receiver_name'] = 'Tola';
    	$data['training_date'] = 'April - May 2016';

    	return view('site.template_alert_trainer')->with($data);
    }
}
