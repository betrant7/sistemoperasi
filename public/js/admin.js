document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById("sidebar");
    const content = document.getElementById("content-wrapper");
    const sidebarCollapseBtn = document.getElementById("sidebarCollapse");

    sidebarCollapseBtn.addEventListener("click", function() {
        sidebar.classList.toggle("collapsed");
        content.classList.toggle("collapsed");
    });

    $(document).ready(function () {
        // Inisialisasi DataTable
        $('#example').DataTable();

        // Event ketika materi dipilih
        $('.materi-select').on('change', function () {
            const idUser = $(this).data('user');
            const idMateri = $(this).val();
            const $progressBar = $('.progres-bar-' + idUser);
            const $waktuMulai = $('.waktu-mulai-' + idUser);
            const $waktuSelesai = $('.waktu-selesai-' + idUser);

            fetch("/laporan/getprogres", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    idUser: idUser,
                    idMateri: idMateri
                })
            })
            .then(response => response.json())
            .then(data => {
                const progres = data.progres || 0;
                $progressBar.css('width', progres + '%');
                $progressBar.attr('aria-valuenow', progres);
                $progressBar.text(progres + '%');

                $waktuMulai.text(data.waktuMulai || '-');
                $waktuSelesai.text(data.waktuSelesai || '-');
            })
            .catch(error => {
                console.error('Gagal mengambil progres:', error);
            });
        });
    });

    // Konfirmasi logout
    window.confirmLogout = function () {
        if (confirm('Apakah Anda yakin ingin logout?')) {
            window.location.href = '/logout';
        }
    };
    
    window.confirmDelete = function (idUser) {
        if (confirm('Menghapus User Mahasiswa Akan Menghilangkan Seluruh datanya, Apakah Anda Yakin?')) {
            window.location.href = '/datamahasiswa/delete/' + idUser;
        }
    };
    
});
