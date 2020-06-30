<?php
include ("../connection.php");

$adminid = $_GET['adminid'];
$adminst = $_GET['adminst'];
$adminpass = $_GET['adminpass'];

$adminloginquery = "SELECT * FROM admin WHERE username='$adminid' AND password='$adminpass' AND city='$adminst'";
$result = mysqli_query($con,$adminloginquery);

$numrows = mysqli_num_rows($result);
if($numrows > 0){
    session_start();
    $_SESSION['user'] = $adminid;
    $_SESSION['station'] = $adminst;

    echo "true";
}else {
    echo "Incorrect USER, PASSWORD or CITY<br>Login Failed";
}
?>