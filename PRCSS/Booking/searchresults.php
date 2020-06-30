<?php
include ("../connection.php");
session_start();
if(!isset($_SESSION['id'])) {
    header("location:../Login.php");
}else {
    if($_SESSION['domain'] == "transit"){
        header("location:../Transit/Transit.php");
    }
}

$id = $_SESSION['id'];
$uname = $_SESSION['name'];
$udomain = $_SESSION['domain'];
$station = $_SESSION['station'];
$image = $_SESSION['img'];
$altpath = "../Assets/Icons/UserFilled.png";

$value = $_GET['value'];
$choice = $_GET['choice'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='../Assets/icons/favicon.ico' type='image/x-icon'/ >
    <title>Search Results</title>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../Assets/CSS/shared.css" rel="stylesheet" type="text/css">
    <link href="../Assets/CSS/searchresults.css" rel="stylesheet" type="text/css">
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
                <h4 class="profile"><?php echo $uname?></h4>
                <h4 class="profile"><?php echo $station?></h4>
            </div>
            <ul class="sidenavcontent">
                <li class="list"><a href="Booking.php"><span class="glyphicon glyphicon-home"></span>     Home</a></li><br><br>
                <li class="list"><a href="bookparcel.php"><span class="glyphicon glyphicon-list"></span>     Book Parcel</a></li><br><br>
                <li class="list"><a href="generatereceipt.php"><span class="glyphicon glyphicon-list-alt"></span>     Generate Reciept</a></li><br><br>
                <li class="list" id="viewlist"><div id="viewparcel"><a id ="viewtext"><span class="glyphicon glyphicon-eye-open"></span>     View Parcels</a></div>
                    <div id="parcelmenu"><ul><br>
                            <li class="list"><a href="parcellist.php?type=all">View All</a></li>
                            <li class="list"><a href="parcellist.php?type=booked">Booked Parcels</a></li>
                            <li class="list"><a href="parcellist.php?type=departed">Departed Parcels</a></li>
                            <li class="list"><a href="parcellist.php?type=received">Received Parcels</a></li>
                        </ul></div>
                </li><br><br>
                <li class="list"><a href="bsearchparcel.php"><span class="glyphicon glyphicon-search"></span>     Search Parcels</a></li><br><br>
                <li class="list"><a href="bookingprofile.php"><span class="glyphicon glyphicon-user"></span>     User Profile</a></li><br><br>
            </ul>
        </div>
        <div id="incontent">

            <div class="searchheading">
                <p id="subheading">Search Results</p>
            </div>
            <div class="div-style" data-spy="affix" data-offset-top="50">
                <center><table class="notify-table">
                    <tr>
                        <th>My Bookings :</th>
                        <td><div class="mb-color"></div></td>
                        <th>Other Bookings :</th>
                        <td><div class="ob-color"></div></td>
                    </tr>
                </table></center>
            </div>
            <div class="main-content">
                <?php
                if($choice == 'destination'){
                    $sqlparcel = mysqli_query($con,"SELECT * FROM packagedetails WHERE 	source='$station' AND destination='$value'");
                }elseif($choice == 'sender'){
                    $sqlparcel = mysqli_query($con,"SELECT packagedetails.pwblt_No, packagedetails.date_booked , packagedetails.time_booked ,
                    packagedetails.description , packagedetails.source ,packagedetails.destination, packagedetails.cash_paid , packagedetails.status,
                    packagedetails.booking_officer_id
                    FROM packagedetails JOIN sender_recieverdetails
                    ON sender_recieverdetails.sender_name LIKE '$value' AND packagedetails.pwblt_No = sender_recieverdetails.package_pwblt_no");
                }

                    echo "<section id='no-more-tables' class='tablecontainer'>
                        <table class='table table-bordered table-responsive'>
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
                            while($prow = mysqli_fetch_array($sqlparcel)) {
                                $pid = $prow['pwblt_No'];
                                $from = $prow['source'];
                                $to = $prow['destination'];
                                $desc = $prow['description'];
                                $cash = $prow['cash_paid'];
                                $status = $prow['status'];
                                $bdate = $prow['date_booked'];
                                $btime = $prow['time_booked'];
                                $boid = $prow['booking_officer_id'];
                                if($id == $boid){
                                    echo "<tr class='yb'>";
                                }else {
                                    echo "<tr>";
                                }
                                echo "<td data-title = 'PWBLT-No'>".$pid."</td>
                                <td data-title = 'Booked-Date/Time'>".$bdate." / ".$btime."</td>
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
                                <td id='btntd'><center><a href="parceldetailsb.php?pid=<?php echo $pid?>&choice=details" ><button class='btn btn-primary btn-xs'>Details</button></a>
                                    <a href="parceldetailsb.php?pid=<?php echo $pid?>&choice=status" ><button class='btn btn-primary btn-xs'>Current Status</button></a>
                                    <a href="receipt.php?pid=<?php echo $pid?>" ><button class='btn btn-primary btn-xs'>Generate Receipt</button></a></center></td>
                                <?php echo "</tr>";
                            }
                            echo "</tbody>
                        </table>
                    </section>";
                ?>

                <div id="footer">
                    <p id="fp">PRCSS Booking Services<a href="#" class="back-to-top"><span class="glyphicon glyphicon-chevron-up" id="fb"></span></a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>