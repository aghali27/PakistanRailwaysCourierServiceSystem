<?php

include ("../connection.php");
session_start();
$station = $_SESSION['station'];

$pid = $_GET['pid'];
$type = $_GET['type'];
if($type == 'id') {
    $delequery = mysqli_query($con, "DELETE FROM packagedetails WHERE pwblt_No='$pid'");
    header("location:deletehistory.php");
}elseif($type == 'all'){
    $delequery = mysqli_query($con, "DELETE FROM packagedetails WHERE source='$station' OR destination='$station'");
    header("location:deletehistory.php");
}
else {

    $delequery = mysqli_query($con, "DELETE FROM packagedetails WHERE pwblt_No='$pid'");

    if ($type = 'sent') {
        header("location:adminsenthistory.php");
    } elseif ($type == 'received') {
        header("location:adminreeivedhistory.php");
    } elseif ($type == 'booked') {
        header("location:adminbookedhistory.php");
    }
}
?>