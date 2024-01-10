<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        <link rel="shortcut icon" href="{{asset('images/logo.svg')}}" type="image/x-icon">

        @vite(['resources/css/app.css','resources/js/app.js'])

    </head>
    <body>
        <livewire:components.nav />
        {{ $slot }}
    </body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/datepicker.min.js"></script>

</html>
