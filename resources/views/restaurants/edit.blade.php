<x-app-layout>
    <h1>Formulario para editar un nuevo restaurante</h1>    
    <a href="/api/restaurants">Volver al listado de restaurantes</a>
    <form action="/api/restaurants/{{$restaurant->id}}" method="POST">
        @method('PUT')
        <label>
            Name:
            <input type="text" name="name" value="{{$restaurant->name}}">
        </label>
        <br><br>
        <label>
            Address:
            <input type="text" name="address" value="{{$restaurant->address}}">
        </label>
        <br><br>
        <label>
            Phone:
            <input type="text" name="phone" value="{{$restaurant->phone}}">
        </label>
        <br><br>
        <button type="submit">Actualizar restaurante</button>
    </form>
</x-app-layout>