// Ambil elemen input file
const FileInput = document.getElementById('FileInput');

// Tambahkan event listener untuk mendeteksi perubahan (unggah file)
FileInput.addEventListener('change', function () {
    // Periksa apakah ada file yang diunggah
    if (FileInput.files && FileInput.files[0]) {
        const file = FileInput.files[0];

        // Periksa apakah file adalah gambar
        if (file.type.startsWith('image/')) {
            // Buat URL untuk pratinjau gambar
            const reader = new FileReader();
            reader.onload = function (e) {
                // Simpan URL gambar dalam localStorage untuk digunakan di halaman berikutnya
                localStorage.setItem('UploadedImage', e.target.result);

                // Redirect ke halaman details.html
                window.location.href = 'details'; // Ganti dengan URL yang sesuai
            };
            reader.readAsDataURL(file); // Baca file sebagai URL Data
        } else {
            alert('Harap unggah file gambar.');
        }
    }
});
