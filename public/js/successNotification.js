// notifikasi success add clothes to wardrobe
document.addEventListener("DOMContentLoaded", () => {
    // Periksa status pemberitahuan di localStorage
    const showNotification = localStorage.getItem('showNotification');

    if (showNotification === 'true') {
        // Tampilkan modal pemberitahuan
        const modal = document.getElementById('notification-modal');
        modal.style.display = 'flex';

        // Hapus status pemberitahuan setelah ditampilkan
        localStorage.removeItem('showNotification');
    }

    // Fungsi untuk menutup modal
    window.closeModal = function () {
        const modal = document.getElementById('notification-modal');
        modal.style.display = 'none';
    };
});

