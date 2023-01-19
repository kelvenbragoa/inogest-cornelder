@extends('layouts_manutencao.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Area</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                     <a href="{{route('meeting.create')}}" class="btn btn-pill btn-primary"><i class="far fa-plus"></i>Adicionar</a> 
                   
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
                                <th style="width:10%">ID Acta</th>
                                <th style="width:40%">Assunto</th>
                                <th style="width:30%">Data</th>
                                
                                <th>{{__('text.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meetings as $item)
                                <tr>
                                    {{-- <td>{{$item->id}}</td> --}}
                                    <td>A-{{$item->id}}</td>
                                    <td>{{$item->subject}}</td>
                                    <td>{{$item->created_at->format('d-m-Y')}}</td>
                                    
                                  

                                    <td class="table-action">
                                        <a href="{{URL::to('/meeting/'.$item->id.'/edit')}}"><i class="align-middle" data-feather="edit-2"></i></a>
                                        <a href="{{URL::to('/meeting/'.$item->id)}}"><i class="align-middle" data-feather="eye"></i></a>
                                        {{-- <a href="" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}"><i class="align-middle" data-feather="trash"></i></a> --}}
                                    </td> 
                                </tr>
                                @include('manutencao.area.modaldelete')
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