<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\department;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $allDepart      = department::all();
        return view('pages.department',compact('allDepart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            
            $dptcheck = DB::table('departments')->where('department_name',$request->input('dpt'))->count();

            if($dptcheck > 0)
            {
                echo "Already";
                die;
            }

            $department = new department([
                'department_name' => $request->input('dpt'),                
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
  
        $allDepart   = department::all();
        $deptname    = department::findOrFail($id);              
        return view('pages.editdepartment',compact('allDepart','deptname'));
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
        $deptname                   = department::find($id);
        $deptname->department_name  = trim($request->department_name);
        $save = $deptname->save();
        if($save){
            //return redirect()->back();
            return redirect('/admin/department');
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
        $depart     = department::destroy($id);
        if($depart){
            return redirect()->back()->withSuccess('Department Delete Successfully');
        }

    }
    
}
