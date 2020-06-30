<html>
<head>
    <link rel='shortcut icon' href='Assets/icons/favicon.ico' type='image/x-icon'/ >
    <script src="Assets/JavaScript/jquerygen.js"></script>
    <script type="text/javascript" src="jquery.backstretch.min.js"></script>
</head>
<body>
<?php
require_once 'vendor/autoload.php';
include ("connection.php");

$name = $_GET['name'];
$email = $_GET['email'];
$station = $_GET['station'];
$domain = $_GET['domain'];

if($domain == 'booking'){
    $domain = 'BOOKING OFFICER';
}elseif($domain == 'transit') {
    $domain = 'TRANSIT OFFICER';
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

$m->Subject = 'Account Created';
$m->Body = '<p>Hi '.$name.',<br><br>You are registered in Pakistan Railways Courier Service System
<br>as '.$domain.' at '.$station.' Station
<br><br><strong>You will be notified about Account Activation within 24 hours via Email</strong>
<br><br>Regards,<br>Administration of PRCSS</p>';
$m->AltBody = 'This is the body';

echo "<h1 style='color: white ; font-family: Segoe UI;'>Account Created but not Activated !!!</h1>";

if ($m->send()){
    echo '<h3 style="color: white ; font-family: Segoe UI;">Do check your mail for account activation</h3>';
}

echo "<a style='font-family: Segoe UI; background: #006622 ; border: 1px solid white ; font-size: 25px ; color: white; text-decoration: none' href='Login.php'>OK</a>";
?>
<script type="text/javascript">
    $.backstretch("Assets/Images/pakistan.jpg", {speed: 1000});
</script>
</body>
</html>