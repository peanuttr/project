<?php
include "../../assets/config/db.php";
include_once "../layout/masterpage.php";

if (isset($_GET['id'])) {
    $_id = $_GET['id'];
    $db = new db();
    $stmt = $db->connect()->prepare("SELECT * FROM unit WHERE id = $_id");
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="home-section">
    <br>
    <h1>แก้ไขหน่วยนับ</h1>
    <form action='../../assets/db/unit/add-unit-and-edit.php' method='post'>
        <input type="hidden" name='id' value=<?php echo $_id; ?>>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>ชื่อหน่วยนับ</label>
                <input type='text' name='unitName' class='form-control' placeholder='ชื่อหน่วยนับ' value=<?php echo $res['unit_name']; ?>>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 20rem; width:50%;'>
            <div class='col' style='margin-left: 42%;'>
                <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก'>
            </div>
            <div class='col' style='margin-right: 37%;'>
                <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
            </div>
        </div>
    </form>
</div>