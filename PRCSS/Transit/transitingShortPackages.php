<?php
include ("../connection.php");

echo $toid = $_POST['toid'];
echo $toname = $_POST['toname'];

$pwblt = $_POST['pid'];
$nop = $_POST['nop'];
$vs = $_POST['station'];
$train = $_POST['train'];
$at_station = $_POST['at_station'];
$from = $_POST["source"];
$to = $_POST["destination"];
$tp = $_POST["no_of_packages"];
$prevcode = $_POST["code"];

preg_match_all('!\d+!', $train, $matches);
$tid = implode(' ', $matches[0]);

$tdate = date("Y-m-d");
$ttime = date("H:i:s");

$code = date("YmdHis");

$sqlstflag = mysqli_query($con,"SELECT tstop_stflag FROM pr_train_stops WHERE train_code='$tid' AND tstop_name = '$at_station'");
while($flag = mysqli_fetch_array($sqlstflag)){
    $flagvalue = $flag['tstop_stflag'];
}

echo "<br>".$code."<br>" ;
$lb = $tp - $nop;

// Via Station Case //

if($to == $vs || $vs == null) {
    $sqlsending = mysqli_query($con,"INSERT INTO sending_packages(pwblt_No , sno_of_packages , from_station , to_station , train_no , transitID , transitname , senddate , sendtime , scode , stflag) VALUES ('$pwblt' , '$nop' , '$at_station' , '$to' , '$tid' , '$toid' , '$toname' , '$tdate' , '$ttime' , '$code' , '$flagvalue')");

    if ($lb > 0) {
        $sqlUpdatepending = mysqli_query($con,"UPDATE pending_packages SET no_of_packages='$lb' WHERE pwblt_No='$pwblt' AND transittype='SPS' AND code='$prevcode'");
    } else {
        $sqlDeletepending = mysqli_query($con, "DELETE FROM pending_packages WHERE pwblt_No='$pwblt' AND transittype='SPS' AND code='$prevcode'");
    }
} else {
    $sqlsending = mysqli_query($con, "INSERT INTO sending_packages(pwblt_No , sno_of_packages , from_station , to_station , train_no , transitID , transitname , senddate , sendtime , scode , stflag) VALUES ('$pwblt' , '$nop' , '$at_station' , '$vs' , '$tid' , '$toid' , '$toname' , '$tdate' , '$ttime' , '$code' , '$flagvalue')");
    $sqlpending = mysqli_query($con, "INSERT INTO pending_packages(pwblt_No , from_st , to_st , transittype , no_of_packages , code) VALUES ('$pwblt' , '$at_station' , '$vs' , 'VSR' , '$nop', '$code')");

    if ($lb > 0) {
        $sqlUpdatepending = mysqli_query($con,"UPDATE pending_packages SET no_of_packages='$lb' WHERE pwblt_No='$pwblt' AND transittype='SPS' AND code='$prevcode'");
    } else {
        $sqlDeletepending = mysqli_query($con, "DELETE FROM pending_packages WHERE pwblt_No='$pwblt' AND transittype='SPS' AND code='$prevcode'");
    }
}

header("location:sendparcel.php");
?>