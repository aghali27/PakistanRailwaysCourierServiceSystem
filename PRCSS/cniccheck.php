<?php
    include ("connection.php");
    $cnic = $_GET['cnic'];

    $sqlcheckcnic = mysqli_query($con,"SELECT * FROM employeelogin WHERE cnic='$cnic'");
    $chceckcount  = mysqli_num_rows($sqlcheckcnic);
    if($chceckcount > 0){
        echo "cnicnotok";
    }else{
        echo "cnicok";
    }
?>