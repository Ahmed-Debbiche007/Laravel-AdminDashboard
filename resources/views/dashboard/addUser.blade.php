@extends('layouts.admin')

@section('main-content')

<x-heading/>
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
<x-usersCount>{{$users->count()}}</x-usersCount>



@endsection