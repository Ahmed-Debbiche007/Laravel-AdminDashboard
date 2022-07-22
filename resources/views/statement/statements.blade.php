@extends('layouts.admin')

@section('main-content')
<x-navbar action="{{$type}}s" />
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

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primairy shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            @php
                            $date=date('d/m/Y', strtotime($statements->created_at));
                            @endphp

                            <div class="h5 mb-0 font-weight-bold text-gray-800 pb-2 pt-3">Client: {{$client->name}} {{$client->last_name}}</div>
                            <div class="h6 mb-0 text-gray-800 "><strong>{{$type}} Number: </strong> {{$statements->id}} </div>
                            <div class="h6 mb-0 text-gray-800 "><strong>Date:</strong> {{$date}}</div>
                            <div class="h6 mb-0 text-gray-800 "><strong>Total Quantity:</strong> {{$statements->gqte}} </div>
                            <div class="h6 mb-0 text-gray-800 "><strong>Timbre Fiscal:</strong> {{$statements->timbreFiscal}} </div>
                            <div class="h6 mb-0 text-gray-800 "><strong>Total Net: </strong>{{$statements->tht}} </div>
                            <div class="h6 mb-0 text-gray-800 "><strong>TVA:</strong> {{$statements->tva}} </div>
                            <div class="h6 mb-0 text-gray-800 "><strong>Total TTC: </strong>{{$statements->ttc}} </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card  shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">Listing</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">TVA</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Discount</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listings as $listing)
                                    <tr>
                                        <td>{{$listing->name}}</td>
                                        <td>{{$listing->price}}</td>
                                        <td>{{$listing->tva}}%</td>
                                        <td>{{$listing->quantity}}</td>
                                        <td>{{$listing->discount}}%</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if ($type == 'Quote')
                <form id="form" method="POST" action="/QuoteToInvoice/{{$statements->statement_id}}" >
                    @csrf                  
                    <button class="btn btn-warning m-2" type="submit"> <i class="bi bi-receipt" ></i> Create Invoice</button>
                </form>
                @endif
                <form id="form" method="POST" action="/{{$type}}s/{{$statements->statement_id}}">
                    @csrf
                    @method('DELETE')
                    <a type="submit" class="btn btn-warning m-2" type="submit" href="/{{$type}}s/GetPDF/{{$statements->statement_id}}" target="_blank"> <i class="bi bi-receipt"></i> Get PDF</a>
                    <a class="btn btn-primary m-2" href="/{{$type}}/edit/{{$statements->statement_id}}"><i class="bi bi-pencil"></i> Edit</a>                    
                    <button class="btn btn-danger m-2" type="submit"><i class="bi bi-trash"></i>Delete</button>
                </form>
            </div>

        </div>

    </div>

</div>

@endsection