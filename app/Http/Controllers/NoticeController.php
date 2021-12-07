<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\notice;

class NoticeController extends Controller
{
    //

    public function index(){
        $notice = Notice::where('is_deleted', '=', 0)->get();
       
        return view('pages.addNotice', compact('notice'));
    }

    public function add_notice(Request $request){

        $validation = $request->validate([
            'title' =>'required',
            'notice_date'=>'required'          
        ]);

        $new_notice = new Notice();
        $new_notice->title = $request->title;
        $new_notice->date = $request->notice_date;
        $new_notice->is_deleted = '0';

        $save = $new_notice->save();
        if($save){
            return back()
            ->with('success', 'New Notice Added Successfully');
        }else{
            return back()                                                           
            ->with('fail', 'something went wrong');
        }        
}

public function noticeDelete($id){
    $Notice = Notice::find($id);
    if($Notice->is_deleted == 0){
        $Notice->is_deleted = 1;
    
    }elseif($Notice->is_deleted == 1){
        $Notice->is_deleted = 0;
    }
    $save = $Notice->save();
    if($save){
        return back()
        ->with('success', 'Record Deleted Successfully');
    }else {
        return back()                                                       
        ->with('fail', 'something went wrong');
    }
}

}
