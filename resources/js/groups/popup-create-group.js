document.addEventListener('DOMContentLoaded', () => {
    const buttonCreateGroup = document.querySelector('.chat-container .sidebar-left ul .sidebar-content .button-create-group');
    const closePopupCreateGroup = document.getElementById('close-popup-create-group');
    const popupCreateGroup = document.querySelector('.chat-container .popup-create-group-container');

    // Toggle show
    if (buttonCreateGroup && popupCreateGroup) {
        buttonCreateGroup.addEventListener('click', () => {
            popupCreateGroup.style.display = 'flex';
        });
    }

    // Toggle hide
    if (closePopupCreateGroup && popupCreateGroup) {
        closePopupCreateGroup.addEventListener('click', () => {
            popupCreateGroup.style.display = 'none';
        });
    }

    // Realtime preview image
    const inputGroupImage = document.getElementById('groupImage');
    const previewImage = document.querySelector('.pcg-profile-picture');

    if (inputGroupImage && previewImage) {
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
    }

    // Invite friend to group
    const popupCreateGroupInviteFriend = document.getElementById('pcg-invite-friend');
    if (popupCreateGroupInviteFriend) {
        popupCreateGroupInviteFriend.addEventListener('click', () => {
            const popupInviteGroupContainer = document.getElementById('pig-container');
            if (popupInviteGroupContainer) {
                popupInviteGroupContainer.style.display = "flex";
            }
        });
    }
});
