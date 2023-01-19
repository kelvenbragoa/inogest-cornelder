@extends('layouts_planning.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Editar Planeamento de turno</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Editar Planeamento de turno</h5>
                </div>
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-success">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <form action="{{ route('planning.update', $planning->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                     
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Turno</label>
                                <select type="text" class="form-control" name="shift_id" id="shift_id" placeholder="Turno" required>
                                   
                                    @foreach (\App\Models\Shift::all() as $item)
                                    <option value="{{$item->id}}" @if ($planning->shift_id == $item->id) selected @endif>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Data</label>
                                <input type="date" class="form-control" name="date" id="date" placeholder="Data" required value="{{ $planning->date}}"> 
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