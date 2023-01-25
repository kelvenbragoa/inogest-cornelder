@extends('layouts_manutencao.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Equipamento</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="mb-1">
                {{-- <button class="btn btn-primary" onclick="generatePDF()">Baixar</button> --}}
              </div>
            <div class="card" id="invoice">
                <div class="card-header">
                    <h5 class="card-title">Equipamento</h5>
                    <a href="{{URL::to('/equipment/'.$equipment->id.'/edit')}}">Editar<i class="align-middle" data-feather="edit-2"></i></a>
                </div>
                <div class="card-body">
                    <p>ID : {{$equipment->id}}</p>
                    <p>Nome : {{$equipment->name}}</p>
                    <p>Omnicom Id : {{$equipment->omnicom_id ?? ''}}</p>
                    <p>Destino : {{$equipment->destination->name ?? ''}}</p>
                    <p>Área : {{$equipment->area->name ?? ''}}</p>
                    <p>Marca : {{$equipment->make}}</p>
                    <p>Modelo : {{$equipment->model}}</p>
                    <p>Tipo : {{$equipment->type->name}}</p>
                    <p>Ano : {{$equipment->year}}</p>
                    <p>Serial : {{$equipment->serial}}</p>
                    <p>Chassis : {{$equipment->chassis}}</p>
                    <p>Mobilizado : @if($equipment->status == 1) <span class="badge bg-success">Operacional</span> @else <span class="badge bg-danger">Imobilizado</span> @endif</p>
                    <p>Estado : @if($equipment->status == 1) <span class="badge bg-success">Disponível</span> @else <span class="badge bg-danger">Indisponível</span> @endif</p>
                    
                    <hr>

                    <h5 class="card-title">Disponibilidade</h5>

                    <p>Tempo de paralização total : {{$time_total}}Horas</p>
                    <p>Tempo de paralização este ano : {{$time_y}}Horas</p>
                    <p>Tempo de paralização este mês : {{$time_m}}Horas</p>
                    <p>Tempo de paralização hoje : {{$time_t}}Horas</p>
                    <p>Nº de MCSCR Total: {{count($equipment->mcscr)}}</p>
                    <p>Nº de MCSCR Terminado: {{count($equipment->mcscr->where('status',1))}}</p>
                    <p>Nº de MCSCR Em execução: {{count($equipment->mcscr->where('status',0))}}</p>
                    <p>Nº de MCSCR Aguardando aprovação: {{count($equipment->mcscr->where('status',2))}}</p>

                    <hr>

                    <div class="row">
                        <h5 class="card-title">Dados referentes a {{date('Y')}}</h5>
                        {{-- <p>Distância percorida: {{$distance}}</p>
                        <p>Combustivel consumido: {{$fuel}} L </p>
                        <p>Tempo de operação: {{$operation_time}} H</p> --}}

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Distância percorida</h5>
                                        <div class="row">
                                            <div class="col">
                                                <h1 class="mt-1 mb-3">{{$distance}}</h1>
                                            </div>
                                            <div class="col">
                                                <i class="align-middle" data-feather="map"></i> 
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Combustivel consumido</h5>
                                        <div class="row">
                                            <div class="col">
                                                <h1 class="mt-1 mb-3">{{$fuel}} L</h1>
                                            </div>
                                            <div class="col">
                                                <i class="align-middle" data-feather="droplet"></i> 
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Tempo de operação</h5>
                                        <div class="row">
                                            <div class="col">
                                                <h1 class="mt-1 mb-3">{{$operation_time}} H</h1>
                                            </div>
                                            <div class="col">
                                                <i class="align-middle" data-feather="clock"></i> 
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Combustivel consumido(L/H)</h5>
                                        <div class="row">
                                            <div class="col">
                                                <h1 class="mt-1 mb-3">@if ($operation_time == 0)
                                                    0 L/H
                                                @else
                                                {{round($fuel/$operation_time,2)}} L/H
                                                @endif </h1>
                                            </div>
                                            <div class="col">
                                                <i class="align-middle" data-feather="droplet"></i> 
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                          
                        </div>

                        <div class="col">
                            <h5>MTTR (Mean time to repair)</h5> 
                            <p>@if (count($mcscr_y) == 0)
                                0 H
                            @else
                            {{number_format($time_y/count($mcscr_y),2)}} H
                            @endif</p>

                        </div>
                        
                        {{-- <div class="col">
                            <h5>MTTF (Mean Time To Failure)</h5> 
                        </div> --}}

                        <div class="col">
                            {{-- (Tempo total disponível – Tempo perdido)/(Número de paradas). 
                                {{number_format(
                                    ($time_operacao_este_ano - $time_total_este_ano) / count($equipment->mcscr_este_ano)
                                    ,2
                                    )}}
                                --}}
                            <h5>MTBF (Mean Time Between Failure)</h5> 
                            <p>@if (count($mcscr_y) == 0)
                                0 H
                            @else
                            {{number_format(($operation_time - $time_y)/count($mcscr_y),2)}} H
                            @endif</p>
                        </div>
                    </div>

                    <hr>

                    <h5 class="card-title">Custos envolvidos neste Equipamento</h5>

                    <p>Total Custo Mão de Obra : {{$equipment->mcscr->sum('custo_mao_obra')}} MT</p>
                    <p>Total Custo Material : {{$equipment->mcscr->sum('custo_material')}} MT</p>
                  

                    <hr>

                    
                    
                        <strong><h3>Para alterar a disponibilidade clica na hora para alterar (É possivel alterar as últimas 24horas)</h3></strong>
                        <div class="row">

                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong> <h5 class="card-title">Disponibilidade em horas 3 dias Atrás - {{date('d-m-Y',strtotime("-3 days"));}}</h5></strong>
                                        <h6 class="card-subtitle text-muted">Disponibilidade Ontem</h6>
                                    </div>
                                    <div class="card-body" id="app">
                                        <div class="row">
                                           
                                        @foreach ($availability_yesterday3 as $item)
                                        <div class="col-1 col-lg-1">
                                            {{-- <button class="@if($item->status==1) btn btn-success @endif @if($item->status==0) btn btn-danger @endif">{{$item->created_at->format('H:i')}}</i></button> --}}
                                            {{-- <a-button equipment="{{$item->id}}" class="@if($item->status==1) btn btn-success @endif @if($item->status==0) btn btn-danger @endif" text="{{$item->created_at->format('H:i')}}"  ></a-button> --}}
                                            
                                                <form action="{{URL::to('availability/'.$item->id)}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="@if($item->status==1) btn btn-success @endif @if($item->status==0) btn btn-danger @endif">{{$item->created_at->format('H:i')}}</i></button>
                                                </form>
                                           
                                           
                                            </div>
                                        @endforeach
                                    
                                    </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                       <strong> <h5 class="card-title">Disponibilidade em horas 2 dias Atrás - {{date('d-m-Y',strtotime("-2 days"));}}</h5></strong>
                                        <h6 class="card-subtitle text-muted">Disponibilidade Hoje</h6>
                                    </div>
                                    <div class="card-body" id="app">

                                        <div class="row">
                                           
                                            @foreach ($availability_yesterday2 as $item)
                                            <div class="col-1 col-lg-1">
                                                {{-- <button class="@if($item->status==1) btn btn-success @endif @if($item->status==0) btn btn-danger @endif">{{$item->created_at->format('H:i')}}</i></button> --}}
                                                {{-- <a-button equipment="{{$item->id}}" class="@if($item->status==1) btn btn-success @endif @if($item->status==0) btn btn-danger @endif" text="{{$item->created_at->format('H:i')}}"  ></a-button> --}}
                                                
                                                    <form action="{{URL::to('availability/'.$item->id)}}" method="post">
                                                        @csrf
                                                        <button type="submit" class="@if($item->status==1) btn btn-success @endif @if($item->status==0) btn btn-danger @endif">{{$item->created_at->format('H:i')}}</i></button>
                                                    </form>
                                               
                                               
                                                </div>
                                            @endforeach
                                        
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong> <h5 class="card-title">Disponibilidade em horas Ontem - {{date('d-m-Y',strtotime("-1 days"));}}</h5></strong>
                                        <h6 class="card-subtitle text-muted">Disponibilidade Ontem</h6>
                                    </div>
                                    <div class="card-body" id="app">
                                        <div class="row">
                                           
                                        @foreach ($availability_yesterday as $item)
                                        <div class="col-1 col-lg-1">
                                            {{-- <button class="@if($item->status==1) btn btn-success @endif @if($item->status==0) btn btn-danger @endif">{{$item->created_at->format('H:i')}}</i></button> --}}
                                            {{-- <a-button equipment="{{$item->id}}" class="@if($item->status==1) btn btn-success @endif @if($item->status==0) btn btn-danger @endif" text="{{$item->created_at->format('H:i')}}"  ></a-button> --}}
                                            
                                                <form action="{{URL::to('availability/'.$item->id)}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="@if($item->status==1) btn btn-success @endif @if($item->status==0) btn btn-danger @endif">{{$item->created_at->format('H:i')}}</i></button>
                                                </form>
                                           
                                           
                                            </div>
                                        @endforeach
                                    
                                    </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                       <strong> <h5 class="card-title">Disponibilidade em horas  Hoje - {{date('d-m-Y')}}</h5></strong>
                                        <h6 class="card-subtitle text-muted">Disponibilidade Hoje</h6>
                                    </div>
                                    <div class="card-body" id="app">

                                        <div class="row">
                                           
                                            @foreach ($availability_today as $item)
                                            <div class="col-1 col-lg-1">
                                                {{-- <button class="@if($item->status==1) btn btn-success @endif @if($item->status==0) btn btn-danger @endif">{{$item->created_at->format('H:i')}}</i></button> --}}
                                                {{-- <a-button equipment="{{$item->id}}" class="@if($item->status==1) btn btn-success @endif @if($item->status==0) btn btn-danger @endif" text="{{$item->created_at->format('H:i')}}"  ></a-button> --}}
                                                
                                                    <form action="{{URL::to('availability/'.$item->id)}}" method="post">
                                                        @csrf
                                                        <button type="submit" class="@if($item->status==1) btn btn-success @endif @if($item->status==0) btn btn-danger @endif">{{$item->created_at->format('H:i')}}</i></button>
                                                    </form>
                                                </div>
                                            @endforeach
                                        
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">

                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Disponibilidade por mês %</h5>
                                        <h6 class="card-subtitle text-muted">Disponibilidade por mês durante corrente ano.720Horas do mês</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart">
                                            <canvas id="chartjs-dashboard-bar3"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Disponibilidade por dia em %</h5>
                                        <h6 class="card-subtitle text-muted">Disponibilidade por dia durante corrente mês. 24Horas do dia</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart">
                                            <canvas id="chartjs-dashboard-bar4"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <hr>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="card flex-fill w-100">
                                    <div class="card-header">
                                        <h5 class="card-title">Custos Envolvidos no Equipamento</h5>
                                        <h6 class="card-subtitle text-muted">Custos de Mão de Obra x Custos de Material.</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart">
                                            <canvas id="chartjs-dashboard-pie2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-12 col-lg-6">
                                <div class="card flex-fill w-100">
                                    <div class="card-header">
                                        <h5 class="card-title">MCSCR por Dia</h5>
                                        <h6 class="card-subtitle text-muted">MCSCR registrados por dia para cada.</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart">
                                            <canvas id="chartjs-dashboard-line"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
     --}}
                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">MCSCR por Mês</h5>
                                        <h6 class="card-subtitle text-muted">MCSCR registrados por mês durante corrente ano.</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart">
                                            <canvas id="chartjs-dashboard-bar2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       
                        </div>
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
                                            <td>@if ($item->status == 0) <span class="badge bg-danger">Em execução</span> @endif @if ($item->status == 1) <span class="badge bg-success">Terminado</span> @endif @if ($item->status == 2) <span class="badge bg-warning">Aguarda Aprovação</span> @endif</td>
        
                                            <td>{{date('d-m-Y H:m:s',strtotime($item->open_at_man)) }}</td>
                                            <td>{{date('d-M-Y H:m:s',strtotime($item->close_at_man))}}</td>
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



<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Pie chart
    var maoobra = @json($equipment->mcscr->sum('custo_mao_obra'));
    var material = @json($equipment->mcscr->sum('custo_material'));
    new Chart(document.getElementById("chartjs-dashboard-pie2"), {
        type: "pie",
        data: {
            labels: ["Mão de obra", "Material"],
            datasets: [{
                data: [maoobra, material ],
                backgroundColor: [
                    window.theme.primary,
                    window.theme.warning,
                   
                ],
                borderWidth: 5
            }]
        },
        options: {
            responsive: !window.MSInputMethodContext,
            maintainAspectRatio: false,
            legend: {
                display: true
            },
            cutoutPercentage: 75
        }
    });
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
    // Bar chart
   
    new Chart(document.getElementById("chartjs-dashboard-bar2"), {
        type: "bar",
        data: {
            labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Otu", "Nov", "Dez"],
            datasets: [{
                label: "Este ano",
                backgroundColor: window.theme.primary,
                borderColor: window.theme.primary,
                hoverBackgroundColor: window.theme.primary,
                hoverBorderColor: window.theme.primary,
                data: [<?php echo $dados_graficobarra ?>],
                barPercentage: .75,
                categoryPercentage: .5
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false
                    },
                    stacked: false,
                    ticks: {
                        stepSize: 20
                    }
                }],
                xAxes: [{
                    stacked: false,
                    gridLines: {
                        color: "transparent"
                    }
                }]
            }
        }
    });
    });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
    // Bar chart
   
    new Chart(document.getElementById("chartjs-dashboard-bar3"), {
        type: "bar",
        data: {
            labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Otu", "Nov", "Dez"],
            datasets: [{
                label: "Este ano",
                backgroundColor: window.theme.primary,
                borderColor: window.theme.primary,
                hoverBackgroundColor: window.theme.primary,
                hoverBorderColor: window.theme.primary,
                data: [<?php echo $dados_graficobarra1 ?>],
                barPercentage: .75,
                categoryPercentage: .5
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false
                    },
                    stacked: false,
                    ticks: {
                        stepSize: 20
                    }
                }],
                xAxes: [{
                    stacked: false,
                    gridLines: {
                        color: "transparent"
                    }
                }]
            }
        }
    });
    });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
    // Bar chart
   
    new Chart(document.getElementById("chartjs-dashboard-bar4"), {
        type: "bar",
        data: {
            labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12","13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24","25","26","27","28","29","30","31"],
            datasets: [{
                label: "Este ano",
                backgroundColor: window.theme.primary,
                borderColor: window.theme.primary,
                hoverBackgroundColor: window.theme.primary,
                hoverBorderColor: window.theme.primary,
                data: [<?php echo $dados_graficobarra2 ?>],
                barPercentage: .75,
                categoryPercentage: .5
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: true
                    },
                    stacked: false,
                    ticks: {
                        stepSize: 20
                    }
                }],
                xAxes: [{
                    stacked: false,
                    gridLines: {
                        color: "transparent"
                    }
                }]
            }
        }
    });
    });
    </script>



<script>
  function generatePDF(){
    const element = document.getElementById("invoice");
    
    var opt = {
    margin:       1,
    filename:     'notificacao.pdf',
    image:        { type: 'jpeg', quality: 0.98 },
    html2canvas:  { scale: 4},
    jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' },

  //pagebreak: { mode: 'avoid-all', before: '#page2el' },
  pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
};

// New Promise-based usage:
html2pdf().set(opt).from(element).save();
   
  }
</script>
@endsection