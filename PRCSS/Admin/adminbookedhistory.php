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
    <title>Booked History</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../Assets/CSS/adminshared.css" rel="stylesheet" type="text/css">
    <link href="../Assets/CSS/adminbookedhistory.css" rel="stylesheet" type="text/css">
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
                <p id="subheading">Booked History</p>
            </div>

            <section id="no-more-tables" class="tablecontainer">
                <?php

                $sqlallparcel = mysqli_query($con,"SELECT * FROM packagedetails WHERE 	source='$station'");
                $allcount = mysqli_num_rows($sqlallparcel);
                if($allcount > 0) {
                echo "<table class='table table-bordered table-responsive table-hover'>
                <thead>
                <tr>
                    <th>PWBLT-No</th>
                    <th>Booked-Date/Time</th>
                    <th>Description</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>";
                while($arow = mysqli_fetch_array($sqlallparcel)){
                $pid = $arow['pwblt_No'];
                $from = $arow['source'];
                $to = $arow['destination'];
                $desc = $arow['description'];
                $cash = $arow['cash_paid'];
                $status = $arow['status'];
                $bdate = $arow['date_booked'];
                $btime = $arow['time_booked'];
                $boid = $arow['booking_officer_id'];
                echo "<tr>
                <td data-title = 'PWBLT-No'>".$pid."</td>
                <td data-title = 'Booked-Date'>".$bdate."/".$btime."</td>
                <td data-title = 'Description'>".$desc."</td>
                <td data-title = 'From'>".$from."</td>
                <td data-title = 'To'>".$to."</td>
                <td data-title = 'Payment'>".$cash."</td>";
                if ($status == 'booked') {
                echo "<td data-title = 'Status'><span class='label label-info label-mini'>Booked</span></td>";
                } elseif ($status == 'departed') {
                echo "<td data-title = 'Status'><span class='label label-warning label-mini'>Departed</span></td>";
                } elseif ($status == 'received') {
                echo "<td data-title = 'Status'><span class='label label-success label-mini'>Received</span></td>";
                }?>
                <td id='btntd'><center><a href="parceldetailsa.php?pid=<?php echo $pid?>&choice=details&type=booked" ><button class='btn btn-primary btn-xs'>Details</button></a>
                <a href="parceldetailsa.php?pid=<?php echo $pid?>&choice=status&type=booked" ><button class='btn btn-primary btn-xs'>Current Status</button></a>
                <a href="parceldetailsa.php?pid=<?php echo $pid?>&choice=report&type=booked" ><button class='btn btn-primary btn-xs'>Delivery Report</button></a>
                    <?php echo "</td>
                            </tr>";
                }
                echo "</tbody>
                        </table>";
                }else {
                    echo "<h3>No Parcel(s) to Show !!!</h3>";
                }
            ?>
            </section>

            <div id="footer">
                <p id="fp">PRCSS Admin<a href="#" class="back-to-top"><span class="glyphicon glyphicon-chevron-up" id="fb"></span></a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>