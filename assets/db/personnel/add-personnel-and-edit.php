<?php
require "../../config/db.php";
$db = new db();
if (isset($_FILES['upload'])) {
    $file = $_FILES['upload']['tmp_name'];
    $file_open = fopen($file, "r");
    $personel = array();
    $department = array();
    $status = "ทำงาน";
    $stmt = $db->sqlQuery("SELECT * FROM department");
    $stmt->execute();
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($department, ['name' => $result['department_name'], 'id' => $result['id']]);
    }
    // while($csv = fgetcsv($file_open, ",")){

    //     $stmt = $db->sqlQuery("SELECT * FROM department WHERE `department_name` LIKE '%$csv[0]%'");
    //     $stmt->execute();
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //     echo $csv[0]." ".$csv[1]." ".$csv[3]." ".$csv[4]." ".$result['id']."<br>";
    // }
    // for($i = 0 ; $i < count($csv); $i++){
    //     echo $csv[$i];
    // }
    $flag = false;
    while (($csv = fgetcsv($file_open, ",")) !== false) {
        $dep = $csv[0];
        $jobTitle = $csv[1];
        $fisrtname = $csv[3];
        $lastname = $csv[4];
        $stmt = $db->sqlQuery("SELECT * FROM department WHERE `department_name` LIKE '%$dep%'");
        $stmt->execute();
        // $result = $stmt->fetch(PDO::FETCH_ASSOC);
        //     // echo "ชื่อ:" . $fisrtname . " นามสกุล: " . $lastname . " ตำแหน่ง: " . $jobTitle ."<br />";
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $department_id = $result['id'];
            $department_name = $result['department_name'];
            //     // if ($department[0]['name'] == $dep) {
            //     // array_push($personel, ['fname' => $fisrtname, 'lname' => $lastname, 'job' => $jobTitle, 'dep_name' => $dep]);
            //     // }
            // echo "ชื่อ:" . $fisrtname . " นามสกุล: " . $lastname . " ตำแหน่ง: " . $jobTitle . " ภาควิชา: " . $dep . " " . $department_id . "<br />";
            $stmt1 = $db->sqlQuery("INSERT INTO `personnels`(`personnel_firstname`, `personnel_lastname`, `job_title`, `status`, `department_id`) VALUES ('$fisrtname', '$lastname', '$jobTitle', '$status', '$department_id')");
            $stmt1->execute();
            //     // print_r($personel);
        }
        // }
        // foreach ($personel as $val) {
        //     echo $val['fname'] . "  " . $val['lname'] . "  " . $val['job'] . "  " . $val['dep_name'] . "<br />";
        //     // $stmt1 = $db->sqlQuery("INSERT INTO `personnels`(`personnel_firstname`, `personnel_lastname`, `job_title`, `status`, `department_id`) VALUES ('$val[fname]', '$val[lname]', '$val[job]', '$val[fname]', '$val[fname]')");
        //     // $stmt1->execute();
        // }
        // for($i = 0 ; $i < count($personel) ; $i++){
        //     for ($k = 0; $k < count($department); $k++){
        //         if($department[$k]['name'] == $personel[$i]['dep_name']){
        //             echo $personel[$i]['fname'] . "  " . $personel[$i]['lname'] . "  " . $personel[$i]['job'] . "  " . $personel[$i]['dep_name']. "  " . $department[$k]['id'] . "<br />";
        //         }
        //     }
    }
    if ($stmt1) {
        header("location: ../../../../../project/views/personnel/personnel-management.php");
    }
} else {
    if (is_null($_POST['id'])) {
        $fisrtname = $_POST['fisrtname'];
        $lastname = $_POST['lastname'];
        $jobTitle = $_POST['jobTitle'];
        $telephone = $_POST['telephone'];
        $extensionNumber = $_POST['extensionNumber'];
        $status = $_POST['status'];
        $email = $_POST['email'];
        $department_id = $_POST['departmentId'];

        $stmt = $db->sqlQuery("INSERT INTO `personnels`(`personnel_firstname`, `personnel_lastname`, `job_title`, `telephone_number`, `extension_number`, `status`, `email`, `department_id`) VALUES ('$fisrtname', '$lastname', '$jobTitle', '$telephone', '$extensionNumber', '$status', '$email', '$department_id')");
        if ($stmt->execute()) {
            header("location: ../../../../../project/views/personnel/personnel-management.php");
        }
    } else {
        $_id = $_POST['id'];
        $fname = $_POST['fisrtname'];
        $lname = $_POST['lastname'];
        $jobTitle = $_POST['jobTitle'];
        $telephone = $_POST['telephone'];
        $extensionNumber = $_POST['extensionNumber'];
        $status = $_POST['status'];
        $email = $_POST['email'];
        $department_id = $_POST['departmentId'];

        $stmt = $db->sqlQuery("UPDATE `personnels` SET `personnel_firstname`= '$fname', `personnel_lastname`= '$lname', `job_title` = '$jobTitle', `telephone_number`= '$telephone', `extension_number` = '$extensionNumber', `status`= '$status', `email`= '$email',`department_id`= '$department_id' WHERE `id`= '$_id'");
        if ($stmt->execute()) {
            header("location: ../../../../../project/views/personnel/personnel-management.php");
        }
    }
}
