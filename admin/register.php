<?php
include '../classes/adminlogin.php';
include '../lib/validation.php';
?>
<?php
	$login = new adminlogin();		
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = array();
    $alert = array();
    if(empty($_POST['name'])) {
      $error['name'] = "Không được để trống tên !";
    }else{
      $name = $_POST['name'];
    }
    if(empty($_POST['code'])) {
      $error['code'] = "Nhập mã số nhân viên vô đi !";
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
        $error['pass'] = "Làm ơn đặt mật khẩu phức tạp hơn !";
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
      // print_r($data);
      $register = $login->register($data);
    }
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <base href="http://localhost/khachhang/admin/">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./css/login.css" />
  <title>Đăng ký tài khoản</title>
</head>

<body>
  <div id="info"></div>
  <canvas id="canvas"></canvas>
  <div class="container">
    <div class="form-wrap">
      <div class="form-inner">
        <h1 class="title text-center">Đăng ký</h1>
        <?php if(isset($register)) {echo $register;} ?>
        <form id="form-login" action="" class="pt-3" method="post">
          <div class="form-floating">
            <input type="text" class="form-control" name="code" id="code" placeholder=" "
              value="<?php if(!empty($code)){echo $code;}?>" />
            <label for="code">Mã số nhân viên</label>
            <span class="text-danger">
              <?php if(!empty($error['code'])) { echo $error['code'] ; }?>
            </span>
          </div>
          <div class="form-floating">
            <input type="text" class="form-control" name="name" id="name" placeholder=" "
              value="<?php if(!empty($name)){echo $name;}?>" />
            <label for="name">Họ và tên</label>
            <span class="text-danger">
              <?php if(!empty($error['name'])) { echo $error['name'] ; }?>
            </span>
          </div>
          <div class="form-floating">
            <select name="room" id="room" class="form-select">
              <option value="">Chọn</option>
              <option value="C. Vân" <?php if(!empty($room) && $room == "C. Vân"){echo "selected" ; }?>>C. Vân</option>
              <option value="A. Tèo <?php if(!empty($room) && $room == "A. Tèo"){echo "selected" ; }?>">A. Tèo</option>
              <option value="A. Quý" <?php if(!empty($room) && $room == "A. Quý"){echo "selected" ; }?>>A. Quý</option>
              <option value="C. Diễm" <?php if(!empty($room) && $room == "C. Diễm"){echo "selected" ; }?>>C. Diễm
              </option>
              <option value="A. Tâm" <?php if(!empty($room) && $room == "A. Tâm"){echo "selected" ; }?>>A. Tâm</option>
            </select>
            <label for="name">Phòng</label>
            <span class="text-danger">
              <?php if(!empty($error['room'])) { echo $error['room'] ; }?>
            </span>
          </div>

          <div class="form-floating">
            <span class="password-show-toggle js-password-show-toggle"><span class="uil"></span></span>
            <input type="password" class="form-control" id="password" name="pass" placeholder="Password" />
            <label for="password">Password</label>
          </div>

          <div class="form-floating">
            <span class="password-show-toggle js-password-show-toggle_2"><span class="uil"></span></span>
            <input type="password" class="form-control" id="password_2" name="pass_2" placeholder="Password" />
            <label for="password_2"> Nhập lại Password</label>
            <span class="text-danger">
              <?php if(!empty($error['pass'])) { echo $error['pass'] ; }?>
            </span>
          </div>

          <div class="d-grid mb-4">
            <input type="submit" class="btn btn-primary" value="Đăng ký" name="register" id="register" disabled>
          </div>

          <div class="mb-2 text-center">
            <a href="dang-nhap">Trở về</a>
          </div>

        </form>
      </div>
    </div>

  </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$("#password, #password_2").on("keyup", function() {
  if ($("#password").val() == $("#password_2").val()) {
    $("#register").removeAttr("disabled");
    $("#restorepass").removeAttr("disabled");
  } else {
    $("#register").attr("disabled", "disabled");
    $("#restorepass").attr("disabled", "disabled");
  }
});
</script>
<script src="./js/login.js" type="text/javascript"></script>