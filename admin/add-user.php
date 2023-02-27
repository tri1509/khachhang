<?php
if(!isset($_GET['edit'])){
$title = "Thêm thành viên";
}else{
$title = "Chỉnh sửa thông tin";
}
include 'inc/header.php';?>
<?php include '../classes/controller.php';?>
<?php include_once '../helpers/format.php';?>
<?php
	$ct = new contact();		
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
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
      $add_user = $ct -> add_user($data);
    }
	}
  if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
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
    if(isset($_GET['edit'])){
      $code_md5 = $_GET['edit'];
    }
    if(empty($error)){
      $data = array(
        'name' => $name,
        'room' => $room,
        'code' => $code,
      );
      $edit_user = $ct -> edit_user($data,$code_md5);
    }
	}
?>
<div id="wp-content">
  <div id="content" class="container-fluid">
    <?php
    if(isset($_GET['edit'])){
      $code_md5 = $_GET['edit'];
      $get_user = $ct -> get_user($code_md5);
      if($get_user) {
        $resule = $get_user -> fetch_assoc();
        $rooms = $resule['room'];
    ?>
    <div class="card">
      <div class="card-header font-weight-bold">
        Chỉnh sửa
      </div>
      <?php if(isset($edit_user)) {echo $edit_user;} ?>
      <?php if(!isset($edit_user)) { ?>
      <div class="card-body">
        <form action="" class="pt-3" method="post">
          <div class="row">
            <div class="col-md-4 col-12">
              <div class="form-group">
                <label for="name">Họ và tên</label>
                <input class="form-control" type="text" name="name" id="name" value="<?php echo $resule['name'] ?>">
                <span class="text-danger">
                  <?php if(!empty($error['name'])) { echo $error['name'] ; }?>
                </span>
              </div>
              <div class="form-group">
                <label for="code">Mã số nhân viên</label>
                <input class="form-control" type="text" name="code" id="code" value="<?php echo $resule['code'] ?>">
                <span class="text-danger">
                  <?php if(!empty($error['code'])) { echo $error['code'] ; }?>
                </span>
              </div>
              <div class="form-group">
                <label for="room">Phòng</label>
                <select class="form-control" id="room" name="room">
                  <option>---Chọn---</option>
                  <option <?php if($rooms == "C. Vân"){echo "selected";}?>>C. Vân</option>
                  <option <?php if($rooms == "A. Tèo"){echo "selected";}?>>A. Tèo</option>
                  <option <?php if($rooms == "A. Quý"){echo "selected";}?>>A. Quý</option>
                  <option <?php if($rooms == "C. Diễm"){echo "selected";}?>>C. Diễm</option>
                  <option <?php if($rooms == "A. Tâm"){echo "selected";}?>>A. Tâm</option>
                </select>
                <span class="text-danger">
                  <?php if(!empty($error['room'])) { echo $error['room'] ; }?>
                </span>
              </div>
            </div>
          </div>
          <input type="submit" name="edit" class="btn btn-info" id="edit-user" value="Cập nhật">
        </form>
      </div>
      <?php } ?>
    </div>
    <?php }}else{?>
    <div class="card">
      <div class="card-header font-weight-bold">
        Thêm người dùng
      </div>
      <?php if(isset($add_user)) {echo $add_user;} ?>
      <div class="card-body">
        <form action="" class="pt-3" method="post">
          <div class="row">
            <div class="col-md-4 col-12">
              <div class="form-group">
                <label for="name">Họ và tên</label>
                <input class="form-control" type="text" name="name" id="name">
                <span class="text-danger">
                  <?php if(!empty($error['name'])) { echo $error['name'] ; }?>
                </span>
              </div>
              <div class="form-group">
                <label for="code">Mã số nhân viên</label>
                <input class="form-control" type="text" name="code" id="code">
                <span class="text-danger">
                  <?php if(!empty($error['code'])) { echo $error['code'] ; }?>
                </span>
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="form-group">
                <label for="">Quyền</label>
                <select class="form-control" id="" name="">
                  <option>User</option>
                  <option>Administrator</option>
                </select>
              </div>
              <div class="form-group">
                <label for="room">Phòng</label>
                <select class="form-control" id="room" name="room">
                  <option>Chọn</option>
                  <option>C. Vân</option>
                  <option>A. Tèo</option>
                  <option>A. Quý</option>
                  <option>C. Diễm</option>
                  <option>A. Tâm</option>
                </select>
                <span class="text-danger">
                  <?php if(!empty($error['room'])) { echo $error['room'] ; }?>
                </span>
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="form-group">
                <label for="pass">Mật khẩu</label>
                <input class="form-control" type="password" name="pass" id="password">
              </div>
              <div class="form-group">
                <label for="pass_2">Nhập lại mật khẩu</label>
                <input class="form-control" type="password" name="pass_2" id="password_2">
              </div>
              <span class="text-danger">
                <?php if(!empty($error['pass'])) { echo $error['pass'] ; }?>
              </span>
            </div>
          </div>
          <input name="add" type="submit" class="btn btn-primary" id="add-user" disabled value="Thêm mới">
        </form>
      </div>
    </div>
    <?php } ?>
  </div>
  <?php include 'inc/footer.php';?>