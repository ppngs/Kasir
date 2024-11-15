        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $produkCount; ?></h3>

              <p>Produk</p>
            </div>
            <div class="icon">
              <i class="fas fa-box-open"></i>
            </div>
            <a href="<?= base_url('Produk') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <?php if (session()->get('role') !== 'kasir'): ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $kategoriCount; ?></sup></h3>

                <p>Kategori</p>
              </div>
              <div class="icon">
                <i class="fas fa-list"></i>
              </div>
              <a href="<?= base_url('Kategori') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $satuanCount; ?></h3>

                <p>Satuan</p>
              </div>
              <div class="icon">
                <i class="fas fa-list-ol"></i>
              </div>
              <a href="<?= base_url('Satuan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $userCount; ?></h3>

                <p>User</p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="<?= base_url('User') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php endif; ?>