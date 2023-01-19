<?php

namespace App\Http\Controllers\Manutencao;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Equipment;
use App\Models\Mcscr;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        $equipments = Equipment::where('destination_id',$id)->get();
        $destination = Destination::find($id);

        $mcscr = Mcscr::where('destination_id',$id)->where('status',1)->get();
        $mcscr_m = Mcscr::where('destination_id',$id)->where('status',1)->whereMonth('created_at',date('m'))->get();
        $mcscr_y = Mcscr::where('destination_id',$id)->where('status',1)->whereYear('created_at',date('Y'))->get();

        $mcscr_execucao = Mcscr::where('destination_id',$id)->where('status',0)->get();

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

        return view('manutencao.availability.show',compact('equipments','destination','time_total','time_m','time_y','mcscr_execucao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
