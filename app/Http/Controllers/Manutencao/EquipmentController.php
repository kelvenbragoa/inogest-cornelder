<?php

namespace App\Http\Controllers\Manutencao;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use App\Models\Equipment;
use App\Models\Mcscr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $equipments = Equipment::all();
        return view('manutencao.equipment.index', compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('manutencao.equipment.create');
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


        Equipment::create($data);

        return redirect()->route('equipment.index')->with('message', 'Equipamento criado com sucesso');
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
        function timeToSeconds(string $time): int
            {
                $arr = explode(':', $time);
                if (count($arr) === 3) {
                    return $arr[0] * 3600 + $arr[1] * 60 + $arr[2];
                }
                return $arr[0] * 60 + $arr[1];
            }
        $equipment = Equipment::find($id);

        $mcscr = Mcscr::where('equipment_id',$id)->where('status',1)->get();
        $mcscr_m = Mcscr::where('equipment_id',$id)->where('status',1)->whereMonth('open_at_man',date('m'))->whereYear('open_at_man',date('Y'))->get();
        $mcscr_y = Mcscr::where('equipment_id',$id)->where('status',1)->whereYear('open_at_man',date('Y'))->get();
        $mcscr_t = Mcscr::where('equipment_id',$id)->where('status',1)->whereMonth('open_at_man',date('m'))->whereYear('open_at_man',date('Y'))->whereDay('open_at_man',date('d'))->get();

        $time_total = 0;
        $time_m = 0;
        $time_y=0;
        $time_t=0;

        $operation_time = 0;
        $fuel = 0;
        $distance = 0;


            foreach($mcscr as $item){
                $created_at = strtotime($item->open_at_man);
                $closed_at = strtotime($item->close_at_man);
                $time = $closed_at - $created_at;
                $time_total = $time_total + $time;
            }

            foreach($mcscr_t as $item){
                $created_at = strtotime($item->open_at_man);
                $closed_at = strtotime($item->close_at_man);
                $time = $closed_at - $created_at;
                $time_t = $time_t + $time;
            }

            foreach($mcscr_m as $item){
                $created_at = strtotime($item->open_at_man);
                $closed_at = strtotime($item->close_at_man);
                $time = $closed_at - $created_at;
                $time_m = $time_m + $time;
            }

            foreach($mcscr_y as $item){
                $created_at = strtotime($item->open_at_man);
                $closed_at = strtotime($item->close_at_man);
                $time = $closed_at - $created_at;
                $time_y = $time_y + $time;
            }

            $time_total = round($time_total/3600, 1);
            $time_m = round($time_m/3600, 1);
            $time_y = round($time_y/3600, 1);

            $dados_graficobarra = '';
            for ($x = 1; $x <= 12; $x++) {
                $mcscr = Mcscr::where('equipment_id',$id)->whereMonth('open_at_man',$x)->whereYear('open_at_man',date('Y'))->get();
                $nr = count( $mcscr);
                $dados_graficobarra.="{$nr},";
            }

            $dados_graficobarra1 = '';
            for ($x = 1; $x <= 12; $x++) {
                $availability = Availability::where('equipment_id',$id)->where('status',1)->whereMonth('created_at',$x)->whereYear('created_at',date('Y'))->get();
                $nr = count( $availability);
                $nr = round($nr*100/720,2);
                $dados_graficobarra1.="{$nr},";
            }

            $dados_graficobarra2 = '';
            for ($x = 1; $x <= 31; $x++) {
                $availability = Availability::where('equipment_id',$id)->where('status',1)->whereDay('created_at',$x)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get();
                $nr = count( $availability);
                $nr = round($nr*100/24,2);

                $dados_graficobarra2.="{$nr},";
            }

            // dd($dados_graficobarra1,$dados_graficobarra2);

            $availability_today = Availability::where('equipment_id',$id)->whereDate('created_at',DB::raw('CURDATE()'))->get();
            $availability_yesterday = Availability::where('equipment_id',$id)->whereDate('created_at',DB::raw('DATE_SUB(CURDATE(), INTERVAL 1 DAY)'))->get();
            $availability_yesterday2 = Availability::where('equipment_id',$id)->whereDate('created_at',DB::raw('DATE_SUB(CURDATE(), INTERVAL 2 DAY)'))->get();
            $availability_yesterday3 = Availability::where('equipment_id',$id)->whereDate('created_at',DB::raw('DATE_SUB(CURDATE(), INTERVAL 3 DAY)'))->get();

            
            $response = Http::get('https://api.fleetmaticsafrica.com/moms-api/public/index.php/api/moms?username=cornelder&starting_time=2022-11-09 00:00&ending_time=2022-11-09 13:00&terminal_id='.$equipment->omnicom_id);


            if($response->successful()){
                // dd('successo',$response->object());
                $object = $response->object();
        
               
                $distance = $object->distance;
                $fuel = $object->fuel;

                $operation_time_1_segundos = timeToSeconds($object->operation_time);
                $operation_time = round($operation_time_1_segundos/3600, 1);


             
               

            }elseif($response->failed()){
                $time_operation = 0;
                $fuel = 0;
                $distance = 0;

            }elseif($response->clientError()){
                $time_operation = 0;
                $fuel = 0;
                $distance = 0;

            }elseif($response->serverError()){
                $time_operation = 0;
                $fuel = 0;
                $distance = 0;

            }
            
           

       
         
           
           


        return view('manutencao.equipment.show', compact('equipment','operation_time','distance','fuel','mcscr_y','time_total','time_m','time_y','time_t','dados_graficobarra','dados_graficobarra1','dados_graficobarra2','availability_today','availability_yesterday','availability_yesterday2','availability_yesterday3'));
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
        $equipment = Equipment::find($id);

        return view('manutencao.equipment.edit', compact('equipment'));
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
        $equipment = Equipment::find($id);

        $equipment->update($data);
        
         if($data['mobilized'] == 2){
            $equipment->update([
                'status' => 0
            ]);
        }

        return redirect()->route('equipment.index')->with('message', 'Equipamento editado com sucesso');

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
