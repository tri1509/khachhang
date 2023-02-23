<?php include 'inc/header.php';?>
<?php include '../classes/controller.php';?>
<?php include_once '../helpers/format.php';?>
<?php
	$ct = new contact();
  if(isset($_GET['edit'])){
    $code_md5 = $_GET['edit'];
  }
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $new_pass = md5($_POST['new_pass']);
    $pass = md5($_POST['pass']);
    $data = array(
      'pass' => $pass,
      'new_pass' => $new_pass,
    );
    $edit_pass = $ct -> edit_pass($data,$code_md5);
	}
?>
<div id="wp-content">
  <div id="content" class="container-fluid">
    <div class="card">
      <div class="card-header font-weight-bold">
        Đổi mật khẩu
      </div>
      <?php if(isset($edit_pass)) {echo $edit_pass;} ?>
      <?php // if(!isset($edit_pass)) { ?>
      <div class="card-body">
        <form action="" class="pt-3" method="post">
          <div class="row">
            <div class="col-md-4 col-12">
              <div class="form-group">
                <label for="pass">Nhập mật khẩu cũ</label>
                <input class="form-control" type="password" name="pass" id="pass">
              </div>
              <div class="form-group">
                <label for="new_pass">Nhật mật khẩu mới</label>
                <input class="form-control" type="password" name="new_pass" id="new_pass">
              </div>
            </div>
          </div>
          <input type="submit" name="edit" class="btn btn-info" value="Cập nhật">
        </form>
      </div>
      <?php // } ?>
    </div>
  </div>
  <?php include 'inc/footer.php';?>