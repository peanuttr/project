<?php
require_once "../config/db.php";

class userController extends db
{

    public function helloWorld()
    {
        $text = "HelloWorld";
        echo $text;
    }

    public function getUserAll()
    {
        $stmt = $this->connect()->prepare("SELECT s.*,d.department_name FROM staffs AS s JOIN department AS d ON d.id = s.department_id");
        $stmt->execute();
        $output = "";
        $output .= "<a class='button-17' href='./user-add.php'> <span>เพิ่มเจ้าหน้าที่</span> </a>";
        $output .= "<table style='font-size:14px; width: 100%; text-align:center; border:1px;' class='table table-striped ' >
        <tr>
        <th>ชื่อ</th>
        <th>นามสกุล</th>
        <th>หน่วยงาน</th>
        <th>action</th>
        </tr>";
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $result['id'];
            $fname = $result['staff_firstname'];
            $lname = $result['staff_lastname'];
            $department = $result['department_name'];
            $output .= "<tr>
            <td>$fname</td>
            <td>$lname</td>
            <td>$department</td>
            <td>
            <a href='./user-edit.php?id=$id' class='btn btn-sm btn-success'>
            <i class='bx bx-edit'></i>
            </a> / 
            <a class='del btn btn-sm btn-danger' onclick='removeUser($id)'>
            <i class='bx bx-trash' ></i>
            </sapan>
            </td>
            </tr>";
        }
        $output .= "</table>";
        return $output;
    }

    public function findUserById($_id)
    {
        $stmt = $this->connect()->prepare("SELECT s.*,d.department_name FROM staffs AS s JOIN department AS d ON d.id = s.department_id  WHERE s.id = $_id");
        $stmt->execute();
        $output = "";
        // $output .= "<table style='font-size:14px; width: 100%; text-align:center; border:1px;' class='table table-striped ' >
        // <tr>
        // <th>ชื่อ</th>
        // <th>นามสกุล</th>
        // <th>สาขา</th>
        // </tr>";
        // while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //     $fname = $result['staff_firstname'];
        //     $lname = $result['staff_lastname'];
        //     $department = $result['department_name'];
        //     $output .=  "<tr>
        //     <td>$fname</td>
        //     <td>$lname</td>
        //     <td>$department</td>
        //     </tr>";
        // }
        // $output .= "</table>";
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = $this->connect()->prepare("SELECT * FROM department");
        $stmt->execute();
        while($dep = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($depp,['id' => $dep['id'], 'department_name' => $dep['department_name']]);
        }

        return json_encode($result);
    }

    public function deleteUserById($_id){
        $stmt = $this->connect()->prepare("DELETE FROM staffs WHERE id = $_id");
        if($stmt->execute()){
            echo "1 record have deleted";
        }
        
    }

    public function addUser($username, $password, $fname, $lname, $telephone, $email, $permission, $department_id){
        $stmt = $this->connect()->prepare("INSERT INTO `staffs`(`username`, `password`, `staff_firstname`, `staff_lastname`, `permission`, `telephone`, `email`, `department_id`) VALUES ('$username','$password','$fname','$lname','$permission','$telephone','$email','$department_id')");
        if($stmt->execute()){
            echo "1 record have insert";
        }
    }
    
    public function getDep(){
        $stmt = $this->connect()->prepare("SELECT * FROM department");
        $stmt->execute();
        $output = " ";
        $output .= "<select class='form-select' name='department_id'>";
        $output .= "<option selected>เลือก หน่วยงาน </option>";
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $depId = $result['id'];
            $depName = $result['department_name'];
            $output .= "<option value='$depId'>$depName</option>";
        }
        $output .= "</select>";
        return $output;
    }

    public function updateUser($_id ,$username, $password, $fname, $lname, $telephone, $email, $permission, $department_id){
        $stmt = $this->connect()->prepare("UPDATE `staffs` SET `username`= '$username', `password`= '$password', `staff_firstname`= '$fname', `staff_lastname`= '$lname', `permission`= '$permission', `telephone`= '$telephone',`email`= '$email',`department_id`= '$department_id' WHERE `id`= '$_id'");
        if($stmt->execute()){
            echo "1 record have update";
        }
    }
}
?>