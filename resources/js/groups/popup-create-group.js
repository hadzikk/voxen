document.addEventListener('DOMContentLoaded', () => {
    const buttonCreateGroup = document.querySelector('.chat-container .sidebar-left ul .sidebar-content .button-create-group');
    const closePopupCreateGroup = document.getElementById('close-popup-create-group');
    const popupCreateGroup = document.querySelector('.chat-container .popup-create-group-container');

    // Toggle show
    buttonCreateGroup.addEventListener('click', () => {
        if (popupCreateGroup) {
            popupCreateGroup.style.display = 'flex';
        }
    });

    // Toggle hide
    closePopupCreateGroup.addEventListener('click', () => {
        if (popupCreateGroup) {
            popupCreateGroup.style.display = 'none';
        }
    });

    // Realtime preview image
    const inputGroupImage = document.getElementById('groupImage');
    const previewImage = document.querySelector('.pcg-profile-picture');

    inputGroupImage.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            if (!file.type.startsWith('image/')) {
                alert('Please upload a valid image file.');
                return;
            }

            const reader = new FileReader();
            reader.onload = function (event) {
                previewImage.src = event.target.result;
                previewImage.classList.add('attached');
            }
            reader.readAsDataURL(file);
        }
    });

    // Remove friend bubble when close icon is clicked
    const removeFriendButtons = document.querySelectorAll('#pcg-remove-friend');

    removeFriendButtons.forEach(button => {
        button.addEventListener('click', function () {
            const bubble = button.closest('.pcg-friend-bubble');
            if (bubble) {
                bubble.style.display = 'none';
            }
        });
    });

    // Invite friend to group
    const popupCreateGroupInviteFriend = document.getElementById('pcg-invite-friend');
    popupCreateGroupInviteFriend.addEventListener('click', () => {
        const popupInviteGroupContainer = document.getElementById('pig-container');

        popupInviteGroupContainer.style.display = "flex";
    })
});
