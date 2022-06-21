@extends('layouts.admin')

@section('main-content')
<x-navbar>"Clients"</x-navbar>
<!-- Page Heading -->
<div class="container-fluid">
<h1 class="h3 mb-4 text-gray-800">{{ __('Clients') }}</h1>

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

    <!-- Content Column -->
   No Clients Yet

</div>

</div>

@endsection