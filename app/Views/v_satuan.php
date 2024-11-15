<div class="card-tools col-12">
    <?php if (session()->get('role') === 'admin'): ?> <!-- Hanya admin yang bisa melihat aksi -->
        <button type="button" class="btn btn-block btn-success" style="margin: 10px; width: auto;">
            <i class="fas fa-plus" data-toggle="modal" data-target="#tambah-data"> Tambah Data</i>
        </button>
    <?php endif; ?>
</div>

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subjudul ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th width=50px>No</th>
                        <th>Satuan</th>
                        <?php if (session()->get('role') === 'admin'): ?> <!-- Hanya admin yang bisa melihat aksi -->
                            <th width=100px>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($satuan as $item): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $item['nama_satuan']; ?></td>
                            <?php if (session()->get('role') === 'admin'): ?> <!-- Hanya admin yang bisa melihat aksi -->
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#edit-data-<?= $item['id_satuan']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete-data-<?= $item['id_satuan']; ?>">
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
            <form action="<?= base_url('/satuan/save'); ?>" method="post" autocomplete="off">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_satuan">Nama Satuan</label>
                        <input type="text" class="form-control" id="nama_satuan" name="nama_satuan" placeholder="Masukkan nama satuan" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($satuan as $item): ?>
    <div class="modal fade" id="edit-data-<?= $item['id_satuan']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data <?= $subjudul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('/satuan/update/' . $item['id_satuan']); ?>" method="post" autocomplete="off">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_satuan">Nama Satuan</label>
                            <input type="text" class="form-control" id="nama_satuan" name="nama_satuan" value="<?= $item['nama_satuan']; ?>" required>
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

<?php foreach ($satuan as $item): ?>
    <div class="modal fade" id="delete-data-<?= $item['id_satuan']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Hapus</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data ini: <strong><?= $item['nama_satuan']; ?></strong>?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <form action="<?= base_url('/satuan/delete/' . $item['id_satuan']); ?>" method="post">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>