<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Playlis;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PlaylistController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Mail;
use App\Mail\verifyEmail;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'country' => 'required|string|max:255',
            'birth' => 'required|',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        Session::flash('status', 'Gracias por registrarse, es necesario que verifique su correo para activar su cuenta');
        $user = User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'country' => $data['country'],
            'birth' => $data['birth'],
            'verifyToken' => Str::random(40),
        ]);
        $thisUser = User::FindOrFail($user->id);
        $this->sendEmail($thisUser);

        $id_user=$user->id;
        Playlis::create([
          'id_user' => $id_user,
        ]);

        return $user;
    }

    public function sendEmail($thisUser)
    {
        Mail::to ($thisUser['email'])->send(new verifyEmail($thisUser));
    }
    public function verifyEmailFirst()
    {
      return view('email.verifyEmailFirst');
    }

    public function sendEmailDone($email, $verifyToken)
    {
      $user = User::where(['email'=>$email, 'verifyToken'=> $verifyToken])->first();
      if ($user) {
        return user::Where(['email'=>$email, 'verifyToken'=> $verifyToken])-> update(['status'=>'1', 'verifyToken'=>NULL]);
      }else {
        return 'usuario no encontrado';
      }
    }
}
