@extends('layouts_planning.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Planeamento de Turnos</h1>

    <div class="row">
       
        <div class="col-md-12">
            <div class="card">
                @if (Session::has('message'))
                        <div class="alert alert-success">
                            {{Session::get('message')}}
                        </div>
                    @endif

                    @if (Session::has('messageError'))
                    <div class="alert alert-danger">
                        {{Session::get('messageError')}}
                    </div>
                @endif
                <div class="card-header">
                    <h5 class="card-title">Planeamento de Turnos</h5>
                </div>

                <div class="card-header">
                    <a href="{{URL::to('/shiftdashboard-planning/'.$planning->id)}}"  class="btn btn-pill btn-primary"><i class="far fa-eye"></i>Painel do turno</a>
                </div>
                <div class="card-body">

                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Informação geral do turno</strong></h3>
                        </div> 
                    </div>

                    <p>Turno : {{$planning->shift->name}}</p>
                    <p>Data : {{$planning->date}}</p>

                    <hr>

                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Brigadas alocadas ao turno</strong></h3>
                        </div> 
                    </div>
                    

                    <a href="" data-toggle="modal" data-target="#exampleAdd" class="btn btn-pill btn-primary"><i class="far fa-plus"></i>Adicionar Brigada</a>

                    @include('planning.planning_shift.brigade.modaladdbrigade')
                    <div class="table-responsive">
                        <table id="myTable" class="table display" >
                            <thead>
                                <tr>
                                
                                    <th style="width:30%">Brigada</th>

                                    <th style="width:30%">Operadores total</th>
                                  
                                   
                                    <th style="width:20%">{{__('text.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brigade_planning as $item)
                                    <tr>
                                        {{-- <td>{{$item->id}}</td> --}}
                                        <td>{{$item->brigade->name}}</td>
                                        <td>{{\App\Models\OperatorBrigadeScheduledShift::where('scheduled_shift_id',$item->id)->count()}}</td>
                                       
                                       
                                        <td class="table-action">
                                            <a href="{{URL::to('/planning/'.$planning->id.'/brigade/'.$item->id)}}"><i class="align-middle" data-feather="eye"></i></a>
                                            <a href="" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}"><i class="align-middle" data-feather="trash"></i></a> 
                                        </td> 
                                    </tr>
                                    @include('planning.planning_shift.brigade.modaldelete')
                                @endforeach
                            </tbody>
                        </table>
                        </div>

                        <hr>

                        <div class="row mb-2 mb-xl-3">
                            <div class="col-auto d-none d-sm-block">
                                <h3><strong>Equipamentos requisitado ao turno</strong></h3>
                            </div> 
                        </div>
                        <a href="" data-toggle="modal" data-target="#exampleAddEquipment" class="btn btn-pill btn-primary"><i class="far fa-plus"></i>Adicionar Requisição Equipamento</a>
                        @include('planning.planning_shift.equipment.modaladdequipment')
                    <div class="table-responsive">
                        <table id="myTable2" class="table display" >
                            <thead>
                                <tr>
                                
                                    <th style="width:20%">Equipamento</th>

                                    <th style="width:15%">Quantidade</th>

                                    <th style="width:30%">Estado da Requisição</th>

                                    <th style="width:15%">Quantidade Respondida</th>

                                    <th style="width:15%">Percentagem%</th>
                                  
                                   
                                    <th style="width:20%">{{__('text.action')}}</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipment_request as $item)
                                    <tr>
                                        {{-- <td>{{$item->id}}</td> --}}
                                        <td>{{$item->type_equipment->name}}</td>
                                        <td>{{$item->qtd}}</td>
                                        <td>@if ($item->status == 1) <span class="badge bg-success">Respondido</span> @else <span class="badge bg-danger">Pendente</span> @endif</td>
                                        <td>{{$item->qtd_real}}</td>
                                         @if ($item->qtd == 0)
                                        <td>0%</td>
                                        @else
                                        <td>{{(100*$item->qtd_real)/ $item->qtd }}%</td>
                                        @endif
                                       
                                       
                                        <td class="table-action">
                                            {{-- <a href="{{URL::to('/planning/'.$planning->id.'/brigade/'.$item->id)}}"><i class="align-middle" data-feather="eye"></i></a> --}}
                                            <a href="{{URL::to('/planning/'.$planning->id.'/equipmentrequest/'.$item->id)}}"><i class="align-middle" data-feather="eye"></i></a>
                                            @if($item->status == 0)
                                            <a href="" data-toggle="modal" data-target="#modaldelete{{$item->id}}"><i class="align-middle" data-feather="trash"></i></a> 
                                            @endif
                                        </td> 
                                    </tr>
                                    @include('planning.planning_shift.equipment.modalviewequipment')
                                    @include('planning.planning_shift.equipment.modaldelete')
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