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

$sqlstflag = mysqli_query($con,"SELECT tstop_stflag FROM pr_train_stops WHERE train_code='$tid' AND tstop_name = '$from'");
while($flag = mysqli_fetch_array($sqlstflag)){
    $flagvalue = $flag['tstop_stflag'];
}

echo "<br>".$code."<br>" ;

// Via Station Case //

if($to == $vs || $vs == null) {
    echo "<br>hello1<br>";
    $sqlsending = mysqli_query($con,"INSERT INTO sending_packages(pwblt_No , sno_of_packages , from_station , to_station , train_no , transitID , transitname , senddate , sendtime , scode , stflag) VALUES ('$pwblt' , '$nop' , '$from' , '$to' , '$tid' , '$toid' , '$toname' , '$tdate' , '$ttime' , '$code' , '$flagvalue')");
} else {
    echo "<br>hello2<br>";
    $sqlsending = mysqli_query($con,"INSERT INTO sending_packages(pwblt_No , sno_of_packages , from_station , to_station , train_no , transitID , transitname , senddate , sendtime , scode , stflag) VALUES ('$pwblt' , '$nop' , '$from' , '$vs' , '$tid' , '$toid' , '$toname' , '$tdate' , '$ttime' , '$code' , '$flagvalue')");
    $sqlpending = mysqli_query($con,"INSERT INTO pending_packages(pwblt_No , from_st , to_st , transittype , no_of_packages , code) VALUES ('$pwblt' , '$from' , '$vs' , 'VSR' , '$nop', '$code')");

    if(!$sqlsending){
        mysql_error();
    }

}

// Left Behind Case //

$lb = $tp - $nop ;
echo "<br>".$tp."<br>".$nop."<br>".$lb;


if ($lb > 0 ){
    $sqlpending = mysqli_query($con,"UPDATE pending_packages SET no_of_packages='$lb',code='$code' WHERE pwblt_No='$pwblt' AND transittype='LB' AND code='$prevcode'");
}
else {
        $sqlDeletepending = mysqli_query($con,"DELETE FROM pending_packages WHERE pwblt_No='$pwblt' AND transittype='LB' AND code='$prevcode'");
}

header("location:sendparcel.php");
?>