<?php
require_once "../controller/userController.php";
$userController = new userController();
        if (isset($_POST['id'])) {
                $id = $_POST['id'];
                echo $userController->deleteUserById($id);
        }
