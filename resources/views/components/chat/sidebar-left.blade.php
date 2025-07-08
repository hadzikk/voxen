@props(['dataset' => [], 'mode' => 'default'])

<div class="sidebar-left">
    <div class="sidebar-left-header">
        <h1 class="greeting-user">
            Welcome <span class="user-fullname">{{ Auth::user()->firstname . " " . Auth::user()->lastname }}</span>
        </h1>
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
        <a href="/chat/friendrequest"><i class="fa-solid icon-left-navbar fa-user-plus"></i></a>
        <a href="/chat/friends"><i class="fa-solid icon-left-navbar fa-address-book" title="Friends"></i></a>
        <a href="/chat/conversations"><i class="fa-solid icon-left-navbar fa-comment"></i></a>
    </div>

    <ul>
        @if ($mode === "friends")
            <div class="sidebar-content">
                <span class="sidebar-content-title">Friends</span>
            </div>
            @foreach (Auth::user()->allFriends() as $friend)
                <li>
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

        @elseif ($mode === "conversation")
            <div class="sidebar-content">
                <span class="sidebar-content-title">Conversations</span>
                <a href="" class="sidebar-content-feature">create group</a>
            </div>

        @elseif ($mode === "default")
            {{-- Kosongkan atau isi sesuai kebutuhan --}}

        @elseif ($mode === "friendrequest")
            <div class="sidebar-content">
                <span class="sidebar-content-title">Friend requests</span>
                <a href="/chat/addfriend" class="sidebar-content-feature">add friend</a>
            </div>
            @foreach ($dataset as $request)
                <li>
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
                                    {{-- Accept --}}
                                    <form action="/chat/friendrequest/{{ $request->id }}/accept" method="POST">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; cursor: pointer; outline: none;">
                                            <i class="fa-solid fa-check text-green-600"></i>
                                        </button>
                                    </form>

                                    {{-- Decline --}}
                                    <form action="/chat/friendrequest/{{ $request->id }}/decline" method="POST">
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
