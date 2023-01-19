@extends('layouts_manutencao.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Acta</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Editar Acta</h5>
                </div>
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-success">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <form action="{{ route('meeting.update', $meeting->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                     
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Assunto da Acta</label>
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto da Acta" value="{{ $meeting->subject }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label" for="inputEmail4">Corpo da Acta</label>
                                <textarea class="form-control" name="body" id="default-editor" placeholder="Corpo da Acta" rows="20">{{ $meeting->body}}</textarea>
                            </div>
                        </div>

                      
                       
        
                        <button type="submit" class="btn btn-primary">Submeter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    tinymce.init({
  selector: 'textarea#default-editor'
});
  </script>
@endsection