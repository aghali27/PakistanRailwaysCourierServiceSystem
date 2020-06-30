<html>
<head>
    <link rel='shortcut icon' href='../Assets/icons/favicon.ico' type='image/x-icon'/ >
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script type="text/javascript" src="../jquery.backstretch.min.js"></script>
</head>
<body>
<?php
require_once '../vendor/autoload.php';
include ("../connection.php");

$pid = $_GET['pid'];

$semail = "";
$sname = "";

$sqlparcel = mysqli_query($con,"SELECT * FROM packagedetails WHERE pwblt_No='$pid'");
while($rowp = mysqli_fetch_array($sqlparcel)){
    $from = $rowp['source'];
    $to = $rowp['destination'];
    $desc = $rowp['description'];
    $tnop = $rowp['total_packages'];
}

$sqlsr = mysqli_query($con,"SELECT * FROM sender_recieverdetails WHERE package_pwblt_no='$pid'");
while($rowsr = mysqli_fetch_array($sqlsr)){
    $sname = $rowsr['sender_name'];
    $semail = $rowsr['sender_email'];
    $rname = $rowsr['reciever_name'];
    $remail = $rowsr['receiver_email'];
}

echo "<h1 style='color: white; font-family: Segoe UI;'>Parcel has been Booked !!!</h1>";

$m = new PHPMailer;

$m->isSMTP();
$m->SMTPAuth = true;


$m->Host = 'smtp.gmail.com';
$m->Username = 'prcss123@gmail.com';//
$m->Password = 'prcss54321';//password of the same email;
$m->SMTPSecure = 'ssl';
$m->Port = 465;


$m->setFrom('prcss123@gmail.com', 'Pakistan Railways');
$m->addAddress($semail, $sname);
$m->addCC($remail, $rname);

$m->isHTML(true);

$m->Subject = 'Parcel Booked';
$m->Body = '<p>Your Parcel has been booked at '.$from.' Station<br><br></p>
<p>Parcel ID : '.$pid.'</p>
<p>Description : '.$desc.'</p>
<p>Sender : '.$sname.'</p>
<p>Receiver : '.$rname.'</p>
<p><strong>To track your parcel </strong></p><a href="http://localhost/PRCSS-UserSite/trackresult.php?pid='.$pid.'"/>Click Here</a>';
$m->AltBody = 'This is the body';


if ($m->send()){
    echo "<h3 style='color : white; font-family: Segoe UI;'>Email sent to Sender/Receiver</h3>";
}


echo "<a style='font-family: Segoe UI; text-decoration: none ; border: 1px solid white ; background: #006622 ; color: white; font-size: 25px;' href='bookparcel.php'>OK</a>";

echo "<script>window.open('receipt.php?pid=".$pid."');</script>";

?>
<script type="text/javascript">
    $.backstretch("../Assets/Images/pakistan.jpg", {speed: 1000});
</script>
</body>
</html>
