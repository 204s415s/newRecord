<!doctype html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
     <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.css" rel='stylesheet'>
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.2.0/main.css" rel='stylesheet'>
<link href="https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.css" rel='stylesheet'>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.3.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.2.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/vue@4.2.2/main.umd.min.js"></script>
 
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