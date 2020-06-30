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
    <title>Admin Panel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../Assets/CSS/admin.css" rel="stylesheet" type="text/css">
    <script src="../Assets/JavaScript/admin.js" type="text/javascript"></script>
</head>
<body>
<div id="wrapper" class="container-fluid">
    <div id="header">
        <div id="logoutbtn">
            <button id="lgbtn" onclick="window.location.href='adminlogout.php'">Logout</button>
        </div>
        <a href="#"><img id="img" src="../Assets/Images/PNGlogo.png" width="50" height="50"></a>
        <h2><a href="../Admin/Admin.php" id="title">PAKISTAN RAILWAYS</a></h2>
    </div>
    <div class="row">
        <div id="incontent">
            <div class="infobar">
                <nav class="navbar nav-justified" style="padding: 0 0 0 0;margin: 0 0 0 0">
                    <div class="container-fluid">
                        <ul class="nav nav-justified">
                            <li><h3>Module: Admin</h3></li>
                            <li><h3 class="navitem2"></h3></li>
                            <li><h3 class="navitem3">Working Station: <?php echo $station; ?></h3></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">

                    <div class="item active">
                        <img id="carouselimg" src="../Assets/Images/1.jpg">
                    </div>

                    <div class="item">
                        <img id="carouselimg" src="../Assets/Images/2.jpg">
                    </div>

                    <div class="item">
                        <img id="carouselimg" src="../Assets/Images/3.jpg">
                    </div>

                    <div class="item">
                        <img id="carouselimg" src="../Assets/Images/4.jpg">
                    </div>

                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div id="menutiles" class="container-fluid">
                <center>
                    <ul class="list-inline">
                        <li><a href="Admin.php" style="text-decoration: none"><div class="mntiles" id="home">
                            <img id="homeimg" class="tileimg" src="../Assets/Icons/mobileHome.png"><br>
                            Home
                        </div></a></li>
                        <li><a href="bookingaccounts.php" style="text-decoration: none"><div class="mntiles" id="bookacc">
                            <img id="bookaccimg" class="tileimg" src="../Assets/Icons/Accounting.png"><br>
                            Booking Accounts
                        </div></a></li>
                        <li><a href="transitaccounts.php" style="text-decoration: none"><div class="mntiles" id="transitacc">
                            <img id="transitaccimg" class="tileimg" src="../Assets/Icons/purchaseOrder.png"><br>
                            Transit Accounts
                        </div></a></li>
                        <li><div class="dropup"><div class="mntiles" id="parcellist" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-menu-up" id="parcellistic"></span>
                            <img id="parcellistimg" class="tileimg" src="../Assets/Icons/history.png"><br>
                            Parcel List
                        </div>
                            <ul class="dropdown-menu">
                                <li><a id="txt" href="adminsenthistory.php">Sent History</a></li>
                                <li><a id="txt" href="adminreceivedhistory.php">Received History</a></li>
                                <li><a id="txt" href="adminbookedhistory.php">Booked History</a></li>
                            </ul>
                        </div>
                        </li>
                        <li><a href="deletehistory.php" style="text-decoration: none"><div class="mntiles" id="delparcel">
                            <img id="delparcelimg" class="tileimg" src="../Assets/Icons/Delete.png"><br>
                            Delete Parcels
                        </div></a></li>
                        <li><a href="changepass.php" style="text-decoration: none"><div class="mntiles" id="changepass">
                            <img id="changepassimg" class="tileimg" src="../Assets/Icons/password.png"><br>
                            Change Password
                        </div></a></li>
                        <li><a href="feedback.php" style="text-decoration: none"><div class="mntiles" id="feedback">
                            <img id="feedbackimg" class="tileimg" src="../Assets/Icons/feedback.png"><br>
                            View Feedbacks
                        </div></a></li>
                    </ul>
                </center>
            </div>
            <div id="footer">
                <p id="fp">PRCSS Admin<a href="#" class="back-to-top"><span class="glyphicon glyphicon-chevron-up" id="fb"></span></a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>