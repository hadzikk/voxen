<div class="popup-create-group-container">
    <div class="popup-create-group">
        <div class="popup-create-group-navigation">
            <p class="popup-create-group-title">Create a new group</p>
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="popup-create-group-content">
            <figure class="popup-create-group-picture-container">
                <img src="{{ asset('images/default_group_profile.jpg') }}" alt="" class="popup-create-group-picture">
            </figure>
            <form action="" method="post">
                <input class="popup-create-group-input" type="file" name="" id="">
                {{-- <p style="font-size: small;">group name</p> --}}
                <input class="popup-create-group-input" type="text" placeholder="Enter a group name...">
                {{-- <p style="font-size: small;">group description</p> --}}
                <textarea class="popup-create-group-input --h-full" name="" id="" placeholder="Enter a grup description..."></textarea>
                <button class="popup-create-group-btn" type="submit">Create</button>
            </form>
        </div>
    </div>
</div>