<x-app-layout>
    <h1> Aquí se mostraran todos los restaurantes</h1>

    <a href="/api/restaurants/create">Nuevo restaurante</a>
    @foreach ($restaurants as $restaurant)
        <li>
            <a href="/api/restaurants/{{$restaurant->id}}">
                {{ $restaurant->name }}
            </a>
        </li>
    @endforeach
</x-app-layout>