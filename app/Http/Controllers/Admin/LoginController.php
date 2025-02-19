<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function LoginIndex (){

        return view ('admin.login');
    }

    public function AuthLogin(Request $request){
    
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->passes()) {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

                if (Auth::guard('admin')->user()->role != 'admin') {
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error', 'You Have no access here');
                }
                return redirect()->route('admin.dashboard');

            } 
            else {
                return redirect()->route('admin.login')->with('error', 'Email or password is incorrect. Please check!');
            }

        } 
        else {
            return redirect()->route('admin.login')->withInput()->withErrors($validator);
        }
        
        }


     public function logout(){
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
            
        }  


    
    
}
