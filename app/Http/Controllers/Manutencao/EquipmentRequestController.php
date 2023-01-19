<?php

namespace App\Http\Controllers\Manutencao;

use App\Http\Controllers\Controller;
use App\Models\EquimentRequest;
use App\Models\EquipmentRequestItem;
use Illuminate\Http\Request;

class EquipmentRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $requests = EquimentRequest::orderBy('id','desc')->get();
        return view('manutencao.request.index', compact('requests'));
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
        $equipmentrequest = EquimentRequest::find($id);

        return view('manutencao.request.show', compact('equipmentrequest'));
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
        $equipmentrequest = EquimentRequest::find($id);

        return view('manutencao.request.edit', compact('equipmentrequest'));


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
        //
        $equipment_test = array();

        $equipmentrequest = EquimentRequest::find($id);
        $data = $request->all();

        $equipment = $request->input('equipment_id');

        for($count = 0; $count < count($equipment); $count++)
        {
            // $equipment_test = $equipment[$count];
            array_push($equipment_test,$equipment[$count]);
        }

        if(count(array_unique($equipment_test))<count($equipment_test))
        {
            return back()->with('messageError', 'Existem equipamentos duplicados na lista.');
        }
        else
        {
            $equipmentrequest->update([
                'qtd_real' => $data['qtd_real'],
                'status' => 1,
            ]);
    
            
    
            for($count = 0; $count < count($equipment); $count++)
            {
                EquipmentRequestItem::create([
                    'equipment_request_id' => $equipmentrequest->id,
                   'scheduled_shift_id' => $equipmentrequest->scheduled_shift_id,
                   'terminal_id' => $equipmentrequest->terminal_id,
                   'equipment_id' => $equipment[$count],
                ]);
             }
    
             return redirect()->route('equipmentrequest.index')->with('message', 'Requisição respondida com sucesso');
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
