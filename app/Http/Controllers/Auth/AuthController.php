<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Models\SiteModel as MySite;
use App\Http\Models\AuthModel as MyAuth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/internal-bkn/dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function member_login()
    {
        $data['title']          = 'Member Login';
        $data['meta_key']       = 'Member ODI, Login as member';
        $data['meta_des']       = 'Free Resourse for member download';

        $data['partner_logo']   = MySite::getPartner();

        return view('site.member_login')->with($data);
    }

    public function check_member_login(Request $request)
    {
        $check_member = MyAuth::checkUser($request->memberMail, $request->memberPassword);
  
        if($check_member == 'logged'){
            return redirect('/free-resources');
        }else{
            Session::flash('msg', $check_member);
            return redirect()->back();
        }
    }
}
