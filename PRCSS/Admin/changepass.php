<?php
include ("../connection.php");
session_start();
if(!isset($_SESSION['user'])) {
    header("location:adminlogin.php");
}

$user = $_SESSION['user'];
$station = $_SESSION['station'];

$adminloginquery = "SELECT * FROM admin WHERE username='$user' AND city='$station'";
$result = mysqli_query($con,$adminloginquery);

$numrows = mysqli_num_rows($result);
if($numrows > 0) {
    while ($rowp = mysqli_fetch_array($result)) {
        $pass = $rowp['password'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='../Assets/icons/favicon.ico' type='image/x-icon'/ >
    <title>Change Password</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../Assets/CSS/adminshared.css" rel="stylesheet" type="text/css">
    <link href="../Assets/CSS/changepass.css" rel="stylesheet" type="text/css">
    <script src="../Assets/JavaScript/adminshared.js" type="text/javascript"></script>
    <script src="../Assets/JavaScript/changepass.js" type="text/javascript"></script>
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
                <h1 id="subheading">Change Password</h1>
            </div>
            <form role="form" id="pswpanel" class="pswpanel" action="changingpass.php" method="post" onSubmit="return validate(this);">
                <div class="form-inline form-group">
                    <label id="seclbl" class="control-label">Current Password: </label>
                    <input type="hidden" id="originalpass" name="originalpass" value="<?php echo $pass; ?>">
                    <input type="password" class="form-control" name="currentpass" id="crpass" autofocus onkeyup="vipeout()">
                </div>
                <hr>
                <div class="form-inline form-group">
                    <label id="seclbl" class="control-label">New Password: </label>
                    <input type="password" name="newpass" class="form-control" id="npass" onkeyup="checkstrength(this.value)" disabled>
                </div>
                <div id="showstrength" class="infobars"></div>
                <hr>
                <div class="form-inline form-group">
                    <label id="seclbl" class="control-label">Confirm Password: </label>
                    <input type="password" name="confirmpass" class="form-control" id="cnpass" onkeyup="matchpass(this.value)" disabled>
                    <input type="hidden" name="user" value="<?php echo $user; ?>">
                    <input type="hidden" name="station" value="<?php echo $station; ?>">
                </div>
                <div id="showmatch" class="infobars"></div>
                <hr>
                <button type="submit" class="changepass-btn">Change Password</button>
            </form>

            <div id="footer">
                <p id="fp">PRCSS Admin<a href="#" class="back-to-top"><span class="glyphicon glyphicon-chevron-up" id="fb"></span></a></p>
            </div>
        </div>

    </div>
</div>
</body>
</html>