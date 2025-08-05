document.addEventListener('DOMContentLoaded', () => {
    const notif = document.querySelector('.notification-container');
    if (notif) {
        const isSuccess = notif.classList.contains('success');

        setTimeout(() => {
            notif.style.opacity = '0';
            notif.style.transform = 'translateY(-20px)';
            notif.style.transition = 'all 0.5s ease';

            setTimeout(() => {
                notif.remove();

                if (isSuccess) {
                    // Redirect hanya jika login berhasil
                    window.location.href = '/chat';
                }
            }, 500); // tunggu animasi hilang selesai
        }, 3000); // tampil selama 3 detik
    }
});
