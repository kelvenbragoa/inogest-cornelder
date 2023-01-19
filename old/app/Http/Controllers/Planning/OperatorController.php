<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use App\Models\Brigade;
use App\Models\BrigadeScheduledShift;
use App\Models\OperatorBrigadeScheduledShift;
use App\Models\ScheduledShift;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($planning_id, $brigade_id)
    {
        //
        $planning = ScheduledShift::find($planning_id);
        $brigade_planning = BrigadeScheduledShift::find($brigade_id);
        $operators = OperatorBrigadeScheduledShift::where('scheduled_shift_id',$brigade_id)->get();

        
        return view('planning.planning_shift.operator.index',compact('planning','brigade_planning','operators'));
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
        $data = $request->all();

        $test=  OperatorBrigadeScheduledShift::where('user_id',$data['user_id'])->where('scheduled_shift_id',$data['scheduled_shift_id'])->first();
        
        if($test == null){
            OperatorBrigadeScheduledShift::create($data);

            return back()->with('message', 'Operador adicionado com sucesso');

        } else {

            return back()->with('messageError', 'Operador ja existente nesta brigada de turno');

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
        //
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
        $operator = OperatorBrigadeScheduledShift::find($id);
        $operator->delete();


        return back()->with('message','Operador apagado com sucesso');
    }
}
