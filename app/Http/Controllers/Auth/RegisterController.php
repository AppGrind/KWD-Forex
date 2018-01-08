<?php

namespace App\Http\Controllers\Auth;

use App\Jobs\SendWelcomeEmail;
use App\Notifications\NewUserWelcome;
use Carbon\Carbon;
use Mail;
use App\Mail\Welcome;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/login';

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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'displayname' => 'required|string|max:255',
            'contactnumber' => 'required|string|max:13',
            'address' => 'required|string|max:255',
            'town' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'postalcode' => 'required|numeric',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
        $user = User::create([
                            'code' => strtoupper(str_random(6)),
                            'status_is' => 'not verified',
                            'firstname' => $data['firstname'],
                            'lastname' => $data['lastname'],
                            'displayname' => $data['displayname'],
                            'contactnumber' => $data['contactnumber'],
                            'address' => $data['address'],
                            'town' => $data['town'],
                            'province' => $data['province'],
                            'postalcode' => $data['postalcode'],
                            'email' => $data['email'],
                            'password' => bcrypt($data['password']),
        ]);

        $user->actAs('member');

        $user->notify(new NewUserWelcome());
        //
        SendWelcomeEmail::dispatch($user);

        return $user;
    }

}
