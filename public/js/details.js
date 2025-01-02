// Ambil elemen preview
const dvnPreviewContainer = document.getElementById('dvnPreviewContainer');
const dvnPreviewImage = document.getElementById('dvnPreviewImage');

// Ambil gambar yang disimpan dari localStorage
const uploadedImage = localStorage.getItem('dvnUploadedImage');

// Jika ada gambar, tampilkan di halaman
if (uploadedImage) {
    dvnPreviewImage.src = uploadedImage; // Set src gambar
    dvnPreviewContainer.style.display = 'block'; // Tampilkan pratinjau
} else {
    alert('Tidak ada gambar yang diunggah.');
}
