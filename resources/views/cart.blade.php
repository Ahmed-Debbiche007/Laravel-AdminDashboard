<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>E-commerce</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">

  <!-- Styles -->
  <style>
    html,
    body {
      background-color: #fff;
      color: #636b6f;
      font-family: 'Nunito', sans-serif;
      font-weight: 200;
      height: 100vh;
      margin: 0;
    }

    .full-height {
      height: 15%;
    }

    .flex-center {
      align-items: center;
      display: flex;
      justify-content: center;
    }

    .position-ref {
      position: relative;
    }

    .top-right {
      position: absolute;
      right: 10px;
      top: 18px;
    }

    .content {
      text-align: center;
    }

    .title {
      font-size: 84px;
    }

    .links>a {
      color: #636b6f;
      padding: 0 25px;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: .1rem;
      text-decoration: none;
      text-transform: uppercase;
    }

    .m-b-md {
      margin-bottom: 30px;
    }
  </style>
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body>
  <div class="flex-center position-ref full-height">

    <div class="top-right links">
      <a href="{{ url('/') }}">Home</a>
      <a href="{{ url('/Products') }}">Products</a>
      @auth
      @if (Auth::user()->role != 'Client')
      <a href="{{ url('/Dashboard') }}">Dashboard</a>
      @else
      <a href="{{ url('/Cart') }}">Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span></a>
      @endif
      <a class="btn " href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      @else

      @if (Route::has('login'))
      <a href="{{ route('login') }}">Connexion</a>
      @endif
      @if (Route::has('register'))
      <a href="{{ route('register') }}">S'inscrire</a>
      @endif
      @endauth

    </div>

  </div>
  @if (session('status'))
    <div class="alert alert-success border-left-success" role="alert">
        {{ session('status') }}
    </div>
    @endif  

  <div class="content">
    <!-- Page Heading -->
    <form method="POST" action="/Order" class="user">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      @php
      $id = Auth::user()->id ;
      @endphp
      <input type="hidden" name="client_id" value="{{$id}}">
      <input type="hidden" name="timbreFiscal" value="0.6">
      <table id="cart" class="table table-hover table-condensed">
        <thead>
          <tr>
            <th style="width:50%">Produit</th>
            <th style="width:10%">Prix</th>
            <th style="width:8%">Quantité</th>
            <th style="width:22%" class="text-center">Total</th>
            <th style="width:10%"></th>
          </tr>
        </thead>
        <tbody>
          @php $total = 0 @endphp
          @if(session('cart'))
          @foreach(session('cart') as $id => $details)
          @php $total += $details['price'] * $details['quantity'] @endphp
          <tr data-id="{{ $id }}">
            <td data-th="Product">
              <div class="row">
                <div class="col-sm-3 hidden-xs"><img src="{{ $details['image'] }}" width="100" height="100" class="img-responsive" /></div>
                <div class="col-sm-9">
                  <h4 class="nomargin">{{ $details['name'] }}</h4>
                  <input type="hidden" name="listing[]" value="{{$id}}">
                  <input type="hidden" name="discount[]" value="0">
                  <input type="hidden" name="tht" value=0>
                  <input type="hidden" name="ttc" value=0>
                </div>
              </div>
            </td>
            <td data-th="Price">${{ $details['price'] }}</td>

            <td data-th="Quantity">
              <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" name="quantity[]" />
            </td>
            <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
            <td class="actions" data-th="">
              <button class="btn btn-danger m-2  remove-from-cart" type="button"><i class="bi bi-trash"></i></button>
            </td>
          </tr>
          @endforeach
          @endif
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5" class="text-right">
              <h3><strong>Total ${{ $total }}</strong></h3>
            </td>
          </tr>
          <tr>
            <td colspan="5" class="text-right">
              <a href="{{ url('/Products') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continuer vos achats</a>
              <button type="submit" class="btn btn-success"> Commander </button>
            </td>
          </tr>
        </tfoot>
      </table>
    </form>

  </div>
  <script type="text/javascript">
    $(".update-cart").change(function(e) {
      e.preventDefault();

      var ele = $(this);

      $.ajax({
        url: '{{ route("update.cart") }}',
        method: "patch",
        data: {
          _token: '{{ csrf_token() }}',
          id: ele.parents("tr").attr("data-id"),
          quantity: ele.parents("tr").find(".quantity").val()
        },
        success: function(response) {
          window.location.reload();
        }
      });
    });

    $(".remove-from-cart").click(function(e) {
      e.preventDefault();

      var ele = $(this);

      if (confirm("Are you sure want to remove?")) {
        $.ajax({
          url: '{{ route("remove.from.cart") }}',
          method: "DELETE",
          data: {
            _token: '{{ csrf_token() }}',
            id: ele.parents("tr").attr("data-id")
          },
          success: function(response) {
            window.location.reload();
          }
        });
      }
    });
  </script>
</body>

</html>