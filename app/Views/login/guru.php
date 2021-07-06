<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Pembimbing</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css'); ?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Hai </b>Pembimbing</a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><?php if(isset($_SESSION['error'])){ echo $_SESSION['error']; }else{ ?>Sign in to start your session <?php } ?></p>

      <form action="<?php echo base_url('auth/ActionLoginGuru'); ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3 embed-responsive">
          <div class="input-group">
              <input type="text" name="number_1" class="form-control" readonly value="<?php echo rand(1, 9); ?>" style="background-color:whitesmoke; text-align:center;">
              <div class="input-group-prepend">
                  <span class="input-group-text"> + </span>
              </div>
              <input type="text" name="number_2" class="form-control" readonly value="<?php echo rand(1, 9); ?>" style="background-color: whitesmoke; text-align:center;">
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="number" class="form-control" placeholder="Berapa hasil diatas" name="captcha" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-robot"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>

<script src="<?= base_url('plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('dist/js/adminlte.min.js'); ?>"></script>
</body>
</html>
