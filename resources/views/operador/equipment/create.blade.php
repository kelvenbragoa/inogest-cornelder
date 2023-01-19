@extends('layouts_operador.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Criar MCSCR</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">MCSCR</h5>
                    <small>Nota: Ao adicionar MCSCR á um equipamento irá causar a paralisação deste equipament</small>
                </div>
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-success">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <form method="POST" action="{{route('mcscr-operador.store')}}">
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
                                <input type="text" class="form-control" name="model" id="model" placeholder="Modelo"  value="{{date('d-m-Y h:m:s') }}" readonly> 
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
                                <label class="form-label" for="inputEmail4">Equipamento</label>
                                <select type="text" class="form-control" name="equipment_id" id="equipment_id" placeholder="Tipo de equipamento" required value="{{ old('type') }}">
                                    @foreach (\App\Models\Equipment::orderBy('name','asc')->get() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
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