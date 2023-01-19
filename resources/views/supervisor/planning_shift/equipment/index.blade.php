@extends('layouts_supervisor.master')
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
                    <a href="{{URL::to('/planning-supervisor/'.$planning->id)}}"><h5 class="card-title">Voltar Planeamento de Turnos</h5></a> 
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
                            {{-- <h3><strong>Operadores alocados a: {{$brigade_planning->brigade->name}}, {{$planning->shift->name}}</strong></h3> --}}
                        </div> 
                    </div>
                    

                    {{-- <a href="" data-toggle="modal" data-target="#exampleAdd" class="btn btn-pill btn-primary"><i class="far fa-plus"></i>Adicionar Operadores</a> --}}

                   
                    <div class="table-responsive">
                        <table id="myTable" class="table display" >
                            <thead>
                                <tr>
                                    <th style="width:15%">Nome Equipamento</th>
                                    <th style="width:15%">Referencia Equipamento</th>
                                    <th style="width:15%">Operador</th>
                                    <th style="width:15%">Moves</th>
                                    <th style="width:15%">Toneladas</th>
                                    <th style="width:15%">Combustivel</th>
                                    <th style="width:15%">Kilometragem</th>
                                    <th style="width:15%">Eficiência</th>
                                    <th style="width:20%">{{__('text.action')}}</th> 
                                </tr>
                            </thead>
                          
                                <tbody>
                                    @foreach ($equipmentrequest->items as $item)
                                        <tr>
                                           
                                            <td>{{$item->equipment->name ?? ''}}</td>
                                            <td>{{$item->equipment->ref ?? ''}}</td>
                                            <td>{{$item->user->name ?? ''}}</td>
                                            <td>{{$item->moves}}</td>
                                            <td>{{$item->ton}}</td>
                                            <td>{{$item->petrol}}</td>
                                            <td>{{$item->km}}</td>

                                            {{--((moves+toneladas)/(petrol+km)) * 100--}}
                                            
                                            <td>@if ($item->petrol+$item->km == 0)
                                                Faltam Parâmetros
                                            @else
                                            {{ round((($item->moves+$item->ton)/($item->petrol+$item->km))*100,2) }} %
                                            @endif</td>
                                           
                                           
                                           
                                             <td class="table-action">
                                                
                                               @if(empty($item->equipment->name))
                                                 
                                                @else
                                                <a href="" data-toggle="modal" data-target="#editEquipment{{$item->id}}"><i class="align-middle" data-feather="edit-2"></i></a> 
                                                @endif
                                                
                                                
                                            </td>  
                                        </tr>

                                        @include('supervisor.planning_shift.equipment.modaleditequipment')
                                        
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