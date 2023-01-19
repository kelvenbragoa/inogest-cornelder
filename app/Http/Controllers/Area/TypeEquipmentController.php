<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use App\Models\TypeEquipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $type = TypeEquipment::where('area_id',Auth::user()->role_id)->get();
        return view('manutencao_areas.area.type_equipment.index', compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('manutencao_areas.area.type_equipment.create');
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


        TypeEquipment::create($data);

        return redirect()->route('type_equipment.index')->with('messageSuccess', 'Tipo deEquipamento criado com sucesso');
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
        $type = TypeEquipment::find($id);
        $dados_graficobarra1 = '';
        for ($x = 1; $x <= 12; $x++) {
            $availability = Availability::where('type_equipment_id',$id)->where('status',1)->whereMonth('created_at',$x)->whereYear('created_at',date('Y'))->get();
            $availabilitytotal = Availability::where('type_equipment_id',$id)->whereMonth('created_at',$x)->whereYear('created_at',date('Y'))->get();
            $nr = count( $availability);
            if (count($availabilitytotal)==0) {
                $nr = 0;
                $dados_graficobarra1.="{$nr},";
            } else {
                $nr = round($nr*100/count($availabilitytotal),2);
                $dados_graficobarra1.="{$nr},";
            }
            
            
        }

        $dados_graficobarra2 = '';
        for ($x = 1; $x <= 31; $x++) {
            $availability = Availability::where('type_equipment_id',$id)->where('status',1)->whereDay('created_at',$x)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get();
            $availabilitytotal = Availability::where('type_equipment_id',$id)->whereDay('created_at',$x)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get();
            $nr = count( $availability);

            if (count($availabilitytotal)==0) {
                $nr = 0;
                $dados_graficobarra2.="{$nr},";
            } else {
                $nr = round($nr*100/count($availabilitytotal),2);

                $dados_graficobarra2.="{$nr},";
            }
        }

        return view('manutencao_areas.area.type_equipment.show', compact('type','dados_graficobarra1','dados_graficobarra2'));
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
        $type = TypeEquipment::find($id);

        return view('manutencao_areas.area.type_equipment.edit', compact('type'));
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
        $destination = TypeEquipment::find($id);

        $destination->update($data);
        return redirect()->route('type_equipment.index')->with('messageSuccess', 'Tipo de Equipamento editado com sucesso');
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
