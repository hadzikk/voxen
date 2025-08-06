<div class="popup-create-group-container">
    <div class="popup-create-group">
        <form action="{{ route('groups.store') }}" method="POST" enctype="multipart/form-data" class="popup-create-group-form">
            @csrf
            <div class="pcg-navigation">
                <p class="pcg-title"></p>
                <i class="fa-solid fa-xmark" id="close-popup-create-group"></i>
            </div>

            <!-- Profile Picture -->
            <div class="pcg-profile-picture-wrapper">
                <label for="groupImage" class="pcg-profile-picture-container">
                    <img src="{{ asset('images/gallery.png') }}" alt="Group Image Preview" class="pcg-profile-picture">
                    <input type="file" id="groupImage" name="groupImage" accept="image/*" style="display: none;">
                    <i class="fas fa-pen pcg-edit-icon"></i>
                </label>
            </div>

            <!-- Friends Invite -->
            <div class="pcg-friends-container">
                <label class="pcg-friend-label">Friends</label>
                <div class="pcg-invited-friends-container">
                    <div class="pcg-btn-addfriend-container" id="pcg-invite-friend">
                        <span class="pcg-btn-addfriend"><i class="fa-solid fa-user-plus"></i></span>
                    </div>
                </div>
            </div>

            <!-- Group Name -->
            <div class="pcg-input-container">
                <label class="pcg-label">Group name</label>
                <input type="text" name="name" placeholder="What should the group name be?" class="pcg-input" required>
            </div>

            <!-- Description -->
            <div class="pcg-input-container">
                <label class="pcg-label">Description</label>
                <textarea name="description" placeholder="How would you describe this group?" class="pcg-textarea"></textarea>
            </div>

            <!-- Submit -->
            <div class="pcg-input-container">
                <button class="popup-create-group-btn" type="submit">Done</button>
            </div>
        </form>
    </div>
</div>
