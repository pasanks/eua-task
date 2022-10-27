<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-blue-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-blue-100 border-b border-gray-200">
                    <div class="container mt-5">
                        <div class="w-full  ">
                            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('query.weather.details') }}">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        Location
                                    </label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                           name="autocomplete" id="autocomplete" type="text" placeholder="Choose Location">
                                </div>
                                <div class="mb-6 hidden" >
                                    <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                                           id="latitude" name="latitude"  type="text" placeholder="">
                                </div>
                                <div class="mb-6 hidden" >
                                    <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                                           name="longitude" id="longitude"  type="text" placeholder="">
                                </div>
                                <div class="flex items-center justify-center">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                        Get Weather Information
                                    </button>
                                </div>
                            </form>
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
                                    <form  method="POST" action="{{ route('favourites.store') }}">
                                        @csrf
                                        <input name="name" type="text" value="{{$currentWeather['name']}}" hidden>
                                        <input name="latitude"  type="text" value="{{$currentWeather['coord']['lat']}}" hidden>
                                        <input name="longitude"  type="text" value="{{$currentWeather['coord']['lon']}}" hidden>
                                        <div class="flex items-center justify-center">
                                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                                Save location
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="w-full px-6 py-8 overflow-hidden flex text-center ">
                                    <div class="w-1/4 items-center">
                                        <div>
                                            <p class="text-gray-500">Humidity</p>
                                        </div>
                                        <div>
                                            <p class="font-bold">{{$currentWeather['main']['humidity']}}%</p>
                                        </div>
                                    </div>
                                    <div class="w-1/4 items-center">
                                        <div>
                                            <p class="text-gray-500">Pressure</p>
                                        </div>
                                        <div>
                                            <p class="font-bold">{{$currentWeather['main']['pressure']}}hPa</p>
                                        </div>
                                    </div>
                                    <div class="w-1/4 items-center">
                                        <div>
                                            <p class="text-gray-500">Wind</p>
                                        </div>
                                        <div>
                                            <p class="font-bold">{{$currentWeather['wind']['speed']}}m/s</p>
                                        </div>
                                    </div>
                                    <div class="w-1/4 items-center">
                                        <div>
                                            <p class="text-gray-500">Visibility</p>
                                        </div>
                                        <div>
                                            <p class="font-bold">{{$currentWeather['visibility']/1000}}km</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(isset($futureWeather))
                                <div>
                                    <p class="text-2xl font-semibold text-center">Forecast</p>
                                </div>
                                @foreach($futureWeather as $key =>$value)

                                    <div class="w-full text-sm bg-blue-100 px-6 py-8 overflow-hidden ">
                                        <div class="w-auto text-lg text-gray-600 text-center" >
                                            <p class="font-extrabold text-xl">{{$key}}</p>
                                        </div>
                                        <div class="w-auto items-center flex">
                                            @foreach($value as $val2)
                                                <div class="w-1/4 text-center">
                                                    <div>
                                                        <p class="font-semibold text-xl">{{date('H:i', strtotime($val2['dt_txt']))}}</p>
                                                    </div>
                                                    <div> <img class="mx-auto" src=" http://openweathermap.org/img/wn/{{$val2['weather'][0]['icon']}}@2x.png"></div>
                                                    <div>
                                                        <p class="text-xs sm:text-base">{{$val2['weather'][0]['description']}}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-xs sm:text-base"><b>Min</b>{{$val2['main']['temp_min']}}°C <b>Max</b>{{$val2['main']['temp_max']}}°C</p>
                                                    </div>
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
    <script type="text/javascript"
            src="https://maps.google.com/maps/api/js?key={{config('services.googleMaps.maps_api_key')}}&libraries=places" ></script>
    <script>
        $(document).ready(function () {
            $("#latitudeArea").addClass("d-none");
            $("#longtitudeArea").addClass("d-none");
        });
    </script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());

                $("#latitudeArea").removeClass("d-none");
                $("#longtitudeArea").removeClass("d-none");
            });
        }
    </script>
</x-app-layout>
