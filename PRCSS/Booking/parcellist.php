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

$type = $_GET['type'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='../Assets/icons/favicon.ico' type='image/x-icon'/ >
    <title>Parcel History</title>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../Assets/CSS/shared.css" rel="stylesheet" type="text/css">
    <link href="../Assets/CSS/parcellist.css" rel="stylesheet" type="text/css">
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
                <li class="list" id="viewlist"><div id="viewparcel"><a style="cursor: pointer" id ="viewtext"><span class="glyphicon glyphicon-eye-open"></span>     View Parcels</a></div>
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
                <p id="subheading">Booked History</p>
            </div>
            <nav class="nav-style" data-spy="affix" data-offset-top="50">
                <center><table class="notify-table">
                    <tr>
                        <th>My Bookings :</th>
                        <td><div class="mb-color"></div></td>
                        <th>Other Bookings :</th>
                        <td><div class="ob-color"></div></td>
                    </tr>
                </table></center>
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
                            <?php
                            if($type == 'all'){
                                echo "<li class='active'><a data-toggle='tab'  href='#all'>All</a></li>";
                            }else{
                                echo "<li><a data-toggle='tab'  href='#all'>All</a></li>";
                            }
                            if($type == 'booked'){
                                echo "<li class='active'><a data-toggle='tab'  href='#booked'>Booked</a></li>";
                            }else{
                                echo "<li><a data-toggle='tab'  href='#booked'>Booked</a></li>";
                            }
                            if($type == 'departed'){
                                echo "<li class='active'><a data-toggle='tab'  href='#departed'>Departed</a></li>";
                            }else{
                                echo "<li><a data-toggle='tab'  href='#departed'>Departed</a></li>";
                            }
                            if($type == 'received'){
                                echo "<li class='active'><a data-toggle='tab'  href='#received'>Received</a></li>";
                            }else{
                                echo "<li><a data-toggle='tab'  href='#received'>Received</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="tab-content">
            <?php
            $sqlallparcel = mysqli_query($con,"SELECT * FROM packagedetails WHERE source='$station'");
            $allcount = mysqli_num_rows($sqlallparcel);
            $sqlbookedparcel = mysqli_query($con,"SELECT * FROM packagedetails WHERE source='$station' AND status='booked'");
            $bookedcount = mysqli_num_rows($sqlbookedparcel);
            $sqldepartedparcel = mysqli_query($con,"SELECT * FROM packagedetails WHERE source='$station' AND status='departed'");
            $departedcount = mysqli_num_rows($sqldepartedparcel);
            $sqlreceivedparcel = mysqli_query($con,"SELECT * FROM packagedetails WHERE source='$station' AND status='received'");
            $receivedcount = mysqli_num_rows($sqlreceivedparcel);


            if($type == 'all'){
                echo "<div id='all' class='tab-pane fade in active'>";
            }else {
                echo "<div id='all' class='tab-pane fade'>";
            }
                    echo "<section id='no-more-tables' class='tablecontainer'>";
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
                                if($boid == $id){
                                    echo "<tr class='yb'>";
                                }else {
                                    echo "<tr>";
                                }
                                echo "<td data-title = 'PWBLT-No'>".$pid."</td>
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
                                    <td id='btntd'><center><a href="parceldetailsb.php?pid=<?php echo $pid?>&choice=details" ><button class='btn btn-primary btn-xs'>Details</button></a>
                                            <a href="parceldetailsb.php?pid=<?php echo $pid?>&choice=status" ><button class='btn btn-primary btn-xs'>Current Status</button></a>
                                            <a href="receipt.php?pid=<?php echo $pid?>" ><button class='btn btn-primary btn-xs'>Generate Receipt</button></a></center>
                                <?php echo "</td>
                            </tr>";
                            }
                            echo "</tbody>
                        </table>";
                    }else {
                        echo "<h3>No Parcel(s) to Show !!!</h3>";
                    }
                    echo "</section>
                </div>";

            if($type == 'booked'){
                echo "<div id='booked' class='tab-pane fade in active'>";
            }else {
                echo "<div id='booked' class='tab-pane fade'>";
            }
                    echo "<section id='no-more-tables' class='tablecontainer'>";
                        if($bookedcount > 0) {
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
                            while($brow = mysqli_fetch_array($sqlbookedparcel)){
                                $pid = $brow['pwblt_No'];
                                $from = $brow['source'];
                                $to = $brow['destination'];
                                $desc = $brow['description'];
                                $cash = $brow['cash_paid'];
                                $status = $brow['status'];
                                $bdate = $brow['date_booked'];
                                $btime = $brow['time_booked'];
                                $boid = $brow['booking_officer_id'];
                                if($boid == $id){
                                    echo "<tr class='yb'>";
                                }else {
                                    echo "<tr>";
                                }
                                echo "<td data-title = 'PWBLT-No'>".$pid."</td>
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
                                    <td id='btntd'><center><a href="parceldetailsb.php?pid=<?php echo $pid?>&choice=details" ><button class='btn btn-primary btn-xs'>Details</button></a>
                                    <a href="parceldetailsb.php?pid=<?php echo $pid?>&choice=status" ><button class='btn btn-primary btn-xs'>Current Status</button></a>
                                    <a href="receipt.php?pid=<?php echo $pid?>&choice=status" ><button class='btn btn-primary btn-xs'>Generate Receipt</button></a></center>
                                <?php echo "</td>
                                </tr>";
                                }
                                echo "</tbody>
                                </table>";
                                }else {
                                echo "<h3>No Parcel(s) to Show !!!</h3>";
                                }
                    echo "</section>

                </div>";

            if($type == 'departed'){
                echo "<div id='departed' class='tab-pane fade in active'>";
            }else{
                echo "<div id='departed' class='tab-pane fade'>";
            }

                    echo "<section id='no-more-tables' class='tablecontainer'>";
                                if($departedcount > 0) {
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
                                while($drow = mysqli_fetch_array($sqldepartedparcel)){
                                $pid = $drow['pwblt_No'];
                                $from = $drow['source'];
                                $to = $drow['destination'];
                                $desc = $drow['description'];
                                $cash = $drow['cash_paid'];
                                $status = $drow['status'];
                                $bdate = $drow['date_booked'];
                                $btime = $drow['time_booked'];
                                $boid = $drow['booking_officer_id'];
                                if($boid == $id){
                                    echo "<tr class='yb'>";
                                }else {
                                    echo "<tr>";
                                }
                                echo "<td data-title = 'PWBLT-No'>".$pid."</td>
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
                                <td id='btntd'><center><a href="parceldetailsb.php?pid=<?php echo $pid?>&choice=details" ><button class='btn btn-primary btn-xs'>Details</button></a>
                                    <a href="parceldetailsb.php?pid=<?php echo $pid?>&choice=status" ><button class='btn btn-primary btn-xs'>Current Status</button></a>
                                    <a href="receipt.php?pid=<?php echo $pid?>&choice=status" ><button class='btn btn-primary btn-xs'>Generate Receipt</button></a></center>
                                <?php echo "</td>
                                </tr>";
                                }
                                echo "</tbody>
                                </table>";
                                }else {
                                    echo "<h3>No Parcel(s) to Show !!!</h3>";
                                }
                            echo "</section>
                        </div>";

            if($type == 'received'){
                echo "<div id='received' class='tab-pane fade in active'>";
            }else {
                echo "<div id='received' class='tab-pane fade'>";
            }

                    echo "<section id='no-more-tables' class='tablecontainer'>";
                            if($receivedcount > 0) {
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
                                while($rrow = mysqli_fetch_array($sqlreceivedparcel)){
                                $pid = $rrow['pwblt_No'];
                                $from = $rrow['source'];
                                $to = $rrow['destination'];
                                $desc = $rrow['description'];
                                $cash = $rrow['cash_paid'];
                                $status = $rrow['status'];
                                $bdate = $rrow['date_booked'];
                                $btime = $rrow['time_booked'];
                                $boid = $rrow['booking_officer_id'];
                                if($boid == $id){
                                    echo "<tr class='yb'>";
                                }else {
                                    echo "<tr>";
                                }
                                echo "<td data-title = 'PWBLT-No'>".$pid."</td>
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
                                <td id='btntd'><center><a href="parceldetailsb.php?pid=<?php echo $pid?>&choice=details" ><button class='btn btn-primary btn-xs'>Details</button></a>
                                    <a href="parceldetailsb.php?pid=<?php echo $pid?>&choice=status" ><button class='btn btn-primary btn-xs'>Current Status</button></a>
                                    <a href="receipt.php?pid=<?php echo $pid?>&choice=status" ><button class='btn btn-primary btn-xs'>Generate Receipt</button></a></center>
                                <?php echo "</td>
                                </tr>";
                            }
                            echo "</tbody>
                            </table>";
                            }else {
                                echo "<h3>No Parcel(s) to Show !!!</h3>";
                            }
                        echo "</section>
                </div>";
            ?>

            <div id="footer">
                <p id="fp">PRCSS Booking Services<a href="#" class="back-to-top"><span class="glyphicon glyphicon-chevron-up" id="fb"></span></a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>