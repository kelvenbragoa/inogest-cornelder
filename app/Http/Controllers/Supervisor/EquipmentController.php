<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\EquimentRequest;
use App\Models\EquipmentRequestItem;
use App\Models\OperatorBrigadeScheduledShift;
use App\Models\ScheduledShift;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($planning_id, $request_id)
    {
        //
        $planning = ScheduledShift::find($planning_id);
        
       

        $equipmentrequest = EquimentRequest::find($request_id);

        
        return view('supervisor.planning_shift.equipment.index',compact('planning','equipmentrequest'));
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

        $equipment = EquipmentRequestItem::find($id);

        $data = $request->all();


        $equipment->update($data);
        
        if($data['user_operator_id'] != null){
            $operator= OperatorBrigadeScheduledShift::where('user_id',$data['user_operator_id'])->first();

        $operator->update([
            'status' =>1
        ]);
        }
        
        

        return back()->with('message','Editado Com sucesso');
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
