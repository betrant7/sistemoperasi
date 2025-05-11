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
    const toastEl = document.getElementById('liveToast');
    const toastMessage = document.getElementById('toastMessage');
    const toastAction = document.getElementById('toastAction');
    const toastBackdrop = document.getElementById('toastBackdrop');
    const toast = new bootstrap.Toast(toastEl, { autohide: false });

    function showBlockingToast(message, actionText, actionHref) {
        toastMessage.textContent = message;
        toastAction.textContent = actionText;
        toastAction.href = actionHref;
        toastBackdrop.classList.remove('d-none'); // Tampilkan overlay
        document.body.style.overflow = 'hidden'; // Nonaktifkan scroll
        toast.show();
    }

    toastTrigger.forEach(el => {
        el.addEventListener('click', function (e) {
            const type = el.getAttribute('data-toast');
            if (type === 'login-dulu') {
                e.preventDefault();
                showBlockingToast(
                    'Silakan login terlebih dahulu untuk mengakses fitur ini.',
                    'Login',
                    baseUrl + 'login'
                );
            } else if (type === 'lengkapi-data') {
                e.preventDefault();
                const url = new URL(el.getAttribute('href'), window.location.origin);
                showBlockingToast(
                    'Lengkapi data diri Anda sebelum melanjutkan.',
                    'Lengkapi Data',
                    url.href
                );
            }
        });
    });

    toastEl.addEventListener('hidden.bs.toast', function () {
        toastBackdrop.classList.add('d-none');
        document.body.style.overflow = 'auto';
    });
});
