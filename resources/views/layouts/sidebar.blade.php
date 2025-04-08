<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                @role('superadmin') 
                <li class="menu-title" key="t-pages">Settings</li>
                <li>
                    <a href="{{route('permissions.index') }}" class="waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-authentication">Users</span>
                    </a>
                </li>     
                @endrole
                @role('superadmin|admin') 
                <li class="menu-title" key="t-menu">Menu</li>
                @can('Personal')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span key="t-authentication">Personal</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('types.create') }}" key="t-login">Type</a></li>
                        <li><a href="{{route('subs.create') }}" key="t-login">Sub</a></li>
                        <li><a href="{{route('personal.index')}}" key="t-login">Data</a></li>
                    </ul>
                </li>
                @endcan
                @can('PDCA')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-task"></i>
                        <span key="t-authentication">PDCA</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('plan.create')}}" key="t-login">Plan</a></li>      
                        <li><a href="{{route('plan-do.index')}}" key="t-login">Do</a></li>     
                        <li><a href="{{route('plan-check.index')}}" key="t-login">Check</a></li>  
                        <li><a href="{{route('plan-action.index')}}" key="t-login">Action</a></li>                  
                    </ul>
                </li>
                @endcan
                @can('Physician')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-plus-medical"></i>
                        <span key="t-authentication">Physician</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="#" key="t-login">Medicine</a></li> --}}
                        <li><a href="{{route('history.create')}}" key="t-login">OPD</a></li>
                        <li><a href="{{route('joint.create')}}" key="t-login">OSTRC</a></li>
                        <li><a href="{{route('lab.index')}}" key="t-login">Lab</a></li>                       
                    </ul>
                </li>
                @endcan
                @can('Strengthen')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-run"></i>
                        <span key="t-authentication">Strengthen</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" key="t-login">Body Composition</a></li>
                        <li><a href="#" key="t-login">Physical Fitness</a></li>
                    </ul>
                </li>
                @endcan
                @can('Nutrition')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-restaurant"></i>
                        <span key="t-authentication">Nutrition</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" key="t-login">Food list</a></li>
                    </ul>
                </li>
                @endcan
                @can('Psychology')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-happy-beaming"></i>
                        <span key="t-authentication">Psychology</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('psychology.index')}}" key="t-login">Mental Health</a></li>
                    </ul>
                </li>
                @endcan
                @can('Physical')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-body"></i>
                        <span key="t-authentication">Physical</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('physical.index')}}" key="t-login">Record</a></li>
                    </ul>
                </li>
                @endcan
                @can('Report')
                <li class="menu-title" key="t-pages">Report</li>
                <li>
                <a href="{{route('joint.index')}}" class="waves-effect">
                    <i class="bx bx-line-chart"></i>
                    <span key="t-authentication">Joint</span>
                </a>
                </li>
                @endcan
                @endrole
                @role('superadmin|admin|employee') 
                <li class="menu-title" key="t-pages">Evaluation</li>
                <li>
                <a href="{{route('ostrc.index')}}" class="waves-effect">
                    <i class="bx bx-plus-medical"></i>
                    <span key="t-authentication">แบบประเมิน OSTRC</span>
                </a>
                <a href="{{route('foodtaste.index')}}" class="waves-effect">
                    <i class="bx bx-restaurant"></i>
                    <span key="t-authentication">แบบประเมินอาหาร</span>
                </a>
                <a href="{{route('health.index')}}" class="waves-effect">
                    <i class="bx bx-happy-beaming"></i>
                    <span key="t-authentication">แบบประเมินสุขภาพจิต</span>
                </a>
                </li>
                @endrole
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>