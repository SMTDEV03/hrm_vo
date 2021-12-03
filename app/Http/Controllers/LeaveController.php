<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\designation;
use App\Models\department;
use App\Models\profile;
use App\Models\leavestype;
use App\Models\employee_application;

use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index(){

        $allLeavetypes = leavestype::all();
        return view('pages.leavestype',compact('allLeavetypes'));
    }

    public function add_leaves_type(Request $request){

        //dd($request->all()); die;

        $validate = $request->validate([
            'leavename' => 'required',
            'leaveday' => 'required'
        ]);
        
        $leavemodel = new leavestype();        
        $leaveId = $request->id;

        /***For Add New Leave Type***/
        if(empty($leaveId))
        {
            $leavemodel->name        = $request->leavename;
            $leavemodel->leave_days  = $request->leaveday;
            $save = $leavemodel->save();             
            if($save){
                return redirect()->back()->withSuccess('Added Successfully');            
            }   
        }else{
         /***For Edit Leave Type***/    
            $leaveData               = leavestype::find($leaveId);
            $leaveData->name         = $request->leavename;
            $leaveData->leave_days   = $request->leaveday;
            $save = $leaveData->save();   
            if($save){
                return redirect()->back();
            }
        }
        die;         
    }

    public function leavetypebyID(Request $request,$id){

        if($request->ajax()){             
            $data['leavetypevalue']   = leavestype::find($id);           
            return response($data);              
        }        
    }

    public function LeavetypeDelet(Request $request,$id)
    {
        $success    = leavestype::destroy($id);
        if($success){
            return redirect()->back()->withSuccess('Leave Type Delete Successfully');
        }
    }

    public function leaveapplication()
    {
        $allLeavetypes = leavestype::all();

        $info = auth()->user();
        //dd($info);
        $logingUserID = $info->id;

       
        $userinfo = DB::table('users')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        ->select('users.*', 'profiles.*') 
        ->where('users.id', '=', $logingUserID)        
        ->where('users.is_deleted', '=', 0)
        ->get();

        //dd($userinfo); die;


        return view('pages.leaveapprove',compact('allLeavetypes','userinfo'));
    }

}


