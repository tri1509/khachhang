<?php include '../classes/category.php';?>
<?php include '../classes/post.php';?>
<?php
	$cat = new category();
  $ps = new post();
  if(isset($_POST['array_id'])){
    $data = $_POST['array_id'];
    foreach($data as $key => $e){
      $id = $data['array_id'];
      $query = "UPDATE tbl_cat_post SET position = '$key' WHERE id= '$id' ";
      $result = $this->db->update($query);
      return $result;
    }
  }