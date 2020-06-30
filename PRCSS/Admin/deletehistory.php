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
    <title>Delete History</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../Assets/CSS/adminshared.css" rel="stylesheet" type="text/css">
    <link href="../Assets/CSS/deletehistory.css" rel="stylesheet" type="text/css">
    <script src="../Assets/JavaScript/adminshared.js" type="text/javascript"></script>
    <script src="../Assets/JavaScript/deletehistory.js" type="text/javascript"></script>

    <script src="../Assets/JavaScript/datepicker.js"></script>
    <link href="../Assets/CSS/datepicker.css" rel="stylesheet"/>

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
                <h1 id="subheading">Delete Parcels</h1>
            </div>
            <button id="schbtn1" class="searchbtns">Delete By Id<div class="sign"><span id="signtrans1" class="glyphicon-plus"></span></div></button>
            <div id="panel1" class="panel">
                <form id="form1" class="input-group style" action="deleteparcel.php" method="get">
                    <input type="text" class="form-control searchbar" name="pid" placeholder="Enter Parcel ID" required>
                    <input type="hidden" name="type" value="id">
                    <span class="input-group-addon" data-toggle="modal" data-target="#myModal1"><div class="bt"><span class="glyphicon glyphicon-trash"></span> </div></span>
                    <div class="modal fade" id="myModal1" role="dialog">
                        <div class="modal-dialog modal-lg">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h3 class="modal-title">Are you sure you want to Delete this Record?</h3>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-danger" value="Yes" style="border-radius: 0;width: 45%;margin-left: 2%;font-weight: bold;float: left">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" style="border-radius: 0;width: 45%;font-weight: bold;margin-left: 2%">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <button id="schbtn2" class="searchbtns">Time Based Deletion<div class="sign"><span id="signtrans2" class="glyphicon-plus"></span></div></button>
            <div id="panel2" class="panel">
                <form id="form2" class="form-inline style" action="deleterecord.php" method="post">
                    <label class="date-label">From:</label>
                    <div class="form-group">
                        <div class="input-append date">
                            <input type="text" class="form-control searchbar" name="fromdate" data-date-format="yyyy-mm-dd">
                            <span class="add-on">
                            </span>
                        </div>
                    </div>
                    <label class="date-label">To:</label>
                    <div class="form-group">
                        <div class="input-append date">
                            <input type="text" class="form-control searchbar" name="todate" data-date-format="yyyy-mm-dd">
                            <span class="add-on">
                            </span>
                        </div>
                    </div>
                    <div class="date-bt" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-trash"></span> Delete</div>
                    <div class="modal fade" id="myModal2" role="dialog">
                        <div class="modal-dialog modal-lg">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h3 class="modal-title">Are you sure you want to Delete these Records?</h3>
                                </div>
                                <div class="modal-footer">
                                    <input form="form2" type="submit" class="btn btn-danger" value="Yes" style="border-radius: 0;width: 45%;margin-left: 2%;font-weight: bold;float: left">
                                    <button class="btn btn-primary" data-dismiss="modal" style="border-radius: 0;width: 45%;font-weight: bold;margin-left: 2%">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <button id="schbtn3" class="searchbtns">Delete till Beginning<div class="sign"><span id="signtrans3" class="glyphicon-plus"></span></div></button>
            <div id="panel3" class="panel">
                <form id="form3" class="input-group style" action="deleteparcel.php" method="get">
                    <input type="hidden" name="pid" value="">
                    <input type="hidden" name="type" value="all">
                    <div class="date-bt" data-toggle="modal" data-target="#myModal3"><span class="glyphicon glyphicon-trash"></span> Delete All Records</div>
                    <div class="modal fade" id="myModal3" role="dialog">
                        <div class="modal-dialog modal-lg">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h3 class="modal-title">Are you sure you want to Delete all Records?</h3>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-danger" value="Yes" style="border-radius: 0;width: 45%;margin-left: 2%;font-weight: bold;float: left">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" style="border-radius: 0;width: 45%;font-weight: bold;margin-left: 2%">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>



            <div id="footer">
                <p id="fp">PRCSS Admin<a href="#" class="back-to-top"><span class="glyphicon glyphicon-chevron-up" id="fb"></span></a></p>
            </div>
        </div>

    </div>
</div>
</body>
</html>
<script>
    jQuery('.input-append.date').datepicker({
        orientation: "top auto"
    });
</script>