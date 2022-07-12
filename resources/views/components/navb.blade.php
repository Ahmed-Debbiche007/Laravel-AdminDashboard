<div class="top-right links">
    <a href="{{ url('/') }}">Home</a>
    <a href="{{ url('/Products') }}">Products</a>
    @auth
    @if (Auth::user()->role != 'Client')
    <a href="{{ url('/Dashboard') }}">Dashboard</a>
    @else <a href="{{ url('/Cart') }}">Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span></a>
    @endif
    <a href="#" data-toggle="modal" data-target="#logoutModal">

        {{ __('Logout') }}
    </a>

    @else
    @if (Route::has('login'))
    <a href="{{ route('login') }}">Login</a>
    @endif
    @if (Route::has('register'))
    <a href="{{ route('register') }}">Register</a>
    @endif
    @endauth
</div>