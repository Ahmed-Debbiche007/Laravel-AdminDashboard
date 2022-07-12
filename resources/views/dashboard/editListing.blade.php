@extends('layouts.admin')

@section('main-content')
<x-navbar action="Listings" />
<!-- Page Heading -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Listing</h1>

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

                        <form method="POST" action="/Listing/{{$listings->id}}" class="user">
                        
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

<input type="hidden" name="_method" value="PUT">


                            <div class="form-group">
                            <label class="form-control-label" for="name">Name</label>
                                <input type="text" class="form-control form-control-user" name="name" placeholder="{{ __('Name') }}" value="{{ $listings->name }}" required autofocus>
                            </div>

                            <div class="form-group">
                            <label class="form-control-label" for="tags">Tags</label>
                                <input type="text" class="form-control form-control-user" name="tags" placeholder="{{ __('Tags') }}" value="{{ $listings->tags }}" required>
                            </div>

                            <div class="form-group">
                            <label class="form-control-label" for="price">Price</label>
                                <input type="number" step="0.01" class="form-control form-control-user" name="price" placeholder="{{ __('0.00') }}" value="{{ $listings->price }}" required>
                            </div>
                            <label class="form-control-label" for="tva">TVA</label>
                                <input type="number" step="0.1" class="form-control form-control-user" name="tva" placeholder="{{ __('0') }}" value="{{ $listings->tva }}" required>
                            
                            <label class="form-control-label" for="quantity">Quantity</label>
                                <input type="number" step="1" class="form-control form-control-user" name="quantity" placeholder="{{ __('0') }}" value="{{ $listings->quantity }}" required>
                            </div>
                            <div class="form-group">
                            <label class="form-control-label" for="description">Description</label>
                               <textarea name="description" class="form-control form-control-user" id="description" cols="30" rows="5" style="border-radius: 20px;"  placeholder="{{ $listings->description }}" value="{{ $listings->description }}">{{ $listings->description }}</textarea>
                            </div>

                            

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                <i class="bi bi-save2"></i> Save Changes
                                </button>
                            </div>
                        </form>

                        <hr>


                    </div>


                </div>
            </div>
            <form id="form" method="POST" action="/Listing/{{$listings->id}}">
    @csrf
    @method('DELETE')
    <td>
        <button class="btn btn-danger m-2" type="submit"><i class="bi bi-trash"></i> Delete Listing</button>
    <td>
</form>
        </div>
        
    </div>
    

</div>



@endsection