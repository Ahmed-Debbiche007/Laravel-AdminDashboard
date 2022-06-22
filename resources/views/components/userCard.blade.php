@props(['users'])
<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primairy shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        @if(Route::is('home') || Route::is('add') )
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Users</div>
                        @else
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Clients</div>
                        @endif
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$users}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>

                </div>

            </div>
            {{$slot}}
        </div>
    </div>
</div>