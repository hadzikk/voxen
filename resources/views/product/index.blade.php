<x-app.layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @foreach ($products as $product)
        <ul>
            <li>{{ $product['name'] }}</li>
            <li>{{ $product['price'] }}</li>
            <li>{{ $product['description'] }}</li>
        </ul>
    @endforeach
</x-app.layout>