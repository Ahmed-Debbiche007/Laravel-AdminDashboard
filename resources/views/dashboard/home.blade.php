@extends('layouts.admin')

@section('main-content')

<x-heading/>
<x-usersCount>{{$allUsers->count()}}</x-usersCount>

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
                                @unless (count($users)==0)
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col">ID</th>
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
                                @else
                                <h1>No users Found</h1>
                                @endif
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



@endsection