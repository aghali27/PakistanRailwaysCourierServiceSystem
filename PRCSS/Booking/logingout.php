<?php
include ("../connection.php");
$uid = $_GET['uid'];

session_start();
session_destroy();
header("location:relogin.php?userid=$uid");
?>