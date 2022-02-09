<?php
require_once "../controller/userController.php";
$userController = new userController();
echo $userController->getUserAll();
?>