document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".container-nav");

    window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });

    const toastTrigger = document.querySelectorAll('[data-toast]');
    const actionModal = new bootstrap.Modal(document.getElementById('actionModal'));
    const modalMessage = document.getElementById('modalMessage');
    const modalAction = document.getElementById('modalAction');

    function showActionModal(message, actionText, actionHref) {
        modalMessage.textContent = message;
        modalAction.textContent = actionText;
        modalAction.href = actionHref;
        actionModal.show();
    }

    toastTrigger.forEach(el => {
        el.addEventListener('click', function (e) {
            const type = el.getAttribute('data-toast');
            if (type === 'login-dulu') {
                e.preventDefault();
                showActionModal(
                    'Silakan login terlebih dahulu untuk mengakses fitur ini.',
                    'Login',
                    baseUrl + 'login'
                );
            } else if (type === 'lengkapi-data') {
                e.preventDefault();
                const url = new URL(el.getAttribute('href'), window.location.origin);
                showActionModal(
                    'Lengkapi data diri Anda sebelum melanjutkan.',
                    'Lengkapi Data',
                    url.href
                );
            }
        });
    });
});
