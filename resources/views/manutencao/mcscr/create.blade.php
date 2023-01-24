@extends('layouts_manutencao.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Criar MCSCR</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">MCSCR</h5>
                    <small>Nota: Ao adicionar MCSCR á um equipamento irá causar a paralisação deste equipamento</small>
                </div>
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-success">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <form method="POST" action="{{route('mcscr.store')}}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Motivo</label>
                                <textarea type="text" class="form-control" name="motivo" id="motivo" placeholder="Motivo da paralização"  required>{{ old('motivo') }}</textarea>
                            </div>
                            
                        </div>

                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Criado por:</label>
                                <input type="text" class="form-control"  placeholder="Criado por" value="{{ Auth::user()->name }}" required readonly>
                                <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ Auth::user()->id }}" required readonly>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Aberto as:</label>
                                <input type="text" class="form-control" name="model" id="model" placeholder="Modelo"  value="{{date('d-m-Y H:i:s') }}" readonly> 
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Aberto as:</label>
                                <input type="datetime-local" class="form-control" name="open_at_man" id="open_at_man" placeholder="Abertura" required> 
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Previsão de saída:</label>
                                <input type="datetime-local" class="form-control" name="output_forecast" id="output_forecast" placeholder="Abertura" required> 
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Tipo de Equipamento</label>
                                <select type="text" class="form-control" id="type-equipment-dropdown" placeholder="Tipo de equipamento" required value="{{ old('type') }}">
                                    <option value="">Selecione o tipo de Equipamento</option>
                                    @foreach (\App\Models\TypeEquipment::orderBy('name','asc')->get() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Equipamento</label>
                                <select id="equipment-dropdown" name="equipment_id" class="form-control" value="{{ old('equipment_id') }}" required>
                                    
                                </select>
                            </div>
                            
                        </div>

                        {{-- <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Equipamento</label>
                                <select type="text" class="form-control" name="equipment_id" id="equipment_id" placeholder="Tipo de equipamento" required value="{{ old('type') }}">
                                    @foreach (\App\Models\Equipment::orderBy('name','asc')->get() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div> --}}

                        

                       
                        

                      
                        
                        <button type="submit" class="btn btn-primary">Submeter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
  
  $(document).ready(function() {

$('#type-equipment-dropdown').on('change', function() {
    var type_equipment_id = this.value;
    
    $("#equipment-dropdown").html('');
    $.ajax({
    url:"{{url('get-equipment')}}",
    type: "POST",
    data: {
    type_equipment_id: type_equipment_id,
    _token: '{{csrf_token()}}' 
    },
    dataType : 'json',
    success: function(result){
    $('#equipment-dropdown').html('<option value="">Selecione Equipamento</option>'); 
    $.each(result.equipment,function(key,value){
    $("#equipment-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
    });
   
    }
    });
});  
});





    </script>
@endsection

