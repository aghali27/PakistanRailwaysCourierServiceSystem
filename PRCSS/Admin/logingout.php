<?php
include ("../connection.php");
$user = $_GET['user'];
$station = $_GET['station'];

session_start();
session_destroy();
header("location:relogin.php?user=$user & station=$station");
?>