<?php
include ("../connection.php");
session_start();
if(!isset($_SESSION['user'])) {
    header("location:adminlogin.php");
}

$user = $_SESSION['user'];
$station = $_SESSION['station'];

$altpath2 = "../Assets/Images/img_avatar.png";

$sqlfeedback = mysqli_query($con,"SELECT * FROM feedback WHERE 	city = '$station'");

$fbcount = mysqli_num_rows($sqlfeedback);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='../Assets/icons/favicon.ico' type='image/x-icon'/ >
    <title>Feedbacks</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../Assets/CSS/adminshared.css" rel="stylesheet" type="text/css">
    <link href="../Assets/CSS/feedback.css" rel="stylesheet" type="text/css">
    <script src="../Assets/JavaScript/adminshared.js" type="text/javascript"></script>
    <script>
        function getmessage(nm,city,date,pid,msg) {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("modelcontent").innerHTML = xmlhttp.responseText;
                    }
                };
                xmlhttp.open("GET","feedbackajax.php?name="+nm+"&city="+city+"&date="+date+"&pid="+pid+"&msg="+msg,true);
                xmlhttp.send();
        }
    </script>
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
                <p id="subheading">Customer`s Feedback</p>
            </div>

            <section id="no-more-tables" class="tablecontainer">
                <?php
                if($fbcount > 0) {
                    echo "<table class='table table-hover table-striped'>
                    <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>PWBLT No.</th>
                        <th>Date</th>
                        <th>Station</th>
                    </tr>
                    </thead>
                    <tbody>";
                    while ($fbrow = mysqli_fetch_array($sqlfeedback)) {
                        $cname = $fbrow['cname'];
                        $city = $fbrow['city'];
                        $fbdate = $fbrow['fbdate'];
                        $pid = $fbrow['pid'];
                        $msg = $fbrow['message'];

                        ?>
                        <tr data-toggle='modal' data-target="#myModel"
                            onclick="getmessage('<?php echo $cname; ?>','<?php echo $city; ?>','<?php echo $fbdate; ?>','<?php echo $pid; ?>','<?php echo $msg; ?>')">
                            <td data-title="Customer Name"><?php echo $cname; ?></td>
                            <td data-title="PWBLT No."><?php echo $pid; ?></td>
                            <td data-title="Date"><?php echo $fbdate; ?></td>
                            <td data-title="Station"><?php echo $city; ?></td>
                        </tr>
                        <?php
                    }

                    echo "</tbody>
                </table>";
                }else {
                    echo "<h3>No Feedbacks to Show</h3>";
                }
                ?>
            </section>


                <div class="modal fade" id="myModel" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div id="modelcontent" class="modal-content">
                            
                        </div>
                    </div>
                </div>
            <div id="footer">
                <p id="fp">PRCSS Admin<a href="#" class="back-to-top"><span class="glyphicon glyphicon-chevron-up" id="fb"></span></a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>