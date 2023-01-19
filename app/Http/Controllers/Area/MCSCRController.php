<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use App\Jobs\NotificationMail;
use App\Models\Equipment;
use App\Models\Mcscr;
use App\Models\LogMcscrActivity;
use App\Models\User;
use App\Notifications\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

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
        $mcscr = Mcscr::where('area_id',Auth::user()->area_id)->orderBy('id','desc')->get();
        return view('manutencao_areas.area.mcscr.index', compact('mcscr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('manutencao_areas.area.mcscr.create');
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
    
            
            $equipment->update([
                'status' => 0
            ]);
            
            $user = User::where('area_id',$equipment->area_id)->orWhere('role_id',7)->get();

            $msg = "Um MCSCR foi criado para o Equipamento ".$equipment->name.", Ref: ".$equipment->ref.". Este Equipamento estará indisponível até fechar o MCSCR. \n 
            Equipamento: ".$equipment->name.".\n
            Ref: ".$equipment->ref.".\n
            O motivo da paralização: ".$data['motivo'].". \n 
            Hora da paralização: ".$data['open_at_man'];

            Notification::send($user,new Operation($msg));
            
            $log = Auth::user()->name.' adicionou um novo MCSCR para equipamento '.$equipment->name;
            LogMcscrActivity::create([
                'log'=>$log,
                'area_id'=>$equipment->area_id,
                'destination_id'=>$equipment->destination_id
            ]);

            /*foreach($user as $item){
              NotificationMail::dispatch($item,$msg)->delay(now()->addSeconds('5'));   
            }*/


           
            // return new \App\Mail\NotificationMail($user);
            // return Mail::send(new NotificationMail($user));
            // return new \App\Mail\NotificationMail($user,$msg);

    
            return redirect()->route('mcscr-area.index')->with('messageSuccess', 'MCSCR criado com sucesso');
        }else{
            return redirect()->route('mcscr-area.index')->with('messageError', 'Existe um MCSCR em execução criado para este equipamento. Fecha o MCSCR para abrir um novo.');
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

        return view('manutencao_areas.area.mcscr.show', compact('mcscr'));
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

        return view('manutencao_areas.area.mcscr.edit', compact('mcscr'));
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
            'obs' => $data['obs'],
            'custo_mao_obra' => $data['custo_mao_obra'],
            'custo_material' => $data['custo_material'],
            'close_by'=>Auth::user()->id,
            'status'=>2,
            'close_at'=>Date::now(),
            'close_at_man'=>$data['close_at_man'],
        ]);

        $equipment = Equipment::find($mcscr->equipment_id);
        // $equipment->update([
        //     'status' => 1
        // ]);
        $user = User::where('area_id',$equipment->area_id)->orWhere('role_id',7)->get();


        $created_at = strtotime($mcscr->open_at);
        $closed_at = strtotime(Date::now());

        $time = $closed_at - $created_at;

        $time = round($time/3600, 1);

        // $msg = "O MCSCR para o Equipamento ".$equipment->name.", Ref: ".$equipment->ref." foi terminado. Esteve indisponível durante ".$time." Horas . Este Equipamento já se encontra disponível";

        // Notification::send($user,new Operation($msg));

        // Notification::send($user,new Operation($msg)); 

        $msg = "O MCSCR para o Equipamento ".$equipment->name.", Ref: ".$equipment->ref." foi terminado.Este Equipamento espera aprovação do PLANNING MANUTENÇÃO para estar disponivel. \n 
            Equipamento: ".$equipment->name.".\n
            Ref: ".$equipment->ref.".\n
            O motivo da paralização: ".$data['motivo'].". \n 
            Causa da paralização: ".$data['causa'].". \n 
            Solução da paralização: ".$data['solucao'].". \n 
            Custo de mão de obra: ".$data['custo_mao_obra']." MT. \n 
            Custo de material: ".$data['custo_material']." MT. \n 
            Motivo de longa paralização: ".$mcscr->obs."\n
            Hora da paralização: ".$time." Horas\n"
          
            ;

            Notification::send($user,new Operation($msg)); 
            
            $log = Auth::user()->name.' editou um MCSCR para equipamento '.$equipment->name;
            LogMcscrActivity::create([
                'log'=>$log,
                'area_id'=>$equipment->area_id,
                'destination_id'=>$equipment->destination_id
            ]);

            //  foreach($user as $item){
            //   Mail::queue(new NotificationMail($item,$msg));   
            //  }
            
            /*foreach($user as $item){
                NotificationMail::dispatch($item,$msg)->delay(now()->addSeconds('5'));   
              }*/

        return redirect()->route('mcscr-area.index')->with('messageSuccess', 'MCSCR editado com sucesso');
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
        $data['equipment'] = Equipment::where('area_id',Auth::user()->area_id)->where("type_equipment_id",$request->type_equipment_id)->get(["name","id"]);

        return response()->json($data);
    }
}
