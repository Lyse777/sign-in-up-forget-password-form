function validateForm() {
    var fullname = document.getElementById('fullname').value.trim();
    var email = document.getElementById('email').value.trim();
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;

    // Checking if all fields are filled
    if (!fullname || !email || !password || !confirmPassword) {
        alert('Please you must fill in all fields.');
        return false;
    }

    // Checking for password length
    if (password.length < 5) {
        alert('Password must be at least 5 characters long.');
        return false;
    }

    // Checking if passwords match
    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return false;
    }

    return true;
}
