<?php
include "../../assets/config/db.php";
include_once "../layout/masterpage.php";

if (isset($_GET['id'])) {
    $_id = $_GET['id'];
    $db = new db();
    $stmt = $db->connect()->prepare("SELECT * FROM assets_types WHERE id = $_id");
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="home-section">
    <br>
    <h1>แก้ไขประเภทครุภัณฑ์</h1>
    <form action='../../assets/db/assetment-type/add-assetment-type-and-edit.php' method='post'>
        <input type="hidden" name='id' value=<?php echo $_id; ?>>
        <div class="container">
        <div class='row flex justify-content-center' style=''>
            <div class='col-6 width-50 flex justify-center'>
                <label>ชื่อประเภทครุภัณฑ์</label>
                <input type='text' name='assetmentTypeName' class='form-control' placeholder='ชื่อประเภทครุภัณฑ์' value=<?php echo $res['assets_types_name']; ?>>
            </div>
        </div>
        <div class='row flex justify-content-center mt-2'>
            <div class='col-1 d-flex justity-content-end' style=''>
                <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
            </div>
            <div class='col-1 d-flex justify-content-start' style=''>
                <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก'>
            </div>
        </div>
    </form>
</div>