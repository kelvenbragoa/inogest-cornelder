@extends('layouts_supervisor.master')

@section('content')

<div class="container-fluid p-0">

    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{__('text.analytics_dashboard')}} - Supervisor</strong></h3>
            <p>Turno : {{$planning->shift->name}}</p>
            <p>Data : {{$planning->date}}</p>
        </div>

        
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Brigadas para este turno</h5>
                                <div class="row">
                                    <div class="col">
                                        <h1 class="mt-1 mb-3">{{count(\App\Models\BrigadeScheduledShift::where('scheduled_shift_id',$planning->id)->get())}}</h1>
                                        <div class="mb-1">
                                          
                                        </div>
                                    </div>
                                    <div class="col">
                                       
                                        
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Operadores para este turno</h5>
                                <div class="row">
                                    <div class="col">
                                        <h1 class="mt-1 mb-3">{{count(\App\Models\OperatorBrigadeScheduledShift::where('shift_id',$planning->id)->get())}}</h1>
                                        <div class="mb-1">
                                            
                                        </div>
                                    </div>
                                    <div class="col">
                                       
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Equipamentos para este turno</h5>
                                <div class="row">
                                    <div class="col">
                                        <h1 class="mt-1 mb-3">{{count(\App\Models\EquipmentRequestItem::where('scheduled_shift_id',$planning->id)->get())}}</h1>
                                        <div class="mb-1">
                                           
                                        </div>
                                    </div>
                                    <div class="col">
                                      
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        
                    </div>

                  
                </div>
            </div>
        </div>
    </div>


        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Total Consumo Combústivel</h5>
                                    <h1 class="mt-1 mb-3">{{\App\Models\EquipmentRequestItem::where('scheduled_shift_id',$planning->id)->sum('petrol')}} Litros</h1>
                                    <div class="mb-1">
                                       
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Total Moves</h5>
                                    <h1 class="mt-1 mb-3">{{\App\Models\EquipmentRequestItem::where('scheduled_shift_id',$planning->id)->sum('moves')}} Moves</h1>
                                    <div class="mb-1">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Total Toneladas</h5>
                                    <h1 class="mt-1 mb-3">{{\App\Models\EquipmentRequestItem::where('scheduled_shift_id',$planning->id)->sum('ton')}} Tons</h1>
                                    <div class="mb-1">
                                       
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                      
                    </div>
                </div>
            </div>
    
        
    </div>
   



  
  

</div>

@endsection