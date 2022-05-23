<?php
include "../../assets/config/db.php";
include_once "../layout/masterpage.php";

if (isset($_GET['id'])) {
    $_id = $_GET['id'];
    $db = new db();
    $stmt = $db->sqlQuery("SELECT p.*,d.department_name FROM personnels AS p JOIN department AS d ON d.id = p.department_id  WHERE p.id = $_id");
    $stmt->execute();

    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    $dep_name = array();
    $stmt = $db->sqlQuery("SELECT * FROM department");
    $stmt->execute();
    while ($dep = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($dep_name, ['id' => $dep['id'], 'department_name' => $dep['department_name']]);
    }
}
?>
<div class="home-section">
    <div class="home-content">
        <h1>แก้ไขข้อมูลบุคลากร</h1>
        <form action='../../assets/db/personnel/add-personnel-and-edit.php' method='post'>
            <input type="hidden" name='id' value=<?php echo $_id; ?>>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>ชื่อ</label>
                    <input type='text' name='fisrtname' class='form-control' placeholder='ชื่อ' value=<?php echo $res['personnel_firstname']; ?>>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>นามสกุล</label>
                    <input type='text' name='lastname' class='form-control' placeholder='นามสกุล' value=<?php echo $res['personnel_lastname']; ?>>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>ตำแหน่ง</label>
                    <input type='text' name='jobTitle' class='form-control' placeholder='ตำแหน่ง' value=<?php echo $res['job_title']; ?>>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>เบอร์โทรศัพท์</label>
                    <input type='text' name='telephone' class='form-control' placeholder='เบอร์โทรศัพท์' value=<?php echo $res['telephone_number']; ?>>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>เบอร์โทรติดต่อภายใน</label>
                    <input type='text' name='extensionNumber' class='form-control' placeholder='เบอร์โทรติดต่อภายใน' value=<?php echo $res['extension_number']; ?>>
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
                    <label>สถานะ</label>
                    <?php
                    $status = array("ทำงานอยู่", "ลาออก");
                    echo " <select class='form-control' name='status'>";
                    echo " <option selected> " . $res['status'] . " </option> ";
                    for ($i = 0; $i < count($status); $i++) {
                        if (strcmp($res['status'], $status[$i]) == 0) {
                        } else {
                            echo "<option value='$status[$i]'>$status[$i]</option>";
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