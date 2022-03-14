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
        <a href="../dashboard/dashboard.php">
          <i class='bx bx-grid-alt'></i>
          <span class="link_name">รายงานครุภัณฑ์</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../dashboard/dashboard.php">รายงานครุภัณฑ์</a></li>
        </ul>
      </li>
      <li>
        <a href="../borrow-return/borrow-return.php">
          <i class='bx bx-transfer-alt'></i>
          <span class="link_name">ยืม - คืน ครุภัณฑ์</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../borrow-return/borrow-return.php">ยืม - คืน ครุภัณฑ์</a></li>
        </ul>
      </li>
      <li>
        <a href="../sale-assetments/sale-assetment.php">
          <i class='bx bx-cart-alt'></i>
          <span class="link_name">จำหน่ายครุภัณฑ์</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../sale-assetments/sale-assetment.php">จำหน่ายครุภัณฑ์</a></li>
        </ul>
      </li>
      <li>
        <a href="../user/user-management.php">
          <i class='bi bi-person-workspace'></i>
          <span class="link_name">จัดการผู้ใช้งาน</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../user/user-management.php">จัดการผู้ใช้งาน</a></li>
        </ul>
      </li>
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
        </ul>
      </li>
      <li>
        <a href="../repair-assetments/repair-assetments.php">
          <i class='bx bx-cog'></i>
          <span class="link_name">แจ้งซ่อมครุภัณฑ์</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../repair-assetments/repair-assetments.php">แจ้งซ่อมครุภัณฑ์</a></li>
        </ul>
      </li>
      <li>
      </li>
    </ul>
    
  </div>
  <div class="home-section top-nav">
    <i class='bx bx-menu'></i>
    <div class="user-detail">
      <h3>user</h3>
    </div>
  </div>

</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="../../assets/js/script.js"></script>

</html>