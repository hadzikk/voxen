<x-app.layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:styles>
        <link rel="stylesheet" href="{{ asset('css/chat/index.scss') }}">
    </x-slot:styles>

    <div class="chat-container">
        <x-chat.popup-create-group />
        <x-chat.sidebar-left :dataset="$conversations" mode="conversation" />
        <x-chat.main />
        <x-chat.sidebar-right />
    </div>

    <script src="{{ asset('js/popupCreateGroup.js') }}"></script>
</x-app.layout>
