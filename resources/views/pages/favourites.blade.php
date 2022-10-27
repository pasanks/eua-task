<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Favourites') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container mt-5">
                        <div class="overflow-x-auto relative">
                            <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Location Name
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Latitude
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Longitude
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Notifications
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($favourites as $favourite)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$favourite->name}}
                                        </th>
                                        <td class="py-4 px-6">
                                            {{$favourite->latitude}}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{$favourite->longitude}}
                                        </td>
                                        <td class="py-4 px-6">
                                        @if($favourite->send_notification == true)
                                             <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Enabled</span>
                                        @else
                                             <span class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">Disabled</span>
                                        @endif
                                        </td>

                                        <td class="py-4 px-6">
                                        @if($favourite->send_notification == true)
                                                <a href="{{ route('favourites.enableNotifications',$favourite->id) }}"
                                                   class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
                                                    Disable Notifications
                                                </a>
                                        @else
                                                <a href="{{ route('favourites.enableNotifications',$favourite->id) }}"
                                                   class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                                                    Enable Notifications
                                                </a>
                                        @endif

                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
