<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\designation;
use App\Models\department;
use App\Models\profile;
use App\Models\leavestype;
use App\Models\holidays;

use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index(){
        //$allLeavetypes = holidays::all();
        return view('pages.holidays');
    }


    public function add_holiday(Request $request){

               
        $holiday = new holidays();        
        $holidayId = $request->id;

        /***For Add New Leave Type***/
        if(empty($leaveId))
        {
            $holiday->holiday_name  = $request->holiname;
            $holiday->from_date     = $request->startdate;
            $holiday->to_date       = $request->enddate;
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


}
