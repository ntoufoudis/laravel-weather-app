<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

        @vite(['resources/js/app.js', 'resources/css/app.css'])


        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-EXMWK5FD3P"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-EXMWK5FD3P');
        </script>

    </head>
    <body class="font-sans antialiased bg-[#37474F] min-h-screen flex align-middle items-center justify-center">
        <div class="w-full max-w-4xl bg-[#232931] text-white rounded-3xl">
            <div class="grid grid-cols-5">
                <div class="col-span-2 bg-gradient-to-br from-[#3F4A79] to-[#193869] rounded-3xl">
                    <div class="text-center p-6">
                        <h2 class="text-5xl font-bold mb-6">{{ now()->format('l') }}</h2>
                        <span class="text-2xl font-bold">{{ now()->format('Y-m-d') }}</span>
                        <div class="icons">
                            <img class="m-auto w-[80%]" src="{{ $data['iconUrl'] }}" alt=""/>
                            <h2 class="text-5xl font-bold mb-4">{{ $data['temp'] }}°C</h2>
                            <h3 class="text-xl capitalize font-bold">{{ $data['weatherDescription'] }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-span-3 p-6 content_section">
                    <form action="{{ route('search') }}" method="post" class="my-6 mx-auto relative">
                        @csrf
                        <input
                            class="h-14 border border-[#37474F] outline-none pl-4  rounded-l-xl w-[84%] bg-transparent"
                            type="text" placeholder="Enter a city" name="city"/>
                        <button type="submit" class="absolute px-4 h-14 bg-[#5C6BC0] rounded-br-xl rounded-tr-xl">
                            Search
                        </button>
                    </form>
                    <div>
                        <div class="flex justify-between py-2">
                            <p class="font-semibold">City</p>
                            <span class="value">{{ $data['city'] }}</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <p class="font-semibold">Country Code</p>
                            <span class="value">{{ $data['country'] }}</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <p class="font-semibold">TEMP</p>
                            <span class="value">{{ $data['temp'] }}°C</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <p class="font-semibold">HUMIDITY</p>
                            <span class="value">{{ $data['humidity'] }}%</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <p class="font-semibold">WIND SPEED</p>
                            <span class="value">{{ $data['wind'] }}Km/h</span>
                        </div>
                    </div>
                    <div class="list_content">
                        <ul class="flex justify-between items-center shadow-2xl my-8">
                            <li class="p-4 flex flex-col items-center rounded-xl hover:scale-110 hover:bg-white hover:text-[#232931] hover:cursor-pointer transition duration-300 ease-in">
                                <img class="w-2/3" src="{{ $data['icon1Url'] }}"/>
                                <span>{{ date("l", strtotime("+1 day")) }}</span>
                                <span class="day_temp">{{$data['day1Temp']}}°C</span>
                            </li>
                            <li class="p-4 flex flex-col items-center rounded-xl  hover:scale-110 hover:bg-white hover:text-[#232931] hover:cursor-pointer transition duration-300 ease-in">
                                <img class="w-2/3" src="{{ $data['icon2Url'] }}"/>
                                <span>{{ date("l", strtotime("+2 day")) }}</span>
                                <span class="day_temp">{{$data['day2Temp']}}°C</span>
                            </li>
                            <li class="p-4 flex flex-col items-center rounded-xl  hover:scale-110 hover:bg-white hover:text-[#232931] hover:cursor-pointer transition duration-300 ease-in">
                                <img class="w-2/3" src="{{ $data['icon3Url'] }}"/>
                                <span>{{ date("l", strtotime("+3 day")) }}</span>
                                <span class="day_temp">{{$data['day3Temp']}}°C</span>
                            </li>
                            <li class="p-4 flex flex-col items-center rounded-xl  hover:scale-110 hover:bg-white hover:text-[#232931] hover:cursor-pointer transition duration-300 ease-in">
                                <img class="w-2/3" src="{{ $data['icon4Url'] }}"/>
                                <span>{{ date("l", strtotime("+4 day")) }}</span>
                                <span class="day_temp">{{$data['day4Temp']}}°C</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
