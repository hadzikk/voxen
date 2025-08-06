document.addEventListener('DOMContentLoaded', () => {
    const popupInviteFriendClose = document.getElementById('pig-close');
    const friendListItems = document.querySelectorAll('.pig-friend-list');
    const invitedFriendsContainer = document.querySelector('.pcg-invited-friends-container');
    const addFriendButtonContainer = document.getElementById('pcg-invite-friend');

    popupInviteFriendClose.addEventListener('click', () => {
        const popupInviteGroupContainer = document.getElementById('pig-container');
        popupInviteGroupContainer.style.display = "none";
    });

    friendListItems.forEach(item => {
        const inviteBtn = item.querySelector('.pig-invite-btn');
        inviteBtn.addEventListener('click', () => {
            const isSelected = item.getAttribute('data-selected') === 'true';
            const friendId = item.getAttribute('data-id');
            const friendName = item.getAttribute('data-name');
            const friendPicture = item.getAttribute('data-picture');

            if (!isSelected) {
                const bubble = document.createElement('div');
                bubble.classList.add('pcg-friend-bubble');
                bubble.setAttribute('data-id', friendId);
                bubble.innerHTML = `
                    <figure class="pcg-friend-profile-picture-container">
                        <img src="${friendPicture}" alt="" class="pcg-friend-profile-picture">
                    </figure>
                    <div class="pcg-friend-profile">
                        <p class="pcg-friend-username">${friendName}</p>
                    </div>
                    <i class="fa-solid fa-xmark pcg-remove-friend"></i>
                    <input type="hidden" name="invited_users[]" value="${friendId}">
                `;
                invitedFriendsContainer.insertBefore(bubble, addFriendButtonContainer);

                const icon = inviteBtn.querySelector('i');
                icon.classList.remove('fa-user-plus');
                icon.classList.add('fa-check');
                item.setAttribute('data-selected', 'true');

                bubble.querySelector('.pcg-remove-friend').addEventListener('click', () => {
                    invitedFriendsContainer.removeChild(bubble);
                    icon.classList.remove('fa-check');
                    icon.classList.add('fa-user-plus');
                    item.setAttribute('data-selected', 'false');
                });
            } else {
                const bubble = invitedFriendsContainer.querySelector(`.pcg-friend-bubble[data-id="${friendId}"]`);
                if (bubble) invitedFriendsContainer.removeChild(bubble);
                const icon = inviteBtn.querySelector('i');
                icon.classList.remove('fa-check');
                icon.classList.add('fa-user-plus');
                item.setAttribute('data-selected', 'false');
            }
        });
    });
});
