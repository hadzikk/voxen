@props(['dataset' => [], 'mode' => 'default'])

<div class="popup-invite-group-container" id="pig-container">
    <div class="popup-invite-group">

        <div class="pig-feature-container">
            <div class="pig-close-navigation">
                <i class="fa-solid fa-xmark pig-close" id="pig-close"></i>
            </div>
            <p class="popup-invite-group-title">Invite</p>

            <div class="pig-search-container">
                <input type="text" placeholder="Search friend name to invite..." class="pig-search">
                <i class="fa-solid fa-magnifying-glass pig-search-icon"></i>
            </div>
        </div>

        <ul class="pig-friend-list-container">
    @foreach (Auth::user()->allFriends() as $friend)
        <li class="pig-friend-list" 
            data-id="{{ $friend->id }}" 
            data-name="{{ $friend->username }}" 
            data-picture="{{ $friend->picture ? asset('storage/images/'.$friend->picture) : asset('images/Deafult PFP _ @davy3k.jpg') }}"
            data-selected="false">
            <div class="pig-friend-info">
                <figure class="pig-friend-picture-container">
                    <img src="{{ $friend->picture ? asset('storage/images/'.$friend->picture) : asset('images/Deafult PFP _ @davy3k.jpg') }}" alt="" class="pig-friend-picture">
                </figure>
                <p class="pig-friend-username">{{ $friend->username }}</p>
            </div>
            <button type="button" class="pig-invite-btn">
                <i class="fa-solid fa-user-plus"></i>
            </button>
        </li>
    @endforeach
</ul>


    </div>
</div>