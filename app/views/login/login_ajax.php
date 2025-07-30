
<!DOCTYPE html>
<html>
<head>
  <title>absensi</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url; ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url; ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url; ?>/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Absensi</b>&nbsp;
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan login terlebih dahulu.</p>

      <!-- <form action="<?= base_url; ?>/login/prosesLogin" method="post"> -->
      <from method="post" id="login-form">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="ketikkan username.." id="username"  required autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password fa-4"></span>
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control" placeholder="ketikkan password.." id="password"  required autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="loginuser"  class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
  <div class="row">
        <div class="col-sm-12">
          <?php
           // Flasher::Message();
          ?>
        </div>
      </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url; ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url; ?>/dist/js/adminlte.min.js"></script>

</body>
</html>
<script>
        
        $(document).on("click",".toggle-password",function () {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

$(document).ready(function(){


       $("#loginuser").on("click",function(){
        $("#loginuser").fadeOut();
           const datas ={
             username :$("#username").val(),
             password :$("#password").val(),
             checkLogin:true
           }
           
          $.ajax({
           url:"<?=base_urlport?>/login/proses",
            method: "post",
            data: datas,
            dataType: "json",
            success: function(response){
                if(response==null){
                  Swal.fire({
                      position: 'top-center',
                      icon: "info",
                      showConfirmButton: true,
                       //timer: 100,
					            title:"Username atau password salah",
                    });
                    $("#loginuser").fadeIn();
                }else{
                 // proselog(response)
                  proseslogin(response);
                }
                 
            }

          })
       })
    });

      // function proselog(response){
      //   const id_user = response.id_user;
      //   const login_user = response.login_user;
        
      //   <?php
         
      //     $_SESSION['id_user'] =`${id_user}`;
      //     $_SESSION['session_login'] = 'sudah_login';
      //     $_SESSION['login_user'] = `${login_user}`;
      //     header('location: '. base_url . '/home');
      //   ?>


      // }

    function proseslogin(response){
      $.ajax({
           url:"<?=base_url?>/login/proseslogin",
            method: "post",
            data: response,
            dataType: "json",
            success: function(result){
              window.location.replace("<?=base_url?>/home/index") 

            }

          })

    }
    </script>