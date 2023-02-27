<?php
$title = "Danh sách khách hàng";
include 'inc/header.php';?>
<?php include '../classes/controller.php';?>
<?php include_once '../helpers/format.php';?>
<?php
  $fm = new Format();
	$ct = new contact();		
  $show = $ct -> show($code);
  if(isset($_GET['del'])){
    $id = $_GET['del'];
    $del = $ct ->del($id,$code);
  }
?>
<div id="wp-content">
  <div id="content" class="container-fluid">
    <div class="card">
      <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
        <h5 class="m-0">Danh sách</h5>
      </div>
      <div class="card-body">
        <table class="table table-striped table-checkall" id="table-admin">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tên KH</th>
              <th scope="col">SDT</th>
              <th scope="col">Khu vực</th>
              <th scope="col">Ngành nghề</th>
              <th scope="col">website</th>
              <th scope="col">Thông qua</th>
              <th scope="col">Giờ gọi</th>
              <th scope="col">Ghi chú</th>
              <th scope="col">Tác vụ</th>
            </tr>
          </thead>
          <tbody>
            <?php 
                if($show) {
                  $i=0;
                  while($resule = $show -> fetch_assoc()){
                    $i++;
              ?>
            <tr class="">
              <td><?php echo $i ?></td>
              <td><?php echo $resule['name'] ?></td>
              <td><?php echo $resule['phone'] ?></td>
              <td><?php echo $resule['area'] ?></td>
              <td><?php echo $resule['job'] ?></td>
              <td><?php echo $resule['question'] ?></td>
              <td><?php echo $resule['search'] ?></td>
              <td><?php echo $resule['time'] ?></td>
              <td><?php echo $resule['note'] ?></td>
              <td>
                <a href="edit-contact.php?id=<?php echo $resule['id'] ?>"
                  class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip"
                  data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                <a href="?del=<?php echo $resule['id'] ?>" onclick="return confirm('Bạn có muốn xoá không?')"
                  class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip"
                  data-placement="top" title="Xoá"><i class="fa fa-trash"></i></a>
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