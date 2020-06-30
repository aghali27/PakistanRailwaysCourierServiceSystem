<?php
include ("../connection.php");

$uid = $_GET['userid'];
echo $uid;

$loginquery = "SELECT * FROM employeelogin WHERE id='$uid'";
$result = mysqli_query($con,$loginquery);

while($urow = mysqli_fetch_array($result)){
    $udomain = $urow['udomain'];
    $uname = $urow['uname'];
    $cnic = $urow['cnic'];
    $station = $urow['workingstation'];
    $status = $urow['status'];
    $path = $urow['imgpath'];
}

session_start();
$_SESSION['id'] = $uid;
$_SESSION['name'] = $uname;
$_SESSION['domain'] = $udomain;
$_SESSION['station'] = $station;
$_SESSION['img'] = $path;

header("location:bookingprofile.php");

?>