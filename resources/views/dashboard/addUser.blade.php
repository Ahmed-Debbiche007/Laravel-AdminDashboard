@extends('layouts.admin')

@section('main-content')
<x-navbar action="Dashboard" >
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

                        <form method="POST" action="/add" class="user" enctype="multipart/form-data">
                        
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
                            <label class="form-control-label" for="address">Address</label>
                                <input type="text" class="form-control form-control-user" name="address" placeholder="{{ __('Address') }}" value="{{ old('address') }}" required>
                            </div>

                            <div class="form-group">
                            <label class="form-control-label" for="tel">Phone Number</label>
                                <input type="text" class="form-control form-control-user" name="tel" placeholder="{{ __('Phone Number') }}" value="{{ old('tel') }}" required>
                            </div>

                            <div class="form-group">
                            <label class="form-control-label" for="email">Email</label>
                                <input type="email" class="form-control form-control-user" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required>
                            </div>

                            <div class="form-group">
                            <label class="form-control-label" for="photo">Photo</label><br>
                            <input type="file" name="photo" />
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
   
@endif
</div>

@endsection