@props(['dataset' => [], 'mode' => 'default'])

<div class="sidebar-left">
    <div class="sidebar-left-header">
        <div class="profile-user">
            <figure class="user-picture-container">
                <img 
                    src="{{ Auth::user()->picture ? asset('storage/images/' . Auth::user()->picture) : asset('images/Deafult PFP _ @davy3k.jpg') }}" 
                    alt="Profile picture"
                    class="user-picture"
                >
            </figure>
            <div class="user-info">    
                <p class="username">{{ Auth::user()->username }}</p> 
                <p class="identity">You</p>
            </div>
        </div>
    </div>

    @if ($mode === "groupRoomChat")
    <div class="sidebar-left-navbar">
        <a href="{{ route('friends.requests.list') }}"><i class="fa-solid icon-left-navbar fa-user-plus"></i></a>
        <a href="{{ route('friends.list') }}"><i class="fa-solid icon-left-navbar fa-address-book" title="Friends"></i></a>
        <a href=""><i class="fa-solid icon-left-navbar fa-comment"></i></a>
        <i class="fa-solid fa-door-open" id="logout"></i>
    </div>
    @else
    <div class="sidebar-left-navbar">
        <a href="{{ route('friends.requests.list') }}"><i class="fa-solid icon-left-navbar fa-user-plus"></i></a>
        <a href="{{ route('friends.list') }}"><i class="fa-solid icon-left-navbar fa-address-book" title="Friends"></i></a>
        <a href="{{ route('groups.index') }}"><i class="fa-solid icon-left-navbar fa-comment"></i></a>
        <i class="fa-solid fa-door-open" id="logout"></i>
    </div>
    @endif

    <ul class="sidebar-left-list-container">
        @if ($mode === "friends")
            <div class="sidebar-content">
                <span class="sidebar-content-title">Friends</span>
            </div>
            @forelse (Auth::user()->allFriends() as $friend)
                <li class="sidebar-left-list">
                    <a href="/chat/p/{{ $friend->username }}">
                        <figure class="contact-picture-container">
                            <img 
                                src="{{ $friend['picture'] ? asset('storage/images/' . $friend['picture']) : asset('images/Deafult PFP _ @davy3k.jpg') }}" 
                                alt="Friend picture" 
                                class="contact-picture"
                            >
                        </figure>
                        <div class="contact-info-container">
                            <div class="contact-info">
                                <p class="contact-name">{{ $friend['username'] }}</p>
                            </div>
                        </div>
                    </a>
                </li>
            @empty
                <div class="sidebar-empty-state">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.18 8.189a4.01 4.01 0 0 0 2.616 2.627m3.507 -.545a4 4 0 1 0 -5.59 -5.552" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4c.412 0 .81 .062 1.183 .178m2.633 2.618c.12 .38 .184 .785 .184 1.204v2" /><path d="M3 3l18 18" /></svg>
                    <p class="sidebar-empty-state-message">You don't have any friends yet. Try adding some friends.</p>
                </div>
            @endforelse

        @elseif ($mode === "group" || $mode === "groupRoomChat")
        <div class="sidebar-content">
            <span class="sidebar-content-title">Groups</span>
            <p class="sidebar-content-feature button-create-group">create group</p>
        </div>

        @forelse ($dataset as $group)
        <li class="sidebar-left-list">
        <a href="{{ route('groups.index')."/".$group->slug }}">
            <figure class="contact-picture-container">
                <img
                    src="{{ $group->groupImage ? asset('storage/'.$group->groupImage) : asset('images/Deafult PFP _ @davy3k.jpg') }}"
                    alt="Group Image" 
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
    <div class="sidebar-empty-state">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-messages-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 3l18 18" /><path d="M11 11a1 1 0 0 1 -1 -1m0 -3.968v-2.032a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10l-3 -3h-3" /><path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2" /></svg>
        <p class="sidebar-empty-state-message">You haven't joined a group yet. Start by creating or joining a new group.</p>
    </div>
@endforelse


        @elseif ($mode === "default")

        @elseif ($mode === "friendRequests")
            <div class="sidebar-content">
                <span class="sidebar-content-title">Friend requests</span>
                <a href="{{ route('friends.search') }}" class="sidebar-content-feature">add friend</a>
            </div>
            @forelse ($dataset as $request)
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
            @empty
                <div class="sidebar-empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-question"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" /><path d="M19 22v.01" /><path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" /></svg>
                    <p class="sidebar-empty-state-message">There's no friend request.</p>
                </div>
            @endforelse
        @endif
    </ul>
</div>
