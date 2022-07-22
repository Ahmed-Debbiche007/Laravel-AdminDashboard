@props(['users'])


@if(Route::is('home') || Route::is('add') )
<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Users</div>
                        
                        
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

@elseif (Route::is('client') || Route::is('Clients') )

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Clients</div>
                        
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

@elseif (Route::is('invoice') || Route::is('Invoices') )

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Invoices</div>
                        
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$users}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-receipt fa-2x text-gray-300"></i>
                    </div>

                </div>

            </div>
            {{$slot}}
        </div>
    </div>
</div>

@elseif (Route::is('quote') || Route::is('Quotes') )

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Quotes</div>
                        
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$users}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-receipt fa-2x text-gray-300"></i>
                    </div>

                </div>

            </div>
            {{$slot}}
        </div>
    </div>
</div>

@else 

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Listings</div>
                        
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$users}}</div>
                    </div>
                    <div class="col-auto">
                       
                        <i class="bi bi-box-seam fa-2x text-gray-300"></i>
                    </div>

                </div>

            </div>
            {{$slot}}
        </div>
    </div>
</div>

@endif