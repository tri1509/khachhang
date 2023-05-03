<?php
  $title = "Danh sách khách hàng";
  include 'inc/header.php';
  include 'inc/sidebar.php';
  require 'PHPExcel/Classes/PHPExcel.php';
?>
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
        <table class="table table-hover table-striped" id="table-admin">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">NAME</th>
              <th scope="col">PHONE</th>
              <th scope="col">AREA</th>
              <th scope="col">JOB</th>
              <th scope="col">WEB</th>
              <th scope="col">AT</th>
              <th scope="col">TIME</th>
              <th scope="col">NOTE</th>
              <th scope="col" style="width: 100px !important">ACTION</th>
            </tr>
          </thead>
          <tbody>
            <?php 
                if($show){
                  $i=0;
                  while($resule = $show -> fetch_assoc()){
                    $i++;
              ?>
            <tr>
              <td><?php echo $i ?></td>
              <td><span class="text-capitalize fw-semibold"><?php echo $resule['name'] ?></span></td>
              <td>
                <?php if($resule['phone']){ ?>
                <button type="button" class="btn btn-info copy"><?php echo $resule['phone'] ?></button>
                <?php } ?>
              </td>
              <td><?php echo $resule['area'] ?></td>
              <td><?php echo $resule['job'] ?></td>
              <td>
                <?php if($resule['question'] != " "){ ?>
                <span class="badge text-bg-warning"><?php echo $resule['question'] ?></span>
                <?php } ?>
              </td>
              <td><?php echo $resule['search'] ?></td>
              <td><?php echo $resule['time'] ?></td>
              <td><?php echo $resule['note'] ?></td>
              <td style="width: 100px !important">
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