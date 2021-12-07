<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\designation;
use App\Models\department;
use App\Models\profile;
use App\Models\leavestype;
use App\Models\employee_application;
use App\Helpers\Helper;

use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index(){

        $allLeavetypes = leavestype::all();
        return view('pages.leavestype',compact('allLeavetypes'));
    }

    /*******  Function for Add Leave Type   *******/

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

    /*******  Function for Get Leave Type By ID   *******/

    public function leavetypebyID(Request $request,$id){

        if($request->ajax()){             
            $data['leavetypevalue']   = leavestype::find($id);           
            return response($data);              
        }        
    }

    /*******  Function for Delete Leave Type   *******/

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
        $logingUserID = $info->id;       
        $userinfo = DB::table('users')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        ->select('users.*', 'profiles.*') 
        ->where('users.id', '=', $logingUserID)        
        ->where('users.is_deleted', '=', 0)
        ->get();

        $allLeaveinfo = employee_application::all();             
        
        return view('pages.leaveapprove',compact('allLeavetypes','userinfo','allLeaveinfo'));
    }

    public function getleavebyID($id){
                        
        $total = DB::table('leavestypes')->sum('leave_days');        
        //echo 'Leave Balance: '.$total;

        $balnceleave =  employee_application::where('user_id',$id)->get();
        echo $balnceleave;

        die;
    }

    /*******  Function for Add Employee Leave Application    *******/

    public function add_application(Request $request){

        if($request->type=='Full Day'){
            $days = 1;    
        }else{
            $datetime1 = new DateTime($request->startdate);
            $datetime2 = new DateTime($request->end_date);
            $interval  = $datetime1->diff($datetime2);
            $days      = $interval->format('%a');//now do whatever you like with $days
        }

        $empApplication = new employee_application();
        $empApplication->user_id         = $request->userid; 
        $empApplication->leave_type_id   = $request->typeid;
        $empApplication->start_date      = $request->startdate;
        $empApplication->end_date        = $request->end_date;
        $empApplication->leave_type      = $request->type;       
        $empApplication->reason          = $request->reason;
        $empApplication->leave_duration  = $days;
        $empApplication->apply_date      = date('Y-m-d');
        $empApplication->leave_status    = 'Not Approve';

        $save = $empApplication->save();             
        if($save){
            return redirect()->back()->withSuccess('Added Successfully');            
        } 
    }

    public function approveleave($id){
        $application = employee_application::where('user_id',$id)->first();  
        $checkstatus = $application->leave_status;  
        
        if($checkstatus=='Not Approve'){

        }
        //dd($application);
        //dd($checkstatus);
       //die;
    }

}


