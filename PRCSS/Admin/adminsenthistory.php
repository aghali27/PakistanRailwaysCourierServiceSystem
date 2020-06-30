<?php
include ("../connection.php");
session_start();
if(!isset($_SESSION['user'])) {
    header("location:adminlogin.php");
}

$user = $_SESSION['user'];
$station = $_SESSION['station'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='../Assets/icons/favicon.ico' type='image/x-icon'/ >
    <title>Sent History</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../Assets/CSS/adminshared.css" rel="stylesheet" type="text/css">
    <link href="../Assets/CSS/adminsenthistory.css" rel="stylesheet" type="text/css">
    <script src="../Assets/JavaScript/adminshared.js" type="text/javascript"></script>
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
                    <button class="btn1" onclick="window.location.href='adminlogout.php'">Logout</button>
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
                <a><img id="user" src="../Assets/Icons/UserFilled.png" width="100" height="100"></a>
                <h4 class="profile">Admin</h4>
                <h4 class="profile"><?php echo $station ;?></h4><br>
            </div>
            <ul class="sidenavcontent">
                <li class="list"><a href="Admin.php"><span class="glyphicon glyphicon-home"></span>     Home</a></li><br>
                <li class="list"><a href="bookingaccounts.php"><span class="glyphicon glyphicon-user"></span>     Booking Acounts</a></li><br>
                <li class="list"><a href="transitaccounts.php"><span class="glyphicon glyphicon-user"></span>     Transit Accounts</a></li><br>
                <li class="list" id="viewlist"><div id="viewparcel"><a style="cursor: pointer" id ="viewtext"><span class="glyphicon glyphicon-list-alt"></span>     Parcel List</a></div>
                    <div id="parcelmenu"><ul><br>
                            <li class="list"><a href="adminsenthistory.php">Sent History</a></li>
                            <li class="list"><a href="adminreceivedhistory.php">Received Histoy</a></li>
                            <li class="list"><a href="adminbookedhistory.php">Booked History</a></li>
                        </ul></div>
                </li><br>
                <li class="list"><a href="deletehistory.php"><span class="glyphicon glyphicon-trash"></span>     Delete Parcels</a></li><br>
                <li class="list"><a href="changepass.php"><span class="glyphicon glyphicon-lock"></span>     Change Password</a></li><br>
                <li class="list"><a href="feedback.php"><span class="glyphicon glyphicon-comment"></span>     View Feedbacks</a></li><br>
            </ul>
        </div>
        <div id="incontent">
            <div class="sub-heading">
                <p id="subheading">Sent History</p>
                <center><table class="notify-table">
                    <tr>
                        <th>Current Station :</th>
                        <td><div class="c-color"></div></td>
                        <th>Other Stations :</th>
                        <td><div class="os-color"></div></td>
                    </tr>
                </table></center>
            </div>

            <section id="no-more-tables" class="tablecontainer">

                <?php

                $sqlsent = mysqli_query($con,"SELECT sending_packages.pwblt_No , sending_packages.sno_of_packages , sending_packages.from_station ,
                    sending_packages.to_station , sending_packages.train_no , sending_packages.transitID , sending_packages.transitname ,
                    sending_packages.senddate , sending_packages.sendtime , packagedetails.pwblt_No , packagedetails.description ,
                    packagedetails.source
                    FROM sending_packages JOIN packagedetails
                    ON sending_packages.pwblt_No = packagedetails.pwblt_No AND sending_packages.from_station = '$station' AND sending_packages.sendtype != 'OC'");

                $sqlsentcount = mysqli_num_rows($sqlsent);
                if($sqlsentcount > 0) {

                    echo "<table class='table table-bordered table-responsive'>
                    <thead>
                    <tr>
                        <th>PWBLT-No</th>
                        <th>Sent-Date/Time</th>
                        <th>Description</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Packages Sended</th>
                        <th>Train No.</th>
                        <th>Transit By(ID)</th>
                        <th>Officer Name</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>";

                    while($srow = mysqli_fetch_array($sqlsent)) {
                        $pid = $srow['pwblt_No'];
                        $snop = $srow['sno_of_packages'];
                        $frst = $srow['from_station'];
                        $tost = $srow['to_station'];
                        $tid = $srow['train_no'];
                        $toid = $srow['transitID'];
                        $toname = $srow['transitname'];
                        $sdate = $srow['senddate'];
                        $stime = $srow['sendtime'];
                        $src = $srow['source'];
                        $desc = $srow['description'];

                        if($src == $station) {
                            echo "<tr class='cs'>
                            <td data-title = 'PWBLT-No'>".$pid."</td>
                            <td data-title = 'Sent-Date/Time'>".$sdate." / ".$stime."</td>
                            <td data-title = 'Description'>".$desc."</td>
                            <td data-title = 'From'>".$frst."</td>
                            <td data-title = 'To'>".$tost."</td>
                            <td data-title = 'Packages Sended'>".$snop."</td>
                            <td data-title = 'Train No.'>".$tid."</td>
                            <td data-title = 'Transit By(ID)'>".$toid."</td>
                            <td data-title = 'Officer Name'>".$toname."</td>
                            <td id='btntd'><center><a href='parceldetailsa.php?pid=$pid&choice=details&type=sent'><button class='btn btn-primary btn-xs'>Details</button></a>
                                <a href='parceldetailsa.php?pid=$pid&choice=status&type=sent'><button class='btn btn-primary btn-xs'>Current Status</button></a>
                                <a href='parceldetailsa.php?pid=$pid&choice=report&type=sent'><button class='btn btn-primary btn-xs'>Delivery Report</button></a></center>
                            </td>
                            </tr>";
                        } else{
                            echo "<tr>
                            <td data-title = 'PWBLT-No'>".$pid."</td>
                            <td data-title = 'Sent-Date/Time'>".$sdate." / ".$stime."</td>
                            <td data-title = 'Description'>".$desc."</td>
                            <td data-title = 'From'>".$frst."</td>
                            <td data-title = 'To'>".$tost."</td>
                            <td data-title = 'Packages Sended'>".$snop."</td>
                            <td data-title = 'Train No.'>".$tid."</td>
                            <td data-title = 'Transit By(ID)'>".$toid."</td>
                            <td data-title = 'Officer Name'>".$toname."</td>
                            <td></td>
                            </tr>";
                        }
                    }
                } else {
                    echo "<h3>NO Record(s) to Show !!!</h3>";
                }

                ?>
                </tbody>
                </table>
            </section>

            <div id="footer">
                <p id="fp">PRCSS Admin<a href="#" class="back-to-top"><span class="glyphicon glyphicon-chevron-up" id="fb"></span></a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>