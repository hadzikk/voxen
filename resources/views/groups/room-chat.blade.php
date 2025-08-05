<x-app.layout>
    <div class="chat-container">
        <x-chat.popup-create-group />
        <x-chat.sidebar-left :dataset="[]" mode="group" />
        <x-chat.main />
        <x-chat.sidebar-right />
    </div>
</x-app.layout>
