@extends('layouts_operador.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">MCSCR - {{$mcscr->equipment->name}}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">MCSCR</h5>
                </div>
                <div class="card-body">
                    <p><strong>Motivo</strong>  : {{$mcscr->motivo}}</p>
                    <p><strong>Causa</strong> : {{$mcscr->causa}}</p>
                    <p><strong>Solução</strong> : {{$mcscr->solucao}}</p>
                    <p><strong>Consequencia</strong> : {{$mcscr->consequencia}}</p>
                    <p><strong>Recomendação</strong> : {{$mcscr->recomendacao}}</p>
                    <p><strong>Estado</strong> : @if ($mcscr->status == 0) <span class="badge bg-danger">Em execução</span> @else <span class="badge bg-success">Terminado</span> @endif</p>
                    
                    <hr>

                    <h5 class="card-title">Informações do Equipamento</h5>
                    <br>
                    <p><strong>Nome</strong>  : {{$mcscr->equipment->name}}</p>
                    <p><strong>Tipo</strong> : {{$mcscr->equipment->type->name}}</p>
                    <p><strong>Referência</strong> : {{$mcscr->equipment->ref}}</p>

                    <hr>

                    <h5 class="card-title">Informações da Avaria</h5>
                    <p><strong>Aberto em</strong>  : {{date('d-m-Y h:i:s',strtotime($mcscr->open_at))}}</p>
                    <p><strong>Fechado em</strong> : {{date('d-m-Y h:i:s',strtotime($mcscr->close_at))}}</p>

                    @if ($mcscr->close_at == null)
                                    <?php
                                        $created_at = strtotime($mcscr->open_at);
                                        $closed_at = strtotime(Date::now());

                                        $time = $closed_at - $created_at;


                                    ?>
                                    <p style="color:red"><strong>Tempo de paralização</strong> : {{round($time/3600, 1);  }}Horas({{round($time/60, 1);  }}Minutos)</p>
                                    
                                    @else
                                    <?php
                                    $created_at = strtotime($mcscr->open_at);
                                    $closed_at = strtotime($mcscr->close_at);

                                    $time = $closed_at - $created_at;


                                    ?>
                                    <p style="color:red"><strong>Tempo de paralização</strong> : {{round($time/3600, 1);  }}Horas({{round($time/60, 1);  }}Minutos)</p>
                                   
                                    @endif
                                   

                    
                    



                </div>
            </div>
        </div>
    </div>

</div>

@endsection