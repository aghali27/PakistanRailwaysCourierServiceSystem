<?php
include ("../connection.php");

$user = $_GET['user'];
$station = $_GET['station'];
echo $user;
echo $station;

$adminloginquery = "SELECT * FROM admin WHERE username='$user' AND city='$station'";
$result = mysqli_query($con,$adminloginquery);

$numrows = mysqli_num_rows($result);
if($numrows > 0) {
    session_start();
    $_SESSION['user'] = $user;
    $_SESSION['station'] = $station;
}

header("location:Admin.php");
?>