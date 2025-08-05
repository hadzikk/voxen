<x-app.layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:styles>
        <link rel="stylesheet" href="{{ asset('css/chat/index.scss') }}">
    </x-slot:styles>

    <div class="chat-container">
        <x-chat.sidebar-left :dataset="[]" mode="default" />
        <x-chat.main mode="default" />
        <x-chat.sidebar-right />
    </div>
</x-app.layout>
