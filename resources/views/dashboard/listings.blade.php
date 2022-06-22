@extends('layouts.admin')

@section('main-content')
<x-navbar>"Products"</x-navbar>
<!-- Page Heading -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Products</h1>

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

    <x-userCard :users="$allListings">
       
        <div>
            <a class="btn btn-primary m-2" href="/addClient"><i class="bi bi-plus-circle"></i> Add Client</a>
        </div>
        
    </x-userCard>
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
                                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                                        <thead>
                                            <tr class="text-dark">
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Mail</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($clients as $client)
                                            <tr>
                                                <td>{{$client->id}}</td>
                                                <td>{{$client->name}} {{$client->last_name}}</td>
                                                <td>{{$client->email}}</td>
                                               
                                                @if (Auth::user()->role == 'Admin')
                                                <form id="form" method="POST" action="/client/{{$client->id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <td>
                                                        <a class="btn btn-primary m-2" href="/client/{{$client->id}}"><i class="bi bi-pencil"></i>Edit</a>
                                                        <button class="btn btn-danger m-2" type="submit"><i class="bi bi-trash"></i>Delete</button>
                                                    <td>
                                                </form>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {{$clients->links()}}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>

</div>

@endsection