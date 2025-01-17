<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>
<?php helper('sweetalert_helper'); ?>


<div class="container mt-5">
    <h2>Daftar Guru</h2>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#guruModal">Tambah Guru</button>

    <table class="table table-striped" id="usersTable">
        <thead class="table-dark">
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Email</th>
                <th>NIP/NUPTK</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td>
                        <?php
                        $photo = !empty($user['photo']) ? base_url('uploads/photos/' . $user['photo']) : base_url('uploads/photos/default.png');
                        ?>
                        <img src="<?= $photo; ?>" width="50" height="65" class="rounded border">
                    </td>
                    <td><?= esc($user['name']); ?></td>
                    <td><?= esc($user['email']); ?></td>
                    <td><?= esc($user['nip_nuptk'] ?? '-'); ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editGuruModal"
                            onclick="setEditModal(<?= $user['id']; ?>, '<?= esc($user['name']); ?>', '<?= esc($user['email']); ?>', '<?= esc($user['nip_nuptk'] ?? ''); ?>')">
                            Edit
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(event, '/users/delete/<?= $user['id']; ?>')">
                            Hapus
                        </button>
                        <?= sweetalert_confirm_delete('/users/delete/' . $user['id']); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah Guru -->
<div class="modal fade" id="guruModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/users/store" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control mb-2" placeholder="Nama" required>
                    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                    <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
                    <input type="text" name="nip_nuptk" class="form-control mb-2" placeholder="NIP/NUPTK (Opsional)">

                    <label class="form-label">Foto (3x4, Max 5MB, JPG/PNG)</label>
                    <input type="file" name="photo" class="form-control" accept=".jpg, .jpeg, .png" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Guru -->
<div class="modal fade" id="editGuruModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editGuruId" name="id">
                    <input type="text" id="editGuruName" name="name" class="form-control mb-2" required>
                    <input type="email" id="editGuruEmail" name="email" class="form-control mb-2" readonly>
                    <input type="text" id="editGuruNIP" name="nip_nuptk" class="form-control mb-2" placeholder="NIP/NUPTK (Opsional)">
                    <input type="password" name="password" class="form-control mb-2" placeholder="Kosongkan jika tidak ingin diubah">
                    <label class="form-label">Foto (3x4, Max 5MB, JPG/PNG)</label>
                    <input type="file" name="photo" class="form-control" accept=".jpg, .jpeg, .png">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- SweetAlert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function setEditModal(id, name, email, nip) {
        document.getElementById('editGuruId').value = id;
        document.getElementById('editGuruName').value = name;
        document.getElementById('editGuruEmail').value = email;
        document.getElementById('editGuruNIP').value = nip;

        // Pastikan form action diperbarui dengan ID
        document.getElementById('editForm').action = "/users/update/" + id;
    }

    $(document).ready(function() {
        $('#usersTable').DataTable();
    });
</script>

<!-- Panggil SweetAlert dari Helper -->
<?= sweetalert_flashdata(); ?>

<?= $this->endSection() ?>