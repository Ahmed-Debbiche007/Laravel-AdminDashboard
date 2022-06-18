@extends('layouts.admin')

@section('main-content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('status'))
<div class="alert alert-success border-left-success" role="alert">
    {{ session('status') }}
</div>
@endif





<div class="row">

    <div class="col-lg-6">

        @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="/add" class="user">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <input type="text" class="form-control form-control-user" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="form-group">
                <input type="text" class="form-control form-control-user" name="last_name" placeholder="{{ __('Last Name') }}" value="{{ old('last_name') }}" required>
            </div>

            <div class="form-group">
                <input type="email" class="form-control form-control-user" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                                    <label class="form-control-label" for="role">Role</label>
                                    <br>
                                    <input type="radio" id="guest" name="role" value="Guest" checked>
                                    <label for="guest">Guest</label>
                                    <br>
                                    <input type="radio" id="admin" name="role" value="Admin">
                                    <label for="admin">Admin</label>
                                    <br>

                                </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-user" name="password" placeholder="{{ __('Password') }}" required>
            </div>

            <div class="form-group">
                <input type="password" class="form-control form-control-user" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-user btn-block">
                <i class="bi bi-plus-circle"></i> Add User
                </button>
            </div>
        </form>

        <hr>


    </div>


</div>
<div class="row">



    <!-- Users -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primairy shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$users->count()}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                   
                </div>

            </div>
        </div>
</div>
</div>



    @endsection