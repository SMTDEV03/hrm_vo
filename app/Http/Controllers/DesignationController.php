<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\designation;

use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allDesignation      = designation::all();
        return view('pages.designation',compact('allDesignation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){             
            
            $dptcheck = DB::table('designations')->where('des_name',$request->input('desgnation_name'))->count();

            if($dptcheck > 0)
            {
                echo "Already";
                die;
            }

            $department = new designation([
                'des_name' => $request->input('desgnation_name'),                
            ]);

            if($department->save()){
                return response('success');
            }
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getall             = designation::all();
        $dsgname            = designation::findOrFail($id);
        // /*dd($dsgname);
        // die;*/
        // $dsgname->des_name   = trim($dsgname->des_name);
        // $save = $dsgname->update();     
        return view('pages.editdesignation',compact('getall','dsgname'));
    }

    /**
     * Update the specified resource in storage. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dsgname            = designation::find($id);
        $dsgname->des_name   = $request->department_name;
        $save = $dsgname->save();     

        if($save){
            return redirect()->back();
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
