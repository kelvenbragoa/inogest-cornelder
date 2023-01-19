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
                    <p>Nome : {{$equipment->name}}</p>
                    <p>Destino : {{$equipment->destination->name ?? ''}}</p>
                    <p>Marca : {{$equipment->make}}</p>
                    <p>Modelo : {{$equipment->model}}</p>
                    <p>Tipo : {{$equipment->type->name}}</p>
                    <p>Ano : {{$equipment->year}}</p>
                    <p>Serial : {{$equipment->serial}}</p>
                    <p>Chassis : {{$equipment->chassis}}</p>
                    <p>Estado : @if($equipment->status == 1) <span class="badge bg-success">Disponível</span> @else <span class="badge bg-danger">Indisponível</span> @endif</p>
                    
                    <hr>

                    <h5 class="card-title">Disponibilidade</h5>

                    <p>Tempo de paralização total : {{$time_total}}Horas</p>
                    <p>Tempo de paralização este ano : {{$time_y}}Horas</p>
                    <p>Tempo de paralização este mês : {{$time_m}}Horas</p>
                    <p>Nº de MCSCR : {{count($equipment->mcscr)}}</p>

                    <hr>

                    <h5 class="card-title">Custos envolvidos neste Equipamento</h5>

                    <p>Total Custo Mão de Obra : {{$equipment->mcscr->sum('custo_mao_obra')}} MT</p>
                    <p>Total Custo Material : {{$equipment->mcscr->sum('custo_material')}} MT</p>
                  

                    <hr>

                    <div class="table-responsive">
                        <table id="myTable" class="table display" >
                            <thead>
                                <tr>
                                    {{-- <th style="width:10%;">{{__('text.id')}}</th> --}}
                                    <th style="width:10%">Estado</th>
                                    <th style="width:10%">Aberto Em</th>
                                    <th style="width:10%">Fechado Em</th>
                                    <th style="width:10%">Tempo paralisado</th>
                                    <th style="width:15%">Motivo</th>
                                    <th style="width:15%">Solução</th>
                                    <th style="width:10%">Custo Mão de Obra</th>
                                    <th style="width:10%">Custo Material</th>
                                    <th>{{__('text.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipment->mcscr as $item)
                                    <tr>
                                        {{-- <td>{{$item->id}}</td> --}}
                                        <td>@if ($item->status == 0) <span class="badge bg-danger">Em execução</span> @else <span class="badge bg-success">Terminado</span> @endif</td>
    
                                        <td>{{date('d-m-Y H:m:s',strtotime($item->open_at)) }}</td>
                                        <td>{{date('d-M-Y H:m:s',strtotime($item->close_at))}}</td>
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
                                       
    
    
                                        
                                        <td>{{$item->motivo}}</td>
                                        <td>{{$item->solucao}}</td>
                                        <td>{{$item->custo_mao_obra}} MT</td>
                                        <td>{{$item->custo_material}} MT</td>
                                        <td class="table-action">
                                            @if ($item->status == 0)
                                                <a href="{{URL::to('/mcscr/'.$item->id.'/edit')}}"><i class="align-middle" data-feather="edit-2"></i></a>
                                            @endif
                                            
                                            <a href="{{URL::to('/mcscr/'.$item->id)}}"><i class="align-middle" data-feather="eye"></i></a>
                                            {{-- <a href="" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}"><i class="align-middle" data-feather="trash"></i></a> --}}
                                        </td> 
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