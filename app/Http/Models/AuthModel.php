<?php

namespace App\Http\Models;

use Hash;
use Session;
use Illuminate\Database\Eloquent\Model;

class AuthModel extends Model
{
    protected $table = 'users';

    public static function checkUser($user_mail=null, $pass=null)
    {
    	$msg_status = '';
    	$user = AuthModel::where('email', $user_mail)->first();
    	
		if(!empty($user)){
			if(Hash::check($pass, $user->password)):
				if($user->role_id == 4){
					$user_ses   = array('id'=> $user->id,'name'=> $user->name, 'role' => $user->role_id);
					Session::put($user_ses);
					$msg_status = 'logged';
				}else{
					$msg_status = 'You have no permission to download';
				}
			else:
				$msg_status = 'Your password incorrect';
			endif;
		}else{
			$msg_status     = 'Your account is not a member';
		}

		return $msg_status;
    }
}
