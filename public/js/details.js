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
