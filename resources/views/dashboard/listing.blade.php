@extends('layouts.admin')

@section('main-content')
<x-navbar action ="Dashboard"/>
<!-- Page Heading -->
<div class="container-fluid">
  

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


    <div class="card shadow mb-4">
        <div class="card-profile-image mt-4">
            <img style="height: 180px; border-radius: 50%;" src="https://st2.depositphotos.com/2619903/6028/v/600/depositphotos_60287149-stock-illustration-no-image-signs-for-web.jpg" alt="">
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h5 class="font-weight-bold">{{ $listings->name}}</h5>
                        <h5>{{ $listings->price}} TND</h5>
                        <h6>Qte: {{ $listings->quantity}} </h6>
                        <x-listingTag :tagsCsv="$listings->tags" />
                    </div>
                </div>
            </div>

        </div>
    </div>

    

    <div class="card shadow mb-4">
      
        <div class="card-body">

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h5>{{ $listings->description}}</h5>
                    </div>
                </div>
            </div>

        </div>
    </div>

    
    <form id="form" method="POST" action="">
    @csrf
    @method('DELETE')
    <td>
    <a class="btn btn-primary m-2" href="/Listing/edit/{{$listings->id}}"><i class="bi bi-pencil"></i> Edit Listing</a>
        <button class="btn btn-danger m-2" href="#"><i class="bi bi-trash"></i> Delete Listing</button>
    <td>
    </form>

</div>

@endsection