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
