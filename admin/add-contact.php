<?php
  $title = "Thêm khách hàng";
  include 'inc/header.php';
  include 'inc/sidebar.php';
?>
<?php include '../classes/controller.php';?>
<?php
	$ct = new contact();		
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
      $insert = $ct->insert($_POST,$_FILES,$code);
    }
?>
<div id="wp-content">
  <div id="content" class="container-fluid">
    <div class="card">
      <div class="card-header font-weight-bold">
        Thêm nguồn
      </div>
      <div class="card-body">
        <form method="post" action="">
          <div class="row animate__animated animate__lightSpeedInLeft">
            <div class="col-md-4 col-12">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" placeholder=" ">
                <label for="name">Tên khách hàng</label>
              </div>
              <div class="form-floating mb-3">
                <input class="form-control" type="text" name="area" placeholder=" ">
                <label for="area">Khu vực</label>
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="row">
                <div class="col-6">
                  <div class="form-floating mb-3">
                    <select class="form-select" name="search">
                      <option value=" ">----Chọn----</option>
                      <option>Facebook</option>
                      <option>Hồ sơ cty</option>
                      <option>Map</option>
                      <option>Khác</option>
                    </select>
                    <label for="search">Thông qua</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-floating mb-3">
                    <select class="form-select" name="question">
                      <option value=" ">----Chọn----</option>
                      <option>Rồi</option>
                      <option>Chưa</option>
                    </select>
                    <label for="question">WEB</label>
                  </div>
                </div>
              </div>
              <div class="form-floating mb-3">
                <input class="form-control" type="text" name="time" placeholder=" ">
                <label for="time">Giờ gọi</label>
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="form-floating mb-3">
                <input class="form-control" type="text" name="job" placeholder=" ">
                <label for="job">Ngành nghề</label>
              </div>
              <div class="form-floating mb-3">
                <input class="form-control" type="text" name="phone" placeholder=" ">
                <label for="phone">Số điện thoại</label>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="note">Ghi chú</label>
                <textarea name="note" class="ckeditor"></textarea>
              </div>
            </div>
          </div>
          <input type="submit" class="btn btn-primary animate__animated animate__backInDown" value="Thêm mới"
            name="add">
        </form>
      </div>
      <?php if(isset($insert)){echo $insert ; } ?>
    </div>
  </div>
</div>
<?php include 'inc/footer.php';?>