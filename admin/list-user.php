<?php
$title = "Danh sách thành viên";
include 'inc/header.php';
?>
<?php include '../classes/controller.php';?>
<?php include_once '../helpers/format.php';?>
<div id="wp-content">
  <div id="content" class="container-fluid">
    <div class="card">
      <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
        <h5 class="m-0">Danh sách thành viên</h5>
      </div>
      <div class="card-body">
        <table class="table table-striped table-checkall">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Họ tên</th>
              <th scope="col">MS</th>
              <th scope="col">Phòng</th>
              <th scope="col">Ngày tạo</th>
              <th scope="col">Tác vụ</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $ct = new contact();	
            if(isset($_GET['del'])){
              $id = $_GET['del'];
              $del = $ct ->del_user($id);
            }	
            $show_user = $ct -> show_user();
            if($show_user) {
              $i=0;
              while($resule = $show_user -> fetch_assoc()){
                $i++;
          ?>
            <tr>
              <th scope="row"><?php echo $i ?></th>
              <td><?php echo $resule['name'] ?></td>
              <td><?php echo $resule['code'] ?></td>
              <td><?php echo $resule['room'] ?></td>
              <td><?php echo $resule['time'] ?></td>
              <td>
                <?php 
                  if ($code == "28838"){
                ?>
                <a href="?del=<?php echo $resule['id'] ?>"
                  onclick="return confirm('Bạn có muốn xoá thành viên này không?')"
                  class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip"
                  data-placement="top" title="Xoá"><i class="fa fa-trash"></i></a>
                <?php } ?>
                <?php 
                if ($code == $resule['code']){
                ?>
                <a href="add-user.php?edit=<?php echo md5($resule['code']) ; ?>"
                  class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip"
                  data-placement="top" title="Chỉnh sửa"><i class="fa fa-edit"></i></a>
                <a href="edit-pass.php?edit=<?php echo md5($resule['code'])?>"
                  class="btn btn-info btn-sm rounded-0 text-white" type="button" data-toggle="tooltip"
                  data-placement="top" title="Đổi mật khẩu"><i class="fa fa-lock"></i></a>
                <?php } ?>
              </td>
            </tr>
            <?php } } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include 'inc/footer.php';?>