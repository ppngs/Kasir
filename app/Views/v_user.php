<?php if (session()->get('role') === 'admin'): ?> <!-- Hanya admin yang bisa melihat aksi -->
    <div class="card-tools col-12">
        <button type="button" class="btn btn-block btn-success" style="margin: 10px; width: auto;"><i class="fas fa-plus" data-toggle="modal" data-target="#tambah-data"> Tambah Data</i></button>
    </div>
<?php endif; ?>


<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subjudul ?></h3>

            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th width=50px>No</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <?php if (session()->get('role') === 'admin'): ?> <!-- Hanya admin yang bisa melihat aksi -->
                            <th width=100px>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($user as $item): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $item['nama_user']; ?></td>
                            <td><?= $item['email']; ?></td>
                            <td><?= $item['password']; ?></td>
                            <td class="text-center">
                                <?php
                                // Menentukan kelas berdasarkan role
                                $roleClass = '';
                                switch ($item['role']) {
                                    case 'admin':
                                        $roleClass = 'badge badge-warning'; // Kuning
                                        break;
                                    case 'kasir':
                                        $roleClass = 'badge badge-primary'; // Biru
                                        break;
                                    case 'owner':
                                        $roleClass = 'badge badge-success'; // Hijau
                                        break;
                                }
                                ?>
                                <span class="<?= $roleClass; ?>"><?= $item['role']; ?></span>
                            </td>
                            <?php if (session()->get('role') === 'admin'): ?> <!-- Hanya admin yang bisa melihat aksi -->
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#edit-data-<?= $item['id_user']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete-data-<?= $item['id_user']; ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            <?php endif; ?>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- Modal form untuk menambahkan data -->
<div class="modal fade" id="tambah-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data <?= $subjudul ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('/user/save'); ?>" method="post"> <!-- Form ini mengirim data ke controller -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_user">Nama user</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Masukkan nama user" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-Mail</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="" disabled selected>Pilih Role</option>
                            <option value="kasir">Kasir</option>
                            <option value="owner">Owner</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
        </div>
        </form>
    </div>
</div>

<?php foreach ($user as $item): ?>
    <div class="modal fade" id="edit-data-<?= $item['id_user']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data <?= $subjudul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('/user/update/' . $item['id_user']); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_user">Nama User</label>
                            <input type="text" class="form-control" id="nama_user" name="nama_user" value="<?= $item['nama_user']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $item['email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru jika ingin mengubah">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control bg-light" id="role" name="role" required>
                                <option value="admin" <?= $item['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                <option value="kasir" <?= $item['role'] == 'kasir' ? 'selected' : ''; ?>>Kasir</option>
                                <option value="owner" <?= $item['role'] == 'owner' ? 'selected' : ''; ?>>Owner</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?php foreach ($user as $item): ?>
    <div class="modal fade" id="delete-data-<?= $item['id_user']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Hapus</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data ini: <strong><?= $item['nama_user']; ?></strong>?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <form action="<?= base_url('/user/delete/' . $item['id_user']); ?>" method="post">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>