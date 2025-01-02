const FileInput = document.getElementById('FileInput');
FileInput.addEventListener('change', function () {
    if (FileInput.files && FileInput.files[0]) {
        const file = FileInput.files[0];

        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                localStorage.setItem('UploadedImage', e.target.result);

                window.location.href = 'details';
            };
            reader.readAsDataURL(file);
        } else {
            alert('Harap unggah file gambar.');
        }
    }
});
