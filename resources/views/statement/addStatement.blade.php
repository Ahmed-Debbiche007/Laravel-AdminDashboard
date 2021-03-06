@extends('layouts.admin')

@section('main-content')

<x-navbar action="{{$type}}s" />
<!-- Page Heading -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Add {{$type}}</h1>

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
    @if ($type == 'Invoice')
    <form method="POST" action="/addInvoice" class="user">
        @else
        <form method="POST" action="/addQuote" class="user">
            @endif
            <div class="col-xl-12 col-md-4 mb-4" style="max-height: 500px ;" id="card">
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
                                    @foreach ($clients as $client)
                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            @if ($type == 'Invoice')
                            <div class="form-group">
                                <input type="checkbox" id="check" onchange="Enable()">
                                <label class="form-control-label" for="timbreFiscal"> Timbre Fiscal</label>
                                <input type="number" step="0.01" class="form-control form-control-user" name="timbreFiscal" placeholder="{{ __('0.60') }}" value="0.60" id="number" disabled>
                            </div>
                            @endif

                        </div>


                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-md-6 mb-4">
                <div class="card border-left-primairy shadow h-100 py-2" style="height: 390px ;">
                    <div class="card-body">

                        <div class="col-lg-12" id="list">

                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Discount</th>


                                    </tr>
                                </thead>
                                <tbody id="table">

                                    <tr id="tr">
                                        <td>
                                            <select onchange="changePrice()" name="listing[]" id="listing" class="form-control " style="border-radius: 50px;" required>
                                             
                                                @foreach ($listings as $listing)
                                                <option value="{{$listing->id}}">{{$listing->name}} </option>
            
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="tht" value=0>
                                            <input type="hidden" name="ttc" value=0>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" step="1" class="form-control form-control-user" name="quantity[]" value="1" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" step="1" id="price" class="form-control form-control-user" name="price[]" placeholder="{{$listings[0]->price}}" value="{{$listings[0]->price}}" required>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <input type="number" step="1" class="form-control form-control-user" name="discount[]" placeholder="{{ __('0.0') }}" value="0" required>
                                            </div>
                                        </td>
                                    </tr>


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


            <div class="col-xl-12 col-md-6 mb-4">



                <div class="col-lg-12">

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            <i class="bi bi-plus-circle"></i> Add {{$type}}
                        </button>
                    </div>
                </div>


            </div>



        </form>
</div>
<script src="./js/invoiceScript.js"></script>
<script>
function changePrice(){
   var listings =  {!! json_encode($listings) !!};
document.getElementById("price").value= listings[document.getElementById("listing").options[document.getElementById("listing").selectedIndex].value -1]["price"];
}
</script>


@endsection