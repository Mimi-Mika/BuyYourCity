<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    public function login(Request $request)
    {
        $user = User::onlyTrashed()->where('email', $request->email)->get();

        if (!$user->isEmpty()){
            $user = $user->first();
            $user->deleted_at = NULL;
            $user->save();
        }

        $this->validateLogin($request);
        if ($this->attemptLogin($request)) {

            $user = $this->guard()->user();
            //$user->makeVisible('api_token');
            $user->generateToken();
            return response()->json([
                'data' => $user->toArray(),
                'token' => $user->getAttribute('api_token'),
            ]);
        }
        return $this->sendFailedLoginResponse($request);
    }
    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            $user->api_token = null;
            $user->save();
        }
        return response()->json([ 'data' => 'User logged out.' ], 200);
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [ 'error' => trans('auth.failed') ];
        return response()->json($errors, 422);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
}