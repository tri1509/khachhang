<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/controller.php';?>
<?php
	$ct = new contact();	
  if(isset($_GET['id']) && $_GET['id']!=NULL){
    $id = $_GET['id'];
  }	
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $update = $ct -> update($_POST,$_FILES,$code,$id);
  }
  $get_id = $ct -> get_id($id,$code);
  if($get_id){
      $result = $get_id->fetch_assoc();
      $question = $result['question'];
      $search = $result['search'];
  }
?>
<div id="wp-content">
  <div id="content" class="container-fluid">
    <div class="card">
      <div class="card-header font-weight-bold">
        Chỉnh sửa
      </div>
      <?php if(isset($update)){echo $update ; } ?>
      <div class="card-body">
        <form method="post" action="">

          <div class="row animate__animated animate__bounceIn">
            <div class="col-md-4 col-12">
              <div class="form-group mb-3">
                <label for="name">Tên khách hàng</label>
                <input class="form-control" type="text" name="name" value="<?php echo $result['name'] ?>">
              </div>
              <div class="form-group mb-3">
                <label for="area">Khu vực</label>
                <input class="form-control" type="text" name="area" value="<?php echo $result['area'] ?>">
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="row">
                <div class="col-6">
                  <div class="form-group mb-3">
                    <label for="search">Thông qua</label>
                    <select class="form-select" name="search">
                      <option value=" ">----Chọn----</option>
                      <option <?php if($search == "Facebook"){ echo "selected" ; } ?>>Facebook</option>
                      <option <?php if($search == "Hồ sơ cty"){ echo "selected" ; } ?>>Hồ sơ cty</option>
                      <option <?php if($search == "Map"){ echo "selected" ; } ?>>Map</option>
                      <option <?php if($search == "Khác"){ echo "selected" ; } ?>>Khác</option>
                    </select>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group mb-3">
                    <label for="question">WEB ?</label>
                    <select class="form-select" name="question">
                      <option value=" ">----Chọn----</option>
                      <option <?php if($question == "Rồi"){ echo "selected" ; } ?>>Rồi</option>
                      <option <?php if($question == "Chưa"){ echo "selected" ; } ?>>Chưa</option>
                      <option <?php if($question == "Business"){ echo "selected" ; } ?>>Business</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group mb-3">
                <label for="time">Giờ gọi</label>
                <input class="form-control" type="text" name="time" value="<?php echo $result['time'] ?>">
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="form-group mb-3">
                <label for="job">Ngành nghề</label>
                <input class="form-control" type="text" name="job" value="<?php echo $result['job'] ?>">
              </div>
              <div class="form-group mb-3">
                <label for="phone">Số điện thoại</label>
                <input class="form-control" type="text" name="phone" value="<?php echo $result['phone'] ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-3">
                <label for="note">Ghi chú</label>
                <textarea name="note" class="ckeditor"><?php echo $result['note'] ?></textarea>
              </div>
            </div>
          </div>
          <input type="submit" class="btn btn-primary animate__animated animate__backInRight" value="Cập nhật"
            name="edit">
        </form>
      </div>
    </div>
  </div>
</div>
<?php include 'inc/footer.php';?>