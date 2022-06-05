<?php
session_start();
session_unset();
session_destroy();
header('location: ../../../../../project/views/login/login.php');
