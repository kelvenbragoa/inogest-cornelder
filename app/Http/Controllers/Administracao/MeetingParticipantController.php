<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use App\Models\MeetingParticipant;
use App\Models\MeetingTask;
use Illuminate\Http\Request;

class MeetingParticipantController extends Controller
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
        $data = $request->all();

        $test=  MeetingParticipant::where('email',$data['email'])->where('meeting_id',$data['meeting_id'])->first();

        if($test == null){
            MeetingParticipant::create($data);

            return back()->with('messageSuccess','Participante adicionado com sucesso');
        }else{
            return back()->with('messageError','Participante já registrado nesta Acta');
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
        $participant = MeetingParticipant::find($id);
        $data = $request->all();

        $participant->update($data);

        return back()->with('messageSuccess','Participante editado com sucesso');
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
        $participant = MeetingParticipant::find($id);

        $test=  MeetingTask::where('participant_meeting_id',$id)->first();

        if($test == null){
            $participant->delete();
            return back()->with('messageSuccess','Participante apagado com sucesso');
        }else{
            return back()->with('messageError','Existe uma tarefa para este participante, apague a tarefa primeiro e depois o participante.');
        }

    }
}
