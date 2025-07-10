<x-app.layout :title="$title">
    <x-slot:styles>
        <link rel="stylesheet" href="{{ asset('css/chat/addfriend.scss') }}">
        <link rel="stylesheet" href="{{ asset('css/chat/main.scss') }}">
    </x-slot:styles>

    <nav class="navbar">
        <a href="/chat/friendrequest"><i class="fa-solid fa-arrow-left"></i></a>
    </nav>

    <div class="add-friend-container">
        <div class="add-friend-content">
            <form action="/chat/friends/s" method="get">
                <div class="input-container">
                    <i class="fa-solid fa-user-plus"></i>
                    <input 
                        type="text" 
                        name="username" 
                        placeholder="Type a username to find a friend..." 
                        value="{{ request('username') }}">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </form>

            @if (request('username'))
                <div class="add-friend-profile-container">
                    @if ($friend)
                        <div class="add-friend-profile">
                            <figure class="add-friend-picture-container">
                                <img 
                                    src="{{ $friend->picture ? asset($friend->picture) : asset('images/Deafult PFP _ @davy3k.jpg') }}" 
                                    alt="Profile Picture" 
                                    class="add-friend-picture">
                            </figure>
                            <p class="add-friend-username">{{ $friend->username }}</p>
                            @if ($isReceivedRequest)
                                @if ($isFriend)
                                    <button type="button" class="add-friend-btn --disabled" disabled>Already friends.</button>
                                @else
                                <form action="/chat/friendrequest/{{ $friend->id }}/accept/onsearch" method="POST">
                                    @csrf
                                     <input type="hidden" name="username" value="{{ $friend->username }}">
                                     <button type="submit" class="add-friend-btn">Accept request</button>
                                </form>
                                @endif
                            @else
                            <form action="/chat/addfriend" method="post">
                                @csrf
                                <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                                
                                @if ($isFriend)
                                    <button type="button" class="add-friend-btn --disabled" disabled>Already friends.</button>
                                @elseif ($isSentRequest)
                                    <button type="button" class="add-friend-btn --disabled" disabled>Request has sent.</button>
                                @else
                                    <button type="submit" class="add-friend-btn">Add friend</button>
                                @endif
                            </form>
                            @endif
                        </div>
                    @else
                        <p style="text-align: center; margin-top: 20px; font-size: small;">
                            <strong>{{ request('username') }}</strong> not found. Please make sure the username is correct.
                        </p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app.layout>
