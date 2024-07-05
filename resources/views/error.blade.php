<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>
    <body class="font-sans antialiased bg-[#37474F] min-h-screen flex align-middle items-center justify-center">
        <div class="w-full max-w-4xl bg-[#232931] text-white rounded-3xl">
            <div class="grid grid-cols-5">

                    <h1 class="text-red-500">{{ $code }}</h1>

            </div>
        </div>
    </body>
</html>
