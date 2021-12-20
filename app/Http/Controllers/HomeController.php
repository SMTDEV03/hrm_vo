<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\designation;
use App\Models\department;
use App\Models\profile;
use App\Models\User;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){

        return view('admin/dashboard');
    }   

    public function user_profile(){
        $profiledata    = $this->authinfo();
        $allDepart      = department::all();
        $allDesignation = designation::all();
        return view('pages.profile', compact('profiledata', 'allDepart', 'allDesignation'));        
    }

    public function userDashboard(){
        return view('user/dashboard');
    }  

    public function employeeList(){
       
        $users = DB::table('users')
                ->join('profiles', 'users.id', '=', 'profiles.user_id')
                ->select('users.*', 'profiles.*')
                ->where('users.role', '=', 2)
                ->where('users.is_deleted', '=', 0)
                ->get();

        return view('pages.employeeList',compact('users'));
    }
                                        
    public function authinfo()
    {
        $info = auth()->user();
        $logingUserID = $info->id;
        $userinfo = DB::table('users')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        ->select('users.*', 'profiles.*') 
        ->where('users.id', '=', $logingUserID)
        // is_deleted( 0 = active, 1 = inactive)
        ->where('users.is_deleted', '=', 0)
        ->get();

        return $userinfo;
    }

    public function updateProfile(Request $request){
    
        $userId                     = $request->user_id;  
        $updtprofile                = profile::findOrFail($userId);
        $updtprofile->fname         = ucfirst($request->fname);
        $updtprofile->lname         = ucfirst($request->lname);
        $updtprofile->department    = $request->department;
        $updtprofile->designation   = $request->designation;
        $updtprofile->gender        = $request->gender;
        $updtprofile->doj           = $request->doj;
        $updtprofile->dob           = $request->dob;
        $updtprofile->contact       = $request->contact;
        $updtprofile->blood_group   = $request->blood_group;
        $save = $updtprofile->save();
        if($save){
            return back()
            ->with('success', 'Profile Updated Successfully');
        }else{
            return back()                                                       
            ->with('fail', 'something went wrong');

        }

    }

    public function updateStatus(request $request, $id){
        if($request->ajax()){ 

            $users = User::find($id);
            if($users->status == 0){
                $users->status = 1;
            } elseif($users->status == 1){
                $users->status = 0;
            }
            $save = $users->save();
            if($save){
                return response('success');
            }
        }
        
    }

    public function userProfile($id){
        $users = DB::table('users')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        ->select('users.*', 'profiles.*')
        ->where('users.id', '=', $id)
        ->where('users.role', '=', 2)
        ->where('users.is_deleted', '=', 0)
        ->get(); 
        foreach($users as $data){
            $desid = $data->designation;
            $depid = $data->department;

        }
        $allDesignation = designation::find($desid);
        $allDepart = department::find($depid);
        return view('pages.userprofile', compact('users', 'allDesignation', 'allDepart'));
    }

}
