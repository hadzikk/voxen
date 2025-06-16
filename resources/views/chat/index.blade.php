<x-app.layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:styles>
        <link rel="stylesheet" href="{{ asset('css/chat/index.scss') }}">
    </x-slot:styles>

    <div class="chat-container">
        <div class="sidebar-left">
            <div class="sidebar-left-header">
                <h1 class="greeting-user">Welcome <span class="user-fullname">{{ $user->firstname." ".$user->lastname }}</span></h1>
                <div class="profile-user">
                    <figure class="user-picture-container">
                        <img src="{{ $user->picture ? asset() }}" alt="" class="user-picture">
                    </figure>
                    <div class="user-info">    
                        <p class="username">{{ $user->username }}</p> 
                        <p class="identity">You</p>
                    </div>
                </div>
            </div>

            
            <div class="sidebar-left-navbar">
                <i class="fa-solid icon-left-navbar fa-user"></i>
                <i class="fa-solid icon-left-navbar fa-users"></i>
                <i class="fa-solid icon-left-navbar fa-user-plus"></i>
                <i class="fa-solid icon-left-navbar fa-box-archive"></i>
            </div>

            <ul>
                @foreach ($contacts as $contact)
                <li>
                    <a href="/chat/p/{{ $contact['username'] }}">
                        <figure class="contact-picture-container">
                            <img src="{{ asset('images/Deafult PFP _ @davy3k.jpg') }}" alt="" class="contact-picture">
                        </figure>
                        <div class="contact-info-container">
                            <div class="contact-info">
                                <p class="contact-name">{{ $contact['username'] }}</p>
                                <p class="time">00:12</p>
                            </div>
                            <div class="contact-additional-info">
                                <p class="contact-last-chat">{{ Str::limit("p", 26, '...') }}</p>
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>

        </div>

        <div class="chat-main">
            <div class="conversation-header">
                <p style="font-size: small">&copy; voxen By Hadzik Mochamad Sofyan 2025 Allrights Reserved.</p>
                <h1 class="conversation-title">choose a chat and start the conversation</h1>
            </div>
        </div>

        <div class="sidebar-right">
        </div>
    </div>
</x-app.layout>