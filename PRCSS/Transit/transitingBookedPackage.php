<?php
include ("../connection.php");

echo $toid = $_POST['toid'];
echo $toname = $_POST['toname'];

echo $pwblt = $_POST['pid'];
echo $nop = $_POST['nop'];
echo $vs = $_POST['station'];
echo $train = $_POST['train'];
echo $tp = $_POST['tp'];
echo $from = $_POST['fromst'];
echo $to = $_POST['dest'];


preg_match_all('!\d+!', $train, $matches);
$tid = implode(' ', $matches[0]);

$tdate = date("Y-m-d");
$ttime = date("H:i:s");

$code = date("YmdHis");

$sqlstflag = mysqli_query($con,"SELECT tstop_stflag FROM pr_train_stops WHERE train_code='$tid' AND tstop_name = '$from'");
while($flag = mysqli_fetch_array($sqlstflag)){
    $flagvalue = $flag['tstop_stflag'];
}

echo "<br>".$code."<br>" ;

$sqlpackage = mysqli_query($con,"UPDATE packagedetails SET status='departed' , date_departure='$tdate' WHERE pwblt_No='$pwblt'");

// Via Station Case //

if($to == $vs || $vs == null ) {
    $sqlsending = mysqli_query($con,"INSERT INTO sending_packages(pwblt_No , sno_of_packages , from_station , to_station , train_no , transitID , transitname ,senddate , sendtime , scode , stflag) VALUES ('$pwblt' , '$nop' , '$from' , '$to' , '$tid' , '$toid' , '$toname' , '$tdate' , '$ttime' , '$code' , '$flagvalue')");
} else { // Via Station Exist //
    $sqlsending = mysqli_query($con,"INSERT INTO sending_packages(pwblt_No , sno_of_packages , from_station , to_station , train_no , transitID , transitname , senddate , sendtime , scode , stflag) VALUES ('$pwblt' , '$nop' , '$from' , '$vs' , '$tid' , '$toid' , '$toname' , '$tdate' , '$ttime' , '$code' , '$flagvalue')");
    $sqlpending = mysqli_query($con,"INSERT INTO pending_packages(pwblt_No , from_st , to_st , transittype , no_of_packages , code) VALUES ('$pwblt' , '$from' , '$vs' , 'VSR' , '$nop' , '$code')");

    if(!$sqlsending){
        die(mysqli_error($con));
    }

}

// Left Behind Case //

if($tp != $nop) {
    $lb = $tp - $nop ;
    $sqlpending = mysqli_query($con,"INSERT INTO pending_packages(pwblt_No , from_st , transittype , no_of_packages , code) VALUES ('$pwblt' , '$from' , 'LB' , '$lb', '$code')");

}

header("location:sendparcel.php");

?>