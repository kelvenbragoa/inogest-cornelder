@extends('layouts_operador.master')
@section('content')


<div class="container-fluid p-0">

    <h1 class="h3 mb-3">{{__('text.profile')}}</h1>

    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">{{__('text.profile')}} </h5>
                </div>
                <div class="card-body text-center">
                   
                    <img src="/storage/img/sys/cdm.jpg" alt="{{Auth::user()->name}}" class="img-fluid rounded-circle mb-2" width="128" height="128" >
                   
                    
                    <h5 class="card-title mb-0">{{Auth::user()->name}}</h5>
                    <div class="text-muted mb-2">{{Auth::user()->role->name}}</div>

                </div>
                
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">{{__('text.details')}}</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><span data-feather="user" class="feather-sm mr-1"></span> ID: <a href="#">{{Auth::user()->id}}</a></li>
                        <li class="mb-1"><span data-feather="phone" class="feather-sm mr-1"></span> Telefone: <a href="#">{{Auth::user()->mobile}}</a></li>
                        <li class="mb-1"><span data-feather="at-sign" class="feather-sm mr-1"></span> Email: <a href="#">{{Auth::user()->email}}</a></li>
                        <li class="mb-1"><span data-feather="file" class="feather-sm mr-1"></span> Codigo: <a href="#">{{Auth::user()->document}}</a></li>
                        <li class="mb-1"><span data-feather="file" class="feather-sm mr-1"></span> Nivel: <a href="#">{{Auth::user()->role->name}}</a></li>
                        
                       
                    </ul>
                </div>
                {{-- <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">{{__('text.campaign')}}</h5>
                    <ul class="list-unstyled mb-0">
                        
                        <li class="mb-1"><span class="fas fa-globe fa-fw mr-1"></span> {{__('text.lead_farmer')}}  <a href="#">: @if ($farmer->lead_farmer == 1)  {{__('text.yes')}} @else {{__('text.no')}} @endif</a></li>
                        <li class="mb-1"><span class="fas fa-globe fa-fw mr-1"></span> {{__('text.name')}} {{__('text.lead_farmer')}} <a href="#">:  {{\App\Models\Farmer::find($farmer->lead_farmer_id)->name}}</a></li>
                        <li class="mb-1"><span class="fas fa-globe fa-fw mr-1"></span> Nº {{__('text.group_members')}} <a href="#">:  {{count($farmer->group_members)}}</a></li>
                        
                    </ul>
                </div> --}}
            </div>
        </div>



        
        <div class="col-md-8 col-xl-9">
            <div class="card">
                <div class="card-header">

                    
                </div>
                <div class="card-body h-100">
                   
                   
                   
                   
                   

                   
                </div>
            </div>
        </div>
    </div>

</div>

@endsection