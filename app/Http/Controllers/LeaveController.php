<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\designation;
use App\Models\department;
use App\Models\profile;
use App\Models\leavestype;

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

    public function LeavetypeDelet($id)
    {
        $success    = leavestype::destroy($id);
        if($success){
            return redirect()->back()->withSuccess('Leave Type Delete Successfully');
        }
    }

}


