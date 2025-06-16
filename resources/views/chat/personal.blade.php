<x-app.layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:styles>
        <link rel="stylesheet" href="{{ asset('css/chat/index.scss') }}">
    </x-slot:styles>

    <div class="chat-container">
        <div class="sidebar-left">
            <div class="sidebar-left-header">
                <h1 class="greeting-user">Welcome <span class="user-fullname">Hadzik Mochamad Sofyan</span></h1>
                <div class="profile-user">
                    <figure class="user-picture-container">
                        <img src="{{ asset('images/IMG-20220709-WA0126.jpeg') }}" alt="" class="user-picture">
                    </figure>
                    <div class="user-info">    
                        <p class="username">hadzik</p> 
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
                <h1 class="conversation-title">You're currently in a personal chat with</h1>
                <p class="conversation-with">{{ $receiver['username'] }}</p>
                
                <div class="conversation-cover">
                    <figure class="conversation-picture-container">
                        <img src="{{asset('images/Deafult PFP _ @davy3k.jpg')}}" alt="" class="conversation-picture">
                    </figure>
                </div>
            </div>

            {{-- <p class="conversation-date">-Friday, 6 June 2025-</p> --}}
            <p class="conversation-date"></p>

            <div class="conversation-chat-container">

                <div class="chat-conversation-bubble">
                    <figure class="bubble-picture-container">
                        <img src="{{ asset('images/Deafult PFP _ @davy3k.jpg') }}" alt="" class="bubble-picture">
                    </figure>
                    
                    <div class="bubble-information-container">
                        <div class="bubble-information">
                            <p class="bubble-username">{{ $receiver['username'] }}</p>
                            <p class="bubble-time">17:01</p>
                        </div>

                        <div class="bubble-chat" id="bubble-chat">
                            
                        </div>
                    </div>
                </div>
            
            </div>

            <div class="conversation-input-container">
                <div class="input-container">
                    <div class="input-leftbar">    
                        <i class="fa-solid fa-microphone"></i>
                        <input type="text" name="" id="" class="input-message" placeholder="Type something here...">
                    </div>
                    <i class="fa-solid fa-paperclip"></i>
                </div>
            </div>
        </div>

        <div class="sidebar-right">
        </div>
    </div>

    @vite('resources/js/app.js')
</x-app.layout>