<?php
include ("../connection.php");
error_reporting(0);

$userid = $_POST['uid'];
$userphone = $_POST['uphone'];
$uemail = $_POST['uemail'];

$imageaction = $_POST['image-action'];
$oldimage = $_POST['oldimage'];
$cnic = $_POST['cnic'];

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

if($imageaction == 'change') {
    unlink($oldimage);
    $target_dir = "../uploads/";
    $temp = explode(".",$_FILES["fileToUpload"]["name"]);
    $imgname = $cnic.'.'.end($temp);
    $target_file = $target_dir . $imgname;

    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG"
        && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . $imgname . " has been uploaded.";


            $updatequery = "UPDATE employeelogin SET password='$finalpass' , phone='$userphone' , email='$uemail' , imgname='$imgname' , imgpath='$target_file' , imgtype='$imageFileType' WHERE id='$userid'";
            $transport = mysqli_query($con, $updatequery);

            if($transport)
            {
                echo "True";
            }
            else{
                echo "False";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} elseif($imageaction == 'none') {
    $updatequery = "UPDATE employeelogin SET password='$finalpass' ,  phone='$userphone' , email='$uemail' WHERE id='$userid'";
    $transport = mysqli_query($con, $updatequery);
}elseif($imageaction == 'remove') {
    unlink($oldimage);
    $updatequery = "UPDATE employeelogin SET password='$finalpass' , phone='$userphone' , email='$uemail' , imgname='' , imgpath='' , imgtype='' WHERE id='$userid'";
    $transport = mysqli_query($con, $updatequery);
}

header("location:logingout.php?uid=$userid");
?>
