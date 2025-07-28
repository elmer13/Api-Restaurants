<x-app-layout>
    <h1>Formulario para crear un nuevo restaurante</h1>    
    <a href="/api/restaurants">Volver al listado de restaurantes</a>
    <form action="/api/restaurants" method="POST">
        <label>
            Name
            <input type="text" name="name">
        </label>
        <br><br>
        <label>
            Address
            <input type="text" name="address">
        </label>
        <br><br>
        <label>
            Phone
            <input type="text" name="phone">
        </label>
        <br><br>
        <button type="submit">crear</button>
    </form>
</x-app-layout>