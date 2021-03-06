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
  <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
  <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</head>

<body>
  <div class="flex-center position-ref full-height">

  <x-navb/>

  </div>


  <div class="content">
    <!-- Page Heading -->
    <div class="container-fluid">
      <h1 class="h3 mb-4 text-gray-800">{{ __('Produits') }}</h1>

      @if ((count($listings) !=0))


      <div class="row">
        @foreach ($listings as $listing)
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primairy shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="card-profile-image mt-4">
                    <a href="/Product/{{$listing->id}}">
                      <img style="height: 180px; border-radius: 50%;" src="img/image.jpg" alt="">
                    </a>
                  </div>
                  <a href="/Product/{{$listing->id}}">
                    <div class="h6 mb-0 font-weight-bold text-gray-800 pb-2 pt-3">{{$listing->name}}</div>
                  </a>
                  <div class="h6 mb-0 font-weight-bold text-gray-800 pb-2 pt-3">{{$listing->price}}</div>
                  <x-productTag :tagsCsv="$listing->tags" />
                  <br>
                  @if(Auth::user()->role == 'Client')
                  <a href="/add-to-cart/{{$listing->id}}"><button class="btn btn-primary m-2">Ajouter au panier </button></a>
                  @endif
                </div>
              </div>

            </div>
          </div>
        </div>

        @endforeach


      </div>
      <div class="col-xl-3 col-md-6 mb-5">
        {{$listings->links()}}
      </div>


      @else

      <div class="row">

        <!-- Content Column -->
        Pas de produits!

      </div>
      @endif
    </div>
  </div>

</body>

</html>