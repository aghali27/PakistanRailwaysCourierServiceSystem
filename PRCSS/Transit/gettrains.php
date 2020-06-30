<?php
    include("../connection.php");
    session_start();
    $station = $_SESSION['station'];

    $tost = strval($_GET['tost']);
    $trains = strval($_GET['t']);

    $sqltrain = mysqli_query($con,"SELECT * FROM pr_traindir WHERE train_code IN(SELECT obj1.train_code FROM pr_train_stops obj1,pr_train_stops obj2
    WHERE obj1.train_code = obj2.train_code AND obj1.tstop_name LIKE '%$station%' AND obj2.tstop_name LIKE '%$tost%' AND
    obj1.tstop_stflag < obj2.tstop_stflag)");

    echo "<datalist id='$trains'>";
    while($row = mysqli_fetch_array($sqltrain)){
        $code = $row["train_code"];
        $name = $row["train_name"];
        $direction = $row["train_direction"];
        $origin = $row["train_origan"];
        $destination = $row["train_destination"];

        if ($direction == "DN"){
            $direction = "DOWN";
        }

        $train = $code." , ".$direction." , ".$name." , ".$origin." , ".$destination;
        echo "<option value='".$train."'>";
    }
    echo "</datalist>";
?>