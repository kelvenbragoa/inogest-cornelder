<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\BrigadeScheduledShift;
use App\Models\EquimentRequest;
use App\Models\ScheduledShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $planning = ScheduledShift::where('supervisor_1_id',Auth::user()->id)->orWhere('supervisor_2_id',Auth::user()->id)->get();
        return view('supervisor.planning_shift.index',compact('planning'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('supervisor.planning_shift.create');
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

        $test=  ScheduledShift::where('shift_id',$data['shift_id'])->where('date',$data['date'])->where('terminal_id',$data['terminal_id'])->first();
        
        if($test == null){
            ScheduledShift::create($data);
            return redirect()->route('planning-supervisor.index')->with('message','Turno criado com sucesso');
        }else{
            return redirect()->route('planning-supervisor.index')->with('messageError','Já existe um turno criado para esta Data.');
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
        $planning = ScheduledShift::find($id);

        $brigade_planning = BrigadeScheduledShift::where('scheduled_shift_id',$id)->get();

        $equipment_request = EquimentRequest::where('scheduled_shift_id', $id)->get();

        return view('supervisor.planning_shift.show', compact('planning','brigade_planning','equipment_request'));
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
        $planning = ScheduledShift::find($id);

        return view('supervisor.planning_shift.edit', compact('planning'));
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
        $planning = ScheduledShift::find($id);

        $test=  ScheduledShift::where('supervisor_1_id',$data['supervisor_1_id'])->where('supervisor_2_id',$data['supervisor_2_id'])->where('shift_id',$data['shift_id'])->where('date',$data['date'])->where('terminal_id',$data['terminal_id'])->first();
        
        if($test == null){
            $planning->update($data);
            return redirect()->route('planning-supervisor.index')->with('message','Turno editado com sucesso');
        }else{
            return redirect()->route('planning-supervisor.index')->with('messageError','Impossivel editar o turno. Os dados inseridos coincidem com turno já existente!');
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
