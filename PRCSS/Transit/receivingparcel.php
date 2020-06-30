<?php
include ("../connection.php");
require_once '../vendor/autoload.php';

$roid = $_POST['roid'];
$roname = $_POST['roname'];

$flagvalue = $_POST['flagvalue'];
$rstation = $_POST['rstation'];
$rpackages = $_POST['rpackages'];
$godown = $_POST['godown'];
$pcode = $_POST['code'];
$pid = $_POST['pid'];

$recieved_packages = $_POST["recieving_packages"];
$totalPackages = $_POST["total_packages"];
$destination = $_POST["destination"];

$spackages = $_POST["no_of_packages"];
$tost = $_POST["to_station"];
$frst = $_POST["from_station"];
$sdate = $_POST["date"];
$stime = $_POST["time"];
$train_no = $_POST["train_no"];
$prevtoid = $_POST["prevtoid"];
$prevtoname = $_POST["prevtoname"];
$sendtype = $_POST['sendtype'];
$OC = $_POST['OC'];

$rdate = date("Y-m-d");
$rtime = date("H:i:s");

$code = date("YmdHis");

$shortpackages = $spackages - $rpackages;
if ($shortpackages > 0){ /// Packages  sended are NOT equal to received
    if($rstation == $tost) {  /// Receiving Station is same as Sended Station
        if($rstation == $destination){ /// Receiving Station is orignal destination
            $sqlDeletepending = mysqli_query($con,"DELETE FROM pending_packages WHERE pwblt_No='$pid' AND code='$pcode' AND transittype='VSR'");
            $sqlInsertrecieving = mysqli_query($con,"INSERT INTO recieving_packages(pwblt_No , rno_of_packages , rtrain_no , receivedate , receivetime , sended_from ,  recieved_at , rcode , godown , receiverID , receivername) VALUES ('$pid' , '$rpackages' , '$train_no' , '$rdate' , '$rtime' , '$frst' ,  '$rstation' , '$pcode' , '$godown' ,'$roid' , '$roname')");
            $sqlDeleteSending = mysqli_query($con, "UPDATE sending_packages SET sdeleterow='1' WHERE pwblt_No='$pid' AND scode='$pcode'");
            $sqlINsertSending = mysqli_query($con,"INSERT INTO sending_packages(pwblt_No , sno_of_packages , from_station , to_station , train_no , transitID , transitname , senddate , sendtime , scode , sendtype , stflag) VALUES ('$pid' , '$shortpackages' , '$frst' , '$tost' , '$train_no' , '$prevtoid' , '$prevtoname' , '$sdate' , '$stime' , '$code' , 'OC' , '$flagvalue')");
            $sqlUpdatePackagedetails = mysqli_query($con,"UPDATE packagedetails SET godown_type='$godown' WHERE pwblt_No='$pid'");

        }else { /// Receiving Station is not at destination
            $sqlDeletepending = mysqli_query($con,"DELETE FROM pending_packages WHERE pwblt_No='$pid' AND code='$pcode' AND transittype='VSR'");

            // combining all similar entries of SPS
            $tSPS = 0 ;
            $sqlpending = mysqli_query($con,"SELECT * FROM pending_packages WHERE pwblt_No='$pid' AND transittype='SPS' AND from_st='$rstation'");
            while($row = mysqli_fetch_array($sqlpending)){
                $packages = $row["no_of_packages"];
                $tSPS = $tSPS + $packages ;
            }
            $tSPS = $tSPS + $rpackages ;
            echo $tSPS;
            $sqlDeletepending = mysqli_query($con,"DELETE FROM pending_packages WHERE pwblt_No='$pid' AND transittype='SPS' AND from_st='$rstation'");

            $sqlInsertpending = mysqli_query($con,"INSERT INTO pending_packages(pwblt_No , from_st , transittype , no_of_packages , code) VALUES ('$pid' , '$rstation' , 'SPS' , '$tSPS' , '$pcode')");
            $sqlInsertrecieving = mysqli_query($con,"INSERT INTO recieving_packages(pwblt_No , rno_of_packages , rtrain_no , receivedate , receivetime , sended_from , recieved_at , rcode , godown , receiverID , receivername) VALUES ('$pid' , '$rpackages' , '$train_no' , '$rdate' , '$rtime' ,  '$frst' , '$rstation' , '$pcode' , '$godown' ,'$roid' , '$roname')");
            $sqlDeleteSending = mysqli_query($con, "UPDATE sending_packages SET sdeleterow='1' WHERE pwblt_No='$pid' AND scode='$pcode'");
            $sqlINsertSending = mysqli_query($con,"INSERT INTO sending_packages(pwblt_No , sno_of_packages , from_station , to_station , train_no , transitID , transitname , senddate , sendtime , scode , sendtype , stflag) VALUES ('$pid' , '$shortpackages' , '$frst' , '$tost' , '$train_no' , '$prevtoid' , '$prevtoname' , '$sdate' , '$stime' , '$code' , 'OC' , '$flagvalue')");
        }
    } else { /// Packages are NOT received where they are sended
        if($rstation == $destination) { /// Receiving Station is orignal destination
            $sqlDeletepending = mysqli_query($con,"DELETE FROM pending_packages WHERE pwblt_No='$pid' AND code='$pcode' AND transittype='VSR'");
            $sqlInsertrecieving = mysqli_query($con,"INSERT INTO recieving_packages(pwblt_No , rno_of_packages , rtrain_no , receivedate , receivetime , sended_from , recieved_at , rcode , godown , receiverID , receivername) VALUES ('$pid' , '$rpackages' , '$train_no' , '$rdate' , '$rtime' , '$frst' ,  '$rstation' , '$pcode' , '$godown' ,'$roid' , '$roname')");
            $sqlDeleteSending = mysqli_query($con, "UPDATE sending_packages SET sdeleterow='1' WHERE pwblt_No='$pid' AND scode='$pcode'");
            $sqlINsertSending = mysqli_query($con,"INSERT INTO sending_packages(pwblt_No , sno_of_packages , from_station , to_station , train_no , transitID , transitname , senddate , sendtime , scode , stflag) VALUES ('$pid' , '$shortpackages' , '$frst' , '$tost' , '$train_no' , '$prevtoid' , '$prevtoname' , '$sdate' , '$stime' , '$code' , 'OC' , '$flagvalue')");
            $sqlUpdatePackagedetails = mysqli_query($con,"UPDATE packagedetails SET godown_type='$godown' WHERE pwblt_No='$pid'");

        } else { /// Receiving Station is not at destination
            echo "<br>SPR1<br>";
            $sqlDeletepending = mysqli_query($con, "DELETE FROM pending_packages WHERE pwblt_No='$pid' AND code='$pcode' AND transittype='VSR'");

            $tSPR = 0;
            $sqlpending = mysqli_query($con, "SELECT * FROM pending_packages WHERE pwblt_No='$pid' AND transittype='SPR' AND from_st='$rstation' AND to_st='$tost'");
            while ($row = mysqli_fetch_array($sqlpending)) {
                $packages = $row["no_of_packages"];
                $tSPR = $tSPR + $packages;
            }
            $tSPR = $tSPR + $rpackages;
            echo $tSPR;
            $sqlDeletepending = mysqli_query($con, "DELETE FROM pending_packages WHERE pwblt_No='$pid' AND transittype='SPR' AND from_st='$rstation' AND to_st='$tost'");


            $sqlInsertpending = mysqli_query($con, "INSERT INTO pending_packages(pwblt_No ,from_st , to_st , transittype , no_of_packages , code) VALUES ('$pid' , '$rstation' , '$tost' , 'SPR' , '$rpackages' , '$pcode')");
            $sqlInsertrecieving = mysqli_query($con, "INSERT INTO recieving_packages(pwblt_No , rno_of_packages , rtrain_no , receivedate , receivetime , sended_from , recieved_at , rcode , godown , receiverID , receivername) VALUES ('$pid' , '$rpackages' , '$train_no' , '$rdate' , '$rtime' , '$frst' , '$rstation' , '$pcode' , '$godown' ,'$roid' , '$roname')");
            $sqlDeleteSending = mysqli_query($con, "UPDATE sending_packages SET sdeleterow='1' WHERE pwblt_No='$pid' AND scode='$pcode'");
            if ($OC == 'true') {
                $sqlINsertSending = mysqli_query($con, "INSERT INTO sending_packages(pwblt_No , sno_of_packages , from_station , to_station , train_no , transitID , transitname , senddate , sendtime , scode , sendtype , stflag) VALUES ('$pid' , '$shortpackages' , '$frst' , '$tost' , '$train_no' , '$prevtoid' , '$prevtoname' , '$sdate' , '$stime' , '$code' , 'OC' , '$flagvalue')");
            }else{
                $sqlINsertSending = mysqli_query($con, "INSERT INTO sending_packages(pwblt_No , sno_of_packages , from_station , to_station , train_no , transitID , transitname , senddate , sendtime , scode , sendtype , stflag) VALUES ('$pid' , '$shortpackages' , '$frst' , '$tost' , '$train_no' , '$prevtoid' , '$prevtoname' , '$sdate' , '$stime' , '$code' , 'OCB' , '$flagvalue')");
            }
        }

    }

} else { // Packages Received are Equal to Packages Sended
    if ($rstation == $tost) { /// Receiving Station is SAME as Sended Station
        if ($rstation == $destination) { /// Receiving Station is orignal destination

                $sqlDeletepending = mysqli_query($con, "DELETE FROM pending_packages WHERE pwblt_No='$pid' AND code='$pcode' AND transittype='VSR'");
                $sqlInsertrecieving = mysqli_query($con, "INSERT INTO recieving_packages(pwblt_No , rno_of_packages , rtrain_no , receivedate , receivetime , sended_from , recieved_at , rcode , godown , receiverID , receivername) VALUES ('$pid' , '$rpackages' , '$train_no' , '$rdate' , '$rtime' , '$frst' , '$rstation' , '$pcode' , '$godown' ,'$roid' , '$roname')");
                $sqlDeleteSending = mysqli_query($con, "UPDATE sending_packages SET sdeleterow='1' WHERE pwblt_No='$pid' AND scode='$pcode'");
                $sqlUpdatePackagedetails = mysqli_query($con,"UPDATE packagedetails SET godown_type='$godown' WHERE pwblt_No='$pid'");

        } else { /// Receiving Station is not at destination

            $sqlSelectpendingvsr = mysqli_query($con,"SELECT * FROM pending_packages WHERE pwblt_No='$pid' AND code='$pcode' AND transittype='VSR'");
            $existCount = mysqli_num_rows($sqlSelectpendingvsr);
            if($existCount > 0) { /// Handling VSR to VSS conversion
                $sqlInsertrecieving = mysqli_query($con, "INSERT INTO recieving_packages(pwblt_No , rno_of_packages , rtrain_no , receivedate , receivetime , sended_from , recieved_at , rcode , godown , receiverID , receivername) VALUES ('$pid' , '$rpackages' , '$train_no' , '$rdate' , '$rtime' , '$frst' , '$rstation' , '$pcode' , '$godown' ,'$roid' , '$roname')");
                $sqlDeleteSending = mysqli_query($con, "UPDATE sending_packages SET sdeleterow='1' WHERE pwblt_No='$pid' AND scode='$pcode'");
                $sqlUpdatepending = mysqli_query($con, "UPDATE pending_packages SET from_st='$rstation' , to_st='' , transittype='VSS' WHERE pwblt_No='$pid' AND code='$pcode' AND transittype='VSR'");

                $tVSS = 0;
                $sqlSelectpendingvss = mysqli_query($con, "SELECT * FROM pending_packages WHERE pwblt_No='$pid' AND transittype='VSS' AND from_st='$rstation'");
                while ($row = mysqli_fetch_array($sqlSelectpendingvss)) {
                    $packages = $row["no_of_packages"];
                    $tVSS = $tVSS + $packages;
                }
                $sqlDeletepending = mysqli_query($con, "DELETE FROM pending_packages WHERE pwblt_No='$pid' AND transittype='VSS' AND from_st='$rstation'");
                $sqlInsertpending = mysqli_query($con, "INSERT INTO pending_packages(pwblt_No , from_st , transittype , no_of_packages , code) VALUES ('$pid' , '$rstation' , 'VSS' , '$tVSS' , '$pcode')");


            } else { /// Handling SPS case and SUM UP previous SPS entries to a single entry


                $sqlInsertrecieving = mysqli_query($con, "INSERT INTO recieving_packages(pwblt_No , rno_of_packages , rtrain_no , receivedate , receivetime , sended_from , recieved_at , rcode , godown , receiverID , receivername) VALUES ('$pid' , '$rpackages' , '$train_no' , '$rdate' , '$rtime' , '$frst' , '$rstation' , '$pcode' , '$godown' ,'$roid' , '$roname')");
                $sqlDeleteSending = mysqli_query($con,"UPDATE sending_packages SET sdeleterow='1' WHERE pwblt_No='$pid' AND scode='$pcode'");

                $tSPS = 0 ;
                $sqlSelectpending = mysqli_query($con,"SELECT * FROM pending_packages WHERE pwblt_No='$pid' AND transittype='SPS' AND from_st='$rstation'");
                while($row = mysqli_fetch_array($sqlSelectpending)){
                    $packages = $row["no_of_packages"];
                    $tSPS = $tSPS + $packages ;
                }
                $tSPS = $tSPS + $rpackages ;
                echo $tSPS;
                $sqlDeletepending = mysqli_query($con,"DELETE FROM pending_packages WHERE pwblt_No='$pid' AND transittype='SPS' AND from_st='$rstation'");
                $sqlInsertpending = mysqli_query($con,"INSERT INTO pending_packages(pwblt_No , from_st , transittype , no_of_packages , code) VALUES ('$pid' , '$rstation' , 'SPS' , '$tSPS' , '$pcode')");


            }
        }
    }
    else { /// Packages are NOT received where they are sended
            if ($rstation == $destination) { /// Receiving Station is orignal destination
                $sqlDeletepending = mysqli_query($con, "DELETE FROM pending_packages WHERE pwblt_No='$pid' AND code='$pcode' AND transittype='VSR'");
                $sqlInsertrecieving = mysqli_query($con, "INSERT INTO recieving_packages(pwblt_No , rno_of_packages , rtrain_no , receivedate , receivetime , sended_from , recieved_at , rcode , godown , receiverID , receivername) VALUES ('$pid' , '$rpackages' , '$train_no' , '$rdate' , '$rtime' , '$frst' , '$rstation' , '$pcode' , '$godown' ,'$roid' , '$roname')");
                $sqlDeleteSending = mysqli_query($con, "UPDATE sending_packages SET sdeleterow='1' WHERE pwblt_No='$pid' AND scode='$pcode'");
                $sqlUpdatePackagedetails = mysqli_query($con,"UPDATE packagedetails SET godown_type='$godown' WHERE pwblt_No='$pid'");

            } else { /// Receiving Station is not at destination
                echo "<br>SPR2<br>".$rstation."<br>".$tost;
                $sqlDeletepending = mysqli_query($con,"DELETE FROM pending_packages WHERE pwblt_No='$pid' AND code='$pcode' AND transittype='VSR'");

                $tSPR = 0 ;
                $sqlpending = mysqli_query($con,"SELECT * FROM pending_packages WHERE pwblt_No='$pid' AND transittype='SPR' AND from_st='$rstation' AND to_st='$tost'");
                while($row = mysqli_fetch_array($sqlpending)){
                    $packages = $row["no_of_packages"];
                    $tSPR = $tSPR + $packages ;
                }
                $tSPR = $tSPR + $rpackages ;
                echo $tSPR;
                $sqlDeletepending = mysqli_query($con,"DELETE FROM pending_packages WHERE pwblt_No='$pid' AND transittype='SPR' AND from_st='$rstation' AND to_st='$tost'");

                $sqlInsertpending = mysqli_query($con,"INSERT INTO pending_packages(pwblt_No , from_st , to_st , transittype , no_of_packages , code) VALUES ('$pid' , '$rstation' , '$tost' , 'SPR' , '$rpackages' , '$pcode')");
                $sqlInsertrecieving = mysqli_query($con, "INSERT INTO recieving_packages(pwblt_No , rno_of_packages , rtrain_no , receivedate , receivetime , sended_from , recieved_at , rcode , godown , receiverID , receivername) VALUES ('$pid' , '$rpackages' , '$train_no' , '$rdate' , '$rtime' , '$frst' , '$rstation' , '$pcode' , '$godown' ,'$roid' , '$roname')");
                $sqlDeleteSending = mysqli_query($con,"UPDATE sending_packages SET sdeleterow='1' WHERE pwblt_No='$pid' AND scode='$pcode'");
            }
        }
}

if ($rstation == $destination) { /// Updating No. of pacakges received at destination in packagedetails Table and also changing status
    $recieved_packages = $recieved_packages + $rpackages ;
    if($recieved_packages ==  $totalPackages){
        $sqlUpdatePackage = mysqli_query($con,"UPDATE packagedetails SET recieving_packages='$recieved_packages' , status='received' , date_recieved='$rdate' WHERE pwblt_No='$pid'");
        $sqlDeleteRecieving = mysqli_query($con,"UPDATE recieving_packages SET rdeleterow='1' WHERE pwblt_No='$pid'");
        $sqlDeletepending = mysqli_query($con,"DELETE FROM pending_packages WHERE pwblt_No='$pid'");

        $sqlparcel = mysqli_query($con,"SELECT description FROM packagedetails WHERE pwblt_No='$pid'");
        while($presult = mysqli_fetch_array($sqlparcel)){
            $desc = $presult['description'];
        }

        $sqlsenderreceiver = mysqli_query($con,"SELECT sender_name,sender_email,reciever_name,receiver_email FROM sender_recieverdetails
        WHERE package_pwblt_no='$pid'");
        while($result = mysqli_fetch_array($sqlsenderreceiver)){
            $sname = $result['sender_name'];
            $semail = $result['sender_email'];
            $rname = $result['reciever_name'];
            $remail = $result['receiver_email'];
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
        $m->addAddress($remail, $rname);
        $m->addCC($semail, $sname);

        $m->isHTML(true);

        $m->Subject = 'Parcel Received';
        $m->Body = '<p>Your Parcel has been Received at '.$destination.' Station<br><br></p>
        <p>Parcel ID : '.$pid.'</p>
        <p>Description : '.$desc.'</p>
        <p>Sender : '.$sname.'</p>
        <p>Receiver : '.$rname.'</p>
        <p><strong>To View Details </strong></p><a href="http://localhost/PRCSS-UserSite/trackresult.php?pid='.$pid.'"/>Click Here</a>
        <br><br>Regards,<br>PRCSS</p>';
        $m->AltBody = 'This is the body';


        if ($m->send()){
            echo 'Email sent';
        }

    } else {
        $sqlUpdatePackage = mysqli_query($con,"UPDATE packagedetails SET recieving_packages='$recieved_packages' WHERE pwblt_No='$pid'");
        $sqlDeletepending = mysqli_query($con,"DELETE FROM pending_packages WHERE pwblt_No='$pid' AND code='$pcode' AND transittype != 'LB'");
    }
}
header ("location:receiveparcellist.php?train=$train_no");
?>