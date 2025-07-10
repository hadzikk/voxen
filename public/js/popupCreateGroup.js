function popupCreateGroup() {
    const popup = document.querySelector('.chat-container .popup-create-group-container');
    if (popup) {
        popup.style.display = 'flex';
    }
}

function closePopupCreateGroup() {
    const popup = document.querySelector('.chat-container .popup-create-group-container');
    if (popup) {
        popup.style.display = 'none';
    }
}


