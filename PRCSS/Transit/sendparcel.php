<?php
include ("../connection.php");
session_start();
if(!isset($_SESSION['id'])) {
    header("location:../Login.php");
}else {
    if($_SESSION['domain'] == "booking"){
        header("location:../Booking/Booking.php");
    }
}

$id = $_SESSION['id'];
$uname = $_SESSION['name'];
$udomain = $_SESSION['domain'];
$station = $_SESSION['station'];
$image = $_SESSION['img'];
$altpath = "../Assets/Icons/UserFilled.png";

$countb = 0 ;
$countlb = 0 ;
$countvs = 0 ;
$countsp = 0 ;
$countoc = 0 ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='../Assets/icons/favicon.ico' type='image/x-icon'/ >
    <title>Send Parcels</title>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../Assets/CSS/shared.css" rel="stylesheet" type="text/css">
    <link href="../Assets/CSS/sendparcel.css" rel="stylesheet" type="text/css">
    <script src="../Assets/JavaScript/shared.js" type="text/javascript"></script>
    <script>

        function showTrain(tost,t) {
            if (tost == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                    }
                };
                xmlhttp.open("GET","gettrains.php?tost="+tost+"&t="+t,true);
                xmlhttp.send();
            }
        }

        function vipeout(trn) {
            document.getElementById(trn).value = null;
        }
    </script>
</head>
<body>
<div id="wrapper" class="container-fluid">
    <div class="row">
        <div id="header">
            <div>
                <a data-toggle="tooltip" title="View Menu">
                    <div id="menubtn" onclick="changeFunction(this)">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </div>
                </a>
                <div id="logoutbtn">
                    <button class="btn1" onclick="window.location.href='../logout.php'">Logout</button>
                </div>
                <div id="content">
                    <h2 id="mainheading">PAKISTAN RAILWAYS</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="mySidenav" class="sidenav">
            <div id="profiledisplay">
                <a><img src="<?php if($image != null)  echo $image; else echo $altpath; ?>" width = 100 height = 100></a>
                <h4 class="profile"><?php echo $uname; ?></h4>
                <h4 class="profile"><?php echo $station; ?></h4>
            </div>
            <ul class="sidenavcontent">
                <li class="list"><a href="Transit.php"><span class="glyphicon glyphicon-home"></span>     Home</a></li><br><br>
                <li class="list"><a href="sendparcel.php"><span class="glyphicon glyphicon-send"></span>     Send Parcel</a></li><br><br>
                <li class="list"><a href="receiveparcels.php"><span class="glyphicon glyphicon-import"></span>     Receive Parcel</a></li><br><br>
                <li class="list" id="viewlist"><div id="viewparcel"><a style="cursor: pointer" id ="viewtext"><span class="glyphicon glyphicon-calendar"></span>     Parcel's History</a></div>
                    <div id="parcelmenu"><ul><br>
                        <li class="list"><a href="senthistory.php">Sent History</a></li>
                        <li class="list"><a href="receivehistory.php">Received History</a></li>
                        <li class="list"><a href="personalhistory.php">Officer's History</a></li>
                    </ul></div>
                </li><br><br>
                <li class="list"><a href="tsearchparcel.php"><span class="glyphicon glyphicon-search"></span>     Search Parcels</a></li><br><br>
                <li class="list"><a href="transitprofile.php" id="profiletext"><span class="glyphicon glyphicon-user"></span>     User Profile</a></li><br><br>
            </ul>
        </div>
        <div id="incontent">
            <div class="searchheading">
                <h1 id="subheading">Send Parcels</h1>
            </div>
            <nav class="nav-style" data-spy="affix" data-offset-top="50">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li><a data-toggle="tab"  href="#search">Search</a></li>
                            <li class="active"><a data-toggle="tab"  href="#booked">Booked Parcel</a></li>
                            <li><a data-toggle="tab"  href="#leftbehind">Left Behind</a></li>
                            <li><a data-toggle="tab"  href="#viastation">Via Station</a></li>
                            <li><a data-toggle="tab"  href="#shortpackages">Short Packages</a></li>
                            <li><a data-toggle="tab"  href="#overcarried">Over Carried</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="tab-content">

                <!---------------------------------  SEARCH TAB --------------------------------->

                <div id="search" class="search-panel tab-pane fade">
                    <p>Search Send Parcels</p>
                    <form class="input-group style" action="sendsearchresult.php" method="post">
                        <input type="text" class="form-control searchbar" name="pid" placeholder="Enter Parcel ID" autofocus>
                        <span class="input-group-addon search"><button class="bt" type="submit"><span class="glyphicon glyphicon-search"></span> </button></span>
                    </form>
                    <br>
                </div>

                <!---------------------------------  BOOKED PARCELS TAB --------------------------------->

                <div id="booked" class="tab-pane fade in active">

                    <div class="panel">
                        <?php

                        $bookedparelquery = "SELECT * FROM packagedetails WHERE status='booked' AND source='".$station."'";
                        $bookedresult = mysqli_query($con,$bookedparelquery);
                        $bookedparcelcount = mysqli_num_rows($bookedresult);

                        if($bookedparcelcount > 0) {
                            while($brow = mysqli_fetch_array($bookedresult)) {
                                $pid = $brow["pwblt_No"];
                                $desc = $brow["description"];
                                $nop = $brow["total_packages"];
                                $from = $brow["source"];
                                $to = $brow["destination"];
                                $risk = $brow["risk_form"];
                                $bdate = $brow["date_booked"];

                                $t = strval($countb++);
                                $sqlblstation = mysqli_query($con,"select st_desc from pr_station WHERE st_desc != '".$station."'");

                                $sqltrainall = mysqli_query($con,"SELECT * FROM pr_traindir WHERE train_code IN(SELECT obj1.train_code FROM
                                pr_train_stops obj1,pr_train_stops obj2 WHERE obj1.train_code = obj2.train_code AND obj1.tstop_name LIKE '%$from%' AND
                                obj2.tstop_name LIKE '%$to%' AND obj1.tstop_stflag < obj2.tstop_stflag)");

                                $trains = "btrains".$t;
                                $trn = "btrn".$t;

                                $bstation = "stationsb".$t;

                        echo "<section class='stylepanel'>
                        <table id='no-more-tables' class='table'>
                            <tr>
                                <th class='topstyle'>PWBLT No:</th>
                                <td data-title='PWBLT No:' class='topstyle'>".$pid."</td>
                                <th class='topstyle'>From:</th>
                                <td data-title='From:' class='topstyle'>".$from."</td>
                                <th class='topstyle'>To:</th>
                                <td data-title='To:' class='topstyle'>".$to."</td>
                            </tr>
                        </table>
                        <table id='no-more-tables' class='table details-table'>
                            <tr>
                                <th>Description :</th>
                                <td data-title='Description'>".$desc."</td>
                                <th>Packages to send :</th>
                                <td data-title='Packages to send'>".$nop."</td>
                                <th>Risk Form :</th>
                                <td data-title='Risk Form'>".$risk."</td>
                                <th>Date Booked :</th>
                                <td data-title='Date Booked'>".$bdate."</td>
                            </tr>
                        </table>
                        <form autocomplete='off' action='transitingBookedPackage.php' method='post'>
                                <input type='hidden' name='toid' value='".$id."'>
                                <input type='hidden' name='toname' value='".$uname."'>

                                <input type='hidden' name='pid' value='".$pid."'>
		                        <input type='hidden' name='dest' value='".$to."'>
		                        <input type='hidden' name='tp' value='".$nop."'>
		                        <input type='hidden' name='fromst' value='".$from."'>
                        <table class='table' id='form-table'>
                            <tr>"; ?>
                                <td><div class='input-group'><span class='input-group-addon group-label'><i>Via Station :</i></span><input list="<?php echo $bstation; ?>" onchange="showTrain(this.value,'<?php echo $trains; ?>')" onfocus="vipeout('<?php echo $trn; ?>')" class='form-control send-form' name='station' id='bstation'></div></td>
                                <?php
                                echo "<datalist id='stationsb".$t."' >";
                                while($row = mysqli_fetch_array($sqlblstation)){
                                    $name = $row["st_desc"];
                                    echo "<option value='".$name."'>";

                                }
                                echo "</datalist>";
                                ?>
                                <div id='txtHint'></div>
                                <td><div class='input-group'><span class='input-group-addon group-label'><i>Train Number :</i></span><input name="train" id="<?php echo $trn; ?>" list="<?php echo $trains; ?>" class='form-control send-form' required></div></td>
                                <?php
                                echo "<datalist id='btrains".$t."' >";
                                while($row = mysqli_fetch_array($sqltrainall)){
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
                                <td><div class='input-group'><span class='input-group-addon group-label'><i>Packages Sending :&nbsp;</i></span><input type='number' name='nop' min='1' max="<?php echo $nop; ?>" class='form-control send-form' required></div></td>
                            <?php echo "</tr>
                        </table>
                        <button type='submit' class='btn btn-block sendbtn'>SEND <span class='glyphicon glyphicon-send'></span></button>
                        </form>
                    </section>";
                        }
                    }else {
                        echo "<h4>No Booked Parcels to Send !!!</h4>";
                    }
                    ?>
                </div>

                </div>

                <!---------------------------------  LEFT BEHIND PARCELS TAB --------------------------------->

                <div id="leftbehind" class="tab-pane fade">

                    <div class="panel">
                        <?php

                        $sqlleftbeindpackages = mysqli_query($con,"SELECT pending_packages.pwblt_No, pending_packages.from_st, pending_packages.transittype,
                        pending_packages.no_of_packages , pending_packages.code , packagedetails.source , packagedetails.destination , packagedetails.description,
                        packagedetails.total_packages , packagedetails.risk_form , packagedetails.status, packagedetails.date_booked
                        FROM pending_packages JOIN packagedetails
                        ON pending_packages.pwblt_No = packagedetails.pwblt_No AND pending_packages.transittype = 'LB' AND packagedetails.source = '".$station."';");

                        $sqlleftbeindcount = mysqli_num_rows($sqlleftbeindpackages);

                        if($sqlleftbeindcount > 0) {
                        while($row = mysqli_fetch_array($sqlleftbeindpackages)){

                        $pid = $row["pwblt_No"];
                        $atst = $row["from_st"];
                        $lbnop = $row["no_of_packages"];
                        $code = $row["code"];

                        $from = $row["source"];
                        $to = $row["destination"];
                        $desc = $row["description"];
                        $tnop = $row["total_packages"];
                        $risk = $row["risk_form"];
                        $bdate = $row["date_booked"];

                        $sqlblstation = mysqli_query($con, "select st_desc from pr_station WHERE st_desc != '" . $station . "'");

                        $sqltrainall = mysqli_query($con, "SELECT * FROM pr_traindir WHERE train_code IN(SELECT obj1.train_code FROM pr_train_stops obj1,pr_train_stops obj2
                        WHERE obj1.train_code = obj2.train_code AND obj1.tstop_name LIKE '%$from%' AND obj2.tstop_name LIKE '%$to%' AND
                        obj1.tstop_stflag < obj2.tstop_stflag)");

                        $t = strval($countlb++);
                        $trains = "lbtrains" . $t;
                        $trn = "lbtrn" . $t;

                        $lbstation = "stationslb" . $t;

                        echo "<section class='stylepanel'>
                        <table id='no-more-tables' class='table'>
                            <tr>
                                <th class='topstyle'>PWBLT No:</th>
                                <td data-title='PWBLT No:' class='topstyle'>".$pid."</td>
                                <th class='topstyle'>From:</th>
                                <td data-title='From:' class='topstyle'>".$from."</td>
                                <th class='topstyle'>To:</th>
                                <td data-title='To:' class='topstyle'>".$to."</td>
                            </tr>
                        </table>
                        <table id='no-more-tables' class='table details-table'>
                            <tr>
                                <th>Description :</th>
                                <td data-title='Description'>".$desc."</td>
                                <th>Packages to send :</th>
                                <td data-title='Packages to send'>".$lbnop."</td>
                                <th>Risk Form :</th>
                                <td data-title='Risk Form'>".$risk."</td>
                                <th>Date Booked :</th>
                                <td data-title='Date Booked'>".$bdate."</td>
                            </tr>
                        </table>
                        <form autocomplete='off' action='transitingLeftBehindPackage.php' method='post'>
                            <input type='hidden' name='toid' value='".$id."'>
                            <input type='hidden' name='toname' value='".$uname."'>

                            <input type='hidden' name='pid' value='".$pid."'/>
		                    <input type='hidden' name='at_station' value='".$atst."'/>
		                    <input type='hidden' name='source' value='".$from."'/>
		                    <input type='hidden' name='destination' value='".$to."'/>
		                    <input type='hidden' name='no_of_packages' value='".$lbnop."'/>
		                    <input type='hidden' name='code' value='".$code."'/>

                        <table class='table' id='form-table'>
                            <tr>"; ?>
                            <td><div class='input-group'><span class='input-group-addon group-label'><i>Via Station :</i></span><input list="<?php echo $lbstation; ?>" name='station' onchange="showTrain(this.value,'<?php echo $trains; ?>')" onfocus="vipeout('<?php echo $trn; ?>')" class='form-control send-form' id="station"></div></td>
                            <?php
                            echo "<datalist id='stationslb".$t."' >";
                            while($row = mysqli_fetch_array($sqlblstation)){
                                $name = $row["st_desc"];
                                echo "<option value='".$name."'>";

                            }
                            echo "</datalist>";
                            ?>
                            <div id='txtHint'></div>
                            <td><div class='input-group'><span class='input-group-addon group-label'><i>Train Number :</i></span><input id="<?php echo $trn; ?>" list="<?php echo $trains; ?>" name='train' class='form-control send-form' required></div></td>
                            <?php
                            echo "<datalist id='lbtrains".$t."' >";
                            while($row = mysqli_fetch_array($sqltrainall)){
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
                            <td><div class='input-group'><span class='input-group-addon group-label'><i>Packages Sending :&nbsp;</i></span><input type='number' name='nop' min='1' max="<?php echo $lbnop; ?>" class='form-control send-form' required></div></td>
                        <?php echo "</tr>
                        </table>
                        <button type='submit' class='btn btn-block sendbtn'>SEND <span class='glyphicon glyphicon-send'></span></button>
                        </form>
                    </section>";
                            }
                    } else {
                        echo "<h4>No Left Behind Parcels to Send !!!</h4>";
                    }
                        ?>
                </div>

                </div>

                <!---------------------------------  VIA STATIONS PARCELS TAB --------------------------------->

                <div id="viastation" class="tab-pane fade">

                    <div class="panel">
                        <?php

                        $sqlviastationpackages = mysqli_query($con,"SELECT pending_packages.pwblt_No, pending_packages.from_st, pending_packages.transittype,
                        pending_packages.no_of_packages , pending_packages.code , packagedetails.source , packagedetails.destination , packagedetails.description ,
                        packagedetails.total_packages , packagedetails.risk_form , packagedetails.status, packagedetails.date_booked
                        FROM pending_packages JOIN packagedetails
                        ON pending_packages.pwblt_No = packagedetails.pwblt_No AND pending_packages.transittype = 'VSS' AND pending_packages.from_st = '".$station."';");

                        $sqlvscount = mysqli_num_rows($sqlviastationpackages);

                        if($sqlvscount > 0) {
                        while($row = mysqli_fetch_array($sqlviastationpackages)) {

                            $pid = $row["pwblt_No"];
                            $atst = $row["from_st"];
                            $vsnop = $row["no_of_packages"];
                            $code = $row["code"];

                            $from = $row["source"];
                            $to = $row["destination"];
                            $desc = $row["description"];
                            $tnop = $row["total_packages"];
                            $risk = $row["risk_form"];
                            $bdate = $row["date_booked"];

                            $sqlvsstation = mysqli_query($con, "select st_desc from pr_station WHERE st_desc != '" . $station . "' AND st_desc != '" . $from . "'");

                            $sqltrainall = mysqli_query($con, "SELECT * FROM pr_traindir WHERE train_code IN(SELECT obj1.train_code FROM
                            pr_train_stops obj1,pr_train_stops obj2 WHERE obj1.train_code = obj2.train_code AND obj1.tstop_name LIKE '%$atst%' AND
                            obj2.tstop_name LIKE '%$to%' AND obj1.tstop_stflag < obj2.tstop_stflag)");

                            $t = strval($countvs++);
                            $trains = "vstrains" . $t;
                            $trn = "vstrn" . $t;

                            $vsstation = "stationsvs".$t;

                            echo "<section class='stylepanel'>
                            <table id='no-more-tables' class='table'>
                                <tr>
                                    <th class='topstyle'>PWBLT No:</th>
                                    <td data-title='PWBLT No:' class='topstyle'>".$pid."</td>
                                    <th class='topstyle'>From:</th>
                                    <td data-title='From:' class='topstyle'>".$atst."</td>
                                    <th class='topstyle'>To:</th>
                                    <td data-title='To:' class='topstyle'>".$to."</td>
                                </tr>
                            </table>
                            <table id='no-more-tables' class='table details-table'>
                                <tr>
                                    <th>Description :</th>
                                    <td data-title='Description'>".$desc."</td>
                                    <th>Packages to send :</th>
                                    <td data-title='Packages to send'>".$vsnop."</td>
                                    <th>Risk Form :</th>
                                    <td data-title='Risk Form'>".$risk."</td>
                                    <th>Date Booked :</th>
                                    <td data-title='Date Booked'>".$bdate."</td>
                                </tr>
                            </table>
                            <form autocomplete='off' action='transitingViaStationPackage.php' method='post'>
                                <input type='hidden' name='toid' value='".$id."'>
                                <input type='hidden' name='toname' value='".$uname."'>

                                <input type='hidden' name='pid' value='".$pid."'/>
		                        <input type='hidden' name='at_station' value='".$atst."'/>
		                        <input type='hidden' name='source' value='".$from."'/>
		                        <input type='hidden' name='destination' value='".$to."'/>
		                        <input type='hidden' name='no_of_packages' value='".$vsnop."'/>
		                        <input type='hidden' name='code' value='".$code."'/>
                            <table class='table' id='form-table'>
                                <tr>"; ?>
                            <td><div class='input-group'><span class='input-group-addon group-label'><i>Via Station :&nbsp;</i></span><input class="form-control send-form" list="<?php echo $vsstation; ?>" name="station" id='bstation' onchange="showTrain(this.value,'<?php echo $trains; ?>')" onfocus="vipeout('<?php echo $trn; ?>')" ></div></td>
                            <?php
                            echo "<datalist id='stationsvs".$t."' >";
                            while($row = mysqli_fetch_array($sqlvsstation)){
                                $name = $row["st_desc"];
                                echo "<option value='".$name."'>";

                            }
                            echo "</datalist>";?>
                            <div id='txtHint'></div>
                            <td><div class='input-group'><span class='input-group-addon group-label'><i>Train Number :&nbsp;</i></span><input id="<?php echo $trn; ?>" list="<?php echo $trains; ?>" name='train' class='form-control send-form' required></div></td>
                            <?php
                            echo "<datalist id='vstrains".$t."' >";
                            while($row = mysqli_fetch_array($sqltrainall)){
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
                            <td><div class='input-group'><span class='input-group-addon group-label'><i>Packages Sending :&nbsp;</i></span><input type='number' name='nop' min='1' max="<?php echo $vsnop; ?>" class='form-control send-form' required></div></td>
                            <?php echo "</tr>
                            </table>
                            <button type='submit' class='btn btn-block sendbtn'>SEND <span class='glyphicon glyphicon-send'></span></button>
                            </form>
                        </section>";
                        }
                        }else {
                            echo "<h4>No Parcels through Via Station to Send !!!</h4>";
                        }
                        ?>
                    </div>

                </div>

                <!---------------------------------  SHORT PACKAGED PARCELS TAB --------------------------------->

                <div id="shortpackages" class="tab-pane fade">

                    <div class="panel">
                    <?php

                    $sqlshortpackages = mysqli_query($con,"SELECT pending_packages.pwblt_No, pending_packages.from_st, pending_packages.transittype,
                    pending_packages.no_of_packages , pending_packages.code , packagedetails.source , packagedetails.destination , packagedetails.description ,
                    packagedetails.total_packages , packagedetails.risk_form , packagedetails.status, packagedetails.date_booked
                    FROM pending_packages JOIN packagedetails
                    ON pending_packages.pwblt_No = packagedetails.pwblt_No AND pending_packages.transittype = 'SPS' AND pending_packages.from_st = '".$station."';");

                    $sqlspcount = mysqli_num_rows($sqlshortpackages);

                    if($sqlspcount > 0) {
                    while($row = mysqli_fetch_array($sqlshortpackages)) {

                        $pid = $row["pwblt_No"];
                        $atst = $row["from_st"];
                        $spsnop = $row["no_of_packages"];
                        $code = $row["code"];

                        $from = $row["source"];
                        $to = $row["destination"];
                        $desc = $row["description"];
                        $tnop = $row["total_packages"];
                        $risk = $row["risk_form"];
                        $bdate = $row["date_booked"];

                        $sqlvsstation = mysqli_query($con, "select st_desc from pr_station WHERE st_desc != '" . $station . "' AND st_desc != '" . $from . "'");

                        $sqltrainall = mysqli_query($con, "SELECT * FROM pr_traindir WHERE train_code IN(SELECT obj1.train_code FROM
                        pr_train_stops obj1,pr_train_stops obj2 WHERE obj1.train_code = obj2.train_code AND obj1.tstop_name LIKE '%$atst%' AND
                        obj2.tstop_name LIKE '%$to%' AND obj1.tstop_stflag < obj2.tstop_stflag)");

                        $t = strval($countsp++);
                        $trains = "sptrains" . $t;
                        $trn = "sptrn" . $t;

                        $spstation = "stationssp" . $t;

                        echo "<section class='stylepanel'>
                        <table id='no-more-tables' class='table'>
                            <tr>
                                <th class='topstyle'>PWBLT No:</th>
                                <td data-title='PWBLT No:' class='topstyle'>".$pid."</td>
                                <th class='topstyle'>From:</th>
                                <td data-title='From:' class='topstyle'>".$atst."</td>
                                <th class='topstyle'>To:</th>
                                <td data-title='To:' class='topstyle'>".$to."</td>
                            </tr>
                        </table>
                        <table id='no-more-tables' class='table details-table'>
                            <tr>
                                <th>Description :</th>
                                <td data-title='Description'>".$desc."</td>
                                <th>Packages to send :</th>
                                <td data-title='Packages to send'>".$spsnop."</td>
                                <th>Risk Form :</th>
                                <td data-title='Risk Form'>".$risk."</td>
                                <th>Date Booked :</th>
                                <td data-title='Date Booked'>".$bdate."</td>
                            </tr>
                        </table>
                        <form autocomplete='off' action='transitingShortPackages.php' method='post'>
                            <input type='hidden' name='toid' value='".$id."'>
                            <input type='hidden' name='toname' value='".$uname."'>

                            <input type='hidden' name='pid' value='".$pid."'/>
		                    <input type='hidden' name='at_station' value='".$atst."'/>
		                    <input type='hidden' name='source' value='".$from."'/>
		                    <input type='hidden' name='destination' value='".$to."'/>
		                    <input type='hidden' name='no_of_packages' value='".$spsnop."'/>
		                    <input type='hidden' name='code' value='".$code."'/>

                    <table class='table' id='form-table'>
                            <tr>"; ?>
                        <td><div class='input-group'><span class='input-group-addon group-label'><i>Via Station :</i></span><input class='form-control send-form' id="station" list="<?php echo $spstation; ?>" name="station" onchange="showTrain(this.value,'<?php echo $trains; ?>')" onfocus="vipeout('<?php echo $trn; ?>')"></div></td>
                        <?php
                        echo "<datalist id='stationssp".$t."' >";
                        while($row = mysqli_fetch_array($sqlvsstation)){
                            $name = $row["st_desc"];
                            echo "<option value='".$name."'>";

                        }
                        echo "</datalist>";
                        ?>
                        <div id='txtHint'></div>
                        <td><div class='input-group'><span class='input-group-addon group-label'><i>Train Number :</i></span><input name="train" id="<?php echo $trn; ?>" list="<?php echo $trains; ?>" class='form-control send-form' required></div></td>
                        <?php
                        echo "<datalist id='sptrains".$t."' >";
                        while($row = mysqli_fetch_array($sqltrainall)){
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
                        <td><div class='input-group'><span class='input-group-addon group-label'><i>Packages Sending :&nbsp;</i></span><input type='number' name='nop' min='1' max="<?php echo $spsnop; ?>" class='form-control send-form' required></div></td>

                        <?php echo "</tr>
                        </table>
                        <button type='submit' class='btn btn-block sendbtn'>SEND <span class='glyphicon glyphicon-send'></span></button>
                        </form>
                    </section>";
                    }
                    } else {
                        echo "<h4>No Parcels with Short Packages to Send !!!</h4>";
                    }

                        ?>
                </div>

                </div>

                <!---------------------------------  OVER CARRIED PARCELS TAB --------------------------------->

                <div id="overcarried" class="tab-pane fade">

                    <div class="panel">
                    <?php

                    $sqlovercarriedpackages = mysqli_query($con,"SELECT pending_packages.pwblt_No, pending_packages.from_st , pending_packages.to_st ,
                    pending_packages.transittype,pending_packages.no_of_packages , pending_packages.code , packagedetails.source , packagedetails.destination ,
                    packagedetails.description ,packagedetails.total_packages , packagedetails.risk_form , packagedetails.status, packagedetails.date_booked
                    FROM pending_packages JOIN packagedetails
                    ON pending_packages.pwblt_No = packagedetails.pwblt_No AND pending_packages.transittype = 'SPR' AND pending_packages.from_st = '".$station."';");

                    $sqloccount = mysqli_num_rows($sqlovercarriedpackages);

                    if($sqloccount > 0 ) {
                        while($row = mysqli_fetch_array($sqlovercarriedpackages)) {

                            $pid = $row["pwblt_No"];
                            $atst = $row["from_st"];
                            $tost = $row["to_st"];
                            $sprnop = $row["no_of_packages"];
                            $code = $row["code"];

                            $from = $row["source"];
                            $to = $row["destination"];
                            $desc = $row["description"];
                            $tnop = $row["total_packages"];
                            $risk = $row["risk_form"];
                            $bdate = $row["date_booked"];

                            $sqltrainall = mysqli_query($con, "SELECT * FROM pr_traindir WHERE train_code IN(SELECT obj1.train_code FROM pr_train_stops obj1,pr_train_stops obj2
                            WHERE obj1.train_code = obj2.train_code AND obj1.tstop_name LIKE '%$atst%' AND obj2.tstop_name LIKE '%$tost%' AND
                            obj1.tstop_stflag < obj2.tstop_stflag)");

                            $t = strval($countoc++);
                            $trains = "octrains" . $t;
                            $trn = "octrn" . $t;

                        echo "<section class='stylepanel'>
                        <table id='no-more-tables' class='table'>
                            <tr>
                                <th class='topstyle'>PWBLT No:</th>
                                <td data-title='PWBLT No:' class='topstyle'>".$pid."</td>
                                <th class='topstyle'>From:</th>
                                <td data-title='From:' class='topstyle'>".$atst."</td>
                                <th class='topstyle'>To:</th>
                                <td data-title='To:' class='topstyle'>".$tost."</td>
                            </tr>
                        </table>
                        <table id='no-more-tables' class='table details-table'>
                            <tr>
                                <th>Description :</th>
                                <td data-title='Description'>".$desc."</td>
                                <th>Packages to send :</th>
                                <td data-title='Packages to send'>".$sprnop."</td>
                                <th>Risk Form :</th>
                                <td data-title='Risk Form'>".$risk."</td>
                                <th>Date Booked :</th>
                                <td data-title='Date Booked'>".$bdate."</td>
                            </tr>
                        </table>
                        <form autocomplete='off' action='transitingOverCarriedPackages.php' method='post'>

                            <input type='hidden' name='toid' value='".$id."'>
                            <input type='hidden' name='toname' value='".$uname."'>

                            <input type='hidden' name='pid' value='".$pid."'/>
		                    <input type='hidden' name='at_station' value='".$atst."'/>
		                    <input type='hidden' name='source' value='".$from."'/>
		                    <input type='hidden' name='destination' value='".$to."'/>
		                    <input type='hidden' name='no_of_packages' value='".$sprnop."'/>
		                    <input type='hidden' name='code' value='".$code."'/>
		                    <input type='hidden' name='tostation' value='".$tost."'/>

                        <table class='table' id='form-table'>
                            <tr>";
                            if($tost == $to){?>
                            <td>
                                <div class='input-group'><span class='input-group-addon group-label'><i>To Station :&nbsp;</i></span>
                                    <select id='bstation' name='station' onchange="showTrain(this.value,'<?php echo $trains; ?>')" onfocus="vipeout('<?php echo $trn; ?>')" class='form-control send-form'>
                                        <option value="<?php echo $tost; ?>"><?php echo $tost; ?></option>
                                    </select>
                                </div>
                            </td>
                                <?php
                            } else {
                                ?>
                                <td>
                                    <div class='input-group'><span class='input-group-addon group-label'><i>To Station :&nbsp;</i></span>
                                        <select id='bstation' name='station' onchange="showTrain(this.value,'<?php echo $trains; ?>')" onfocus="vipeout('<?php echo $trn; ?>')" class='form-control send-form'>
                                            <option value="<?php echo $tost; ?>"><?php echo $tost; ?></option>
                                            <option value="<?php echo $to; ?>"><?php echo $to; ?></option>
                                        </select>
                                    </div>
                                </td>
                                <?php
                            }
                            ?>
                            <td>
                                <div id='txtHint'></div>
                                <div class='input-group'><span class='input-group-addon group-label'><i>Train Number:&nbsp;</i></span><input id="<?php echo $trn; ?>" list="<?php echo $trains; ?>" name='train' class='form-control send-form' required>
                                </div>
                                <?php
                                echo "<datalist id='octrains".$t."' >";
                                while($row = mysqli_fetch_array($sqltrainall)){
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
                            </td>
                            <td><div class='input-group'><span class='input-group-addon group-label'><i>Packages Sending :&nbsp;</i></span><input type='number' name='nop' min='1' max="<?php echo $sprnop; ?>" class='form-control send-form' required></div></td>
                        <?php echo "</tr>
                        </table>
                        <button type='submit' class='btn btn-block sendbtn'>SEND <span class='glyphicon glyphicon-send'></span></button>
                        </form>
                    </section>";
                    }
                        }else{
                        echo "<h4>No Over Carried Parcels to Send</h4>";
                    }
                        ?>
                </div>

                </div>

            </div>


            <div id="footer">
                <p id="fp">PRCSS Transit Services<a href="#" class="back-to-top"><span class="glyphicon glyphicon-chevron-up" id="fb"></span></a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>