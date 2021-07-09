<!DOCTYPE html>
<html lang="en">
    <?= $this->include('landingpage/partisi/head.php'); ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>">
    <body>
    <?= $this->include('landingpage/partisi/navbar.php'); ?>
    <?php use App\Models\Application; $modell = new Application; ?>
        <div class="container px-4 px-lg-5">
        
            <nav class="navbar navbar-light bg-light mb-3">

                <nav class="nav">
                    <a class="nav-link disabled" href="#">Login</a>
                </nav>

            </nav>

            <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                    <div class="card-header text-center bg-white">
                        <h2 class="font-weight-light">Login Siswa</h2>
                    </div>
                    <div class="card-body">
                        <form id="Login">
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
                            <button type="submit" class="btn btn-primary mt-3 submit" style="float:right">Login</button>
                            <button class="btn btn-primary mt-3 loading" type="button" disabled style="float:right;">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...
                            </button>
                        </form>
                    </div>
                    <div class="card-footer text-center bg-white">
                        <small>
                            <a href="<?= base_url('auth/guru'); ?>" class="card-link">Login Pembimbing</a>
                        </small>
                    </div>
                    </div>
                </div>
            </div>
        </div>


        </div>
        <?= $this->include('landingpage/partisi/footer.php'); ?>
        <?= $this->include('landingpage/partisi/js.php'); ?>
        <script>
            $('.loading').hide();

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });

            $(document).ready(function () {
                $('#Login').submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        url : '<?= base_url('auth/ActionLoginSiswa') ?>',
                        type : 'POST',
                        data : $(this).serialize(),
                        beforeSend : function(){
                            $('.loading').show();
                            $('.submit').hide();
                        },
                        complete : function () {
                            $('.loading').hide();
                            $('.submit').show();
                        },
                        success : function (response) {
                            
                            if(response == 1){

                                window.location.href = '<?= base_url('siswa/beranda'); ?>'

                            }else{

                                swal(response);

                            }

                        },
                        error : function (err) {
                            alert('SERVER ERROR '.err);
                        }
                        
                    });
                });
            });
        </script>
    </body> 
</html>
