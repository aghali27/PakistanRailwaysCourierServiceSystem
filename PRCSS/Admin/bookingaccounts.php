<?php
include ("../connection.php");
session_start();
if(!isset($_SESSION['user'])) {
    header("location:adminlogin.php");
}

$user = $_SESSION['user'];
$station = $_SESSION['station'];

$altpath2 = "../Assets/Images/default.gif";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='../Assets/icons/favicon.ico' type='image/x-icon'/ >
    <title>Booking Accounts</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../Assets/CSS/adminshared.css" rel="stylesheet" type="text/css">
    <link href="../Assets/CSS/bookingaccounts.css" rel="stylesheet" type="text/css">
    <script src="../Assets/JavaScript/adminshared.js" type="text/javascript"></script>
    <script src="../Assets/JavaScript/bookingaccounts.js" type="text/javascript"></script>
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
            <div class="searchheading">
                <p id="subheading">Booking Accounts</p>
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
                            <li class="active"><a data-toggle="tab"  href="#all">All</a></li>
                            <li><a data-toggle="tab"  href="#active">Activated</a></li>
                            <li><a data-toggle="tab"  href="#deactive">Deactivated</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="tab-content">


                <div class="modal fade" id="myModal1" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title">Are you sure you want to Delete this Account?</h3>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" onclick="deluser()" style="border-radius: 0;width: 45%;margin-left: 2%;font-weight: bold;float: left">Yes</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal" style="border-radius: 0;width: 45%;font-weight: bold;margin-left: 2%">No</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!------------------------------------- Search Booking Account --------------------------------------->

                <div id="search" class="search-panel tab-pane fade">
                    <p>Search Booking Officer</p>
                    <form class="input-group style" action="accountsearchresults.php" method="post">
                        <input type="text" class="form-control searchbar" name="uid" placeholder="Enter Officer ID" required autofocus>
                        <input type="hidden" name="domain" value="booking">
                        <span class="input-group-addon search"><button class="bt" type="submit"><span class="glyphicon glyphicon-search"></span> </button></span>
                    </form>
                    <br>
                </div>

                <?php

                /////////////////////////////////////// All Booking Accounts ///////////////////////////////////////

                echo "<div id='all' class='tab-pane fade in active'>

                    <center>
                        <ul class='list-inline cards'>";
                        $profilequery = "SELECT * FROM employeelogin WHERE udomain='booking' AND workingstation = '$station'";
                        $result = mysqli_query($con,$profilequery);

                        while($prow = mysqli_fetch_array($result)) {
                            $userid = $prow['id'];
                            $udomain = $prow['udomain'];
                            $uname = $prow['uname'];
                            $cnic = $prow['cnic'];
                            $phone = $prow['phone'];
                            $station = $prow['workingstation'];
                            $status = $prow['status'];
                            $email = $prow['email'];
                            $path = $prow['imgpath'];

                            if($status == "true") {
                                echo "<li><div class='media booked'>
                                <div class='media-left'>"; ?>
                                <img id='mediaimg' class='media-object' src="<?php if ($path != null) echo $path; else echo $altpath2; ?>" >
                                <?php echo "</div>
                                <div class='media-body'>
                                    <p>User ID :  " . $userid . "</p>
                                    <p>User Name :  " . $uname . "</p>
                                    <p>CNIC :  " . $cnic . "</p>
                                    <p>Phone No :  " . $phone . "</p>
                                    <p>Email :  " . $email . "</p>
                                    <p>Working Module :  <span class='label label-info label-mini'>Booking</span></p>
                                    <a href='bookingaccounthistory.php?userid=".$userid."&uname=".$uname."'><button id='vhst' class='btn btn-primary btn-xs'>View History</button></a>
                                    <a href='bookingaccountprocessing.php?aid=".$userid."&status=".$status."'><button id='deacc' class='btn btn-warning btn-xs'>Deactivate Account</button></a>";?>
                                    <button id='delacc' class='btn btn-danger btn-xs' data-toggle="modal" data-target="#myModal1" onclick="getdelvalues('<?php echo $userid; ?>','<?php echo $udomain; ?>')">Delete Account</button>
                                <?php echo "</div>
                            </div></li>";
                            } else {

                                echo "<li><div class='media booked'>
                                <div class='media-left'>"; ?>
                                <img id='mediaimg' class='media-object' src="<?php if ($path != null) echo $path; else echo $altpath2; ?>" >
                                <?php echo "</div>
                                <div class='media-body'>
                                    <p>User ID :  " . $userid . "</p>
                                    <p>User Name :  " . $uname . "</p>
                                    <p>CNIC :  " . $cnic . "</p>
                                    <p>Phone No :  " . $phone . "</p>
                                    <p>Email :  " . $email . "</p>
                                    <p>Working Module :  <span class='label label-info label-mini'>Booking</span></p>
                                    <a href='bookingaccounthistory.php?userid=".$userid."&uname=".$uname."'><button id='vhst' class='btn btn-primary btn-xs'>View History</button></a>
                                    <a href='bookingaccountprocessing.php?aid=".$userid."&status=".$status."'><button id='deacc' class='btn btn-success btn-xs'>Activate Account</button></a>";?>
                                    <button id="delacc" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal1" onclick="getdelvalues('<?php echo $userid; ?>','<?php echo $udomain; ?>')">Delete Account</button>
                                <?php echo "</div>
                            </div></li>";
                            }

                        }


                        echo "</ul>
                    </center>

                </div>";

                /////////////////////////////////////// Activated Accounts ///////////////////////////////////////

                echo "<div id='active' class='tab-pane fade'>

                    <center>
                        <ul class='list-inline cards'>";

                        $profilequery = "SELECT * FROM employeelogin WHERE udomain='booking' AND status='true' AND workingstation = '$station'";
                        $result = mysqli_query($con,$profilequery);

                        while($prow = mysqli_fetch_array($result)) {
                            $userid = $prow['id'];
                            $udomain = $prow['udomain'];
                            $uname = $prow['uname'];
                            $cnic = $prow['cnic'];
                            $phone = $prow['phone'];
                            $station = $prow['workingstation'];
                            $status = $prow['status'];
                            $email = $prow['email'];
                            $path = $prow['imgpath'];

                            echo "<li><div class='media booked'>
                                <div class='media-left'>"; ?>
                            <img id='mediaimg' class='media-object' src="<?php if ($path != null) echo $path; else echo $altpath2; ?>" >
                            <?php echo "</div>
                                <div class='media-body'>
                                    <p>User ID :  " . $userid . "</p>
                                    <p class='media-heading'>User Name :  " . $uname . "</p>
                                    <p>CNIC :  " . $cnic . "</p>
                                    <p>Phone No :  " . $phone . "</p>
                                    <p>Email :  " . $email . "</p>
                                    <p>Working Module :  <span class='label label-info label-mini'>Booking</span></p>
                                    <a href='bookingaccounthistory.php?userid=".$userid."&uname=".$uname."'><button id='vhst' class='btn btn-primary btn-xs'>View History</button></a>
                                    <a href='bookingaccountprocessing.php?aid=".$userid."&status=".$status."'><button id='deacc' class='btn btn-warning btn-xs'>Deactivate Account</button></a>";?>
                                    <button id='delacc' class='btn btn-danger btn-xs' data-toggle="modal" data-target="#myModal1" onclick="getdelvalues('<?php echo $userid; ?>','<?php echo $udomain; ?>')">Delete Account</button>
                            <?php echo "</div>
                            </div></li>";
                        }
                        echo "</ul>
                    </center>

                </div>";

                /////////////////////////////////////// Deactivated Accounts ///////////////////////////////////////

                echo "<div id='deactive' class='tab-pane fade'>

                    <center>
                        <ul class='list-inline cards'>";

                $profilequery = "SELECT * FROM employeelogin WHERE udomain='booking' AND status='false' AND workingstation = '$station'";
                $result = mysqli_query($con,$profilequery);

                while($prow = mysqli_fetch_array($result)) {
                    $userid = $prow['id'];
                    $udomain = $prow['udomain'];
                    $uname = $prow['uname'];
                    $cnic = $prow['cnic'];
                    $phone = $prow['phone'];
                    $station = $prow['workingstation'];
                    $status = $prow['status'];
                    $email = $prow['email'];
                    $path = $prow['imgpath'];

                    echo "<li><div class='media booked'>
                                <div class='media-left'>"; ?>
                    <img id='mediaimg' class='media-object' src="<?php if ($path != null) echo $path; else echo $altpath2; ?>" >
                    <?php echo "</div>
                                <div class='media-body'>
                                    <p>User ID :  " . $userid . "</p>
                                    <p class='media-heading'>User Name :  " . $uname . "</p>
                                    <p>CNIC :  " . $cnic . "</p>
                                    <p>Phone No :  " . $phone . "</p>
                                    <p>Email :  " . $email . "</p>
                                    <p>Working Module :  <span class='label label-info label-mini'>Booking</span></p>
                                    <a href='bookingaccounthistory.php?userid=".$userid."&uname=".$uname."'><button id='vhst' class='btn btn-primary btn-xs'>View History</button></a>
                                    <a href='bookingaccountprocessing.php?aid=".$userid."&status=".$status."'><button id='deacc' class='btn btn-success btn-xs'>Activate Account</button></a>";?>
                                    <button id='delacc' class='btn btn-danger btn-xs' data-toggle="modal" data-target="#myModal1" onclick="getdelvalues('<?php echo $userid; ?>','<?php echo $udomain; ?>')">Delete Account</button>
                                    <?php echo "</div>
                            </div></li>";

                }
                    echo "</ul>
                    </center>

                </div>";

                ?>

            <div id="footer">
                <p id="fp">PRCSS Admin<a href="#" class="back-to-top"><span class="glyphicon glyphicon-chevron-up" id="fb"></span></a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>