<div class="card-tools col-12">
  <?php if (session()->get('role') === 'admin'): ?> <!-- Hanya admin yang bisa menambah data -->
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
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead class="text-center">
          <tr>
            <th width=50px>No</th>
            <th>Kode / Barcode</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Satuan</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <?php if (session()->get('role') === 'admin'): ?>
              <!-- Hanya admin yang bisa melihat aksi -->
              <th width=100px>Aksi</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          <?php foreach ($produk as $item): ?>
            <tr class="<?= $item['stok'] == 0 ? 'table-danger' : ''; ?>">
              <td><?= $no++; ?></td>
              <td><?= $item['kode_produk']; ?></td>
              <td><?= $item['nama_produk']; ?></td>
              <td><?= $item['nama_kategori']; ?></td>
              <td><?= $item['nama_satuan']; ?></td>
              <td>Rp.<?= number_format($item['harga_beli'], 0); ?></td>
              <td>Rp.<?= number_format($item['harga_jual'], 0); ?></td>
              <td><?= $item['stok']; ?></td>
              <?php if (session()->get('role') === 'admin'): ?>
                <!-- Hanya admin yang bisa melihat tombol edit dan delete -->
                <td class="text-center">
                  <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#edit-data-<?= $item['id_produk']; ?>">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete-data-<?= $item['id_produk']; ?>">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>



<!-- Modal form untuk menambahkan data -->
<div class="modal fade" id="tambah-data">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Produk</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('/produk/save'); ?>" method="post" autocomplete="off">
        <div class="modal-body">
          <div class="form-group">
            <label for="kode_produk">Kode Produk</label>
            <input type="text" class="form-control" id="kode_produk" name="kode_produk" placeholder="Masukkan kode produk" required>
          </div>
          <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Masukkan nama produk" required>
          </div>
          <div class="form-group">
            <label for="id_kategori">Kategori</label>
            <select class="form-control" id="id_kategori" name="id_kategori" required>
              <option value="" disabled selected>Pilih Kategori</option>
              <?php foreach ($kategori as $item): ?>
                <option value="<?= $item['id_kategori']; ?>"><?= $item['nama_kategori']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="id_satuan">Satuan</label>
            <select class="form-control" id="id_satuan" name="id_satuan" required>
              <option value="" disabled selected>Pilih Satuan</option>
              <?php foreach ($satuan as $item): ?>
                <option value="<?= $item['id_satuan']; ?>"><?= $item['nama_satuan']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="harga_beli">Harga Beli</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input type="number" class="form-control" id="harga_beli" name="harga_beli" placeholder="Masukkan harga beli" required>
            </div>
          </div>
          <div class="form-group">
            <label for="harga_jual">Harga Jual</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input type="number" class="form-control" id="harga_jual" name="harga_jual" placeholder="Masukkan harga jual" required>
            </div>
          </div>
          <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan stok" required>
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


<?php foreach ($produk as $item): ?>
  <div class="modal fade" id="edit-data-<?= $item['id_produk']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Produk</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('/produk/update/' . $item['id_produk']); ?>" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="kode_produk">Kode Produk</label>
              <input type="text" class="form-control" id="kode_produk" name="kode_produk" value="<?= $item['kode_produk']; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="nama_produk">Nama Produk</label>
              <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $item['nama_produk']; ?>" required>
            </div>
            <div class="form-group">
              <label for="id_kategori">Kategori</label>
              <select class="form-control" id="id_kategori" name="id_kategori" required>
                <?php foreach ($kategori as $kat): ?>
                  <option value="<?= $kat['id_kategori']; ?>" <?= $item['id_kategori'] == $kat['id_kategori'] ? 'selected' : ''; ?>><?= $kat['nama_kategori']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="id_satuan">Satuan</label>
              <select class="form-control" id="id_satuan" name="id_satuan" required>
                <?php foreach ($satuan as $sat): ?>
                  <option value="<?= $sat['id_satuan']; ?>" <?= $item['id_satuan'] == $sat['id_satuan'] ? 'selected' : ''; ?>><?= $sat['nama_satuan']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="harga_beli">Harga Beli</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp.</span>
                </div>
                <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="<?= $item['harga_beli']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="harga_jual">Harga Jual</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp.</span>
                </div>
                <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="<?= $item['harga_jual']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="stok">Stok</label>
              <input type="number" class="form-control" id="stok" name="stok" value="<?= $item['stok']; ?>" required>
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



<?php foreach ($produk as $item): ?>
  <div class="modal fade" id="delete-data-<?= $item['id_produk']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Konfirmasi Hapus</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus data ini: <strong><?= $item['nama_produk']; ?></strong>?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <form action="<?= base_url('/produk/delete/' . $item['id_produk']); ?>" method="post">
            <button type="submit" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>