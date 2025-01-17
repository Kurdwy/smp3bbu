<?php

function sweetalert_flashdata()
{
    $session = session();

    if ($session->getFlashdata('success')) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '" . $session->getFlashdata('success') . "',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>";
    }

    if ($session->getFlashdata('error')) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '" . $session->getFlashdata('error') . "',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}

function sweetalert_confirm_delete($deleteUrl)
{
    echo "<script>
        function confirmDelete(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data ini akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '" . $deleteUrl . "';
                }
            });
        }
    </script>";
}
