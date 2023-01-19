@extends('layouts_manutencao.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Requisição de Equipamento</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Requisição de Equipamento</h5>
                </div>
                <div class="card-body">
                    @if (Session::has('messageError'))
                        <div class="alert alert-danger">
                            {{Session::get('messageError')}}
                        </div>
                    @endif

                    <p><strong>Turno: {{$equipmentrequest->scheduled_shift->shift->name}}</strong></p>
                    <p><strong>Tipo de Equipamento: {{$equipmentrequest->type_equipment->name}}</strong></p>
                    <p><strong>Quantidade de Equipamento Requisitada: {{$equipmentrequest->qtd}}</strong></p>
                    <p><strong>Observação:  {{$equipmentrequest->obs}}</strong></p>
                    <p></p>
                    <form action="{{ route('equipmentrequest.update', $equipmentrequest->id)}}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Quantidade Entregue</label>
                                <input type="number" class="form-control" name="qtd_real" id="qtd_real" placeholder="Quantidade Atendida" value="{{$equipmentrequest->qtd_real}}" required>
                            </div>
                            
                        </div>


                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Equipamentos a entregar</label>
                               
                            </div>
                            
                        </div>

                        

                        @for ($i = 0; $i < $equipmentrequest->qtd; $i++)

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Nome Equipamento</label>
                                <select type="text" class="form-control" name="equipment_id[]" id="name" placeholder="Equipamento" value="">
                                        <option value="">Selecionar</option>
                                    @foreach (\App\Models\Equipment::where('status',1)->where('type_equipment_id',$equipmentrequest->type_equipment_id)->get() as $item)
                                        
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>

                        @endfor
                     
                        

                       
                        <button type="submit" class="btn btn-primary">Submeter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection