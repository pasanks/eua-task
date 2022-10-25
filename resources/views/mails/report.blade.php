
    <!doctype html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container mt-5">


                        <div class="w-full  ">
                            @if(isset($currentWeather))
                                <div class="w-full px-6 py-8 overflow-hidden text-center ">
                                    <p class="text-5xl">{{$currentWeather['name']}}</p>
                                    <p class="text-4xl">
                                        <img class="inline" src=" http://openweathermap.org/img/wn/{{$currentWeather['weather'][0]['icon']}}@2x.png">
                                        {{$currentWeather['main']['temp']}}°C &nbsp;{{$currentWeather['weather'][0]['main']}}
                                    </p>

                                    <p class="text-xl">
                                        <b>Feels</b> {{$currentWeather['main']['feels_like']}}°C
                                        <b>Low</b> {{$currentWeather['main']['temp_min']}}°C
                                        <b>High</b> {{$currentWeather['main']['temp_max']}}°C
                                    </p>
                                    <p>{{$currentWeather['weather'][0]['description']}}</p>

                                </div>

                                <div class="w-full px-6 py-8 overflow-hidden flex text-center ">
                                    <div class="w-1/4 items-center">
                                        <div><p class="text-gray-500">Humidity</p></div>
                                        <div><p class="font-bold">{{$currentWeather['main']['humidity']}}%</p></div>
                                    </div>
                                    <div class="w-1/4 items-center">
                                        <div><p class="text-gray-500">Pressure</p></div>
                                        <div><p class="font-bold">{{$currentWeather['main']['pressure']}}hPa</p></div>
                                    </div>
                                    <div class="w-1/4 items-center">
                                        <div><p class="text-gray-500">Wind</p></div>
                                        <div><p class="font-bold">{{$currentWeather['wind']['speed']}}m/s</p></div>
                                    </div>
                                    <div class="w-1/4 items-center">
                                        <div><p class="text-gray-500">Visibility</p></div>
                                        <div><p class="font-bold">{{$currentWeather['visibility']/1000}}km</p></div>
                                    </div>
                                </div>
                            @endif


                            @if(isset($futureWeather))
                                <div><p class="text-2xl font-semibold text-center">Forecast</p></div>
                                @foreach($futureWeather as $key =>$value)

                                <!-- end future-weather -->

                                    <div class="w-full text-sm bg-gray-300 px-6 py-8 overflow-hidden ">
                                        <div class="w-auto text-lg text-gray-200 text-center" ><p class="font-extrabold text-xl">{{$key}}</p></div>
                                        <div class="w-auto items-center flex">



                                            @foreach($value as $val2)

                                                <div class="w-1/4 text-center">
                                                    <div><p class="font-semibold text-xl">{{date('H:i', strtotime($val2['dt_txt']))}}</p></div>
                                                    <div> <img class="mx-auto" src=" http://openweathermap.org/img/wn/{{$val2['weather'][0]['icon']}}@2x.png"></div>
                                                    <div><p class="text-xs sm:text-base">{{$val2['weather'][0]['description']}}</p></div>
                                                    <div><p class="text-xs sm:text-base"><b>Min</b>{{$val2['main']['temp_min']}}°C <b>Max</b>{{$val2['main']['temp_max']}}°C</p></div>

                                                </div>

                                            @endforeach

                                        </div>
                                    </div>
                                @endforeach
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
