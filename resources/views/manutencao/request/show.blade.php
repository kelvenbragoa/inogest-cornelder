@extends('layouts_manutencao.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Equipamento</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Equipamento</h5>
                </div>
                <div class="card-body">

                    <p><strong>Turno: {{$equipmentrequest->scheduled_shift->shift->name}}</strong></p>
                    <p><strong>Tipo de Equipamento: {{$equipmentrequest->type_equipment->name}}</strong></p>
                    <p><strong>Quantidade de Equipamento Requisitada: {{$equipmentrequest->qtd}}</strong></p>
                    <p><strong>Quantidade de Equipamento Respondida: {{$equipmentrequest->qtd_real}}</strong></p>
                    <p><strong>Percentagem: {{(100*$equipmentrequest->qtd_real)/ $equipmentrequest->qtd }}%</strong></p>
                    <p><strong>Observação:  {{$equipmentrequest->obs}}</strong></p>

                    


                    <div class="table-responsive">
                        <table id="myTable" class="table display" >
                            <thead>
                                <tr>
                                    {{-- <th style="width:10%;">{{__('text.id')}}</th> --}}
                                    <th style="width:20%">Nome</th>
                                    <th style="width:10%">Destino</th>
                                    <th style="width:10%">Modelo</th>
                                    <th style="width:10%">Marca</th>
                                    <th style="width:10%">Tipo</th>
                                    <th style="width:10%">Operador</th>
                                    <th style="width:10%">Combustivel</th>
                                    <th style="width:5%">Moves</th>
                                    <th style="width:5%">Toneladas</th>
                                    {{-- <th style="width:10%">Estado</th> --}}
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipmentrequest->items as $item)
                                    <tr>
                                      
                                        <td>{{$item->equipment->name ?? ''}}</td>
                                        <td>{{$item->equipment->destination->name ?? ''}}</td>
                                        <td>{{$item->equipment->make ?? ''}}</td>
                                        <td>{{$item->equipment->model ?? ''}}</td>
                                        <td>{{$item->equipment->type->name ?? ''}}</td>
                                        <td>{{$item->equipment->user_id ?? ''}}</td>
                                        <td>{{$item->equipment->petrol ?? ''}}</td>
                                        <td>{{$item->equipment->moves ?? ''}}</td>
                                        <td>{{$item->equipment->ton ?? ''}}</td>

                                       
                                       
                                        {{-- <td>@if ($item->equipment->status == 1) <span class="badge bg-success">Disponível</span> @else <span class="badge bg-danger">Indisponível</span> @endif</td> --}}
                                      
                                    </tr>
                                  
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