<?php
include '../classes/adminlogin.php';
include '../lib/validation.php';
?>
<?php
	$login = new adminlogin();		
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["btn_login"])) {
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <link rel="stylesheet" href="./css/login.css" />
  <title>Đăng nhập admin</title>
</head>

<body>
  <section>
    <div class="box">
      <div class="square" style="--i:0;"></div>
      <div class="square" style="--i:1;"></div>
      <div class="square" style="--i:2;"></div>
      <div class="square" style="--i:3;"></div>
      <div class="square" style="--i:4;"></div>
      <div class="square" style="--i:5;"></div>
      <div class="container animate__animated animate__zoomInDown">
        <div class="form">
          <h2>Đăng nhập</h2>
          <?php if(isset($login_check)) {echo $login_check;} ?>
          <form action="" method="post">
            <div class="inputBx">
              <input type="text" required="required" name="code" id="code">
              <span>Mã số nhân viên</span>
              <i class="fas fa-user-circle"></i>
            </div>
            <div class="inputBx password">
              <input required="required" type="password" id="password" name="pass">
              <span>Password</span>
              <a class="password-control" onclick="return show_hide_password(this);"></a>
              <i class="fas fa-key"></i>
            </div>
            <label class="remember"><input type="checkbox"> Ghi nhớ mật khẩu</label>
            <div class="inputBx">
              <input type="submit" value="Đăng nhập" name="btn_login" id="btn_login">
            </div>
          </form>
          <p>Quên mật khẩu? <a href="">Bấm vào</a></p>
          <p>Bạn chưa có tài khoản? <a href="dang-ky">Đăng ký ngay</a></p>
        </div>
      </div>
    </div>
  </section>
</body>

</html>
<script>
function show_hide_password(target) {
  var input = document.getElementById('password');
  if (input.getAttribute('type') == 'password') {
    target.classList.add('view');
    input.setAttribute('type', 'text');
  } else {
    target.classList.remove('view');
    input.setAttribute('type', 'password');
  }
  return false;
}
</script>