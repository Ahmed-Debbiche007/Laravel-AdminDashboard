@extends('layouts.admin')

@section('main-content')
<x-navbar action="Clients" />
<!-- Page Heading -->
<div class="container-fluid">
<h1 class="h3 mb-4 text-gray-800">Profile</h1>

@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger border-left-danger " role="alert">
    <ul class="pl-4 my-2">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">

    <div class="col-lg-4 order-lg-2">

        <div class="card shadow mb-4">
            <div class="card-profile-image mt-4">
                
                <figure class="rounded-circle avatar avatar font-weight-bold" style="font-size: 60px; height: 180px; width: 180px;" data-initial="{{ $clients->name[0] }}"></figure>
                
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <h5 class="font-weight-bold">{{ $clients->name}}</h5>
                            <p>Client </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="col-lg-8 order-lg-1">

        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-gear"></i> Parametres du compte</h6>
            </div>

            <div class="card-body">

                <form method="POST" action="/client/{{$clients->id}}" autocomplete="off" id="form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input type="hidden" name="_method" value="PUT">


                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="name">Nom<span class="small text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control" name="name" placeholder="Name" value="{{ $clients->name}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="last_name">Matricule Fiscale<span class="small text-danger">*</span></label>
                                    <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Last name" value="{{ $clients->matFisc }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="address">Addresse<span class="small text-danger">*</span></label>
                                    <input type="address" id="address" class="form-control" name="address"  value="{{ $clients->address }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="tel">Num??ro de t??l??phone<span class="small text-danger">*</span></label>
                                    <input type="tel" id="tel" class="form-control" name="tel" placeholder="example@example.com" value="{{ $clients->tel }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="email">Addresse Mail<span class="small text-danger">*</span></label>
                                    <input type="email" id="email" class="form-control" name="email" placeholder="example@example.com" value="{{ $clients->email }}">
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- Button -->

                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-save2"></i> Sauvegarder les changements</button>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
        </div>
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-shield-check"></i> Param??tre de Confidentialit??</h6>
            </div>

            <div class="card-body">

                <form method="POST" action="/client/password/{{$clients->id}}" autocomplete="off" id="form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input type="hidden" name="_method" value="PUT">


                    <div class="pl-lg-12">
                        
                            <div class="col-lg-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="password">Mot de passe actuel<span class="small text-danger">*</span></label>
                                    <input data-toggle="password" type="password" id="password" class="form-control" name="password" placeholder="Current password">

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="new_password">Nouveau mot de passe<span class="small text-danger">*</span></label>
                                    <input data-toggle="password" type="password" id="new_password" class="form-control" name="new_password" placeholder="New password">
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="confirm_password">Confirmer le nouveau mot de passe<span class="small text-danger">*</span></label>
                                    <input data-toggle="password" type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                                </div>
                            </div>
                        
                    </div>

                    <!-- Button -->

                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-save2"></i> Sauvegarder les changements</button>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>



</div>
@if (Auth::user()->role == 'Admin')
<form id="form" method="POST" action="/client/{{$clients->id}}">
    @csrf
    @method('DELETE')
    <td>
        <button class="btn btn-danger m-2" type="submit"><i class="bi bi-trash"></i>Supprimer le client</button>
    <td>
</form>
@endif

</div>
@endsection