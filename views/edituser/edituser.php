<?php
include "../../assets/config/db.php";
include_once "../layout/masterpage.php";

$_id = $_SESSION['userid'];
$db = new db();
$stmt = $db->sqlQuery("SELECT s.*,d.department_name FROM `staffs` AS s 
                        JOIN `department` as d ON s.department_id = d.id
                        WHERE s.id = $_id");
$stmt->execute();
$res = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div class="home-section">
    <div class="home-content">
        <h1>แก้ไขข้อมูลผู้ใช้งาน</h1>
        <form action='../../assets/db/edituser/edituser.php' method='post'>
            <input type="hidden" name='id' value=<?php echo $_id; ?>>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>ชื่อผู้ใช้งาน</label>
                    <input type='text' name='userName' class='form-control' placeholder='ชื่อ' value=<?php echo $res['username']; ?>>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>รหัสผ่าน</label>
                    <input type='text' name='password' class='form-control' placeholder='นามสกุล' value=<?php echo $res['password']; ?>>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>ชื่อ</label>
                    <input type='text' name='firstname' class='form-control' placeholder='ชื่อ' value=<?php echo $res['staff_firstname']; ?>>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>นามสกุล</label>
                    <input type='text' name='lastname' class='form-control' placeholder='นามสกุล' value=<?php echo $res['staff_lastname']; ?>>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>เบอร์โทรศัพท์</label>
                    <input type='text' name='telephone' class='form-control' placeholder='เบอร์โทรศัพท์' value=<?php echo $res['telephone']; ?>>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>อีเมล์</label>
                    <input type='text' name='email' class='form-control' placeholder='E-Mail' value=<?php echo $res['email']; ?>>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>หน่วยงาน</label>
                    <?php
                    $stmt = $db->sqlQuery("SELECT * FROM department");
                    $stmt->execute();
                    echo "<select class='form-control' name='departmentId'>";
                    echo "<option value=" . $res['department_id'] . " selected> " . $res['department_name'] . "</option>";
                    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $depId = $result['id'];
                        $depName = $result['department_name'];
                        if (strcmp($res['department_name'], $depName) == 0) {
                        } else {
                            echo "<option value='$depId'>$depName</option>";
                        }
                    }
                    echo "</select>"
                    ?>
                </div>
            </div>
            <div class='row flex justify-content-center mt-2'>
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