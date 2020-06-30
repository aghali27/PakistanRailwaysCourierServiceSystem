<?php
require_once 'vendor/autoload.php';

$m = new PHPMailer;

$m->isSMTP();
$m->SMTPAuth = true;


$m->Host = 'smtp.gmail.com';
$m->Username = 'prcss123@gmail.com';//
$m->Password = 'prcss54321';//password of the same email;
$m->SMTPSecure = 'ssl';
$m->Port = 465;


$m->setFrom('prcss123@gmail.com', 'Pakistan Railways');
$m->addAddress('usamaw94@gmail.com', 'prcss');

$m->isHTML(true);

$m->Subject = 'Email OK!!';
$m->Body = '<p>Mailer is working</p>';
$m->AltBody = 'This is the body';


if ($m->send()){
    echo 'Email sent';
}
?>