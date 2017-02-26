<?php

$user_check = $_SESSION['user_login'];

if (!isset($_SESSION['user_login'])) {
    header("location:index.php");
}

?>
