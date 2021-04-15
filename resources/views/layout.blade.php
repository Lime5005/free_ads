<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>FREE ADS FOR EVERYONE & EVERY PRICE</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-info">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a href="/home" class="nav-link">Accueil</a>
      </li>
      <li class="nav-item">
        <a href="/posts" class="nav-link">Home</a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">Témoignages</a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">Référence</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="/posts/create" class="nav-link">Add a post</a>
      </li>
    </ul>
  </nav>
  <div class="container">
    @yield('content')
  </div>
  <script src="{{ asser('js/app.js')}}" type="text/js"></script>
</body>
</html>