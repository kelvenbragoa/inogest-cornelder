@extends('layouts_manutencao.master')
@section('content')

<div class="container-fluid p-0">

    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{__('text.analytics_dashboard')}} - MANUTENÇÃO - {{$destination->name}}</strong></h3>
        </div>

        
    </div>


    <div class="row">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total MCSCR</h5>
                                <div class="row">
                                    <div class="col">
                                        <h1 class="mt-1 mb-3">{{count(\App\Models\Mcscr::where('destination_id',$destination->id)->get())}}</h1>
                                        <div class="mb-1">
                                          
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="">Este mês: {{count(\App\Models\Mcscr::where('destination_id',$destination->id)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get())}}</h5>
                                        <h5 class="">Este ano: {{count(\App\Models\Mcscr::where('destination_id',$destination->id)->whereYear('created_at',date('Y'))->get())}}</h5>
                                        
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total MCSCR ABERTOS</h5>
                                <div class="row">
                                    <div class="col">
                                        <h1 class="mt-1 mb-3">{{count(\App\Models\Mcscr::where('destination_id',$destination->id)->where('status',0)->get())}}</h1>
                                        <div class="mb-1">
                                            
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="">Este mês: {{count(\App\Models\Mcscr::where('destination_id',$destination->id)->where('status',0)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get())}}</h5>
                                        <h5 class="">Este ano: {{count(\App\Models\Mcscr::where('destination_id',$destination->id)->where('status',0)->whereYear('created_at',date('Y'))->get())}}</h5>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total MCSCR Fechados</h5>
                                <div class="row">
                                    <div class="col">
                                        <h1 class="mt-1 mb-3">{{count(\App\Models\Mcscr::where('destination_id',$destination->id)->where('status',1)->get())}}</h1>
                                        <div class="mb-1">
                                           
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="">Este mês: {{count(\App\Models\Mcscr::where('destination_id',$destination->id)->where('status',1)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get())}}</h5>
                                        <h5 class="">Este ano: {{count(\App\Models\Mcscr::where('destination_id',$destination->id)->where('status',1)->whereYear('created_at',date('Y'))->get())}}</h5>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Horas Paralizadas (MCSCR FECHADOS)</h5>
                                <div class="row">
                                    <div class="col">
                                        <h1 class="mt-1 mb-3">{{$time_total}}H</h1>
                                        <div class="mb-1">
                                           
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="">Este mês: {{$time_m}}H</h5>
                                        <h5 class="">Este ano: {{$time_y}}H</h5>
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
                                <h5 class="card-title mb-4">Disponibilidade</h5>
                                <div class="row">
                                    <div class="col">
                                        <h1 class="mt-1 mb-3" style="color: green">{{$equipments->where('status',1)->count()}}</h1>
                                        <div class="mb-1">
                                          
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h1 class="mt-1 mb-3" style="color: red">{{$equipments->where('status',0)->count()}}</h1>
                                        <div class="mb-1">
                                          
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Percentagem global disponibilidade</h5>
                                <h1 class="mt-1 mb-3"> 
                                @if ($equipments->count() != 0)
                                {{round( ($equipments->where('status',1)->count()) * 100/$equipments->count(),2)  }} % 
                                @else
                                0%
                                @endif </h1>
                                <div class="mb-1">
                                   
                                </div>
                            </div>
                        </div>
                        
                    </div>
    
                </div>
            </div>
        </div>
    </div>
    


    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>MCSCR em Execução{{$destination->name}}</strong></h3>
        </div>

        
    </div>
    <div class="row">
  
        <div class="table-responsive">
            <table id="myTable" class="table display" >
                <thead>
                    <tr>
                        {{-- <th style="width:10%;">{{__('text.id')}}</th> --}}
                        <th style="width:10%">Estado</th>
                        <th style="width:10%">Equipamento</th>
                        <th style="width:10%">Aberto(A)</th>
                        <th style="width:10%">Fechado(A)</th>
                        <th style="width:10%">Tempo paralisado(A)</th>
                        <th style="width:10%">Aberto</th>
                        <th style="width:10%">Fechado</th>
                        <th style="width:10%">Tempo paralisado</th>
                        <th style="width:15%">Motivo</th>
                        <th style="width:5%">Custo Mão de Obra</th>
                        <th style="width:5%">Custo Material</th>
                        <th>{{__('text.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mcscr_execucao as $item)
                        <tr>
                            {{-- <td>{{$item->id}}</td> --}}
                            <td>@if ($item->status == 0) <span class="badge bg-danger">Em execução</span> @endif @if($item->status == 1) <span class="badge bg-success">Terminado</span> @endif @if($item->status == 2) <span class="badge bg-warning">Aguarda Aprovação</span> @endif</td>
                            <td>{{$item->equipment->name}} ({{$item->equipment->ref}})</td>

                            <td>{{date('d-m-Y H:i',strtotime($item->open_at)) }}</td>
                            @if ($item->close_at == null)
                            <td>----</td>
                            @else
                            <td>{{date('d-m-Y H:i',strtotime($item->close_at))}}</td>
                            @endif
                            @if ($item->close_at == null)
                            <?php
                                $created_at = strtotime($item->open_at);
                                $closed_at = strtotime(Date::now());

                                $time = $closed_at - $created_at;


                            ?>
                            <td style="color:red">{{round($time/3600, 1);  }}Horas({{round($time/60, 1);  }}Minutos)</td>
                            @else
                            <?php
                            $created_at = strtotime($item->open_at);
                            $closed_at = strtotime($item->close_at);

                            $time = $closed_at - $created_at;


                            ?>
                            <td style="color:red">{{round($time/3600, 1);  }}Horas({{round($time/60, 1);  }}Minutos)</td>
                            @endif
                           

                            <td>{{date('d-m-Y H:i',strtotime($item->open_at_man)) }}</td>

                            @if ($item->close_at_man == null)
                            <td>----</td>
                            @else
                            <td>{{date('d-m-Y H:i',strtotime($item->close_at_man))}}</td>
                            @endif
                            @if ($item->close_at_man == null)
                            <?php
                                $created_at = strtotime($item->open_at_man);
                                $closed_at = strtotime(Date::now());

                                $time = $closed_at - $created_at;


                            ?>
                            <td style="color:red">{{round($time/3600, 1);  }}Horas({{round($time/60, 1);  }}Minutos)</td>
                            @else
                            <?php
                            $created_at = strtotime($item->open_at_man);
                            $closed_at = strtotime($item->close_at_man);

                            $time = $closed_at - $created_at;


                            ?>
                            <td style="color:red">{{round($time/3600, 1);  }}Horas({{round($time/60, 1);  }}Minutos)</td>
                            @endif
                           
                            
                            <td>{{$item->motivo}}</td>
                            <td>{{$item->custo_mao_obra}} MT</td>
                            <td>{{$item->custo_material}} MT</td>
                            <td class="table-action">
                                @if ($item->status == 0 || $item->status == 2 )
                                    <a href="{{URL::to('/mcscr/'.$item->id.'/edit')}}"><i class="align-middle" data-feather="edit-2"></i></a>
                                @endif
                                
                                <a href="{{URL::to('/mcscr/'.$item->id)}}"><i class="align-middle" data-feather="eye"></i></a>
                                {{-- <a href="" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}"><i class="align-middle" data-feather="trash"></i></a> --}}
                            </td> 
                        </tr>
                        @include('manutencao.mcscr.modaldelete')
                    @endforeach
                </tbody>
            </table>
            </div>
    
    
</div>
  
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Disponibilidade Equipamentos {{$destination->name}}</strong></h3>
        </div>

        
    </div>
    <div class="row">
  
        <div class="table-responsive">
            <table id="myTable" class="table display" >
                <thead>
                    <tr>
                        {{-- <th style="width:10%;">{{__('text.id')}}</th> --}}
                        <th style="width:25%">Nome</th>
                       
                        <th style="width:10%">Quantidade Equipamentos</th>
                        <th style="width:10%">Percentagem Disponibilidade(%)</th>
                        <th style="width:10%">Disponíveis</th>
                        <th style="width:10%">Indisponíveis</th>
                        <th>{{__('text.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (\App\Models\TypeEquipment::all() as $item)
                        <tr>
                            {{-- <td>{{$item->id}}</td> --}}
                            <td>{{$item->name}}</td>
                       
                            <td>{{count($item->equipment->where('destination_id',$destination->id))}}</td>
                            @if (count($item->equipment->where('destination_id',$destination->id)) == 0)
                                <td>0%</td>
                            @else
                            <td>{{round(count($item->equipment->where('destination_id',$destination->id)->where('status',1))*100/count($item->equipment->where('destination_id',$destination->id)),2)}} %</td>
                            @endif
                            
                            <td style="color: green">{{count($item->equipment->where('destination_id',$destination->id)->where('status',1))}}</td>
                            <td style="color: red">{{count($item->equipment->where('destination_id',$destination->id)->where('status',0))}}</td>

                            <td class="table-action">
                                
                                <a href="{{URL::to('/type_equipment/'.$item->id)}}"><i class="align-middle" data-feather="eye"></i></a>
                                {{-- <a href="" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}"><i class="align-middle" data-feather="trash"></i></a> --}}
                            </td> 
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
            </div>
    
    
</div>
    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('equipment.create')}}" class="btn btn-pill btn-primary"><i class="far fa-plus"></i>Adicionar</a>
                   
                </div>
                
                <div class="card-body">
                    @if (Session::has('messageSuccess'))
                        <div class="alert alert-success">
                            {{Session::get('messageSuccess')}}
                        </div>
                    @endif
                    @if (Session::has('messageError'))
                        <div class="alert alert-danger">
                            {{Session::get('messageError')}}
                        </div>
                    @endif
                    <div class="table-responsive">
                    <table id="myTable" class="table display" >
                        <thead>
                            <tr>
                               
                                <th style="width:20%">Nome</th>
                                <th style="width:10%">Destino</th>
                                <th style="width:10%">Modelo</th>
                                <th style="width:10%">Marca</th>
                                <th style="width:10%">Tipo</th>
                                <th style="width:10%">Serial</th>
                                <th style="width:10%">Chassis</th>
                                <th style="width:5%">Ano</th>
                                <th style="width:10%">Estado</th>
                                <th>{{__('text.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equipments as $item)
                                <tr>
                                   
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->destination->name ?? ''}}</td>
                                    <td>{{$item->make}}</td>
                                    <td>{{$item->model}}</td>
                                    <td>{{$item->type->name}}</td>
                                    <td>{{$item->serial}}</td>
                                    <td>{{$item->chassis}}</td>
                                    <td>{{$item->year}}</td>
                                    <td>@if ($item->status == 1) <span class="badge bg-success">Disponível</span> @else <span class="badge bg-danger">Indisponível</span> @endif</td>
                                    <td class="table-action">
                                        <a href="{{URL::to('/equipment/'.$item->id.'/edit')}}"><i class="align-middle" data-feather="edit-2"></i></a>
                                        <a href="{{URL::to('/equipment/'.$item->id)}}"><i class="align-middle" data-feather="eye"></i></a>
                                       
                                    </td> 
                                </tr>
                                @include('manutencao.equipment.modaldelete')
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

</div>

@endsection