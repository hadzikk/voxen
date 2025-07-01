@props(['dataset' => [], 'mode' => 'default'])

<div class="sidebar-left">
    <div class="sidebar-left-header">
        <h1 class="greeting-user">Welcome <span class="user-fullname">{{ Auth::user()->firstname." ".Auth::user()->lastname }}</span></h1>
        <div class="profile-user">
            <figure class="user-picture-container">
                <img src="{{ Auth::user()->picture ? asset('storage/images/' . Auth::user()->picture) : asset('images/Deafult PFP _ @davy3k.jpg') }}" alt="" class="user-picture">
            </figure>
            <div class="user-info">    
                <p class="username">{{ Auth::user()->username }}</p> 
                <p class="identity">You</p>
            </div>
        </div>
    </div>

    <div class="sidebar-left-navbar">
        <a href="/chat/friends"><i class="fa-solid icon-left-navbar fa-address-book" title="Friends"></i></a>
        <a href="/chat/conversations"><i class="fa-solid fa-comments"></i><i class="fa-solid icon-left-navbar fa-comment" title="Conversation"></i></a>
    </div>

    <ul>
        @if ($mode === "friends")
        <div class="sidebar-content">
            <span class="sidebar-content-title">Friends</span>
        </div>
            @foreach ($dataset as $friend)
            <li>
                <a href="/chat/p/{{ $friend['username'] }}">
                    <figure class="contact-picture-container">
                        <img src="{{ $friend['picture'] ? asset('storage/images/' . $friend['picture']) : asset('images/Deafult PFP _ @davy3k.jpg') }}" alt="" class="contact-picture">
                    </figure>
                    <div class="contact-info-container">
                        <div class="contact-info">
                            <p class="contact-name">{{ $friend['username'] }}</p>
                            <p class="time">00:12</p>
                        </div>
                        <div class="contact-additional-info">
                            <p class="contact-last-chat">{{ Str::limit('p', 26, '...') }}</p>
                        </div>
                    </div>
                </a>
            </li>
            @endforeach

        @elseif ($mode === "conversation")
        <div class="sidebar-content">
            <span class="sidebar-content-title">Conversations</span>
        </div>

        @elseif ($mode === "default")
        @endif
    </ul>
</div>
