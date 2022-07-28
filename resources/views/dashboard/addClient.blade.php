@extends('layouts.admin')

@section('main-content')
<x-navbar action="Clients" />
<!-- Page Heading -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Add Client</h1>

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

        <div class="col-xl-12 col-md-6 mb-4">
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

                        <form method="POST" action="/addClient" class="user">
                        
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                            <label class="form-control-label" for="name">Nom</label>
                                <input type="text" class="form-control form-control-user" name="name" placeholder="{{ __('Nom') }}" value="{{ old('name') }}" required autofocus>
                            </div>

                            <div class="form-group">
                            <label class="form-control-label" for="last_name">Matricule Fiscale</label>
                                <input type="text" class="form-control form-control-user" name="last_name" placeholder="{{ __('Matricule Fiscale') }}" value="{{ old('matFisc') }}" required>
                            </div>

                            <div class="form-group">
                            <label class="form-control-label" for="address">Addresse</label>
                                <input type="text" class="form-control form-control-user" name="address" placeholder="{{ __('Addresse') }}" value="{{ old('address') }}" required>
                            </div>

                            <div class="form-group">
                            <label class="form-control-label" for="tel">Numéro de téléphone</label>
                                <input type="text" class="form-control form-control-user" name="tel" placeholder="{{ __('Numéro de téléphone') }}" value="{{ old('tel') }}" required>
                            </div>

                            <div class="form-group">
                            <label class="form-control-label" for="email">Email</label>
                                <input type="email" class="form-control form-control-user" name="email" placeholder="{{ __('E-Mail') }}" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                            <label class="form-control-label" for="password">Mot de passe</label>
                                <input type="password" class="form-control form-control-user" name="password" placeholder="{{ __('Mot de passe') }}" required>
                            </div>

                            <div class="form-group">
                            <label class="form-control-label" for="password_confirmation">Confirmer le mot de passe</label>
                                <input type="password" class="form-control form-control-user" name="password_confirmation" placeholder="{{ __('Confirmer le mot de passe') }}" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    <i class="bi bi-plus-circle"></i> Ajouter un client
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