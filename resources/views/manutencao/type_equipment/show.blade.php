@extends('layouts_manutencao.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Tipo Equipamento</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tipo de Equipamento</h5>
                </div>
                <div class="card-body">
                   <div class="row">
                    <div class="col">
                        <p>Nome : {{$type->name}}</p>
                        <p>Número de Equipamentos : {{count($type->equipment)}}</p>
                        <p style="color:green">Equipamentos Disponíveis : {{count($type->equipment->where('status',1))}}</p>
                        <p style="color:red">Equipamentos Indisponíveis: {{count($type->equipment->where('status',0))}}</p>
                    </div>
                    <div class="col">
                        <p>Percentagem disponibilidade:</p>
                        @if (count($type->equipment)>0)
                        <h2>{{round(count($type->equipment->where('status',1))*100/count($type->equipment),2)  }} %</h2>
                        @else
                           <h2>0%</h2>
                        @endif
                        
                    </div>
                   </div>
                   <hr>
                   <div class="row">

                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Disponibilidade por mês %</h5>
                                <h6 class="card-subtitle text-muted">Disponibilidade por mês durante corrente ano.</h6>
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
                                <h6 class="card-subtitle text-muted">Disponibilidade por dia durante corrente mês.</h6>
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
                  <div class="table-responsive">
                    <table id="myTable" class="table display" >
                        <thead>
                            <tr>
                                {{-- <th style="width:10%;">{{__('text.id')}}</th> --}}
                                <th style="width:20%">Nome</th>
                                <th style="width:15%">Modelo</th>
                                <th style="width:15%">Marca</th>
                                <th style="width:15%">Tipo</th>
                                <th style="width:10%">Serial</th>
                                <th style="width:10%">Chassis</th>
                                <th style="width:10%">Ano</th>
                                <th style="width:15%">Estado</th>
                                <th>{{__('text.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($type->equipment as $item)
                                <tr>
                                    {{-- <td>{{$item->id}}</td> --}}
                                    <td>{{$item->name}}</td>
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
@endsection