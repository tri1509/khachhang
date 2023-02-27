<?php
$title = "Thêm khách hàng";
include 'inc/header.php';?>
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
          <div class="row">
            <div class="col-md-4 col-12">
              <div class="form-group">
                <label for="name">Tên khách hàng</label>
                <input class="form-control" type="text" name="name">
              </div>
              <div class="form-group">
                <label for="area">Khu vực</label>
                <input class="form-control" type="text" name="area">
              </div>
              <div class="form-group">
                <label for="job">Ngành nghề</label>
                <input class="form-control" type="text" name="job">
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="form-group">
                <label for="question">Đã có website chưa ?</label>
                <select class="form-control" name="question">
                  <option value=" ">----Chọn----</option>
                  <option>Có rồi</option>
                  <option>Chưa có</option>
                </select>
              </div>
              <div class="form-group">
                <label for="search">Thông qua</label>
                <select class="form-control" name="search">
                  <option value=" ">----Chọn----</option>
                  <option>Facebook</option>
                  <option>Hồ sơ cty</option>
                  <option>Map</option>
                  <option>Khác</option>
                </select>
              </div>
              <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input class="form-control" type="text" name="phone">
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="form-group">
                <label for="note">Ghi chú</label>
                <textarea class="form-control" type="text" name="note" rows="8" cols="20"></textarea>
              </div>
            </div>
          </div>
          <input type="submit" class="btn btn-primary" value="Thêm mới" name="add">
        </form>
      </div>
      <?php if(isset($insert)){echo $insert ; } ?>
    </div>
  </div>
</div>
<?php include 'inc/footer.php';?>