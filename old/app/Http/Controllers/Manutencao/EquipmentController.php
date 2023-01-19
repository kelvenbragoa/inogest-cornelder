<?php

namespace App\Http\Controllers\Manutencao;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Mcscr;
use Illuminate\Http\Request;

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
        $equipments = Equipment::all();
        return view('manutencao.equipment.index', compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('manutencao.equipment.create');
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

        return redirect()->route('equipment.index')->with('message', 'Equipamento criado com sucesso');
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

        $mcscr = Mcscr::where('equipment_id',$id)->where('status',1)->get();
        $mcscr_m = Mcscr::where('equipment_id',$id)->where('status',1)->whereMonth('created_at',date('m'))->get();
        $mcscr_y = Mcscr::where('equipment_id',$id)->where('status',1)->whereYear('created_at',date('Y'))->get();

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


        return view('manutencao.equipment.show', compact('equipment','time_total','time_m','time_y'));
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

        return view('manutencao.equipment.edit', compact('equipment'));
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

        return redirect()->route('equipment.index')->with('message', 'Equipamento editado com sucesso');

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
