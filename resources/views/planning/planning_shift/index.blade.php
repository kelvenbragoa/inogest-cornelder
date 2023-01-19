@extends('layouts_planning.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Planeamento de Turnos</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('planning.create')}}" class="btn btn-pill btn-primary"><i class="far fa-plus"></i>Adicionar</a>
                   
                </div>
                
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-success">
                            {{Session::get('message')}}
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
                                <th style="width:30%">Turno</th>
                                <th style="width:20%">Supervisor 1</th>
                                <th style="width:20%">Supervisor 2</th>
                                <th style="width:30%">Data</th>
                               
                                <th style="width:20%">{{__('text.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($planning as $item)
                                <tr>
                                    {{-- <td>{{$item->id}}</td> --}}
                                    <td>{{$item->shift->name}}</td>
                                    <td>{{$item->supervisor_1->name ?? ''}}</td>
                                    <td>{{$item->supervisor_2->name ?? ''}}</td>
                                    <td>{{date('d-m-Y',strtotime($item->date))}}</td>
                                   
                                    <td class="table-action">
                                        <a href="{{URL::to('/planning/'.$item->id.'/edit')}}"><i class="align-middle" data-feather="edit-2"></i></a>
                                        <a href="{{URL::to('/planning/'.$item->id)}}"><i class="align-middle" data-feather="eye"></i></a>
                                        {{-- <a href="" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}"><i class="align-middle" data-feather="trash"></i></a> --}}
                                    </td> 
                                </tr>
                                @include('planning.planning_shift.modaldelete')
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