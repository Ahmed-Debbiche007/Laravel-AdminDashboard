<div class="top-right links">
    <a href="{{ url('/') }}">Acceuil</a>
    <a href="{{ url('/Products') }}">Produits</a>
    @auth
    @if (Auth::user()->role != 'Client')
    <a href="{{ url('/Dashboard') }}">Tableau de Bord</a>
    @else <a href="{{ url('/Cart') }}">Panier <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span></a>
    @endif
    <a href="#" data-toggle="modal" data-target="#logoutModal">

        {{ __('Déconnexion') }}
    </a>

    @else
    @if (Route::has('login'))
    <a href="{{ route('login') }}">Connexion</a>
    @endif
    @if (Route::has('register'))
    <a href="{{ route('register') }}">S'inscrire</a>
    @endif
    @endauth
</div>