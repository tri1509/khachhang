<?php
include '../classes/adminlogin.php';
include '../lib/validation.php';
?>
<?php
	$login = new adminlogin();		
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$code = $_POST['code'];
		$pass = md5($_POST['pass']);
		$login_check = $login->login($code,$pass);
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <base href="http://localhost/khachhang/admin/">
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="https://nina.vn/images/logo-2789.png" type="image/x-icon">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./css/login.css" />
  <title>Đăng nhập admin</title>
</head>

<body>
  <div id="info"></div>
  <canvas id="canvas"></canvas>
  <div class="container">
    <div class="form-wrap">
      <div class="form-inner">
        <h1 class="title text-center">Đăng nhập</h1>
        <?php if(isset($login_check)) {echo $login_check;} ?>
        <form id="form-login" action="" class="pt-3" method="post">
          <div class="form-floating">
            <input type="text" class="form-control" name="code" id="code" placeholder=" " />
            <label for="code">Mã số nhân viên</label>
          </div>

          <div class="form-floating">
            <span class="password-show-toggle js-password-show-toggle"><span class="uil"></span></span>
            <input type="password" class="form-control" id="password" name="pass" placeholder="Password" />
            <label for="password">Password</label>
          </div>

          <div class="d-flex justify-content-between">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="remember" name="remember_me" />
              <label for="remember" class="form-check-label">Ghi nhớ mập khẩu</label>
            </div>
            <div><a href="">Quên mật khẩu ?</a></div>
          </div>
          <div class="d-grid mb-4">
            <input type="submit" class="btn btn-primary" value="Đăng nhập" name="btn_login" id="btn_login">
          </div>
          <div class="mb-2 text-center">
            Bạn chưa có tài khoản? <a href="dang-ky">Đăng ký ngay</a>
          </div>
        </form>
      </div>
    </div>

  </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="./js/login.js" type="text/javascript"></script>