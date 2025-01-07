// Ambil elemen preview
const PreviewContainer = document.getElementById('PreviewContainer');
const PreviewImage = document.getElementById('PreviewImage');

// Ambil gambar yang disimpan dari localStorage
const uploadedImage = localStorage.getItem('UploadedImage');

// Jika ada gambar, tampilkan di halaman
if (uploadedImage) {
    PreviewImage.src = uploadedImage; // Set src gambar
    PreviewContainer.style.display = 'block'; // Tampilkan pratinjau
} else {
    alert('Tidak ada gambar yang diunggah.');
}

// buat redirect ke page top atau bottom
function redirectToPage() {
    const selectedOption = document.querySelector('input[name="top"]:checked'); // Mendapatkan opsi yang dipilih

    if (!selectedOption) {
        // Jika tidak ada opsi yang dipilih, tampilkan peringatan
        alert('Please select "Top" or "Bottom" before continuing.');
    } else if (selectedOption.value === 'top') {
        // Jika opsi "Top" dipilih, pindah ke halaman detailsTop
        window.location.href = 'detailsTop';
    } else if (selectedOption.value === 'bottom') {
        // Jika opsi "Bottom" dipilih, pindah ke halaman detailsBottom
        window.location.href = 'detailsBottom';
    }
}

// biar bisa multiple select
document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".category-btn");
    const continueButton = document.getElementById("continue-btn");

    // Fungsi untuk mengupdate status tombol Continue
    function updateContinueButtonState() {
      const activeButtons = document.querySelectorAll(".category-btn.active");
      continueButton.disabled = activeButtons.length === 0; // Disable jika tidak ada yang dipilih
    }

    // Tambahkan event listener untuk setiap tombol kategori
    buttons.forEach((button) => {
      button.addEventListener("click", () => {
        button.classList.toggle("active"); // Toggle kelas aktif
        updateContinueButtonState();      // Update status tombol Continue
      });
    });

    // Fungsi untuk redirect ke detailsStyle ketika tombol Continue ditekan
    window.redirectToPageStyle = function () {
    //   alert("Redirecting to the next page!");
      window.location.href = 'detailsStyle';
    };

// Fungsi untuk redirect ke Wardrobe ketika tombol Continue ditekan
    window.redirectToPageWardrobe = function () {
        localStorage.setItem('showNotification', 'true'); // Set status pemberitahuan
        window.location.href = 'wardrobe'; // Redirect ke halaman wardrobe
    };


    // window.redirectToPageWardrobe = function () {
    //     window.location.href = 'wardrobe'; // Redirect ke halaman wardrobe
    //     // Tampilkan modal pemberitahuan
    //     const modal = document.getElementById('notification-modal');
    //     modal.style.display = 'flex';

    // };

});

