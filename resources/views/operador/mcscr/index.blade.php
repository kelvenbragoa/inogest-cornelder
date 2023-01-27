@extends('layouts_operador.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">MCSCR</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('mcscr-operador.create')}}" class="btn btn-pill btn-primary"><i class="far fa-plus"></i>Adicionar</a>
                   
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
                            @foreach ($mcscr as $item)
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
                                    {{-- @if ($item->status == 0 || $item->status == 2 )
                                        <a href="{{URL::to('/mcscr-operador/'.$item->id.'/edit')}}"><i class="align-middle" data-feather="edit-2"></i></a>
                                    @endif --}}
                                    
                                    <a href="{{URL::to('/mcscr-operador/'.$item->id)}}"><i class="align-middle" data-feather="eye"></i></a>
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