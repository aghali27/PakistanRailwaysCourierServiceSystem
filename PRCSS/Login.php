<?php
include ("connection.php");
session_start();
if(isset($_SESSION['id'])){
    if($_SESSION['domain'] == "booking"){
        header("location:Booking/Booking.php");
    }else {
        header("location:Transit/Transit.php");
    }
}

$sqlstation = mysqli_query($con,"SELECT st_desc FROM pr_station");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='Assets/icons/favicon.ico' type='image/x-icon'/ >
    <title>Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="Assets/JavaScript/jquerygen.js"></script>
    <script type="text/javascript" src="jquery.backstretch.min.js"></script>
    <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="Assets/CSS/login.css" rel="stylesheet" type="text/css">
    <script src="Assets/JavaScript/login.js" type="text/javascript"></script>
    <script>
        function getlogin() {

            var userid = document.getElementById("userid").value;
            var userpass = document.getElementById("userpass").value;

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
                    document.getElementById("loginerrormsg").style.fontWeight = "bolder";
                    if (xmlhttp.responseText == 'booking') {
                        window.location = "Booking/Booking.php";
                    }
                    else if (xmlhttp.responseText == 'transit') {
                        window.location = "Transit/Transit.php";
                    }
                    else {
                        document.getElementById("loginerrormsg").innerHTML = xmlhttp.responseText;
                    }
                }
            };
            xmlhttp.open("GET","loginprocessing.php?userid="+userid+"&userpass="+userpass,true);
            xmlhttp.send();
        }
    </script>
</head>
<body>
<div id="loginpanel">
    <div class="container">
        <form class="loginform form-group float-label-control">
            <h2 class="loginformheading">PAKISTAN RAILWAYS COURIER SYSTEM SERVICES</h2>
            <div class="loginwrap">

                <div class="form-group float-label-control">
                    <label >User ID</label>
                    <input id="userid" type="text" name="id" class="form-control formlogin" placeholder="User ID" autofocus required>
                </div>

                <div class="form-group float-label-control">
                    <label >Password</label>
                    <input id="userpass" type="password" name="pass" class="form-control formlogin" placeholder="Password" required>
                </div>
                <div id="loginerrormsg" class="infobars"></div>
                <br>
                <div id="login" class="btn btn-block" onclick="getlogin()"><span>LOG IN</span></div>
                <hr>
                <a onclick="document.getElementById('id01').style.display='block'" class="createaccount">Create an Account</a>
            </div>
        </form>

        <div id="id01" class="modal">


            <div class="modal-content animate">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Form">&times;</span>
                    <h1 id="signupheading" style="color: #006622">Sign Up Now</h1>
                </div>

                <form role="form" id="signup" class="container" action="signupprocessing.php" method="post" enctype="multipart/form-data" onSubmit="return validate(this);">
                    <br>
                    <div class="form-group">
                        <input id="name" class="form-control formsignup" type="text" placeholder="Enter Name" name="uname" autofocus required>
                        <label for="name" class="formlabel">Enter Name</label>
                    </div>
                    <div id="nameerror" class="infobars"></div>
                    <br>
                    <div class="form-group">
                        <input id="cnic" class="form-control formsignup" type="number" placeholder="Enter CNIC" name="cnic" required>
                        <label for="cnic" class="formlabel">Enter CNIC</label>
                    </div>
                    <div id="cnicerror" class="infobars"></div>
                    <br>
                    <div class="form-group">
                        <input id="phone" class="form-control formsignup" type="number" placeholder="Enter Phone Number" name="phone">
                        <label for="phone" class="formlabel">Enter Phone Number</label>
                    </div>
                    <div id="phoneerror" class="infobars"></div>
                    <br>
                    <div class="form-group">
                        <input id="email" class="form-control formsignup" type="email" placeholder="Enter Email" name="email" required>
                        <label for="email" class="formlabel">Enter Email</label>
                    </div>
                    <br>
                    <div class="form-group">
                        <input id="npass" class="form-control formsignup" type="password" placeholder="Enter Password" name="pass" onkeyup="checkstrength(this.value)" required>
                        <label for="npass" class="formlabel">Enter Password</label>
                    </div>
                    <div id="showstrength" class="infobars"></div>
                    <br>
                    <div class="form-group">
                        <input id="cnpass" class="form-control formsignup" type="password" placeholder="Confirm Password" name="cnfrmpass" onkeyup="matchpass(this.value)" required>
                        <label for="cnpass" class="formlabel">Confirm Password</label>
                    </div>
                    <div id="showmatch" class="infobars"></div>
                    <br>
                    <div class="form-group">
                        <select name="udomain" class="form-control formsignup" style="font-size: 15px">
                            <option value="booking">Booking</option>
                            <option value="transit">Transit</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <input id="station" class="form-control formsignup" list="stations" placeholder="Enter Working Station" name="station" required>
                        <label for="station" class="formlabel">Enter Working Station</label>
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
                    <br>
                    <div class="form-group">
                        <label>Upload Photo</label>
                        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control formsignup">
                    </div>
                    <br>
                    <button type="submit" class="signupbtn">Create Account</button>
                </form>
            </div>
        </div>
    </div>

</div>
</body>
<script type="text/javascript">
    $.backstretch("Assets/Images/pakistan.jpg", {speed: 1000});
</script>
</html>