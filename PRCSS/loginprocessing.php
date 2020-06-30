<?php
include ("connection.php");

$userid = $_GET['userid'];
$userpass = $_GET['userpass'];

$loginquery = "SELECT * FROM employeelogin WHERE id='$userid' AND password='$userpass'";
$result = mysqli_query($con,$loginquery);

$numrows = mysqli_num_rows($result);
if($numrows == 1){
    while($urow = mysqli_fetch_array($result)){
        $udomain = $urow['udomain'];
        $uname = $urow['uname'];
        $cnic = $urow['cnic'];
        $station = $urow['workingstation'];
        $status = $urow['status'];
        $path = $urow['imgpath'];
    }
    if($status == "true") {
        session_start();
        $_SESSION['id'] = $userid;
        $_SESSION['name'] = $uname;
        $_SESSION['domain'] = $udomain;
        $_SESSION['station'] = $station;
        $_SESSION['img'] = $path;

        if ($udomain == "booking") {
            echo "booking";
        } else {
            echo "transit";
        }
    } else {
        echo "Account is not Activated";
    }
}else{
    echo "Incorrect ID or PASSWORD<br>Login Failed";
}
?>