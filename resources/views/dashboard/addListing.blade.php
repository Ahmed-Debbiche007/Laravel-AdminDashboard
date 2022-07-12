@extends('layouts.admin')

@section('main-content')
<x-navbar action="Listings" />
<!-- Page Heading -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Add Listing</h1>

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

                        <form method="POST" action="/addListing" class="user">
                        
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                            <label class="form-control-label" for="name">Name</label>
                                <input type="text" class="form-control form-control-user" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>
                            </div>

                            <div class="form-group">
                            <label class="form-control-label" for="tags">Tags</label>
                                <input type="text" class="form-control form-control-user" name="tags" placeholder="{{ __('Tags') }}" value="{{ old('tags') }}" required>
                            </div>

                            <div class="form-group">
                            <label class="form-control-label" for="price">Price</label>
                                <input type="number" step="0.01" class="form-control form-control-user" name="price" placeholder="{{ __('0.00') }}" value="{{ old('price') }}" required>
                            </div>

                            <div class="form-group">
                            <label class="form-control-label" for="tva">TVA</label>
                                <input type="number" step="1" class="form-control form-control-user" name="tva" placeholder="{{ __('0') }}" value="{{ old('tva') }}" required>
                            </div>

                            <div class="form-group">
                            <label class="form-control-label" for="quantity">Quantity</label>
                                <input type="number" step="1" class="form-control form-control-user" name="quantity" placeholder="{{ __('0') }}" value="{{ old('quantity') }}" required>
                            </div>
                            <div class="form-group">
                            <label class="form-control-label" for="description">Description</label>
                               <textarea name="description" class="form-control form-control-user" id="description" cols="30" rows="10" style="border-radius: 20px;"></textarea>
                            </div>

                            

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    <i class="bi bi-plus-circle"></i> Add Listing
                                </button>
                            </div>
                        </form>

                        <hr>


                    </div>


                </div>
            </div>
        </div>
    </div>
    

</div>

@endsection