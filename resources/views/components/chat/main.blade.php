@props(['group' => [], 'mode' => 'default'])

<div class="chat-main">
    @if ($mode === "group")
    <div class="chat-main-navigation">
        <div class="chat-main-group-profile">
            <figure class="chat-main-picture-container">
            <img
                src="{{ $group->profile_picture ? asset('storage/' . $group->profile_picture) : asset('images/default_group_profile.jpg') }}"
                alt="" 
                class="chat-main-picture">
            </figure>
            <div>
                <p class="chat-main-group-name">{{ Str::limit($group->name, 20, '...') }}</p>
                <p class="chat-main-group-label">Group</p>
            </div>
        </div>
    </div>
    @else
    <div class="conversation-header">
        <p style="font-size: small">&copy; voxen By Hadzik Mochamad Sofyan 2025 Allrights Reserved.</p>
        <h1 class="conversation-title">choose a chat and start the conversation</h1>
    </div>
    @endif

    <div class="chat-main-conversation">
        <div class="chat-main-bubble">
            <figure class="chat-main-bubble-picture-container">
                <img 
                    src="{{ asset('images/Deafult PFP _ @davy3k.jpg') }}" 
                    alt="" 
                    class="chat-main-bubble-picture">
            </figure>
            <div class="chat-main-bubble-content">
                <p class="chat-main-bubble-username">You <span class="chat-main-bubble-time">15:47</span></p>
                <p class="chat-main-bubble-message">{{ $group->description }}</p>
            </div>
        </div>
    </div>
</div>