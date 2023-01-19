<?php

namespace App\Http\Controllers;

use App\Models\LogMcscrActivity;
use App\Models\Mcscr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         if(Auth::user()->role_id == 1){
            $mcscr = Mcscr::where('status',1)->get();
            $mcscr_m = Mcscr::where('status',1)->whereMonth('created_at',date('m'))->get();
            $mcscr_y = Mcscr::where('status',1)->whereYear('created_at',date('Y'))->get();

            $time_total = 0;
            $time_m = 0;
            $time_y=0;

            foreach($mcscr as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_total = $time_total + $time;
            }

            foreach($mcscr_m as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_m = $time_m + $time;
            }

            foreach($mcscr_y as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_y = $time_y + $time;
            }

            $time_total = round($time_total/3600, 1);
            $time_m = round($time_m/3600, 1);
            $time_y = round($time_y/3600, 1);

            return view('admin.index',compact('time_total','time_m','time_y'));
        }

        if(Auth::user()->role_id == 2){

            $mcscr = Mcscr::where('status',1)->get();
            $mcscr_m = Mcscr::where('status',1)->whereMonth('created_at',date('m'))->get();
            $mcscr_y = Mcscr::where('status',1)->whereYear('created_at',date('Y'))->get();

            $time_total = 0;
            $time_m = 0;
            $time_y=0;

            foreach($mcscr as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_total = $time_total + $time;
            }

            foreach($mcscr_m as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_m = $time_m + $time;
            }

            foreach($mcscr_y as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_y = $time_y + $time;
            }

            $time_total = round($time_total/3600, 1);
            $time_m = round($time_m/3600, 1);
            $time_y = round($time_y/3600, 1);

            return view('planning.index',compact('time_total','time_m','time_y'));
           
        }

        if(Auth::user()->role_id == 3){

            $mcscr = Mcscr::where('status',1)->get();
            $mcscr_m = Mcscr::where('status',1)->whereMonth('created_at',date('m'))->get();
            $mcscr_y = Mcscr::where('status',1)->whereYear('created_at',date('Y'))->get();

            $time_total = 0;
            $time_m = 0;
            $time_y=0;

            foreach($mcscr as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_total = $time_total + $time;
            }

            foreach($mcscr_m as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_m = $time_m + $time;
            }

            foreach($mcscr_y as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_y = $time_y + $time;
            }

            $time_total = round($time_total/3600, 1);
            $time_m = round($time_m/3600, 1);
            $time_y = round($time_y/3600, 1);

            return view('area.index',compact('time_total','time_m','time_y'));
           
        }

        if(Auth::user()->role_id == 4){
            $mcscr = Mcscr::where('status',1)->get();
            $mcscr_m = Mcscr::where('status',1)->whereMonth('created_at',date('m'))->get();
            $mcscr_y = Mcscr::where('status',1)->whereYear('created_at',date('Y'))->get();

            $time_total = 0;
            $time_m = 0;
            $time_y=0;

            foreach($mcscr as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_total = $time_total + $time;
            }

            foreach($mcscr_m as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_m = $time_m + $time;
            }

            foreach($mcscr_y as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_y = $time_y + $time;
            }

            $time_total = round($time_total/3600, 1);
            $time_m = round($time_m/3600, 1);
            $time_y = round($time_y/3600, 1);

            return view('supervisor.index',compact('time_total','time_m','time_y'));
           
        }

        if(Auth::user()->role_id == 5){
            $mcscr = Mcscr::where('status',1)->get();
            $mcscr_m = Mcscr::where('status',1)->whereMonth('created_at',date('m'))->get();
            $mcscr_y = Mcscr::where('status',1)->whereYear('created_at',date('Y'))->get();

            $time_total = 0;
            $time_m = 0;
            $time_y=0;

            foreach($mcscr as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_total = $time_total + $time;
            }

            foreach($mcscr_m as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_m = $time_m + $time;
            }

            foreach($mcscr_y as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_y = $time_y + $time;
            }

            $time_total = round($time_total/3600, 1);
            $time_m = round($time_m/3600, 1);
            $time_y = round($time_y/3600, 1);

            return view('operadorc.index',compact('time_total','time_m','time_y'));
            
        }

        if(Auth::user()->role_id == 6){
            $mcscr = Mcscr::where('status',1)->get();
            $mcscr_m = Mcscr::where('status',1)->whereMonth('created_at',date('m'))->get();
            $mcscr_y = Mcscr::where('status',1)->whereYear('created_at',date('Y'))->get();

            $time_total = 0;
            $time_m = 0;
            $time_y=0;

            foreach($mcscr as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_total = $time_total + $time;
            }

            foreach($mcscr_m as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_m = $time_m + $time;
            }

            foreach($mcscr_y as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_y = $time_y + $time;
            }

            $time_total = round($time_total/3600, 1);
            $time_m = round($time_m/3600, 1);
            $time_y = round($time_y/3600, 1);

            return view('operador.index',compact('time_total','time_m','time_y'));
           
        }

        if(Auth::user()->role_id == 7){
            $mcscr = Mcscr::where('status',1)->get();
            $mcscr_m = Mcscr::where('status',1)->whereMonth('created_at',date('m'))->get();
            $mcscr_y = Mcscr::where('status',1)->whereYear('created_at',date('Y'))->get();

            $time_total = 0;
            $time_m = 0;
            $time_y=0;

            foreach($mcscr as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_total = $time_total + $time;
            }

            foreach($mcscr_m as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_m = $time_m + $time;
            }

            foreach($mcscr_y as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_y = $time_y + $time;
            }

            $time_total = round($time_total/3600, 1);
            $time_m = round($time_m/3600, 1);
            $time_y = round($time_y/3600, 1);

            $log = LogMcscrActivity::orderBy('id','desc')->first();


            return view('manutencao.index',compact('log','time_total','time_m','time_y'));
        }

        if(Auth::user()->role_id == 8 || Auth::user()->role_id == 9 || Auth::user()->role_id == 10 || Auth::user()->role_id == 11 || Auth::user()->role_id == 12 || Auth::user()->role_id == 13 || Auth::user()->role_id == 14){
            $mcscr = Mcscr::where('area_id',Auth::user()->role_id)->where('status',1)->get();
            $mcscr_m = Mcscr::where('area_id',Auth::user()->role_id)->where('status',1)->whereMonth('created_at',date('m'))->get();
            $mcscr_y = Mcscr::where('area_id',Auth::user()->role_id)->where('status',1)->whereYear('created_at',date('Y'))->get();

            $time_total = 0;
            $time_m = 0;
            $time_y=0;

            foreach($mcscr as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_total = $time_total + $time;
            }

            foreach($mcscr_m as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_m = $time_m + $time;
            }

            foreach($mcscr_y as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_y = $time_y + $time;
            }

            $time_total = round($time_total/3600, 1);
            $time_m = round($time_m/3600, 1);
            $time_y = round($time_y/3600, 1);


            return view('manutencao_areas.area.index',compact('time_total','time_m','time_y'));
        }
        
        if(Auth::user()->role_id == 15){
           
            return view('administracao.index');
        }



    }
}
