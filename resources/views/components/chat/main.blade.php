@props(['group' => [], 'messages' => [], 'mode' => 'default'])

<div class="chat-main">
    @if ($mode === "groupRoomChat")
        <nav class="chat-main-header">
            <figure class="chat-main-picture-container">
                <img
                    src="{{ $group->groupImage ? asset('storage/'.$group->groupImage) : asset('images/Deafult PFP _ @davy3k.jpg') }}"
                    alt="" 
                    class="chat-main-picture">
            </figure>
            <p class="chat-main-group-name">{{ $group->name }}</p>
        </nav>
        <div class="chat-main-conversation">
            @forelse ($messages as $message)
            <div class="chat-main-bubble">
                <figure class="chat-main-bubble-picture-container">
                    <img 
                        src="{{ $message->groupImage ? asset('storage/'.$message->groupImage) : asset('images/Deafult PFP _ @davy3k.jpg') }}" 
                        alt="" 
                        class="chat-main-bubble-picture">
                </figure>
                <p class="chat-main-bubble-message"></p>
            </div>
            @empty
                
            @endforelse
        </div>
    @else
        <p>no conversation yet</p>
    @endif
</div>