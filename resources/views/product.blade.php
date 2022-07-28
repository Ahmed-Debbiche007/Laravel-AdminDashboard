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

      <div class="card shadow mb-4">
        <div class="card-profile-image mt-4">
            <img style="height: 180px; border-radius: 50%;" src="https://st2.depositphotos.com/2619903/6028/v/600/depositphotos_60287149-stock-illustration-no-image-signs-for-web.jpg" alt="">
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h5 class="font-weight-bold">{{ $listings->name}}</h5>
                        <h5>{{ $listings->price}} TND</h5>
                        <x-productTag :tagsCsv="$listings->tags" />
                    </div>
                </div>
            </div>

        </div>
    </div>

    

    <div class="card shadow mb-4">
      
        <div class="card-body">

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h5>{{ $listings->description}}</h5>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @if(Auth::user()->role == 'Client')
    <div class="card shadow mb-4">
      
      <div class="card-body">


          <div class="row">
              <div class="col-lg-12">
                  <div class="text-center">
                     <a href="/add-to-cart/{{$listings->id}}"><button class="btn btn-primary m-2">Ajouter au panier</button></a>
                  </div>
              </div>
          </div>

      </div>
  </div>
  @endif
      </div>
  </div>

</body>

</html>