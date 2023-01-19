@extends('layouts_administracao.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Acta da Reunião</h1>

    <div class="row">
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Acta da Reunião</h5>
                    <a href="{{URL::to('/download-ata/'.$meeting->id)}}" class="btn btn-pill btn-primary"><i class="far fa-arrow-down"></i>Baixar</a>
                    <a  class="btn btn-pill btn-secondary"><i class="far fa-file"></i>Enviar Email a todos(Indisponivel)</a>

                </div>
                <div class="card-body">
                   <div class="row">
                    <div class="col">
                        <p>ID : A{{$meeting->id}}</p>
                        <p>Assunto da Acta :{{$meeting->subject}}</p>
                        <p>Corpo da Acta: <a href="{{URL::to('/meeting/'.$meeting->id.'/edit')}}">(Editar)</a> </p>
                        {{-- <textarea class="form-control" name="body" id="default-editor" placeholder="Corpo da Acta" rows="20">{{ $meeting->body}}</textarea> --}}
                        {{-- html_entity_decode($meeting->body) --}}
                        {!! $meeting->body !!}
                    </div>
                 
                   </div>
                   <hr>
                   <div class="row mb-2 mb-xl-3">
                    <div class="col-auto d-none d-sm-block">
                        <h3><strong>Intervenientes da Reunião e tarefas</strong></h3>
                    </div> 
                </div>
                <a href="" data-toggle="modal" data-target="#exampleAddEquipment" class="btn btn-pill btn-primary"><i class="far fa-plus"></i>Adicionar Intervenientes</a>
                @include('administracao.meeting.modal.addparticipant')

                <div class="table-responsive">
                    <table id="myTable" class="table display" >
                        <thead>
                            <tr>
                                {{-- <th style="width:10%;">{{__('text.id')}}</th> --}}
                                <th style="width:30%">Nome</th>
                                <th style="width:30%">Email</th>
                                <th style="width:30%">Obs</th>
                                <th style="width:30%">Envio Email</th>
                                <th>{{__('text.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meeting->participants as $item)
                                <tr>
                                    {{-- <td>{{$item->id}}</td> --}}
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->obs}}</td>
                                    <td>@if ($item->status == 1) <span class="badge bg-success">Enviado</span> @else <span class="badge bg-danger">Pendente</span> @endif</td>
                                    
                                  

                                    <td class="table-action">
                                        <a href="" data-toggle="modal" data-target="#exampleModalCenterEditParticipant{{$item->id}}"><i class="align-middle" data-feather="edit-2"></i></a>
                                        <a href="" data-toggle="modal" data-target="#exampleModalCenterMail{{$item->id}}"><i class="align-middle" data-feather="mail"></i></a>
                                        {{-- <a href="{{URL::to('/meeting/'.$item->id)}}"><i class="align-middle" data-feather="eye"></i></a> --}}
                                        <a href="" data-toggle="modal" data-target="#exampleModalCenterDeleteParticipant{{$item->id}}"><i class="align-middle" data-feather="trash"></i></a>
                                    </td> 
                                </tr>
                                @include('administracao.meeting.modal.editparticipant')
                                @include('administracao.meeting.modal.deleteparticipant')
                                @include('administracao.meeting.modal.sendmail')
                            @endforeach
                        </tbody>
                    </table>
                    </div>


                    <hr>
                   <div class="row mb-2 mb-xl-3">
                    <div class="col-auto d-none d-sm-block">
                        <h3><strong>Intervenientes da Reunião e tarefas</strong></h3>
                    </div> 
                </div>
                <a href="" data-toggle="modal" data-target="#exampleAddTask" class="btn btn-pill btn-primary"><i class="far fa-plus"></i>Adicionar Tarefas</a>
                @include('administracao.meeting.modal.addtask')

                <div class="table-responsive">
                    <table id="myTable2" class="table display" >
                        <thead>
                            <tr>
                                {{-- <th style="width:10%;">{{__('text.id')}}</th> --}}
                                <th style="width:20%">Nome</th>
                                <th style="width:25%">Email</th>
                                <th style="width:25%">Tarefa</th>
                                <th style="width:20%">Quando</th>
                                <th style="width:20%">Estado</th>
                                <th>{{__('text.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meeting->tasks as $item)
                                <tr>
                                    {{-- <td>{{$item->id}}</td> --}}
                                    <td>{{$item->participant->name}}</td>
                                    <td>{{$item->participant->email}}</td>
                                    <td>{{$item->what}}</td>
                                    <td>{{date('d-m-Y',strtotime($item->when))}}</td>
                                    <td>@if ($item->status == 1) <span class="badge bg-success">Terminado</span> @else <span class="badge bg-danger">Pendente</span> @endif</td>
                                    <td class="table-action">
                                        <a href="" data-toggle="modal" data-target="#exampleModalCenterEditTask{{$item->id}}"><i class="align-middle" data-feather="edit-2"></i></a>
                                        {{-- <a href="{{URL::to('/meeting/'.$item->id)}}"><i class="align-middle" data-feather="eye"></i></a> --}}
                                        <a href="" data-toggle="modal" data-target="#exampleModalCenterDeleteTask{{$item->id}}"><i class="align-middle" data-feather="trash"></i></a>
                                    </td> 
                                </tr>
                                @include('administracao.meeting.modal.edittask')
                                @include('administracao.meeting.modal.deletetask')
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    
                
                    
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    tinymce.init({
  selector: 'textarea#default-editor',
  readonly : 1
  
});
  </script>

@endsection