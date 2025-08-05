@props(['dataset' => [], 'mode' => 'default'])

<div class="sidebar-left">
    <div class="sidebar-left-header">
        <div class="profile-user">
            <figure class="user-picture-container">
                <img 
                    src="{{ Auth::user()->picture ? asset('storage/images/' . Auth::user()->picture) : asset('images/Deafult PFP _ @davy3k.jpg') }}" 
                    alt="" 
                    class="user-picture"
                >
            </figure>
            <div class="user-info">    
                <p class="username">{{ Auth::user()->username }}</p> 
                <p class="identity">You</p>
            </div>
        </div>
    </div>

    <div class="sidebar-left-navbar">
        <a href="{{ route('friends.requests.list') }}"><i class="fa-solid icon-left-navbar fa-user-plus"></i></a>
        <a href="{{ route('friends.list') }}"><i class="fa-solid icon-left-navbar fa-address-book" title="Friends"></i></a>
        <a href="{{ route('groups.index') }}"><i class="fa-solid icon-left-navbar fa-comment"></i></a>
    </div>

    <ul class="sidebar-left-list-container">
        @if ($mode === "friends")
            <div class="sidebar-content">
                <span class="sidebar-content-title">Friends</span>
            </div>
            @foreach (Auth::user()->allFriends() as $friend)
                <li class="sidebar-left-list">
                    <a href="/chat/p/{{ $friend->username }}">
                        <figure class="contact-picture-container">
                            <img 
                                src="{{ $friend['picture'] ? asset('storage/images/' . $friend['picture']) : asset('images/Deafult PFP _ @davy3k.jpg') }}" 
                                alt="" 
                                class="contact-picture"
                            >
                        </figure>
                        <div class="contact-info-container">
                            <div class="contact-info">
                                <p class="contact-name">{{ $friend['username'] }}</p>
                                <p class="time"></p>
                            </div>
                            <div class="contact-additional-info">
                                <p class="contact-last-chat"></p>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach

        @elseif ($mode === "group")
        <div class="sidebar-content">
            <span class="sidebar-content-title">Groups</span>
            <p class="sidebar-content-feature button-create-group">create group</p>
        </div>

        @forelse ($dataset as $group)
            <li class="sidebar-left-list">
                <a href="{{ route('groups.index')."/".$group->slug }}">
                    <figure class="contact-picture-container">
                        <img
                            src="{{ $group->profile_picture ? asset('storage/' . $group->profile_picture) : asset('images/default_group_profile.jpg') }}"
                            alt="" 
                            class="contact-picture"
                        >
                    </figure>
                    <div class="contact-info-container">
                        <div class="contact-info">
                            <p class="contact-name">{{ Str::limit($group->name, 20, '...') }}</p>
                            <p class="time"></p>
                        </div>
                        <div class="contact-additional-info">
                            <p class="contact-last-chat">You: {{ Str::limit($group->description, 26, '...') }}</p>  
                        </div>
                    </div>
                </a>
            </li>
        @empty
            <li class="sidebar-left-list"><p class="text-gray-500 text-sm px-4">No groups yet.</p></li>
        @endforelse


        @elseif ($mode === "default")

        @elseif ($mode === "friendRequests")
            <div class="sidebar-content">
                <span class="sidebar-content-title">Friend requests</span>
                <a href="{{ route('friends.search') }}" class="sidebar-content-feature">add friend</a>
            </div>
            @foreach ($dataset as $request)
                <li class="sidebar-left-list">
                    <a>
                        <figure class="contact-picture-container">
                            <img 
                                src="{{ asset('images/Deafult PFP _ @davy3k.jpg') }}" 
                                alt="" 
                                class="contact-picture"
                            >
                        </figure>
                        <div class="contact-info-container">
                            <div class="contact-info">
                                <p class="contact-name">{{ $request->sender->username }}</p>
                                <p class="time"></p>
                            </div>
                            <div class="contact-additional-info">
                                <p class="contact-last-chat">{{ Str::limit('request to be friends.', 26, '...') }}</p>
                                <div class="contact-request flex gap-2">
                                    <form action="{{ route('friends.requests.accept', ['id' => $request->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; cursor: pointer; outline: none;">
                                            <i class="fa-solid fa-check text-green-600"></i>
                                        </button>
                                    </form>

                                    {{-- Decline --}}
                                    <form action="{{ route('friends.requests.decline', ['id' => $request->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; cursor: pointer; outline: none;">
                                            <i class="fa-solid fa-xmark text-red-600"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</div>
