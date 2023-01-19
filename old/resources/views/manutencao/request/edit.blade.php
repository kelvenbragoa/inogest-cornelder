@extends('layouts_manutencao.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Editar Equipamento</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Editar Equipamento</h5>
                </div>
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-success">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <form action="{{ route('equipment.update', $equipment->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                     
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Nome Equipamento</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Equipamento" value="{{$equipment->name }}" required>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Modelo</label>
                                <input type="text" class="form-control" name="model" id="model" placeholder="Modelo" required value="{{ $equipment->model}}"> 
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Marca</label>
                                <input type="text" class="form-control" name="make" id="make" placeholder="Marca" required value="{{$equipment->make }}">
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Tipo</label>
                                <input type="text" class="form-control" name="type" id="type" placeholder="Tipo de equipamento" required value="{{ $equipment->type }}">
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Serial</label>
                                <input type="text" class="form-control" name="serial" id="serial" placeholder="Número de serie" required value="{{ $equipment->serial }}">
                            </div>
                            
                        </div>


                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Chassis</label>
                                <input type="text" class="form-control" name="chassis" id="chassis" placeholder="Número de chassis" required value="{{ $equipment->chassis}}">
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Ano</label>
                                <input type="text" class="form-control" name="year" id="year" placeholder="Ano de fabrico" required value="{{$equipment->year }}">
                            </div>
                            
                        </div>
                       
        
                        <button type="submit" class="btn btn-primary">Submeter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection