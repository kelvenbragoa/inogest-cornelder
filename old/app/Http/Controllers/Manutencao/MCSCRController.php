<?php

namespace App\Http\Controllers\Manutencao;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Mcscr;
use App\Models\User;
use App\Notifications\Operation;
use Illuminate\Http\Request;
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
        $mcscr = Mcscr::all();
        return view('manutencao.mcscr.index', compact('mcscr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('manutencao.mcscr.create');
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
        
        if($test == null){
            Mcscr::create([
                'motivo'=>$data['motivo'],
                'user_id'=>$data['user_id'],
                'equipment_id'=>$data['equipment_id'],
                'status'=>0,
                'open_at'=>Date::now(),
                'open_at_man'=>$data['open_at_man'],
                
            ]);
    
            $equipment = Equipment::find($data['equipment_id']);
            $equipment->update([
                'status' => 0
            ]);

            $msg = "Um MCSCR foi criado para o Equipamento ".$equipment->name.", Ref: ".$equipment->ref.". Este Equipamento estará indisponível até fechar o MCSCR.";

            Notification::send($user,new Operation($msg));

    
            return redirect()->route('mcscr.index')->with('messageSuccess', 'MCSCR criado com sucesso');
        }else{
            return redirect()->route('mcscr.index')->with('messageError', 'Existe um MCSCR em execução criado para este equipamento. Fecha o MCSCR para abrir um novo.');
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

        return view('manutencao.mcscr.show', compact('mcscr'));
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

        return view('manutencao.mcscr.edit', compact('mcscr'));
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
        $user = User::all();

        $mcscr = Mcscr::find($id);

        $mcscr->update([
            'motivo' => $data['motivo'],
            'causa' => $data['causa'],
            'solucao' => $data['solucao'],
            'consequencia' => $data['consequencia'],
            'recomendacao' => $data['recomendacao'],
            'custo_mao_obra' => $data['custo_mao_obra'],
            'custo_material' => $data['custo_material'],
            'status'=>1,
            'close_at'=>Date::now(),
            'close_at_man'=>$data['close_at_man'],
        ]);

        $equipment = Equipment::find($mcscr->equipment_id);
        $equipment->update([
            'status' => 1
        ]);

        $created_at = strtotime($mcscr->open_at);
        $closed_at = strtotime(Date::now());

        $time = $closed_at - $created_at;

        $time = round($time/3600, 1);

        $msg = "O MCSCR para o Equipamento ".$equipment->name.", Ref: ".$equipment->ref." foi terminado. Esteve indisponível durante ".$time." Horas . Este Equipamento já se encontra disponível";

        Notification::send($user,new Operation($msg));

        return redirect()->route('mcscr.index')->with('messageSuccess', 'MCSCR editado com sucesso');
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
