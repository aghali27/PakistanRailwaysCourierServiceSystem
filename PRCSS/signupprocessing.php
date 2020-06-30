<html>
<head>
    <link rel='shortcut icon' href='Assets/icons/favicon.ico' type='image/x-icon'/ >
    <script src="Assets/JavaScript/jquerygen.js"></script>
    <script type="text/javascript" src="jquery.backstretch.min.js"></script>
</head>
<body>
<?php
include ("connection.php");

$uname = $_POST['uname'];
$cnic = $_POST['cnic'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$cnfrmpass = $_POST['cnfrmpass'];
$udomain = $_POST['udomain'];
$station = $_POST['station'];
$imgtemp = $_FILES["fileToUpload"]["name"];


if($imgtemp != null) {

    $target_dir = "uploads/";
    $temp = explode(".",$imgtemp);
    $imgname = $cnic.'.'.end($temp);
    $target_file = $target_dir . $imgname;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG"
        && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

            $imgpath = "../".$target_file;
            $signupquery = "INSERT INTO employeelogin (password, udomain , uname , cnic , phone , workingstation , email , status , imgname , imgpath , imgtype) VALUES ('$pass' , '$udomain' , '$uname' , '$cnic' , '$phone' , '$station' , '$email' , 'false' , '$imgname' , '$imgpath' , '$imageFileType')";
            $transport = mysqli_query($con, $signupquery);

            if ($transport) {
                echo "True";
                header("location:signupmail.php?name=$uname&email=$email&station=$station&domain=$udomain");
            } else {
                echo "<h1 style='color: white ; font-family: Segoe UI;'>Account not Created !!!</h1>";
                echo "<a style='font-family: Segoe UI; background: #006622 ; border: 1px solid white ; font-size: 25px ; color: white; text-decoration: none' href='Login.php'>OK</a>";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}else {
    $signupquery = "INSERT INTO employeelogin (password, udomain , uname , cnic , phone , workingstation , email , status) VALUES ('$pass' , '$udomain' , '$uname' , '$cnic' , '$phone' , '$station' , '$email' , 'false')";
    $transport = mysqli_query($con, $signupquery);
    if ($transport) {
        echo "True";
        header("location:signupmail.php?name=$uname&email=$email&station=$station&domain=$udomain");
    } else {
        echo "<h1 style='color: white ; font-family: Segoe UI;'>Account not Created !!!</h1>";
        echo "<h3 style='color: white ; font-family: Segoe UI;'>Cnic already exists !!!</h3>";
        echo "<a style='font-family: Segoe UI; background: #006622 ; border: 1px solid white ; font-size: 25px ; color: white; text-decoration: none' href='Login.php'>OK</a>";
    }
}
?>
<script type="text/javascript">
    $.backstretch("Assets/Images/pakistan.jpg", {speed: 1000});
</script>
</body>
</html>
