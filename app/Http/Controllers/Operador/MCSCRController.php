<?php

namespace App\Http\Controllers\Operador;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\LogMcscrActivity;
use App\Models\Mcscr;
use App\Models\User;
use App\Notifications\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Notification;

class MCSCRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mcscr = Mcscr::where('user_id',Auth::user()->id)->get();
        return view('operador.mcscr.index', compact('mcscr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('operador.mcscr.create');
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

        $user = User::all();

        $test=  Mcscr::where('equipment_id',$data['equipment_id'])->where('status',0)->first();
        $equipment = Equipment::find($data['equipment_id']);
        
        if($test == null){
            Mcscr::create([
                'motivo'=>$data['motivo'],
                'user_id'=>$data['user_id'],
                'equipment_id'=>$data['equipment_id'],
                'destination_id'=>$equipment->destination_id,
                'area_id'=>$equipment->area_id,
                'status'=>0,
                'open_at'=>Date::now(),
                'open_at_man'=>$data['open_at_man'],
                
            ]);
    
            $equipment = Equipment::find($data['equipment_id']);
            $equipment->update([
                'status' => 0
            ]);

            $msg = "Um MCSCR foi criado para o Equipamento ".$equipment->name.", Ref: ".$equipment->ref.". Este Equipamento estará indisponível até fechar o MCSCR.";

            $log = Auth::user()->name.' adicionou um novo MCSCR para equipamento '.$equipment->name;
            LogMcscrActivity::create([
                'log'=>$log,
                'area_id'=>$equipment->area_id,
                'destination_id'=>$equipment->destination_id
            ]);

            //Notification::send($user,new Operation($msg));
    
            return redirect()->route('mcscr-operador.index')->with('messageSuccess', 'MCSCR criado com sucesso');
        }else{
            return redirect()->route('mcscr-operador.index')->with('messageError', 'Existe um MCSCR em execução criado para este equipamento. Fecha o MCSCR para abrir um novo.');
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
        $mcscr = Mcscr::find($id);

        return view('operador.mcscr.show', compact('mcscr'));
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
        $mcscr = Mcscr::find($id);

        return view('operador.mcscr.edit', compact('mcscr'));
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

        $mcscr = Mcscr::find($id);

        $mcscr->update([
            'motivo' => $data['motivo'],
            'causa' => $data['causa'],
            'solucao' => $data['solucao'],
            'consequencia' => $data['consequencia'],
            'recomendacao' => $data['recomendacao'],
            'status'=>1,
            'close_at'=>Date::now(),
            'close_at_man'=>$data['close_at_man'],
        ]);

        $equipment = Equipment::find($mcscr->equipment_id);
        $equipment->update([
            'status' => 1
        ]);

        $log = Auth::user()->name.' editou um MCSCR para equipamento '.$equipment->name;
        LogMcscrActivity::create([
            'log'=>$log,
            'area_id'=>$equipment->area_id,
            'destination_id'=>$equipment->destination_id
        ]);

        return redirect()->route('mcscr-operador.index')->with('messageSuccess', 'MCSCR editado com sucesso');
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

    public function getEquipment(Request $request)
    {
        $data['equipment'] = Equipment::where("type_equipment_id",$request->type_equipment_id)->get(["name","id"]);
        return response()->json($data);

    }
}
