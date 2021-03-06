@extends('layouts.admin')

@section('main-content')
<x-navbar action="Listings" />
<!-- Page Heading -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">{{ __('Listings') }}</h1>

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

    @if (($allListings !=0))

    <x-userCard :users="$allListings">

        <div>
            <a class="btn btn-primary m-2" href="/addListing"><i class="bi bi-plus-circle"></i> Add Listings</a>
        </div>

    </x-userCard>

    <div class="row">
        @foreach ($listings as $listing)
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primairy shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="card-profile-image mt-4">
                                <a href="/Listing/{{$listing->id}}">
                                    <img style="height: 180px; border-radius: 50%;" src="img/image.jpg" alt="">
                                </a>
                            </div>
                            <a href="/Listing/{{$listing->id}}">
                                <div class="h4 mb-0 font-weight-bold text-gray-800 pb-2 pt-3">{{$listing->name}}</div>
                            </a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 pb-2 pt-3">{{$listing->price}} TND</div>
                            <div class="h6 mb-0 text-gray-800 ">TVA: {{$listing->tva}}</div>
                            <div class="h6 mb-0 text-gray-800 ">Qte: {{$listing->quantity}} </div>
                            <x-listingTag :tagsCsv="$listing->tags" />
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @endforeach

        
    </div>
    {{$listings->links()}}

    @else

    <div class="row">

        <!-- Content Column -->
        No Products Yet

    </div>
    @endif
</div>

@endsection