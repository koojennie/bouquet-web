// buat javascript login.html class wrapper
document.addEventListener('DOMContentLoaded', function() {
    const wrapper = document.querySelector('.wrapper');
    const loginLink = document.querySelector('.login-link');
    const registerLink = document.querySelector('.register-link');

    registerLink.addEventListener('click', function() {
        wrapper.classList.add('active');
    });

    loginLink.addEventListener('click', function() {
        wrapper.classList.remove('active');
    });
});
