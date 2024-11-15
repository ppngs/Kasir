<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>


  <!-- SweetAlert CSS and JS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url('Dashboard') ?>" class="nav-link">Dashboard</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1A1A1D">
      <!-- Brand Logo -->
      <a href="<?= base_url('Dashboard') ?>" class="brand-link">
        <img src="<?= base_url('AdminLTE') ?>/dist/img/intechcom.jpg" alt="Kasir Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Kasir Intechcom</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info d-flex align-items-center">
            <a href="#" class="d-block">
              <?= session()->get('nama_user') ?>
            </a>
            <?php
            $role = session()->get('role');
            $roleClass = '';

            switch ($role) {
              case 'owner':
                $roleClass = 'badge badge-success'; // Hijau
                break;
              case 'admin':
                $roleClass = 'badge badge-warning'; // Kuning
                break;
              case 'kasir':
                $roleClass = 'badge badge-primary'; // Biru
                break;
              default:
                $roleClass = 'bg-secondary'; // Warna default jika tidak ada role
                break;
            }
            ?>
            <span class="badge <?= $roleClass ?> ml-2"><?= $role ?></span> <!-- Menampilkan role pengguna --> <!-- Menampilkan role pengguna di sebelah kanan nama -->
          </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
              <a href="<?= base_url('Dashboard') ?>" class="nav-link <?= $menu == 'dashboard' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>Dashboard</p>
              </a>
            </li>

            <?php if (session()->get('role') !== 'owner'): ?>
              <li class="nav-item">
                <a href="<?= base_url('Penjualan') ?>" class="nav-link <?= $menu == 'penjualan' ? 'active' : '' ?>">
                  <i class="nav-icon fas fa-cash-register"></i>
                  <p>Penjualan</p>
                </a>
              </li>
            <?php endif; ?>

            <li class="nav-item <?= $menu == 'masterdata' ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= $menu == 'masterdata' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Master Data <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('Produk') ?>" class="nav-link <?= $submenu == 'produk' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Produk</p>
                  </a>
                </li>
                <?php if (session()->get('role') !== 'kasir'): ?>
                  <li class="nav-item">
                    <a href="<?= base_url('Kategori') ?>" class="nav-link <?= $submenu == 'kategori' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kategori</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('Satuan') ?>" class="nav-link <?= $submenu == 'satuan' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Satuan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('User') ?>" class="nav-link <?= $submenu == 'user' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>User</p>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </li>

            <?php if (session()->get('role') !== 'kasir'): ?>
              <li class="nav-item <?= $menu == 'laporan' ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link <?= $menu == 'laporan' ? 'active' : '' ?>">
                  <i class="nav-icon fas fa-newspaper"></i>
                  <p>Laporan <i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url('Laporan') ?>" class="nav-link <?= $submenu == 'laporanharian' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Laporan Harian</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('Laporan/Bulanan') ?>" class="nav-link <?= $submenu == 'laporanbulanan' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Laporan Bulanan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('Laporan/Tahunan') ?>" class="nav-link <?= $submenu == 'laporantahunan' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Laporan Tahunan</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php endif; ?>

            <li class="nav-item">
              <a href="<?= base_url('setting') ?>" class="nav-link">
                <i class="nav-icon fas fa-wrench"></i>
                <p>Setting</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('logout') ?>" class="nav-link">
                <i class="nav-icon fas fa-exclamation"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>

        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><?= $judul ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#"><?= $judul ?></a></li>
                <li class="breadcrumb-item active"><?= $subjudul ?></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- content -->
            <?php
            if ($page) {
              echo view($page);
            }
            ?>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>

  <script>
    $(document).ready(function() {
      // Check for success message
      <?php if (session()->getFlashdata('success')): ?>
        swal("Success!", "<?= session()->getFlashdata('success'); ?>", "success");
      <?php endif; ?>

      // Check for error message
      <?php if (session()->getFlashdata('error')): ?>
        swal("Error!", "<?= session()->getFlashdata('error'); ?>", "error");
      <?php endif; ?>
    });

    $(function() {
      var buttons = []; // Array untuk menyimpan tombol

      // Cek apakah kita berada di halaman v_produk
      if (window.location.pathname.includes('Produk')) {
        buttons = [{
            extend: 'excel',
            title: 'Intechcom' // Ubah judul untuk file Excel
          },
          {
            extend: 'pdf',
            title: 'Intechcom', // Ubah judul untuk file PDF
            message: function() {
              // Ambil tanggal saat ini
              const today = new Date();
              const formattedDate = today.toLocaleDateString('id-ID'); // Format tanggal
              return 'Tanggal: ' + formattedDate; // Pesan yang akan ditampilkan saat print
            }
          }
        ];
      }

      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": true,
        "ordering": true,
        "buttons": buttons // Gunakan array tombol yang telah disiapkan
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });


    document.addEventListener('DOMContentLoaded', function() {
      const roleSelect = document.getElementById('role');

      function updateRoleColor() {
        roleSelect.classList.remove('bg-success', 'bg-warning', 'bg-primary'); // Hapus kelas warna lama

        if (roleSelect.value === 'admin') {
          roleSelect.classList.add('bg-warning');
        } else if (roleSelect.value === 'kasir') {
          roleSelect.classList.add('bg-primary');
        } else if (roleSelect.value === 'owner') {
          roleSelect.classList.add('bg-success');
        }
      }

      // Panggil saat halaman dimuat pertama kali
      updateRoleColor();

      // Panggil saat terjadi perubahan
      roleSelect.addEventListener('change', updateRoleColor);
    });
  </script>




</body>

</html>