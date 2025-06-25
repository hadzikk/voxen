<x-app.layout :title="$title">
    <x-slot:styles>
        <link rel="stylesheet" href="{{ asset('css/chat/addfriend.scss') }}">
        <link rel="stylesheet" href="{{ asset('css/chat/main.scss') }}">
    </x-slot:styles>

    <nav class="navbar">
        <a href="{{ url()->previous() }}"><i class="fa-solid fa-arrow-left"></i></a>
    </nav>

    <div class="add-friend-container">
        <div class="add-friend-content">
            <form action="" method="get">
                <div class="input-container">
                    <i class="fa-solid fa-user-plus"></i>
                    <input type="text" placeholder="Please input an username to find a friend...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </form>

            <div class="add-friend-profile-container">
                <div class="add-friend-profile">
                    <figure class="add-friend-picture-container">
                        <img src="{{ asset('images/Deafult PFP _ @davy3k.jpg') }}" alt="" class="add-friend-picture">
                    </figure>
                    <p class="add-friend-username">hadzikk</p>
                    <a href="" class="add-friend-btn">Add friend</a>
                </div>
            </div>
        </div>
    </div>
</x-app.layout>