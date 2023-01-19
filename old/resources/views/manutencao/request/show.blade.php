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
                    <p>Marca : {{$equipment->make}}</p>
                    <p>Modelo : {{$equipment->model}}</p>
                    <p>Tipo : {{$equipment->type}}</p>
                    <p>Ano : {{$equipment->year}}</p>
                    <p>Serial : {{$equipment->serial}}</p>
                    <p>Chassis : {{$equipment->chassis}}</p>
                    <p>Estado : @if($equipment->status == 1) <span class="badge bg-success">Disponível</span> @else <span class="badge bg-danger">Indisponível</span> @endif</p>
                    
                </div>
            </div>
        </div>
    </div>

</div>

@endsection