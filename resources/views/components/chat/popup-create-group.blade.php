<div class="popup-create-group-container">
    <div class="popup-create-group">
        <div class="popup-create-group-navigation">
            <p class="popup-create-group-title">Create a new group</p>
            <i class="fa-solid fa-xmark" onclick="closePopupCreateGroup()"></i>
        </div>
        <div class="popup-create-group-content">
            <figure class="popup-create-group-picture-container">
                <img src="{{ asset('images/Deafult PFP _ @davy3k.jpg') }}" alt="" class="popup-create-group-picture">
            </figure>
            <form action="/group/create" method="POST" enctype="multipart/form-data">
                @csrf
                <input class="popup-create-group-input" type="file" name="profile_picture" id="" required>
                <input class="popup-create-group-input" name="name" type="text" placeholder="Enter a group name...">
                <textarea class="popup-create-group-input --h-full" name="description" id="" placeholder="Enter a grup description..."></textarea>
                <button class="popup-create-group-btn" type="submit">Create</button>
            </form>
        </div>
    </div>
</div>