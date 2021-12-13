<?php

namespace App\Helpers;
use App\Models\leavestype;
use App\Models\designation;
use App\Models\department;
use App\Models\profile;
use App\Models\User;
use App\Models\Status;

class Helper{

     /*** Function for Get Leave Type Name ****/

    public static function getLeavename($id)
    {

        $getlvename = leavestype::find($id);

        return $getlvename;

    }

    /*** Function for Get Designation ****/

    public static function getDesignation($id)
    {

        $designame = designation::find($id);

        return $designame;

    }

    /*** Function for Get Designation ****/

    public static function getDepartment($id)
    {

        $deptname = department::find($id);

        return $deptname;

    }

    /*** Function for Get Ticket Status ****/

    public static function getstatusbyID($id)
    {

        $status = Status::find($id);
        return $status;

    }

}


?>