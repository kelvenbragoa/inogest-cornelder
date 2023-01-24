<?php

namespace App\Http\Controllers\Manutencao;


use App\Http\Controllers\Controller;
use App\Models\Availability;
use App\Models\Mcscr;
use App\Models\Report;
use App\Models\TypeEquipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('manutencao.report.index');
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
        function dateDiffInDays($date1, $date2) 
        {
            // Calculating the difference in timestamps
            $diff = strtotime($date2) - strtotime($date1);
        
            // 1 day = 24 hours
            // 24 * 60 * 60 = 86400 seconds
            return abs(round($diff / 86400));
        }

        

        if($data['report'] == 1){

           
            $id = $data['type_equipment_id'];
            $type = TypeEquipment::find($id);
            $startDate = $data['start_date'];
            $endDate = $data['end_date'];
            $days = 1;
            $time_total = 0;
            $mcscr_time_total_paralizado_1 = 0;
            $arrayreport = array();

            $dados_graficobarra1 = '';
            for ($x = 1; $x <= 12; $x++) {
                $availability = Availability::where('type_equipment_id',$id)->where('status',1)->whereMonth('created_at',$x)->whereYear('created_at',date('Y'))->get();
                $availabilitytotal = Availability::where('type_equipment_id',$id)->whereMonth('created_at',$x)->whereYear('created_at',date('Y'))->get();
                $nr = count( $availability);
                if (count($availabilitytotal)==0) {
                    $nr = 0;
                    $dados_graficobarra1.="{$nr},";
                } else {
                    $nr = round($nr*100/count($availabilitytotal),2);
                    $dados_graficobarra1.="{$nr},";
                }
                
                
            }

            $dados_graficobarra2 = '';
            for ($x = 1; $x <= 31; $x++) {
                $availability = Availability::where('type_equipment_id',$id)->where('status',1)->whereDay('created_at',$x)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get();
                $availabilitytotal = Availability::where('type_equipment_id',$id)->whereDay('created_at',$x)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get();
                $nr = count( $availability);

                if (count($availabilitytotal)==0) {
                    $nr = 0;
                    $dados_graficobarra2.="{$nr},";
                } else {
                    $nr = round($nr*100/count($availabilitytotal),2);

                    $dados_graficobarra2.="{$nr},";
                }
                
            }

            $dateDiff = dateDiffInDays($startDate, $endDate);

            if($dateDiff !=0 ){
                $days = $dateDiff;
            }

            


            foreach ($type->equipment as $item){
                $mcscr_time_total_paralizado = Mcscr::where('equipment_id',$id)->where('status',1)->whereBetween('created_at', [$startDate, $endDate])->get();
                $availability_total = Availability::where('equipment_id',$item->id)->whereBetween('created_at', [$startDate, $endDate])->where('status',1)->count();
                $operation_time = 0;
                $mtbf = 0;
                $mcscr = Mcscr::where('equipment_id',$item->id)->orderBy('id','desc')->first();

                foreach($mcscr_time_total_paralizado as $item){
                    $created_at = strtotime($item->open_at_man);
                    $closed_at = strtotime($item->close_at_man);
                    $time = $closed_at - $created_at;
                    $mcscr_time_total_paralizado_1 = $mcscr_time_total_paralizado_1 + $time;
                }
                
                


                if($item->omnicom_id == null){
                    $report1 = new Report();
                    $report1->availability_total_date = $availability_total;
                    $report1->last_mcscr = $mcscr;
                    $report1->time_stopped = $mcscr_time_total_paralizado_1;
                    $report1->operation_time = 0;
                    $report1->mtbf = 0;
                    $arrayreport[] = $report1;

                }else{

                    $report1 = new Report();
                    $report1->availability_total_date = $availability_total;
                    $report1->last_mcscr = $mcscr;
                    $report1->time_stopped = $mcscr_time_total_paralizado_1;
                    $report1->operation_time = 0;
                    $report1->mtbf = 0;
                    $arrayreport[] = $report1;

                }

            }

            // $arrayreport = array();

            // $report1 = new Report();
            // $report1->name = 'a';
            // $report1->mobile = '840000';

            // $report2 = new Report();
            // $report2->name = 'a1';
            // $report2->mobile = '841111';

            // $arrayreport[] = $report1;
            // $arrayreport[] = $report2;

           

            

            


            return view('manutencao.report.show', compact('type','dados_graficobarra1','dados_graficobarra2','arrayreport'));


        }elseif($data['report'] == 2){

            dd('mcscr');

        }
        


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
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
    }
}
