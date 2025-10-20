<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>
        @vite([ 'resources/js/app.js'])
       @inertiaHead
        <!-- Fonts -->
        

        <!-- Styles -->
       
    </head>
    <body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
        @inertia
    </body>
</html>
