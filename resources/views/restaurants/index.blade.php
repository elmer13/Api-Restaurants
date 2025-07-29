<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">List of Restaurants</h1>
            <a href="{{route('restaurants.create')}}" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md transition-colors duration-200 flex items-center">
                <i class="fas fa-plus mr-1"></i>
                Add Restaurant
            </a>            
        </div>

        <ul class="bg-white rounded-lg shadow-md overflow-hidden divide-y divide-gray-200">
            @foreach ($restaurants as $restaurant)
            <li class="hover:bg-gray-50 transition-colors duration-150">
                <a href="{{route('restaurants.show', $restaurant)}}" class="p-4 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $restaurant->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $restaurant->address }}</p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                </a>
            </li>
            @endforeach
        </ul>

        @if($restaurants->isEmpty())
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mt-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-yellow-400 text-lg"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        No restaurants yet. <a href="{{route('restaurants.create')}}" class="font-medium underline text-yellow-700 hover:text-yellow-600">Add your first one!</a>.
                    </p>
                </div>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>