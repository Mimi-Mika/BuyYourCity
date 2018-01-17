<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use Mail;

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
            'name' => 'required|string|max:255|unique:users',
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
        Mail::raw('Verify your email !!! '.PHP_EOL.'Click HERE ==>  :  https://www.api.buyyourcity.ovh/verifyemail/'.$data['name'].'/'.Crypt::encryptString($data['name'].$data['email']), function($message) use ($data)
        {
            $message->subject('Welcome to Buy Your City');
            $message->from('no.reply.byc@gmail.com', 'Admin Buy Your City');
            $message->to($data['email']);
            $message->attach(storage_path('app/public/logo.png'));
        });
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'pointsAvailable' => 30,
            'ban' => 0,
            'validEmail' => 0,
            'admin' => 0,
            'image_id' => 1,
        ]);
    }

    protected function registered(Request $request, $user)
    {
        $user->generateToken();
        //return response()->json(['data' => $user->toArray()], 201);
        return response()->json([
                'data' => $user->toArray(),
                'token' => $user->getAttribute('api_token'),
        ], 201);
    }

    protected function verifyEmail($name, $string)
    {
        try{
            $nameEmail = Crypt::decryptString($string);
            $user = User::where('name', $name)->first();
            $user->name.$user->email == $nameEmail ? $user->validEmail = 1 : $user->validEmail = 0;
            $user->save();
            //return $user->validEmail ? response()->json(['data' => $user->toArray()], 200) : response()->json(['error' => 'No contents.'], 204);
            return redirect('http://buyyourcity.ovh');
        }
        catch(\Exception $e){
            return response()->json(['error' => 'No contents.'], 204);
        }
    }
}