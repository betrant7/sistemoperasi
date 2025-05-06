const password = document.querySelector('#password');
const passwordLama = document.querySelector('#passwordLama');
const passwordBaru = document.querySelector('#passwordBaru');
const passwordKonfirmasi = document.querySelector('#passwordKonfirmasi');
const togglePasswords = document.querySelectorAll('#togglePassword');

togglePasswords.forEach(toggle => {
    toggle.addEventListener('click', function() {
        const passwordField = this.previousElementSibling;
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
});