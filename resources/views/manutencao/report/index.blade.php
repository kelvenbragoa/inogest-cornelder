@extends('layouts_manutencao.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Relatórios</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Escolha o tipo de relatório</h5> 
                </div>
                
                <div class="card-body">

                    <form method="POST" action="{{route('report.store')}}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Tipo de relátorio</label>
                                <select type="text" class="form-control" name="report" id="report" placeholder="Relatório" required>
                                    <option value="" >Selecionar</option>
                                    <option value="1">Disponibilidade</option>
                                    {{-- <option value="2">Mcscr</option> --}}
                                </select>
                            </div>
                            
                        </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="inputEmail4">Tipo de Equipamento/Frota</label>
                                    <select type="text" class="form-control" name="type_equipment_id" id="type_equipment_id" placeholder="Relatório" required>
                                        <option value="">Selecionar</option>
                                        @foreach (\App\Models\TypeEquipment::orderBy('name','asc')->get() as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="inputEmail4">Data Inicio</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Data inicio" required>
                                    
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="inputEmail4">Data Fim</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date" placeholder="Data Fim" required>
                                    
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