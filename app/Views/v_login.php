<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Intechcom | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page" style="background: linear-gradient(135deg, #EFCA52, #E4819E);">
  <div class="login-box">
    <div class="text-center mb-3">
      <img src="<?= base_url('AdminLTE') ?>/dist/img/intechcom.png" alt="Logo" style="width: 100px; background-color:white; border-radius: 50px;">
    </div>
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="<?= base_url('/') ?>" class="h1 text-primary"><b>Kasir</b><br>Intechcom</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Login untuk memulai sesi Anda</p>

        <?php if (session()->getFlashdata('error')): ?>
          <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
          </div>
        <?php endif; ?>

        <form action="<?= base_url('/login') ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" name="nama_user" class="form-control" placeholder="Username" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>

      </div>
      <div class="card-footer text-center">
        <small>&copy; 2024 Intechcom. All rights reserved.</small>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>
</body>

</html>