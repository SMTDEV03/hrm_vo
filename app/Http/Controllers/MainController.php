<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\profile;

class MainController extends Controller
{
    //
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.registration');
    }

    // register new admin
    public function save(Request $request)
    {

        $request->validate(['fname' => 'required', 'lname' => 'required', 'email' => 'required|email|unique:users,email', 'password' => 'required|min:5|max:12']);

        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
         // role = (admin => 1 , Employee => 2)
        $user->role = '2';
        $user->status = '0';
        $user->is_deleted = '0';
        $save = $user->save();
        if($save){

            $profile = new profile();
            $profile->user_id = $user->id;
            $profile->fname = $request->fname;
            $profile->lname = $request->lname;
            $save = $profile->save();
    
         //return back()->with('success', 'you are successfully register');
            return redirect('/auth/login')->withSuccess(' Account Created Successfully Please Login');

        }
        else
        {
            return back()
                ->with('fail', 'Something went wrong, try again later');
        }
    }

    public function check(Request $request)
    {

        $credentials =  $request->validate(['email' => 'required|email', 'password' => 'required|min:5|max:12']);                                                                               
     

        if (Auth::attempt($credentials))
        {
            $request->session()
                ->regenerate();
            return redirect()
                ->route('admin.dashboard');
        }

        return back()
            ->withErrors(['email' => 'The provided credentials do not match our records.', ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('auth/login');
    }

}

