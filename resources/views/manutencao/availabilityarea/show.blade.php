@extends('layouts_manutencao.master')
@section('content')

<div class="container-fluid p-0">

    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{__('text.analytics_dashboard')}} - MANUTENÇÃO AREA - {{$area->name}}</strong></h3>
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
                                        <h1 class="mt-1 mb-3">{{count(\App\Models\Mcscr::where('area_id',$area->id)->get())}}</h1>
                                        <div class="mb-1">
                                          
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="">Este mês: {{count(\App\Models\Mcscr::where('area_id',$area->id)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get())}}</h5>
                                        <h5 class="">Este ano: {{count(\App\Models\Mcscr::where('area_id',$area->id)->whereYear('created_at',date('Y'))->get())}}</h5>
                                        
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
                                        <h1 class="mt-1 mb-3">{{count(\App\Models\Mcscr::where('area_id',$area->id)->where('status',0)->get())}}</h1>
                                        <div class="mb-1">
                                            
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="">Este mês: {{count(\App\Models\Mcscr::where('area_id',$area->id)->where('status',0)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get())}}</h5>
                                        <h5 class="">Este ano: {{count(\App\Models\Mcscr::where('area_id',$area->id)->where('status',0)->whereYear('created_at',date('Y'))->get())}}</h5>
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
                                        <h1 class="mt-1 mb-3">{{count(\App\Models\Mcscr::where('area_id',$area->id)->where('status',1)->get())}}</h1>
                                        <div class="mb-1">
                                           
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="">Este mês: {{count(\App\Models\Mcscr::where('area_id',$area->id)->where('status',1)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get())}}</h5>
                                        <h5 class="">Este ano: {{count(\App\Models\Mcscr::where('area_id',$area->id)->where('status',1)->whereYear('created_at',date('Y'))->get())}}</h5>
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
            <h3><strong>Disponibilidade Equipamentos {{$area->name}}</strong></h3>
        </div>

        
    </div>
    <div class="row">
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
                                {{-- <th style="width:10%;">{{__('text.id')}}</th> --}}
                                <th style="width:20%">Nome</th>
                                <th style="width:10%">Area</th>
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
                                    {{-- <td>{{$item->id}}</td> --}}
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->area->name ?? ''}}</td>
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
                                        {{-- <a href="" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}"><i class="align-middle" data-feather="trash"></i></a> --}}
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
    </div>

</div>

@endsection