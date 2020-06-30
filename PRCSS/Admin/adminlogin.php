<?php
include ("../connection.php");
session_start();
if(isset($_SESSION['user'])) {
    header("location:Admin.php");
}

$sqlstation = mysqli_query($con,"SELECT st_desc FROM pr_station");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='../Assets/icons/favicon.ico' type='image/x-icon'/ >
    <title>Admin Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="../Assets/JavaScript/jquerygen.js"></script>
    <script type="text/javascript" src="../jquery.backstretch.min.js"></script>
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../Assets/CSS/adminlogin.css" rel="stylesheet" type="text/css">
    <script src="../Assets/JavaScript/adminlogin.js" type="text/javascript"></script>
    <script>
        function getlogin() {

            var adminid = document.getElementById("adminid").value;
            var adminst = document.getElementById("adminst").value;
            var adminpass = document.getElementById("adminpass").value;

            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("loginerrormsg").style.color = "red";
                    if (xmlhttp.responseText == 'true') {
                        window.location = "Admin.php";
                    }
                    else {
                        document.getElementById("loginerrormsg").innerHTML = xmlhttp.responseText;
                    }
                }
            };
            xmlhttp.open("GET","adminloginprocessing.php?adminid="+adminid+"&adminst="+adminst+"&adminpass="+adminpass,true);
            xmlhttp.send();
        }
    </script>
</head>
<body>
<div id="loginpanel">
    <div class="container">
        <form class="loginform form-group float-label-control">
            <h2 class="loginformheading">PAKISTAN RAILWAYS COURIER SYSTEM SERVICES<br><br>Admin Login</h2>
            <div class="loginwrap">

                <div class="form-group float-label-control">
                    <label >User</label>
                    <input id="adminid" type="text" name="user" class="form-control formlogin" placeholder="User" autofocus required>
                </div>

                <div class="form-group float-label-control">
                    <label >Station</label>
                    <input id="adminst" list="stations" name="station" class="form-control formlogin" placeholder="Station" required>
                    <?php
                    // Datalist For Stations //

                    echo "<datalist id='stations' >";
                    while($row = mysqli_fetch_array($sqlstation)){
                        $name = $row["st_desc"];
                        echo "<option value='".$name."'>";

                    }
                    echo "</datalist>";
                    ?>
                </div>

                <div class="form-group float-label-control">
                    <label >Password</label>
                    <input id="adminpass" type="password" name="pass" class="form-control formlogin" placeholder="Password" required>
                </div>
                <div id="loginerrormsg" class="infobars"></div>
                <br>
                <div id="login" class="btn btn-block" onclick="getlogin()"><span>LOG IN</span></div>
            </div>
        </form>

    </div>

</div>
</body>
<script type="text/javascript">
    $.backstretch("../Assets/Images/pakistan.jpg", {speed: 1000});
</script>
</html>