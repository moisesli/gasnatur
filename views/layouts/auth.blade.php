<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  {{--Vue js--}}
  <script src="https://unpkg.com/vue@next"></script>

  <!-- Tailwind Css -->
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>

  {{--Add Js Login--}}
  {{--<script src="/views/auth/login.js"></script>--}}

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  
</head>
<body>
  @yield('content')
</body>
</html>
