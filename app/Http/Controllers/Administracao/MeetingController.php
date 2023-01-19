<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Models\MeetingParticipant;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $meetings = Meeting::all();
        return view('manutencao.meeting.index',compact('meetings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('manutencao.meeting.create');
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

        Meeting::create($data);

        return redirect()->route('meeting.index')->with('messageSuccess', 'Acta da Reunião criada com sucesso');
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
        $meeting = Meeting::find($id);
        return view('manutencao.meeting.show',compact('meeting'));
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
        $meeting = Meeting::find($id);


        return view('manutencao.meeting.edit',compact('meeting'));
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
        $data= $request->all();

        $meeting = Meeting::find($id);

        $meeting->update($data);

        return redirect()->route('meeting.index')->with('messageSuccess', 'Acta da Reunião editada com sucesso');
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


    public function download($id)
    {
        $meeting = Meeting::find($id);
        $pdf = Pdf::loadView('administracao.meeting.meeting', compact('meeting'))->setOptions([
            'defaultFont' => 'sans-serif',
            'isRemoteEnabled' => 'true'
        ]);
        return $pdf->setPaper('a4')->stream('meeting.pdf');
    }

    public function sendmail(Request $request){

        $data = $request->all();
        $participant = MeetingParticipant::find($data['participant_id']);
        $meeting = Meeting::find($data['meeting_id']);

        $pdf = Pdf::loadView('administracao.meeting.meeting', compact('meeting'))->setOptions([
            'defaultFont' => 'sans-serif',
            'isRemoteEnabled' => 'true'
        ]);

       
        $msg = "Esta Acta da Reunião criada no dia ".$meeting->created_at->format('d-m-Y')." as ".$meeting->created_at->format('H:i').", enviada para ".$participant->name.". \nEncontre em anexo a Acta da Reunião.";

        // new \App\Mail\MeetingMail($participant,$msg);
        $participant->update([
            'status'=>1
        ]);
        Mail::send(new \App\Mail\MeetingMail($participant,$msg,$pdf));

        return back()->with('messageSuccess','Email enviado com sucesso');
    }
}
