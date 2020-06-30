<?php
    include ("../connection.php");

    $user = $_POST['user'];
    $station = $_POST['station'];

    $originalpass = $_POST['originalpass'];
    $currentpass = $_POST['currentpass'];
    $newpass = $_POST['newpass'];
    $confirmpass = $_POST['confirmpass'];

    if($originalpass == $currentpass){
    $oldconfirmpass = $originalpass;
    if($newpass == $confirmpass && $newpass != null){
        $newconfirmpass = $newpass;
        if($oldconfirmpass != $newconfirmpass){
            $finalpass = $newpass;
        }else{
            $finalpass = $originalpass;
        }
    }else{
        $finalpass = $originalpass;
    }

    }else{
    $finalpass = $originalpass;
    }

    $sqlchangepass = mysqli_query($con,"UPDATE admin SET password = '$finalpass'");

    header("location:logingout.php?user=$user & station=$station");

?>