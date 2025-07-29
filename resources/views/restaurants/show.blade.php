<x-app-layout>
    <div class="max-w-2xl mx-auto p-6">
        <a href="/api/restaurants" class="inline-block mb-6 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-gray-700 transition-colors duration-200">
            Back to list
        </a>

        <div class="bg-white rounded-lg shadow-md overflow-hidden p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $restaurant->name }}</h1>

            <div class="space-y-3">
                <p class="text-gray-600">
                    <span class="font-semibold">Address:</span> {{ $restaurant->address }}
                </p>
                <p class="text-gray-600">
                    <span class="font-semibold">Phonee:</span> {{ $restaurant->phone }}
                </p>
            </div>
        </div>

        <div class="flex space-x-4">
            <a href="/api/restaurants/{{$restaurant->id}}/edit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition-colors duration-200">
                Edit Restaurant
            </a>

            <form action="/api/restaurants/{{$restaurant->id}}" method="POST">
                @method('Delete')
                <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md transition-colors duration-200" onclick="return confirm('Are you sure you want to delete this restaurant?')">
                    Delete Restaurant
                </button>
            </form>
        </div>            
    </div>
</x-app-layout>