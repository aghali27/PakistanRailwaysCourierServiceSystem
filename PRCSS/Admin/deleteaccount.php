<?php
require_once '../vendor/autoload.php';
include ("../connection.php");

$id = $_GET['uid'];
$domain = $_GET['domain'];

echo $id;
$sqluser = mysqli_query($con,"SELECT * FROM employeelogin WHERE id='$id'");
$delete = mysqli_query($con,"DELETE FROM employeelogin WHERE id='$id'");

if($delete) {

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

        $m->Subject = 'Account Deleted';
        $m->Body = '<p>Hi ' . $name . ',<br><br><strong>Your account has been Deleted<br>
        Contact Admin for enquiry</strong>
        <br><br>Administration of PRCSS</p>';
        $m->AltBody = 'This is the body';


    if ($m->send()) {
        echo 'Email sent';
    }
}

if($domain == 'booking'){
    header("location:bookingaccounts.php");
}elseif($domain == 'transit'){
    header("location:transitaccounts.php");
}

?>