<x-app-layout>
    <a href="/api/restaurants">Volver al listado de restaurantes</a>
    <h1>Name: {{ $restaurant->name }}</h1>
    <p>Address: {{ $restaurant->address }}</p>
    <p>Phonee: {{ $restaurant->phone }}</p>

    <a href="/api/restaurants/{{$restaurant->id}}/edit">Editar Restaurante</a>
    <form action="/api/restaurants/{{$restaurant->id}}" method="POST">
        @method('Delete')
        <button type="submit">
            Eliminar Restaurante
        </button>
    </form>
</x-app-layout>