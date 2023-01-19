@extends('layouts_manutencao.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Tipo de Equipamento</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tipo de Equipamento</h5>
                </div>
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-success">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <form method="POST" action="{{route('type_equipment.store')}}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Tipo Equipamento</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Equipamento" value="{{ old('name') }}" required>
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