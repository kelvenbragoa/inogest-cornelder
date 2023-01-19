<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use App\Models\Equipment;
use App\Models\Mcscr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $equipments = Equipment::where('area_id',Auth::user()->role_id)->get();
        return view('manutencao_areas.area.equipment.index', compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('manutencao_areas.area.equipment.create');
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
        $data = $request->all();
        Equipment::create($data);

        return redirect()->route('equipment-area.index')->with('message', 'Equipamento criado com sucesso');
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
        $equipment = Equipment::find($id);

        $mcscr = Mcscr::where('area_id',Auth::user()->role_id)->where('equipment_id',$id)->where('status',1)->get();
        $mcscr_m = Mcscr::where('area_id',Auth::user()->role_id)->where('equipment_id',$id)->where('status',1)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get();
        $mcscr_y = Mcscr::where('area_id',Auth::user()->role_id)->where('equipment_id',$id)->where('status',1)->whereYear('created_at',date('Y'))->get();
        $mcscr_t = Mcscr::where('area_id',Auth::user()->role_id)->where('equipment_id',$id)->where('status',1)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->whereDay('created_at',date('d'))->get();

        $time_total = 0;
        $time_m = 0;
        $time_y=0;
        $time_t=0;

            foreach($mcscr as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_total = $time_total + $time;
            }

            foreach($mcscr_t as $item){
                $created_at = strtotime($item->open_at);
                $closed_at = strtotime($item->close_at);
                $time = $closed_at - $created_at;
                $time_t = $time_t + $time;
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

            $dados_graficobarra = '';
            for ($x = 1; $x <= 12; $x++) {
                $mcscr = Mcscr::where('area_id',Auth::user()->role_id)->where('equipment_id',$id)->whereMonth('created_at',$x)->whereYear('created_at',date('Y'))->get();
                $nr = count( $mcscr);
                $dados_graficobarra.="{$nr},";
            }

            $dados_graficobarra1 = '';
            for ($x = 1; $x <= 12; $x++) {
                $availability = Availability::where('equipment_id',$id)->where('status',1)->whereMonth('created_at',$x)->whereYear('created_at',date('Y'))->get();
                $nr = count( $availability);
                $nr = round($nr*100/720,2);
                $dados_graficobarra1.="{$nr},";
            }

            $dados_graficobarra2 = '';
            for ($x = 1; $x <= 31; $x++) {
                $availability = Availability::where('equipment_id',$id)->where('status',1)->whereDay('created_at',$x)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get();
                $nr = count( $availability);
                $nr = round($nr*100/24,2);

                $dados_graficobarra2.="{$nr},";
            }

            // dd($dados_graficobarra1,$dados_graficobarra2);

            $availability_today = Availability::where('equipment_id',$id)->whereDate('created_at',DB::raw('CURDATE()'))->get();
            $availability_yesterday = Availability::where('equipment_id',$id)->whereDate('created_at',DB::raw('DATE_SUB(CURDATE(), INTERVAL 1 DAY)'))->get();


        return view('manutencao_areas.area.equipment.show', compact('equipment','time_total','time_m','time_y','time_t','dados_graficobarra','dados_graficobarra1','dados_graficobarra2','availability_today','availability_yesterday'));
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
        $equipment = Equipment::find($id);

        return view('manutencao_areas.area.equipment.edit', compact('equipment'));
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
        $data = $request->all();
        $equipment = Equipment::find($id);

        $equipment->update($data);

        return redirect()->route('equipment-area.index')->with('message', 'Equipamento editado com sucesso');

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
