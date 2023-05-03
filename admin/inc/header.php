<?php
  include '../lib/session.php';
  Session::checkSession();
  if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    Session::destroy();
  }            
  $name = Session::get('adminName');
  $code = Session::get('adminCode');
  if (empty($title)){
    $title = "Trang chủ";
  }
  ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
  <link rel="shortcut icon" href="https://nina.vn/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="./css/dataTables.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/responsive.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./ckeditor/ckeditor.js" type="text/javascript"></script>
  <title><?php echo $title ?></title>
</head>

<body>
  <?php
  if (session_id() === '')
  session_start();
  if( isset( $_SESSION['popup'] ) ){
      $_SESSION['popup'] += 1;
  }else{
      $_SESSION['popup'] = 1;
  }
  $luotvao = $_SESSION['popup'];
  if ($luotvao == '1') {
  ?>
  <div id="untree_co--overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-info" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <?php } ?>
  <div id="warpper" class="nav-fixed">
    <nav class="topnav shadow navbar-light bg-white d-flex">
      <div class="logo hrv-rotateY">
        <img src="https://nina.vn/upload/hinhanh/logothietkewebnina-3831.webp" alt="" srcset="" width="120">
      </div>
      <div class="navbar-brand text-center">
        <a href="./">DESIGN BY M.TRÍ</a>
        <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
      </div>
      <div class="nav-right ">
        <div class="btn-group mr-auto">
          <button type="button" class="btn dropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="plus-icon fas fa-plus-circle"></i>
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="add-contact.php">Thêm nguồn</a>
            <a class="dropdown-item" href="list-contact.php">Danh sách</a>
          </div>
        </div>
        <div class="btn-group">
          <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $name." - ".$code ; ?>
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="add-user.php?edit=<?php echo md5($code) ; ?>">Tài khoản</a>
            <a class="dropdown-item" href="?action=logout">Thoát</a>
          </div>
        </div>
      </div>
    </nav>
    <div id="page-body" class="d-flex">