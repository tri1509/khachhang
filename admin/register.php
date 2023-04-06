<?php
  include '../classes/adminlogin.php';
  include '../lib/validation.php';
  include './data/support.php';
?>
<?php
	$login = new adminlogin();		
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = array();
    $alert = array();
    if(empty($_POST['name'])) {
      $error['name'] = "Đừng để trống tên !";
    }else{
      $name = $_POST['name'];
    }
    if(empty($_POST['code'])) {
      $error['code'] = "Đừng để trống MSNV !";
    }else{
      $code = $_POST['code'];
    }
    if(empty($_POST['room'])) {
      $error['room'] = "Vui lòng chọn phòng !";
    }else{
      $room = $_POST['room'];
    }
    if(empty($_POST['pass'])) {
      $error['pass'] = "Không được để trống mật khẩu !";
    }else{
      $pattern = '/^[A-Za-z0-9_\.!@#$%^&*()]{6,32}$/';
      if(!preg_match($pattern,$_POST['pass'])){
        $error['pass'] = "Đặt mật khẩu phức tạp hơn !";
      }else{
        $pass = md5($_POST['pass']);
      }
    }
    if(empty($error)){
      $data = array(
        'name' => $name,
        'room' => $room,
        'pass' => $pass,
        'code' => $code,
      );
      $register = $login->register($data);
    }
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="./css/login.css" />
  <title>Đăng ký tài khoản</title>
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
          <h2>Đăng ký</h2>
          <?php if(isset($register)) {echo $register;} ?>
          <form id="form-login" action="" method="post">
            <div class="inputBx">
              <input type="text" required="required" name="code" id="code"
                value="<?php if(!empty($code)){echo $code;}?>" />
              <span>Mã số nhân viên</span>
              <i class="fas fa-user-circle"></i>
            </div>
            <?php if(!empty($error['code'])) { echo $error['code'] ; }?>

            <div class="inputBx">
              <input type="text" required="required" name="name" id="name"
                value="<?php if(!empty($name)){echo $name;}?>" />
              <span>Họ và tên</span>
              <i class="fas fa-user-circle"></i>
            </div>
            <?php if(!empty($error['name'])) { echo $error['name'] ; }?>

            <div class="inputBx">
              <select name="room" id="room">
                <option value="">Chọn</option>
                <?php foreach($list_manage as $item) { ?>
                <option value="<?php echo $item['name'] ?>"
                  <?php if(!empty($room) && $room == $item['name']){echo "selected";}?>>
                  <?php echo $item['name'] ?>
                </option>
                <?php } ?>
              </select>
              <span></span>
              <i class="fas fa-user-circle"></i>
            </div>
            <?php if(!empty($error['room'])) { echo $error['room'] ; }?>
            <div class="inputBx password">
              <input required="required" type="password" id="password" name="pass">
              <span>Password</span>
              <a class="password-control" onclick="return show_hide_password(this);"></a>
              <i class="fas fa-key"></i>
            </div>
            <?php if(!empty($error['pass'])) { echo $error['pass'] ; }?>
            <div class="inputBx">
              <input type="submit" value="Đăng ký" name="register" id="register" .disabled>
            </div>
          </form>
          <p>Bạn đã có tài khoản? <a href="dang-nhap">Đăng nhập</a></p>
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