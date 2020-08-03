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

  <!-- Scripts -->
  <script src="{{ url(mix('js/app.js')) }}" defer></script>
</head>
<body class="bg-gray-100">
  <div id="app">
    <app-component />
  </div>
</body>
</html>
