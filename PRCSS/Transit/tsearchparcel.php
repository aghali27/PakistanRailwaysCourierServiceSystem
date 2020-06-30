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

$sqlstation = mysqli_query($con,"SELECT st_desc FROM pr_station WHERE st_desc!='$station'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='../Assets/icons/favicon.ico' type='image/x-icon'/ >
    <title>Search Parcel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../Assets/CSS/shared.css" rel="stylesheet" type="text/css">
    <link href="../Assets/CSS/tsearchparcel.css" rel="stylesheet" type="text/css">
    <script src="../Assets/JavaScript/shared.js" type="text/javascript"></script>
    <script src="../Assets/JavaScript/tsearchparcel.js" type="text/javascript"></script>
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
                <p id="subheading">Search Parcel</p>
            </div>
            <nav class="nav-style">
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
                            <li class="active"><a data-toggle="tab"  href="#sent">Sent</a></li>
                            <li><a data-toggle="tab"  href="#received">Received</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="tab-content">

                <div id="sent" class="tab-pane fade in active">

                    <button id="schbtn1" class="searchbtns">Search By Id<div class="sign"><span id="signtrans1" class="glyphicon-plus"></span></div></button>
                    <div id="panel1" class="panel">
                        <form class="input-group style" action="searchsentresult.php" method="get">
                            <input type="text" class="form-control searchbar" name="value" placeholder="Enter Parcel ID" required>
                            <input type="hidden" name="choice" value="id">
                            <span class="input-group-addon"><button class="bt" type="submit"><span class="glyphicon glyphicon-search"></span> </button></span>
                        </form>
                    </div>
                    <button id="schbtn2" class="searchbtns">Search By Destination<div class="sign"><span id="signtrans2" class="glyphicon-plus"></span></div></button>
                    <div id="panel2" class="panel">
                        <form class="input-group style" action="searchsentresult.php" method="get">
                            <input list="stations" class="form-control searchbar" name="value" placeholder="Enter Parcel Destination" required>
                            <?php
                            // Datalist For Stations //

                            echo "<datalist id='stations' >";
                            while($row = mysqli_fetch_array($sqlstation)){
                                $name = $row["st_desc"];
                                echo "<option value='".$name."'>";

                            }
                            echo "</datalist>";
                            ?>
                            <input type="hidden" name="choice" value="destination">
                            <span class="input-group-addon"><button type="submit" class="bt"><span class="glyphicon glyphicon-search"></span> </button></span>
                        </form>
                    </div>
                    <button id="schbtn3" class="searchbtns">Search By Sender Name<div class="sign"><span id="signtrans3" class="glyphicon-plus"></span></div></button>
                    <div id="panel3" class="panel">
                        <form class="input-group style" action="searchsentresult.php" method="get">
                            <input type="text" class="form-control searchbar" name="value" placeholder="Enter Parcel Sender Name" required>
                            <input type="hidden" name="choice" value="sender">
                            <span class="input-group-addon"><button class="bt" type="submit"><span class="glyphicon glyphicon-search"></span> </button></span>
                        </form>
                    </div>

                </div>

                <div id="received" class="tab-pane fade">

                    <button id="rschbtn1" class="searchbtns">Search By Id<div class="sign"><span id="rsigntrans1" class="glyphicon-plus"></span></div></button>
                    <div id="rpanel1" class="panel">
                        <form class="input-group style" action="searchreceivedresult.php" method="get">
                            <input type="text" class="form-control searchbar" name="value" placeholder="Enter Parcel ID" required>
                            <input type="hidden" name="choice" value="id">
                            <span class="input-group-addon"><button class="bt" type="submit"><span class="glyphicon glyphicon-search"></span> </button></span>
                        </form>
                    </div>
                    <button id="rschbtn2" class="searchbtns">Search By Source<div class="sign"><span id="rsigntrans2" class="glyphicon-plus"></span></div></button>
                    <div id="rpanel2" class="panel">
                        <form class="input-group style" action="searchreceivedresult.php" method="get">
                            <input list="stations" class="form-control searchbar" name="value" placeholder="Enter Parcel Source" required>
                            <?php
                            // Datalist For Stations //

                            echo "<datalist id='stations' >";
                            while($row = mysqli_fetch_array($sqlstation)){
                                $name = $row["st_desc"];
                                echo "<option value='".$name."'>";

                            }
                            echo "</datalist>";
                            ?>
                            <input type="hidden" name="choice" value="source">
                            <span class="input-group-addon"><button class="bt" type="submit"><span class="glyphicon glyphicon-search"></span> </button></span>
                        </form>
                    </div>
                    <button id="rschbtn3" class="searchbtns">Search By Consignee Name<div class="sign"><span id="rsigntrans3" class="glyphicon-plus"></span></div></button>
                    <div id="rpanel3" class="panel">
                        <form class="input-group style" action="searchreceivedresult.php" method="get">
                            <input type="text" class="form-control searchbar" name="value" placeholder="Enter Parcel Consignee Name" required>
                            <input type="hidden" name="choice" value="receiver">
                            <span class="input-group-addon"><button class="bt" type="submit"><span class="glyphicon glyphicon-search"></span> </button></span>
                        </form>
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