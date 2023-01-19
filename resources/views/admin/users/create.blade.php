@extends('layouts_admin.master')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Usuários</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Usuários</h5>
                </div>
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-success">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <form method="POST" action="{{route('users.store')}}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Nome</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nome" value="{{ old('name') }}" required>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('name') }}" required>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Telefone</label>
                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Telefone" value="{{ old('name') }}" required>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Codigo</label>
                                <input type="text" class="form-control" name="code" id="code" placeholder="Codigo" value="{{ old('name') }}" >
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Nível</label>
                                <select type="text" class="form-control" name="role_id" id="role_id" placeholder="Nivel" required value="{{ old('type') }}" onchange="showDiv(this)">
                                    @foreach (\App\Models\Role::orderBy('name','asc')->get() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>

                        <div class="row" id="hidden_div_area" style="display:none;">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Area</label>
                                <select type="text" class="form-control" name="area_id" id="area_id" placeholder="Nivel"  value="{{ old('type') }}">
                                    <option value="">Selecionar</option>
                                    @foreach (\App\Models\Area::orderBy('name','asc')->get() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>

                        <div class="row" id="hidden_div_terminal" style="display:none;">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Terminal</label>
                                <select type="text" class="form-control" name="terminal_id" id="terminal_id" placeholder="Nivel"  value="{{ old('type') }}">
                                    <option value="">Selecionar</option>
                                    @foreach (\App\Models\Terminal::orderBy('name','asc')->get() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>


                        
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputEmail4">Password</label>
                                <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="" autocomplete="off" required>
                            </div>
                            
                        </div>

                       

                      
                        
                        <button type="submit" class="btn btn-primary">Submeter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


<script type="text/javascript">
    function showDiv(select){
       if(select.value==4  || select.value==5 || select.value==6){
        document.getElementById('hidden_div_terminal').style.display = "block";
        document.getElementById('hidden_div_area').style.display = "none";
       }else if(select.value==8 || select.value==9 || select.value==10 || select.value==11 || select.value==12 || select.value==13 || select.value==14){
        document.getElementById('hidden_div_terminal').style.display = "none";
        document.getElementById('hidden_div_area').style.display = "block";
       }else{
        document.getElementById('hidden_div_terminal').style.display = "none";
        document.getElementById('hidden_div_area').style.display = "none";
       }
    } 
    </script>
@endsection