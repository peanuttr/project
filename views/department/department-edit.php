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
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>ชื่อหน่วยงาน</label>
                <input type='text' name='departmentName' class='form-control' placeholder='ชื่อหน่วยงาน' value=<?php echo $res['department_name']; ?>>
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
    
</div>