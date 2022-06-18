@extends('home')

@section('usersTable')
<div class="row">
    <!-- Content Column -->
    <div class="col-lg-12 mb-4">
        <!-- Color System -->
        <div class="row">
            <div class="col-md-8 mb-4">
                <div class="card  shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="table-responsive">
                                <h1>No users Found</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{$users->links()}}
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection