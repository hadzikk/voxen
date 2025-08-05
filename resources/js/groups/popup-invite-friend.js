document.addEventListener('DOMContentLoaded', () => {
    const popupInviteFriendClose = document.getElementById('pig-close');

    popupInviteFriendClose.addEventListener('click',  () => {
            const popupInviteGroupContainer = document.getElementById('pig-container');

            popupInviteGroupContainer.style.display = "none";
        });
});