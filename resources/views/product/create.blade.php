<x-app.layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <form action="/app/product" method="post">
        @csrf
        <ul>
            <li><h3>adding new product</h3></li>
            <li><label for="name">name</label></li>
            <li><input type="text" name="name" id="" placeholder="Create a name for this new product"></li>
            <li><label for="price">price</label></li>
            <li><input type="number" name="price" placeholder="Determine a price for this new product"></li>
            <li><textarea name="description" id="" cols="30" rows="10" placeholder="Create a description for this new product"></textarea></li>
            <li><button type="submit">submit</button></li>
        </ul>
    </form>
</x-app.layout>