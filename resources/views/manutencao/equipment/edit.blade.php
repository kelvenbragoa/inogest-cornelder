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
                                <label class="form-label" for="inputEmail4">Referência</label>
                                <input type="text" class="form-control" name="ref" id="ref" placeholder="Refêrencia do equipamento" value="{{$equipment->ref }}" required>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Tipo</label>
                                <select type="text" class="form-control" name="type_equipment_id" id="type_equipment_id" placeholder="Tipo de equipamento" required value="{{ old('type') }}">
                                    @foreach (\App\Models\TypeEquipment::orderBy('name','asc')->get() as $item)
                                        <option @if ($equipment->type_equipment_id == $item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Modelo</label>
                                <input type="text" class="form-control" name="model" id="model" placeholder="Modelo"  value="{{ $equipment->model}}"> 
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Marca</label>
                                <input type="text" class="form-control" name="make" id="make" placeholder="Marca"  value="{{$equipment->make }}">
                            </div>
                            
                        </div>

                       

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Serial</label>
                                <input type="text" class="form-control" name="serial" id="serial" placeholder="Número de serie"  value="{{ $equipment->serial }}">
                            </div>
                            
                        </div>


                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Chassis</label>
                                <input type="text" class="form-control" name="chassis" id="chassis" placeholder="Número de chassis"  value="{{ $equipment->chassis}}">
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Ano</label>
                                <input type="text" class="form-control" name="year" id="year" placeholder="Ano de fabrico"  value="{{$equipment->year }}">
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Capacidade</label>
                                <input type="text" class="form-control" name="load_max" id="load_max" placeholder="Capacidade"  value="{{$equipment->load_max }}">
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Destino de Aplicação</label>
                                <select type="text" class="form-control" name="destination_id" id="destination_id" placeholder="Destino" required value="{{ old('type') }}">
                                    @foreach (\App\Models\Destination::orderBy('name','asc')->get() as $item)
                                        <option @if ($equipment->destination_id == $item->id) selected @endif  value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                        

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Área</label>
                                <select type="text" class="form-control" name="area_id" id="area_id" placeholder="Area" required value="{{ old('area') }}">
                                    @foreach (\App\Models\Area::orderBy('name','asc')->get() as $item)
                                        <option @if ($equipment->area_id == $item->id) selected @endif  value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Mobilizado</label>
                                <select type="text" class="form-control" name="mobilized" id="mobilized" placeholder="Mobilizado" required value="{{ old('mobilized') }}">
                                   
                                        <option value="1" @if ($equipment->mobilized == 1) selected @endif >Operacional</option>
                                        <option value="2" @if ($equipment->mobilized == 2) selected @endif>Imobilizado</option>
                                    
                                </select>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Omnicom ID</label>
                                <input type="text" class="form-control" name="omnicom_id" id="omnicom_id" placeholder="Omnicom Id"  value="{{$equipment->omnicom_id }}">
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Disponibilidade</label>
                                <select type="text" class="form-control" name="status" id="status" required value="{{ old('type') }}">
                                   
                                     <option @if ($equipment->status == 1) selected @endif  value="1">Disponível</option>
                                     <option @if ($equipment->status == 0) selected @endif  value="0">Indisponível</option>
                                   
                                </select>
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