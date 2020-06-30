<?php
require_once '../vendor/autoload.php';
include ("../connection.php");

$id = $_GET['aid'];
$status = $_GET['status'];

if($status == "false") {
    $accountquery = "UPDATE employeelogin SET status='true' WHERE id='$id'";
    mysqli_query($con,$accountquery);
} elseif($status == "true"){
    $accountquery = "UPDATE employeelogin SET status='false' WHERE id='$id'";
    mysqli_query($con,$accountquery);
}

if($accountquery) {
    echo "abc";

    $sqluser = mysqli_query($con,"SELECT * FROM employeelogin WHERE id='$id'");
    while($result = mysqli_fetch_array($sqluser)){
        $pass = $result['password'];
        $domain = $result['udomain'];
        $name = $result['uname'];
        $station = $result['workingstation'];
        $email = $result['email'];
    }

    $m = new PHPMailer;

    $m->isSMTP();
    $m->SMTPAuth = true;


    $m->Host = 'smtp.gmail.com';
    $m->Username = 'prcss123@gmail.com';//
    $m->Password = 'prcss54321';//password of the same email;
    $m->SMTPSecure = 'ssl';
    $m->Port = 465;


    $m->setFrom('prcss123@gmail.com', 'Pakistan Railways');
    $m->addAddress($email, $name);

    $m->isHTML(true);

    if ($status == 'false') {

        $m->Subject = 'Account Activated';
        $m->Body = '<p>Hi ' . $name . ',<br><br>Your account has been Activated<br>You can now login to Pakistan Railways Courier Service System
    <br>as TRANSIT OFFICER at ' . $station . ' Station
    <br><br><strong>User ID : '.$id.'</strong>
    <br><strong>Password : '.$pass.'</strong>
    <br><strong>To Login </strong><a href="http://localhost/PRCSSFinal/Login.php"/>Click Here</a>
    <br><br>Regards,<br>Administration of PRCSS</p>';
        $m->AltBody = 'This is the body';

    } elseif ($status == 'true') {

        $m->Subject = 'Account Deactivated';
        $m->Body = '<p>Hi ' . $name . ',<br><br>
    <br><br><strong>Your account has been deactivated due to some reasons <br>Contact Admin</strong>
    <br><br>Administration of PRCSS</p>';
        $m->AltBody = 'This is the body';
    }

    if ($m->send()) {
        echo 'Email sent';
    }
}

header("location:transitaccounts.php");
?>