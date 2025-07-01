<x-app.layout :title="$title">
    <x-slot:styles>
        <link rel="stylesheet" href="{{ asset('css/chat/addfriend.scss') }}">
        <link rel="stylesheet" href="{{ asset('css/chat/main.scss') }}">
    </x-slot:styles>

    <nav class="navbar">
        <a href="/chat"><i class="fa-solid fa-arrow-left"></i></a>
    </nav>

    <div class="add-friend-container">
        <div class="add-friend-content">
            <form action="/chat/friends/s" method="get">
                @csrf
                <div class="input-container">
                    <i class="fa-solid fa-user-plus"></i>
                    <input type="text" name="username" placeholder="Please input an username to find a friend..." value="{{ request('username') }}">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </form>

            @if (request('username'))
            
            <div class="add-friend-profile-container">
                @if ($friend)
                <div class="add-friend-profile">
                    <figure class="add-friend-picture-container">
                        <img src="{{ $friend->picture ? asset($friend->picture) : asset('images/Deafult PFP _ @davy3k.jpg') }}" alt="" class="add-friend-picture">
                    </figure>
                    <p class="add-friend-username">{{ $friend->username }}</p>
                    <form action="/chat/addfriend" method="post">
                        @csrf
                        <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                        @if (session('success'))
                        <button type="submit" class="add-friend-btn" disabled>{{ session('success') }} <i class="fa-solid fa-user-check"></i></button>
                        @else
                        <button type="submit" class="add-friend-btn">Add friend</button>
                        @endif
                    </form>
                </div>
                @else
                <p style="text-align: center; margin-top: 20px; font-size: small;"><strong>{{ request('username') }}</strong> not found please try to make sure the username is correct.</p>
                @endif
            </div>
            @endif
        </div>
    </div>
</x-app.layout>