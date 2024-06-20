<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ 'StepByStep' }}</title>
    @livewireStyles
    @vite('resources/css/app.css')
</head>
<body class="w-full h-full bg-tertiary">
@livewire('navbar')


{{ $slot }}
    @livewireScripts
</body>
</html>
