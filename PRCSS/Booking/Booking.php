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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='../Assets/icons/favicon.ico' type='image/x-icon'/ >
    <title>Booking Services - Home</title>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../Assets/CSS/Booking.css" rel="stylesheet" type="text/css">
    <script src="../Assets/JavaScript/Booking.js" type="text/javascript"></script>
</head>
<body>
<div id="wrapper" class="container-fluid">
    <div id="header">
        <div id="logoutbtn">
            <button id="lgbtn" onclick="window.location.href='../logout.php'">Logout</button>
        </div>
        <a href="#"><img id="img" src="../Assets/Images/PNGlogo.png" width="50" height="50"></a>
        <h2><a href="Booking.php" id="title">PAKISTAN RAILWAYS</a></h2>
    </div>
    <div class="row">
        <div id="incontent">
            <div class="infobar">
                <nav class="navbar nav-justified" style="padding: 0 0 0 0;margin: 0 0 0 0">
                    <div class="container-fluid">
                        <ul class="nav nav-justified">
                            <li><h3>Module: Booking</h3></li>
                            <li><h3 class="navitem2">User: <?php echo $uname; ?></h3></li>
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
                        <li><a href="Booking.php" style="text-decoration: none"><div class="mntiles" id="home">
                                    <img id="homeimg" class="tileimg" src="../Assets/Icons/Home.png"><br>
                                    Home
                                </div></a></li>
                        <li><a href="bookparcel.php" style="text-decoration: none"><div class="mntiles" id="bookParcel">
                                    <img id="bParcelimg" class="tileimg" src="../Assets/Icons/NewProduct.png"><br>
                                    Book Parcel
                                </div></a></li>
                        <li><a href="generatereceipt.php" style="text-decoration: none"><div class="mntiles" id="receipt">
                                <img id="receiptimg" class="tileimg" src="../Assets/Icons/Receipt.png"><br>
                                Generate Receipt
                            </div></a></li>
                        <li><div class="dropup"><div class="mntiles" id="list" data-toggle="dropdown">
                                    <span class="glyphicon glyphicon-menu-up" id="vpic"></span>
                                    <img id="listimg" class="tileimg" src="../Assets/Icons/List.png"><br>
                                    View Parcels
                                </div>
                                <ul class="dropdown-menu">
                                    <li><a id="txt" href="parcellist.php?type=all">View All</a></li>
                                    <li><a id="txt" href="parcellist.php?type=booked">Booked Parcels</a></li>
                                    <li><a id="txt" href="parcellist.php?type=departed">Departed Parcels</a></li>
                                    <li><a id="txt" href="parcellist.php?type=received">Received Parcels</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="bsearchparcel.php" style="text-decoration: none"><div class="mntiles" id="search">
                                    <img id="searchimg" class="tileimg" src="../Assets/Icons/Search.png"><br>
                                    Search Parcels
                                </div></a></li>
                        <li><a href="bookingprofile.php" style="text-decoration: none"><div class="mntiles" id="profile">
                                    <img id="profileimg" class="tileimg" src="../Assets/Icons/Contacts.png"><br>
                                    User Profile
                            </div></a></li>
                    </ul>
                </center>
            </div>
            <div id="footer">
                <p id="fp">PRCSS Booking Services<a href="#" class="back-to-top"><span class="glyphicon glyphicon-chevron-up" id="fb"></span></a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>