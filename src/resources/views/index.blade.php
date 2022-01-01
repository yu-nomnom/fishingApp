<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 
<head>
    <meta charset="UTF-8">
    <title>SPAサンプル</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
 
<body>
    <div id="app">
        <div id="nav">
          <router-link to="/">createDiary</router-link>
        </div>
        <router-view/>
    </div>

<script src="{{ mix('js/app.js') }}"></script> 
</body>
 
</html>