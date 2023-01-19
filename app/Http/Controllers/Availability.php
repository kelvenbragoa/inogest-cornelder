<?php

namespace App\Http\Controllers;

use App\Models\Availability as ModelsAvailability;
use Illuminate\Http\Request;

class Availability extends Controller
{
    //

    public function availability($equipment){
        $availability = ModelsAvailability::find($equipment);

        if($availability->status == 0){
          $availability->update([
            'status'=>1
          ]);
          return back();

        }else{
            $availability->update([
                'status'=>0
              ]);
          return back();
        }
    }
}
