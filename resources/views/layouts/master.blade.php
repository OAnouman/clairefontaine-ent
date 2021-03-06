<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" xmlns:v-on="http://www.w3.org/1999/xhtml">

    <head>


        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Styles -->

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        @yield('styles')


    </head>

    <body>


        <div id="app">


            <!-- Navigation bar -->

            @include('layouts.nav')



            <!-- Content section -->

            @yield('content')


        </div>


        <!-- Footer -->

        @include('layouts.footer')



    </body>


</html>
