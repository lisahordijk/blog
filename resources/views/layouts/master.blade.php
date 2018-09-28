
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
  </head>

  <body>

      @include ('layouts.header')

      @if ($flash = session('message'))
        <div id="flash-message" class="alert alert-success" role="alert">
          {{ $flash }}
        </div>
      @endif


      <div class="container">
        <div class="row">

          @yield ('content')

          @include ('layouts.sidebar')

        </div>
      </div>

      @include('layouts.footer')

  </body>
</html>
