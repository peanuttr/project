<?php
session_start();
if (empty($_SESSION['username'])) {
  header('Location: /project/views/login/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> Assetment </title>
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
  <!-- Boxiocns CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../../assets/libs/bootstrap-datepicker-thai/css/datepicker.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div id="side-bar" class="sidebar close">
    <div class="logo-details">
      <!-- <i class='bx bxl-c-plus-plus'></i> -->
      <!-- <div class="logo_name"></div> -->
      <a href="../dashboard/dashboard.php" class="logo">
        <img class="banner" src="../../assets/image/logo.png">
      </a>
    </div>
    <ul class="nav-links">
      <li>
        <?php
        if ($_SESSION['status'] == "admin" || $_SESSION['status'] == "executive") {
        ?>
          <a href="../dashboard/dashboard.php">
            <i class='bx bx-grid-alt'></i>
            <span class="link_name">รายงานครุภัณฑ์</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="../dashboard/dashboard.php">รายงานครุภัณฑ์</a></li>
          </ul>
        <?php
        }
        ?>
      </li>
      <?php
      if ($_SESSION['status'] == "staff") {
      ?>
        <li>
          <a href="../asset-detail/asset-management.php">
            <i class='bx bx-tv'></i>
            <span class="link_name">จัดการข้อมูลครุภัณฑ์</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="../asset-detail/asset-management.php">จัดการข้อมูลครุภัณฑ์</a></li>
          </ul>
        </li>
        <li>
          <div class="iocn-link">
            <a>
              <i class='bx bx-collection'></i>
              <span class="link_name">จัดการข้อมูลทั่วไป</span>
            </a>
            <i class='bx bxs-chevron-down arrow'></i>
          </div>
          <ul class="sub-menu">
            <li><a class="link_name">จัดการข้อมูลทั่วไป</a></li>
            <li><a href="../unit/unit-management.php">จัดการข้อมูลหน่วยนับ</a></li>
            <li><a href="../department/department-management.php">จัดการข้อมูลหน่วยงาน</a></li>
            <li><a href="../money-source/money-source-management.php">จัดการข้อมูลแหล่งเงิน</a></li>
            <li><a href="../assetments-type/assetments-type-management.php">จัดการข้อมูลประเภทครุภัณฑ์</a></li>
            <li><a href="../place/place-management.php">จัดการข้อมูลสถานที่</a></li>
          </ul>
        </li>
      <?php
      }
      ?>
      <li>
        <div class="iocn-link">
          <a>
            <i class='bi bi-arrow-left-right'></i>
            <span class="link_name">ยืม - คืนครุภัณฑ์</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name">ยืม - คืนครุภัณฑ์</a></li>
          <?php
          if ($_SESSION['status'] == "admin") {
          ?>
            <li><a href="../borrow-return/borrow-return-management.php">รายการยืมครุภัณฑ์</a></li>
          <?php
          }
          ?>
          <?php
          if ($_SESSION['status'] == "staff") {
          ?>
            <li><a href="../borrow-return/borrow-return-add.php">ยืมครุภัณฑ์</a></li>
            <li><a href="../borrow-return/return-asset.php">คืนครุภัณฑ์</a></li>
          <?php
          }
          ?>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a>
            <i class='bx bx-cart-alt'></i>
            <span class="link_name">จำหน่ายครุภัณฑ์</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name">จำหน่ายครุภัณฑ์</a></li>
          <?php
          if ($_SESSION['status'] == "admin") {
          ?>
            <li><a href="../sale-assetments/sale-assetment-manage.php">รายการจำหน่ายครุภัณฑ์</a></li>
          <?php
          }
          ?>
          <?php
          if ($_SESSION['status'] == "staff") {
          ?>
            <li><a href="../sale-assetments/sale-assetment-add.php">จำหน่ายครุภัณฑ์</a></li>
          <?php
          }
          ?>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a>
            <i class='bx bx-wrench'></i>
            <span class="link_name">การแจ้งซ่อม</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name">การแจ้งซ่อม</a></li>
          <?php
          if ($_SESSION['status'] == "admin") {

          ?>
            <li><a href="../repair-assetments/repair-assetments-manage.php">รายการแจ้งซ่อม</a></li>
          <?php
          }
          if ($_SESSION['status'] == "staff") {
          ?>
            <li><a href="../repair-assetments/repair-assetments-add.php">แจ้งซ่อมครุภัณฑ์</a></li>
          <?php
          }
          ?>
        </ul>
      </li>
      <?php
      if ($_SESSION['status'] == "staff") {
      ?>
        <li>
          <a href="../personnel/personnel-management.php">
            <i class='bi bi-person-fill'></i>
            <span class="link_name">จัดการบุคลากร</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="../personnel/personnel-management.php">จัดการบุคลากร</a></li>
          </ul>
        </li>
        <li>
          <a href="../edituser/edituser.php">
            <i class='bi bi-person-lines-fill'></i>
            <span class="link_name">แก้ไขข้อมูลผู้ใช้งาน</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="../edituser/edituser.php">แก้ไขข้อมูลผู้ใช้งาน</a></li>
          </ul>
        </li>
      <?php
      }
      ?>
      <?php
      if ($_SESSION['status'] == "admin") {
      ?>
        <li>
          <a href="../user/user-management.php">
            <i class='bi bi-person-workspace'></i>
            <span class="link_name">จัดการผู้ใช้งาน</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="../user/user-management.php">จัดการผู้ใช้งาน</a></li>
          </ul>
        </li>
      <?php
      }
      ?>
      <li>
        <a href="../../assets/db/login/logout-db.php">
          <i class="bi bi-box-arrow-left"></i>
          <span class="link_name">ออกจากระบบ</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../../assets/db/login/logout-db.php">ออกจากระบบ</a></li>
        </ul>
      </li>
    </ul>

  </div>
  <div class="home-section top-nav">
    <i class='bx bx-menu'></i>
    <div class="user-detail">
      <h3><?php echo $_SESSION['firstName'] ?></h3>
    </div>
  </div>

</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../assets/libs/bootstrap-datepicker-thai/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../../assets/libs/bootstrap-datepicker-thai/js/bootstrap-datepicker-thai.js"></script>
<script type="text/javascript" src="../../assets/libs/bootstrap-datepicker-thai/js/locales/bootstrap-datepicker.th.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.11.5/sorting/natural.js"></script>
<script src="../../assets/js/script.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>