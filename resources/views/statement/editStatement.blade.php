@extends('layouts.admin')

@section('main-content')

<x-navbar action="Statements" />
<!-- Page Heading -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit {{$type}}</h1>

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
    <form method="POST" action="/{{$type}}/{{$statements->id}}" class="user">
    <input type="hidden" name="_method" value="PUT">
        <div class="row" id="row">
            <div class="col-xl-4 col-md-4 mb-4" style="max-height: 500px ;" id="card">
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



                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="form-control-label" for="client_id">Client</label>
                                <select name="client_id" id="client_id" class="form-control " style="border-radius: 50px;" required>
                                    <option value="{{$client->id}}" selected>{{$client->name}} {{$client->last_name}}</option>
                                    @foreach ($clients as $oclient)
                                    @if ($client->id != $oclient->id)
                                    <option value="{{$oclient->id}}">{{$oclient->name}} {{$oclient->last_name}}</option>
                                    @endif
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="timbreFiscal">Timbre Fiscal</label>
                                <input type="number" step="0.01" class="form-control form-control-user" name="timbreFiscal" placeholder="{{$statements->timbreFiscal}}" value="{{$statements->timbreFiscal}}" required>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primairy shadow h-100 py-2" style="height: 390px ;">
                    <div class="card-body">

                        <div class="col-lg-12" id="list">

                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Discount</th>


                                    </tr>
                                </thead>
                                <tbody id="table">
                                    @foreach ($listings as $listing)
                                    <tr id="tr">
                                        <td>
                                            <select name="listing[]" id="listing" class="form-control " style="border-radius: 50px;" required>
                                            <option value="{{$listing->id}}" selected>{{$listing->name}} </option>
                                                @foreach ($olistings as $olisting)
                                                @if ($listing->id!=$olisting->id)
                                                <option value="{{$olisting->id}}">{{$olisting->name}} </option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="tht" value=0>
                                            <input type="hidden" name="ttc" value=0>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" step="1" class="form-control form-control-user" name="quantity[]" value="{{$listing->quantity}}" required>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <input type="number" step="1" class="form-control form-control-user" name="discount[]" value="{{$listing->discount}}" required>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger m-2 rm" type="button"><i class="bi bi-x-lg"></i></button>
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table><br>
                            <div class="form-group">
                                <button id="btn" type="button" class="btn btn-primary btn-user btn-block">
                                    <i class="bi bi-plus-circle"></i> Add Product
                                </button>
                            </div>






                        </div>

                    </div>

                </div>
            </div>


            <div class="col-xl-4 col-md-6 mb-4">



                <div class="col-lg-12">

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                        <i class="bi bi-pencil"></i> Edit {{$type}}
                        </button>
                    </div>
                </div>


            </div>

        </div>

    </form>
</div>
<script src="{{ URL::asset('js/editInvoice.js') }}"></script>

@endsection