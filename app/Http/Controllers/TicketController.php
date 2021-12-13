<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\designation;
use App\Models\department;
use App\Models\profile;
use App\Models\User;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Ticket_Attachment;

Use \Carbon\Carbon;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $status = Status::all();
        $departments = Department::all();
        $info = auth()->user();
        $logingUserID = $info->id;
        $userinfo = DB::table('users')->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('users.*', 'profiles.*')
            ->where('users.id', '=', $logingUserID)->where('users.is_deleted', '=', 0)
            ->get();
        if($info->role==2){
            $ticketinfo = Ticket::where('user_id', $info->id)->get(); 
        }else{
            $ticketinfo = Ticket::all();
        }
           
        return view('pages.ticket', compact('userinfo','status', 'departments','ticketinfo'));
    }


    public function add_newTicket(Request $request)
    {        
        /*$validation = $request->validate(['subject' => 'required', 'status' => 'required', 'department' => 'required', 'ticket_summary' => 'required'

        ]);*/
        
        $info = auth()->user();
        $ticketmodel = new Ticket();
        $attachment = new Ticket_Attachment();
        $ticketmodel->user_id = $info->id;
        $ticketmodel->subject = $request->subject;
        $ticketmodel->status_id ='1';
        $ticketmodel->department_id = $request->department;
        $ticketmodel->ticket_summary = $request->ticket_summary;        
        $ticketmodel->closed_at = Carbon::now();
        $save = $ticketmodel->save();
        $lastTicketId =$ticketmodel->id;
            if (!empty($request->file()))
            {
                $fileName = time() . '_' . $request
                    ->file
                    ->getClientOriginalName();
                $filePath = $request->file('file')
                    ->storeAs('uploads', $fileName, 'public');
                $attachment->ticketid = $lastTicketId;
                $attachment->name = time() . '_' . $request
                    ->file
                    ->getClientOriginalName();
                $attachment->path = '/storage/' . $filePath;
                $asave = $attachment->save();
            }
            if ($save || $asave)
            {
                return back()->with('success', 'Record Save Successfully');
            }
            else
            {
                return back()
                    ->with('fail', 'something went wrong');
            }
        }

        public function updateTicketStatus($statusid){
           dd($statusid);
        }
    }


