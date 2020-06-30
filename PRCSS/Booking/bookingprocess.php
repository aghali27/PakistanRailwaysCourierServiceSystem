<html>
<head>
    <link rel='shortcut icon' href='../Assets/icons/favicon.ico' type='image/x-icon'/ >
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script type="text/javascript" src="../jquery.backstretch.min.js"></script>
</head>
<body>
<?php
    include ("../connection.php");

    $b_officer_id = $_POST['boid'];
    $boname = $_POST['boname'];
    $pwblt = $_POST['pid'];
    $source = $_POST['fst'];
    $destination = $_POST['tst'];
    $no_of_packages = $_POST['pnumber'];
    $description = $_POST['des'];
    $weightkg = $_POST['wkg'];
    $weighttn = $_POST['wtn'];
    $value_of_package = $_POST['pvalue'];
    $risk_form = $_POST['risktype'];
    $cash_paid=$_POST['cash'];

    $sname = $_POST['sname'];
    $saddress = $_POST['saddress'];
    $scnic = $_POST['scnic'];
    $sphone = $_POST['sphone'];
    $semail = $_POST['semail'];

    $rname = $_POST['rname'];
    $raddress = $_POST['raddress'];
    $rcnic = $_POST['rcnic'];
    $rphone = $_POST['rphone'];
    $remail = $_POST['remail'];

    $status = "booked";

    $date_booked = date("Y-m-d");
    $time_booked = date("H:i:s");

    $sql = mysqli_query($con,"INSERT INTO packagedetails(pwblt_No , source , destination , description , total_packages , weightkg , weightton , value_of_package , risk_form , cash_paid , date_booked , time_booked, booking_officer_id , b_officer_name , status) VALUES ('$pwblt' , '$source' , '$destination' , '$description' , '$no_of_packages' , '$weightkg' , '$weighttn' , '$value_of_package' , '$risk_form' , '$cash_paid' , '$date_booked' ,  '$time_booked' , '$b_officer_id' , '$boname' , '$status')");

    if($sql){
    $sql1 = mysqli_query($con,"INSERT INTO sender_recieverdetails(package_pwblt_no , sender_name , sender_address , sender_cnic , sender_phone , sender_email , reciever_name , reciever_address , reciever_cnic , reciever_phone , receiver_email) VALUES ('$pwblt' , '$sname' , '$saddress' , '$scnic' , '$sphone' , '$semail' , '$rname' , '$raddress' , '$rcnic' , '$rphone' , '$remail')");
    header("location:bookparcelmail.php?pid=$pwblt");
    }else{
        echo "<h1 style='color: rgba(240, 188, 174, 0.95); font-family: Segoe UI;'>Parcel is not Booked !!!</h1>";
        echo "<a style='font-family: Segoe UI; text-decoration: none ; border: 1px solid white ; background: #006622 ; color: white; font-size: 25px;' href='bookparcel.php'>OK</a>";
    }


?>
<script type="text/javascript">
    $.backstretch("../Assets/Images/pakistan.jpg", {speed: 1000});
</script>
</body>
</html>
