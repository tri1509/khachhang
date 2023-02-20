<?php include 'inc/header.php';?>
<?php include '../classes/contact.php';?>
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
          <div class="row">
            <div class="col-md-4 col-12">
              <div class="form-group">
                <label for="name">Tên khách hàng</label>
                <input class="form-control" type="text" name="name" value="<?php echo $result['name'] ?>">
              </div>
              <div class="form-group">
                <label for="area">Khu vực</label>
                <input class="form-control" type="text" name="area" value="<?php echo $result['area'] ?>">
              </div>
              <div class="form-group">
                <label for="job">Ngành nghề</label>
                <input class="form-control" type="text" name="job" value="<?php echo $result['job'] ?>">
              </div>
              <div class="form-group">
                <label for="job">Ngày - giờ gọi</label>
                <input class="form-control" type="text" name="time" value="<?php echo $result['time'] ?>">
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="form-group">
                <label for="question">Đã có website chưa ?</label>
                <select class="form-control" name="question">
                  <option value=" ">----Chọn----</option>
                  <option <?php if($question == "Có rồi"){ echo "selected" ; } ?>>Có rồi</option>
                  <option <?php if($question == "Chưa có"){ echo "selected" ; } ?>>Chưa có</option>
                </select>
              </div>
              <div class="form-group">
                <label for="search">Thông qua</label>
                <select class="form-control" name="search">
                  <option value=" ">----Chọn----</option>
                  <option <?php if($search == "Facebook"){ echo "selected" ; } ?>>Facebook</option>
                  <option <?php if($search == "Hồ sơ cty"){ echo "selected" ; } ?>>Hồ sơ cty</option>
                  <option <?php if($search == "Map"){ echo "selected" ; } ?>>Map</option>
                  <option <?php if($search == "Khác"){ echo "selected" ; } ?>>Khác</option>
                </select>
              </div>
              <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input class="form-control" type="text" name="phone" value="<?php echo $result['phone'] ?>">
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="form-group">
                <label for="note">Ghi chú</label>
                <textarea class="form-control" type="text" name="note" rows="8"
                  cols="20"><?php echo $result['note'] ?></textarea>
              </div>
            </div>
          </div>
          <input type="submit" class="btn btn-primary" value="Cập nhật" name="edit">
        </form>
      </div>
    </div>
  </div>
</div>
<?php include 'inc/footer.php';?>