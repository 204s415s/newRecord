<!doctype html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>{{ config('app.name', 'Vue Laravel SPA') }}</title>
 
     <!-- Styles -->
     <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
 </head>
 
 
 <body>
 <div id="app">
    <p v-if="$route.name !== 'index'"><header-component></header-component></p>
    <router-view></router-view>
    
 </div>
 <!-- Scripts -->

 <script src="{{ mix('/js/app.js') }}" defer></script>

 </body>
 </html>
 
 <script>
  
 </script>