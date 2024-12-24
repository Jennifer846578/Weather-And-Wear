const form = document.querySelector('form');
const emailOrPhoneInput = document.querySelector('.dvnemail');
const passwordInput = document.querySelector('.dvnpassword');
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
function isValidPhone(phone) {
    const phoneRegex = /^\d+$/; // Hanya angka
    return phoneRegex.test(phone);
}form.addEventListener('submit', function(event) {
    const emailOrPhone = emailOrPhoneInput.value.trim();
    const password = passwordInput.value;

    let isValid = true;

    if (!isValidEmail(emailOrPhone) && !isValidPhone(emailOrPhone)) {
        alert('Please enter a valid email or phone number');
        isValid = false;
    }
    if (password.length <= 8) {
        alert('Password must be at least 8 characters');
        isValid = false;
    }
    if (!isValid) {
        event.preventDefault();
    }
});
