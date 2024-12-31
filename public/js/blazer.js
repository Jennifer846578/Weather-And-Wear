document.addEventListener('DOMContentLoaded', function () {
    const btnNo = document.getElementById('no');
    const btnYes = document.getElementById('yes');

    btnNo.addEventListener('click', function () {
        btnNo.style.opacity = '0'; // Sembunyikan "no"
        btnNo.style.visibility = 'hidden'; // Tidak bisa diklik
        btnYes.style.opacity = '1'; // Tampilkan "yes"
        btnYes.style.visibility = 'visible'; // Bisa diklik
    });

    btnYes.addEventListener('click', function () {
        btnYes.style.opacity = '0'; // Sembunyikan "yes"
        btnYes.style.visibility = 'hidden'; // Tidak bisa diklik
        btnNo.style.opacity = '1'; // Tampilkan "no"
        btnNo.style.visibility = 'visible'; // Bisa diklik
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const allFavButtons = document.querySelectorAll('.btn-fav-clothes');

    allFavButtons.forEach(btnFav => {
        const noFav = btnFav.querySelector('.no-fav-clothes');
        const yesFav = btnFav.querySelector('.yes-fav-clothes');

        noFav.addEventListener('click', function () {
            noFav.style.opacity = '0';
            noFav.style.visibility = 'hidden';
            yesFav.style.opacity = '1';
            yesFav.style.visibility = 'visible';
        });

        yesFav.addEventListener('click', function () {
            yesFav.style.opacity = '0';
            yesFav.style.visibility = 'hidden';
            noFav.style.opacity = '1';
            noFav.style.visibility = 'visible';
        });
    });
});

// Fungsi untuk tombol back
function goBack() {
    window.location.href = "/wardrobe"; // Sesuaikan dengan rute ke halaman wardrobe Anda
}

// Fungsi untuk scroll ke atas
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
