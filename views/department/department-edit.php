<?php
include "../../assets/config/db.php";
include_once "../layout/masterpage.php";

if (isset($_GET['id'])) {
    $_id = $_GET['id'];
    $db = new db();
    $stmt = $db->sqlQuery("SELECT * FROM department WHERE id = $_id");
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="home-section">
    <div class="home-content">
        <h1>แก้ไขหน่วยงาน</h1>
        <form action='../../assets/db/department/add-department-and-edit.php' method='post'>
            <input type="hidden" name='id' value=<?php echo $_id; ?>>
            <div class='row flex justify-content-center'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>ชื่อหน่วยงาน</label>
                    <input type='text' name='departmentName' class='form-control' placeholder='ชื่อหน่วยงาน' value=<?php echo $res['department_name']; ?>>
                </div>
            </div>
            <div class='row flex justify-content-center mt-2' style="padding-top: 20px">
                <div class='col-1 d-flex justify-content-start'>
                    <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
                </div>
                <div class='col-1 d-flex justity-content-end'>
                    <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก'>
                </div>
            </div>
        </form>
    </div>

</div>