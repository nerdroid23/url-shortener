<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Styles -->
  <link href="{{ url(mix('css/app.css')) }}" rel="stylesheet">
  <style>
    html, body {
      background-color: #fff;
      color: #636b6f;
      font-family: 'Inter', sans-serif;
      font-weight: 200;
      height: 100vh;
      margin: 0;
    }

    .full-height {
      height: 100vh;
    }

    .flex-center {
      align-items: center;
      display: flex;
      justify-content: center;
    }

    .position-ref {
      position: relative;
    }

    .content {
      text-align: center;
    }

    .title {
      font-size: 84px;
    }

    .m-b-md {
      margin-bottom: 30px;
    }
  </style>

  <!-- Scripts -->
  <script src="{{ url(mix('js/app.js')) }}" defer></script>
</head>
<body>
  <div class="flex-center position-ref full-height">
    <div class="content" id="app">
      <div class="title m-b-md">
        <example-component />
      </div>
    </div>
  </div>
</body>
</html>
