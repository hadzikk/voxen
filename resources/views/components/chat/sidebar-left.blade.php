@props(['contacts'])

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
        <i class="fa-solid icon-left-navbar fa-comment"></i>
        <i class="fa-solid icon-left-navbar fa-address-book"></i>
        <i class="fa-solid icon-left-navbar fa-user-plus"></i>
    </div>

    <ul>
        @foreach ($contacts as $contact)
        <li>
            <a href="/chat/p/{{ $contact['username'] }}">
                <figure class="contact-picture-container">
                    <img src="{{ $contact['picture'] ? asset('storage/images/' . $contact['picture']) : asset('images/Deafult PFP _ @davy3k.jpg') }}" alt="" class="contact-picture">
                </figure>
                <div class="contact-info-container">
                    <div class="contact-info">
                        <p class="contact-name">{{ $contact['username'] }}</p>
                        <p class="time">00:12</p>
                    </div>
                    <div class="contact-additional-info">
                        <p class="contact-last-chat">{{ Str::limit('p', 26, '...') }}</p>
                    </div>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</div>
