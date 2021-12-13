<?php

namespace App\Http\Controllers;

use DateTime;
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
        $allholidays = holidays::all();
        return view('pages.holidays',compact('allholidays'));
    }


    public function add_holiday(Request $request)
    {
        $holiday = new holidays();        
        $holidayId = $request->id;
        $sdate   = $request->startdate;
        $edate   = $request->enddate;
        $date1 = new DateTime($sdate);
        $date2 = new DateTime($edate);
        $diff = date_diff($date1,$date2);
        $nofdate = $diff->format("%a");
        $year    = date('m-Y',strtotime($sdate)); 

        /***For Add New Leave Type***/
        if(empty($holidayId))
        {          
            $holiday->holiday_name      = $request->holiname;
            $holiday->from_date         = $request->startdate;
            $holiday->to_date           = $request->enddate;
            $holiday->number_of_days    = $nofdate;
            $holiday->year              = $year;
           
            $save = $holiday->save();             
            if($save){
                return redirect()->back()->withSuccess('Added Successfully');            
            }   
        }else{
         /***For Edit Holiday***/ 
            $holidaysData               = holidays::find($holidayId);
            $holidaysData->holiday_name      = $request->holiname;
            $holidaysData->from_date         = $request->startdate;
            $holidaysData->to_date           = $request->enddate;
            $holidaysData->number_of_days    = $nofdate;
            $holidaysData->year              = $year;            
            $save                            = $holidaysData->save();   
            if($save){
                return redirect()->back();
            }
        } 
                 
    }

    public function holidaybyID(Request $request,$id){
        if($request->ajax()){             
            $data['holidayvalue']   = holidays::find($id);           
            return response($data);              
        }        
    }

    public function holidayDelet(Request $request,$id)
    {
        $success = holidays::destroy($id);
        if($success){
            return redirect()->back()->withSuccess('Holiday Delete Successfully');
        }
    }
}
