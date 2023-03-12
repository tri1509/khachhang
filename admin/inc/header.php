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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
  <link rel="shortcut icon" href="https://nina.vn/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/responsive.css">
  <title><?php echo $title ?></title>
</head>

<body>
  <div id="warpper" class="nav-fixed">
    <nav class="topnav shadow navbar-light bg-white d-flex">
      <div class="logo">
        <img src="https://nina.vn/upload/hinhanh/logothietkewebnina-3831.webp" alt="" srcset="" width="120">
      </div>
      <div class="navbar-brand text-center">
        <a href="./">DESIGN BY M.TRÍ</a>
        <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
      </div>
      <div class="nav-right ">
        <div class="btn-group mr-auto">
          <button type="button" class="btn dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="plus-icon fas fa-plus-circle"></i>
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="add-contact.php">Thêm nguồn</a>
            <a class="dropdown-item" href="list-contact.php">Danh sách</a>
          </div>
        </div>
        <div class="btn-group">
          <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
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
      <div id="sidebar" class="bg-white">
        <ul id="sidebar-menu">
          <li class="nav-link active">
            <a href="">
              <div class="nav-link-icon d-inline-flex">
                <i class="far fa-folder"></i>
              </div>
              Khách hàng
            </a>
            <i class="arrow fas fa-angle-down"></i>
            <ul class="sub-menu">
              <li><a href="add-contact.php">Thêm mới</a></li>
              <li><a href="list-contact.php">Danh sách</a></li>
            </ul>
          </li>
          <li class="nav-link active">
            <a href="" class="link">
              <div class="nav-link-icon d-inline-flex">
                <i class="far fa-folder"></i>
              </div>
              Thành viên
            </a>
            <i class="arrow fas fa-angle-down"></i>
            <ul class="sub-menu">
              <li><a href="add-user.php">Thêm mới</a></li>
              <li><a href="list-user.php">Danh sách</a></li>
            </ul>
          </li>
          <li class="nav-link active">
            <a href="" class="link">
              <div class="nav-link-icon d-inline-flex">
                <i class="far fa-folder"></i>
              </div>
              Tiện ích
            </a>
            <i class="arrow fas fa-angle-down"></i>
            <ul class="sub-menu">
              <li><a href="calculator.php">Máy tính</a></li>
              <li><a href="todolist.php">Công việc</a></li>
            </ul>
          </li>
        </ul>
      </div>