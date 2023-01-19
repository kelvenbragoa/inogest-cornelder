@extends('manutencao_areas.layouts_area_manutencao.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Editar MCSCR</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Editar MCSCR</h5>
                </div>
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-success">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <form action="{{ route('mcscr-area.update', $mcscr->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                     
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Motivo</label>
                                <textarea type="text" class="form-control" name="motivo" id="motivo" placeholder="Motivo da paralização"  required>{{ $mcscr->motivo }}</textarea>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Causa</label>
                                <textarea type="text" class="form-control" name="causa" id="causa" placeholder="causa da paralização"  required>{{ $mcscr->causa }}</textarea>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Solução</label>
                                <textarea type="text" class="form-control" name="solucao" id="solucao" placeholder="solucao da paralização"  required>{{ $mcscr->solucao }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Consequência</label>
                                <textarea type="text" class="form-control" name="consequencia" id="consequencia" placeholder="consequencia da paralização"  required>{{ $mcscr->consequencia }}</textarea>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Recomendação</label>
                                <textarea type="text" class="form-control" name="recomendacao" id="recomendacao" placeholder="recomendacao da paralização"  required>{{ $mcscr->recomendacao }}</textarea>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Motivo de longa paralização (Observações)</label>
                                <textarea type="text" class="form-control" name="obs" id="obs" placeholder="Motivo de longa paralização"  required>{{ $mcscr->obs }}</textarea>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Custo Mão de Obra</label>
                                <textarea type="number" class="form-control" name="custo_mao_obra" id="custo_mao_obra" placeholder="Custo mão de obra"  required>{{ $mcscr->custo_mao_obra }}</textarea>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Custo Material</label>
                                <textarea type="number" class="form-control" name="custo_material" id="custo_material" placeholder="Custo Material"  required>{{ $mcscr->custo_material }}</textarea>
                            </div>
                            
                        </div>

                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Criado por:</label>
                                <input type="text" class="form-control"  placeholder="Criado por" value="{{ $mcscr->user->name }}" required readonly>
                               
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Fechado as:</label>
                                <input type="datetime-local" class="form-control" name="close_at_man" id="close_at_man" placeholder="Fechado" required> 
                            </div>
                            
                        </div>


                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Equipamento</label>
                                <input type="text" class="form-control"  placeholder="Equipamento"  value="{{ $mcscr->equipment->name }}" readonly> 
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