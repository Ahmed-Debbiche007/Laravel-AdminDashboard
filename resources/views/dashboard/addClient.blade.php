@extends('layouts.admin')

@section('main-content')
<x-navbar>"Dashboard"</x-navbar>
<!-- Page Heading -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Add User</h1>

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

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primairy shadow h-100 py-2">
                <div class="card-body">

                    <div class="col-lg-12">

                        @if ($errors->any())
                        <div class="alert alert-danger border-left-danger" role="alert">
                            <ul class="pl-4 my-2">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form method="POST" action="/addClient" class="user">
                        
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                            <label class="form-control-label" for="name">Name</label>
                                <input type="text" class="form-control form-control-user" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>
                            </div>

                            <div class="form-group">
                            <label class="form-control-label" for="last_name">Last Name</label>
                                <input type="text" class="form-control form-control-user" name="last_name" placeholder="{{ __('Last Name') }}" value="{{ old('last_name') }}" required>
                            </div>

                            <div class="form-group">
                            <label class="form-control-label" for="email">Email</label>
                                <input type="email" class="form-control form-control-user" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                            <label class="form-control-label" for="password">Password</label>
                                <input type="password" class="form-control form-control-user" name="password" placeholder="{{ __('Password') }}" required>
                            </div>

                            <div class="form-group">
                            <label class="form-control-label" for="password_confirmation">Confirm Password</label>
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
            </div>
        </div>
    </div>
    <x-userCard :users="$allclients" />

</div>

@endsection