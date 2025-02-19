<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class loginController extends Controller
{
    public function LoginIndex (){

        return view ('user.login');
    }

    
    public function AuthLogin(Request $request){
    
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('account.dashboard');
            } else {
                return redirect()->route('account.login')->with('error', 'Email or password is incorrect. Please check!');
            }
        } else {
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }
        
        }
    

        public function RegisterIndex (){
            return view('user.registration');
        }


        public function AuthRegistration(Request $request){
            
            $validator = Validator::make ($request->all(),[
                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password'=>'required',
            ]);
            
            if ($validator->passes()){

                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = $request->password;
                $user->role = 'user';
                $user->save();

                return redirect()->route('account.login')->with('Success','User Created Successfully');


            }
            else{
                return redirect()->route('account.login')->withInput()->withErrors($validator);
    
            }

        }


        public function logout(){
            Auth::logout();
            return redirect()->route('account.login');
            
        }

          

        
        

}
