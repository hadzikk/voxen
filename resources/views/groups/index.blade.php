<x-app.layout>
    <div class="chat-container">
        <x-popup.invite-to-group-chat :friends="$friends"/>
        <x-popup.create-group-chat />
        <x-chat.sidebar-left :dataset="$groups" mode="group" />
        <x-chat.main />
        <x-chat.sidebar-right />
    </div>
</x-app.layout>
