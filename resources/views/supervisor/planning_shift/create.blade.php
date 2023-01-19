@extends('layouts_supervisor.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Planeamento de Turnos</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Planeamento de Turnos</h5>
                </div>
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-success">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <form method="POST" action="{{route('planning.store')}}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Turno</label>
                                <select type="text" class="form-control" name="shift_id" id="shift_id" placeholder="Turno" required>

                                   
                                        @foreach (\App\Models\Shift::where('terminal_id',Auth::user()->terminal_id)->get() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                 
                                   
                                    
                                </select>
                            </div>
                            
                        </div>

                        

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Data</label>
                                <input type="date" class="form-control" name="date" id="date" placeholder="Data" required value="{{ old('date') }}"> 
                                <input type="hidden" value="{{Auth::user()->terminal_id}}" class="form-control" name="terminal_id" id="terminal_id" required > 
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Supervisor 1</label>
                                <select type="text" class="form-control" name="supervisor_1_id" id="supervisor_1_id" placeholder="Turno" required>

                                        <option value="">Selecionar</option>
                                        @foreach (\App\Models\User::where('role_id',4)->get() as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                 
                                   
                                    
                                </select>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Supervisor 2</label>
                                <select type="text" class="form-control" name="supervisor_2_id" id="supervisor_2_id" placeholder="Turno">

                                        <option value="">Selecionar</option>
                                        @foreach (\App\Models\User::where('role_id',4)->get() as $item)
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