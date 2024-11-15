<div class="container mt-2">
    <h2>Pengaturan Toko</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('setting/update') ?>" method="post" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Toko</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="foto_toko">Foto Toko</label>
                    <input type="file" class="form-control" id="foto_toko" name="foto_toko" <?= session()->get('role') == 'kasir' ? 'disabled' : '' ?>>
                    <div class="text-center mt-2">
                        <?php if (!empty($setting['foto_toko'])): ?>
                            <img src="<?= base_url('uploads/' . $setting['foto_toko']) ?>" alt="Foto Toko" class="img-thumbnail" style="width: 200px; border-radius: 75px;">
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nama_toko">Nama Toko</label>
                    <input type="text" class="form-control" id="nama_toko" name="nama_toko" value="<?= $setting['nama_toko'] ?>" <?= session()->get('role') == 'kasir' ? 'disabled' : '' ?> required>
                </div>

                <div class="form-group">
                    <label for="nama_pemilik">Nama Pemilik</label>
                    <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" value="<?= $setting['nama_pemilik'] ?>" <?= session()->get('role') == 'kasir' ? 'disabled' : '' ?> required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $setting['alamat'] ?>" <?= session()->get('role') == 'kasir' ? 'disabled' : '' ?> required>
                </div>

                <div class="form-group">
                    <label for="nomor_telepon">Nomor Telepon</label>
                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="<?= $setting['nomor_telepon'] ?>" <?= session()->get('role') == 'kasir' ? 'disabled' : '' ?> required>
                </div>

                <div class="form-group">
                    <label for="motto">Motto</label>
                    <input type="text" class="form-control" id="motto" name="motto" value="<?= $setting['motto'] ?>" <?= session()->get('role') == 'kasir' ? 'disabled' : '' ?> required>
                </div>
            </div>
            <div class="card-footer">
                <?php if (session()->get('role') != 'kasir'): ?>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>