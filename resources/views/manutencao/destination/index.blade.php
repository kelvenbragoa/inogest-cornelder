@extends('layouts_manutencao.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Destino de Aplicação</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('destination.create')}}" class="btn btn-pill btn-primary"><i class="far fa-plus"></i>Adicionar</a>
                   
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
                                <th style="width:50%">Nome</th>
                                <th style="width:10%">Quantidade Equipamentos</th>
                                <th style="width:10%">Percentagem Disponibilidade(%)</th>
                                <th style="width:10%">Disponíveis</th>
                                <th style="width:10%">Indisponíveis</th>
                                <th>{{__('text.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($destination as $item)
                                <tr>
                                    {{-- <td>{{$item->id}}</td> --}}
                                    <td>{{$item->name}}</td>
                                    <td>{{count($item->equipment->where('mobilized',1))}}</td>
                                    @if (count($item->equipment->where('mobilized',1)) == 0)
                                    <td>0%</td>
                                    @else
                                    <td>{{round(count($item->equipment->where('status',1)->where('mobilized',1))*100/count($item->equipment),2)}} %</td>
                                    @endif
                                    <td style="color: green">{{count($item->equipment->where('status',1)->where('mobilized',1))}}</td>
                                    <td style="color: red">{{count($item->equipment->where('status',0)->where('mobilized',1))}}</td>

                                    <td class="table-action">
                                        <a href="{{URL::to('/destination/'.$item->id.'/edit')}}"><i class="align-middle" data-feather="edit-2"></i></a>
                                        <a href="{{URL::to('/destination/'.$item->id)}}"><i class="align-middle" data-feather="eye"></i></a>
                                        {{-- <a href="" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}"><i class="align-middle" data-feather="trash"></i></a> --}}
                                    </td> 
                                </tr>
                                @include('manutencao.destination.modaldelete')
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