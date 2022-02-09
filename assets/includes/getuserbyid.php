<?php
require_once "../controller/userController.php";
$userController = new userController();
if(isset($_GET['id'])){
    echo $userController->findUserById($_GET['id']);
}
