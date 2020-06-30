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

$train = $_GET["train"];

preg_match_all('!\d+!', $train, $matches);
$tid = implode(' ', $matches[0]);

$sqlstflag = mysqli_query($con,"SELECT tstop_stflag FROM pr_train_stops WHERE train_code='$tid' AND tstop_name LIKE '%$station%'");
while($flag = mysqli_fetch_array($sqlstflag)){
    $flagvalue = $flag['tstop_stflag'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='../Assets/icons/favicon.ico' type='image/x-icon'/ >
    <title>Received Parcel List</title>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../Assets/CSS/shared.css" rel="stylesheet" type="text/css">
    <link href="../Assets/CSS/receiveparcellist.css" rel="stylesheet" type="text/css">
    <script src="../Assets/JavaScript/shared.js" type="text/javascript"></script>
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
            <?php
                $sqlcheckstation = mysqli_query($con, "SELECT * FROM pr_train_stops WHERE train_code='$tid' AND tstop_name LIKE '%$station%'");
                $countcheck = mysqli_num_rows($sqlcheckstation);

            if($countcheck <= 0) {
                echo "<h1>Current Station (" . $station . ") Doesn't exist in the Route of Train No. " . $tid . "</h1></br>";
            }else {
                echo "<div class='sub-heading'>
                <p id='subheading'>Parcel Arrival List From Train no. " . $tid . "</p>
                <center>
                    <form class='input-group style' action='searchedreceiveparcels.php' method='get'>
                        <input id='main-search' type='text' class='form-control searchbar' name='pid' placeholder='Search Parcel (Enter PWBLT No.)'>
                        <input type='hidden' name='tid' value='$tid'>
                        <span class='input-group-addon'><button type='submit' class='bt'><span class='glyphicon glyphicon-search'></span> </button></span>
                    </form>
                </center>
                <center><table class='notify-table'>
                    <tr>
                        <th>Current Station :</th>
                        <td><div class='c-color'></div></td>
                        <th>Over Carried :</th>
                        <td><div class='oc-color'></div></td>
                        <th>Others :</th>
                        <td><div class='o-color'></div></td>
                    </tr>
                </table></center>
            </div>

            <div class='panel-container'>";

                $sqlreceivedlist = mysqli_query($con, "SELECT sending_packages.pwblt_No, sending_packages.sno_of_packages,
                sending_packages.from_station ,sending_packages.to_station, sending_packages.train_no , sending_packages.senddate ,
                sending_packages.sendtime , sending_packages.scode, sending_packages.sendtype , sending_packages.transitID ,
                sending_packages.transitname , packagedetails.source ,packagedetails.destination ,packagedetails.description ,
                packagedetails.total_packages ,packagedetails.risk_form ,packagedetails.recieving_packages
                FROM sending_packages JOIN packagedetails
                ON sending_packages.pwblt_No = packagedetails.pwblt_No AND sending_packages.train_no = '$tid' AND
                sending_packages.sdeleterow='0' AND sending_packages.from_station != '$station' AND sending_packages.stflag < '$flagvalue'");


            while($row = mysqli_fetch_array($sqlreceivedlist)) {

                $pid = $row["pwblt_No"];
                $spackages = $row["sno_of_packages"];
                $from = $row["from_station"];
                $tost = $row["to_station"];
                $train_no = $row["train_no"];
                $ddate = $row["senddate"];
                $dtime = $row["sendtime"];
                $code = $row["scode"];
                $sendtype = $row["sendtype"];
                $transitID = $row["transitID"];
                $transitname = $row["transitname"];

                $source = $row["source"];
                $dest = $row["destination"];
                $desc = $row["description"];
                $tpackages = $row["total_packages"];
                $risk = $row["risk_form"];
                $receivedpackages = $row["recieving_packages"];

                $sqlrdstation = mysqli_query($con, "SELECT tstop_stflag FROM pr_train_stops WHERE train_code= '$tid' AND tstop_name LIKE '%$tost%' LIMIT 1");
                while ($rdrow = mysqli_fetch_array($sqlrdstation)) {
                    $rstationflag = $rdrow['tstop_stflag'];
                }

                $sqlcrstation = mysqli_query($con, "SELECT tstop_stflag FROM pr_train_stops WHERE train_code= '$tid' AND tstop_name LIKE '%$station%' LIMIT 1");
                while ($crrow = mysqli_fetch_array($sqlcrstation)) {
                    $crstationflag = $crrow['tstop_stflag'];
                }
                $OC = 'false';


                ////////////////////////////////// Current Station //////////////////////////////////

                if ($tost == $station) {
                    $OC = 'true';
                    echo "<div class='panel'>
                    <section class='stylepanel cspanel'>
                        <table id='no-more-tables' class='table'>
                            <tr>
                                <th class='topstyle'>PWBLT No:</th>
                                <td data-title='PWBLT No:' class='topstyle'>".$pid."</td>
                                <th class='topstyle'>From:</th>
                                <td data-title='From:' class='topstyle'>".$from."</td>
                                <th class='topstyle'>To:</th>
                                <td data-title='To:' class='topstyle'>".$tost."</td>
                            </tr>
                        </table>
                        <table id='no-more-tables' class='table details-table'>
                            <tr>
                                <th>Description :</th>
                                <td data-title='Description'>".$desc."</td>
                                <th>Packages Sended :</th>
                                <td data-title='Packages to send'>".$spackages."</td>
                                <th>Risk Form :</th>
                                <td data-title='Risk Form'>".$risk."</td>
                                <th>Departure Date :</th>
                                <td data-title='Departure Date'>".$ddate."</td>
                            </tr>
                        </table>
                        <form action='receivingparcel.php' method='POST'>
                            <table class='table' id='form-table'>
                                <tr>
                                    <td><div class='input-group'><span class='input-group-addon group-label cs'><i>Packages Recevied :&nbsp;</i></span><input type='number' class='form-control receive-form' name='rpackages' id='nop' min='1' max='".$spackages."' required></div></td>
                                    <td>
                                        <div class='input-group'><span class='input-group-addon group-label cs'><i>Select Godown Type :&nbsp;</i></span>
                                            <select id='bstation' name='godown' class='form-control receive-form' required>
                                                <option value='No Godown Seected'>--</option>
                                                <option value='Head Dispatcher'>Head Dispatcher</option>
                                                <option value='Foriegn Godown'>Foriegn Godown</option>
                                                <option value='Local Godown'>Local Godown</option>
                                                <option value='Fruit Godown'>Fruit Godown</option>
                                                <option value='Transit Godown'>Transit Godown</option>
                                            </select>
                                        </div>
                                    </td>
                                    <input type='hidden' name='rstation' value='$station' />
                                    <input type='hidden' name ='flagvalue' value='$flagvalue' />
                                    <input type='hidden' name='roid' value='" . $id . "' />
                                    <input type='hidden' name='roname' value='" . $uname . "' />

	                                <input type='hidden' name='code' value='" . $code . "' />
	                                <input type='hidden' name='pid' value='" . $pid . "' />

	                                <input type='hidden' name='recieving_packages' value='" . $receivedpackages . "' />
	                                <input type='hidden' name='total_packages' value='" . $tpackages . "' />
	                                <input type='hidden' name='destination' value='" . $dest . "' />

                                    <input type='hidden' name='no_of_packages' value='" . $spackages . "' />
                                    <input type='hidden' name='to_station' value='" . $tost . "' />
                                    <input type='hidden' name='from_station' value='" . $from . "' />
                                    <input type='hidden' name='date' value='" . $ddate . "' />
                                    <input type='hidden' name='time' value='" . $dtime . "' />
                                    <input type='hidden' name='train_no' value='" . $train_no . "' />
                                    <input type='hidden' name='prevtoid' value='" . $transitID . "' />
                                    <input type='hidden' name='prevtoname' value='" . $transitname . "' />
                                    <input type='hidden' name='sendtype' value='" . $sendtype . "' />
                                    <input type='hidden' name='OC' value='" . $OC . "' />
                                </tr>
                            </table>
                            <button type='submit' class='btn btn-block receivebtn'>Receive <span class='glyphicon glyphicon-import'></span></button>
                        </form>
                    </section>
                </div>";
                }

                ////////////////////////////////// Over Carried //////////////////////////////////

                elseif($crstationflag > $rstationflag) {
                    echo "<div class='panel'>
                    <section class='stylepanel ocpanel'>
                        <table id='no-more-tables' class='table'>
                            <tr>
                                <th class='topstyle'>PWBLT No:</th>
                                <td data-title='PWBLT No:' class='topstyle'>".$pid."</td>
                                <th class='topstyle'>From:</th>
                                <td data-title='From:' class='topstyle'>".$from."</td>
                                <th class='topstyle'>Over Carried From:</th>
                                <td data-title='To:' class='topstyle'>".$tost."</td>
                            </tr>
                        </table>
                        <table id='no-more-tables' class='table details-table'>
                            <tr>
                                <th>Description :</th>
                                <td data-title='Description'>".$desc."</td>
                                <th>Packages Sended :</th>
                                <td data-title='Packages to send'>".$spackages."</td>
                                <th>Risk Form :</th>
                                <td data-title='Risk Form'>".$risk."</td>
                                <th>Departure Date :</th>
                                <td data-title='Departure Date'>".$ddate."</td>
                            </tr>
                        </table>
                        <form action='receivingparcel.php' method='POST'>
                            <table class='table' id='form-table'>
                                <tr>
                                    <td><div class='input-group'><span class='input-group-addon group-label oc'><i>Packages Recevied :&nbsp;</i></span><input type='number' class='form-control receive-form' name='rpackages' id='nop' min='1' max='".$spackages."' required></div></td>
                                    <td>
                                        <div class='input-group'><span class='input-group-addon group-label oc'><i>Select Godown Type :&nbsp;</i></span>
                                            <select id='bstation' name='godown' class='form-control receive-form' required>
                                                <option value='No Godown Seected'>--</option>
                                                <option value='Head Dispatcher'>Head Dispatcher</option>
                                                <option value='Foriegn Godown'>Foriegn Godown</option>
                                                <option value='Local Godown'>Local Godown</option>
                                                <option value='Fruit Godown'>Fruit Godown</option>
                                                <option value='Transit Godown'>Transit Godown</option>
                                            </select>
                                        </div>
                                    </td>
                                    <input type='hidden' name='rstation' value='$station' readonly>
                                    <input type='hidden' name='roid' value='" . $id . "' />
                                    <input type='hidden' name='roname' value='" . $uname . "' />

	                                <input type='hidden' name='code' value='" . $code . "' />
	                                <input type='hidden' name='pid' value='" . $pid . "' />

	                                <input type='hidden' name='recieving_packages' value='" . $receivedpackages . "' />
	                                <input type='hidden' name='total_packages' value='" . $tpackages . "' />
	                                <input type='hidden' name='destination' value='" . $dest . "' />

                                    <input type='hidden' name='no_of_packages' value='" . $spackages . "' />
                                    <input type='hidden' name='to_station' value='" . $tost . "' />
                                    <input type='hidden' name='from_station' value='" . $from . "' />
                                    <input type='hidden' name='date' value='" . $ddate . "' />
                                    <input type='hidden' name='time' value='" . $dtime . "' />
                                    <input type='hidden' name='train_no' value='" . $train_no . "' />
                                    <input type='hidden' name='prevtoid' value='" . $transitID . "' />
                                    <input type='hidden' name='prevtoname' value='" . $transitname . "' />
                                    <input type='hidden' name='sendtype' value='" . $sendtype . "' />
                                    <input type='hidden' name='OC' value='" . $OC . "' />
                                </tr>
                            </table>
                            <button type='submit' class='btn btn-block receivebtn'>Receive <span class='glyphicon glyphicon-import'></span></button>
                        </form>
                    </section>
                </div>";
                }

                ////////////////////////////////// Other Stations //////////////////////////////////

                else {
                    echo "<div class='panel'>
                    <section class='stylepanel'>
                        <table id='no-more-tables' class='table'>
                            <tr>
                                <th class='topstyle'>PWBLT No:</th>
                                <td data-title='PWBLT No:' class='topstyle'>".$pid."</td>
                                <th class='topstyle'>From:</th>
                                <td data-title='From:' class='topstyle'>".$from."</td>
                                <th class='topstyle'>To:</th>
                                <td data-title='To:' class='topstyle'>".$tost."</td>
                            </tr>
                        </table>
                        <table id='no-more-tables' class='table details-table'>
                            <tr>
                                <th>Description :</th>
                                <td data-title='Description'>".$desc."</td>
                                <th>Packages Sended :</th>
                                <td data-title='Packages to send'>".$spackages."</td>
                                <th>Risk Form :</th>
                                <td data-title='Risk Form'>".$risk."</td>
                                <th>Departure Date :</th>
                                <td data-title='Departure Date'>".$ddate."</td>
                            </tr>
                        </table>
                        <form action='receivingparcel.php' method='POST'>
                            <table class='table' id='form-table'>
                                <tr>
                                    <td><div class='input-group'><span class='input-group-addon group-label o'><i>Packages Recevied :&nbsp;</i></span><input type='number' class='form-control receive-form' name='rpackages' id='nop' min='1' max='".$spackages."' required></div></td>
                                    <td>
                                        <div class='input-group'><span class='input-group-addon group-label o'><i>Select Godown Type :&nbsp;</i></span>
                                            <select id='bstation' name='godown' class='form-control receive-form' required>
                                                <option value='No Godown Seected'>--</option>
                                                <option value='Head Dispatcher'>Head Dispatcher</option>
                                                <option value='Foriegn Godown'>Foriegn Godown</option>
                                                <option value='Local Godown'>Local Godown</option>
                                                <option value='Fruit Godown'>Fruit Godown</option>
                                                <option value='Transit Godown'>Transit Godown</option>
                                            </select>
                                        </div>
                                    </td>
                                    <input type='hidden' name='rstation' value='$station' readonly>
                                    <input type='hidden' name='roid' value='" . $id . "' />
                                    <input type='hidden' name='roname' value='" . $uname . "' />

	                                <input type='hidden' name='code' value='" . $code . "' />
	                                <input type='hidden' name='pid' value='" . $pid . "' />

	                                <input type='hidden' name='recieving_packages' value='" . $receivedpackages . "' />
	                                <input type='hidden' name='total_packages' value='" . $tpackages . "' />
	                                <input type='hidden' name='destination' value='" . $dest . "' />

                                    <input type='hidden' name='no_of_packages' value='" . $spackages . "' />
                                    <input type='hidden' name='to_station' value='" . $tost . "' />
                                    <input type='hidden' name='from_station' value='" . $from . "' />
                                    <input type='hidden' name='date' value='" . $ddate . "' />
                                    <input type='hidden' name='time' value='" . $dtime . "' />
                                    <input type='hidden' name='train_no' value='" . $train_no . "' />
                                    <input type='hidden' name='prevtoid' value='" . $transitID . "' />
                                    <input type='hidden' name='prevtoname' value='" . $transitname . "' />
                                    <input type='hidden' name='sendtype' value='" . $sendtype . "' />
                                    <input type='hidden' name='OC' value='" . $OC . "' />
                                </tr>
                            </table>
                            <button type='submit' class='btn btn-block receivebtn' >Receive <span class='glyphicon glyphicon-import'></span></button>
                        </form>
                    </section>
                </div>";
                }
            }
            }

                ?>

            </div>


            <div id="footer">
                <p id="fp">PRCSS Transit Services<a href="#" class="back-to-top"><span class="glyphicon glyphicon-chevron-up" id="fb"></span></a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>