<?php
    include ("../connection.php");

    echo $fromd = $_POST['fromdate'];
    echo "<br>".$tod = $_POST['todate'];

    echo "<br>".$formatedfd = date("Y-m-d", strtotime($fromd));
    echo "<br>".$formatedtd = date("Y-m-d", strtotime($tod));

    $deletequery = mysqli_query($con,"DELETE FROM packagedetails WHERE date_booked BETWEEN '$formatedfd' AND '$formatedtd'");

    header("location:deletehistory.php");
?>