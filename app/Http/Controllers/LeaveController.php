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

        $validate = $request->validate([
            'leavename' => 'required',
            'leaveday' => 'required'
        ]);
        
        $leavemodel = new leavestype();
        $leavemodel->name = $request->leavename;
        $leavemodel->leave_days  = $request->leaveday;
        $save = $leavemodel->save();  
        
        if($save){
            return redirect()->back()->withSuccess('Added Successfully');
            
        }
    
    }

}


