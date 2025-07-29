<x-app-layout>
    <div class="max-w-2xl mx-auto p-6">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Edit Restaurant</h1>    
            <a href="{{route('restaurants.index')}}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-gray-700 transition-colors duration-200">
                Back to list
            </a>
        </div>

        <form action="{{route('restaurants.update', $restaurant)}}" method="POST" class="bg-white rounded-lg shadow-md overflow-hidden p-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name:</label>
                    <input type="text" name="name" value="{{ old('name', $restaurant->name) }}" 
                           class="w-full px-3 py-2 border rounded-md shadow-sm @error('name') border-red-500 focus:ring-red-500 @else border-gray-300 focus:ring-blue-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Address:</label>
                    <input type="text" name="address" value="{{ old('address', $restaurant->address) }}" 
                           class="w-full px-3 py-2 border rounded-md shadow-sm @error('address') border-red-500 focus:ring-red-500 @else border-gray-300 focus:ring-blue-500 @enderror">
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone:</label>
                    <input type="text" name="phone" value="{{ old('phone', $restaurant->phone) }}"
                           class="w-full px-3 py-2 border rounded-md shadow-sm @error('phone') border-red-500 focus:ring-red-500 @else border-gray-300 focus:ring-blue-500 @enderror">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>    
                <div class="pt-4">
                    <button type="submit" class="w-full py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition-colors duration-200">
                        Update Restaurant
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>

