@extends('layouts_operador.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Resultado dos turnos</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{-- <a href="{{route('mcscr-operador.create')}}" class="btn btn-pill btn-primary"><i class="far fa-plus"></i>Adicionar</a> --}}
                   
                </div>
                
                <div class="card-body">
                    @if (Session::has('messageSuccess'))
                        <div class="alert alert-success">
                            {{Session::get('messageSuccess')}}
                        </div>
                    @endif
                    @if (Session::has('messageError'))
                        <div class="alert alert-danger">
                            {{Session::get('messageError')}}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="myTable" class="table display" >
                            <thead>
                                <tr>
                                    {{-- <th style="width:10%;">{{__('text.id')}}</th> --}}
                                    <th style="width:15%">Turno</th>
                                    <th style="width:20%">Operador</th>
                                   
                                    <th style="width:10%">Equipamento</th>
                                    <th style="width:10%">Referencia</th>
                                    <th style="width:10%">Combustivel</th>
                                    <th style="width:10%">Moves</th>
                                    <th style="width:10%">Toneladas</th>
                                    
                                   
                                    {{-- <th>{{__('text.action')}}</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipment as $item)
                                    <tr>
                                        {{-- <td>{{$item->id}}</td> --}}
                                        <td>{{$item->scheduled_shift->shift->name}}</td>
                                        <td>{{$item->user->name}}</td>
                                       
                                        <td>{{$item->equipment->name}}</td>
                                        <td>{{$item->equipment->ref}}</td>
                                        <td>{{$item->petrol}}</td>
                                        <td>{{$item->moves}}</td>
                                        <td>{{$item->ton}}</td>
                                       
                                       
                                       {{-- <td class="table-action">
                                             <a href="{{URL::to('/equipment/'.$item->id.'/edit')}}"><i class="align-middle" data-feather="edit-2"></i></a>
                                            <a href="{{URL::to('/equipment/'.$item->id)}}"><i class="align-middle" data-feather="eye"></i></a>
                                            <a href="" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}"><i class="align-middle" data-feather="trash"></i></a>
                                        </td>  --}}
                                    </tr>
                                    @include('manutencao.equipment.modaldelete')
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection