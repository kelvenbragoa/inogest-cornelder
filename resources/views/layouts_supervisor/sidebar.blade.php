<nav id="sidebar" class="sidebar" >
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
          <span class="align-middle">InoGest</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                {{__('text.pages')}}
            </li>
            <li class="sidebar-item">
                <a href="#dashboard" data-toggle="collapse" class="sidebar-link collapsed">
                <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">{{__('text.dashboard')}}</span>
                </a>
                <ul id="dashboard" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{URL::to('/home')}}">{{__('text.operation')}}</a></li>
                 
                    {{-- <li class="sidebar-item"><a class="sidebar-link" href="">{{__('text.human_resource')}}</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="">{{__('text.financial')}}</a></li>
                    --}}
                </ul>
            </li>
            <li class="sidebar-header">
                {{__('text.management')}}
            </li>
           
                
            
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('planning-supervisor.index')}}">
                <i class="align-middle" data-feather="users"></i> <span class="align-middle">Planeamento turnos</span>
                </a>
            </li>
            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="">
                <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">{{__('text.process_salary')}}</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="">
                <i class="align-middle" data-feather="user"></i> <span class="align-middle">{{__('text.users')}}</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="">
                <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">{{__('text.positions')}}</span>
                </a>
            </li>

            

            <li class="sidebar-item">
                <a class="sidebar-link" href="">
                <i class="align-middle" data-feather="users"></i> <span class="align-middle">{{__('text.customers')}}</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="">
                <i class="align-middle" data-feather="archive"></i> <span class="align-middle">{{__('text.mcscr')}}</span>
                </a>
            </li>

            <li class="sidebar-header">
                {{__('text.finances')}}
            </li>

            

            
            

            <li class="sidebar-item">
                <a class="sidebar-link" href="">
                <i class="align-middle" data-feather="activity"></i> <span class="align-middle">{{__('text.quotation')}}</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="">
                <i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">{{__('text.invoice')}}</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="">
                <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">{{__('text.expense')}}</span>
                </a>
            </li> --}}

            

          
        </ul>

        <!--<div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
                <div class="mb-3 text-sm">
                    Are you looking for more components? Check out our premium version.
                </div>
                <a href="https://adminkit.io/pricing" target="_blank" class="btn btn-primary btn-block">Upgrade to Pro</a>
            </div>
        </div>-->
    </div>
</nav>