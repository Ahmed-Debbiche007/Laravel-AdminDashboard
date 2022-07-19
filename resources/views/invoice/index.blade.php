@extends('layouts.admin')

@section('main-content')
<x-navbar action="invoices" />
<!-- Page Heading -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Invoices</h1>

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

    <x-userCard :users="$allInvoices">

        <div>
            <a class="btn btn-primary m-2" href="/addInvoice"><i class="bi bi-plus-circle"></i> Add Invoice</a>
        </div>

    </x-userCard>

    <div class="row">
        @if (($allInvoices !=0))
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
                                                <th scope="col">Client</th>
                                                <th scope="col">Total HT</th>
                                                <th scope="col">Total TVA</th>
                                                <th scope="col">Total TTC</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoices as $invoice)
                                            <tr>
                                                <td>{{$invoice->id}}</td>

                                                <td>{{$invoice->client_id}}</td>
                                                <td>{{$invoice->tht}}</td>
                                                <td>{{$invoice->tva}}</td>
                                                <td>{{$invoice->ttc}}</td>
                                                <form id="form" method="POST" action="/invoice/{{$invoice->id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <td>
                                                        <a class="btn btn-warning m-2" href="/Invoice/{{$invoice->id}}">Details</a>
                                                        <a class="btn btn-primary m-2" href="/Invoice/edit/{{$invoice->id}}"><i class="bi bi-pencil"></i> Edit</a>
                                                        <button class="btn btn-danger m-2" type="submit"><i class="bi bi-trash"></i>Delete</button>
                                                    </td>
                                                    </form>
                                                    
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {{$invoices->links()}}
                        </div>
                    </div>
                </div>

            </div>
          

        </div>
        @else
        <h1>No invoices Yet!</h1>
        @endif
    </div>

</div>

</div>

@endsection