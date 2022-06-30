<?php
include "../../assets/config/db.php";
include_once "../layout/masterpage.php";

if (isset($_GET['id'])) {
    $_id = $_GET['id'];
    $db = new db();
    $stmt = $db->sqlQuery("SELECT s.*,d.department_name FROM staffs AS s JOIN department AS d ON d.id = s.department_id  WHERE s.id = $_id");
    $stmt->execute();

    $res = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="home-section">
    <div class="home-content">
        <h1 style="padding-top: 1%;">แก้ไขข้อมูลเจ้าหน้าที่</h1>
        <form action='../../assets/db/user/add-user-and-edit.php' method='post'>
            <input type="hidden" name='id' value=<?php echo $_id; ?>>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>ชื่อผู้ใช้งาน</label>
                    <input type='text' name='username' class='form-control' placeholder='ชื่อผู้ใช้งาน' value=<?php echo $res['username']; ?>>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>รหัสผ่าน</label>
                    <input type='password' name='password' class='form-control' placeholder='รหัสผ่าน' value=<?php echo $res['password']; ?>>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>ยืนยันรหัสผ่าน</label>
                    <input type='password' name='confirmPassword' class='form-control' placeholder='ยืนยันรหัสผ่าน' value=<?php echo $res['password']; ?>>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>ชื่อ</label>
                    <input type='text' name='fisrtname' class='form-control' placeholder='ชื่อ' value=<?php echo $res['staff_firstname']; ?>>
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
                    <label>เบอร์มือถือ</label>
                    <input type='text' name='telephone' class='form-control' placeholder='เบอร์มือถือ' value=<?php echo $res['telephone']; ?>>
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
                    <label>สิทธิ์การใช้งาน</label>
                    <?php
                    $permission = ["staff", "ceo"];
                    echo " <select class='form-control' name='permission'>";
                    echo " <option value=".$res['permission']." selected>".(($res['permission'] == "staff") ? "เจ้าหน้าที่" : "ผู้บริหาร")."</option> ";
                    for ($i = 0; $i < count($permission); $i++) {
                        if (strcmp($res['permission'], $permission[$i]) == 0) {
                        } else {
                            if ($permission[$i] == "staff") {
                                echo "<option value='$permission[$i]'>เจ้าหน้าที่</option>";
                            } else {
                                echo "<option value='$permission[$i]'>ผู้บริหาร</option>";
                            }     
                        }
                    }
                    echo "</select>";
                    ?>
                </div>

            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>หน่วยงาน</label>
                    <?php
                    $stmt = $db->sqlQuery("SELECT * FROM department");
                    $stmt->execute();
                    echo "<select class='form-control' name='department_id'>";
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