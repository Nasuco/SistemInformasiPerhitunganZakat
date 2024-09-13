<?php
 
namespace App\Http\Controllers\Auth;
 
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;

use Illuminate\Http\Request;
 
class LoginController extends Controller
{
 
    use AuthenticatesUsers;
 
    protected $redirectTo = RouteServiceProvider::HOME;
 
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
 
    public function login(Request $request)
    {   
        $input = $request->all();
       
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
       
        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            $user = auth()->user();
        
            $userType = $user->type; // Access the 'type' attribute directly
        
            // Redirect sesuai dengan peran
            switch ($userType) {
                case 'panitia':
                    return redirect()->route('panitia.home');
                    break;
        
                case 'muzakki':
                    return redirect()->route('muzakki.home');
                    break;
        
                default:
                    // Default redirect jika tidak sesuai dengan peran yang diharapkan
                    return redirect()->route('home');
                    break;
            }
        } else {
            return redirect()->route('login')
                ->with('error', 'Email-Address and Password are wrong.');
        }
            
    }
}

