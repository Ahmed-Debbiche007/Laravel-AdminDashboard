@extends('layouts.admin')

@section('main-content')
<x-navbar action="Dashboard" />
<!-- Page Heading -->
<div class="container-fluid">
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

    <x-userCard :users="$allUsers">
        @if (Auth::user()->role == 'Admin')
        <div>
            <a class="btn btn-primary m-2" href="/add"><i class="bi bi-plus-circle"></i> Add Users</a>
        </div>
        @endif
    </x-userCard>
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">



            <!-- Color System -->
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card  shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="table-responsive">
                                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                                        <thead>
                                            <tr class="text-dark">
                                                <th scope="col">ID</th>
                                                <th scope="col">Photo</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Mail</th>
                                                <th scope="col">Role</th>
                                            </tr>
                                        </thead>
                                        @if (Auth::user()->role == 'Admin')
                                        <tbody>
                                            @foreach ($users as $user)
                                            <tr>
                                                <td>{{$user->id}}</td>
                                                <td> <img style="height: 45px; width: 45px; border-radius: 50% ;" src="{{$user->photo ? asset('/storage/'.$user->photo) : asset('https://st2.depositphotos.com/2619903/6028/v/600/depositphotos_60287149-stock-illustration-no-image-signs-for-web.jpg')}}" alt=""></td>
                                                <td>{{$user->name}} {{$user->last_name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->role}}</td>
                                                @if (Auth::user()->role == 'Admin')
                                                <form id="form" method="POST" action="/profile/{{$user->id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <td>
                                                        <a class="btn btn-primary m-2" href="/profile/{{$user->id}}"><i class="bi bi-pencil"></i>Edit</a>
                                                        <button class="btn btn-danger m-2" type="submit"><i class="bi bi-trash"></i>Delete</button>
                                                    <td>
                                                </form>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        @else
                                        <tbody>
                                            @foreach ($users as $user)
                                            @if($user->role == 'Guest')
                                            <tr>
                                                <td>{{$user->id}}</td>
                                                <td>{{$user->name}} {{$user->last_name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->role}}</td>
                                                @if (Auth::user()->role == 'Admin')
                                                <form id="form" method="POST" action="/profile/{{$user->id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <td>
                                                        <a class="btn btn-primary m-2" href="/profile/{{$user->id}}"><i class="bi bi-pencil"></i>Edit</a>
                                                        <button class="btn btn-danger m-2" type="submit"><i class="bi bi-trash"></i>Delete</button>
                                                    <td>
                                                </form>
                                                @endif
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                        @endif
                                    </table>
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

</div>

</div>

@endsection