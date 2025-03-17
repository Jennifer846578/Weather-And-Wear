document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const saveButton = document.getElementById('saveButton');
    const errorMessagesContainer = document.getElementById('errorMessages');

    function validateEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email regex
        return emailPattern.test(email);
    }

    function validatePhone(phone) {
        const phonePattern = /^\+?\d{10,15}$/; // Phone number: optional "+" followed by 10-15 digits
        return phonePattern.test(phone);
    }

    function displayErrors(errors) {
        // Clear previous errors
        errorMessagesContainer.innerHTML = '';

        if (errors.length > 0) {
            // Add each error as a div or span (no list items)
            errors.forEach(error => {
                const errorMessage = document.createElement('div');
                errorMessage.textContent = error;
                errorMessage.style.color = 'red';
                errorMessage.style.fontSize = '14px';
                errorMessagesContainer.appendChild(errorMessage);
            });
        }
    }

    saveButton.addEventListener('click', function (event) {
        const errors = [];

        if (!validateEmail(emailInput.value)) {
            errors.push('Please enter a valid email address.');
        }

        if (!validatePhone(phoneInput.value)) {
            errors.push('Please enter a valid phone number.');
        }

        if (errors.length > 0) {
            event.preventDefault(); // Prevent form submission
            displayErrors(errors); // Show errors above the Save button
        } else {
            errorMessagesContainer.innerHTML = ''; // Clear errors if form is valid
        }
    });
});

document.getElementById('profilePicInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Set the new image source
            document.getElementById('profilePic').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const genderSelect = document.getElementById("gender");
    const selectedGender = genderSelect.options[0].text.trim(); // Ambil nilai terpilih (yang pertama)

    // Loop melalui semua opsi dan sembunyikan yang sesuai
    for (let i = 1; i < genderSelect.options.length; i++) {
        if (genderSelect.options[i].text.trim() === selectedGender) {
            genderSelect.options[i].style.display = "none";
        }
    }
});
