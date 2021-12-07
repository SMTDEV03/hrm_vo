<?php

namespace App\Helpers;
use App\Models\leavestype;

class Helper{

    public static function getLeavename($id){

        $getlvename = leavestype::find($id);

        return $getlvename;

    }

}


?>