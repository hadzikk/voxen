<div class="popup-create-group-container">
    <div class="popup-create-group">
        <div class="pcg-navigation">
            <p class="pcg-title">Create a group</p>
            <i class="fa-solid fa-xmark" id="close-popup-create-group"></i>
        </div>
        <div class="pcg-profile-picture-wrapper">
            <label for="groupImage" class="pcg-profile-picture-container">
                <img src="{{ asset('images/gallery.png') }}" alt="" class="pcg-profile-picture">
                <input type="file" id="groupImage" name="groupImage" accept="image/*" hidden>
                <i class="fas fa-pen pcg-edit-icon"></i>
            </label>
        </div>

        <div class="pcg-friends-container">
            <label for="" class="pcg-friend-label">Friends</label>
            <div class="pcg-invited-friends-container">
                <div class="pcg-friend-bubble" id="pcg-friend-bubble">
                    <figure class="pcg-friend-profile-picture-container">
                        <img src="{{ asset('images/Deafult PFP _ @davy3k.jpg') }}" alt="" class="pcg-friend-profile-picture">
                    </figure>
                    <div class="pcg-friend-profile">
                        <p class="pcg-friend-username">salshanandia</p>
                    </div>
                    <i class="fa-solid fa-xmark" id="pcg-remove-friend"></i>
                </div>

                <div class="pcg-friend-bubble" id="pcg-friend-bubble">
                    <figure class="pcg-friend-profile-picture-container">
                        <img src="{{ asset('images/car with horn.jpg') }}" alt="" class="pcg-friend-profile-picture">
                    </figure>
                    <div class="pcg-friend-profile">
                        <p class="pcg-friend-username">andinaainurizkyrahayu</p>
                    </div>
                    <i class="fa-solid fa-xmark" id="pcg-remove-friend"></i>
                </div>

                <div class="pcg-friend-bubble" id="pcg-friend-bubble">
                    <figure class="pcg-friend-profile-picture-container">
                        <img src="{{ asset('images/elsa.jpg') }}" alt="" class="pcg-friend-profile-picture">
                    </figure>
                    <div class="pcg-friend-profile">
                        <p class="pcg-friend-username">keyshacuwarman</p>
                    </div>
                    <i class="fa-solid fa-xmark" id="pcg-remove-friend"></i>
                </div>

                <div class="pcg-friend-bubble" id="pcg-friend-bubble">
                    <figure class="pcg-friend-profile-picture-container">
                        <img src="{{ asset('images/Lucy.jpg') }}" alt="" class="pcg-friend-profile-picture">
                    </figure>
                    <div class="pcg-friend-profile">
                        <p class="pcg-friend-username">annisaputriseptiani</p>
                    </div>
                    <i class="fa-solid fa-xmark" id="pcg-remove-friend"></i>
                </div>

                <div class="pcg-friend-bubble" id="pcg-friend-bubble">
                    <figure class="pcg-friend-profile-picture-container">
                        <img src="{{ asset('images/gorillaz.jpg') }}" alt="" class="pcg-friend-profile-picture">
                    </figure>
                    <div class="pcg-friend-profile">
                        <p class="pcg-friend-username">hadzikmochammadsofyan</p>
                    </div>
                    <i class="fa-solid fa-xmark" id="pcg-remove-friend"></i>
                </div>

                <div class="pcg-friend-bubble" id="pcg-friend-bubble">
                    <figure class="pcg-friend-profile-picture-container">
                        <img src="{{ asset('images/devin.jpg') }}" alt="" class="pcg-friend-profile-picture">
                    </figure>
                    <div class="pcg-friend-profile">
                        <p class="pcg-friend-username">devinnaziasyadzili</p>
                    </div>
                    <i class="fa-solid fa-xmark" id="pcg-remove-friend"></i>
                </div>

                <div class="pcg-btn-addfriend-container" id="pcg-invite-friend">
                    <span class="pcg-btn-addfriend" id="pcg-btn-addfriend"><i class="fa-solid fa-user-plus"></i></span>
                </div>
            </div>
        </div>

        <div class="pcg-input-container">
            <label for="" class="pcg-label">Group name</label>
            <input type="text" placeholder="What should the group name be?" class="pcg-input">
        </div>
        <div class="pcg-input-container">
            <label for="" class="pcg-label">Description</label>
            <textarea name="" id="" placeholder="How would you describe this group?" class="pcg-textarea"></textarea>
        </div>
    </div>
</div>
